<?php

namespace App\Mail;

use App\Models\Task\Task;

class TaskCreated extends AbstractEmails
{
    public Task $task;

    /**
     * Create a new message instance.
     *
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.task-created');
    }
}
