<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function deposit(Request $request){
        // dd($request->all());
        $request->validate([
            'amount_deposited' => 'required',           
        ]);
        // $user = User::find($id)->get();
        //  dd($user);
        $deposit=new Deposit();
        // $deposit->user_id=$id;
        $deposit->amount_deposited=$request->input('amount_deposited');
        // dd($deposit);
        $deposit->save();
        return $deposit;

        // $user = User::find($request->user_id);
        // $balance =$user->balance+$request->amount_depoisted;
        // $balance->update(['balnce'=>$balance]);
        // $user->update(['balnce'=>$balance]);


    }
}
