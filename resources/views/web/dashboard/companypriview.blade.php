@extends('web.layout.portal-master')
@section('content')

<section class="shope-banner p-0">
  <div class="media_div">
    @if(isset($aboutSecation))
    <img src="{{asset('/public/homeSecation/'.@$aboutSecation->home_image)}}" width="100%">
    @else
    <img id="perview_userprofile" src="{{asset('web/images/img-icon1920x650.png')}}" alt="profile-upload-image">
    @endif
  </div>
</section>
@if($productdata->status == 1)
<section class="shop_listing">
  <div class="container">
    <div class="d-flex align-content-center justify-content-between">
      <div class="heading_block">
        <h2>Shop</h2>
        <span>Feature Products</span>
      </div>
      <div class="button_div">
        <a href="{{route('shop_portal_all',$slug)}}" class="btn btn-border">View All</a>
      </div>
    </div>
    <div class="row">
      @forelse ($products as $product)
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="feature_box p-0">
            <div class="media_div">
              <a href="{{route('shop_portal_details',[$slug,$product->slug])}}">
                  @if($product->getproductImage)
                    <img src="{{asset('public/product_image/'.$product->getproductImage[0]['image'])}}" alt="product-image">
                  @else
                    <img src="{{asset('/web/images/size-500-500.jpg')}}" alt="product-image">
                  @endif
              </a>
            </div>
            <div class="feature_content">
              <h3><a href="{{route('shop_portal_details',[$slug,$product->slug])}}">{{$product->product_name}} </a></h3>
              <P class="description">{{mb_strimwidth($product->sort_description, 0, 50, '...')}}</P>
              <p class="price">${{$product->product_discount}}.00 <del>${{$product->product_price}}.00</del> </p>
              <div class="button_div">
                <a href="#" class="btn btn-50">Add to cart</a>
              </div>
            </div>
          </div>
        </div>
        @empty
          <div class="col-lg-12 col-md-12 col-sm-12">
              <p style="text-align: center;">No product yet!</p>
          </div>
        @endforelse
    </div>
  </div>
</section>
@endif
@if($eventdata->status == 1)
<section class="shop_listing event_listing pt-0">
  <div class="container">
    <div class="d-flex align-content-center justify-content-between">
      <div class="heading_block">
        <h2>Events</h2>
        <span>Feature Tickets</span>
      </div>
      <div class="button_div">
        <a href="{{route('event_all',$slug)}}" class="btn btn-border">View All</a>
      </div>
    </div>
    <div class="row">
      @forelse ($events as $event)
        <div class="col-lg-4 col-md-6 col-sm-6">
          
          <div class="feature_box p-0">
            <div class="media_div">
              <a href="{{route('event_details',[$slug,$event->slug])}}"><img src="{{asset('/web/images/event-1.jpg')}}"></a>
            </div>
            <div class="feature_content">
              <h3><a href="{{route('event_details',[$slug,$event->slug])}}">{{$event->name}}</a></h3>
              <P class="description">{{mb_strimwidth($event->sort_description, 0, 50, '...')}}</P>
              @if($event->ticket_type == 'Free')
                <p class="price"><b>Free</b></p>
              @else
                <p class="price">${{$event->geteventTicket['0']['ticket_cost'] ?? 0}}.00 </p>
              @endif
              <div class="location_time_date">
                <ul>
                  <li><i class="icon-location"></i> {{$event->location}}</li>
                  <li><i class="icon-calendar"></i>  {{date('d-m-Y H:i', strtotime($event->start_date))}} –  {{date('d-m-Y H:i', strtotime($event->end_date))}}</li>
                </ul>
              </div>
              <div class="button_div">
                <a href="{{route('event_details',[$slug,$event->slug])}}" class="btn btn-50">Book Now</a>
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
@endif
@if($facilitydata->status == 1)
<section class="shop_listing event_listing pt-0">
  <div class="container">
    <div class="d-flex align-content-center justify-content-between">
      <div class="heading_block">
        <h2>Facility</h2>
        <span>Feature Facility</span>
      </div>
      <div class="button_div">
        <a href="{{route('facility_all',$slug)}}" class="btn btn-border">View All</a>
      </div>
    </div>
    <div class="row">
    @forelse ($facilitys as $facility)
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="feature_box p-0">
          <div class="media_div">
            <a href="{{route('facility_details',[$slug,$facility->slug])}}">
            @if($facility->getfacilityImage)
              <img src="{{asset('public/facility_image/'.$facility->getfacilityImage[0]['image'])}}" alt="facility-image">
            @else
              <img src="{{asset('/web/images/size-500-500.jpg')}}" alt="facility-image">
            @endif
            </a>
          </div>
          <div class="feature_content">
            <h3><a href="{{route('facility_details',[$slug,$facility->slug])}}">{{$facility->name}}</a></h3>
            <P class="description">{{mb_strimwidth($facility->sort_description, 0, 50, '...')}}</P>
            <p class="price ">${{$facility->price}}.00 </p>
            <div class="location_time_date">
                <ul>
                  <li><i class="icon-calendar"></i>  {{date('d-m-Y H:i', strtotime($facility->start_date))}} –  {{date('d-m-Y H:i', strtotime($facility->end_date))}}</li>
                </ul>
              </div>
            <div class="button_div">
              <a href="{{route('facility_details',[$slug,$facility->slug])}}" class="btn btn-50">Book Now</a>
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
@endif
@if($membershipdata->status == 1)
<section class="shop_listing event_listing pt-0">
  <div class="container">
    <div class="d-flex align-content-center justify-content-between">
      <div class="heading_block">
        <h2>MemberShip</h2>
        <span> MemberShip Plan</span>
      </div>
      <div class="button_div">
        <a href="{{route('membership_all',$slug)}}" class="btn btn-border">View All</a>
      </div>
    </div>
    <div class="row">
    @forelse ($memnerships as $ship)
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="feature_box p-0">
          <div class="feature_content">
            <h3><a href="{{route('membership_details',[$slug,$ship->slug])}}">{{$ship->plan_name}}</a></h3>
            <P class="description">{{mb_strimwidth($ship->sort_description, 0, 50, '...')}}</P>
            @if($ship->ticket_type == 'Paid')
            <p class="price ">${{$ship->fixed_amount}}.00 <del>${{$ship->price}}.00</del></p>
            @else
            <p class="price "><b>Free</b></p>

            @endif
            <div class="time mb-3">
              <label for="">MemberShip</label>&nbsp;&nbsp;-&nbsp;&nbsp;<span>{{ucfirst($ship->membership_type)}}</span>
                 
                @if($ship->membership_type == 'family')
                 - <span>{{$ship->maximum_people}} people</span>
                @endif
                <br>
                <span>Plan :-{{ucfirst($ship->plan_terms)}}</span>
                @if($ship->plan_terms ==  'custome')
                &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;<span>{{$ship->custome_month}} Month</span>
                @endif
            </div>
            <div class="button_div">
              <a href="{{route('membership_details',[$slug,$ship->slug])}}" class="btn btn-50">Book Now</a>
            </div>
          </div>
        </div>
      </div>
      @empty
        <div class="col-lg-12 col-md-12 col-sm-12">
            <p style="text-align: center;">No membership plan yet!</p>
        </div>
      @endforelse
    </div>
  </div>
</section>
@endif
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
              <img src="{{asset('/public/aboutSecation/'.$aboutSecation->about_image)}}" width="100%" alt="about shop">
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