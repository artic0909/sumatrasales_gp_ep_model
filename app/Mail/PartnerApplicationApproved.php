<?php

namespace App\Mail;

use App\Models\Partner;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PartnerApplicationApproved extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Partner $partner
    ) {}

    public function envelope(): Envelope
    {
        $roleName = $this->partner->registration_type === 'GP' ? 'Ground Partner (GP)' : 'Executive Partner (EP)';
        $code = $this->partner->approved_code ?: $this->partner->application_code;

        return new Envelope(
            subject: "Application Approved: {$roleName} - Your Partner Code: {$code}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.partner_application_approved',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
