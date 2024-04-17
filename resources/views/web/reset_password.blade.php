@extends('web.layout.master')
@section('content')
<style>
  .error-message{
    color:red;
    float: left;
  }
  .registrationFormAlert2{

color:red;

text-align: justify;

}
.registrationFormAlert1{

color:red;

text-align: justify;

}
  </style>
<div class="page_title_section">
  <div class="page_header">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-8 col-12 col-sm-7">
          <h1>Password Recovery</h1>
        </div>
        <div class="col-lg-3 col-md-4 col-12 col-sm-5">
          <div class="sub_title_section">
            <ul class="sub_title">
              <li> <a href="{{route('website-home')}}"> Home </a>&nbsp; / &nbsp; </li>
              <li>Password Recovery</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="login_wrapper jb_cover">
  <div class="container">
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="login_top_box jb_cover">
          <div class="login_banner_wrapper ms-log-bg">  </div>
          <div class="login_form_wrapper ms-reg signup_wrapper">
            <h2>Password Recovery</h2>
			  <p class="mb-4 theme-color">Enter to your New Password</p>            
              <form action="{{route('reset.password.post')}}"  method="post" class="signin-form">
                @csrf
            <div class="form-group comments_form password-box">
            
              <input name="password" type="password"  value="" class="input form-control" id="password" placeholder="New Password" required="true" aria-label="password" aria-describedby="basic-addon1" />
              <div class="input-group-append">
                <span class="input-group-text" onclick="password_show_hide();">
                  <i class="fas fa-eye d-none" id="hide_eye" ></i>
                  <i class="fas fa-eye-slash" id="show_eye"></i>
                </span>
              </div>
                @error('password')
                   <span class="error-message">{{$message}}</span>
                @enderror
            </div>
            <div class="registrationFormAlert1" id="divPasswordValidationResult1"></div>
            <div class="form-group comments_form password-box">
              <input name="confirmed" type="password" value="" class="input form-control" id="newpassword" placeholder="Confirm Password" required="true" aria-label="password" aria-describedby="basic-addon1" />
              <div class="input-group-append">
                <span class="input-group-text" onclick="con_password_show_hide();">
                  <i class="fas fa-eye d-none" id="con_hide_eye"></i>
                  <i class="fas fa-eye-slash" id="con_show_eye"></i>
                </span>
              </div>
                @error('confirmed')
                    <span class="error-message">{{$message}}</span>
                @enderror
            </div>
            <div class="registrationFormAlert2" id="divPasswordValidationResult2"></div>
            <div class="header_btn search_btn login_btn jb_cover"> 
            <button type="submit" id="submitdisable" class="btn btn-50 w-100 d-flex align-items-center justify-content-center">Submit</button>
            </div>
           
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('web.layout.faq-page')

@endsection