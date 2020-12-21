<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Notifications\TaskStepCompleted;
use App\Models\Task\Step;

class CompletedStepsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update,step');
    }

    public function store(Step $step)
    {
        $step->complete();

        $step->task->owner->notify(new TaskStepCompleted());

        return back();
    }

    public function destroy(Step $step)
    {
        $step->incomplete();

        return back();
    }
}
