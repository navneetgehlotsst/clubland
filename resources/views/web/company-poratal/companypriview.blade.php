@extends('web.layout.portal-master')
@section('content')
<style>
.feature_box .location_time_date li {

    font-size: 14px;
    color: #222222;
}
</style>
<section class="shope-banner p-0">
  <div class="media_div">
    @if(isset($bannerImage))
    <img src="{{asset('/homeSecation/'.@$bannerImage->home_image)}}" width="100%">
    @else
    <img id="perview_userprofile" src="{{asset('web/images/img-icon1920x650.png')}}" alt="profile-upload-image">
    @endif
  </div>
</section>

@foreach($homedata as $home)
  @include('web.company-poratal.'.$home->secation_type)
@endforeach

@if($aboutSecation)
  <section class="about_shop">
    <div class="container">
      <div class="row align-items-center d-flex">
        <div class="col-lg-12">
          <div class="heading_block">
            <h2>About Club</h2>
          </div>
        </div>
        @if($aboutSecation->image_left_right == 1)
            @if($aboutSecation->image_hide_show == 1)
            <div class="col-lg-6">
              <div class="media_div">
                <img src="{{asset('/aboutSecation/'.$aboutSecation->about_image)}}" width="100%" alt="about shop">
              </div>
            </div>
            @endif
            <div class="col-lg-6"> 
              <div class="heading_block">
                {!!$aboutSecation->description!!}
              </div>
            </div>
        @else
            <div class="col-lg-6"> 
              <div class="heading_block">
                {!!$aboutSecation->description!!}
              </div>
            </div>
            @if($aboutSecation->image_hide_show == 1)
            <div class="col-lg-6">
              <div class="media_div">
                <img src="{{asset('/public/aboutSecation/'.$aboutSecation->about_image)}}" width="100%" alt="about shop">
              </div>
            </div>
            @endif
        @endif
      </div>
    </div>
  </section>
  @endif
  @endsection