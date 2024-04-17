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
                <li> <a href="{{route('website-home')}}"> Home </a>&nbsp; / &nbsp; </li>
                <li>Dashboard</li>
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
            <div class="feature_box d-block membership_plan_list">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                    <div class="titile_content">
                      <h2 class="border_bottom">Members</h2>
                    </div>
                </div>
               
                <div class="mambers-listing-btn mb-3">

                  <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                    <li class="nav-item button_div">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#active-members" role="tab" aria-controls="home" aria-selected="true">Active Members</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#inactive-members" role="tab" aria-controls="profile" aria-selected="false">Inactive Members</a>
                    </li>
                  </ul>

                </div>
                
              <div class="tab-content" id="myTabContent">
                
                <div class="tab-pane fade show active" id="active-members" role="tabpanel" aria-labelledby="home-tab">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                    
                  
                  @if(count($activedata) > 1) 
                  <div class="titile_content">
                   <span>{{count($activedata)}} Active Members</span>
                  </div>
                  @endif
                    <div class="add_new">
                      <div class="nav-item button_div">
                      <a class="btn orange-border-btn btn-50" href="{{route('active_csv','active')}}" >Download Active CSV</a>
                      </div>
                    </div>
                </div>
                  <!--Listing start-->
                  <ul class="plan_list border-0">
                    @forelse ($activedata as $val)
                      <li class="plan_item member-list-li border p-3">
                          <a href="{{route('member_details',$val->id)}}">
                            <div class="content_div">
                              <div class="content_inner">
                                <div class="event-name-amount status">
                                  <h3 class="d-flex align-content-center">{{$val->user_name}}</h3>
                                  <h3 class="">#ORDERID00{{$val->id}}</h3>
                                </div>
                                  <p class="text-dark mamber-list-email">{{$val->user_email}}</p>
                                  <div class="plan_type_terms d-block d-sm-flex align-content-center mt-3">
                                      <div class="plan_type">
                                          <span>Terms</span>
                                          @if($val->getMemeberShip->custome_month != 0)
                                          <p>{{$val->getMemeberShip->custome_month}} Month</p>

                                          @else
                                          <p>{{$val->getMemeberShip->plan_terms}}</p>

                                          @endif
                                      </div>
                                      <div class="plan_type">
                                        @if($val->card_token)
                                          <span>Price </span>
                                          <p>${{$val->destination_amount}}</p>
                                        @else
                                          <span>&nbsp;</span>
                                          <p><b>Free</b></p>
                                        @endif
                                      </div>
                                      <div class="plan_type">
                                          <span>Expiry date</span>
                                           <p>{{ date('d-m-Y', strtotime($val->expire_date)) }}</p>
                                          
                                      </div>
                                      <div class="plan_type">
                                          <span>Auto Renewal</span>
                                          <p>Available</p>
                                      </div>
                                  </div>
                              </div>
                              <div class="category-plan-box pl-1 pl-lg-5">
                                <p class="mamber-category align-items-center"><i class="icon-membership"></i><span>{{$val->getMemeberShip->membership_type}}</span></p>
                                <h3>{{$val->getMemeberShip->plan_name}}</h3>
                                <div class="button_div mr-3 text-left">
                                @if($val->autorenew == 1)
                                <a href="javascript:void(0);" class="btn orange-border-btn btn-50" data-toggle="modal" data-target="#Terminate" onclick="return Terminate({{$val->id}})">Terminate</a>
                                @else
                                <a href="javascript:void(0);" class="btn green-border-btn btn-50" data-toggle="modal" data-target="#Restore" onclick="return Restore({{$val->id}})">Restore</a>
                                @endif
                                  
                                </div>
                              </div>
                          </div>
                          </a>
                      </li> 
                    @empty
                      <li class="plan_item member-list-li border p-3">
                          No active members
                      <li>
                    @endforelse
                  </ul>
                  <!--Listing start-->
                  <div class="mt-3" style="float: right;">
                @if(count($activedata) > 1) 
                  {{$activedata->links('pagination::bootstrap-4')}}
                @endif
              </div>
                </div>
                
                <div class="tab-pane fade" id="inactive-members" role="tabpanel" aria-labelledby="profile-tab">
                  <!--Listing start-->
                  <div class="title_div d-flex align-items-center justify-content-between mb-20">
                       @if(count($inactivedata) > 1) 
                  <div class="titile_content">
                    <span>{{count($inactivedata)}} Inactive Members</span>
                  </div>
                  <div class="add_new">
                      <div class="nav-item button_div">
                      <a href="{{route('active_csv','inactive')}}" class="btn orange-border-btn btn-50">Download Inactive CSV</a>
                      </div>
                    </div>
                    @endif
                </div>
                  <ul class="plan_list border-0">
                  @forelse ($inactivedata as $vals)
                    <li class="plan_item member-list-li border p-3">
                      <a href="{{route('member_details',$vals->id)}}">
                        <div class="content_div">
                            <div class="content_inner">
                                <div class="event-name-amount status">
                                  <h3 class="d-flex align-content-center">{{$vals->user_name}}</h3>
                                  <h3 class="">#ORDERID00{{$vals->id}}</h3>
                                </div>
                              
                                <p class="text-dark mamber-list-email">{{$vals->user_email}}</p>
                                <div class="plan_type_terms d-block d-sm-flex align-content-center mt-3">
                                    <div class="plan_type">
                                        <span>Terms</span>
                                        @if($vals->getMemeberShip->custome_month != 0)
                                          <p>{{$vals->getMemeberShip->custome_month}} Month</p>
                                        @else
                                          <p>{{$vals->getMemeberShip->plan_terms}}</p>
                                        @endif
                                    </div>
                                    <div class="plan_type">
                                       @if($vals->card_token)
                                        <span>Price </span>
                                          <p>${{$vals->destination_amount}}</p>
                                        @else
                                        <span>&nbsp;</span>
                                          <p><b>Free</b></p>
                                         
                                        @endif
                                    </div>
                                    <div class="plan_type">
                                        <span>Status</span>
                                        @if($vals->autorenew == 0)
                                        <p class="text-danger">Terminate</p>

                                        @else
                                        <p class="text-danger">Expired</p>

                                        @endif
                                    </div>
                                    <div class="plan_type">
                                        <span>Auto Renewal</span>
                                        <p>Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="category-plan-box pl-1 pl-lg-5">
                            <p class="mamber-category align-items-center"><i class="icon-membership"></i><span>{{$vals->getMemeberShip->membership_type}}</span></p>
                                <h3>{{$vals->getMemeberShip->plan_name}}</h3>
                                <div class="button_div mr-3 text-left">
                                  @if($vals->autorenew == 1)
                                 
                                  @else
                                  <a href="javascript:void(0);" class="btn green-border-btn btn-50" data-toggle="modal" data-target="#Restore" onclick="return Restore({{$vals->id}})">Restore</a>
                                  @endif
                                  
                                </div>
                            </div>
                        </div>
                      </a>  
                    </li> 
                  @empty
                    <li class="plan_item member-list-li border p-3">
                    No inactive members
                    <li>
                  @endforelse
                  </ul>
                  <!--Listing start-->
                  <div class="mt-3" style="float: right;">
                @if(count($inactivedata) > 0) 

                  {{$inactivedata->links('pagination::bootstrap-4')}}
@endif
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
  @endsection
 