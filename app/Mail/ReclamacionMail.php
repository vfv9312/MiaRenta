<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReclamacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $evidenciaPath;
    public $evidenciaName;

    /**
     * Create a new message instance.
     */
    public function __construct($data, $evidenciaPath = null, $evidenciaName = null)
    {
        $this->data = $data;
        $this->evidenciaPath = $evidenciaPath;
        $this->evidenciaName = $evidenciaName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva Reclamación / Sugerencia de: ' . $this->data['nombre'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reclamacion',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        if ($this->evidenciaPath) {
            $attachments[] = Attachment::fromStorageDisk('public', $this->evidenciaPath)
                ->as($this->evidenciaName ?? 'Evidencia');
        }

        return $attachments;
    }
}
