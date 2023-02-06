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
       
        $deposit=new Deposit();
        $deposit['user_id'] = auth('api')->user()->id; 
        $deposit->amount_deposited=$request->input('amount_deposited');
        $deposit->save();
         
        // updating balance 
        $balance =$deposit->balance +$deposit->amount_deposited;
        $deposit->update(['balance' => $balance]) ;

    //    updating user balance
        $user_id=$deposit->user_id;
           if($user_id){
            $user = User::where('id' ,'=' ,$user_id)->first(); 
            $balance=$user->balance + $deposit->amount_deposited;
            $user->update(['balance'=>$balance]);
            return response()->json([
                "deposit"=>$deposit,
                "balance"=>$user
                
            ]);
           }
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
            $balance =$withdrawal->balance - $withdrawal->amount_withdrawn;
            $withdrawal->update(['balance' => $balance]) ;
    
            //  updating withdrawal
            $user_id=$withdrawal->user_id;
            if($user_id){
             $user = User::where('id' ,'=' ,$user_id)->first(); 
             $balance=$user->balance + $withdrawal->amount_withdrawn;
             $user->update(['balance'=>$balance]);
             return response()->json([
                 "withdrawal"=>$withdrawal,
                 "balance"=>$user
                 
             ]);
                
        
            }
        }

        
}
