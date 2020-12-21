<?php

namespace App\Listeners\Posts;

use App\Events\Posts\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPostCreatedNotification
{
    /**
     * Handle the event.
     *
     * @param PostCreated $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        Mail::to(config('mail.admin.address'))->send(
            new \App\Mail\Posts\PostCreated($event->post)
        );
    }
}
