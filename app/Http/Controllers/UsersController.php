<?php

namespace App\Http\Controllers;

use App\Mail\savingMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //    dd($request->all());
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
           
        ]);
        $user= new User();
        $user-> full_name  = $request->input('full_name');
        $user-> email  = $request->input('email');
        $user-> password    =  Hash::make($request->password);
         $user->save();
         $token = $user->createToken("USERS");
         $accessToken = $token->accessToken;

                 $mail = $request->email;
                // $data = [
                //     'title' => 'Mail from ItSolutionStuff.com',
                //     'body' => 'This is for testing email using smtp.'
                // ];
        $mail= Mail::to($mail)->send(new savingMail($user));

        /**
         * Check if the email has been sent successfully, or not.
         * Return the appropriate message.
         */
            // if($mail){
            return response()->json([
                'data' => $user->refresh(),
                'token' => $accessToken,
                // "Email has been sent successfully."
            ]);
        }
        // return "Oops! There was some error sending the email.";
        //   }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User:: find($id);
        $user->address= $request->get('address');
        $user->contact= $request->get('contact');
        $user->subscription= $request->get('subscription');
        $user->next_of_kin_fullname= $request->get('next_of_kin_fullname');
        $user->next_of_kin_address= $request->get('next_of_kin_address');
        $user->next_of_kin_contact= $request->get('next_of_kin_contact'); 
        $user->save();
      return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        User::where('id', '=', $user)->delete();
        // $user->destroy();
    }

    public function SignIn(Request $request )
    { 
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return"login successfully";
            }
             return "fail";
    }



    public function Signout() {
        Session::flush();
        Auth::logout();
    
        return 'logout';
    }

      

    public function changePassword(Request $request  )
{     
        $user= auth('api')->user();
        // $password = $user->password;
        // dd($password);

            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required'
            ]);
              if($user && Hash::check($request->old_password, $user->password)){
                if($request->new_password == $request->confirm_password){
                #Update the new Password
                    User::whereId($user->id)->update([
                    'password' => Hash::make($request->new_password) ]);
                     return "password change successfully";
                 }
                    return " password mismatch";
                 }
                return " error:Old Password Doesn't match!";
            }

    }




