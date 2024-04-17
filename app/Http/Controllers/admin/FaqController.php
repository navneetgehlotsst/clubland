<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use File;
class FaqController extends Controller
{
    public function Index(){
        try {
            $data = Faq::get();
            return view('admin.faq.index',compact('data'));
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    
    public function Add(){
        try {
            return view('admin.faq.add');
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    
    public function Store(Request $request){
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
        ]);
        try {
           
            $faq = new Faq;
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();
            return redirect()->route('faq_page')->withInput()->withSuccess("Faq Add Successfully.");

        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function view($id){
        try {
            $data = Faq::where('id',$id)->first();
            return view('admin.faq.view',compact('data'));
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function edit($id){
        try {
            $data = Faq::where('id',$id)->first();
            return view('admin.faq.edit',compact('data'));
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function update(Request $request,$id){
        try {
           
            $faq = Faq::find($id);
            $faq->question = $request->question;
            $faq->answer = $request->answer;

            
            $faq->update();
            return redirect()->route('faq_page')->withInput()->withSuccess("Faq Updated Successfully.");
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function Delete(Request $request){
        try {
            $delete = Faq::where('id',$request->id)->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Faq deleted successfully";
            } else {
                $success = true;
                $message = "Faq not found";
            }
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    

}
