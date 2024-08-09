<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customerName;
    public $bookingId;
    public $bookingDetailsUrl;
    public $paymentDeadline;

    /**
     * Create a new message instance.
     */
    public function __construct($customerName, $bookingId, $bookingDetailsUrl,$paymentDeadline)
    {
        $this->customerName = $customerName;
        $this->bookingId = $bookingId;
        $this->bookingDetailsUrl = $bookingDetailsUrl;
        $this->paymentDeadline = $paymentDeadline;
    }

    /**
     * Get the message envelope.
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Your Booking Has Been Approved – Pay',
        );
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('Frontend.Auth.approvednotification') // Corrected path
        ->with([
            'customerName' => $this->customerName,
            'bookingId' => $this->bookingId,
            'bookingDetailsUrl' => $this->bookingDetailsUrl,
            'paymentDeadline' => $this->paymentDeadline,
        ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}