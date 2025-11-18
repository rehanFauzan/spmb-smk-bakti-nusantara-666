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
    public $purpose;

    public function __construct($otp, $nama, $purpose = 'Pendaftaran')
    {
        $this->otp = $otp;
        $this->nama = $nama;
        $this->purpose = $purpose;
    }

    public function envelope(): Envelope
    {
        $subject = $this->purpose === 'Reset Password' 
            ? 'Kode OTP Reset Password - SMK BAKTI NUSANTARA 666'
            : 'Kode OTP Pendaftaran - SMK BAKTI NUSANTARA 666';
            
        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.otp',
        );
    }
}