<?php

namespace App\Mail;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonationPendingMail extends Mailable
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
                'Yayasan Al-Kautsar'
            ),
            subject: 'Terima Kasih! Donasi Anda Sedang Diproses — Yayasan Al-Kautsar',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.donation_pending',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
