<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Payment;
use App\Models\Facility;
use App\Models\MembershipPlan;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\PrductVariation;

use App\Models\Cart;
use App\Models\EventAppend;
use App\Models\Notification;
use App\Models\MembershipPeople;
use App\Models\EventBookingDetail;
use App\Models\CartEventTicket;
use App\Models\MembershipGuardiansDetail;
use App\Models\MailchimpKey;


use App\Models\Event;
use Mail,Hash,File,Auth,DB,Helper,Exception,Session,Redirect,Validator,TimeHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Stripe;
use App\Mail\HostNewBooking;
use App\Mail\WaitingHostApproval;
use App\Mail\HostAcceptBookingAction;
use App\Mail\HostRejectBookingAction;
use App\Mail\LeaderAcceptBooking;
use App\Http\Controllers\StripeTrait;
use Laravel\Cashier\Cashier;
use App\Mail\UserSendEmailInvoice;
use App\Mail\UserSendEmailProductInvoice;
use App\Mail\UserSendEmailFacilityInvoice;
use App\Mail\UserSendEmailEventInvoice;

class PaymentController extends Controller
{
    public function create(Request $request,$businessSlug,$booking_id,$type=null){
        try{
            $data =$request->all();
            $customer = '';
            if($type == 'membership'){
                if(isset($data['answer'])){
                    $ans =implode(',', $data['answer']);
                }else{
                    $ans ="";
                }
                if(isset($data['name'])){
                    $peoplename =implode(',', $data['name']);
                    $peoplephone =implode(',', $data['phone']);
                    $peopleemail =implode(',', $data['people_email']);
                    

                }else{
                    $peoplename ="";
                    $peoplephone ="";
                    $peopleemail ="";
                }
                $booking = MembershipPlan::where('slug', $booking_id)->first();
                if($booking->discount == 0){
                    $platformFee = ((3.75 / 100) * $booking->price) + 0.50;
                }else{
                    $platformFee = ((3.75 / 100) * $booking->fixed_amount) + 0.50;
                }
                
                $type ="membership";
                $curl = new \Stripe\HttpClient\CurlClient();
                $curl->setEnablePersistentConnections(false);
                \Stripe\ApiRequestor::setHttpClient($curl);
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            
                $customer = \Stripe\Customer::create(
                    [
                        "email" => $data['email'],
                        "name" => $data['user_name'],
                    ]
                );
                $customer = $customer->id;
                Session::put('guardians', $data);
                return view('web.company-poratal.payment',compact('booking','businessSlug','platformFee','data','ans','type','customer','peoplephone','peoplename','peopleemail'));
            }
            if($type == 'free'){
               // dd($data['name']);
                if(!empty($data['answer'])){
                    $ans = implode(',', $data['answer']);
                }else{
                    $ans ="";

                }
                $booking = MembershipPlan::where('slug', $booking_id)->first();
                $business = User::where('id',$booking->business_id)->first();
                $currentdate = Carbon::now();
                if ($booking->plan_terms == 'monthly') {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, 1);
                } elseif ($booking->plan_terms == 'quarterly') {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, 3);
                } elseif ($booking->plan_terms == 'half yearly') {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, 6);
                } elseif ($booking->plan_terms == 'annually') {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, 12);
                } else {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, $booking->custome_month);
                }
                $payment = new Payment();
                $payment->booking_id = $booking->id;
                $payment->type = 'membership';
                $payment->user_name = $data['user_name'];
                $payment->user_email = $data['email'];
                $payment->phone_number = $data['phone_number'];
                $payment->address = $data['address'] ?? '';
                $payment->charge_id = "";
                $payment->receipt_url = "";
                $payment->total_amount = "";
                $payment->owner_answer =$ans;
                $payment->currency = "";
                $payment->destination = $business->stripe_connect_id;
                $payment->destination_amount = "";
                $payment->commission_amount = "";
                $payment->payment_status = 'free'; 
                $payment->expire_date = $ExpiryDate; 

                $payment->save();
                if($data['check_age'] == '1'){
                    $guadians = new MembershipGuardiansDetail();
                    $guadians->payment_id = $payment->id;
                    $guadians->name = $data['parent_name'];
                    $guadians->email = $data['parent_email'];
                    $guadians->phone_number = $data['parent_phone_number'];
                    $guadians->save();
                }

                foreach ($data['name'] as $key => $value) {
                    $people = new MembershipPeople();
                    $people->payment_id = $payment->id;
                    $people->name = $value;
                    $people->phone = $data['phone'][$key];
                    $people->email = $data['people_email'][$key];
                    $people->save();
                }
                $notification = new Notification();
                $notification->target_id = $business->id;
                $notification->type = 'membership';
                $notification->message = 'You have a new Order for free membership #ORDERID00'.$payment->id;
                $notification->save();

                $mailchimpuser = array(
                    "email_address" => $data['email'],
                    "status" => "subscribed",
                    "merge_fields" => array(
                        "FNAME"=> $data['user_name'],
                        "PHONE"=> $data['phone_number'],
                    )
                );

                $this->MailChimpUserstore($mailchimpuser,$businessSlug);
                DB::commit();
                $data['orderId'] = $payment->id;
                $data['orderDate'] = $payment->created_at;
                $data['business_name'] = $business->full_name;
                $data['business_email'] = $business->email;
                $data['business_phone'] = $business->phone_number;
                $data['business_country_code'] = $business->country_code;
                $data['booking'] = $booking;
                $data['members'] = MembershipPeople::where('payment_id',$payment->id)->get();
                $data['guardians'] = MembershipGuardiansDetail::where('payment_id',$payment->id)->first();
                Mail::to($data['email'])->send(new UserSendEmailInvoice($data));
                return redirect()->away('/thank-you');

            }
            if($type == 'product'){
                $booking = Cart::where('session_id', Session::getId())->where('type','product')
                ->groupBy('variation_id', 'product_id')
                ->get();
                $ProductAmount = 0;
                foreach ($booking as $key => $value) {
                    if($value->variation_id){
                        if($value->getvariationdata->discount_price == 0){
                            $ProductAmount+= $value->getvariationdata->price * $value->quantity;
                        }else{
                            $ProductAmount+= $value->getvariationdata->discount_price * $value->quantity;
                        }               
                    }else{
                        if($value->getproductdata->product_discount != null && $value->getproductdata->product_discount == 0){
                            $ProductAmount+=  $value->getproductdata['product_price'] * $value->quantity;
                        }else{
                            $ProductAmount+= $value->getproductdata['product_discount'] * $value->quantity;
                        }
                    }
                }
                
                $eventdata = Cart::where('session_id', Session::getId())->where('type','event')
                ->groupBy('product_id')
                ->selectRaw('*')
                ->get();
                    $EventAmount = 0;
                    foreach ($eventdata as $keys => $values) {
                        foreach ($values->geteventticketdata as $key => $val) {
                          $EventAmount+= $val->price * $val->quantity;
                        }
                    }

                    $finalAmount = $ProductAmount + $EventAmount;
                    $platformFee = ((3.75 / 100) * $finalAmount) + 0.50;
                    Session::put('my_array', $data);
                        // Retrieve array value from session
                 
                return view('web.company-poratal.product-payment',compact('booking','businessSlug','data','finalAmount','platformFee'));

            }

            if($type == 'event-free'){
                $booking = Cart::where('session_id', Session::getId())
                ->where('type','event')
                ->where('event_type','free')
                ->get();
                $business = User::where('id',$booking['0']['geteventdata']['business_id'])->first();
                $payment = new Payment();
                $payment->booking_id = '';
                $payment->type = 'event';
                $payment->user_name    = $data['user_name'];
                $payment->user_email   = $data['email'];
                $payment->phone_number = $data['phone_number'];
                $payment->address      = $data['address'] ?? '';
                $payment->user_query   = $data['user_query'] ?? '';
                $payment->charge_id    = "";
                $payment->receipt_url  = "";
                $payment->total_amount = "";
                $payment->owner_answer = "";
                $payment->currency = "";
                $payment->destination = $business->stripe_connect_id;
                $payment->destination_amount = "";
                $payment->commission_amount = "";
                $payment->payment_status = 'free'; 
                $payment->save();
                foreach ($booking as $key => $value) {
                    $order = new OrderItem;
                    $order->order_id = $payment->id;
                    $order->product_id = $value->product_id;
                    $order->variation_id = '';
                    $order->quantity = $value->quantity;
                    $order->type = 'event';

                    $order->price = '0';
                    $order->save();
                    Event::where('id', $value->product_id)->decrement('quantity', $value->quantity);
                    $notification = new Notification();
                    $notification->target_id = $business->id;
                    $notification->type = 'event';
                    $notification->event_id = $value->product_id;
                    $notification->message = 'You have a new Order for free event #ORDERID00'.$payment->id;
                    $notification->save();
                }

                if(count($data['name']) > 0){
                    foreach ($data['name'] as $key1 => $value) {
                        foreach ($value as $key2 => $val) {
                            foreach ($data['name'][$key1][$key2] as $key3 => $result) {
                                $event_booking = new EventBookingDetail;
                                $event_booking->payment_id = $payment->id;
                                $event_booking->event_id = $key1;
                                $event_booking->name = $data['name'][$key1][$key2][$key3];
                                $event_booking->email = $data['emails'][$key1][$key2][$key3];
                                $event_booking->phone = $data['phone'][$key1][$key2][$key3];
                             //   $event_booking->user_query = $data['user_query'][$key1][$key2][$key3];
                                $event_booking->save();
                                // echo $data['user_query'][$key1]."<br>";
                            }
                        }
                    }
                }
                $mailchimpuser = array(
                    "email_address" => $data['email'],
                    "status" => "subscribed",
                    "merge_fields" => array(
                        "FNAME"=> $data['user_name'],
                        "PHONE"=> $data['phone_number'],
                    )
                );

                $this->MailChimpUserstore($mailchimpuser,$businessSlug);
                $Event_id = OrderItem::where('order_id',$payment->id)->pluck('product_id');
                // dd($orderdata);
                $eventdata = Event::whereIn('id', $Event_id)->get();
                $data['orderId'] = $payment->id;
                $data['orderDate'] = $payment->created_at;
                $data['business_name'] = $business->full_name;
                $data['business_email'] = $business->email;
                $data['business_phone'] = $business->phone_number;
                $data['business_country_code'] = $business->country_code;
                $data['booking'] = $eventdata;
                $data['quanitiy'] = OrderItem::where('order_id',$payment->id)->get();
                $data['event_booking_detail'] = EventBookingDetail::where('payment_id',$payment->id)->orderBy('id','ASC')->get();

                Mail::to($data['email'])->send(new UserSendEmailEventInvoice($data));
                Cart::where('session_id', Session::getId())
                ->where('type','event')
                ->where('event_type','free')
                ->delete();
                
                return redirect()->away('/thank-you');
            }
            if($type == 'event-paid'){
                $booking = Event::with(['geteventTicket' => function($query) use ($data) {
                    $query->whereIn('id', $data['ticket_id']);
                }])->where('slug', $booking_id)->first();
                //dd($booking->geteventTicket);
                $data['totalAmount'] = 0;
                foreach ($booking->geteventTicket as $key => $value) {
                    $data['totalAmount'] += $value->ticket_cost * $data['quanitiy'][$key];
                }
                $platformFee = ((3.75 / 100) * $data['totalAmount']) + 0.50;
                $data['finalAmount'] = $data['totalAmount'] + $platformFee;
                $data['type'] = 'event';
               return view('web.company-poratal.event-payment',compact('booking','businessSlug','platformFee','data'));
            
            }
            $booking = Facility::where('slug', $booking_id)->first();
            $platformFee = ((3.75 / 100) * $booking->price) + 0.50;
            $type ="facility";
            return view('web.company-poratal.payment',compact('booking','businessSlug','platformFee','data','type'));
            
        }catch(Exception $e){
            return back()->withInput()->withError("something went wrong");
        }
    }

    
    public function ProductPayment(Request $request){
        $data = $request->all();
        $sessiondata = Session::get('my_array');
        $validator = Validator::make($request->all(), [
            'card_token' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json( [ 'errors' => $validator->getMessageBag()->first() ] );

          //  return back()->withInput()->withError($validator->getMessageBag()->first());
        }
        try {
            DB::beginTransaction();
            $booking = Cart::where('session_id', Session::getId())
            ->where('type','product')
            ->get();
            $paymentlastid = Payment::orderBy('id','DESC')->first();
            if($paymentlastid){
                $orderNo = $paymentlastid->id + 1;
            } else {
                $orderNo = 1;
            }
            $productAmount = 0;
            foreach ($booking as $key => $value) {
                $productAmount+=  $value->amount * $value->quantity;;
            }

            $eventdata = Cart::where('session_id', Session::getId())
            ->where('type','event')
            ->groupBy('product_id')
            ->get();
            $EventAmount = 0;
            foreach ($eventdata as $keys => $values) {
                foreach ($values->geteventticketdata as $key => $val) {
                    $EventAmount+= $val->price * $val->quantity;
                }
            }
            $platformFee = 0;
            if($productAmount != 0){
                $platformFee = ((3.75 / 100) * $productAmount) + 0.50;
            }
            $eventplatformFee = 0;
            if($EventAmount != 0){
                $eventplatformFee = ((3.75 / 100) * $EventAmount) + 0.50;
            }

            $totalamounts = $productAmount + $EventAmount; 
            $finalPlateformFee = $platformFee + $eventplatformFee;
            $finalAmount = $totalamounts + $platformFee + $eventplatformFee; 
            if(count($booking) > 0){
                $business = User::where('id',$booking[0]['getproductdata']['business_id'])->first();
            }else{
                $business = User::where('id',$eventdata[0]['geteventdata']['business_id'])->first();
            }

            $host_amount = round($finalAmount,2);
            $finalPlateformFee = round($finalPlateformFee,2);
            $transferAmount = round(($host_amount-$finalPlateformFee)*100);
            
            $token = $request->card_token;
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $charge = $stripe->charges->create([
                'amount' => $host_amount * 100,
                'currency' => env('CURRENCY'),
                'source' => $token,
                'description' => '',
                'capture' => true,
                'transfer_data' => ['destination' => $business->stripe_connect_id, 'amount' => $transferAmount],
            ]);
            if($charge->paid == true && $charge->status == 'succeeded'){
                $booking = Cart::where('session_id', Session::getId())
                ->where('type','product')
                ->get();
                if(count($booking) != 0) {
                    $payment = new Payment();
                    $payment->booking_id = $orderNo;
                    $payment->user_name  = $data['user_name'];
                    $payment->type       = 'product';
                    $payment->user_email = $data['email'];
                    $payment->phone_number = $data['phone_number'];
                    $payment->address      = $data['address'] ?? '';
                    $payment->charge_id    = $charge->id;
                    $payment->card_token   = '';
                    $payment->receipt_url  = $charge->receipt_url;
                    $payment->total_amount = $productAmount;
                    $payment->currency     = $charge->currency;
                    $payment->destination  = $business->stripe_connect_id;
                    $payment->destination_amount = $host_amount;
                    $payment->commission_amount  = $platformFee;
                    $payment->payment_status     = 'success'; 
                    $payment->owner_answer       = '';
                    $payment->expire_date        = ''; 
                    $payment->save();
                    DB::commit();
                    $product_total_amount = 0;
                    foreach ($booking as $key => $value) {
                        $amount= number_format(((3.75 / 100) * $value->amount) + 0.50 + $value->amount,2) * $value->quantity;;
                        $order = new OrderItem;
                        $order->order_id = $orderNo;
                        $order->product_id = $value->product_id;
                        $order->variation_id = $value->variation_id ?? '';
                        $order->quantity = $value->quantity;
                        $order->type = 'product';
                        $order->price = $amount;
                        $order->save();
                        //$product_total_amount += $amount; 
                        Product::where('id', $value->product_id)->decrement('product_quantity', $value->quantity);
                        PrductVariation::where('id', $value->variation_id)->decrement('quantity', $value->quantity);
                        if($key == 0){
                            $notification = new Notification();
                            $notification->target_id = $business->id;
                            $notification->type = 'product';
                            $notification->event_id = $value->product_id;
                            $notification->message = 'You have a new Order for product #ORDERID00'.$orderNo;
                            $notification->save();
                        }
                    }
                   // $payment->total_amount = $product_total_amount;
                    //$payment->save();
                }
                $event_booking = Cart::where('session_id', Session::getId())
                ->where('type','event')
                ->get();
               // $eventplatformFee = ((3.75 / 100) * $EventAmount) + 0.50;

                if(count($event_booking) != 0) {
                    $payment = new Payment();
                    $payment->booking_id = $orderNo;
                    $payment->user_name  = $data['user_name'];
                    $payment->type       = 'event';
                    $payment->user_email = $data['email'];
                    $payment->phone_number = $data['phone_number'];
                    $payment->address      = $data['address'] ?? '';
                    $payment->charge_id    = $charge->id;
                    $payment->card_token   = '';
                    $payment->receipt_url  = $charge->receipt_url;
                    $payment->total_amount = $EventAmount;
                    $payment->currency     = $charge->currency;
                    $payment->destination  = $business->stripe_connect_id;
                    $payment->destination_amount = $host_amount;
                    $payment->commission_amount  = $eventplatformFee;
                    $payment->payment_status     = 'success'; 
                    $payment->owner_answer       = '';
                    $payment->expire_date        = ''; 
                    $payment->save();
                    $event_total_amount = 0;
                    foreach ($event_booking as $key => $value) {
                        $cartamount = 0;
                        if($value->event_type == 'Paid'){
                            foreach($value->geteventticketdata as $ke => $val){
                                $amounts= number_format(((3.75 / 100) * $val->price) + 0.50 + $val->price,2)* $val->quantity;
                                $order = new OrderItem;
                                $order->order_id = $orderNo;
                                $order->product_id = $value->product_id;
                                $order->ticket_id = $val->ticket_id;
                                $order->quantity = $val->quantity;
                                $order->type = 'event';
                                $order->price = $amounts;
                                $order->save();
                                $cartamount += $val->price * $val->quantity;
                                EventAppend::where('id', $val->ticket_id)->where('event_id', $value->product_id)->decrement('ticket_quantity', $val->quantity);

                            }
                                if($key == 0){
                                    $notification = new Notification();
                                    $notification->target_id = $business->id;
                                    $notification->type = 'event';
                                    $notification->event_id = $value->product_id;
                                    $notification->message = 'You have a new Order for paid event #ORDERID00'.$orderNo;
                                    $notification->save();
                                }
                        }else{
                                $order = new OrderItem;
                                $order->order_id = $orderNo;
                                $order->product_id = $value->product_id;
                                $order->quantity = $value->quantity;
                                $order->type = 'event';
                                $order->price = '0';
                                $order->save();
                                Event::where('id', $value->product_id)->decrement('quantity', $value->quantity);
                                if($key == 0){
                                    $notification = new Notification();
                                    $notification->target_id = $business->id;
                                    $notification->type = 'event';
                                    $notification->event_id = $value->product_id;
                                    $notification->message = 'You have a new Order for free event #ORDERID00'.$orderNo;
                                    $notification->save();
                                }
                        }
                        
                        $event_total_amount += $cartamount;
                        //need to minus event quantity.
                        //Product::where('id', $value->product_id)->decrement('product_quantity', $value->quantity);
                        //PrductVariation::where('id', $value->variation_id)->decrement('quantity', $value->quantity);
                    }
                    $payment->total_amount = $event_total_amount;
                    $payment->save();
                    if(count($sessiondata['name']) > 0){
                        foreach ($sessiondata['name'] as $key1 => $value) {
                            foreach ($value as $key2 => $val) {
                                foreach ($sessiondata['name'][$key1][$key2] as $key3 => $result) {
                                    $event_booking = new EventBookingDetail;
                                    $event_booking->payment_id = $orderNo;
                                    $event_booking->event_id = $key1;
                                    $event_booking->name = $sessiondata['name'][$key1][$key2][$key3];
                                    $event_booking->email = $sessiondata['emails'][$key1][$key2][$key3];
                                    $event_booking->phone = $sessiondata['phone'][$key1][$key2][$key3];
                                    $event_booking->save();
                                    // echo $sessiondata['user_query'][$key1]."<br>";
                                }
                            }
                        }
                    }
                    
                    DB::commit();
                    
                }
 
                $mailchimpuser = array(
                    "email_address" => $data['email'],
                    "status" => "subscribed",
                    "merge_fields" => array(
                        "FNAME"=> $data['user_name'],
                        "PHONE"=> $data['phone_number'],
                    )
                );
                $this->MailChimpUserstore($mailchimpuser,$business->slug);
                $cartdata = Cart::where('session_id', Session::getId())->pluck('id');
                CartEventTicket::whereIn('cart_id',$cartdata)->delete();
                Cart::where('session_id', Session::getId())->delete();
                Session::forget('my_array');
                $Event_id = OrderItem::where('order_id',$orderNo)->where('type','event')->pluck('product_id');
                $ticket_id = OrderItem::where('order_id',$orderNo)->where('type','event')->pluck('ticket_id');
                $bookingevents = Event::with(['geteventTicket' => function($query) use ($ticket_id) {
                    $query->whereIn('id', $ticket_id);
                }])->whereIn('id', $Event_id)->get();

                $data['orderdata'] = OrderItem::where('order_id',$orderNo)->where('type','product')->get();
                $data['ordereventdata'] = $bookingevents;
                $data['orderId'] = $payment->id;
                $data['orderDate'] = $payment->created_at;
                $data['business_name'] = $business->full_name;
                $data['business_email'] = $business->email;
                $data['business_phone'] = $business->phone_number;
                $data['business_country_code'] = $business->country_code;
                $data['quanitiy'] = OrderItem::where('order_id',$orderNo)->where('type','event')->get();
                //$totalamount = Payment::where('booking_id',$orderNo)->first();
                $data['totalamount'] = Payment::where('booking_id',$orderNo)->sum('total_amount');
                $data['commission_amount'] = Payment::where('booking_id',$orderNo)->sum('commission_amount');
                $data['destination_amount'] = Payment::where('booking_id',$orderNo)->first();
                
                Mail::to($data['email'])->send(new UserSendEmailProductInvoice($data));
                return response()->json( [ 'success' => 'Payment completed successfully!' ] );

            }
            else{
                return response()->json( [ 'errors' => $charge->failure_message ] );

             //   return redirect()->back()->withError($charge->failure_message);
            }
        } catch (\Throwable $e) {
           
            DB::rollback();
            return response()->json( [ 'errors' => $e->getMessage() ] );

            // return redirect()->back()->withError('Payment failed! '.$e->getMessage());
        }
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $guardians = Session::get('guardians');
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'card_token' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json( [ 'errors' => $validator->errors() ] );
            
           // return back()->withInput()->withError($validator->getMessageBag()->first());
        }
        try{
            DB::beginTransaction();
            $booking_id = $request->booking_id;
            $token = $request->card_token;
            if($request->type== 'membership'){
                $booking = MembershipPlan::where('id', $booking_id)->first();
                $currentdate = Carbon::now();
                if ($booking->plan_terms == 'monthly') {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, 1);
                } elseif ($booking->plan_terms == 'quarterly') {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, 3);
                } elseif ($booking->plan_terms == 'half yearly') {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, 6);
                } elseif ($booking->plan_terms == 'annually') {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, 12);
                } else {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, $booking->custome_month);
                }
                $business = User::where('id',$booking->business_id)->first();
                //======================end check booking availability ==================//
                if($booking->discount == 0){
                    $platformFee = ((3.75 / 100) * $booking->price) + 0.50;
                    $host_amount = round($booking->price + $platformFee,2);
                }else{
                    $platformFee = ((3.75 / 100) * $booking->fixed_amount) + 0.50;
                    $host_amount = round($booking->fixed_amount + $platformFee,2);
                }

                $finalhostamount = round($host_amount,2);
                $finalplatformFee = round($platformFee,2);
                $transferAmount = round(($finalhostamount-$finalplatformFee)*100);
                
                $booking_name = $booking->name;
                $curl = new \Stripe\HttpClient\CurlClient();
                $curl->setEnablePersistentConnections(false);
                \Stripe\ApiRequestor::setHttpClient($curl);
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $card = \Stripe\Customer::createSource(
                    $data['customer_id'],
                    [
                        'source' => $token,
                    ]
                );
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                $charge = $stripe->charges->create([
                    'amount' => $host_amount * 100, // The amount to charge in cents
                    'currency' => env('CURRENCY'), // Currency code, e.g., 'usd'
                    'customer' => $data['customer_id'], // Customer ID for the payment
                    'description' => '', // Description for the charge
                    'capture' => true, // Whether to immediately capture the charge
                    'transfer_data' => ['destination' => $business->stripe_connect_id, 'amount' => $transferAmount], // Transfer data for connected accounts
                ]);
                $type = "membership";
            
            }else{
                $booking = Facility::where('id', $booking_id)->first();
                $ExpiryDate = "";
                $business = User::where('id',$booking->business_id)->first();
                //======================end check booking availability ==================//
                $platformFee = ((3.75 / 100) * $booking->price) + 0.50;
                $host_amount = round($booking->price + $platformFee,2);
                
                $finalplatformFee = round($platformFee,2);
                $transferAmount = round(($host_amount-$finalplatformFee)*100);
                
                $booking_name = $booking->name;
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                $charge = $stripe->charges->create([
                    'amount' => $host_amount * 100, // The amount to charge in cents
                    'currency' => env('CURRENCY'), // Currency code, e.g., 'usd'
                    'source' => $token, // Customer ID for the payment
                    'description' => '', // Description for the charge
                    'capture' => true, // Whether to immediately capture the charge
                    'transfer_data' => ['destination' => $business->stripe_connect_id, 'amount' => $transferAmount], // Transfer data for connected accounts
                ]);
                $type = "facility";
            }
            
            if($charge->paid == true && $charge->status == 'succeeded'){
                $payment = new Payment();
                $payment->booking_id = $booking->id ?? '';
                $payment->user_name = $data['user_name'];
                $payment->type = $request->type;
                $payment->user_email = $data['email'];
                $payment->phone_number = $data['phone_number'];
                $payment->address = $data['address'] ?? '';
                $payment->charge_id = $charge->id;
                $payment->card_token = $data['customer_id'];
                $payment->receipt_url = $charge->receipt_url;
                $payment->total_amount = $booking->price;
                $payment->currency = $charge->currency;
                $payment->destination = $business->stripe_connect_id;
                $payment->destination_amount = $host_amount;
                $payment->commission_amount = $platformFee;
                $payment->payment_status = 'success'; 
                $payment->owner_answer = $data['ans'] ?? '';
                $payment->expire_date = $ExpiryDate; 
                $payment->save();
                
                if($type == 'membership'){
                    $data['orderId'] = $payment->id;
                    $data['orderDate'] = $payment->created_at;
                    $data['business_name'] = $business->full_name;
                    $data['business_email'] = $business->email;
                    $data['business_phone'] = $business->phone_number;
                    $data['business_country_code'] = $business->country_code;
                    $data['booking'] = $booking;
                    if($booking->discount == 0){
                        $totalamount = $booking->price;
                        $platformfee = (3.75 / 100) * $booking->price + 0.50;
                    }else{
                        $totalamount = $booking->fixed_amount;
                        $platformfee = (3.75 / 100) * $booking->fixed_amount + 0.50;
                    }
                    $data['totalamount'] = $totalamount;
                    $data['platformfee'] = $platformfee;
                    $data['finalamount'] = $totalamount + $platformfee;
                    $peoplename = explode(",", $data['name']);
                    $peoplephone = explode(",", $data['phone']);
                    $peopleemail = explode(",", $data['people_email']);
                    
                    foreach ($peoplename as $key => $value) {
                        $people = new MembershipPeople();
                        $people->payment_id = $payment->id;
                        $people->name = $value;
                        $people->phone = $peoplephone[$key];
                        $people->email = $peopleemail[$key];
                        $people->save();
                    }
                    if($guardians['check_age'] == '1'){
                        $guadians = new MembershipGuardiansDetail();
                        $guadians->payment_id = $payment->id;
                        $guadians->name = $guardians['parent_name'];
                        $guadians->email = $guardians['parent_email'];
                        $guadians->phone_number = $guardians['parent_phone_number'];
                        $guadians->save();
                    }

                    $notification = new Notification();
                    $notification->target_id = $business->id;
                    $notification->type = 'membership';
                    $notification->message = 'You have a new Order for paid membership #ORDERID00'.$payment->id;
                    $notification->save();
                    
                    $data['members'] = MembershipPeople::where('payment_id',$payment->id)->get();
                    $data['guardians'] = MembershipGuardiansDetail::where('payment_id',$payment->id)->first();

                    Mail::to($data['email'])->send(new UserSendEmailInvoice($data));
                    Session::forget('guardians');

                }else{
                    $data['orderId'] = $payment->id;
                    $data['orderDate'] = $payment->created_at;
                    $data['business_name'] = $business->full_name;
                    $data['business_email'] = $business->email;
                    $data['business_phone'] = $business->phone_number;
                    $data['business_country_code'] = $business->country_code;
                    $data['booking'] = $booking;
                    $data['totalamount'] = $booking->price;
                    $data['platformfee'] = (3.75 / 100) * $booking->price + 0.50;
                    $data['finalamount'] = $data['totalamount'] + $data['platformfee'];
                    $notification = new Notification();
                    $notification->target_id = $business->id;
                    $notification->type = 'facility';
                    $notification->message = 'You have a new Order for facility #ORDERID00'.$payment->id;
                    $notification->save();
                    
                    Mail::to($data['email'])->send(new UserSendEmailFacilityInvoice($data));
                }
                
                DB::commit();

                $mailchimpuser = array(
                    "email_address" => $data['email'],
                    "status" => "subscribed",
                    "merge_fields" => array(
                        "FNAME"=> $data['user_name'],
                        "PHONE"=> $data['phone_number'],
                    )
                );
                $this->MailChimpUserstore($mailchimpuser,$business->slug);
                return response()->json( [ 'success' => 'Payment completed successfully!' ] );

            }
            else{
                return response()->json( [ 'errors' => $charge->failure_message ] );

               // return redirect()->back()->withError($charge->failure_message);
            }

        }
        catch(CardException $e){
            DB::rollback();
            return response()->json( [ 'errors' => $e->getMessage() ] );

           // return redirect()->back()->withError('Payment failed! '.$e->getMessage());
        }
        catch(Exception $e){
            DB::rollback();
            return response()->json( [ 'errors' => $e->getMessage() ] );

           // return redirect()->back()->withError('Payment failed! '.$e->getMessage());
        }
    }

    public function ThankYou($businessSlug){
        try{
            return view('web.company-poratal.thank-you',compact('businessSlug'));

        }catch(Exception $e){
            return back()->withError('Payment failed! '.$e->getMessage());
        }
    }


    public function MembershipRenew(){
        try{
            $currentDate = Carbon::now();
            $data = Payment::where('autorenew','1')->where('expire_date', '<', $currentDate)->get();

            foreach ($data as $key => $value) {
                if($value->card_token){
                    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                    $charge =  $stripe->charges->create([
                        'amount' => $value->destination_amount*100,
                        'currency' => env('CURRENCY'),
                        'customer' => $value->card_token,
                        'description' => '', // Description for the charge
                        'capture' => true,
                        'transfer_data' => ['destination' => $value->destination, 'amount' => $value->total_amount * 100], // Transfer data for connected accounts
    
                    ]);
                }
                    
                $booking = MembershipPlan::where('id', $value->booking_id)->first();
                $currentdate = Carbon::now();
                if ($booking->plan_terms == 'monthly') {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, 1);
                } elseif ($booking->plan_terms == 'quarterly') {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, 3);
                } elseif ($booking->plan_terms == 'half yearly') {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, 6);
                } elseif ($booking->plan_terms == 'annually') {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, 12);
                } else {
                    $ExpiryDate = Helper::ExpirationDate($currentdate, $booking->custome_month);
                }
                Payment::where('card_token', $value->card_token)->update(['expire_date' => $ExpiryDate]);
                
            }
        }catch(Exception $e){
            return back()->withError('Payment failed! '.$e->getMessage());
        }
    }


    public function MailChimpUserstore($mailchimpuser,$businessSlug){

        $business = User::where('slug',$businessSlug)->first();
        $mailchipdata = MailchimpKey::where('business_id',$business->id)->first();

        if(!empty($mailchipdata->prifixed_value)){
            $ch = curl_init('https://'.$mailchipdata->prifixed_value.'.api.mailchimp.com/3.0/lists/'.$mailchipdata->audience_id.'/members/');
            curl_setopt_array($ch, array(
                CURLOPT_POST => TRUE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: apikey '.$mailchipdata->key,
                    'Content-Type: application/json'
                ),
                CURLOPT_POSTFIELDS => json_encode($mailchimpuser)
            ));
            $response = curl_exec($ch);
        }
    }
}
