<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $tokenData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tokenData)
    {
        $this->tokenData=$tokenData;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Reset Password')
            ->view('email.SendResetEmail');
    }
}
