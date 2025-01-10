<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostCreated extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('ახალი პოსტი შეიქმნა.')
                    ->action('ნახე პოსტი', url('/posts'))
                    ->line('მადლობას გიხდით ჩვენთან ყოფნისთვის!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'ახალი პოსტი შეიქმნა.'
        ];
    }
}
