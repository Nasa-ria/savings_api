<?php

namespace App\Mail;

use App\Models\Deposit;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class transactions extends Mailable
{
  
    use Queueable, SerializesModels;
    public $deposit;
    /**
     * The order instance.
     *
     * @var \App\Models\Deposit
     */
   

    /**
     * Create a new message instance.
     *
     * @return void
     * 
     */
    public function __construct(Deposit $deposit)
    {
        $this->deposit = $deposit;
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
            view: 'email.transaction',
          with: [
            'amount_deposited' => $this->deposit->amount_deposited,
           
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

    // public function build(){
    //     return $this->from('theemail@gmail.com', 'Me')
	// 	->to('mumuninasaria@gmail.com', 'Your mail')
    //       ->view('email.transaction')
    //       ->with([
    //           'amount_deposited' => $this->deposit->amount_deposited
    //       ]);
    // }
}
