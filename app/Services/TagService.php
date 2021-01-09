<?php

namespace App\Services;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Model;

class TagService
{
    public function setTags(Model $model, $request)
    {
        $syncIds = [];

        $tagsToAttach = collect(explode(',', $request['tags']))->keyBy(fn($item) => $item);

        foreach ($tagsToAttach as $tag) {
            if (! empty($tag)) {
                $tag = Tag::firstOrCreate(['name' => $tag]);
                $syncIds[] = $tag->id;
            }
        }

        $model->tags()->sync($syncIds);
    }
}
