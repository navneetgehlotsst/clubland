@extends('web.layout.portal-master')
@section('content')
<style>
  .shop_details .feature_content .button_div .quantity div {
    width: 64px !important;
}
.position-zoom-list-img{
  position: relative !important;
  display: -webkit-box !important;
}
.error{
  color:red;
}
</style>
<div class="page_title_section">
    <div class="page_header">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-8 col-12 col-sm-7 align-items-center d-flex">
            <h1>Booking Details</h1>
          </div>
          <div class="col-lg-3 col-md-4 col-12 col-sm-5">
            <div class="sub_title_section">
              <ul class="sub_title">
                <li> <a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}"> Home </a>&nbsp; / &nbsp; </li>
                <li>Booking Details</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="shop_details">
    <div class="container">
        <div class="row">
          <div class="col-lg-10 m-auto">
            <div class="feature_box rounded">
              <div class="feature_content">
                <h2 class="border_bottom">{{$event->name}}</h2>
                <div class="price_div">
                    <div class="price_div mb-2">
                      @if($event->ticket_type == 'Paid')

                      @else
                      <span><b>Free</b></span>
                      @endif
                    </div>
                </div>
                <div class="row">
                  <div class="col-lg-5">
                    <p class="membership-icon-box"><span class="text-green"><img src="{{asset('web/images/icon/tickets.svg')}}" alt="" class="pr-1"> <span class="h5 font-weight-bold mt-2"> {{$event->quantity}} &nbsp; Available ticket</span></p>
                    
                  </div>
                  <div class="col-lg-5">
                    <p class="membership-icon-box"><span class="text-green"><img src="{{asset('web/images/icon/tickets.svg')}}" alt="" class="pr-1"> <span class="h5 font-weight-bold mt-2"> Buy ticket &nbsp; {{$quanitiy}}</span></p>
                    
                  </div>
                </div>
                <div class="description mt-2">
                    <p>{{$event->sort_description}}</p>
                </div>
                <hr>
              <h5>Personal Details</h5>
              <form action="{{route('payment.payment',[$businessSlug,$event->slug,'event-free'])}}" name="payment" method="post">
                <div class="row mt-3">
                 @csrf
                    <div class="col-lg-6">
                      <div class="form-group comments_form">
                        <lable>Name</lable>
                        <input type="hidden" name="quanitiy" value="{{$quanitiy}}">
                        <input type="name" required name="user_name" class="form-control" placeholder="Name">
                      </div>
                      
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group comments_form">
                        <lable>Phone Number</lable>
                        <input type="text" name="phone_number" required class="form-control number" placeholder="Phone Number">
                        </div>
                      </div>

                    <div class="col-lg-6">
                      <div class="form-group comments_form">
                        <lable>Email</lable>
                        <input type="email" required name="email" class="form-control" placeholder="Email">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group comments_form">
                        <lable>Address</lable>
                        <input type="text" required name="address" class="form-control" placeholder="Address">
                      </div>
                    </div>
                    @if($event->ticket_type_check == '1')
                    <div class="col-lg-6">
                      <div class="form-group comments_form">
                        <lable>Any Query</lable>
                        <input type="text" name="user_query" class="form-control" placeholder="Any Query">
                      </div>
                    </div>
                    @endif
                    <div class="col-lg-12">
                      <div class="button_div mt-25" style="margin-top: 15px !important;">
                        <input type="submit" value="Continue" class="btn btn-50">
                      </div>
                    </div>
                    
                </div>
              </form>
                
              </div>
            </div>
          </div>
        </div>
    </div>
</section>
  @endsection