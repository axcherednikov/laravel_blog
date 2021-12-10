<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

class NewPosts extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param  Collection  $posts
     * @param  string  $countPeriod
     * @param  string  $subject
     */
    public function __construct(
        public Collection $posts,
        public string $countPeriod,
        public string $subject = 'Уведомление о новых статьях'
    ) {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject($this->subject)
            ->markdown('mail.posts.new-posts', [
                'posts' => $this->posts,
                'countPeriod' => $this->countPeriod,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
