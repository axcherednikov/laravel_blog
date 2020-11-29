<?php

namespace App\Events\Posts;

use App\Events\AbstractEvents;
use App\Models\Post\Post;

abstract class AbstractPostsEvents extends AbstractEvents
{
    public Post $post;

    /**
     * Create a new event instance.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}
