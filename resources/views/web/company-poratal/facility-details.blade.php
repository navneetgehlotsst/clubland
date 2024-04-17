@extends('web.layout.portal-master')
@section('content')
<style>

.position-zoom-list-img{
  position: relative !important;
  display: -webkit-box !important;
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
                <li>Facility Details</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<section class="shop_details">
    <div class="container">
        <div class="feature_box">
            <div class="row">
                <div class="col-lg-6">
                    <div class="wrapper pl-0">
                        
                        <div class="big-img">
                          
                            @if(isset($facility->getfacilityImage))
                              <img src="{{asset('/facility_image/'.$facility->getfacilityImage[0]['image'])}}" class="display-img" alt="facility-image">
                            @else
                              <img src="{{asset('/web/images/size-500-500.jpg')}}" class="display-img" alt="facility-image">
                            @endif
                        </div>
                        <div class="img-selection position-zoom-list-img mt-3">
                        @if(isset($facility->getfacilityImage))
                          @foreach ($facility->getfacilityImage as $key => $val)
                          <div class="img-thumbnail selected  mt-0 mr-1 mr-lg-3">
                            <img src="{{asset('/facility_image/'.$val->image)}}" width="100%">
                          </div>
                          @endforeach
                          
                        @endif  
                        </div>
                      </div>

                </div>
                <div class="col-lg-6">
                    <div class="feature_content">
                        <h2 class="border_bottom">{{$facility->name}}</h2>
                        <div class="price_div">
                            <p><span>
                              ${{$facility->price}}
                            </span>/ Facility</p>
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
                        <div class="description">
                            <p>{{$facility->sort_description}}</p>
                        </div>
                        <div class="button_div d-flex">
                        <a href="{{url('/facility/'.$facility->slug.'/book-now')}}" class="btn btn-50">Book Now</a>
                            
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
            @if($facility->description)
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Description</a>
            </li>
            @endif
            @if($facility->terms)

            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Terms & Conditions</a>
            </li>
            @endif
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="description">
                    {!!$facility->description!!}
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="description">
                {!!$facility->terms!!}
                </div>
            </div>
        </div>
    </div>
</section>
  @endsection