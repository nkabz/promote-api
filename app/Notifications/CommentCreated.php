<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use App\Http\Resources\CommentResource;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommentCreated extends Notification
{
    use Queueable;

    private $message = 'There\'s a new message in your post!';
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting(`Hello {$notifiable->name}!`)
                    ->subject($this->message)
                    ->line($this->message)
                    ->line('Thank you for using the ' . env('APP_NAME') . '!');
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
            'fromUser' => $this->user->name,
            'message' => $this->message,
        ];
    }
}
