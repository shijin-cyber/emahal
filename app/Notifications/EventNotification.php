<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventNotification extends Notification
{
    use Queueable;
      protected $information = null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($info = null)
    {
         $this->information = $info;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                   ->line('You have a notice from E-mahal Software')
                    ->action('Go to your dashboard', url('/'))
                    ->line('Thank you for using our application!');
    
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
     public function toDatabase($notifiable)
    {
        return [
            'body' => 'You have a notice from E-mahal Software.',
            'link' => 'edit-event'.@$this->information->id
        ];
    }
}
