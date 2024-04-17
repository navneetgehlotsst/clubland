<?php
namespace App\Http\Controllers\web;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\{User,Faq,Cart,InquiryRequest,HeaderSecation,Page,FooterAddressSecation,FooterSecation,Product,EventReminder,EventCategory,Event,EventAppend,Color,ProductImage,EventImage,HeaderSecationAppend,Facility,HomeSecation,AboutSecation,AboutContent,MembershipPlan,CartEventTicket,PrductVariation};
use Mail,Hash,File,Http,DB,Auth,Session,Stripe;
use Carbon\Carbon;
class CompanyPortalController extends Controller
{
    private $username;

    public function __construct(Request $request)
    {
        $this->username = $request->username;
    }

    public function index(Request $request)
    {
        $user = User::where('slug', $this->username)->first();
        dd($user);
    }

    public function CompanyPriview(Request $request){
        try {

            $slug = $this->username;
            $userId = User::where('slug',$slug)->first();

            if(!empty($userId)){

                 $checkHomeSecation =AboutSecation::where('business_id',$userId->id)->where('secation_type','Home_secation')->first();

                 if(!empty($checkHomeSecation)){
                    $homedata = HomeSecation::where('business_id',$userId->id)->orderBy('order','ASC')->get();
                    //Strat Product Code....//

                    $productdata = HomeSecation::where('business_id',$userId->id)->where('secation_type','product_secation')->first();

                    if($productdata->type == 1){

                        if($productdata->seaction_product_id != ''){

                            $productIds=  json_decode($productdata->seaction_product_id);

                        }else{

                            $productIds=[];

                        }

                        $products = Product::where('business_id', $userId->id)->whereIn('id', $productIds)->take(3)->get();

                    }else{

                        $products = Product::where('business_id', $userId->id)->orderBy('id','DESC')->take(3)->get();

                    }

                    //End Product Code....//

                    

                    //Strat Event Code....//

                        $eventdata = HomeSecation::where('business_id',$userId->id)->where('secation_type','event_secation')->first();
                        $now = Carbon::now();
                        $date = Carbon::parse($now)->toDatetimeString();
                        if($eventdata->type == 1){

                            if($eventdata->seaction_product_id != ''){

                                $eventIds=  json_decode($eventdata->seaction_product_id);

                            }else{

                                $eventIds=[];

                            }

                            $events = Event::where('business_id', $userId->id)->where('end_date', '>=', $date)->whereIn('id', $eventIds)->take(3)->get();

                        }else{

                            $events = Event::where('business_id', $userId->id)->where('end_date', '>=', $date)->orderBy('id','DESC')->take(3)->get();



                        }

                    //End Event Code....//



                    //Strat Facility Code....//

                        $facilitydata = HomeSecation::where('business_id',$userId->id)->where('secation_type','facility_secation')->first();
                        $now = Carbon::now();
                        $date = Carbon::parse($now)->toDatetimeString();
                        if($facilitydata->type == 1){

                            if($facilitydata->seaction_product_id != ''){

                                $facilityIds=  json_decode($facilitydata->seaction_product_id);

                            }else{

                                $facilityIds=[];

                            }
                            
                            $facilitys = Facility::where('business_id', $userId->id)->where('end_hours', '>=', $date)->whereIn('id', $facilityIds)->take(3)->get();

                        }else{

                            $facilitys = Facility::where('business_id', $userId->id)->where('end_hours', '>=', $date)->orderBy('id','DESC')->take(3)->get();

                        }



                    //Strat Facility Code....//

                    //Strat MemberShip Code....//



                        $membershipdata = HomeSecation::where('business_id',$userId->id)->where('secation_type','membership_secation')->first();

                            if($membershipdata->type == 1){

                                if($membershipdata->seaction_product_id != ''){

                                    $memnershipIds=  json_decode($membershipdata->seaction_product_id);

                                }else{

                                    $memnershipIds=[];

                                }

                                $memnerships = MembershipPlan::where('business_id', $userId->id)->whereIn('id', $memnershipIds)->take(3)->get();

                            }else{

                                $memnerships = MembershipPlan::where('business_id', $userId->id)->orderBy('id','DESC')->take(3)->get();

                            }

                        //Strat MemberShip Code....//

                        $bannerImage = AboutSecation::where('business_id',$userId->id)->where('secation_type','Home_secation')->first();

                        $aboutSecation = AboutSecation::where('business_id',$userId->id)->where('secation_type','Home_secation')->where('status','1')->first();

                        $businessSlug = $slug;
                       
                    return view('web.company-poratal.companypriview',compact('bannerImage','productdata','aboutSecation','products','slug','events','facilitys','memnerships','membershipdata','facilitydata','eventdata','productdata','businessSlug','homedata'));

                }else{
                    return back()->withInput()->withError("Please complete home section");
                }

            }else{

                return abort(404);  

            }

        } catch (\Throwable $e) {
            return abort(404);  

        }

    }



