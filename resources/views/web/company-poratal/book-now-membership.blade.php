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
#check_age-error.error {
    position: absolute;
    top: 18px;
    left: 16px;
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
            <div class="feature_box rounded bg-transparent">
              <div class="feature_content">
                <h2 class="border_bottom">{{$membership->plan_name}}</h2>
                <div class="price_div">
                    <div class="price_div mb-2">
                      @if($membership->ticket_type == 'Paid')
                        @if($membership->discount == 0)
                          <p class="price ">${{$membership->price}}</p>
                        @else
                        <span>${{$membership->fixed_amount}} </span><del> ${{$membership->price}}</del>
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

                <hr>
              @if($membership->ticket_type == 'Paid')
              <form action="{{url('/payment/'.$membership->slug.'/membership')}}" name="payment" method="post">
              @else
              <form action="{{url('/payment/'.$membership->slug.'/free')}}" name="payment" method="post">
              @endif
              @csrf
              <?php $j= $membership->maximum_people;?>
              @if($membership->membership_type != 'individual')
              <h5>Family Details</h5>
              <?php for ($i = 1; $i <= $j; $i++) { ?>
                 @if($i == '1')
                <div class="feature_box my-4">
                  <p class="h6"><strong>{{$i}}. Member</strong></p>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group comments_form">
                      <lable>Name</lable>
                      <input type="text" name="name[{{$i}}]" required class="form-control name" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group comments_form">
                        <lable>Phone Number</lable>
                        <input type="text" name="phone[{{$i}}]" required class="form-control number" placeholder="Phone Number">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group comments_form">
                        <lable>Email</lable>
                        <input type="email" name="people_email[{{$i}}]" required class="form-control" placeholder="Email">
                      </div>
                    </div>
                  </div>
                </div>
                @else
                <div class="feature_box my-4">
                  <p class="h6"><strong>{{$i}}. Member</strong></p>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group comments_form">
                      <lable>Name</lable>
                      <input type="text" name="name[{{$i}}]" required class="form-control name" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group comments_form">
                        <lable>Phone Number</lable>
                        <input type="text" name="phone[{{$i}}]" class="form-control number" placeholder="Phone Number">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group comments_form">
                        <lable>Email</lable>
                        <input type="email" name="people_email[{{$i}}]" class="form-control" placeholder="Email">
                      </div>
                    </div>
                  </div>
                </div>
                @endif
              <?php } ?>
              @endif
              
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                    <lable class="h6"><b>You are below 18 ?</b></lable><br>
                    <div class="row pt-2">
                      <div class="col-6">
                      <input type="radio" required name="check_age" value="1"><span class="ml-2">Yes</span> 
                      </div>
                      <div class="col-6">
                      <input type="radio" required name="check_age" value="0"><span class="ml-2">No</span> 
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
              <div class="row" id="Guardians" style="display:none;">

                        <div class="col-lg-12">
                          <h5>Parent or Guardians Details </h5>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group comments_form">
                            <lable>Name</lable>
                            <input type="text" name="parent_name" required class="form-control name" placeholder="Name">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group comments_form">
                            <lable>Phone Number</lable>
                            <input type="text" name="parent_phone_number" required class="form-control number" placeholder="Phone Number">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group comments_form">
                            <lable>Email</lable>
                            <input type="email" required name="parent_email" class="form-control" placeholder="Email">
                          </div>
                        </div>

                      </div>
              <h5>Billing Details</h5>
             
                <div class="row mt-3">
                 
                    <div class="col-lg-6">
                      <div class="form-group comments_form">
                        <lable>Name</lable>
                        <input type="text" name="user_name" required class="form-control name" placeholder="Name">
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
                      
                      
                     
                      @if(count($membership->getOwnQuestion) > 0)
                      <div class="col-lg-12">
                        <h5>Owner Question</h5>
                        <hr>
                      </div>
                      @endif
                    
                    @php $i=1 @endphp
                        @foreach($membership->getOwnQuestion as $key => $question)
                    <div class="col-lg-6">
                      <div class="form-group comments_form">
                        
                        
                        <lable>{{$i}}.</lable>
                        <lable>{{$question->question}}</lable>
                        <input type="text" required name="answer[{{$key}}]" class="form-control" placeholder="Answer {{$key+1}}">
                         <?php $i++ ?> 
                        
                      </div>
                    
                    </div>
                    @endforeach
                   
                    <div class="col-lg-12">
                    <div class="button_div mt-25" style="margin-top: 38px !important;">
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
