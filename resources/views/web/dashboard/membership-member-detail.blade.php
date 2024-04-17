@extends('web.layout.master')
@section('content')
  <!-- Title Section Start -->
  <div class="page_title_section dashbord_title">
    <div class="page_header">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-8 col-12 col-sm-7 align-items-center d-flex">
            <div class="left_menu_icon" id="left_menu_icon"></div>
            <h1>Dashboard</h1>
          </div>
          <div class="col-lg-3 col-md-4 col-12 col-sm-5">
            <div class="sub_title_section">
              <ul class="sub_title">
                <li> <a href="#"> Home </a>&nbsp; / &nbsp; </li>
                <li>Member-Ship Details</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Title Section End -->
  <!-- Dashboard Inner Content Section Start -->
  <section class="dashboard_inner_content">
    <div class="container">
      <div class="row">
        @include('web.layout.sidebar')
        <div class="col-xl-9 col-lg-8">
          <div class="right_menu">
            <div class="feature_box d-block membership_plan_list border-bottom-0">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                    <div class="titile_content">
                      <h2 class="border_bottom mb-0">Member Details</h2>
                    </div>
                </div>
                <div class="member-detail-box">
                  <ul class="plan_list border-0 mb-0">
                    <li class="plan_item member-list-li border p-3">
                        <div class="content_div">
                            <div class="content_inner">
                                <h3 class="d-flex align-content-center">{{$data->user_name}}</h3>
                                <div class="plan_type_terms d-block d-sm-flex align-content-center mt-3">
                                    <div class="plan_type">
                                        <span>Terms</span>
                                           @if($data->getMemeberShip->custome_month != 0)
                                          <p>{{$data->getMemeberShip->custome_month}} Month</p>

                                          @else
                                          <p>{{$data->getMemeberShip->plan_terms}}</p>

                                          @endif
                                    </div>
                                    <div class="plan_type">
                                        @if($data->payment_status)
                                          <span>Price </span>
                                          <p>${{$data->destination_amount}}</p>
                                        @else
                                          <span>&nbsp;</span>
                                          <p><b>Free</b></p>
                                        @endif
                                    </div>
                                    <div class="plan_type">
                                        <span>Expiry date</span>
                                        @if($data->expire_date < $currentDate)
                                        <p class="text-danger">Expired</p>
                                        @else
                                        <p>{{ date('d-m-Y', strtotime($data->expire_date)) }}</p>

                                        @endif
                                    </div>
                                    <div class="plan_type">
                                        <span>Auto Renewal</span>
                                        <p>Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="category-plan-box">
                              <p class="mamber-category align-items-center"><i class="icon-membership"></i><span>{{$data->getMemeberShip->membership_type}}</span></p>
                                <h3>{{$data->getMemeberShip->plan_name}}</h3>
                              <div class="button_div mr-3 text-left">
                                @if($data->autorenew == 1)
                                <a href="javascript:void(0);" class="btn orange-border-btn btn-50" data-toggle="modal" data-target="#Terminate" onclick="return Terminate({{$data->id}})">Terminate</a>
                                @else
                                <a href="javascript:void(0);" class="btn green-border-btn btn-50" data-toggle="modal" data-target="#Restore" onclick="return Restore({{$data->id}})">Restore</a>
                                @endif
                              
                              
                              </div>
                            </div>
                        </div>
                    </li> 
                  </ul>
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                      <div class="mamber-contect-details py-3">
                        <p class="mt-2">Full name</p>
                        <span>{{$data->user_name}}</span>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                      <div class="mamber-contect-details py-3">
                        <p class="mt-2">Email Address</p>
                        <span>{{$data->user_email}}</span>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                      <div class="mamber-contect-details py-3">
                        <p class="mt-2">Phone Number</p>
                        <span>{{$data->phone_number}}</span>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                      <div class="mamber-contect-details py-3">
                        <p class="mt-2">Subscription Date</p>
                        <span>{{ date('d-m-Y', strtotime($data->created_at)) }}</span>
                      </div>
                    </div>
                  </div>
                  @if($data->getmembershipGuardiansDetails)
                  <div class="feature_box my-4 d-block">
                    <p class="h6"><strong>Guardians Details</strong></p>
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="py-1">
                          <p class="mt-2"><span class="pr-1"><i class="fas fa-user"></i></span>{{$data->getmembershipGuardiansDetails->name}}</p>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="py-1">
                          @if($data->getmembershipGuardiansDetails->email)
                            <p class="mt-2"><span class="pr-1"><i class="fas fa-envelope"></i></span>{{$data->getmembershipGuardiansDetails->email}}</p>
                          @endif
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="py-1">
                          @if($data->getmembershipGuardiansDetails->phone_number)
                            <p class="mt-2"><span class="pr-1"><i class="fas fa-phone"></i></span>{{$data->getmembershipGuardiansDetails->phone_number}}</p>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                  @if($data->getMemeberShip->membership_type == 'family')
                    @foreach($data->getMemeberShipMember as $key => $member)
                    <div class="feature_box my-4 d-block">
                      <p class="h6"><strong> Member Details {{$key + 1}}</strong></p>
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="py-1">
                            <p class="mt-2"><span class="pr-1"><i class="fas fa-user"></i></span>{{$member->name}}</p>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="py-1">
                            @if($member->email)
                              <p class="mt-2"><span class="pr-1"><i class="fas fa-envelope"></i></span>{{$member->email}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="py-1">
                            @if($member->phone)
                              <p class="mt-2"><span class="pr-1"><i class="fas fa-phone"></i></span>{{$member->phone}}</p>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  @endif
                  
                </div>
            </div>
            <div class="question-answer-box px-4 py-2 px-lg-5 py-lg-3 ">
              <div class="row">
                @php
                 $ans = explode(',',$data->owner_answer);
                @endphp
                @foreach($data->getMemeberShipQuestion as $ke => $question)
                <div class="col-lg-12">
                  <div class="mamber-contect-details py-3">
                    <span>Question {{$ke + 1}}.{{$question->question}}</span>
                    <p class="mt-2">{{$ans[$ke]}}</p>
                  </div>
                </div>
                @endforeach
                <!-- <div class="col-lg-12">
                  <div class="mamber-contect-details py-3">
                    <span>Do you identify as a person with a disability?</span>
                    <p class="mt-2">No Answer</p>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
   <!-- Paln Delete Modal Start-->
<div class="modal fade" id="Terminate" tabindex="-1" role="dialog" aria-labelledby="planModalLabel" aria-hidden="true" style="margin-top: 185px;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="planModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center py-5">
          <h3 class="font-weight-bold mb-2">Are you sure you want to terminate <br> this existing membership ?</h3>
          
        </div>
      </div>
      <div class="modal-footer button_div text-center">
        <button type="button" class="btn orange-border-btn btn-50" data-dismiss="modal">Close</button>
        <form class="dashboard_form" action="{{route('terminate_membership')}}" name="planform" method="post">
              @csrf
              <input type="hidden" id="order_id" name="order_id" value="">
              <input type="hidden" id="status" name="status" value="0">

              <button type="submit" class="btn btn-50">Terminate</button>
        </form>      
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="Restore" tabindex="-1" role="dialog" aria-labelledby="planModalLabel" aria-hidden="true" style="margin-top: 185px;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="planModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center py-5">
          <h3 class="font-weight-bold mb-2">Are you sure you want to restore <br> this existing membership ?</h3>
          
        </div>
      </div>
      <div class="modal-footer button_div text-center">
        <button type="button" class="btn orange-border-btn btn-50" data-dismiss="modal">Close</button>
        <form class="dashboard_form" action="{{route('terminate_membership')}}" name="planform" method="post">
              @csrf
              <input type="hidden" id="order_id" name="order_id" value="">
              <input type="hidden" id="status" name="status" value="1">
              <button type="submit" class="btn btn-50">Restore</button>
        </form>      
      </div>
    </div>
  </div>
</div>
<!-- Paln Delete Modal End-->
  <!-- Dashboard Inner Content Section End -->
  <!-- Dashboard Inner Content Section End -->
  @endsection