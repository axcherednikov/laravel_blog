<?php

namespace App\Policies;

use App\Step;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StepPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Step $step)
    {
        return $step->task->owner->id == $user->id;
    }
}
