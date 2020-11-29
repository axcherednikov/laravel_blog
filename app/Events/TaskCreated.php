<?php

namespace App\Events;

use App\Models\Task\Task;

class TaskCreated extends AbstractEvents
{
    public $task;

    /**
     * Create a new event instance.
     *
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }
}
