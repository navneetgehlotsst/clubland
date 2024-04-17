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
                <li> <a href="{{route('shop_portal',$businessSlug)}}"> Home </a>&nbsp; / &nbsp; </li>
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
        <div class="col-lg-8 m-auto">
          <div class="feature_content">
            <div class="feature_box">
              <h2 class="py-3"><span class="h6">Facility Name : </span>{{$facility->name}}</h2>
              <div class="price_div">
                  <p><span>
                    ${{$facility->price}}
                  </span>/ total price</p>
              </div>
              <div class="size_color_div">
                <div class="row">
                    <div class="col-12">
                      <label for="">Available Hours</label>
                    </div>
                    <div class="col-6">
                      <p><span class="text-green"><i class="far fa-clock"></i> Start :</span> {{date('d-m-Y H:i', strtotime($facility->start_hours))}}</p>
                    </div>
                    <div class="col-6">
                      <p><span class="text-danger"><i class="far fa-clock"></i> End :</span> {{date('d-m-Y H:i', strtotime($facility->end_hours))}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                            <div class="col-12">
                                <label for=""><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp; Location :</label>
                                   {{$facility->location}}

                                </div>
                                </div>
              </div>
              <p class="mt-3">{{$facility->sort_description}}</p>
              <hr>
              <h5>Personal Details</h5>
              <form action="{{url('/payment/'.$facility->slug)}}" name="payment" method="post">
                <div class="row mt-3">
                 @csrf
                    <div class="col-lg-6">
                      <div class="form-group comments_form">
                        <input type="name" required name="user_name" class="form-control" placeholder="Name">
                      </div>
                     
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group comments_form">
                        <input type="text" name="phone_number" required class="form-control number" placeholder="Mobile Number">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group comments_form">
                        <input type="email" required name="email" class="form-control" placeholder="Email">
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group comments_form">
                        <input type="text" required name="address" class="form-control" placeholder="Address">
                      </div>
                    </div>
                    <div class="button_div mt-0">
                      <input type="submit" value="Continue" class="btn btn-50">
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