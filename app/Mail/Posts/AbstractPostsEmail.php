<?php

namespace App\Mail\Posts;

use App\Mail\AbstractEmails;
use App\Models\Post\Post;

abstract class AbstractPostsEmail extends AbstractEmails
{
    public Post $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}
