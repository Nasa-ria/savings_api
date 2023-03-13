<?php

namespace App\Http\Controllers;

// use App\Mail\Mail;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Events\Mailtransaction;
use App\Mail\withdrawalMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{

    public function deposit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'amount_deposited' => 'required',
        ]);
        $deposit = new Deposit();
        // $id = Auth::user()?->id;
        $deposit['user_id'] = auth('api')->user()->id;;
        // auth('api')->user()->id; 
        $deposit->amount_deposited = $request->input('amount_deposited');
        $deposit->save();
        $email =   auth('api')->user()->email;
        event(new Mailtransaction($email,$deposit));

        // updating balance 
        $user_id = $deposit->user_id;
        if ($user_id) {
            $user = User::where('id', '=', $user_id)->first();
            $balance = $user->balance + $deposit->amount_deposited;
            $deposit->update(['balance' => $balance]);
        }
        //    updating user balance
        $user_id = $deposit->user_id;
        if ($user_id) {
            $user = User::where('id', '=', $user_id)->first();
            // $withdrawal = Withdrawal::where('id' ,'=' ,$user_id)->first();  
            $balance = $user->balance + $deposit->amount_deposited;
            $user->update(['balance' => $balance]);
            $withdrawal = DB::table('Withdrawals')->where('id', '=', $user_id)->update(['balance' => $balance]);
            // $withdrawal->update(['balance'=>$balance]);
            return response()->json([
                // "deposit"=>$deposit,
                "user" => $user,
                "withdrawal" => $withdrawal,

            ]);
        }
        // $email = auth('api')->user()->email;
        // //    dd($email);
        // event(new Mailtransaction($email,$deposit));
    }


    public function withdrawals(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'amount_withdrawn' => 'required',
        ]);

        $withdrawal = new Withdrawal();
        $withdrawal['user_id'] = auth('api')->user()->id;
        $withdrawal->amount_withdrawn = $request->input('amount_withdrawn');
        $withdrawal->save();
        $email =   auth('api')->user()->email;
        // event(new Mailtransaction($email,$deposit));/

                //   $mail = $request->email;
                // $data = [
                //     'title' => 'Mail from ItSolutionStuff.com',
                //     'body' => 'This is for testing email using smtp.'
                // ];
         Mail::to($email)->send(new withdrawalMail($withdrawal));


        // updating balance
        $user_id = $withdrawal->user_id;
        if ($user_id) {
            $user = User::where('id', '=', $user_id)->first();
            $balance = $user->balance - $withdrawal->amount_withdrawn;
            $withdrawal->update(['balance' => $balance]);

            //  updating withdrawal
            $user_id = $withdrawal->user_id;
            if ($user_id) {
                $user = User::where('id', '=', $user_id)->first();
                $deposit = Deposit::where('id', '=', $user_id)->first();
                $balance = $user->balance - $withdrawal->amount_withdrawn;
                $user->update(['balance' => $balance]);
                $deposit = DB::table('deposits')->where('id', '=', $user_id)->update(['balance' => $balance]);
                return response()->json([
                    "withdrawal" => $withdrawal,
                    //  "deposit"=>$deposit,
                    "balance" => $user

                ]);
            }
        }
    }
}
