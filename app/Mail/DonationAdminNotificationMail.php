<?php

namespace App\Mail;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonationAdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Donation $donation;

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address(
                config('mail.from.address', 'admin@yysalkautsar.or.id'),
                'Sistem Donasi Al-Kautsar'
            ),
            subject: '[DONASI BARU] ' . $donation->donator_name . ' — Rp ' . number_format($donation->amount, 0, ',', '.'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.donation_admin_notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
