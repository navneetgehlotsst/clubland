<?php

namespace App\Http\Controllers\web;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\{User,EventCategory,Event,EventAppend,Color,EventImage,Payment,OrderItem,EventBookingDetail};
use Mail,Hash,File,Http,DB,Auth,Session,Stripe;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class EventsController extends Controller
{

//Strat Event Moduel//    
    public function EventList(){
        try {
            $data= Event::where('business_id',auth()->user()->id)->orderBy('id','DESC')->paginate(5);
            return view('web.dashboard.event-list',compact('data'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function EventAdd(){
        try {
            $data="";
            $category = EventCategory::where('business_id',auth()->user()->id)->orwhere('business_id',0)->where('status','1')->orderBy('id','DESC')->get();
            return view('web.dashboard.event-add',compact('data','category'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function EventStore(Request $request){
        $data = $request->all();
     
        $request->validate([
            'name' => [
                'required',
                Rule::unique('events', 'name')->where('business_id', auth()->user()->id),
            ],
            'category_id' => 'required',
            'location' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'ticket_type' => 'required',
            'image' => 'required',
            "sort_description"=>"required"
        ]);
        try {
            // $startDateTime = Carbon::createFromFormat('H:i d/m/Y', $data['start_date']);
            // $start = $startDateTime->format('Y-m-d H:i');
            // $endDateTime = Carbon::createFromFormat('H:i d/m/Y', $data['end_date']);
            // $end = $endDateTime->format('Y-m-d H:i');

            $datestart=date_create($data['start_date']);
            $start = date_format($datestart,"Y-m-d H:i");
            $dateend=date_create($data['end_date']);
            $end =date_format($dateend,"Y-m-d H:i");
            if($data['ticket_type'] == "Free"){
                $eventQua= $data['quantity'];
            }else{
                $eventQua= "0";
            }
            if(@$data['ticket_type_check'] == "on"){
                $typeCheck = 1;
            }else {
                $typeCheck = 0;

            }

            if($data['category_id'] == 'other'){
                $event              = new EventCategory;
                $event->name        = $request->new_event_cat;
                $event->business_id = auth()->user()->id;
                $event->save();
                $eventData = $event->id;
            }else{
                $eventData = $data['category_id'];
            }
            $event = new Event;
            $event->business_id       = auth()->user()->id;
            $event->name              = $data['name'];
            $event->category_id       = $eventData;
            $event->location          = $data['location'];
            $event->start_date        = $start;
            $event->end_date          = $end;
            $event->ticket_type       = $data['ticket_type'];
            $event->quantity          = $eventQua;
            $event->ticket_type_check = $typeCheck;
            $event->sort_description = $data['sort_description'];
            $event->event_description = $data['event_description'];
            $event->term_condition    = $data['term_condition'];
            $event->save();

            $event_images = $request->file('image');

            if ($request->hasFile('image')) {

                foreach($event_images as $event_image) {

                    $name = md5(time().rand(11111111,99999999)).'.'.$event_image->getClientOriginalExtension();

                    $event_image->move('event_image/', $name);

                    $event_img['event_id'] = $event->id;

                    $event_img['image'] = $name;

                    $auction_image = EventImage::create($event_img);

                }

            }

            if($data['ticket_type'] == "Paid"){
                foreach ($data['ticket_name'] as $keys => $val) {
                    $eventAppend                  = new EventAppend;
                    $eventAppend->event_id        = $event->id;
                    $eventAppend->ticket_name     = $data['ticket_name'][$keys];
                    $eventAppend->ticket_cost     = $data['ticket_cost'][$keys];
                    $eventAppend->ticket_quantity = $data['ticket_quantity'][$keys];
                    $eventAppend->save();
                }
            }
            return redirect()->route('event_list')->withSuccess('Event Added Successfully!.');
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function EventEdit(Request $request,$slug){
        try {
            $data = Event::where('id',$slug)->first();

            $category = EventCategory::where('business_id',auth()->user()->id)->orwhere('business_id',0)->where('status','1')->orderBy('id','DESC')->get();
            return view('web.dashboard.edit-event',compact('data','category'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }


    public function EventUpdate(Request $request,$slug){
        $data = $request->all();
        $request->validate([
            "name" => [
                'required',
                Rule::unique('events', 'name')
            ->where('business_id', auth()->user()->id)
            ->ignore($slug),
            ],
            "category_id" => "required",
            "location" => "required",
            "start_date" => "required",
            "end_date" => "required",
            "ticket_type" => "required",
            "sort_description"=>"required"
        ]);
        try {
            // $startDateTime = Carbon::createFromFormat('H:i d/m/Y', $data['start_date']);
            // $start = $startDateTime->format('Y-m-d H:i');
            // $endDateTime = Carbon::createFromFormat('H:i d/m/Y', $data['end_date']);
            // $end = $endDateTime->format('Y-m-d H:i');

            $datestart=date_create($data['start_date']);
            $start = date_format($datestart,"Y-m-d H:i");
            $dateend=date_create($data['end_date']);
            $end =date_format($dateend,"Y-m-d H:i");
            if($data['ticket_type'] == "Free"){
                $eventQua= $data['quantity'];
            }else{
                $eventQua= "0";
            }
            if(@$data['ticket_type_check'] == "on"){
                $typeCheck = 1;
            }else {
                $typeCheck = 0;

            }

            if($data['category_id'] == 'other'){
                $event              = new EventCategory;
                $event->name        = $request->new_event_cat;
                $event->business_id = auth()->user()->id;
                $event->save();
                $eventData = $event->id;
            }else{
                $eventData = $data['category_id'];
            }
            $event = Event::where('id',$slug)->first();
            $event->business_id       = auth()->user()->id;
            $event->name              = $data['name'];
            $event->category_id       = $eventData;
            $event->location          = $data['location'];
            $event->start_date        = $start;
            $event->end_date          = $end;
            $event->ticket_type       = $data['ticket_type'];
            $event->quantity          = $eventQua;
            $event->ticket_type_check = $typeCheck;
            $event->event_description = $data['event_description'];
            $event->sort_description = $data['sort_description'];
            $event->term_condition    = $data['term_condition'];
            $event->save();

            if($data['ticket_type'] == "Paid"){
                //EventAppend::where('event_id',$event->id)->delete();
                foreach ($data['ticket_name'] as $keys => $val) {

                    if(!empty($data['ticket_id'][$keys])){
                        EventAppend::where('id', $data['ticket_id'][$keys])
                        ->where('event_id', $event->id)
                        ->update([
                            'ticket_name' => $val,
                            'ticket_cost' => $data['ticket_cost'][$keys],
                            'ticket_quantity' => $data['ticket_quantity'][$keys],
                        ]);
                    }else{
                     
                        EventAppend::create([
                            'event_id' => $event->id,
                            'ticket_name' => $val,
                            'ticket_cost' => $data['ticket_cost'][$keys],
                            'ticket_quantity' => $data['ticket_quantity'][$keys],
                        ]);
                    }
              
                }
               
            }
            $event_images = $request->file('image');

            if ($request->hasFile('image')) {

                $id = event::where('slug',$slug)->first();
                EventImage::where('event_id',$id->id)->delete();
              
                foreach($event_images as $event_image) {
                    $name = md5(time().rand(11111111,99999999)).'.'.$event_image->getClientOriginalExtension();
                    $event_image->move('event_image/', $name);
                    $event_image = EventImage::updateOrCreate([
                      'event_id' => $id->id,
                      'image' => $name,
                  ]);
                }
            }
            return redirect()->route('event_list')->withSuccess('Event Updated Successfully!.');
        } catch (\Throwable $e) {
            dd($e);
            return back()->withInput()->withError("something went wrong");
        }
    }


    public function EventRemove(Request $request){
        try {

            $delete = Event::destroy($request->event_id);
            if ($delete == 1) {
                EventAppend::where('event_id',$request->event_id)->delete();
                $message = "Event deleted successfully.";
            } else {
                $message = "Event not found.";
            }
        return redirect()->route('event_list')->withSuccess($message);
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");

        }
    }
    
    public function EventTicketRemove(Request $request){
        try {
            $delete = EventAppend::where('id',$request->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Event ticket remove Successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
    public function EventTicketList(Request $request){
        try {
            $data = Payment::where('type', 'event')
            ->where('destination', Auth::user()->stripe_connect_id)->orderBy('id','DESC')
            ->paginate(12);
            return view('web.dashboard.event-ticket-list',compact('data'));

        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function EventHistoryDetails(Request $request,$id){
        try {
            $data = Payment::where('type', 'event')
            ->where('destination', Auth::user()->stripe_connect_id)
            ->where('id',$id)->first();

            if($data->booking_id == "0"){
                $Event_id = OrderItem::where('order_id',$data->id)->pluck('product_id');
                $eventdata = Event::whereIn('id', $Event_id)->get();
                $type = "Free";
                $quanitiy = OrderItem::where('order_id',$data->id)->where('type','event')->get();
                $totalamount = 0;
                $eventuserdetails=EventBookingDetail::where('payment_id',$data->booking_id)->get();
            }else{
                $Event_id = OrderItem::where('order_id',$data->booking_id)->where('type','event')->pluck('product_id');
                $ticket_id = OrderItem::where('order_id',$data->booking_id)->where('type','event')->pluck('ticket_id');
                $eventdata = Event::with(['geteventTicket' => function($query) use ($ticket_id) {
                    $query->whereIn('id', $ticket_id);
                }])->whereIn('id', $Event_id)->get();
                $type = "Paid";
                $quanitiy = OrderItem::where('order_id',$data->booking_id)->where('type','event')->get();
                $totalamount = $quanitiy->sum('price');
                $eventuserdetails = EventBookingDetail::where('payment_id',$data->booking_id)->get();
            }
          return view('web.dashboard.event-history-details',compact('data','eventdata','type','quanitiy','totalamount','eventuserdetails'));
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function BusinessCatAdd(Request $request){
        $this->validate($request, [
            'new_cat' => 'required',
        ]);
        try {
            $event              = new EventCategory;
            $event->name        = $request->new_cat;
            $event->business_id = auth()->user()->id;
            $event->save();
            $category = EventCategory::where('business_id', auth()->user()->id)
                ->orWhere('business_id', 0)->orderBy('id','DESC')
                ->get();
            // dd($category);
            $html = '';
            foreach ($category as $val) {
                $html .= '<option value="' . $val->id . '" ' . (old('category_id') == $val->id ? 'selected' : '') . '>' . ucfirst($val->name) . '</option>';
            }
            $html .= '<option value="other">Other</option>';
            return response()->json([
                'success' => true,
                'message' => 'Event Add Successfully',
                'data'    => $html
            ]);
            
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
//End Event Moduel//    
}
