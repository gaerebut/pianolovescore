<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScoreRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $view_path, $score_request;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($state, $score_request)
    {
        $this->view_path = 'emails.score_request.' . $state;
        $this->score_request = $score_request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view( $this->view_path );
    }
}
