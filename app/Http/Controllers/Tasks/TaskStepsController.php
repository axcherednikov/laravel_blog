<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task\Task;

class TaskStepsController extends Controller
{
    public function store(Task $task)
    {
        $task->addStep(request()->validate([
            'description' => 'required|min:5'
        ]));

        return back();
    }
}
