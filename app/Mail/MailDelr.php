<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailDelr extends Mailable
{
    use Queueable, SerializesModels;
    public  $nom;
    public  $email_source;
    public  $sujet;
    public  $messages;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($demo)
    {
        $this->nom = $demo->nom;
        $this->email_source = $demo->email_source;
        $this->sujet = $demo->sujet;
        $this->messages = $demo->messages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('delrcovid19@gmail.com')
        ->view('emails.newMailDelr');
    }
}
