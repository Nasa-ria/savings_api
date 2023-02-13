<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class savingMail extends Mailable
{
    use Queueable, SerializesModels;
     
    public $data ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this-> data = $data;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Saving Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {

        return new Content(
            view: 'email.test ',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        // return [];
    }

    public function build()
    {
        // return $this->from('emailTesting@gmail.com','hello world')
        // ->subject($this->data['subject'])->view('email.test')
        // ->with('data',$this->data);
        return $this->subject('Mail from ItSolutionStuff.com')
        ->view('emails.test');
    }
}
