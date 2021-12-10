<?php

namespace App\Listeners\Posts;

use App\Events\Posts\PostUpdated;
use Illuminate\Support\Facades\Mail;

class SendPostUpdateNotification
{
    /**
     * Handle the event.
     *
     * @param  PostUpdated  $event
     * @return void
     */
    public function handle(PostUpdated $event)
    {
        Mail::to(config('mail.admin.address'))->send(
            new \App\Mail\Posts\PostUpdated($event->post)
        );
    }
}
