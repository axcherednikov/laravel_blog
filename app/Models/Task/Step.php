<?php

namespace App\Models\Task;

use App\Models\Contracts\HasTags;
use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * App\Models\Task\Step.
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
 * @method static \Database\Factories\Task\StepFactory factory(...$parameters)
 * @method static Builder|Step newModelQuery()
 * @method static Builder|Step newQuery()
 * @method static Builder|Step query()
 * @method static Builder|Step whereCompleted($value)
 * @method static Builder|Step whereCreatedAt($value)
 * @method static Builder|Step whereDescription($value)
 * @method static Builder|Step whereId($value)
 * @method static Builder|Step whereTaskId($value)
 * @method static Builder|Step whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Step extends Model implements HasTags
{
    use HasFactory;

    protected $guarded = [];

    public function task(): BelongsTo
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

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
