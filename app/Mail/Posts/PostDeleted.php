<?php

namespace App\Mail\Posts;

class PostDeleted extends AbstractPostsEmail
{
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.posts.delete-post');
    }
}
