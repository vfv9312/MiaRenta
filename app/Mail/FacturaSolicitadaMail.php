<?php

namespace App\Mail;

use App\Models\FacturaSolicitada;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FacturaSolicitadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $facturaSolicitada;

    /**
     * Create a new message instance.
     */
    public function __construct(FacturaSolicitada $facturaSolicitada)
    {
        $this->facturaSolicitada = $facturaSolicitada;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva Solicitud de Factura - Ticket ' . $this->facturaSolicitada->numero_ticket,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.factura_solicitada',
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

        if ($this->facturaSolicitada->constancia_path) {
            $attachments[] = Attachment::fromStorageDisk('public', $this->facturaSolicitada->constancia_path)
                ->as('Constancia.pdf'); // Assuming it might be generic. Or we can leave normal name using fromStorage.
        }

        if ($this->facturaSolicitada->nota_path) {
            $attachments[] = Attachment::fromStorageDisk('public', $this->facturaSolicitada->nota_path)
                ->as('Nota.pdf');
        }

        return $attachments;
    }
}
