<?php

namespace App\Listeners\Posts;

use App\Events\Posts\PostDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPostDeleteNotification
{
    /**
     * Handle the event.
     *
     * @param PostDeleted $event
     * @return void
     */
    public function handle(PostDeleted $event)
    {
        Mail::to(config('mail.admin.address'))->send(
            new \App\Mail\Posts\PostDeleted($event->post)
        );
    }
}
