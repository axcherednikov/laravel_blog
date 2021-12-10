<?php

declare(strict_types=1);

namespace App\Broadcasting;

use App\Models\Task\Task;
use App\Models\User;

class TaskChannel
{
    public function __construct()
    {
    }

    function join(User $user, Task $task): bool
    {
        return $user->id == $task->owner_id;
    }
}
