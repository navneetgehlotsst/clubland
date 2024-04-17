<?php



namespace App\Http\Controllers\web;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Str;

use App\Models\{User,Facility,FacilityImage,Payment};

use Mail,Hash,File,Http,DB,Auth,Session,Stripe;

use Carbon\Carbon;

use Illuminate\Validation\Rule;



class FacilityController extends Controller

{



//Start Facility Moduel//    



    public function AllFacility(){

        try {

            $data = Facility::where('business_id',auth()->user()->id)->orderBy('id','DESC')->paginate(6);

            return view('web.dashboard.facility',compact('data'));

        } catch (\Throwable $e) {

            return back()->withInput()->withError("something went wrong");

        }

    }



    public function AddFacility(){

        try {

            $data ="";

            return view('web.dashboard.add-facility',compact('data'));

        } catch (\Throwable $e) {

            return back()->withInput()->withError("something went wrong");

        }

    }



    public function FacilityStore(Request $request){

        $data = $request->all();

        $request->validate([

            'name' => [

                'required',

                Rule::unique('facilities', 'name')->where('business_id', auth()->user()->id),

            ],

            'price' => 'required|numeric|min:0.01',

            'start_hours' => 'required',

            'end_hours' => 'required',

            'location' => 'required',

          //  'terms' => 'required',

        //    'description'  => 'required',

            'sort_description'  => 'required',

        ]);

        try {

            // $startDateTime = Carbon::createFromFormat('H:i d/m/Y', $data['start_hours']);

            // $start = $startDateTime->format('Y-m-d H:i');

            // $endDateTime = Carbon::createFromFormat('H:i d/m/Y', $data['end_hours']);

            // $end = $endDateTime->format('Y-m-d H:i');



         

            $start = Carbon::parse($data['start_hours'])->toDatetimeString();

          // dd($stratdate);

            $end = Carbon::parse($data['end_hours'])->toDatetimeString();



            $facility              = new Facility;

            $facility->business_id = auth()->user()->id;

            $facility->name        = $data['name'];

            $facility->price       = $data['price'];

            $facility->start_hours = $start;

            $facility->end_hours   = $end;

            $facility->location    = $data['location'];

            $facility->terms       = $data['terms'];

            $facility->description = $data['description'];

            $facility->sort_description = $data['sort_description'];



            $facility->lat         = $data['description'];

            $facility->long        = $data['description'];

            $facility->save();

            $facility_images = $request->file('image');



            if ($request->hasFile('image')) {



                foreach($facility_images as $facility_image) {



                    $name = md5(time().rand(11111111,99999999)).'.'.$facility_image->getClientOriginalExtension();



                    $facility_image->move('facility_image/', $name);



                    $car_img['facility_id'] = $facility->id;



                    $car_img['image'] = $name;



                    $auction_image = FacilityImage::create($car_img);



                }



            }

            return redirect()->route('all_facility')->withSuccess('Facility Added Successfully!.');

        } catch (\Throwable $e) {

            return back()->withInput()->withError("something went wrong");

        }

    }



    public function FacilityEdit(Request $request,$id){

        try {

            $data = Facility::with('getfacilityImage')->where('id',$id)->first();

            return view('web.dashboard.add-facility',compact('data'));



        } catch (\Throwable $e) {

            return back()->withInput()->withError("something went wrong");

        }

    }

    public function FacilityUpdate(Request $request,$id){

        $data = $request->all();
       // dd($data);
        $request->validate([

            'name' => [

                'required',

                Rule::unique('facilities', 'name')

            ->where('business_id', auth()->user()->id)

            ->ignore($id),

            ],

            'price' => 'required|numeric|min:0.01',

            'start_hours' => 'required',

            'end_hours' => 'required',

            'location' => 'required',

            //'terms' => 'required',

           // 'description'  => 'required',

            "sort_description"=>"required"

        ]);

        try {

            // $startDateTime = Carbon::createFromFormat('H:i d/m/Y', $data['start_hours']);

            // $start = $startDateTime->format('Y-m-d H:i');

            // $endDateTime = Carbon::createFromFormat('H:i d/m/Y', $data['end_hours']);

            // $end = $endDateTime->format('Y-m-d H:i');

            

            $start = Carbon::parse($data['start_hours'])->toDatetimeString();

            $end = Carbon::parse($data['end_hours'])->toDatetimeString();

  



            $facility              = Facility::where('id',$id)->first();

            $facility->name        = $data['name'];

            $facility->business_id = auth()->user()->id;

            $facility->price       = $data['price'];

            $facility->start_hours = $start;

            $facility->end_hours   = $end;

            $facility->location    = $data['location'];

            $facility->terms       = $data['terms'];

            $facility->sort_description = $data['sort_description'];

            $facility->description = $data['description'];

            $facility->lat         = $data['description'];

            $facility->long        = $data['description'];

            $facility->update();

            $facility_images = $request->file('image');



            if ($request->hasFile('image')) {



                FacilityImage::where('facility_id',$id)->delete();

              

                foreach($facility_images as $facility_image) {

                    $name = md5(time().rand(11111111,99999999)).'.'.$facility_image->getClientOriginalExtension();

                    $facility_image->move('facility_image/', $name);

                    $facility_image = FacilityImage::updateOrCreate([

                      'facility_id' => $id,

                      'image' => $name,

                  ]);

                }

            }

            return redirect()->route('all_facility')->withSuccess('Facility updated successfully!.');

        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");

        }

    }



    public function facilityRemove(Request $request){

        try {

         
            $delete = Facility::destroy($request->facility_id);
 
            if ($delete == 1) {

                $message = "Facility deleted successfully.";

            } else {

                $message = "Facility not found.";

            }

        return redirect()->route('all_facility')->withSuccess($message);

        } catch (\Throwable $e) {

            return back()->withInput()->withError("something went wrong");



        }

    }



    public function FacilityHistory(){

        try {
            // $data = Payment::where('type','facility')->where('destination',Auth::user()->stripe_connect_id)->paginate(6);
            $data = Payment::with(['getFacility' => function ($q) {
                $q->withTrashed();
            }])
            ->where('type', 'facility')
            ->where('destination', Auth::user()->stripe_connect_id)
            ->orderBy('id','DESC')
            ->paginate(6);
            return view('web.dashboard.facility-history',compact('data'));
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");

        }

    }

    public function FacilityHistoryDetails(Request $request,$id){
        try {
            $data = Payment::where('type','facility')->where('id',$request->id)->first();
            return view('web.dashboard.facility-history-details',compact('data'));
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");
        }
    }

//End Facility Moduel//



}

