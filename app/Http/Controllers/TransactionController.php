<?php

namespace App\Http\Controllers;

// use App\Mail\Mail;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Events\Mailtransaction;
use App\Mail\withdrawalMail;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{

    public function deposit(Request $request, User $user)
    {
        $request->validate([
            'amount_deposited' => 'required',
        ]);
        $deposit = new Deposit();
        $deposit['user_id'] = $user->id; 
        $deposit->amount_deposited = $request->input('amount_deposited');
        $deposit->save();
        $email =   $user->email;
        event(new Mailtransaction($email, $deposit));
        #updating balance  
        $balance = $user->balance + $deposit->amount_deposited;
        $user->update(['balance' => $balance]);
        return response()->json([
            "deposit"=>$deposit,
            "balance" => $user->balance,


        ]);
    }


    public function withdrawals(Request $request, User $user )
    {
        $request->validate([
            'amount_withdrawn' => 'required',
        ]);

        $withdrawal = new Withdrawal();
        $withdrawal['user_id'] =$user->id;
        $withdrawal->amount_withdrawn = $request->input('amount_withdrawn');
        $withdrawal->save();
        $email =$user->email;
        Mail::to($email)->send(new withdrawalMail($withdrawal));
        // updating balance
        $balance = $user->balance - $withdrawal->amount_withdrawn;
        $user->update(['balance' => $balance]);
                return response()->json([
                    "withdrawal" => $withdrawal,
                    "User balance" => $user->balance
                ]);
            }
        }
    

