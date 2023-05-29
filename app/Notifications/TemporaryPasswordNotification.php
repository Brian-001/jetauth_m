<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TemporaryPasswordNotification extends Notification
{
    use Queueable;

    
    /**
     * @var string
     * Create a new notification instance.
     */

     private $temporaryPassword;

    public function __construct(string $temporaryPassword)
    {
        $this->temporaryPassword = $temporaryPassword;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $temporaryPassword = $this->temporaryPassword;
        return (new MailMessage)
            ->subject('Temporary Password')
            ->line('You are receiving this email because you have been assigned as the admin user.')
            ->line('Your temporary password is: ' . $temporaryPassword)
            ->line('Please log in using this password and change it immediately.')
            ->action('Log In', route('http://127.0.0.1:8000/admin/admin-login'))
            ->line('If you did not request this password, please contact the site administrator.');
}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
