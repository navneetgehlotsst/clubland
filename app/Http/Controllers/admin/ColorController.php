<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Color;
use File;
class ColorController extends Controller
{
    public function Index(){
        try {
            $data = Color::get();
            return view('admin.color.index',compact('data'));
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    
    public function Add(){
        try {
            return view('admin.color.add');
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    
    public function Store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'color' => 'required',
        ]);
        try {
            $color = new Color;
            $color->name = $request->name;
            $color->color_code = $request->color;
            $color->save();
            return redirect()->route('color_page')->withInput()->withSuccess("Color Add Successfully.");

        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function view($id){

        try {
            $data = Color::where('id',$id)->first();
            return view('admin.color.view',compact('data'));
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function edit($id){
        try {
            $data = Color::where('id',$id)->first();
            return view('admin.color.edit',compact('data'));
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function update(Request $request,$id){
        $this->validate($request, [
            'name' => 'required',
            'color' => 'required',
        ]);
        try {
            $color = Color::find($id);
            $color->name = $request->name;
            $color->color_code = $request->color;
            $color->update();
            return redirect()->route('color_page')->withInput()->withSuccess("Color Updated Successfully.");
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function Delete(Request $request){
        try {
            $delete = Color::where('id',$request->id)->delete();
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
            return $e->getMessage();
        }
    }
    

    public function changeStatus(Request $request)
    {
      try {
        $color = Color::find($request->color_id);
        if (!empty($color)) {
          if($color->status == '0'){
            $status = '1';
          }else{
            $status = '0';

          }
          $color->status = $status;
          $color->save();
            return response()->json([
                'success' => true,
                'message' => "Status change successfully.",
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => "Color not found",
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
