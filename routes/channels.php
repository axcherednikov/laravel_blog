<?php

use App\Broadcasting\TaskChannel;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('task.{task}', TaskChannel::class);

Broadcast::channel('chat', fn($user) => ['id' => $user->id, 'name' => $user->name]);
