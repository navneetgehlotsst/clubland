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
                        <h4>{{$data->name}}</h4>
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
                     <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <div class="">
                              <div class="page-title-box">
                                <div class="title-left">
                                  <h4>Contant</h4>
                                </div>
                                <div class="title-right"></div>
                              </div>
                            </div>
                          </div>
                          <div class="card-body">
                            <div class="profile_detail_holder">
                              <div class="profile_detail_blk">
                                {!! $data->content !!}
                   
                              </div>
                            </div>
                          </div>
                        </div>
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