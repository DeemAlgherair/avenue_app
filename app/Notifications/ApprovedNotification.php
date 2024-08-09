<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApprovedNotification extends Notification
{
    use Queueable;
    public $message;
    public $subject;
    public $fromEmail;
    public $mailer;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->message="Dear [Customer Name],
We are pleased to inform you that your booking with us has been successfully approved! 
To complete your reservation, please proceed with the payment at your earliest convenience. You can view and manage your booking details using the link below:
[View Booking Details]
If you have any questions or need further assistance, feel free to contact us.
Thank you for choosing us!
Best regards,
The Hall Plus Team";
        $this->subject="Your Booking Has Been Approved – Pay";
        $this->fromEmail="aloufihMona@gmail.com";
        $this->mailer='smtp';
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
        return (new MailMessage)
                    ->mailer('smtp')
                    ->subject($this->subject)
                    ->greeting('Hello '. $notifiable->name)
                    ->line($this->message);
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