@extends('web.layout.portal-master')
@section('content')
<div class="page_title_section">
    <div class="page_header">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-8 col-12 col-sm-7 align-items-center d-flex">
            <h1>Event</h1>
          </div>
          <div class="col-lg-3 col-md-4 col-12 col-sm-5">
            <div class="sub_title_section">
              <ul class="sub_title">
                <li> <a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}"> Home </a>&nbsp; / &nbsp; </li>
                <li>Event List</li>
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
        @forelse ($event as $val)
        <div class="col-lg-4 col-md-6 col-sm-6">
          
          <div class="feature_box p-0">
            <div class="media_div">
              <a href="{{url('event/details/'.$val->slug)}}">
                <img src="{{asset('/event_image/'.$val->geteventImage[0]['image'])}}">
              </a>
            </div>
            <div class="feature_content">
              <h3><a href="{{url('event/details/'.$val->slug)}}">{{$val->name}}</a></h3>
              <P class="description">{{mb_strimwidth($val->sort_description, 0, 50, '...')}}</P>
              @if($val->ticket_type == 'Free')
                <p class="price"><b>Free</b></p>
              @else
                <p class="price"><b>Paid</b></p>
              @endif
              <div class="location_time_date mb-3">
                <ul>
                  <li>Available Hours </li>
                  <li><i class="icon-calendar"></i>  {{date('d-m-Y H:i', strtotime($val->start_date))}} –  {{date('d-m-Y H:i', strtotime($val->end_date))}}</li>
                  <li><i class="icon-location"></i> {{$val->location}}</li>
                </ul>
              </div>
              <div class="button_div">
                <a href="{{url('event/details/'.$val->slug)}}" class="btn btn-50">Add to cart</a>
              </div>
            </div>
          </div>
        </div> 
        @empty
          <div class="col-lg-12 col-md-12 col-sm-12">
              <p style="text-align: center;">No event yet!</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>
  @endsection