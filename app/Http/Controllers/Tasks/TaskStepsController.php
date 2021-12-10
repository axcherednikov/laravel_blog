<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Task\Task;
use App\Services\TagService;

class TaskStepsController extends Controller
{
    public function store(Task $task, TagRequest $tagRequest, TagService $tagService)
    {
        $step = $task->addStep(request()->validate([
            'description' => 'required|min:5',
        ]));

        $tagService->setTags($step, $tagRequest);

        return back();
    }
}
