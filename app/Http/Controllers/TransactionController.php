<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Events\Mailtransaction;
use Illuminate\Support\Facades\DB;

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
        $email= auth('api')->user()->email;
        //    dd($email);
           event(new Mailtransaction($email));

        // updating balance 
        $user_id=$deposit->user_id;
           if($user_id){
            $user = User::where('id' ,'=' ,$user_id)->first();
        $balance =$user->balance +$deposit->amount_deposited;
        $deposit->update(['balance' => $balance]) ;
           }
    //    updating user balance
        $user_id=$deposit->user_id;
           if($user_id){
            $user = User::where('id' ,'=' ,$user_id)->first();
            // $withdrawal = Withdrawal::where('id' ,'=' ,$user_id)->first();  
            $balance=$user->balance + $deposit->amount_deposited;
            $user->update(['balance'=>$balance]);
            $withdrawal= DB::table('Withdrawals')->where('id' ,'=' ,$user_id)->update(['balance'=>$balance]);
            // $withdrawal->update(['balance'=>$balance]);
            return response()->json([
                // "deposit"=>$deposit,
                "user"=>$user,
                "withdrawal"=>$withdrawal,
                
            ]);
           }
           $email= auth('api')->user()->email;
        //    dd($email);
           event(new Mailtransaction($email));

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
            $user_id=$withdrawal->user_id;
            if($user_id){
             $user = User::where('id' ,'=' ,$user_id)->first();
            $balance =$user->balance - $withdrawal->amount_withdrawn;
            $withdrawal->update(['balance' => $balance]) ;
    
            //  updating withdrawal
            $user_id=$withdrawal->user_id;
            if($user_id){
             $user = User::where('id' ,'=' ,$user_id)->first(); 
             $deposit = Deposit::where('id' ,'=' ,$user_id)->first(); 
             $balance=$user->balance - $withdrawal->amount_withdrawn;
             $user->update(['balance'=>$balance]);
             $deposit->update(['balance'=>$balance]);
             return response()->json([
                 "withdrawal"=>$withdrawal,
                //  "deposit"=>$deposit,
                 "balance"=>$user
                 
             ]);
                
        
            }
        }

        
}
}