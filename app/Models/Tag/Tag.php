<?php

declare(strict_types=1);

namespace App\Models\Tag;

use App\Models\News\News;
use App\Models\Post\Post;
use App\Models\Task\Step;
use App\Models\Task\Task;
use App\Traits\HasFlushTagCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

class Tag extends Model
{
    use HasFactory, HasFlushTagCache;

    protected $guarded = [];

    protected static array $tagsCache = ['tags'];

    public function getRouteKeyName(): string
    {
        return 'name';
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function tasks(): MorphToMany
    {
        return $this->morphedByMany(Task::class, 'taggable');
    }

    public function steps(): MorphToMany
    {
        return $this->morphedByMany(Step::class, 'taggable');
    }

    public function news(): MorphToMany
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    public static function tagsTaskCloud(): \Illuminate\Database\Eloquent\Collection|array|Collection
    {
        return (new static())->has('tasks')->get();
    }

    public static function tagsPostCloud(): \Illuminate\Database\Eloquent\Collection|array|Collection
    {
        return (new static())->has('posts')->get();
    }

    public static function tagsNewsCloud(): \Illuminate\Database\Eloquent\Collection|array|Collection
    {
        return (new static())->has('news')->get();
    }
}
