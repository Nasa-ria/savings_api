<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use App\Models\Withdrawal;
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
            $deposits = Deposit::where('user_id' ,'=' ,$id)->get(); 
          $withdrawals = Withdrawal::where('user_id' ,'=' ,$id);
            return response()->json([
                "deposits"=>$deposits,
                "withdrawals"=>$withdrawals
                
            ]);


        }
    }
        public function profile( $id){
            $user= User:: find($id);
            if($id){
                $deposits = Deposit::where('user_id' ,'=' ,$id)->get(); 
              $withdrawals = Withdrawal::where('user_id' ,'=' ,$id)->get();
                return response()->json([
                    'user'=>$user,
                    "deposits"=>$deposits,
                    "withdrawals"=>$withdrawals
                    
                ]);
            
        }

    }

    public function searching(Request $request){
        //get the request the user is passing
        $search = $request->input('search');
        //if you get the request, search in the model 
        $users = User::  where('full_name', 'like', "%" . $search . "%" )
                 ->orwhere('email', 'like', "%" . $search . "%")
                    ->get();
        if($users->count() > 0){
            return $users;
        }else{ 
            return response()->json([
                "message" => "No results found"
            ]);
        }
    }

        
}
