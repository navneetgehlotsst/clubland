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
                <li>Membership Plans</li>
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
                      <h2 class="border_bottom">Plan List</h2>
                      <span>{{count($data)}} Membership Plans</span>
                    </div>
                    <div class="add_new">
                        <div class="button_div">
                            <a class="btn mr-1" href="{{route('add_plan')}}">
                                <i class="icon-membership"></i> Add New Plan
                            </a>
                        </div>
                        <div class="search_div">
                        <form method="get" action="" id="planSerach">
                            <input type="text" placeholder="Search" name="keyword" value="{{request('keyword')}}" id="plan_search">
                            <i class="icon-search"></i></form>
                        </div>
                    </div>
                </div>
                <ul class="plan_list">
                    @forelse ($data as $val)
                        <li class="plan_item">
                            <div class="content_div">
                                <div class="content_inner">
                                    <h3 class="d-flex justify-content-between align-content-center"><span class="plan_name ">{{ucfirst($val->plan_name)}}</span> <span class="plan_price">{{ucfirst($val->ticket_type)}}</span></h3>
                                    <div class="plan_type_terms d-block d-sm-flex justify-content-between align-content-center">
                                        <div class="plan_type">
                                            <span>Membership Type</span>
                                            <p>{{ucfirst($val->membership_type)}}</p>
                                        </div>
                                        <div class="plan_terms">
                                            <span>Membership Terms</span>
                                            <p>{{ucfirst($val->plan_terms)}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="button_div">
                                    <a href="{{route('edit_plane',$val->id)}}"><i class="fas fa-edit"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-close pr-0" data-toggle="modal" data-target="#PalndeleteModal" onclick="return DeletePlan({{$val->id}})"><i class="fas fa-trash" style="color: #c93131;"></i></a>

                                </div>
                            </div>
                             
                            @if($val->membership_type == 'individual')
                              
                            @else
                            <p class="total_members"><span>Total Members</span>{{$val->maximum_people}}</p>
                            @endif
                          
                        </li>
                        @empty
                            <li class="plan_item" style="text-align: center;">
                                <div class="content_div">
                                    <div class="content_inner">
                                    <b>No existing plans yet!</b>
                                    </div>
                                </div>
                            </li>
                        @endforelse
                   
                    <!-- <li class="plan_item">
                        <div class="content_div">
                            <div class="content_inner">
                                <h3 class="d-flex justify-content-between align-content-center"><span class="plan_name ">Trial</span> <span class="plan_price">FREE</span></h3>
                                <div class="plan_type_terms d-block d-sm-flex justify-content-between align-content-center">
                                    <div class="plan_type">
                                        <span>Membership Type</span>
                                        <p>Individual</p>
                                    </div>
                                    <div class="plan_terms">
                                        <span>Membership Terms</span>
                                        <p>1 Week</p>
                                    </div>
                                </div>
                            </div>
                            <div class="button_div">
                                <a href="#" class="btn green_light-border">Edit</a>
                                <a href="#" class="btn btn-close pr-0"><i class="uil uil-multiply"></i></a>
                            </div>
                        </div>
                        <p class="total_members"><span>Total Members</span> 1,216</p>
                    </li>
                    <li class="plan_item">
                        <div class="content_div">
                            <div class="content_inner">
                                <h3 class="d-flex justify-content-between align-content-center"><span class="plan_name ">Trial</span> <span class="plan_price">FREE</span></h3>
                                <div class="plan_type_terms d-block d-sm-flex justify-content-between align-content-center">
                                    <div class="plan_type">
                                        <span>Membership Type</span>
                                        <p>Individual</p>
                                    </div>
                                    <div class="plan_terms">
                                        <span>Membership Terms</span>
                                        <p>1 Week</p>
                                    </div>
                                </div>
                            </div>
                            <div class="button_div">
                                <a href="#" class="btn green_light-border">Edit</a>
                                <a href="#" class="btn btn-close pr-0"><i class="uil uil-multiply"></i></a>
                            </div>
                        </div>
                        <p class="total_members"><span>Total Members</span> 1,216</p>
                    </li>
                    <li class="plan_item">
                        <div class="content_div">
                            <div class="content_inner">
                                <h3 class="d-flex justify-content-between align-content-center"><span class="plan_name ">Trial</span> <span class="plan_price">FREE</span></h3>
                                <div class="plan_type_terms d-block d-sm-flex justify-content-between align-content-center">
                                    <div class="plan_type">
                                        <span>Membership Type</span>
                                        <p>Individual</p>
                                    </div>
                                    <div class="plan_terms">
                                        <span>Membership Terms</span>
                                        <p>1 Week</p>
                                    </div>
                                </div>
                            </div>
                            <div class="button_div">
                                <a href="#" class="btn green_light-border">Edit</a>
                                <a href="#" class="btn btn-close pr-0"><i class="uil uil-multiply"></i></a>
                            </div>
                        </div>
                        <p class="total_members"><span>Total Members</span> 1,216</p>
                    </li> -->
                    
                </ul>
                
                <!-- <p class="upgrade_note"><span>You have reached the limit of your total membership creation.</span> <a class="link">Upgrade to create more</a></p> -->
            </div>
            <div class="mt-3" style="float: right;">
                    {{$data->links('pagination::bootstrap-4')}}
                </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Paln Delete Modal Start-->
<div class="modal fade" id="PalndeleteModal" tabindex="-1" role="dialog" aria-labelledby="planModalLabel" aria-hidden="true" style="margin-top: 185px;">
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
          <h3 class="font-weight-bold mb-2">Are you sure you want to delete this existing plan ?</h3>
          <p>This will delete this post permanently. You cannot undo this action</p>
        </div>
      </div>
      <div class="modal-footer button_div text-center">
        <button type="button" class="btn orange-border-btn btn-50" data-dismiss="modal">Close</button>
        <form class="dashboard_form" action="{{route('plan_remove')}}" name="planform" method="post">
              @csrf
              <input type="hidden" id="plan_id" name="plan_id" value="">
              <button type="submit" class="btn btn-50">Delete</button>
        </form>      
      </div>
    </div>
  </div>
</div>
<!-- Paln Delete Modal End-->
  <!-- Dashboard Inner Content Section End -->
  @endsection