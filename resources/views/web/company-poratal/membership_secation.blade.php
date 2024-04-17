

<!-- membership -->

@if($membershipdata->status == 1)
  <section class="shop_listing" style="margin-bottom: -100px!important;">
    <div class="container">
      <div class="d-flex align-content-center justify-content-between">
        <div class="heading_block">
          <h2>MemberShip Plan</h2>
        </div>
        <div class="button_div">
          <a href="{{url('/membership/all')}}" class="btn btn-border">View All</a>
        </div>
      </div>
      <div class="row">
      @forelse ($memnerships as $ship)
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="feature_box p-0">
            <div class="feature_content">
              <h3><a href="{{url('membership/details/'.$ship->slug)}}">{{$ship->plan_name}}</a></h3>
              <P class="description">{{mb_strimwidth($ship->sort_description, 0, 50, '...')}}</P>
              @if($ship->ticket_type == 'Paid')
                @if($ship->discount == 0)
                  <p class="price ">
                  <!-- ${{number_format(((3.75 / 100) * $ship->price) + 0.50 + $ship->price,2)}} -->
                  ${{$ship->price}}
                  </p>
                @else
                <p class="price ">${{$ship->fixed_amount}} <del> ${{$ship->price}}</del></p>
                 
                <!-- <p class="price ">${{number_format(((3.75 / 100) * $ship->fixed_amount) + 0.50 + $ship->fixed_amount,2)}} <del> ${{number_format(((3.75 / 100) * $ship->price) + 0.50 + $ship->price,2)}}</del></p> -->
                @endif
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
              <a href="{{url('/membership/'.$ship->slug.'/book-now')}}" class="btn btn-50">Book Now</a>
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

<!-- membership -->