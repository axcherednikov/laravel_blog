<?php

namespace App\Services;

use App\Models\Post\Post;
use App\Models\Post\Tag;

class PostsService
{
    /**
     * @param Post $post
     * @param $requestTags
     */
    public function setTags(Post $post, $requestTags)
    {
        $postTags = $post->tags->keyBy('name');

        $tags = collect(explode(',', $requestTags['tags']))->keyBy(fn($item) => $item);

        $syncIds = $postTags->intersectByKeys($tags)->pluck('id')->toArray();

        $tagsToAttach = $tags->diffKeys($postTags);

        foreach ($tagsToAttach as $tag) {
            if (! empty($tag)) {
                $tag = Tag::firstOrCreate(['name' => $tag]);
                $syncIds[] = $tag->id;
            }
        }

        $post->tags()->sync($syncIds);
    }
}
