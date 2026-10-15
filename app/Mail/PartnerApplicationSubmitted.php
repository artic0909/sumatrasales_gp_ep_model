<?php

namespace App\Mail;

use App\Models\Partner;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PartnerApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Partner $partner
    ) {}

    public function envelope(): Envelope
    {
        $roleName = $this->partner->registration_type === 'GP' ? 'Ground Partner (GP)' : 'Executive Partner (EP)';

        return new Envelope(
            subject: "Application Received: {$roleName} - Ref: {$this->partner->application_code}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.partner_application_submitted',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
