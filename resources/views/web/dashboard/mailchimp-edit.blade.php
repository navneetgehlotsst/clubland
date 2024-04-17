@extends('web.layout.master')
@section('content')
<style>
  .error{
    color:red;
  }
 </style> 
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
                <li>Mailchimp-Edit</li>
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
        <form class="dashboard_form" action="{{ route('mailchimp_update') }}" name="mailchimp" method="post" enctype="multipart/form-data">
          @csrf
            <div class="feature_box">
                <div class="row">
                  <div class="col-lg-6">
                    
                    <div class="form-group comments_form">
                      <label class="form-label">Api Key</label>
                      <input type="text" class="form-control valid" name="key" value="{{$data->key ?? old('key')}}" required placeholder="Enter Api Key">
                      @if ($errors->has('key'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('key') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-6">
                    
                    <div class="form-group comments_form">
                      <label class="form-label">Audience ID</label>
                      <input type="text" class="form-control valid" name="audience_id" value="{{$data->audience_id ?? old('audience_id')}}" required placeholder="Enter Audience ID">
                      @if ($errors->has('audience_id'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('audience_id') }}</span>
                      @endif
                    </div>
                  </div>
                 
                  <div class="col-lg-12">
                    <p><b>Note :</b> &nbsp;Before proceeding, ensure you have created an account. Once your account is set up, follow these steps to obtain your Mailchimp API Key: Log in to your Mailchimp account, navigate to the right top bar, and select 'Account & Billing.' From there, click on 'Extras' and then 'Create a Key.'</p><br>
                    <p> To find your Audience ID, go to the left sidebar, click on 'Audience,' and select 'All Contacts.' Access the 'Settings' option to view Audience name and defaults, where you will find the Audience ID displayed.</p>
                  </div>
                  <div class="col-lg-12">&nbsp;</div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">For more help</label>
                      <a href="https://mailchimp.com/help/" target="_blank">Click Here</a>
                    </div>
                  </div>
                </div>
            </div>
            <div class="button_div float-end mt-30"><button type="submit" class="btn btn-50">Save Changes</button></div>
          </form>
        </div>
      </div>
      </div>
    </div>
  </section>
  <!-- Dashboard Inner Content Section End -->
  @endsection
