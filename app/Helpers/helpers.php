<?php

if (! function_exists('flash')) {

    /**
     * @param string $message
     * @param string $type
     */
    function flash(string $message, string $type = 'success'): void
    {
        session()->flash('message', $message);
        session()->flash('message_type', $type);
    }
}

if (! function_exists('push_all')) {

    /**
     * @param string|null $title
     * @param string|null $text
     * @return \App\Services\PushAll|mixed
     */
    function push_all(string $title = null, string $text = null)
    {
        if (is_null($title) || is_null($text)) {
            return app(\App\Services\PushAll::class);
        }

        return app(\App\Services\PushAll::class)->send($title, $text);
    }
}
