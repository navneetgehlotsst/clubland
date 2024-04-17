<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\{User,MembershipPlan,MembershipPlanAppend,OwnQuestion,Payment};
use Mail,Hash,File,Http,DB,Auth,Session,Stripe;
use Carbon\Carbon;
class MembershipController extends Controller
{

    public function MemberShipPlan(Request $request){
        try {
            if($request->keyword){
                $data = MembershipPlan::where('plan_name', 'like', '%' . $request->keyword . '%')->paginate(4);
            }else{
                $data = MembershipPlan::where('business_id',auth()->user()->id)->paginate(4);

            }
            return view('web.dashboard.member-ship-plan',compact('data'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");

        }
    }

    
    public function MemberShipMemberList(){
        try {
            $currentDate = Carbon::now();
            $activedata = Payment::with(['getMemeberShip' => function ($q) {
                $q->withTrashed();
            }])
            ->where('type', 'membership')
            ->where('autorenew', '1')
            ->where('expire_date', '>=', $currentDate)
            ->where('destination', Auth::user()->stripe_connect_id)
            ->orderBy('id','DESC')
            ->paginate(6);
            $inactivedata = Payment::with(['getMemeberShip' => function ($q) {
                $q->withTrashed();
            }])
            ->where('type', 'membership')
            ->where('expire_date', '<', $currentDate)
            ->where('destination', Auth::user()->stripe_connect_id)
            ->orwhere('autorenew', '0')
            ->orderBy('id','DESC')
            ->paginate(6);
            return view('web.dashboard.membership-member',compact('activedata','inactivedata'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");

        }
    }

    public function MemberShipMemberDetails(Request $request,$id){
        try {
            $currentDate = Carbon::now();
            $data = Payment::with('getMemeberShipQuestion','getmembershipGuardiansDetails')->where('id', $id)->first();
            return view('web.dashboard.membership-member-detail',compact('data','currentDate'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");

        }
    }
    public function TerminateMembershhip(Request $request){
        try {
            $currentDate = Carbon::now();
            $data = Payment::find($request->order_id);
            $data->autorenew = $request->status;
            $data->update();
            if($request->status == 0){
                return redirect()->back()->withSuccess('MembershipPlan Terminated Successfully!.');
            }else{
                return redirect()->back()->withSuccess('MembershipPlan Restore Successfully!.');
            }
        } catch (\Throwable $e) {
            dd($e);
            return back()->withInput()->withError("something went wrong");

        }
    }

    public function AddPlane(){
        try {
            return view('web.dashboard.add-plan');
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function PlanEdit($id){
        try {
            $data = MembershipPlan::where('id',$id)->where('business_id',auth()->user()->id)->first();
            $appendData = MembershipPlanAppend::where('membeship_id',$id)->get();
            $OwnQuestion = OwnQuestion::where('membeship_id',$id)->get();
            
            return view('web.dashboard.edit-plan',compact('data','appendData','OwnQuestion'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function PlanStore(Request $request){
        $data = $request->all();
        $request->validate([
            "membership-type" => "required",
            "plan_name" => "required",
            "ticket_type" => "required",
            "plan_terms" => "required",
          //  "plan_summary" => "required",
           // "term_condition" => "required",
        ]);
        if($data['discount'] >= 100) {
            return back()->withInput()->withError("Discount value is not valid. Please enter a value between 1 and 99.");
        }
        try {
            if($data['ticket_type'] == "Paid"){
                $fixedAmount = $data['price'] - ($data['price'] * ($data['discount']/100));
            }else{
                $fixedAmount = "";
            }
            $memberpaln                  = new MembershipPlan;
            $memberpaln->business_id     = auth()->user()->id;
            $memberpaln->membership_type = $data['membership-type'];
            if($data['membership-type'] == 'individual'){
                $memberpaln->maximum_people  = 0;
            }else{
                $memberpaln->maximum_people  = $data['maximum_people'] ?? '';
            }
            $memberpaln->plan_name       = $data['plan_name'];
            $memberpaln->ticket_type     = $data['ticket_type'];
            $memberpaln->price           = $data['price'] ?? '';
            $memberpaln->discount        = $data['discount'] ?? '';
            $memberpaln->fixed_amount    = $fixedAmount;
            $memberpaln->plan_terms      = $data['plan_terms'];
            $memberpaln->custome_month   = $data['custome_month'] ?? '';
            $memberpaln->sort_description    = $data['sort_description'];
            $memberpaln->plan_summary    = $data['plan_summary'];
            $memberpaln->term_condition  = $data['term_condition'];
            $memberpaln->save();
            foreach($data['benefit'] as $val){
                $memberpalnapped = new MembershipPlanAppend;
                $memberpalnapped->membeship_id = $memberpaln->id;
                $memberpalnapped->name = $val;
                $memberpalnapped->save();
            }
            if($data['own_question']){
                foreach($data['own_question'] as $val){
                    if($val){
                        $memberquestion = new OwnQuestion;
                        $memberquestion->membeship_id = $memberpaln->id;
                        $memberquestion->question = $val;
                        $memberquestion->save();
                    }
                }
            }

            return redirect()->route('member_ship')->withSuccess('MembershipPlan Added Successfully!.');
        } catch (\Throwable $e) {
            dd($e);
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function PlanUpdate(Request $request,$id){
        $data = $request->all();
        // dd($data);
        // dd($id);
        $request->validate([
            "membership-type" => "required",
            "plan_name" => "required",
            "ticket_type" => "required",
            "plan_terms" => "required",
            "sort_description" => "required",
         //   "term_condition" => "required",
        ]);
        if($data['discount'] >= 100) {
            return back()->withInput()->withError("Discount value is not valid. Please enter a value between 1 and 99.");
        }
        try {
            if($data['ticket_type'] == "Paid"){
                $fixedAmount = $data['price'] - ($data['price'] * ($data['discount']/100));
            }else{
                $fixedAmount = "";
            }
            $memberpaln                  = MembershipPlan::where('id',$id)->first();
            $memberpaln->business_id     = auth()->user()->id;
            $memberpaln->membership_type = $data['membership-type'];

            if($data['membership-type'] == 'individual'){
                $memberpaln->maximum_people  = 0;
            }else{
                $memberpaln->maximum_people  = $data['maximum_people'];
            }
            $memberpaln->plan_name       = $data['plan_name'];
            $memberpaln->ticket_type     = $data['ticket_type'];
            $memberpaln->price           = $data['price'] ?? '';
            $memberpaln->discount        = $data['discount'] ?? '';
            $memberpaln->fixed_amount    = $fixedAmount;
            $memberpaln->plan_terms      = $data['plan_terms'];
            $memberpaln->custome_month   = $data['custome_month'] ?? '';
            $memberpaln->plan_summary    = $data['plan_summary'];
            $memberpaln->sort_description    = $data['sort_description'];
            $memberpaln->term_condition  = $data['term_condition'];
            $memberpaln->save();
            MembershipPlanAppend::where('membeship_id',$id)->delete();
            foreach($data['benefit'] as $val){
                $memberpalnapped = new MembershipPlanAppend;
                $memberpalnapped->membeship_id = $memberpaln->id;
                $memberpalnapped->name = $val;
                $memberpalnapped->save();
            }
            OwnQuestion::where('membeship_id',$id)->delete();
            if($data['own_question']){
               
                foreach($data['own_question'] as $val){
                    if($val){
                        $questionuestion = new OwnQuestion;
                        $questionuestion->membeship_id = $memberpaln->id;
                        $questionuestion->question = $val;
                        $questionuestion->save();
                    }
                }
            }
            return redirect()->route('member_ship')->withSuccess('MembershipPlan Updated Successfully!.');
        } catch (\Throwable $e) {
            dd($e);
            return back()->withInput()->withError("something went wrong");
        }
    }
    
    public function PlanRemove(Request $request){
        try {
            $delete = MembershipPlan::destroy($request->plan_id);
            if ($delete == 1) {
                $message = "Plan deleted successfully.";
            } else {
                $message = "Plan not found.";
            }
        return redirect()->route('member_ship')->withSuccess($message);
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");

        }
    }
    public function PlanSearch(Request $request){
        try {
            $data = MembershipPlan::where('plan_name', 'like', '%' . $request->search . '%')->paginate(4);
            return view('web.dashboard.member-ship-plan',compact('data'));
         } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");

        }
    }
//End Facility Moduel//

}
