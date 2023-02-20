<?php

namespace App\Listeners;

use App\Events\Mailtransaction;
use App\Mail\transactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class transactionMail
{
 
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //  
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle( Mailtransaction $event)
    {
        // DB:: table('users')->update([
        //     'email'=>$event->email
        // ]);
        Mail::to($event->email)->send(new transactions);
    }
}
  