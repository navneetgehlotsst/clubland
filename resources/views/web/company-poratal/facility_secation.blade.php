<!-- facility -->

@if($facilitydata->status == 1)
  <section class="shop_listing" style="margin-bottom: -100px!important;">
    <div class="container">
      <div class="d-flex align-content-center justify-content-between">
        <div class="heading_block">
          <h2>Facility</h2>
        </div>
        <div class="button_div">
          <a href="{{url('/facility/all')}}" class="btn btn-border">View All</a>
        </div>
      </div>
      <div class="row">
      @forelse ($facilitys as $facility)
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="feature_box p-0">
            <div class="media_div">
              <a href="{{url('facility/details/'.$facility->slug)}}">
              @if($facility->getfacilityImage)
                <img src="{{asset('/facility_image/'.$facility->getfacilityImage[0]['image'])}}" alt="facility-image">
              @else
                <img src="{{asset('/web/images/size-500-500.jpg')}}" alt="facility-image">
              @endif
              </a>
            </div>
            <div class="feature_content">
              <h3><a href="{{url('facility/details/'.$facility->slug)}}">{{$facility->name}}</a></h3>
              <P class="description">{{mb_strimwidth($facility->sort_description, 0, 50, '...')}}</P>
             
              <p class="price ">${{$facility->price}}</p>
              <!-- <p class="price ">${{number_format(((3.75 / 100) * $facility->price) + 0.50 + $facility->price,2)}}</p> -->
              <div class="location_time_date mb-3">
                  <ul>
                  <li>Available Hours </li>
                    <li><i class="icon-calendar text-green"></i>  {{date('d-m-Y H:i', strtotime($facility->start_hours))}} –  {{date('d-m-Y H:i', strtotime($facility->end_hours))}}</li>
                    <li><i class="icon-location text-green"></i> {{$facility->location}}</li>
                  </ul>
                </div>
              <div class="button_div">
              
                <a href="{{url('/facility/'.$facility->slug.'/book-now')}}" class="btn btn-50">Book Now</a>
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

<!-- facility -->
