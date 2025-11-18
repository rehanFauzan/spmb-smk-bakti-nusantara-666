<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $nama;

    public function __construct($otp, $nama)
    {
        $this->otp = $otp;
        $this->nama = $nama;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode OTP Pendaftaran - SMK BAKTI NUSANTARA 666',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.otp',
        );
    }
}