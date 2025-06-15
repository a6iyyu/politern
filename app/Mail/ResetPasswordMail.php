<?php

namespace App\Mail;

use App\Models\Pengguna;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pengguna;
    public $token;
    public $resetUrl;

    public function __construct($pengguna, $token)
    {
        $this->pengguna = $pengguna;
        $this->token = $token;
        $this->resetUrl = url('/reset-password/'.$token);
    }

    public function build()
    {
        return $this->subject('Reset Password - POLITERN')
                   ->view('emails.reset-password')
                   ->with([
                       'pengguna' => $this->pengguna,
                       'token' => $this->token,
                       'resetUrl' => $this->resetUrl
                   ]);
    }
}