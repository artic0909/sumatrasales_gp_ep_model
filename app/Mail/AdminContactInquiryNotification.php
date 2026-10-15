<?php

namespace App\Mail;

use App\Models\ContactInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminContactInquiryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactInquiry $inquiry
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "[New Website Inquiry] {$this->inquiry->inquiry_type} - From: {$this->inquiry->name}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_contact_inquiry_notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
