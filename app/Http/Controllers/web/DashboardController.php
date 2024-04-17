<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\{User,Faq,InquiryRequest,HeaderSecation,FooterAddressSecation,FooterSecation,Product,EventReminder,
EventCategory,Event,EventAppend,Color,ProductImage,EventImage,HeaderSecationAppend,Facility,HomeSecation,AboutSecation,AboutContent};
use Mail,Hash,File,Http,DB,Auth,Session,Stripe;
use Carbon\Carbon;
class DashboardController extends Controller
{
    
    public function ChangePassword(){
        try {
          return view('web.dashboard.change-password');
        } catch (\Throwable $e) {
          return back()->withInput()->withError("something went wrong");
        }
    }

    public function updatePassword(Request $request)
    {
        $data = $request->all();
        $request->validate([
            "old_password" => "required",
            "password" => "required|confirmed|min:8",
        ]);
        try{
            $userdata = User::where('id',auth()->user()->id)->first();
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

    
    public function AddReminder(Request $request){
        $data = $request->all();
        $request->validate([
            "ename"        => "required",
            "e_start_date" => "required",
            "e_end_date"   => "required",
            "edesc"        => "required",
        ]); 

        try {
            $datestart=date_create($data['e_start_date']);
            $start = date_format($datestart,"Y-m-d H:i");
            $dateend=date_create($data['e_end_date']);
            $end =date_format($dateend,"Y-m-d H:i");
            $eventreminder                    = new EventReminder;
            $eventreminder->business_id       = auth()->user()->id;
            $eventreminder->event_name        = $data['ename'];
            $eventreminder->event_start_date  = $start;
            $eventreminder->event_end_date    = $end;
            $eventreminder->event_description = $data['edesc'];
            $eventreminder->save();
            return redirect()->back()->withSuccess('Reminders added  successfully!.');
        } catch (\Throwable $e) {
            dd($e);
             return back()->withInput()->withError("something went wrong");
        }
    }

    public function GetReminder(Request $request){
        $data = $request->all();
        try {
            $data = EventReminder::where('id',$data['reminderId'])->first();
            return response()->json([
                'success' => 'success',
                'data' => $data,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'something went wrong',
            ]);
        }
    }

    public function UpdateReminder(Request $request){
        $data = $request->all();
        $request->validate([
            "ename"        => "required",
            "e_start_date" => "required",
            "e_end_date"   => "required",
            "edesc"        => "required",
        ]); 

        try {
            $datestart=date_create($data['e_start_date']);
            $start = date_format($datestart,"Y-m-d H:i");
            $dateend=date_create($data['e_end_date']);
            $end =date_format($dateend,"Y-m-d H:i");
            $eventreminder                    = EventReminder::where('id',$data['id'])->first();
            $eventreminder->business_id       = auth()->user()->id;
            $eventreminder->event_name        = $data['ename'];
            $eventreminder->event_start_date  = $start;
            $eventreminder->event_end_date    = $end;
            $eventreminder->event_description = $data['edesc'];
            $eventreminder->update();
            return redirect()->back()->withSuccess('Reminders updated  successfully!.');
        } catch (\Throwable $e) {
             return back()->withInput()->withError("something went wrong");
        }
    }

}
