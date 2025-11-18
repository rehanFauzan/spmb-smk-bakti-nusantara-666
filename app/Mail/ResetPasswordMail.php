<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $token;
    public $email;

    public function __construct($name, $token, $email)
    {
        $this->name = $name;
        $this->token = $token;
        $this->email = $email;
    }

    public function build()
    {
        $resetUrl = route('pendaftaran.reset-password', [
            'token' => $this->token,
            'email' => $this->email
        ]);

        return $this->subject('Reset Password - SPMB SMK Bakti Nusantara 666')
                    ->view('emails.reset-password')
                    ->with([
                        'name' => $this->name,
                        'resetUrl' => $resetUrl
                    ]);
    }
}