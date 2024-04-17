@extends('web.layout.portal-master')
@section('content')
<style>
  .feature_box .location_time_date li {

font-size: 14px;
color: #222222;
}
</style>
<div class="page_title_section">
    <div class="page_header">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-8 col-12 col-sm-7 align-items-center d-flex">
            <h1>Facility</h1>
          </div>
          <div class="col-lg-3 col-md-4 col-12 col-sm-5">
            <div class="sub_title_section">
              <ul class="sub_title">
                <li> <a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}"> Home </a>&nbsp; / &nbsp; </li>
                <li>Facility List</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="shop_listing">
    <div class="container">
      <div class="row">
        @forelse ($facility as $val)
        <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="feature_box p-0">
          <div class="media_div">
            <a href="{{url('facility/details/'.$val->slug)}}">
            @if($val->getfacilityImage)
              <img src="{{asset('/facility_image/'.$val->getfacilityImage[0]['image'])}}" alt="facility-image">
            @else
              <img src="{{asset('/web/images/size-500-500.jpg')}}" alt="facility-image">
            @endif
            </a>
          </div>
          <div class="feature_content">
            <h3><a href="{{url('facility/details/'.$val->slug)}}">{{$val->name}}</a></h3>
            <P class="description">{{mb_strimwidth($val->sort_description, 0, 50, '...')}}</P>
            <p class="price ">
              ${{$val->price}}
            </p>
            <div class="location_time_date mb-3">
                <ul>
                <li>Available Hours </li>
                  <li><i class="icon-calendar text-green"></i>  {{date('d-m-Y H:i', strtotime($val->start_hours))}} –  {{date('d-m-Y H:i', strtotime($val->end_hours))}}</li>
                  <li><i class="icon-location text-green"></i> {{$val->location}}</li>
                </ul>
              </div>
            <div class="button_div">
            
              <a href="{{url('/facility/'.$val->slug.'/book-now')}}" class="btn btn-50">Book Now</a>
            </div>
          </div>
        </div>
      </div>
      @empty
        <div class="col-lg-12 col-md-12 col-sm-12">
            <p style="text-align: center;">No facility yet!</p>
        </div>
      @endforelse
      </div>
    </div>
  </section>
  @endsection