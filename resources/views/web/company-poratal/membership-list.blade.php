@extends('web.layout.portal-master')
@section('content')
<div class="page_title_section">
    <div class="page_header">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-8 col-12 col-sm-7 align-items-center d-flex">
            <h1>Membership</h1>
          </div>
          <div class="col-lg-3 col-md-4 col-12 col-sm-5">
            <div class="sub_title_section">
              <ul class="sub_title">
                <li> <a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}"> Home </a>&nbsp; / &nbsp; </li>
                <li>Membership List</li>
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
        @forelse ($membership as $val)
        <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="feature_box p-0">
          <div class="feature_content">
            <h3><a href="{{url('membership/details/'.$val->slug)}}">{{$val->plan_name}}</a></h3>
            <P class="description">{{mb_strimwidth($val->sort_description, 0, 50, '...')}}</P>
            @if($val->ticket_type == 'Paid')
                @if($val->discount == 0)
                  <p class="price ">
                  ${{$val->price}}
                  </p>
                @else
                  <p class="price ">${{$val->fixed_amount}} <del> ${{$val->price}}</del></p>
                @endif

            @else
                <p class="price "><b>Free</b></p>
            @endif
            <div class="time mb-3">
              <label for="">Membership</label>&nbsp;&nbsp;-&nbsp;&nbsp;<span>{{ucfirst($val->membership_type)}}</span>

                @if($val->membership_type == 'family')
                 - <span>{{$val->maximum_people}} people</span>
                @endif
                <br>
                <span>Plan :-{{ucfirst($val->plan_terms)}}</span>
                @if($val->plan_terms ==  'custom')
                &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;<span>{{$val->custome_month}} Month</span>
                @endif
            </div>
            <div class="button_div">
              <a href="{{url('/membership/'.$val->slug.'/book-now')}}" class="btn btn-50">Book Now</a>
            </div>
          </div>
        </div>
      </div>
        @empty
          <div class="col-lg-12 col-md-12 col-sm-12">
              <p style="text-align: center;">No membership yet!</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>
  @endsection
