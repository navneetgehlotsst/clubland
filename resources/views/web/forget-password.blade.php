@extends('web.layout.master')
@section('content')
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
            <form action="{{route('forgot.password.post')}}" method="post" class="signin-form">
                @csrf
                <h2>Password Recovery</h2>
			  <p class="mb-4 theme-color">Enter the email address associated with your Clubland Service account</p>            
                <div class="form-group comments_form password-box">
                    
                <input name="email" type="email" value="" class="input form-control" id="email" placeholder="Enter register email" required="true" aria-label="password" aria-describedby="basic-addon1" />
                </div>
                <div class="header_btn search_btn login_btn jb_cover">
                <button type="submit" class="btn btn-50 w-100 d-flex align-items-center justify-content-center">Submit</button>
                </div>
                <!-- <div class="dont_have_account jb_cover">
                    <p>Already have an account? <a href="{{route('login_business')}}"> Login</a></p>
                </div> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('web.layout.faq-page')

@endsection