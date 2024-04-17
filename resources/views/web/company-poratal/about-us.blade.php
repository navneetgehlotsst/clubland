@extends('web.layout.portal-master')
@section('content')
<style>
  .how-it-works {
    background-image: url({{asset('/public/AboutBannerImage/'.@$databanner->home_image)}});
   
}
</style>

<div class="top_company_wrapper jb_cover how-it-works">
  <div class="overlay-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="top_hiring_cpmpany_heading jb_cover">
            <div class="jb_heading_wraper left_jb_jeading">
              <h3 class="text-white text-center">About Us </h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@if($data)
<div class="grow_next_wrapper jb_cover bg-white">
  <div class="container">
    <div class="row">
    @if($data->image_left_right == 1)
     
      @if($data->image_hide_show == 1)
      <div class="col-lg-6 col-md-12 col-12 col-sm-12 align-self-center">
        <div class="grow_next_img jb_cover"> <img src="{{asset('/public/aboutSecation/'.@$data->about_image)}}" class="img-responsive img-fluid" alt="img" style="height: 500px;"> </div>
      </div>
      @endif
      <div class="col-lg-6 col-md-12 col-12 col-sm-12 align-self-center pl-0 pl-lg-5">
        <div class="jb_heading_wraper left_jb_jeading">
          <h3>About Clubland services</h3>
        </div>
        <div class="grow_next_text jb_cover">
          {!!$data->description!!}
        </div>
      </div>
    @else
      
      <div class="col-lg-6 col-md-12 col-12 col-sm-12 align-self-center pl-0 pl-lg-5">
        <div class="jb_heading_wraper left_jb_jeading">
          <h3>About Clubland services</h3>
        </div>
        <div class="grow_next_text jb_cover">
          {!!$data->description!!}
        </div>
      </div>
      @if($data->image_hide_show == 1)
      <div class="col-lg-6 col-md-12 col-12 col-sm-12 align-self-center">
        <div class="grow_next_img jb_cover"> <img src="{{asset('/public/aboutSecation/'.@$data->about_image)}}" class="img-responsive img-fluid" alt="img"> </div>
      </div>
      @endif
     
    @endif
    </div>
  </div>
</div>

@else
      <section style="margin-bottom: -86px;">
        <div class="container">
           <div class="row">
           <div class="col-lg-12 m-auto text-center">
            <h4>No Content added yet</h4>
          </div>
           </div>
        </div>
      </section>
@endif

<div class="grow_next_wrapper pt-0 jb_cover bg-white">
  <div class="container">
    <div class="row">
      @if(@$aboutContent->we_secation_status == '1')
      <div class="col-lg-4 col-md-12 col-12 col-sm-12">
        <div class="mt-3 ">
          <h4 class="mb-3">{{@$aboutContent->we_secation_title}}</h4>
          <div class="text-wrap">{!!@$aboutContent->we_secation_description!!}</div>
          
        </div>
      </div>
      @endif
      @if(@$aboutContent->our_secation_status == '1')
      <div class="col-lg-4 col-md-12 col-12 col-sm-12">
        <div class="mt-3">
          <h4 class="mb-3">{{@$aboutContent->our_secation_title}}</h4>
          <div class="text-wrap">{!!@$aboutContent->our_secation_description!!}</div>
          
        </div>
      </div>
      @endif
      @if(@$aboutContent->mis_secation_status == '1')
      <div class="col-lg-4 col-md-12 col-12 col-sm-12">
        <div class="mt-3 text-wrap">
          <h4 class="mb-3">{{@$aboutContent->mis_secation_title}}</h4>
          <div class="text-wrap">{!!@$aboutContent->mis_secation_description!!}</div>
          
        </div>
      </div>
      @endif
    </div>
  </div>
</div>

@endsection