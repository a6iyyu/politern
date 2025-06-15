<?php

namespace App\Mail;

use App\Models\Pengguna;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public Pengguna|string $pengguna;
    public string $reset, $token;

    public function __construct(Pengguna|string $pengguna, string $token)
    {
        $this->pengguna = $pengguna;
        $this->reset = url("/reset-kata-sandi/{$token}");
        $this->token = $token;
    }

    public function build(): ResetPasswordMail
    {
        return $this->subject('Reset Kata Sandi - POLITERN')
            ->view('emails.reset-kata-sandi')
            ->with(['pengguna' => $this->pengguna, 'token' => $this->token, 'reset' => $this->reset]);
    }
}