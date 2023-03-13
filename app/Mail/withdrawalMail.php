<?php

namespace App\Mail;

use App\Models\Withdrawal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class withdrawalMail extends Mailable
{
  
    use Queueable, SerializesModels;
    public $withdrawal;
    /**
     * The order instance.
     *
     * @var \App\Models\Withdrawal
     */
   

    /**
     * Create a new message instance.
     *
     * @return void
     * 
     */
    public function __construct(Withdrawal $withdrawal)
    {
        $this->withdrawal = $withdrawal;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('jeffrey@example.com', 'Savings Api'),
                subject: 'transcation  ',
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
            view: 'email.withdrawal',
          with: [
            'amount_withdrawn' => $this->withdrawal->amount_withdrawn,
           
        ],


        // return $this->from('theemail@gmail.com', 'Me')
		// ->to('mumuninasaria@gmail.com', 'Your mail')
        //   ->view('email.transaction')
        //   ->with([
        //       'amount_deposited' => $this->deposit->amount_deposited
        //   ]);

    );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
