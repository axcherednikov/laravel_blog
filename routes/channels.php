<?php

use App\Broadcasting\TaskChannel;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('task.{task}', TaskChannel::class);
Broadcast::channel('admin.report', fn(User $user) => $user->isAdmin());
Broadcast::channel('total.admin.report', fn(User $user) => $user->isAdmin());

Broadcast::channel('chat', fn($user) => ['id' => $user->id, 'name' => $user->name]);
