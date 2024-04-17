<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use App\Models\{User,InquiryRequest,ContactUs};
use Helper,DB;
class HomeController extends Controller
{
    public function index(Request $request)
    {
        try {
          $monthlyActiveUsers = [];
          $monthlyInactiveUsers = [];
                for($month=0;$month<12;$month++){
                    $monthStartDateTimeChart = date("Y-m-01 00:00:00",strtotime("-".$month." months"));
                    $monthEndDateTimeChart = date("Y-m-t 23:59:59",strtotime("-".$month." months"));
                    $monthlyUsersApp = User::where('role','business')->where('status','1')->whereBetween('created_at',[$monthStartDateTimeChart,$monthEndDateTimeChart])->count();
                    $monthlyActiveUsers[$month]['month'] =   date("M",strtotime("-".$month." months"));
                    $monthlyActiveUsers[$month]['users'] =   $monthlyUsersApp;
                }
                $monthlyActiveUsers   =   array_reverse($monthlyActiveUsers);
                for($month=0;$month<12;$month++){
                  $monthStartDateTimeChart = date("Y-m-01 00:00:00",strtotime("-".$month." months"));
                  $monthEndDateTimeChart = date("Y-m-t 23:59:59",strtotime("-".$month." months"));
                  $monthlyUsersApp = User::where('role','business')->where('status','0')->whereBetween('created_at',[$monthStartDateTimeChart,$monthEndDateTimeChart])->count();
                  $monthlyInactiveUsers[$month]['month'] =   date("M",strtotime("-".$month." months"));
                  $monthlyInactiveUsers[$month]['users'] =   $monthlyUsersApp;
              }
              $monthlyInactiveUsers   =   array_reverse($monthlyInactiveUsers);
            
          return view('admin.dashboard',compact('monthlyActiveUsers','monthlyInactiveUsers'));
        } catch (\Throwable $e) {
          return redirect()->back()->withError($e->getMessage());

        }
    }

    public function InquiryList(){
      try {
        $data = InquiryRequest::get();
          return view('admin.inquery.index',compact('data'));
      } catch (\Throwable $e) {
        return redirect()->back()->withError($e->getMessage());
      }
    }

    public function Delete(Request $request){
      try {
        $delete = InquiryRequest::destroy($request->id);
        if ($delete == 1) {
            $success = true;
            $message = "Inquiry deleted successfully";
        } else {
            $success = true;
            $message = "Inquiry not found";
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

    public function ContactUsList(){
      try {
        $data = ContactUs::get();
          return view('admin.contactUs.index',compact('data'));
      } catch (\Throwable $e) {
        return redirect()->back()->withError($e->getMessage());
      }
    }

    public function ContactUsDelete(Request $request){
      try {
        $delete = ContactUs::destroy($request->id);
        if ($delete == 1) {
            $success = true;
            $message = "ContactUs deleted successfully";
        } else {
            $success = true;
            $message = "ContactUs not found";
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
    
}
