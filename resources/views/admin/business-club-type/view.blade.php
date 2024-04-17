@extends('admin.layouts.master') @section('content')
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
  <!-- end page title -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <div class="">
                    <div class="page-title-box">
                      <div class="title-left">
                        <h4>Question</h4>
                        <h5>{{$data->question}}</h5>
                        
                      </div>
                      <div class="title-right"></div>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
            <div class="col-lg-6">
                &nbsp;
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <div class="">
                    <div class="page-title-box">
                      <div class="title-left">
                        <h4>Answer</h4>
                        <h5>{{$data->answer}}</h5>
                      </div>
                      <div class="title-right"></div>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <!-- end card-body-->
        </div>
      </div>
      <!-- end card-->
    </div>
    <!-- end col-->
  </div>
  <!-- end row-->
</div>
<!-- container --> @endsection