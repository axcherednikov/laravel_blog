<?php

namespace App\Events\Posts;

use App\Events\AbstractEvents;
use App\Models\Post\Post;

abstract class AbstractPostsEvents extends AbstractEvents
{
    public function __construct(public Post $post)
    {
    }
}
