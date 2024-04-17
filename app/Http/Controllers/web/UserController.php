<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use Laravel\Cashier\Cashier;

use Carbon\Carbon;

use App\Mail\UserSendOtpMail;

use App\Mail\UserSendEmailVerifyLink;



use App\Models\{BusinessInfo,User,Faq,EmailOtp,ClubType};

use Auth,DB,Hash,Session,Str,Mail,Stripe,Helper;

use App\Http\Controllers\StripeTrait;



class UserController extends Controller

{

//   

  

    public function UserLogin()

    {

        try {

          $faq = Faq::orderBy('id','DESC')->get();

            return view('web.login',compact('faq'));

        } catch (\Throwable $e) {

            return back()->withInput()->withError("something went wrong");

        }

    }



    public function AuthLogin(Request $request){

      $request->validate([

          'email' => 'required|email',

          'password' => 'required',

      ]);

      try{

        $credentials = $request->only('email', 'password');

        $business = User::where('email',$request->email)->where('role','business')->first();

        if($business){

          if($business->status != 0){

            if($business->email_verified_at != null){

              if(Auth::attempt($credentials)) {

                  $checkhomesecation = Helper::checkHomeSecation();

                  if(!empty($checkhomesecation)){

                    return redirect()->route('b_dashboard')->withInput()->withSuccess("Login successfully!");

                  }else{

                    return redirect()->route('home_secation')->withInput()->withSuccess("Login successfully!");

                  }

                }

              return back()->withInput()->withError('You have entered invalid credentials!');

            }else{

              return back()->withInput()->withError('Please verify your email!');

            }

          }else{

            return back()->withInput()->withError('The business has been deactivated by the administration. For any inquiries, please reach out to the administrative team.');

          }

        }else{

          return back()->withInput()->withError('You have entered invalid credentials!');

        }

      }catch(Exception $e){

          return back()->withInput()->withError("something went wrong");

      }

  }

    public function logoutUser(Request $request)

    {

        try {

          Session::flush();

          Auth::logout();

          return redirect()->route('login_business')->withInput()->withSuccess("You have been logged out !");

        } catch (\Throwable $e) {

          return back()->withInput()->withError("something went wrong");

        }

    }



    public function Register(){

       try {

        $faq = Faq::orderBy('id','DESC')->get();

        $clubType = ClubType::where('business_id','0')->where('status','1')->get();



        return view('web.register',compact('faq','clubType'));

       } catch (\Throwable $e) {

        return back()->withInput()->withError("something went wrong");

       }

    }



    public function RemoveAccount(Request $request)

    {

        try {

          $user = User::where('id',$request->account_id)->first();

          $user->email = $request->account_id.$user->email;

          $user->update();

          Auth::logout();

          return redirect()->route('website-home')->withSuccess("Your account deleted successfully.");

        } catch (\Throwable $e) {

          return back()->withInput()->withError("something went wrong");

        }

    }

    public function RegisterStore(Request $request)

    {

      $data = $request->all();

      $this->validate($request, [

        'club_name' => 'required|string|max:100',

        'club_type' => 'required',

        'name' => 'required|string|max:100',

        'position' => 'required|string|max:100',

        'email' => 'required|email|unique:users,email',

        'phone_number' => "required|unique:users,phone_number",

        'address' => 'required',

        'terms_condition' => 'required',

        'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',

        'g-recaptcha-response' => 'required'

       ]);

        try {
            
            $token = Str::random(64);

            $user = new User;

            $user->full_name = $data['name'];

            $user->password = Hash::make($data['password']);

            $user->phone_number = $data['phone_number'];

            $user->email = $data['email'];

            $user->status = 1;

            $user->address = $data['address'];

            $user->country_code = $data['country_code'];

            $user->email_link_token = $token;

            $user->club = $data['club_name'];;

            $user->role = 'business';

            $user->save();

            if($user){

              if($data['club_type'] == 'other'){

                $clubtype = new ClubType;

                $clubtype->name = $data['new_club_type'];

                $clubtype->business_id = $user->id;

                $clubtype->save();

                $clubtypeData = $clubtype->id;

              }else{

                $clubtypeData = $data['club_type'];

              }

              $businessInfo = new BusinessInfo;

              $businessInfo->business_id = $user->id;

              $businessInfo->club_name = $data['club_name'];

              $businessInfo->club_type = $clubtypeData;

              $businessInfo->position = $data['position'];

              $businessInfo->save();

            }

            if(!is_null($user)) {

              Session::forget('register_user');

              Session::put('register_user', $user);

              $curl = new \Stripe\HttpClient\CurlClient();
              $curl->setEnablePersistentConnections(false);

              \Stripe\ApiRequestor::setHttpClient($curl);
              \Stripe\Stripe::setApiKey(env('STRIPE_KEY'));

              $stripeCustomer =  StripeTrait::createCustomer([
                'email' => $data['email'],
                'name' => $data['name'],
              ]);
  
              User::where('email', $data['email'])->update(['stripe_id' => $stripeCustomer['customer_token']]);
              $data['token'] = $token;
              $data['user_name'] = $data['name'];
              Mail::to($user->email)->send(new UserSendEmailVerifyLink($data));

              return redirect()->route('login_business')->withSuccess('Account created successfully , Please verify your email');

            }else {

              return back()->with("failed", "Registration failed. Try again.");
            }

         } catch (\Throwable $e) {
          dd($e);
          return back()->withInput()->withError("something went wrong");
        }

    }



