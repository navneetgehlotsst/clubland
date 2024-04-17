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
                <li>Notification List</li>
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
            <div class="title_div d-flex align-items-center justify-content-between">
              <div class="titile_content">
                <h2 class="border_bottom">All Notification</h2>
              </div>
             
            </div>
            <!--Event list start-->
            <div class="product-list">
              <div class="card border-0">
                <div class="card-body border p-0 border-top-0">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                              @forelse ($notification as $val)
                                <tr>
                                <td class="align-middle" style="width: 70px;">
                                @if($val->type == 'product')
                                  <a href="javascript:void(0)" class="d-bloxk notificationClick" data-id="{{$val->id}}" data-url="{{route('product_history')}}">
                                      <p>{{ $val->message }}</p>
                                      <div class="pb-3"><span>{{ \Carbon\Carbon::parse($val->created_at)->format('d M Y') }}</span></div>
                                      
                                  </a>
                                @endif
                                @if($val->type == 'event')
                                <a href="javascript:void(0)" class="d-bloxk notificationClick" data-id="{{$val->id}}" data-url="{{route('event_ticket_list',$val->event_id)}}">
                                      <p>{{ $val->message }}</p>
                                      <div class="pb-3"><span>{{ \Carbon\Carbon::parse($val->created_at)->format('d M Y') }}</span></div>
                                      
                                  </a>
                                @endif
                                @if($val->type == 'facility')
                                <a href="javascript:void(0)" class="d-bloxk notificationClick" data-id="{{$val->id}}" data-url="{{route('facility_history')}}">
                                      <p>{{ $val->message }}</p>
                                      <div class="pb-3"><span>{{ \Carbon\Carbon::parse($val->created_at)->format('d M Y') }}</span></div>
                                      
                                  </a>
                                @endif
                                @if($val->type == 'membership')
                                <a href="javascript:void(0)" class="d-bloxk notificationClick" data-id="{{$val->id}}" data-url="{{route('member_list')}}">
                                      <p>{{ $val->message }}</p>
                                      <div class="pb-3"><span>{{ \Carbon\Carbon::parse($val->created_at)->format('d M Y') }}</span></div>
                                      
                                  </a>
                                @endif
                                
                              </td>
                               
                                @empty
                                <tr>
                                <td class="align-middle text-center" colspan="6"><b>No notifications yet!</b></td>
                                    
                                </tr>
                                @endforelse
                               
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
              <div class="mt-3" style="float: right;">
                  {{$notification->links('pagination::bootstrap-4')}}
              </div>
            </div>
            <!--Event list End-->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Dashboard Inner Content Section End -->
  @endsection