<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use App\Models\{User,Faq,InquiryRequest,HeaderSecation,FooterAddressSecation,FooterSecation,Product,
EventCategory,Event,EventAppend,Color,ProductImage,EventImage,HeaderSecationAppend,Facility,MembershipPlan,HomeSecation,AboutSecation,AboutContent};
use Mail,Hash,File,Http,DB,Auth,Session,Stripe;
use Carbon\Carbon;
class AllSecationController extends Controller
{

//Start HomeSecation Moduel//

    public function HomeSecation(){
        try {
            $product    = Product::where('business_id',auth()->user()->id)->get();
            $event      = Event::where('business_id',auth()->user()->id)->get();
            $facility   = Facility::where('business_id',auth()->user()->id)->get();
            $membership = MembershipPlan::where('business_id',auth()->user()->id)->get();
            $data       = HomeSecation::where('business_id',auth()->user()->id)->get();
            $about      = AboutSecation::where('business_id',auth()->user()->id)->where('secation_type','Home_secation')->first();
            return view('web.dashboard.home-secation',compact('product','event','facility','data','about','membership'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError($e->getMessage());
        }
    }

    public function HomeSecationStore(Request $request){
        $data = $request->all();
        // $request->validate([
        //     'product_order' => [
        //         'required',Rule::unique('home_secations', 'order')->where('business_id',auth()->user()->id),
        //     ],
        //     'event_order' => [
        //         'required',Rule::unique('home_secations', 'order')->where('business_id',auth()->user()->id),
        //     ],
        //     'facility_order' => [
        //         'required',Rule::unique('home_secations', 'order')->where('business_id',auth()->user()->id),
        //     ],
        // ]);
            
       
        try {
            $data = $request->all();
            if(!empty($data['product_status']) && isset($data['product_status'])){
                $product_status = '1';
            }else{
                $product_status = '0';
            }
            
                $productdata                = new HomeSecation;
                $productdata->secation_type = $data["product_secation"];
                $productdata->business_id   = auth()->user()->id;
                $productdata->type          = $data["product_type"];
                $productdata->status        = $product_status;
                $productdata->order         = $data["product_order"];
                if($data["product_type"]=='1'){
                $productdata->seaction_product_id = json_encode($data["product_id"]);
                }
                $productdata->save();
                if(!empty($data['event_status']) && isset($data['event_status'])){
                    $event_status = '1';
                }else{
                    $event_status = '0';
                }
                
                $tdata                = new HomeSecation;
                $tdata->secation_type = $data["event_secation"];
                $tdata->business_id   = auth()->user()->id;
                $tdata->type          = $data["event_type"];
                $tdata->status        = $event_status;
                $tdata->order         = $data["event_order"];
                if($data["event_type"]=='1'){
                $tdata->seaction_product_id = json_encode($data["event_id"]);
                }
                $tdata->save();

                if(!empty($data['facility_status']) && isset($data['facility_status'])){
                    $facility_status = '1';
                }else{
                    $facility_status = '0';
                }
                $facilitydata                = new HomeSecation;
                $facilitydata->secation_type = $data["facility_secation"];
                $facilitydata->business_id   = auth()->user()->id;
                $facilitydata->type          = $data["facility_type"];
                $facilitydata->status        = $facility_status;
                $facilitydata->order         = $data["facility_order"];
                if($data["facility_type"]=='1'){
                    $facilitydata->seaction_product_id = json_encode($data["facility_id"]);
                }
                $facilitydata->save();

                if(!empty($data['membership_status']) && isset($data['membership_status'])){
                    $membership_status = '1';
                }else{
                    $membership_status = '0';
                }
                $membershipdata                = new HomeSecation;
                $membershipdata->secation_type = $data["membership_secation"];
                $membershipdata->business_id   = auth()->user()->id;
                $membershipdata->type          = $data["membership_type"];
                $membershipdata->status        = $membership_status;
                $membershipdata->order         = $data["membership_order"];
                if($data["membership_type"]=='1'){
                    $membershipdata->seaction_product_id = json_encode($data["membership_id"]);
                }
                $membershipdata->save();



                if(!empty($data["about_status"]) && isset($data["about_status"])){
                    $about_status = '1';
                }else{
                    $about_status = '0';
                }
                $aboutdata = new AboutSecation;
                $aboutdata->business_id       = auth()->user()->id;
                $aboutdata->secation_type     = "Home_secation";
                $aboutdata->image_hide_show   = $data["about_Image_status"];
                $aboutdata->image_left_right  = $data["about_Image_side"];

                if($data["about_Image_status"] == "1"){
                    if ($request->file('about_image')) {
                        $file = $request->file('about_image');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time(). '.' . $extension;
                        $file->move('aboutSecation/', $filename);
                        $aboutdata->about_image    = $filename;
                    }
                }
                if ($request->file('banner_image')) {
                    $file = $request->file('banner_image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('homeSecation/', $filename);
                    $aboutdata->home_image    = $filename;
                  }
                $aboutdata->description       = $data["about_description"];
                $aboutdata->status            = $about_status;
                $aboutdata->save();
                if(auth()->user()->stripe_account_status == 'active'){
                    $data['user_slug'] = auth()->user()->slug;
                    Mail::to(auth()->user()->email)->send(new BusinessComapnyPortalLink($data));
                }
            return redirect()->route('home_secation')->withSuccess('HomeSeaction Add Successfully!.');
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }


    public function HomeSecationUpdate(Request $request){
        $data = $request->all();
            // $request->validate([
            //     'product_order' => [
            //         'required',Rule::unique('home_secations', 'order')->where('business_id',auth()->user()->id),
            //     ],
            //     'event_order' => [
            //         'required',Rule::unique('home_secations', 'order')->where('business_id',auth()->user()->id),
            //     ],
            //     'facility_order' => [
            //         'required',Rule::unique('home_secations', 'order')->where('business_id',auth()->user()->id),
            //     ],
            // ]);
        try {
            HomeSecation::where('business_id',auth()->user()->id)->delete();
            if(!empty($data['product_status']) && isset($data['product_status'])){
                $product_status = '1';
            }else{
                $product_status = '0';
            }
                $productdata                = new HomeSecation;
                $productdata->secation_type = $data["product_secation"];
                $productdata->business_id   = auth()->user()->id;
                $productdata->type          = $data["product_type"];
                $productdata->status        = $product_status;
                $productdata->order         = $data["product_order"];
                if($data["product_type"]=='1'){
                $productdata->seaction_product_id = json_encode($data["product_id"]);
                }
                $productdata->save();
                if(!empty($data['event_status']) && isset($data['event_status'])){
                    $event_status = '1';
                }else{
                    $event_status = '0';
                }
                $tdata                = new HomeSecation;
                $tdata->secation_type = $data["event_secation"];
                $tdata->business_id   = auth()->user()->id;
                $tdata->type          = $data["event_type"];
                $tdata->status        = $event_status;
                $tdata->order         = $data["event_order"];
                if($data["event_type"]=='1'){
                $tdata->seaction_product_id = json_encode($data["event_id"]);
                }
                $tdata->save();
                if(!empty($data['facility_status']) && isset($data['facility_status'])){
                    $facility_status = '1';
                }else{
                    $facility_status = '0';
                }
                $facilitydata                = new HomeSecation;
                $facilitydata->secation_type = $data["facility_secation"];
                $facilitydata->business_id   = auth()->user()->id;
                $facilitydata->type          = $data["facility_type"];
                $facilitydata->status        = $facility_status;
                $facilitydata->order         = $data["facility_order"];
                if($data["facility_type"]=='1'){
                    $facilitydata->seaction_product_id = json_encode($data["facility_id"]);
                }
                $facilitydata->save();

                if(!empty($data["about_status"]) && isset($data["about_status"])){
                    $about_status = '1';
                }else{
                    $about_status = '0';
                }

                if(!empty($data['membership_status']) && isset($data['membership_status'])){
                    $membership_status = '1';
                }else{
                    $membership_status = '0';
                }
                $membershipdata                = new HomeSecation;
                $membershipdata->secation_type = $data["membership_secation"];
                $membershipdata->business_id   = auth()->user()->id;
                $membershipdata->type          = $data["membership_type"];
                $membershipdata->status        = $membership_status;
                $membershipdata->order         = $data["membership_order"];
                if($data["membership_type"]=='1'){
                    $membershipdata->seaction_product_id = json_encode($data["membership_id"]);
                }
                $membershipdata->save();
                
                $aboutdata = AboutSecation::where('secation_type','Home_secation')->where('business_id',auth()->user()->id)->first();
                $aboutdata->business_id       = auth()->user()->id;
                $aboutdata->secation_type     = "Home_secation";
                $aboutdata->image_hide_show   = $data["about_Image_status"];
                $aboutdata->image_left_right  = $data["about_Image_side"];

                if($data["about_Image_status"] == "1"){
                    if ($request->file('about_image')) {
                        $file = $request->file('about_image');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time(). '.' . $extension;
                        $file->move('aboutSecation/', $filename);
                        $aboutdata->about_image    = $filename;
                    }
                }
                // if($request->file('profile_image')){
                  if ($request->file('banner_image')) {
                    $file = $request->file('banner_image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('homeSecation/', $filename);
                    $aboutdata->home_image    = $filename;
                  }
                  
                $aboutdata->description       = $data["about_description"];
                $aboutdata->status            = $about_status;
                $aboutdata->update();
            return redirect()->route('home_secation')->withSuccess('HomeSeaction Updated Successfully!.');
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    
//End HomeSecation Moduel//

//Start AboutSecation Moduel//

    public function AboutSecation(){
        try {
            $data= AboutSecation::where('business_id',auth()->user()->id)->where('secation_type','About_secation')->first();
            // dd($data);
            $aboutcontent = AboutContent::where('business_id',auth()->user()->id)->first();
            
            return view('web.dashboard.about-secation',compact('data','aboutcontent'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function AboutSecationStore(Request $request){
        try {
            
                $data = $request->all();
                if(!empty($data['about_status']) && isset($data['about_status'])){
                    $about_status = '1';
                }else{
                    $about_status = '0';
                }
                $aboutdata = new AboutSecation;
                $aboutdata->business_id       = auth()->user()->id;
                $aboutdata->secation_type     = "About_secation";
                $aboutdata->image_hide_show   = $data["about_Image_status"];
                    if($data["about_Image_status"] == "1"){
                        $aboutdata->image_left_right  = $data["about_Image_side"];
                        if ($request->file('about_image')) {
                            $file = $request->file('about_image');
                            $extension = $file->getClientOriginalExtension();
                            $filename = time(). '.' . $extension;
                            $file->move('aboutSecation/', $filename);
                            $aboutdata->about_image    = $filename;
                        }
                    }
                    if ($request->file('about_banner')) {
                        $file = $request->file('about_banner');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time(). '.' . $extension;
                        $file->move('AboutBannerImage/', $filename);
                        $aboutdata->home_image    = $filename;
                    }
                $aboutdata->description       = $data["about_description"];
                $aboutdata->status            = $about_status;
                $aboutdata->save();
                
                if(!empty($data['we_secation_status']) && isset($data['we_secation_status'])){
                    $we_secation_status = '1';
                }else{
                    $we_secation_status = '0';
                }
                if(!empty($data['our_secation_status']) && isset($data['our_secation_status'])){
                    $our_secation_status = '1';
                }else{
                    $our_secation_status = '0';
                }
                if(!empty($data['mis_secation_status']) && isset($data['mis_secation_status'])){
                    $mis_secation_status = '1';
                }else{
                    $mis_secation_status = '0';
                }
                    $aboutcontent                           = new AboutContent;
                    $aboutcontent->business_id              = auth()->user()->id;
                    $aboutcontent->we_secation_title        = $data["we_secation_title"];
                    $aboutcontent->we_secation_description  = $data["we_secation_description"];
                    $aboutcontent->we_secation_status       = $we_secation_status;
                    $aboutcontent->our_secation_title       = $data["our_secation_title"];
                    $aboutcontent->our_secation_description = $data["our_secation_description"];
                    $aboutcontent->our_secation_status      = $our_secation_status;
                    $aboutcontent->mis_secation_title       = $data["mis_secation_title"];
                    $aboutcontent->mis_secation_description = $data["mis_secation_description"];
                    $aboutcontent->mis_secation_status      = $mis_secation_status;
                    $aboutcontent->save();

                    return back()->withInput()->withSuccess("About Secation Add Successfully!");

        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }


    public function AboutSecationUpdate(Request $request){
        try {
            $data = $request->all();
            if(!empty($data['about_status']) && isset($data['about_status'])){
                $about_status = '1';
            }else{
                $about_status = '0';
            }
            $aboutdata = AboutSecation::where('secation_type','About_secation')->where('business_id',auth()->user()->id)->first();
                $aboutdata->business_id       = auth()->user()->id;
                $aboutdata->secation_type     = "About_secation";
                $aboutdata->image_hide_show   = $data["about_Image_status"];
                    if ($request->file('about_image')) {
                        $file = $request->file('about_image');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time(). '.' . $extension;
                        $file->move('aboutSecation/', $filename);
                        $aboutdata->about_image    = $filename;
                    }
                    $aboutdata->image_left_right  = $data["about_Image_side"];
                if ($request->file('about_banner')) {
                    $file = $request->file('about_banner');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '.' . $extension;
                    $file->move('AboutBannerImage/', $filename);
                    $aboutdata->home_image    = $filename;
                }
                  
                $aboutdata->description       = $data["about_description"];
                $aboutdata->status            = $about_status;
                $aboutdata->update();

                if(!empty($data['we_secation_status']) && isset($data['we_secation_status'])){
                    $we_secation_status = '1';
                }else{
                    $we_secation_status = '0';
                }
                if(!empty($data['our_secation_status']) && isset($data['our_secation_status'])){
                    $our_secation_status = '1';
                }else{
                    $our_secation_status = '0';
                }
                if(!empty($data['mis_secation_status']) && isset($data['mis_secation_status'])){
                    $mis_secation_status = '1';
                }else{
                    $mis_secation_status = '0';
                }
                $aboutcontent = AboutContent::where('business_id',auth()->user()->id)->first();
                $aboutcontent->business_id              = auth()->user()->id;
                $aboutcontent->we_secation_title        = $data["we_secation_title"];
                $aboutcontent->we_secation_description  = $data["we_secation_description"];
                $aboutcontent->we_secation_status       = $we_secation_status;
                $aboutcontent->our_secation_title       = $data["our_secation_title"];
                $aboutcontent->our_secation_description = $data["our_secation_description"];
                $aboutcontent->our_secation_status      = $our_secation_status;
                $aboutcontent->mis_secation_title       = $data["mis_secation_title"];
                $aboutcontent->mis_secation_description = $data["mis_secation_description"];
                $aboutcontent->mis_secation_status      = $mis_secation_status;
                $aboutcontent->update();
                return back()->withInput()->withSuccess("About Secation Updated Successfully!");


        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }
//End AboutSecation Moduel//

//Start HeaderSecation Moduel//

    public function HeaderSecation(){
        try {
            $data = HeaderSecation::where('business_id',auth()->user()->id)->get();
            $header = HeaderSecationAppend::where('business_id',auth()->user()->id)->get();
            $headerlogo = AboutSecation::where('business_id',auth()->user()->id)->where('secation_type','header_secation')->first();
            return view('web.dashboard.header-secation',compact('data','header','headerlogo'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function HeaderSecationStore(Request $request){
        
        try {
            HeaderSecation::where('business_id',auth()->user()->id)->delete();
            HeaderSecationAppend::where('business_id',auth()->user()->id)->delete();

            $data = $request->all();
            $aboutdata = AboutSecation::where('secation_type','header_secation')->where('business_id',auth()->user()->id)->first();
            if($aboutdata){
                $aboutdata->business_id       = auth()->user()->id;
                $aboutdata->secation_type     = "header_secation";
                if($request->file('image_logo')){
                    $file                     = $request->file('image_logo');
                    $extension                = $file->getClientOriginalExtension();
                    $filename                 = time(). '.' . $extension;
                    $file->move('image_logo/', $filename);
                    $aboutdata->header_secation_image = $filename;
                }
                $aboutdata->update();
            }else{
                $aboutdata = new AboutSecation;
                $aboutdata->business_id       = auth()->user()->id;
                $aboutdata->secation_type     = "header_secation";
                if($request->file('image_logo')){
                    $file                     = $request->file('image_logo');
                    $extension                = $file->getClientOriginalExtension();
                    $filename                 = time(). '.' . $extension;
                    $file->move('image_logo/', $filename);
                    $aboutdata->header_secation_image = $filename;
                }
                $aboutdata->save();
            }
           
            foreach ($data['de_menu'] as $keys => $val) {
                if(!empty($data['de_status'][$keys]) && isset($data['de_status'][$keys])){
                    $status = '1';
                }else{
                    $status = '0';
                }
                
                $HeaderSecation = new HeaderSecation;
                $HeaderSecation->menu = $data['de_menu'][$keys];
                $HeaderSecation->order = $data['de_order'][$keys];
                $HeaderSecation->status = $status;
                $HeaderSecation->business_id = $data['business_id'];
                $HeaderSecation->save();
            }
            if(isset($data['menu_name'])){
                foreach ($data['menu_name'] as $key => $val) {
                    $HeaderSecationa = new HeaderSecationAppend;
                    $HeaderSecationa->menu = $data['menu_name'][$key];
                    $HeaderSecationa->url = $data['url'][$key];
                    $HeaderSecationa->order = $data['order'][$key];
                    $HeaderSecationa->business_id = $data['business_id'];
                    $HeaderSecationa->save();
                }
            }
            

          return back()->withInput()->withSuccess("Header Secation Updated Successfully!");
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

//End HeaderSecation Moduel//


//Start FooterSecation Moduel//

    public function FooterSecation(){
        try {
            $number = FooterAddressSecation::where('key','number')->where('business_id',auth()->user()->id)->get();
            $email = FooterAddressSecation::where('key','email')->where('business_id',auth()->user()->id)->get();
            $firstSec = FooterSecation::where('key','second_secation')->where('business_id',auth()->user()->id)->get();
            $SecondSec = FooterSecation::where('key','secation_third')->where('business_id',auth()->user()->id)->get();
            return view('web.dashboard.footer-secation',compact('number','email','firstSec','SecondSec'));
        } catch (\Throwable $e) {
          return back()->withInput()->withError("something went wrong");
        }
    }

    public function FooterSecationStore(Request $request){
        
        try {

            FooterAddressSecation::where('business_id',auth()->user()->id)->delete();
            FooterSecation::where('business_id',auth()->user()->id)->delete();
            $data = $request->all();
            foreach ($data['number'] as $keys => $val) {
                if($val){
                    $emailPhone = new FooterAddressSecation;
                    $emailPhone->name = $data['secation_first'];
                    $emailPhone->number = $data['number'][$keys];
                    $emailPhone->business_id = $data['business_id'];
                    $emailPhone->key = "number";
                    $emailPhone->save();
                }

            }
            foreach ($data['email'] as $keys => $val) {
                if($val){
                    $emailPhone = new FooterAddressSecation;
                    $emailPhone->name = $data['secation_first'];
                    $emailPhone->email = $data['email'][$keys];
                    $emailPhone->business_id = $data['business_id'];
                    $emailPhone->key = "email";
                    $emailPhone->save();
                }
            }

            foreach ($data['sec_menu'] as $keysec => $val) {
                if($val){
                    $emailPhone = new FooterSecation;
                    $emailPhone->name = $data['secation_second'];
                    $emailPhone->menu = $data['sec_menu'][$keysec];
                    $emailPhone->url = $data['sec_url'][$keysec];
                    $emailPhone->order = $data['sec_order'][$keysec];
                    $emailPhone->business_id = $data['business_id'];
                    $emailPhone->key = "second_secation";
                    $emailPhone->save();
                }
               
            }

            foreach ($data['sec_menu_2'] as $keysthi => $val) {
                if($val){
                    $emailPhone = new FooterSecation;
                    $emailPhone->name = $data['secation_third'];
                    $emailPhone->menu = $data['sec_menu_2'][$keysthi];
                    $emailPhone->url = $data['sec_url_2'][$keysthi];
                    $emailPhone->order = $data['sec_order_2'][$keysthi];
                    $emailPhone->business_id = $data['business_id'];
                    $emailPhone->key = "secation_third";
                    $emailPhone->save();
                }  
            }
          return back()->withInput()->withSuccess("Footer Secation Updated Successfully!");
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function FooterRemove(Request $request){
        try {

            if($request->type == "email" || $request->type == "number"){
                FooterAddressSecation::where('business_id',auth()->user()->id)->where('id',$request->id)->delete();
                return response()->json([
                    'success' => 'success',
                    'message' => "is deleted",
                ]);
            }else{
                FooterSecation::where('business_id',auth()->user()->id)->where('id',$request->id)->delete();
                return response()->json([
                    'success' => $success,
                    'message' => "is deleted",

                ]);
            }
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");

        }
    }
//End FooterSecation Moduel//
}
