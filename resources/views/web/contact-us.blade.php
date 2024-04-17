@extends('web.layout.master')
@section('content')
<div class="blog_wrapper pb-3 jb_cover">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12"></div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="blog_newsleeter jb_cover">
                    <!-- <div class="animation-circle-inverse"><i></i><i></i><i></i></div> -->
                    <form action="{{route('contact_us_store')}}" method="post">
                        @csrf
                        <h1>CONTACT US</h1>
                        <div class="form-group blog_letter">
                            <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Enter Your Name" required>
                            @error('name')
                            <span class="text-danger" style="float: left;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group blog_letter">
                            <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="Enter Your Email" required>
                            @error('email')
                            <span class="text-danger" style="float: left;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group blog_letter" style="padding-bottom: 15px;">
                            <textarea class="form-control" name="content" class="form-control" placeholder="Your message" required>{{old('content')}}</textarea>
                            @error('content')
                            <span class="text-danger" style="float: left;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_SITEKEY')}}" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                            <input class="form-control d-none" name="captcha" data-recaptcha="true">
                            @error('g-recaptcha-response')
                            <span class="text-danger" style="float: left;">Please Complete the Recaptcha to proceed</span>
                            @enderror
                        </div>
                    
                        <div class="header_btn search_btn submit_btn jb_cover mt-2">
                            <button type="submit" class="submit_btn btn btn-50 w-100 d-flex align-items-center justify-content-center" style="width: 100%;background: #d97333;border: 1px solid #d97333;">submit</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection