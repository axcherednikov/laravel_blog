<?php

namespace App\Models\Task;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Task\Step
 *
 * @property int $id
 * @property int $task_id
 * @property string $description
 * @property int $completed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read \App\Models\Task\Task $task
 * @method static \Illuminate\Database\Eloquent\Builder|Step newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Step newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Step query()
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Step extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function complete($complete = true): void
    {
        $this->update(['completed' => $complete]);
    }

    public function incomplete(): void
    {
        $this->complete(false);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
