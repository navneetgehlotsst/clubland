<!DOCTYPE html>
<html lang="">
<head>
<meta charset="utf-8" />
<title>Clubland Services</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta name="Clubland Service" content="" />
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/animate.css')}}" />

<link rel="stylesheet" type="text/css" href="{{asset('/web/css/bootstrap.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/gijgo.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/flaticon.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/font-awesome.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/jquery-ui.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/nice-select.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/reset.css')}}" />
<link rel="shortcut icon" type="image/png" href="{{asset('/web/images/customcolor_logo.png')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('web/css/fullcalendar.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('web/css/icons.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('web/fonts/icon/icon.css')}}" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/style.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/responsive.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/custom.css')}}" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" />

</head>

<body>
  <style>
    .swal2-select{
      display:none !important;
    }
    .notification-box-menu{
  max-width: 350px;
  left: -130px !important;
  top: -10px !important;
  box-shadow: 3px 5px 14px 0px rgb(0 0 0 / 18%);
  border-radius: 5px !important;
}

.notification-box-menu span{
  font-size: 12px;
  float: left !important;
}

.notification-box-menu p{
  font-size: 14px;
}


.onsite-notifications__tip {
  display: block;
  position: absolute;
  top: -8px;
  right: 160px;
  pointer-events: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  height: 25px;
  width: 25px;
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
  z-index: -1;
  background-color: #fff;
  box-shadow: 0 14px 42px 0 rgba(0,0,0,.2);
  border: 1px solid rgba(0,0,0,.15);
}
  </style>
<div class="jb_preloader">
  <div class="spinner_wrap">
    <div class="spinner"></div>
  </div>
</div>
  <?php 
     $notification = Helper::GetAllNotification();
  ?> 
<div class="cursor"></div>
<a href="javascript:" id="return-to-top"><i class="fas fa-angle-double-up"></i></a>
<nav class="cd-dropdown  d-block d-sm-block d-md-block d-lg-none d-xl-none">
  <h2><a href="{{route('website-home')}}"> <span><img src="{{asset('/web/images/logo.png')}}" alt="img"></span></a></h2>
  <a href="#0" class="cd-close">Close</a>
  <ul class="cd-dropdown-content">
    <li ><a href="{{route('website-home')}}">Home</a> </li>
    <li ><a href="{{route('about_us')}}">About</a> </li>
    <li><a href="{{route('how_it_work')}}">How it works</a></li>
    <li><a href="{{route('login_business')}}">Login</a></li>
  </ul>
</nav>
@if(Auth::check())
<div class="cp_navi_main_wrapper jb_cover dashboard_header">
    <div class="container-fluid">
      <div class="cp_logo_wrapper"> <a href="{{route('website-home')}}"> <img src="{{asset('web/images/logo.png')}}" alt="logo"> </a> </div>
      <header class="mobail_menu d-block d-sm-block d-md-block d-lg-none d-xl-none">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="cd-dropdown-wrapper"> <a class="house_toggle" href="#0">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                    id="Capa_1" x="0px" y="0px" viewBox="0 0 31.177 31.177"
                    style="enable-background:new 0 0 31.177 31.177;" xml:space="preserve" width="25px" height="25px">
                    <g>
                      <g>
                        <path class="menubar"
                          d="M30.23,1.775H0.946c-0.489,0-0.887-0.398-0.887-0.888S0.457,0,0.946,0H30.23    c0.49,0,0.888,0.398,0.888,0.888S30.72,1.775,30.23,1.775z"
                          fill="#004165" />
                      </g>
                      <g>
                        <path class="menubar"
                          d="M30.23,9.126H12.069c-0.49,0-0.888-0.398-0.888-0.888c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,8.729,30.72,9.126,30.23,9.126z"
                          fill="#004165" />
                      </g>
                      <g>
                        <path class="menubar"
                          d="M30.23,16.477H0.946c-0.489,0-0.887-0.398-0.887-0.888c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,16.079,30.72,16.477,30.23,16.477z"
                          fill="#004165" />
                      </g>
                      <g>
                        <path class="menubar"
                          d="M30.23,23.826H12.069c-0.49,0-0.888-0.396-0.888-0.887c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,23.43,30.72,23.826,30.23,23.826z"
                          fill="#004165" />
                      </g>
                      <g>
                        <path class="menubar"
                          d="M30.23,31.177H0.946c-0.489,0-0.887-0.396-0.887-0.887c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.398,0.888,0.888C31.118,30.78,30.72,31.177,30.23,31.177z"
                          fill="#004165" />
                      </g>
                    </g>
                  </svg>
                </a> </div>
            </div>
          </div>
        </div>
      </header>
      <div class="jb_navigation_wrapper">
        <div class="mainmenu d-xl-block d-lg-block d-md-none d-sm-none d-none">
          <ul class="main_nav_ul">
            <li><a href="{{route('website-home')}}" class="gc_main_navigation {{ request()->is('/') ? 'active_class' : '' }}">Home</a></li>
            <li><a href="{{route('about_us')}}" class="gc_main_navigation {{ request()->is('about-us') ? 'active_class' : '' }}">About</a></li>
            <li><a href="{{route('how_it_work')}}" class="gc_main_navigation {{ request()->is('how-it') ? 'active_class' : '' }}">How it works</a></li>
            <li>
              <a href="#" class="notification_nav" role="button" data-toggle="dropdown" aria-expanded="false">
              <span class="notification_count">{{count($notification)}}</span>
              <i class="icon-bell"></i>
            </a>
            


