<?php

namespace App\Policies;

use App\Models\Task\Step;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StepPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Step $step)
    {
        return $step->task->owner->id == $user->id;
    }
}
