<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\BusinessComapnyPortalLink;

use App\Models\{User,UserReview,AboutSecation};
use Helper,Mail;
class BusinessController extends Controller
{
    public function Index(Request $request)
    {
        try {
          $user = User::whereNot('role',"admin")->orderBy('id','DESC')->get();
          return view('admin.user.index',compact('user'));
        } catch (\Throwable $e) {
            return redirect()->back()->withError($e->getMessage());

        }
    }
   
    public function Remove(Request $request){
      try {
        $delete = User::destroy($request->user_id);
        if ($delete == 1) {
            $success = true;
            $message = "User deleted successfully";
        } else {
            $success = true;
            $message = "User not found";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
      } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ]);
       
      }
    }
    public function changeStatus(Request $request)
    {
      try {
        $users = User::find($request->id);
        if (!empty($users)) {
          if($users->status == '0'){
            $status = '1';
          }else{
            $status = '0';

          }
          $users->status = $status;
          $users->save();
            return response()->json([
                'success' => true,
                'message' => "Status change successfully.",
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => "User not found",
            ]);
        }
      } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ]);
      }
    }

    public function Details(Request $request,$id){
      try {
        $data = User::where('id',$id)->first();
        $logo = AboutSecation::where('business_id',$id)->where('secation_type','header_secation')->first();
        $banner = AboutSecation::where('business_id',$id)->where('secation_type','Home_secation')->first();
        return view('admin.user.view',compact('data','logo','banner'));
      } catch (\Throwable $e) {
        return redirect()->back()->withError($e->getMessage());

      }
    }

    public function SendWelcomeUrl($id){
        try{
              $checkhomesecation= Helper::checkHomeSecation($id);
                if(!empty($checkhomesecation)){
                    $user = User::where('id',$id)->first();
                    if($user){
                      $data['user_slug'] = $user->slug;
                      $data['user_name'] = $user->full_name;
                        Mail::to($user->email)->send(new BusinessComapnyPortalLink($data));
                    }
                    return redirect()->route('business_list')->withInput()->withSuccess("Welcome message send successfully.");
                }else{
                  return redirect()->route('business_list')->withInput()->withSuccess("something went wrong");
                }
        } catch (\Throwable $e) {
        return redirect()->back()->withError($e->getMessage());

      }
    }
}