    public function verifyAccount(Request $request,$token)

    {

      

        $verifyUser = User::where('email_link_token', $token)->first();

        

        $message = 'Your email is already verified.';

        if(!is_null($verifyUser) ){

            if(!$verifyUser->email_verified_at) {

                $verifyUser->email_verified_at = 1;

                $verifyUser->email_link_token = null;

                $verifyUser->save();

                $message = "Your e-mail is verified. You can now login.";

            } else {

                $message = "Your e-mail is already verified. You can now login.";

            }

        }

  

      return redirect()->route('login_business')->withSuccess($message);

    }



    public function PurchasePlan(){

      try {

        $userdata = Auth::user();

        $userdata->stripe_id = 1;

        $userdata->save();

        return redirect()->route('b_dashboard')->withSuccess('Plane Purchase Successfully');

      } catch (\Throwable $e) {

        return back()->withInput()->withError("something went wrong");



      }

    }

    



    public function Profile(){

      try {

        $id = auth()->user()->id;

        $data = User::with('business_info')->where('id',$id)->first();

        $category =  ClubType::where('business_id','0')->orwhere('business_id',$id)->where('status','1')->get();   

        return view('web.dashboard.profile',compact('data','category'));

      } catch (\Throwable $e) {

          return back()->withInput()->withError("something went wrong");



      }

    }



    public function EditProfile(){

      try {

        $id = auth()->user()->id;

        $data = User::with('business_info')->where('id',$id)->first();

        $category =  ClubType::where('business_id','0')->orwhere('business_id',$id)->where('status','1')->get();   

        return view('web.dashboard.edit-profile',compact('data','category'));

      } catch (\Throwable $e) {

          return back()->withInput()->withError("something went wrong");



      }

    }



    public function BusinessUpdate(Request $request){

      $data = $request->all();

      $this->validate($request, [

        'club_name' => 'required|string|max:100',

        'club_type' => 'required',

        'name' => 'required|string|max:100',

        'position' => 'required|string|max:100',

        'phone_number' => "required",

        'address' => 'required',

       ]);

      try {

          $id = auth()->user()->id;

          $data = $request->all();

          $business = User::find($id);

          $business->full_name = $data['name'];

          $business->phone_number = $data['phone_number'];

          $business->address = $data['address'];

          $business->about = $data['content'];

          $business->country_code = $data['country_code'];

        

          $business->update();

          if($business){

            if($data['club_type'] == 'other'){

              $clubtype = new ClubType;

              $clubtype->name = $data['new_club_type'];

              $clubtype->business_id = $id;

              $clubtype->save();

              $clubtypeData = $clubtype->id;

            }else{

                $clubtypeData = $data['club_type'];

            }

            $businessInfo = BusinessInfo::where('business_id',$id)->first();

            $businessInfo->business_id = $id;

            $businessInfo->club_name = $data['club_name'];

            $businessInfo->club_type = $clubtypeData;

            $businessInfo->position = $data['position'];

            $businessInfo->instagram = $data['instagram'];

            $businessInfo->facebook = $data['facebook'];

            $businessInfo->twitter = $data['twitter'];

            $businessInfo->linkedin = $data['linkedin'];

            $businessInfo->update();

          }

          return redirect()->route('b_dashboard')->withSuccess("Profile updated successfully!");



      } catch (\Throwable $e) {

        dd($e);

        return back()->withInput()->withError("something went wrong");



      }

    }



