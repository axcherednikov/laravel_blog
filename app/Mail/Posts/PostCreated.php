<?php

namespace App\Mail\Posts;

class PostCreated extends AbstractPostsEmail
{
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.posts.created-post');
    }
}
