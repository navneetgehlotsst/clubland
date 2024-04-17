@extends('admin.layouts.master')
@section('content')
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                        <div class="col-3">
                        </div>
                            <div class="col-6">
                            <div class="page-title-box">
                                    
                                    <h4 class="page-title">Edit Profile</h4>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                    <form action="{{route('update_profile')}}" method="POST">
                                            @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="projectname">Name</label>
                                                    <input type="text" id="projectname" class="form-control" value="{{$data->full_name}}" name="name" placeholder="Enter Name">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="projectname">Email</label>
                                                    <input type="text" readonly id="projectname" class="form-control" value="{{$data->email}}" placeholder="Enter Email">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="projectname">Address</label>
                                                    <input type="text" id="projectname" class="form-control" name="address" value="{{$data->address}}" placeholder="Enter Address">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="projectname">Phone Number</label>
                                                    <input type="text" id="projectname" class="form-control" name="phone_number" value="{{$data->phone_number}}" placeholder="Enter Phone Number">
                                                </div>
                                            </div>
                                            <div class="col-xl-2">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <input type="submit" value="Update" class="btn" style="color: #fff; background-color: #1E532E; border-color: #1E532E;">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                    </form>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->

@endsection