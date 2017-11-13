<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScoreRequestRefused extends Mailable
{
    use Queueable, SerializesModels;

    private $score_url, $score_title, $score_author, $contact_firstname, $admin_comment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($score_url, $score_title, $score_author, $contact_firstname, $admin_comment)
    {
        $this->score_url = $score_url;
        $this->score_title = $score_title;
        $this->score_author = $score_author;
        $this->contact_firstname = $contact_firstname;
        $this->admin_comment = $admin_comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.score_request.refused');
    }
}
