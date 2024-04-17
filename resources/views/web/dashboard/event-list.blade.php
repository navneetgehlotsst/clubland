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
                <li>Event List</li>
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
            <div class="title_div d-flex align-items-center justify-content-between mb-20">
              <div class="titile_content">
                <h2 class="border_bottom">All Events</h2>
              </div>
              <div class="add_new">
                <div class="button_div"><a class="btn mr-1" href="{{route('event_add')}}"><i class="icon-events"></i> Create New Events</a></div>
              </div>
            </div>
            <!--Event list start-->
            @forelse ($data as $val)
            <div class="d-block add_membership_plan p-0 my-3">
                <div class="row border">
                  <div class="col-lg-2 col-12 align-self-center px-0">
                    <div class="event-img">
                      <img src="{{asset('/event_image/'.@$val->geteventImage[0]['image'])}}" class="img-fluid w-100">
                    </div>
                  </div>
                  <div class="col-lg-8 col-12 px-3 align-self-center">
                    <div class="event-details mt-3 mt-lg-0">
                      <div class="event-name-amount status">
                        <a href="#"><h5 class="font-weight-bold mb-2">{{$val->name}}</h5></a>
                        <span class="ticket-price text-green">{{$val->ticket_type}}</span>
                      </div>
                      <p class="mb-2">{!! Str::words($val->event_description, 10, ' ...') !!}</p>
                      <div class="event-lists px-3 px-lg-0 py-3 py-lg-0">
                        <div class="row">
                          <div class="col-lg-4 col-12 py-2"><span class="fs-14"><i class="far fa-calendar-alt"></i> {{date('d-m-Y H:i', strtotime($val->start_date))}}</span></div>
                          <div class="col-lg-4 col-7 py-2"><span class="fs-14"><i class="fas fa-map-marker-alt"></i> {{$val->location}}</span></div>
                          <div class="col-lg-4 col-5 py-2"><span class="fs-14"><i class="far fa-list-alt"></i> {{$val->getEventCategory->name ?? ''}}</span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 align-self-center">
                    <div class="row action-btn px-2 actions-border">
                      <div class="col-lg-12 col-6 py-2"><a href="{{route('event_edit',$val->id)}}" class="py-2"><i class="fas fa-edit pr-1"></i> Edit</a></div>
                      <div class="col-lg-12 col-6 py-2"><a href="javascript:void(0);" class="py-2" data-toggle="modal" data-target="#EvtntdeleteModal" onclick="return DeleteEvent({{$val->id}})"><i class="fas fa-trash pr-2" style="color: #c93131;"></i> Delete</a></div>
                      <!-- <div class="col-lg-12 col-6 py-2"><a href="{{route('event_ticket_list',$val->id)}}" class="py-2"><img src="{{asset('/web/images/icon/tickets.svg')}}" alt="" class="pr-1"> Tickets</a></div> -->
                    </div>
                  </div>
                </div>
              </div>
            @empty
            <div class="d-block add_membership_plan p-0 my-3">
                <div class="row border">
                  <div class="col-lg-12 col-12 align-self-center px-0">
                    <center><b>No Event added yet!</b> </center>
                  </div>
                  
                </div>
              </div>
            @endforelse
            <!--Event list End-->
          </div>
          <div class="mt-3" style="float: right;">
              {{$data->links('pagination::bootstrap-4')}}
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Dashboard Inner Content Section End -->
  @endsection