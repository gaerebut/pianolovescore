<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contactus extends Mailable
{
    use Queueable, SerializesModels;

    public $lastname, $firstname, $email, $subject, $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lastname, $firstname, $email, $subject, $message)
    {
        $this->lastname     = $lastname ;
        $this->firstname    = $firstname ;
        $this->email        = $email ;
        $this->subject      = $subject ;
        $this->message      = $message ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view( 'emails.contactus' );
    }
}
