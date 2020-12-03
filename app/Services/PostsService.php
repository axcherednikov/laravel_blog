<?php

namespace App\Services;

use App\Models\Post\Post;
use App\Models\Post\Tag;

class PostsService
{
    /**
     * @param Post $post
     */
    public static function setTags(Post $post)
    {
        $postTags = $post->tags->keyBy('name');

        $tags = collect(explode(',', request('tags')))->keyBy(fn ($item) => $item);

        $syncIds = $postTags->intersectByKeys($tags)->pluck('id')->toArray();

        $tagsToAttach = $tags->diffKeys($postTags);

        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $post->tags()->sync($syncIds);
    }
}
