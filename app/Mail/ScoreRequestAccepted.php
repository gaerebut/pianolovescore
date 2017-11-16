<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScoreRequestAccepted extends Mailable
{
    use Queueable, SerializesModels;

    public $score_request;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($score_request)
    {
        $this->score_request = $score_request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.score_request.accepted');
    }
}
