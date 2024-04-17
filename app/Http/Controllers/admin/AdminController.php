<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use App\Models\{User};
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;
class AdminController extends Controller
{

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        try {
            if(auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
                $user = auth()->guard('admin')->user();
                if($user->role == "admin"){
                    return redirect()->route('dashboard')->withInput()->withSuccess('You are Logged in sucessfully');
                }
                return redirect('/admin')->withInput()->withError('Whoops! invalid email and password.');

            }else {
                return redirect('/admin')->withInput()->withError('Oops! invalid email and password.');

            } //code...
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
    }

    public function Logout(Request $request)
    {
        try {
            auth()->guard('admin')->logout();
            return redirect('/admin')->withInput()->withError('You are logout sucessfully');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
    }

    public function EditProfile(){
        try {
            $user = auth()->guard('admin')->user();
            $data = User::where('id',$user->id)->first();
            return view('admin.profile.edit',compact('data'));
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
    }

    public function UpdateProfile(Request $request){
      //  dd($request->all());
        $user = auth()->guard('admin')->user();
        $id = $user->id;
        $data = $request->all();
        $user = User::find($id);
        $user->full_name    = $request->name;
        $user->address      = $request->address;
        $user->phone_number = $request->phone_number;
        $user->save();
        return redirect()->back()->withInput()->withSuccess('Account details saved.');
    }

    public function ChangePassword(){
        try {
            $user = auth()->guard('admin')->user();
            $data = User::where('id',$user->id)->first();
            return view('admin.profile.change_password',compact('data'));
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->withError($e->getMessage());


        }
    }

    public function UpdatePassword(Request $request){
        $data = $request->all();
        $request->validate([
            "old_password" => "required",
            "password" => "required|confirmed|min:8",
        ]);
        try{
            $user = auth()->guard('admin')->user();
            $userdata = User::where('id',$user->id)->first();
            if (Hash::check($request->old_password, $userdata->password)) {
                $password = Hash::make($request->password);
                if($request->password == $request->password_confirmation){
                    $user = User::find($userdata->id);
                    $user->password = $password;
                    $user->update();
                    return redirect()->back()->withInput()->withSuccess('Password changed successfully.');
                }else{
                    return redirect()->back()->withInput()->withError('New password and confirm password does not match.');
                }
            }else{
                return redirect()->back()->withInput()->withError('Old password is invalid.');
            }
           
        }catch(Exception $e){
             return back()->withInput()->withError("something went wrong");
        }

    }


}
