<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task\Tag;
use App\Models\Task\Task;

class TaskStepsController extends Controller
{
    public function store(Task $task)
    {
        $step = $task->addStep(request()->validate([
            'description' => 'required|min:5'
        ]));

        $tagsToAttach = collect(explode(',', request('tags')))->keyBy(fn($item) => $item);

        $syncIds = [];

        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $step->tags()->sync($syncIds);

        return back();
    }
}
