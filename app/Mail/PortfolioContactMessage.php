<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Mime\Address;

class PortfolioContactMessage extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public array $messageData,
        public string $lang
    ) {
    }

    public function envelope(): Envelope
    {
        $subject = $this->lang === 'hu'
            ? "Kapcsolatfelvétel a portfólió oldalról - {$this->messageData['name']}"
            : "Contact from portfolio site - {$this->messageData['name']}";

        return new Envelope(
            subject: $subject,
            replyTo: [
                new Address($this->messageData['email'], $this->messageData['name']),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.portfolio-contact',
        );
    }
}
