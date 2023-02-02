<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function deposit(Request $request){
        // dd($request->all());
        $request->validate([
            'amount_deposited' => 'required',           
        ]);
       
        //  dd($user);
        $deposit=new Deposit();
        $deposit['user_id'] = auth('api')->user()->id; 
        $deposit->amount_deposited=$request->input('amount_deposited');
        // dd($deposit);
        $deposit->save();

        $balance =$deposit->balance +$deposit->amount_deposited;
        $deposit->update(['balance' => $balance]) ;

        $user = auth()->user();
        $balance =$user->balance +$deposit->amount_deposited;
        // $user->update(['balance'=>$balance]);
                //    dd($balance);
          return $deposit;
    }
        public function withdrawals(Request $request){
            // dd($request->all());
            $request->validate([
                'amount_withdrawn' => 'required',           
            ]);

            $withdrawal=new Withdrawal();
            $withdrawal['user_id'] = auth('api')->user()->id; 
            $withdrawal->amount_withdrawn=$request->input('amount_withdrawn');
            $withdrawal->save();
            
            // updating balance
            $balance =$withdrawal->balance +$withdrawal->amount_withdrawn;
            $withdrawal->update(['balance' => $balance]) ;
    
            // $user = auth()->user();
            // $balance =$user->balance +$withdrawl->amount_deposited;
            // // $user->update(['balance'=>$balance]);
            //         //    dd($balance);
            return $withdrawal;
        }
}
