<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateAdminReport implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public string $report)
    {
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('total.admin.report');
    }

    public function broadcastAs()
    {
        return 'create.admin.report';
    }
}
