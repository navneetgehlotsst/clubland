<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\StripeTrait;
use Helper,Mail,Str;
use DB;
use Carbon\Carbon;
class AuthController extends Controller
{
    public function password_email(Request $request)
    {
      $request->validate([
        'email' => 'required|email',
      ]);
      $user = User::where('email',$request->email)->where('role','admin')->first();
      if (empty($user)) {
          return redirect()->back()->with('error','The email address is wrong. Enter the correct email address');

      }
        try {
          $token = Str::random(64);
          DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);
          Mail::send('emails.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
          });
          return redirect()->back()->with('success','We have e-mailed your password reset link!');
        } catch (\Throwable $e) {
          return redirect()->back()->withInput()->withError($e->getMessage());

        }
         
    }

    public function showResetPasswordForm($token)
    {
        $email = DB::table('password_resets')->where(['token' => $token])->first();
        return view('auth.confirm-password', ['token' => $token,'email' =>$email]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
              'email' => 'required|email|exists:users',
                      'password' => 'required|string|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',

              'password_confirmation' => 'required'
          ],[
             'password' =>  'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
        ]);
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();
          if(!$updatePassword){
            return redirect()->back()->withInput()->withSuccess("Invalid token!");

          }
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();
          return redirect()->back()->withInput()->withSuccess("Your password has been changed!");
    }



}