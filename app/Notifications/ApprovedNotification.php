<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $subject;
    public $bookingUrl;

    /**
     * Create a new notification instance.
     *
     * @param string $bookingUrl
     */
    public function __construct($bookingUrl)
    {
        $this->subject = "Your Booking Has Been Approved – Pay";
        $this->bookingUrl = $bookingUrl;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject($this->subject)
                    ->greeting('Hello ' . $notifiable->name)
                    ->line('We are pleased to inform you that your booking with us has been successfully approved!')
                    ->line('To complete your reservation, please proceed with the payment at your earliest convenience.')
                    ->action('View Booking Details', $this->bookingUrl)
                    ->line('If you have any questions or need further assistance, feel free to contact us.')
                    ->line('Thank you for choosing us!')
                    ->salutation('Best regards, The Hall Plus Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
