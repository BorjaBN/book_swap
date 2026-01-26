<?php

namespace App\Mail;

use App\Models\Intercambio;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class IntercambioAceptadoSolicitante extends Mailable
{
    use Queueable, SerializesModels;

    public $intercambio;

    /**
     * Create a new message instance.
     */
    public function __construct(Intercambio $intercambio)
    {
        $this->intercambio = $intercambio;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu intercambio ha sido aceptado'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.intercambio-aceptado-solicitante',
            with: [
                'intercambio' => $this->intercambio,
                'solicitante' => $this->intercambio->solicitante,
                'propietario' => $this->intercambio->propietario,
                'libro'       => $this->intercambio->libro,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
