<?php

namespace App\Mail\Posts;

class PostUpdated extends AbstractPostsEmail
{
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.posts.updated-post');
    }
}
