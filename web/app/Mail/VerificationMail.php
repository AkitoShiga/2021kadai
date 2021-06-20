<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Verification mail';
        $baseUrl = config('app.url');
        $token = $this->token;
        $url = "{$baseUrl}/verification/{$token}";
        $from = config('mail.from.address');
        return $this
            ->from($from)
            ->subject($subject)
            ->view('mails.verification_mail')
            ->with('url', $url);
    }
}
