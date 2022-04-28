<?php

declare(strict_types=1);

namespace App\Models\Post;

use App\Events\Posts\PostUpdated;
use App\Models\Comment\Comment;
use App\Models\Contracts\HasTags;
use App\Models\Tag\Tag;
use App\Models\User;
use App\Traits\HasFlushTagCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Arr;

class Post extends Model implements HasTags
{
    use HasFactory, HasFlushTagCache;

    protected $guarded = [];

    protected static array $tagsCache = ['posts'];

    protected static function boot()
    {
        parent::boot();

        static::updating(function(Post $post) {
            $after = $post->getDirty();

            $post->history()->attach(auth()->id(), [
                'before' => json_encode(Arr::only($post->fresh()->toArray(), array_keys($after))),
                'after'  => json_encode($after),
            ]);

            event(new PostUpdated($post));
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeUnpublished($query)
    {
        return $query->where('publish', 0)->get();
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function history(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class, 'post_histories')
            ->withPivot(['before', 'after'])
            ->withTimestamps();
    }
}
