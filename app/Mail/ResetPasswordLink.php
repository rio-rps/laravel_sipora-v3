<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordLink extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $email;

    public function __construct($url, $email)
    {
        $this->url = $url;
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('LINK RESET PASSWORD SIPORA')
            ->markdown('mail.reset-password-link')
            ->with([
                'url' => $this->url,
                'email' => $this->email,
            ]);
    }
}
