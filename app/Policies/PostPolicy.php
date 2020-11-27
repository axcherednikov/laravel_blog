<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Post $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $post->owner_id == $user->id;
    }
}
