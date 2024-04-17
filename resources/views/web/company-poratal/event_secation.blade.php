<!-- event -->

@if($eventdata->status == 1)
  <section class="shop_listing" style="margin-bottom: -100px!important;">
    <div class="container">
      <div class="d-flex align-content-center justify-content-between">
        <div class="heading_block">
          <h2>Events</h2>
        </div>
        <div class="button_div">
          <a href="{{url('/event/all')}}" class="btn btn-border">View All</a>
        </div>
      </div>
      <div class="row">
        @forelse ($events as $event)
          <div class="col-lg-4 col-md-6 col-sm-6">
            
            <div class="feature_box p-0">
              <div class="media_div">
                <a href="{{url('event/details/'.$event->slug)}}">
                <img src="{{asset('/event_image/'.$event->geteventImage[0]['image'])}}">
                </a>
              </div>
              <div class="feature_content">
                <h3><a href="{{url('event/details/'.$event->slug)}}">{{$event->name}}</a></h3>
                <P class="description">{{mb_strimwidth($event->sort_description, 0, 50, '...')}}</P>
                @if($event->ticket_type == 'Free')
                  <p class="price"><b>Free</b></p>
                @else
                  <p class="price"><b>Paid</b></p>
                @endif
                <div class="location_time_date mb-3">
                  <ul>
                    <li>Available Hours </li>
                    <li><i class="icon-calendar text-green"></i>  {{date('d-m-Y H:i', strtotime($event->start_date))}} –  {{date('d-m-Y H:i', strtotime($event->end_date))}}</li>
                    <li><i class="icon-location text-green"></i> {{$event->location}}</li>
                  
                  </ul>
                </div>
                <div class="button_div">
                  <a href="{{url('event/details/'.$event->slug)}}" class="btn btn-50">Add to cart</a>
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


<!-- event -->