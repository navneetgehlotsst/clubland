@extends('admin.layouts.master')
@section('content')
<style>
  .error-message{
    color:red;
  }
  </style>
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
                                    <h4 class="page-title">Change Password</h4>
                                </div>
                                <div class="card">
                                
                                    <div class="card-body">
                                        <form action="{{route('update_password')}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="old">Old Password</label>
                                                        <input type="password" id="old" class="form-control" name="old_password" placeholder="Enter the old password">
                                                        @error('old_password')
                                                            <span class="error-message">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="new">New Password</label>
                                                        <input type="password" id="new" class="form-control" name="password" placeholder="Enter the new password ">
                                                        @error('password')
                                                            <span class="error-message">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="conform">Confirm Password</label>
                                                        <input type="password" id="conform" class="form-control" name="password_confirmation" placeholder="Enter the confirm new password">
                                                        @error('password_confirmation')
                                                            <span class="error-message">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xl-2">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <input type="submit" value="Update" class="btn" style="color: #fff; background-color: #1E532E; border-color: #1E532E;">
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->

@endsection