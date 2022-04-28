<?php

declare(strict_types=1);

namespace App\Models\News;

use App\Models\Comment\Comment;
use App\Models\Contracts\HasTags;
use App\Models\Tag\Tag;
use App\Traits\HasFlushTagCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class News extends Model implements HasTags
{
    use HasFactory, HasFlushTagCache;

    protected $guarded = [];

    protected static array $tagsCache = ['news'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
