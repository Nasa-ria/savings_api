<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Users(){
        $users=  User::all();
         return response()->json([
            "users"=>$users,
         ]);
    }

    public function tansactions(Request $request, $id){
        $user = User::find($id);
        if($id){
            $deposit = Deposit::where('user_id' ,'=' ,$id)->get(); 
          $balance =$deposit->balance; 
            // $user->update(['balance'=>$balance]);
            //            dd($balance);
            return response()->json([
                "deposit"=>$deposit,
                
            ]);


        }

    }
        
}
