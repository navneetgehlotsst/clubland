<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClubType;
use File;
class BusinessClubTypeController extends Controller
{
    public function Index(){
        try {
            $data = ClubType::orderBy('id','DESC')->get();
            return view('admin.business-club-type.index',compact('data'));
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    
    public function Add(){
        try {
            return view('admin.business-club-type.add');
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    
    public function Store(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);
        try {
            $clubtype = new ClubType;
            $clubtype->name = $request->name;
            $clubtype->save();
            return redirect()->route('clubtype_page')->withInput()->withSuccess("Club type added Successfully.");

        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function view($id){
        try {
            $data = ClubType::where('id',$id)->first();
            return view('admin.business-club-type.view',compact('data'));
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function edit($id){
        try {
            $data = ClubType::where('id',$id)->first();
            return view('admin.business-club-type.edit',compact('data'));
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function update(Request $request,$id){
        $this->validate($request, [
            'name' => 'required',
        ]);
        try {
            $clubtype = ClubType::find($id);
            $clubtype->name = $request->name;
            $clubtype->update();
            return redirect()->route('clubtype_page')->withInput()->withSuccess("Club type updated successfully.");
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function Delete(Request $request){
        try {
            $delete = ClubType::where('id',$request->id)->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Club Type deleted successfully";
            } else {
                $success = true;
                $message = "Club Type not found";
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
        $clubtype = ClubType::find($request->id);
        if (!empty($clubtype)) {
          if($clubtype->status == '0'){
            $status = '1';
          }else{
            $status = '0';

          }
          $clubtype->status = $status;
          $clubtype->save();
            return response()->json([
                'success' => true,
                'message' => "Status change successfully.",
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => "Club Type not found",
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
