<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEnquiryReplay extends Mailable
{
    use Queueable, SerializesModels;
    public $request;
    public $advertisement_id;

    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request,$advertisement_id)
    {
        $this->request = $request;
        $this->advertisement_id = $advertisement_id;
        // dd($advertisement_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.Enquiryreplay')->subject('Enquiry Replay from Diyarnaa ');
    }
}
