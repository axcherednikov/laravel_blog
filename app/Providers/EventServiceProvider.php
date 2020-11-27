<?php

namespace App\Providers;

use App\Events\Posts\PostDeleted;
use App\Events\TaskCreated;
use App\Listeners\Posts\SendPostCreatedNotification;
use App\Listeners\Posts\SendPostDeleteNotification;
use App\Listeners\Posts\SendPostUpdateNotification;
use App\Listeners\SendTaskCreatedNotification;
use App\Events\Posts\PostCreated;
use App\Events\Posts\PostUpdated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class  => [
            SendEmailVerificationNotification::class,
        ],
        TaskCreated::class => [
            SendTaskCreatedNotification::class,
        ],
        PostCreated::class => [
            SendPostCreatedNotification::class,
        ],
        PostUpdated::class => [
            SendPostUpdateNotification::class,
        ],
        PostDeleted::class => [
            SendPostDeleteNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
