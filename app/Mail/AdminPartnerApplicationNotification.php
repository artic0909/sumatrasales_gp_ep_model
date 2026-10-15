<?php

namespace App\Mail;

use App\Models\Partner;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminPartnerApplicationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Partner $partner
    ) {}

    public function envelope(): Envelope
    {
        $roleName = $this->partner->registration_type === 'GP' ? 'GP (Ground Partner)' : 'EP (Executive Partner)';

        return new Envelope(
            subject: "[New Application] {$roleName}: {$this->partner->name} ({$this->partner->application_code})",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_partner_application_notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
