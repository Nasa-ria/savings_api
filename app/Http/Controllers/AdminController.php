<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Users(){
        $users=  User::all();
         $id = $users->id;
        // fetching deposit history
        $deposit =Deposit::where('user_id', '=', $id)->get(); 


         return response()->json([
            "users"=>$users,
            "deposit"=>$deposit
         ]);
    }

        
}
