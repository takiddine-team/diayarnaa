<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelloEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd('erصثقبثصقثصg');
        /**
         * Replace the "from" field with your valid sender email address.
         * The "email-template" is the name of the file present inside
         * "resources/views" folder. If you don't have this file, then
         * create it.
         */
        return $this->view('email.template')->subject('Enquiry Replay from Diyarnaa ');
        // return $this->from("support@example.com")->view('email.template');
    }
}