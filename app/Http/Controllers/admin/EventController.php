<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use File;
class EventController extends Controller
{
    public function Index(){
        try {
            $data = EventCategory::with('getBusinessName')->orderBy('id','DESC')->get();
            return view('admin.event-category.index',compact('data'));
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    
    public function Add(){
        try {
            return view('admin.event-category.add');
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    
    public function Store(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);
        try {
            $event = new EventCategory;
            $event->name = $request->name;
            $event->save();
            return redirect()->route('event_category_page')->withInput()->withSuccess("Event added Successfully.");

        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function view($id){
        try {
            $data = EventCategory::where('id',$id)->first();
            return view('admin.event-category.view',compact('data'));
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function edit($id){
        try {
            $data = EventCategory::where('id',$id)->first();
            return view('admin.event-category.edit',compact('data'));
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function update(Request $request,$id){
        $this->validate($request, [
            'name' => 'required',
        ]);
        try {
            $event = EventCategory::find($id);
            $event->name = $request->name;
            $event->update();
            return redirect()->route('event_category_page')->withInput()->withSuccess("Event updated successfully.");
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function Delete(Request $request){
        try {
            $delete = EventCategory::where('id',$request->id)->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Event deleted successfully";
            } else {
                $success = true;
                $message = "Event not found";
            }
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }
    

    public function changeStatus(Request $request)
    {
      try {
        $event = EventCategory::find($request->event_id);
        if (!empty($event)) {
          if($event->status == '0'){
            $status = '1';
          }else{
            $status = '0';

          }
          $event->status = $status;
          $event->save();
            return response()->json([
                'success' => true,
                'message' => "Status change successfully.",
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => "Event not found",
            ]);
        }
      } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ]);
      }
    }

}
