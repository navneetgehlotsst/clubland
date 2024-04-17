@extends('admin.layouts.master') @section('content')
<style>
   .error{
   color:red;
   }
</style>
<!-- Start Content-->
<div class="container-fluid">
   <!-- start page title -->
   <div class="row">
      <div class="col-12">
         <div class="page-title-box">
            <div class="page-title-right">
               <!-- <ol class="breadcrumb m-0"><li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li><li class="breadcrumb-item active">User Details</li></ol> -->
            </div>
         </div>
      </div>
   </div>
   <div class="row">
   <div class="col-3">
         </div>
      <div class="col-6">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-sm-6 page-title-box">
                     <div class="title-left">
                        <h4>Cms Edit</h4>
                     </div>
                  </div>
                  
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end page title -->
  
      <div class="row">
         <div class="col-3">
         </div>
         <div class="col-lg-6">
            <div class="card">
               <div class="card-body">
                  <div class="profile_detail_holder">
                     <div class="profile_detail_blk">
                     <form action="{{route('cms_update',$data->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="projectname">Name</label>
                                                    <input type="text" id="projectname" class="form-control" value="{{$data->name ?? ''}}" name="name" placeholder="Enter name">

                                                </div>
                                                @if($errors->has('name'))
                                                    <div class="error">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                           
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="projectname">Content</label>
                                                   <br>
                                                    <textarea class="form-control" id="editor" name="content">{{$data->content}}</textarea>
                                                </div>
                                               
                                            </div>

                                            <div class="col-xl-5">
                                            <input type="submit" value="Update" class="btn" style="color: #fff; background-color: #1E532E; border-color: #1E532E;">
                                                  
                                                
                                            </div>
                                        </div>
                                        <!-- end row -->
                                    </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end card-body-->
   
   <!-- end row-->
</div>
<!-- container --> @endsection