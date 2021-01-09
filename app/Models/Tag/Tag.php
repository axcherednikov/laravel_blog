<?php

namespace App\Models\Tag;

use App\Models\News\News;
use App\Models\Post\Post;
use App\Models\Task\Step;
use App\Models\Task\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tag\Tag
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Post[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Step[] $steps
 * @property-read int|null $steps_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Task[] $tasks
 * @property-read int|null $tasks_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function tasks()
    {
        return $this->morphedByMany(Task::class, 'taggable');
    }

    public function steps()
    {
        return $this->morphedByMany(Step::class, 'taggable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    public static function tagsTaskCloud()
    {
        return (new static)->has('tasks')->get();
    }

    public static function tagsPostCloud()
    {
        return (new static)->has('posts')->get();
    }

    public static function tagsNewsCloud()
    {
        return (new static)->has('news')->get();
    }
}
