<?php

namespace App\Events\Posts;

use App\Models\Post\Post;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostUpdated extends AbstractPostsEvents implements ShouldBroadcast
{
    public string $message;

    public function __construct(public Post $post)
    {
        parent::__construct($post);

        $this->message = $this->createMessage($post);
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('update.post.report');
    }

    public function broadcastAs(): string
    {
        return 'post.updated';
    }

    public function createMessage(Post $post): string
    {
        $after = $post->getDirty();
        $before = \Arr::only($post->fresh()->toArray(), array_keys($after));

        $message = '<p>Новые данные: ' . json_encode($after, JSON_UNESCAPED_UNICODE) . '</p>';
        $message .= '<p>Старые данные: ' . json_encode($before, JSON_UNESCAPED_UNICODE) . '</p>';
        $message .= '<a href="' . route('posts.show', $post->slug) . '">Ссылка на статью</a>';

        return $message;
    }

    public function broadcastWith(): array
    {
        return [
            'title' => $this->post->title,
            'message' => $this->message,
        ];
    }
}
