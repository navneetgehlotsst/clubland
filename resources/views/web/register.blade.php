@extends('web.layout.master') @section('content')
<style>
    .nice-select.form-control{
    display: none;
    }
    select.form-control.w-100 {
    display: block !important;
    }
    .registrationFormAlert1{
    color:red;
    text-align: justify;
    }
    .form-select {
    padding: 5px 23px;
    }
    .hide {
    display: none;
    }
    .form-control.form-select {
    height: 50px !important;
    /* padding: 15px 23px; */
    font-size: 16px;
    border: 1px solid #e2e2e2;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
    box-shadow: none;
    -webkit-transition: all 0.3s ease 0s;
    -moz-transition: all 0.3s ease 0s;
    -o-transition: all 0.3s ease 0s;
    transition: all 0.3s ease 0s;
    background-color: #fff;
    }
    #other{
    display:none;
    }
    .iti {
    display: block !important;
    }
    span#error-msg {
    color: red;
    float: left;
    margin-bottom: 14PX;
    }
    .iti{
    width: 100%;
    }
</style>
<div class="page_title_section">
    <div class="page_header">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8 col-12 col-sm-7">
                    <h1>Register</h1>
                </div>
                <div class="col-lg-3 col-md-4 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li>
                                <a href="{{route('website-home')}}"> Home </a>&nbsp; / &nbsp;
                            </li>
                            <li>Register</li>
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
                    <div class="login_banner_wrapper ms-reg-bg">
                        <img src="{{asset('/web/images/customcolor_logo.png')}}" class="img-fluid" width="300px" alt="logo">
                    </div>
                    <div class="login_form_wrapper ms-reg signup_wrapper">
                        <h2>Register</h2>
                        <p class="mb-4 theme-color">Register your organisation with Clubland Services</p>
                        <form action="{{route('store_register')}}" method="post" >
                            @csrf
                            <div class="form-group  comments_form">
                                <input type="text" class="form-control require" required value="{{old('club_name')}}" name="club_name" placeholder="Club name">
                                @if ($errors->has('club_name'))
                                <span class="text-danger" style="float: left;">{{ $errors->first('club_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <div class="require">
                                    <select class="form-control form-select w-100" required name="club_type" id="changeClub">
                                        <option value="">Select club type</option>
                                        @foreach ($clubType as $types)
                                        <option value="{{$types->id}}" {{ old('club_type') == $types->id ? 'selected' : '' }}>{{$types->name}}</option>
                                        @endforeach
                                        <option value="other">Other</option>
                                    </select>
                                    @if ($errors->has('club_type'))
                                    <span class="text-danger" style="float: left;">{{ $errors->first('club_type') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group  comments_form" id="other">
                                <input type="text" class="form-control require"  value="{{old('new_club_type')}}" id="NewType" name="new_club_type" placeholder="Enter New Club Type">
                            </div>
                            <div class="form-group  comments_form">
                                <input type="text" class="form-control require"  required value="{{old('name')}}" name="name" placeholder="Contact person name">
                                @if ($errors->has('name'))
                                <span class="text-danger" style="float: left;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group  comments_form">
                                <input type="text" class="form-control require" required value="{{old('position')}}" name="position" placeholder="Contact person position">
                                @if ($errors->has('position'))
                                <span class="text-danger" style="float: left;">{{ $errors->first('position') }}</span>
                                @endif
                            </div>
                            <div class="form-group  comments_form">
                                <input type="text" class="form-control require" required value="{{old('email')}}" name="email" placeholder="Contact email">
                                @if ($errors->has('email'))
                                <span class="text-danger" style="float: left;">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group comments_form password-box">
                                <input name="password" type="password" value="" class="input form-control" id="password" placeholder="Password" required="true" aria-label="password" aria-describedby="basic-addon1" />
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="password_show_hide();">
                                    <i class="fas fa-eye d-none" id="hide_eye"></i>
                                    <i class="fas fa-eye-slash " id="show_eye"></i>
                                    </span>
                                </div>
                                @if ($errors->has('password'))
                                <span class="text-danger" style="float: left;">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="registrationFormAlert1" id="divPasswordValidationResult1"></div>
                            <div class="form-group  comments_form">
                                <input type="hidden" id="code" name="country_code" value="{{old('country_code','61')}}">
                                <input type="text" id="contect" class="form-control require" required value="{{old('phone_number')}}" name="phone_number" placeholder="Contact phone">
                                @if ($errors->has('phone_number'))
                                <span class="text-danger" style="float: left;">{{ $errors->first('phone_number') }}</span>
                                @endif
                            </div>
                            <div class="form-group  comments_form">
                                <textarea type="text" class="form-control require" required name="address" placeholder="Club address ">{{old('address')}}</textarea>
                                @if ($errors->has('address'))
                                <span class="text-danger" style="float: left;">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="login_remember_box" style="margin-right: 78px;">
                                <label class="control control--checkbox">I accept 
                                <a href="{{route('cms_all_pages','privacy_policy')}}" target="_blank">Privacy Policy</a> & <a href="{{route('cms_all_pages','terms_conditions')}}" target="_blank">Terms & Conditions</a>
                                <input type="checkbox" required name="terms_condition">
                                <span class="control__indicator"></span>
                                </label><br>
                                @if ($errors->has('terms_condition'))
                                <span class="text-danger" style="float: left;">{{ $errors->first('terms_condition') }}</span>
                                @endif
                            </div>

                            <div class="form-group mt-3">
                                <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_SITEKEY')}}" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                                <input class="form-control d-none" name="captcha" data-recaptcha="true">
                                @error('g-recaptcha-response')
                                <span class="text-danger" style="float: left;">Please Complete the Recaptcha to proceed</span>
                                @enderror
                            </div>
                            <div class="header_btn search_btn login_btn jb_cover">
                                <div class="">
                                    <button type="submit" class="btn btn-50 w-100 d-flex align-items-center justify-content-center" id="submitdisable">Sign up</button>
                                </div>
                            </div>
                        </form>
                        <div class="dont_have_account jb_cover">
                            <p>Already have an account? <a href="{{route('login_business')}}">Login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('web.layout.faq-page')
@endsection
@section('script')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    $("#contect").intlTelInput({
        preferredCountries: ["us", "gb", "au"],
        separateDialCode: true,
        initialCountry: "au"
    }).on('countrychange', function (e, countryData) {
        $("#code").val(($("#contect").intlTelInput("getSelectedCountryData").dialCode));
    
    });
</script>
@endsection