    public function ShopPortalDetails(Request $request,$businessSlug,$slug){
        try {
            $product = Product::where('slug', $slug)->first();
            $cartcheck = Cart::where('session_id',Session::getId())->where('product_id',$product->id)->where('type','product')->first();
            return view('web.company-poratal.shop-portal-details',compact('product','businessSlug','cartcheck'));
        } catch (\Throwable $e) {
             return back()->withInput()->withError("something went wrong");
        }

    }


    public function shopPortalColorVariation(Request $request)
    {
        try {
            $businessSlug = $this->username;
            $colors = PrductVariation::where('product_id', $request->product_id)
                ->where('size', $request->size)
                ->get();
            $size = PrductVariation::where('product_id', $request->product_id)
            ->where('size', $request->size)
            ->first();
            $html = '<option value="" selected>--Select Color--</option>';
            foreach ($colors as $value) {
                $html .= '<option value="' . $value->id . '">' . ucfirst($value->color) . '</option>';
            }
            return response()->json([
                'status' => true,
                'data' => $html,
                'size' => $size,
            ]);
        } catch (\Throwable $e) {
            // Log the error for debugging
            \Log::error('Error in shopPortalColorVariation: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }


    

    public function ShopPortalPriceVariation(Request $request)
    {
        try {
            $businessSlug = $this->username;
            $data = PrductVariation::where('product_id', $request->product_id)
                ->where('id', $request->color_id)
                ->first();
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Throwable $e) {
            // Log the error for debugging
            \Log::error('Error in shopPortalColorVariation: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }



    public function EventDetails(Request $request,$businessSlug,$slug=null){

        try {
            $event = Event::where('slug', $slug)->first();
            $cartcheck = Cart::where('session_id',Session::getId())->where('product_id',$event->id)->where('type','event')->first();
            return view('web.company-poratal.event-details',compact('event','businessSlug','cartcheck'));

        } catch (\Throwable $e) {

             return back()->withInput()->withError("something went wrong");

        }

    }

    

    public function FacilitytDetails(Request $request,$businessSlug,$slug=null){

        try {
            $facility = Facility::where('slug', $slug)->first();
            return view('web.company-poratal.facility-details',compact('facility','businessSlug'));
        } catch (\Throwable $e) {
             return back()->withInput()->withError("something went wrong");
        }
    }

    public function ShopPortallist(Request $request){
        try {
            $businessSlug = $this->username;
            $userId = User::where('slug',$businessSlug)->first();

            $product = Product::where('business_id', $userId->id)->orderBy('id','DESC')->get();

            return view('web.company-poratal.shop-portal-list',compact('product','businessSlug'));

        } catch (\Throwable $e) {

             return back()->withInput()->withError("something went wrong");

        }

    }

    public function Eventlist(Request $request){

        try {
            $businessSlug = $this->username;
            $now = Carbon::now();
            $date = Carbon::parse($now)->toDatetimeString();
            $userId = User::where('slug',$businessSlug)->first();

            $event = Event::where('business_id', $userId->id)->where('end_date', '>=', $date)->orderBy('id','DESC')->get();

            return view('web.company-poratal.event-list',compact('event','businessSlug'));

        } catch (\Throwable $e) {

             return back()->withInput()->withError("something went wrong");

        }

    }

    public function Facilitylist(Request $request){

        try {
            $businessSlug = $this->username;
            $userId = User::where('slug',$businessSlug)->first();
            $now = Carbon::now();
            $date = Carbon::parse($now)->toDatetimeString();
            $facility = Facility::where('business_id', $userId->id)->where('end_hours', '>=', $date)->orderBy('id','DESC')->get();

            return view('web.company-poratal.facility-list',compact('facility','businessSlug'));

        } catch (\Throwable $e) {

             return back()->withInput()->withError("something went wrong");

        }

    }



    public function MembershipList(Request $request){

        try {
            $businessSlug = $this->username;
            $userId = User::where('slug',$businessSlug)->first();

            $membership = MembershipPlan::where('business_id', $userId->id)->orderBy('id','DESC')->get();

            return view('web.company-poratal.membership-list',compact('membership','businessSlug'));

        } catch (\Throwable $e) {

             return back()->withInput()->withError("something went wrong");

        }

    }

    public function MembershipDetails(Request $request,$businessSlug,$slug=null){

        try {
            $membership = MembershipPlan::where('slug',$slug)->first();
            return view('web.company-poratal.membership-details',compact('membership','businessSlug'));

        } catch (\Throwable $e) {

             return back()->withInput()->withError("something went wrong");

        }

    }



    public function TermCondition($slug)

    {

        try{
            $businessSlug = $this->username;
            $page = Page::where('template', $slug)->first();

            return view('web.company-poratal.cms-pages', compact('page','businessSlug'));

        }catch(Exception $e){

            return back()->withInput()->withError("something went wrong");

        }



    }



    public function ContactUs(){

        try {
            $businessSlug = $this->username;
            return view('web.company-poratal.contact-us', compact('businessSlug'));
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");
        }

    }

    public function AboutUs(){

        try {
            $businessSlug = $this->username;

            $userId = User::where('slug',$businessSlug)->first();

            if(!empty($userId)){

                    //Strat Product Code....//

                    $databanner = AboutSecation::where('business_id',$userId->id)->where('secation_type','About_secation')->first();

                    $data = AboutSecation::where('business_id',$userId->id)->where('secation_type','About_secation')->where('status','1')->first();

                $aboutContent = AboutContent::where('business_id',$userId->id)->first();

           

            return view('web.company-poratal.about-us',compact('businessSlug','data','aboutContent','databanner'));



            }else{

                return abort(404);  

            }    



        } catch (\Throwable $th) {

            return abort(404);  

        }

    }


    public function BookNow(Request $request,$businessSlug,$type=null,$productslug=null,$id=null){
        try {
         
            if($type == 'membership'){
               $membership = MembershipPlan::where('slug',$productslug)->first();
                 return view('web.company-poratal.book-now-membership', compact('businessSlug','membership'));
            }else if($type == 'event'){
                if($productslug == 'Free'){
                    $quanitiy = $request->quantity;
                    $event = Event::where('slug',$id)->first();
                    return view('web.company-poratal.book-now-event', compact('businessSlug','event','quanitiy'));
                }else{
                    $quanitiy = $request->quantity;
                    if($quanitiy){
                        $checkarray = array_diff($quanitiy, [0]);
                        if ($checkarray) {
                            $event = Event::where('slug',$id)->first();
                            return view('web.company-poratal.book-now-paid-event', compact('businessSlug','event','quanitiy'));
                        } else {
                            return back()->withInput()->withError("Please select event quantity");
                          
                        }
                    }else{
                        return back()->withInput()->withError("Please select event quantity");

                    }
                    
                   

                }
            }else{
                $facility = Facility::where('slug', $productslug)->first();
                return view('web.company-poratal.book-now', compact('businessSlug','facility'));
            }

        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");

        }

    }

    public function AddToCart(Request $request){
        $data = $request->all();
        $this->validate($request, [
            'quantity' => 'required',
        ]);
        try {
            if($data['type'] == "product"){
                if($data['variation_id'] == ''){
                    $productData = Product::where('id',$data['product_id'])->first();
                    $check=(int)$productData->product_quantity < (int)$request->quantity;
                    if($check){
                        return response()->json([
                            'status' => 'out of stock',
                            'message' => 'product quantity out of stock'
                        ]);
                    }
                    if($productData->product_discount == null){
                        $totalAmount = $productData->product_price;
                    }else{
                        $totalAmount = $productData->product_discount;
                    }
                }else{
                    $productData = PrductVariation::where('id',$data['variation_id'])->first();
                    $check=(int)$productData->quantity < (int)$request->quantity;
                    if($check){
                        return response()->json([
                            'status' => 'out of stock',
                            'message' => 'product quantity out of stock'
                        ]);
                    }
                    if($productData->discount_price != '0'){
                        $totalAmount = $productData->discount_price;
                    }else{
                        $totalAmount = $productData->price;

                    }
                }
                
                $cartdata = Cart::where('session_id', Session::getId())
                ->where('product_id', $data['product_id'])->where('variation_id', $data['variation_id'])->where('type','product')->first();
                if($cartdata){
                    return response()->json([
                        'status' => 'all ready add',
                        'message' => 'This product all ready added this cart list.'
                    ]);
                }
                $cart = new Cart;
                $cart->session_id   = Session::getId();
                $cart->product_id   = $data['product_id'];
                $cart->variation_id = $data['variation_id'];
                $cart->amount       = $totalAmount;
                $cart->type         = "product";
                $cart->quantity     = $data['quantity'];
                $cart->save();
                return response()->json([
                    'status' => 'cart add',
                ]);
            }else{
                if($request->event_type != 'paid'){
                    $quanitiy = $request->quantity;
                    $event = Event::where('slug',$request->event_id)->first();
                    $cartdata = Cart::where('session_id', Session::getId())
                    ->where('product_id', $event->id)->where('type','event')->first();
                    if($cartdata){
                        return response()->json([
                            'status' => 'all ready add',
                            'message' => 'This event all ready added this cart list.'
                        ]);
                    }
                    $cart = new Cart;
                    $cart->session_id = Session::getId();
                    $cart->product_id = $event->id;
                    $cart->amount     = 0;
                    $cart->type       = "event";
                    $cart->event_type = "Free";
                    $cart->quantity   = $quanitiy;
                    $cart->save();
                    return response()->json([
                        'status' => 'cart add',
                    ]);
                }else{
                    $quanitiy = $request->quantity;
                    if($quanitiy){
                        $checkarray = array_diff($quanitiy, [0]);
                       // dd($checkarray);
                        if ($checkarray) {
                            $event = Event::where('slug',$request->event_id)->first();
                            $cartdata = Cart::where('session_id', Session::getId())
                            ->where('product_id', $event->id)->where('type','event')->first();
                            
                            if($cartdata){
                                return response()->json([
                                    'status' => 'all ready add',
                                    'message' => 'This event all ready added this cart list.'
                                ]);
                            }
                            $cart = new Cart;
                            $cart->session_id = Session::getId();
                            $cart->product_id = $event->id;
                            $cart->amount     = 0;
                            $cart->type       = "event";
                            $cart->event_type = "Paid";
                            $cart->quantity   = 0;
                            $cart->save();
                            if($cart){
                                foreach ($event->geteventTicket as $key => $value) {
                                    if($quanitiy[$key] != 0){
                                        $cartevent = new CartEventTicket;
                                        $cartevent->cart_id   = $cart->id;
                                        $cartevent->ticket_id = $value->id;
                                        $cartevent->quantity  = $checkarray[$key];
                                        $cartevent->price     = $value->ticket_cost;
                                        $cartevent->save();
                                    }
                                }
                            }
                            return response()->json([
                                'status' => 'cart add',
                            ]);
                        } else {
                            return response()->json([
                                'status' => 'select quantity',
                              
                            ]);
                        }
                    }else{
                        return response()->json([
                            'message' => 'Please select event quantity.'
                        ]);
                    }
                }
            }
            
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");
        }

    }

    public function UpdateCart(Request $request){
        try {
            $data = $request->all();
            $cartdata = Cart::where('id', $data['id'])->first();
            if($cartdata){
                $cartdata->quantity = $data['quantity'];
                $cartdata->update();
                return response()->json([
                    'status' => 'success',
                    'message' => 'quantity updated successfully.'
                ]);
            }else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'no data found'
                ]);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e
            ]);
        }
    }
    public function UpdateEventTicketCart(Request $request){
        try {
            $data = $request->all();
            $cartdata = CartEventTicket::where('id', $data['id'])->first();
            if($cartdata){
                $cartdata->quantity = $data['quantity'];
                $cartdata->update();
                return response()->json([
                    'status' => 'success',
                    'message' => 'quantity updated successfully.'
                ]);
            }else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'no data found'
                ]);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e
            ]);
        }
    }

    public function UpdateEventDetailsTicket(Request $request){
        try {
            $data = $request->all();
            $event = Event::where('slug',$request->event_id)->first();
            if($request->event_type == 'free'){
                $quanitiy = $request->quantity;
                $cartdata = Cart::where('session_id', Session::getId())
                ->where('product_id', $event->id)->where('event_type','Free')->where('type','event')->first();
                if($cartdata){
                    $cartdata->quanitiy = $quanitiy;
                    $cartdata->update();
                    return response()->json([
                        'status' => 'cart update',
                    ]);
                }
                
            }else{
                $quanitiy = $request->quantity;
                if($quanitiy){
                    $checkarray = array_diff($quanitiy, [0]);
                    if ($checkarray) {
                        $cartdata = Cart::where('session_id', Session::getId())
                        ->where('product_id', $event->id)->where('event_type','Paid')->first();
                        if($cartdata){
                            CartEventTicket::where('cart_id',$cartdata->id)->delete();
                            foreach ($event->geteventTicket as $key => $value) {
                                if($quanitiy[$key] != 0){
                                    $cartevent = new CartEventTicket;
                                    $cartevent->cart_id   = $cartdata->id;
                                    $cartevent->ticket_id = $value->id;
                                    $cartevent->quantity  = $checkarray[$key];
                                    $cartevent->price     = $value->ticket_cost;
                                    $cartevent->save();
                                }
                            }
                        }
                    } else {
                        $cartdata = Cart::where('session_id', Session::getId())
                        ->where('product_id', $event->id)->where('event_type','Paid')->first();
                        CartEventTicket::where('cart_id',$cartdata->id)->delete();
                        $cartdata->delete();
                    }
                    return response()->json([
                        'status' => 'cart update',
                    ]);
                }else{
                    return response()->json([
                        'message' => 'Please select event quantity.'
                    ]);
                }
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e
            ]);
        }
    }

    
    public function CartList(Request $request){
        try {
            $businessSlug = $this->username;

            $data = Cart::where('session_id', Session::getId())->where('type','product')
            ->groupBy('variation_id','product_id')
            ->selectRaw('id,product_id,variation_id, sum(amount) as total_amount, sum(quantity) as total_quantity')
            ->get();
            $totalAmount = Cart::where('session_id', Session::getId())
            ->groupBy('session_id')
            ->selectRaw('product_id, sum(amount) as total_amount')
            ->first();
            if($totalAmount){
                $platformFee = ((3.75 / 100) * $totalAmount->total_amount) + 0.50;
                $finalAmount = ($totalAmount->total_amount) + $platformFee;
            }else{
                $platformFee = '0';
                $finalAmount = '0';
            }
            $eventdata = Cart::where('session_id', Session::getId())->where('type','event')
            ->groupBy('product_id')
            ->selectRaw('*')
            ->get();
           // dd($eventdata);
            return view('web.company-poratal.cart-list', compact('data','businessSlug','platformFee','eventdata','totalAmount','finalAmount'));
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");

        }

    }
    
    
    public function RemoveCart(Request $request){
        try {
            $data = Cart::where('id', $request->id)->delete();
            return response()->json([
                'status' =>'success',
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");

        }
    }

    public function RemoveEventCart(Request $request){
        try {
            $data = CartEventTicket::where('id', $request->id)->first();
            $catid = $data->cart_id;
            $eventcartcount = CartEventTicket::where('cart_id', $catid)->count();
            if($eventcartcount == 1){
              //  $data->delete();
                Cart::where('id',$catid)->delete();
            }
                $data->delete();
            
            return response()->json([
                'status' =>'success',
            ]);
            
            
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");

        }
    }

    
    public function CheckOut(Request $request){
        try {
            $businessSlug = $this->username;

            $data = Cart::select('*')->where('session_id', Session::getId())->where('type','product')
            ->groupBy('variation_id')
            ->get();
            $eventdata = Cart::where('session_id', Session::getId())->where('type','event')
            ->groupBy('product_id')
            ->selectRaw('*')
            ->get();
            $EventAmount = 0;
                    foreach ($eventdata as $keys => $values) {
                        foreach ($values->geteventticketdata as $key => $val) {
                           // echo number_format(((3.75 / 100) * $val->price) + 0.50 + $val->price,2) * $val->quantity;
                          $EventAmount+= number_format(((3.75 / 100) * $val->price) + 0.50 + $val->price,2) * $val->quantity;
                        }
                    }
            $productamount = $data->sum('amount');
            $totalamount =$productamount + $EventAmount;
            if($totalamount <= 0 ){
                return view('web.company-poratal.free-checkout-page', compact('businessSlug','data','eventdata'));
            }else{
               return view('web.company-poratal.checkout-page', compact('businessSlug','data','eventdata'));
            }
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");

        }
    }
    

}