    public function ForgetPassword(){



      try {

        $faq = Faq::orderBy('id','DESC')->get();

        return view('web.forget-password',compact('faq'));



      } catch (\Throwable $e) {



       return back()->withInput()->withError("something went wrong");



      }



    }



    public function forgotPasswordSubmit(Request $request){



      $request->validate([



          'email' => 'required|email',



      ]);







      try{



          $user = User::where('email',$request->email)->where('role','business')->first();

          if (empty($user)) {

            return redirect()->back()->withError('The email address is wrong. Enter the correct email address');

    

        }

          $code = rand(1000,9999);



          $date = date('Y-m-d H:i:s');



          $currentDate = strtotime($date);



          $futureDate = $currentDate+(60*5);



          EmailOtp::where('email',$user->email)->forceDelete();



          $email_otp = new EmailOtp();



          $email_otp->email = $user->email;



          $email_otp->otp = $code;



          $email_otp->otp_expire_time = $futureDate;



          $email_otp->save();



          Mail::to($user->email)->send(new UserSendOtpMail($user, $code));



          Session::forget('forgot_user');



          Session::put('forgot_user', $user);



          return redirect()->route('verify.forgot-password.get')->withSuccess('Verification code sent successfully on your email address');



      }catch(Exception $e){



          return back()->withInput()->withError("something went wrong");



      }



    }



    public function verifyForgotPassword(){

      try {

        $faq = Faq::orderBy('id','DESC')->get();



        return view('web.forgot_password_verify',compact('faq'));

      } catch (\Throwable $e) {

        return back()->withInput()->withError("something went wrong");



      }

     



    }







    public function verifyForgotPasswordSubmit(Request $request){



        try{



            $verify_user = EmailOtp::where('otp',$request->otp)->orderBy('id','desc')->first();



            $date = date('Y-m-d H:i:s');



            $currentTime = strtotime($date);



            if($verify_user){



                if($verify_user->otp == $request->otp){



                    if($verify_user->otp_expire_time > $currentTime){



                        return redirect()->route('reset.password.gets')->withSuccess('OTP verified successfully.Please reset your password.');



                    }else{



                        return back()->withInput()->withError('Verification code expired!');



                    }



                }else{



                    return back()->withInput()->withError('Invalid verification code!');



                }



            }else{



                return back()->withInput()->withError('Invalid verification code!');



            }







        }catch(Exception $e){



            return back()->withInput()->withError("something went wrong");



        }



    }







    public function resetPassword(){

      try {

        $faq = Faq::orderBy('id','DESC')->get();

        return view('web.reset_password',compact('faq'));



      } catch (\Throwable $e) {

        return back()->withInput()->withError("something went wrong");



      }



    }







    public function resetPasswordSubmit(Request $request){



      //dd($request->all());



        $request->validate([



            'password' => 'required',



            'confirmed' => 'required|same:password',



        ]);



        try{



            $user = Session::get('forgot_user');



            if($user){



                if(Hash::check($request->password,$request->confirmed)){



                    return back()->withInput()->withError('Cannot use your old password as new password');



                }else{



                    $user->password = Hash::make($request->password);



                    $user->save();



                    Session::forget('forgot_user');



                    return redirect()->route('login_business')->withSuccess('Password reset successfully! Please Login');



                }



            }



            else{



                return back()->withInput()->withError('User not exist');



            }



        }



        catch(Exception $e){



            return back()->withInput()->withError("something went wrong");



        }



    }

    public function sendOtp(){



      try {

        $user = Session::get('register_user');



      if(!$user){



          $user = Session::get('forgot_user');



      }



      $code = rand(1000,9999);



      $date = date('Y-m-d H:i:s');



      $currentDate = strtotime($date);



      $futureDate = $currentDate+(60*5);



      EmailOtp::where('email',$user->email)->forceDelete();



      $email_otp = new EmailOtp();



      $email_otp->email = $user->email;



      $email_otp->otp = $code;



      $email_otp->otp_expire_time = $futureDate;



      $email_otp->save();



      Mail::to($user->email)->send(new UserSendOtpMail($user, $code));



      return back()->withSuccess('Verification code sent again successfully on your email address');

      } catch (\Throwable $e) {

        return back()->withInput()->withError("something went wrong");



      }

      



  }

   

}

