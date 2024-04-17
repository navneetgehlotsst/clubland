<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\UserSendMail;
use Auth,DB,Hash,Session,Str,Mail;
use Carbon\Carbon;

use App\Models\{User,Faq,InquiryRequest,Page,ContactUs,Payment,Notification,MailchimpKey};
class FrontController extends Controller
{
    public function index(){
        try {
           // return view('landing');

            $faq = Faq::orderBy('id','DESC')->get();
            return view('web.home-secation',compact('faq'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function BusinessDashboard(Request $request){
        try {

            if($request->filter == 'week'){
                $membership = Payment::where('type','membership')->where('destination',Auth::user()->stripe_connect_id)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->count();
                $event = Payment::where('type','event')->where('destination',Auth::user()->stripe_connect_id)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->count();
                $product = Payment::where('type','product')->where('destination',Auth::user()->stripe_connect_id)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->count();
                
                $reneue = Payment::where('destination',Auth::user()->stripe_connect_id)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->sum('destination_amount');
                return view('web.dashboard.dashboard',compact('membership','event','reneue','product'));
            }elseif ($request->filter == 'month') {
                $membership =Payment::where('type','membership')->where('destination',Auth::user()->stripe_connect_id)->whereMonth('created_at', Carbon::now()->month)->count();
                $event = Payment::where('type','event')->where('destination',Auth::user()->stripe_connect_id)->whereMonth('created_at', Carbon::now()->month)->count();
                $product = Payment::where('type','product')->where('destination',Auth::user()->stripe_connect_id)->whereMonth('created_at', Carbon::now()->month)->count();
                
                $reneue = Payment::where('destination',Auth::user()->stripe_connect_id)->whereMonth('created_at', Carbon::now()->month)->sum('destination_amount');
                return view('web.dashboard.dashboard',compact('membership','event','reneue','product'));
            }elseif ($request->filter == 'year') {
                $membership =Payment::where('type','membership')->where('destination',Auth::user()->stripe_connect_id)->whereBetween('created_at', [
                    Carbon::now()->startOfYear(),
                    Carbon::now()->endOfYear(),
                ])->count();
                $event = Payment::where('type','event')->where('destination',Auth::user()->stripe_connect_id)->whereBetween('created_at', [
                    Carbon::now()->startOfYear(),
                    Carbon::now()->endOfYear(),
                ])->count();
                $product = Payment::where('type','product')->where('destination',Auth::user()->stripe_connect_id)->whereBetween('created_at', [
                    Carbon::now()->startOfYear(),
                    Carbon::now()->endOfYear(),
                ])->count();

                $reneue = Payment::where('destination',Auth::user()->stripe_connect_id)->whereBetween('created_at', [
                    Carbon::now()->startOfYear(),
                    Carbon::now()->endOfYear(),
                ])->sum('destination_amount');
                return view('web.dashboard.dashboard',compact('membership','event','reneue','product'));
            }else{
                $membership =Payment::where('type','membership')->where('destination',Auth::user()->stripe_connect_id)->count();
                $event = Payment::where('type','event')->where('destination',Auth::user()->stripe_connect_id)->count();
                $product = Payment::where('type','product')->where('destination',Auth::user()->stripe_connect_id)->count();
                $reneue = Payment::where('destination',Auth::user()->stripe_connect_id)->sum('destination_amount');
                return view('web.dashboard.dashboard',compact('membership','event','reneue','product'));
            }
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    

    public function PlanSubscription(){
        try {
            $faq = Faq::orderBy('id','DESC')->get();
            return view('web.plan-subscription-list',compact('faq'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function AboutUs(){
        try {
            $faq = Faq::orderBy('id','DESC')->get();
            return view('web.about-us',compact('faq'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function HowItWork(){
        try {
            $faq = Faq::orderBy('id','DESC')->get();
            return view('web.how-itwork',compact('faq'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }
    
    public function InquiryStore(Request $request){
        try {
            $data = new InquiryRequest;
            $data->email =  $request->email;
            $data->name =  $request->name;
            $data->content =  $request->content;
            $data->save();
            return redirect()->back()->withSuccess('Your request send successfully.');

        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function landingInquiryStore(Request $request){
        try {
            $data = new InquiryRequest;
            $data->email =  $request->email;
            $data->name =  $request->name;
            $data->phone_number =  $request->content;
            $data->save();
            $getdata = InquiryRequest::where('id',$data->id)->first();
            $email = "info@clublandservices.com";
            Mail::to($email)->send(new UserSendMail($getdata));

            return redirect()->back()->withSuccess('Your request send successfully.');

        } catch (\Throwable $e) {

            return back()->withError($e->getMessage());
        }
    }

    public function TermCondition($slug)
    {
        try{
            $page = Page::where('template', $slug)->first();

            return view('web.cms-pages', compact('page'));
        }catch(Exception $e){
            return back()->withInput()->withError("something went wrong");
        }

    }

    public function ContactUs(){
        try {
            return view('web.contact-us');

        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function ContactUsStore(Request $request){
        $request->validate([
            'name' => 'required', 
            'email' => 'required|email', 
            'content' => 'required|string|min:10',
            'g-recaptcha-response' => 'required'
        ]);

        try {
            $data               = new ContactUs;
            $data->name         =  $request->name;
            $data->email        =  $request->email;
            $data->description  =  $request->content;
            $data->save();
            return redirect()->back()->withSuccess('Your contact request send successfully.');
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function notificationRead(Request $request)
    {
        Notification::where('id',$request->id)->update(array('read_at'=>'1'));
        return response()->json(['success' => true]);
    }

    public function allnotificationRead(Request $request)
    {
        Notification::where('target_id',Auth::user()->id)->update(array('read_at'=>'1'));
        $notification = Notification::where('target_id',auth()->user()->id)->orderBy('id','DESC')->paginate(7);
        return view('web.dashboard.notification-list',compact('notification'));
    }
    
    
    public function TransactionHistory(Request $request){
        try {
            $data = Payment::select('*')->where('destination',Auth::user()->stripe_connect_id)->where('charge_id','!=','')->paginate();
            return view('web.dashboard.transaction-history',compact('data'));
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function MailchimpEdit(Request $request){
        try {
            $data = MailchimpKey::where('business_id',Auth::user()->id)->first();
            return view('web.dashboard.mailchimp-edit',compact('data'));
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function MailchimpUpdate(Request $request){

        $request->validate([
            'key' => 'required',
            'audience_id' => 'required',
        ]);
        $prifixed = strrpos($request->key, '-'); // Find the position of the last occurrence of '-'
        if($prifixed != true){
            $prifixed_value = '';
        }else{
            $prifixed_value = substr($request->key, $prifixed + 1);
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://'.$prifixed_value.'.api.mailchimp.com/3.0/lists/'.$request->audience_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$request->key
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        if (isset($data['status']) && ($data['status'] == 401 || $data['status'] == 404) || is_null($data)) {
            return back()->withInput()->withError('Mailchimp API Key or Audience ID is incorrect.');

        }else{
            try {
            
            
                $data = MailchimpKey::where('business_id',Auth::user()->id)->first();
                if($data){
                    $data->key = $request->key;
                    $data->audience_id = $request->audience_id;
                    $data->prifixed_value = $prifixed_value;
                    $data->update();
    
                }else{
                      $mailchimp = new MailchimpKey;
                      $mailchimp->business_id = Auth::user()->id;
                      $mailchimp->key = $request->key;
                      $mailchimp->audience_id = $request->audience_id;
                      $mailchimp->prifixed_value = $prifixed_value;
    
                      $mailchimp->save();
                }
                return redirect()->back()->withSuccess('Mailchimp key generated successfully.');
            } catch (\Throwable $th) {
                dd($th);
                return back()->withInput()->withError("something went wrong");
            }
        }
        
    }
}
