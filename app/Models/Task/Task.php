<?php

namespace App\Models\Task;

use App\Events\TaskUpdated;
use App\Models\Company;
use App\Models\Contracts\HasTags;
use App\Models\Tag\Tag;
use App\Models\User;
use App\Events\TaskCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

/**
 * App\Models\Task\Task
 *
 * @property int $id
 * @property int $owner_id
 * @property string $title
 * @property string $body
 * @property bool $completed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $type
 * @property \datetime $viewed_at
 * @property array|null $options
 * @property-read mixed $double_type
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $history
 * @property-read int|null $history_count
 * @property-read User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task\Step[] $steps
 * @property-read int|null $steps_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Task incomplete()
 * @method static \Illuminate\Database\Eloquent\Builder|Task new()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task ofType(string $type)
 * @method static \Illuminate\Database\Query\Builder|Task onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereViewedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Task withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Task withoutTrashed()
 * @mixin \Eloquent
 * @property-read Company|null $company
 */
class Task extends Model implements HasTags
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => TaskCreated::class,
        'updated' => TaskUpdated::class,
    ];

    protected $attributes = [
        'type' => 'new',
    ];

    protected $appends = [
        'double_type',
    ];

    protected $dates = [
        'viewed_at',
    ];

    protected $casts = [
        'completed' => 'boolean',
        'options'   => 'array',
        'viewed_at' => 'datetime:Y-m-d',
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function (Task $task) {
            $after = $task->getDirty();

            $task->history()->attach(auth()->id(), [
                'before' => json_encode(Arr::only($task->fresh()->toArray(), array_keys($after))),
                'after'  => json_encode($after),
            ]);
        });

        static::created(function () {
            \Cache::tags(['tasks'])->flush();
        });
        static::updated(function () {
            \Cache::tags(['tasks'])->flush();
        });
        static::deleted(function () {
            \Cache::tags(['tasks'])->flush();
        });

//        self::addGlobalScope('onlyNew', function (\Illuminate\Database\Eloquent\Builder $builder) {
//            $builder->new();
//        });
    }

    public function getTypeAttribute(string $value): string
    {
        return ucfirst($value);
    }

    public function getDoubleTypeAttribute()
    {
        return str_repeat($this->type, 2);
    }

    public function setTypeAttribute(string $value)
    {
        $this->attributes['type'] = ucfirst(mb_strtolower($value));
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function scopeIncomplete($query)
    {
        return $query->where('completed', 0)->get();
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeNew($query)
    {
        return $query->ofType('new');
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function addStep(array $attributes)
    {
        return $this->steps()->create($attributes);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function history()
    {
        return $this
            ->belongsToMany(User::class, 'task_histories')
            ->withPivot(['before', 'after'])
            ->withTimestamps();
    }

    public function company()
    {
        return $this->hasOneThrough(Company::class, User::class, 'id', 'owner_id');
    }
}
