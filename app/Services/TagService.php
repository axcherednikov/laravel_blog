<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\TagRequest;
use App\Models\Contracts\HasTags;
use App\Models\Tag\Tag;

class TagService
{
    public function setTags(HasTags $tags, TagRequest $request): void
    {
        $syncIds = [];

        foreach ($request->input('tags') as $tag) {
            if (! empty($tag)) {
                $tag = Tag::firstOrCreate(['name' => $tag]);
                $syncIds[] = $tag->id;
            }
        }

        $tags->tags()->sync($syncIds);
    }
}