<div class="dropdown-menu px-3 notification-box-menu p-0" style="width: 350px !important;">
              <div class="onsite-notifications__tip"></div>
                <div class="notification-list-item bg-white pt-2">
                @if(count($notification) > 0)
                 @foreach($notification as $key=> $val)
                  @if($key < 5)
                    @if($val->type == 'product')
                      <a href="javascript:void(0)" class="d-bloxk notificationClick" data-id="{{$val->id}}" data-url="{{route('product_history')}}">
                          <p>{{ $val->message }}</p>
                          <div class="pb-3"><span>{{ \Carbon\Carbon::parse($val->created_at)->format('d M Y') }}</span></div>
                          <hr>
                      </a>
                    @endif
                    @if($val->type == 'event')
                    <a href="javascript:void(0)" class="d-bloxk notificationClick" data-id="{{$val->id}}" data-url="{{route('event_ticket_list',$val->event_id)}}">
                          <p>{{ $val->message }}</p>
                          <div class="pb-3"><span>{{ \Carbon\Carbon::parse($val->created_at)->format('d M Y') }}</span></div>
                          <hr>
                      </a>
                    @endif
                    @if($val->type == 'facility')
                    <a href="javascript:void(0)" class="d-bloxk notificationClick" data-id="{{$val->id}}" data-url="{{route('facility_history')}}">
                          <p>{{ $val->message }}</p>
                          <div class="pb-3"><span>{{ \Carbon\Carbon::parse($val->created_at)->format('d M Y') }}</span></div>
                          <hr>
                      </a>
                    @endif
                    @if($val->type == 'membership')
                    <a href="javascript:void(0)" class="d-bloxk notificationClick" data-id="{{$val->id}}" data-url="{{route('member_list')}}">
                          <p>{{ $val->message }}</p>
                          <div class="pb-3"><span>{{ \Carbon\Carbon::parse($val->created_at)->format('d M Y') }}</span></div>
                          <hr>
                      </a>
                    @endif

                  @else
                      @break
                  @endif
                 @endforeach 

                @else
                    <div class="text-center">
                      <img src="{{asset('/web/images/notification.png')}}" alt="notification image" style="width: 150px;">
                      <p class="pb-3 text-green">No notifications yet.</p>

                    </div>  
                    
                @endif
                </div>
                @if(count($notification) > 0)
                <div class="text-center pb-5"><a href="{{route('all_notification')}}"><span class="bg-quantity w-100">View All Notification</span></a></div>
                @else
                    
                @endif
            </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="user_profile">
         <div  class="d-flex link-body-emphasis text-decoration-none" role="button" data-toggle="dropdown" aria-expanded="false" >
            @if(Auth::user()->image_path)
              <img src="{{Auth::user()->image_path}}" alt="mdo" width="50" height="50" class="rounded-circle">
            @else
            <img src="{{asset('web/images/user-img.png')}}" alt="mdo" width="50" height="50" class="rounded-circle">
            @endif
            <div class="user-content text-start">
            <span class="h4">{{Auth::user()->full_name ?? ''}} </span>
            <p class="mb-0 h3">{{mb_strimwidth(Auth::user()->business_info->club_name, 0, 15, '...')}}</p>
            </div>
          </div>
          <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('b_dashboard') }}"><i class="icon-dashboard"></i> Dashboard</a>
            <a class="dropdown-item" href="{{ route('business_edit_profile') }}"><i class="icon-profile"></i> Edit Profile</a>
            <a class="link dropdown-item" href="{{ route('user.logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="icon-power-off"></i> Log out</a>
            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </div>
      </div>
    </div>
  </div>
