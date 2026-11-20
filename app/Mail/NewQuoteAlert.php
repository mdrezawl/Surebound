<?php

namespace App\Mail;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Queue\SerializesModels;

class NewQuoteAlert extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Quote $quote) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $replyTo = [];
        if (! empty($this->quote->email) && filter_var($this->quote->email, FILTER_VALIDATE_EMAIL) && ! str_contains($this->quote->email, '@surebound-inquiry.com')) {
            $replyTo[] = new Address($this->quote->email, $this->quote->name ?: 'Customer');
        }

        $customerName = trim($this->quote->name ?: 'New Customer');
        $policyType = trim($this->quote->type_label ?: ucfirst(str_replace('_', ' ', $this->quote->type ?: 'Insurance')));
        $subject = "New Lead: {$customerName} - {$policyType} (#{$this->quote->quote_ref})";

        return new Envelope(
            from: new Address(config('mail.from.address', 'karry@sureboundinsurance.com'), config('mail.from.name', 'Surebound Insurance')),
            replyTo: $replyTo,
            subject: $subject,
        );
    }

    /**
     * Get the message content definition with multipart/alternative (HTML + Plain Text).
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new-quote',
            text: 'emails.new-quote-text',
        );
    }

    /**
     * High inbox-deliverability transactional headers.
     */
    public function headers(): Headers
    {
        return new Headers(
            text: [
                'X-Priority' => '1',
                'X-MSMail-Priority' => 'High',
                'Importance' => 'High',
                'Priority' => 'Urgent',
                'X-Mailer' => 'Surebound Insurance Notification Engine v2.0',
                'X-Auto-Response-Suppress' => 'OOF, AutoReply',
                'Auto-Submitted' => 'auto-generated',
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
