@extends('web.layout.master')
@section('content')
<style>
  .error-message{
    color:red;
  }


.registrationFormAlert2{

color:red;

text-align: justify;

}
.registrationFormAlert1{

color:red;

text-align: justify;

} </style>
  <!-- Title Section Start -->
  <div class="page_title_section dashbord_title">
    <div class="page_header">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-8 col-12 col-sm-7 align-items-center d-flex">
            <div class="left_menu_icon" id="left_menu_icon"></div>
            <h1>Dashboard</h1>
          </div>
          <div class="col-lg-3 col-md-4 col-12 col-sm-5">
            <div class="sub_title_section">
              <ul class="sub_title">
                <li> <a href="{{route('website-home')}}"> Home </a>&nbsp; / &nbsp; </li>
                <li>Change Password</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Title Section End -->
  <!-- Dashboard Inner Content Section Start -->
  <section class="dashboard_inner_content">
    <div class="container">
      <div class="row">
        @include('web.layout.sidebar')
        <div class="col-xl-9 col-lg-8">
            <div class="right_menu">
            <div class="feature_box d-block border-bottom-0">
                <div class="title_div d-flex align-items-center justify-content-between">
                <div class="titile_content">
                    <h2 class="border_bottom mb-0">Change Password</h2>
                </div>
                </div>
            </div>
            <form class="dashboard_form" action="{{route('business_update_password')}}" method="post">
                @csrf
                <div class="feature_box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group comments_form">
                                <label class="form-label">Old Password</label>
                                <input type="password" class="form-control" name="old_password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Old password">
                                @error('old_password')
                                    <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>
                          
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group comments_form">
                                <label class="form-label">New Password</label>
                                <input type="password" id="newpassword" class="form-control" name="password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="New password">
                                @error('password')
                                    <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="registrationFormAlert2" id="divPasswordValidationResult2"></div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group comments_form">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" id="password" class="form-control" name="password_confirmation" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Confirm password">
                                @error('password_confirmation')
                                    <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="registrationFormAlert1" id="divPasswordValidationResult1"></div>

                        </div>
                        <div class="col-lg-12">
                            <div class="button_div float-end mt-30"><button type="submit" class="btn btn-50">
                                Save Password</button>
                            </div>
                        </div>
                    </div>
                </div>            
            </form>
            </div>
        </div>
    </div>
  </section>
  <!-- Dashboard Inner Content Section End -->
  @endsection