@else
<div class="cp_navi_main_wrapper jb_cover">
  <div class="container-fluid">
    <div class="cp_logo_wrapper"> <a href="{{route('website-home')}}"> <img src="{{asset('/web/images/logo.png')}}" alt="logo"> </a> </div>
    <header class="mobail_menu d-block d-sm-block d-md-block d-lg-none d-xl-none">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="cd-dropdown-wrapper"> <a class="house_toggle" href="#0">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 31.177 31.177" style="enable-background:new 0 0 31.177 31.177;" xml:space="preserve" width="25px" height="25px">
                <g>
                  <g>
                    <path class="menubar" d="M30.23,1.775H0.946c-0.489,0-0.887-0.398-0.887-0.888S0.457,0,0.946,0H30.23    c0.49,0,0.888,0.398,0.888,0.888S30.72,1.775,30.23,1.775z" fill="#004165" />
                  </g>
                  <g>
                    <path class="menubar" d="M30.23,9.126H12.069c-0.49,0-0.888-0.398-0.888-0.888c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,8.729,30.72,9.126,30.23,9.126z" fill="#004165" />
                  </g>
                  <g>
                    <path class="menubar" d="M30.23,16.477H0.946c-0.489,0-0.887-0.398-0.887-0.888c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,16.079,30.72,16.477,30.23,16.477z" fill="#004165" />
                  </g>
                  <g>
                    <path class="menubar" d="M30.23,23.826H12.069c-0.49,0-0.888-0.396-0.888-0.887c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,23.43,30.72,23.826,30.23,23.826z" fill="#004165" />
                  </g>
                  <g>
                    <path class="menubar" d="M30.23,31.177H0.946c-0.489,0-0.887-0.396-0.887-0.887c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.398,0.888,0.888C31.118,30.78,30.72,31.177,30.23,31.177z" fill="#004165" />
                  </g>
                </g>
              </svg>
              </a> </div>
          </div>
        </div>
      </div>
    </header>
    <div class="menu_btn_box header_btn jb_cover">
      <ul>
        <li> <a href="{{route('business_register')}}" class=" d-xl-block d-lg-block d-md-none d-sm-none d-none">Register</a> </li>
        <li> <a href="{{route('login_business')}}"> <i class="flaticon-login"></i> Login</a> </li>
      </ul>
    </div>
    <div class="jb_navigation_wrapper">
      <div class="mainmenu d-xl-block d-lg-block d-md-none d-sm-none d-none">
        <ul class="main_nav_ul">
        <li><a href="{{route('website-home')}}" class="gc_main_navigation {{ request()->is('/') ? 'active_class' : '' }}">Home</a></li>
            <li><a href="{{route('about_us')}}" class="gc_main_navigation {{ request()->is('about-us') ? 'active_class' : '' }}">About</a></li>
          <li><a href="{{route('how_it_work')}}" class="gc_main_navigation {{ request()->is('how-it') ? 'active_class' : '' }}">How it works</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endif