<?php

namespace App\Mail;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
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

        $subject = 'New Quote Inquiry ['.$this->quote->quote_ref.'] - '.($this->quote->name ?: 'New Customer').' ('.($this->quote->type_label ?: 'General Insurance').')';

        return new Envelope(
            subject: $subject,
            replyTo: $replyTo,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new-quote',
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
