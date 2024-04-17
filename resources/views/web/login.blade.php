@extends('web.layout.master')
@section('content')
<div class="page_title_section">
  <div class="page_header">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-8 col-12 col-sm-7">
          <h1>Login</h1>
        </div>
        <div class="col-lg-3 col-md-4 col-12 col-sm-5">
          <div class="sub_title_section">
            <ul class="sub_title">
              <li> <a href="{{route('website-home')}}"> Home </a>&nbsp; / &nbsp; </li>
              <li>Login</li>
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
            <h2>Login</h2>
            <p class="mb-4 theme-color">Enter to your Clubland Service account</p>
            <form action="{{route('businessLogin')}}" method="post">
                @csrf
                <div class="form-group  comments_form">
                  <input type="email" class="form-control require" value="{{old('email')}}" name="email" placeholder="Registered email address">
                  @if ($errors->has('email'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('email') }}</span>
                  @endif
                  </div>
                
             
                  <div class="form-group comments_form password-box">
                    <input name="password" type="password" value="" class="input form-control" id="password" placeholder="Password" required="true" aria-label="password" aria-describedby="basic-addon1" />
                    <div class="input-group-append">
                      <span class="input-group-text" onclick="password_show_hide();">
                        <i class="fas fa-eye d-none" id="hide_eye"></i>
                        <i class="fas fa-eye-slash " id="show_eye" ></i>
                      </span>
                    </div>

                    
                    @if ($errors->has('password'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('password') }}</span>
                  @endif
                  </div>
                <div class="login_remember_box  d-flex justify-content-between">
                  <label class="control control--checkbox mt-1">Remember Me  
                    <input type="checkbox">
                    <span class="control__indicator"></span> </label>
                    <div class="text-end"><a href="{{route('forget_password')}}" class="pl-3">Forgot Password?</a> </div>
                  </div>
                <div class="header_btn search_btn login_btn jb_cover"> 
                <button type="submit" class="btn btn-50 w-100 d-flex align-items-center justify-content-center">Login</button>
                </div>
                
            </form>
            <div class="dont_have_account jb_cover">
              <p>Don't have an account?  <a href="{{route('business_register')}}">Register</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('web.layout.faq-page')

@endsection