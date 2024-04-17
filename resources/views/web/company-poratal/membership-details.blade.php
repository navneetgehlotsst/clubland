@extends('web.layout.portal-master')
@section('content')

<div class="page_title_section">
    <div class="page_header">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-8 col-12 col-sm-7 align-items-center d-flex">
            <h1>MemberShip</h1>
          </div>
          <div class="col-lg-3 col-md-4 col-12 col-sm-5">
            <div class="sub_title_section">
              <ul class="sub_title">
                <li> <a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}"> Home </a>&nbsp; / &nbsp; </li>
                <li>MemberShip Details</li>
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
                <h2 class="border_bottom">{{$membership->plan_name}}</h2>
                <div class="price_div">
                    <div class="price_div mb-2">
                      @if($membership->ticket_type == 'Paid')
                        @if($membership->discount == 0)
                        <p class="price ">${{$membership->price}}</p>

                        @else
                        <span>${{$membership->fixed_amount}} </span> <del> ${{$membership->price}}</del>
                        @endif
                      @else
                      <span><b>Free</b></span>
                      @endif
                    </div>
                </div>
                <div class="row">
                  <div class="col-lg-3">
                    @if($membership->membership_type == 'individual')
                    <p class="membership-icon-box"><span class="text-green"><i class="icon-membership"></i> Individual</span></p>
                    @else
                    <p class="membership-icon-box"><span class="text-green"><i class="icon-membership"></i> Family</span> : {{$membership->maximum_people}} people</p>
                    @endif
                  </div>
                  <div class="col-lg-3">
                    <p><span class="text-info"><i class="fas fa-coins"></i> Plan</span> : {{ucfirst($membership->plan_terms)}}</p>
                  </div>
                </div>
                <div class="size_color_div">
                  <h5>Benefits</h5>
                  <div class="row">

                    <div class="col-lg-6">
                      <ul class="mt-3 benefits-list-item">
                        @if($membership->getBenefitAppend)
                          @foreach ($membership->getBenefitAppend as $benfit)
                            <li>{{$benfit->name}}</li>
                          @endforeach
                        @endif
                      </ul>
                    </div>
                  
                  </div>
                </div>
                <div class="description">
                    <p>{{$membership->sort_description}}</p>
                </div>

                
                <div class="button_div d-flex">
                <a href="{{url('/membership/'.$membership->slug.'/book-now')}}" class="btn btn-50">Book Now</a>
                    <!-- <button class="btn btn-50">Book Now</button> -->
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</section>
<section class="other_details">
    <div class="container">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
          @if($membership->plan_summary)
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Plan Summary</a>
            </li>
            @endif
          @if($membership->term_condition)
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Terms & Conditions</a>
            </li>
            @endif
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="description">
                    {!!$membership->plan_summary!!}
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="description">
                    {!!$membership->term_condition!!}
                </div>
            </div>
        </div>
    </div>
</section>
  @endsection