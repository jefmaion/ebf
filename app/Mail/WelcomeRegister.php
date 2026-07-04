<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class WelcomeRegister extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $childname;
    public $qrCode;
    public $qrCodePath;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $childname, $hash)
    {
        $this->name = $name;
        $this->childname = $childname;
        $this->qrCode = base64_encode(QrCode::size(400)->margin(2)->generate($hash));
        Storage::disk('public')->put("qrcodes/{$hash}.png",QrCode::format('png')->size(400)->margin(2)->generate($hash));
        $this->qrCodePath = storage_path("app/public/qrcodes/{$hash}.png");
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'EBF 2026 - Inscrição Confirmada!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome-register',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
