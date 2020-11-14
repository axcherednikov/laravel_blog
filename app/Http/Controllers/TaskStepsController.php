<?php

namespace App\Http\Controllers;

use App\Step;
use App\Task;

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
