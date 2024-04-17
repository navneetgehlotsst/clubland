<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use File;
class CmsController extends Controller
{
    public function Index(){
        try {
            $data = Page::get();
            return view('admin.cms.index',compact('data'));
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
    }

    public function view($id){
        try {
            $data = Page::where('id',$id)->first();
            return view('admin.cms.view',compact('data'));
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
    }
    public function edit($id){
        try {
            $data = Page::where('id',$id)->first();
            return view('admin.cms.edit',compact('data'));
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
    }
    public function update(Request $request,$id){
        try {
           
            $cms = Page::find($id);
            $cms->name = $request->name;
            $cms->content = $request->content;

            if($request->hasFile('image'))
            {
                $destination = 'public/cms/' . $cms->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time(). '.' . $extension;
                $file->move('public/cms/', $filename);
                $cms->image = $filename;
            }
            $cms->update();
            return redirect()->route('cms_page')->withInput()->withSuccess("Cms Updated Successfully.");
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
    }

}
