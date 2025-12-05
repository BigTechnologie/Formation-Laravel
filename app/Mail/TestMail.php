<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;
     public $messageContent;
      public $attachment;

    /**
     * Create a new message instance.
     */
    public function __construct($messageContent, $attachment = null)
    {
       $this->messageContent = $messageContent;
       $this->attachment = $attachment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('dev.technologie2018@gmail.com', 'Admin'),
            subject: 'Message Laravel avec pièce jointe',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.test', // test.blade.php -> La vue ou on affiche le contenu du message
            with: ['messageContent' => $this->messageContent]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    */
    public function attachments(): array
    {
        return $this->attachment ? [
            \Illuminate\Mail\Mailables\Attachment::fromPath($this->attachment->getRealPath())
                ->as($this->attachment->getClientOriginalName()) // Nom du fichier
                ->withMime($this->attachment->getMimeType()) // Type MIME du fichier
        ] : [];
    }
}
