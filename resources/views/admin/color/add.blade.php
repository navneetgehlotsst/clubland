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
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-6 page-title-box">
                                                <div class="title-left">
                                                    <h4>Color Add</h4>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="{{route('color_page')}}" class="btn" style="float: right; color: #fff; background-color: #2fb473; border-color: #2fb473;">
                                                Color List
                                                </a>
                                            </div>
                                        </div>
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
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="profile_detail_holder">
                    <div class="profile_detail_blk">
                    <form action="{{route('color_store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="projectname">name</label>
                                                    <input type="text" class="form-control" value="{{old('name')}}" name="name" placeholder="Enter name">
                                                    @if($errors->has('name'))
                                                    <div class="error">{{ $errors->first('name') }}</div>
                                                @endif
                                                </div>
                                               
                                            </div>
                                            <div class="col-xl-6">
                                                &nbsp;
                                            </div>
                                            
                                           
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="projectname">Color</label>
                                                    <input type="color" class="form-control form-control-color" id="colorfield" name="color">
                                                    @if($errors->has('color'))
                                                    <div class="error">{{ $errors->first('color') }}</div>
                                                @endif
                                                </div>
                                               
                                            </div>
                                            <div class="col-xl-6">
                                                &nbsp;
                                            </div>
                                            
                                            <div class="col-xl-5">
                                                
                                                    <input type="submit" value="Submit" class="btn" style="color: #fff; background-color: #2fb473; border-color: #2fb473;">
                                                
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
        </div>
      </div>
      <!-- end card-->
    </div>
    <!-- end col-->
  </div>
  <!-- end row-->
</div>
<!-- container --> @endsection