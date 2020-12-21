<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTaskCreatedNotification
{
    /**
     * Handle the event.
     *
     * @param TaskCreated $event
     * @return void
     */
    public function handle(TaskCreated $event)
    {
        Mail::to($event->task->owner->email)->send(
            new \App\Mail\TaskCreated($event->task)
        );
    }
}
