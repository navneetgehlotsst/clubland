<!DOCTYPE html>
<html lang="">
<head>
<meta charset="utf-8" />
<title>Clubland Services</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta name="Clubland Service" content="" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/animate.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/bootstrap.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/fonts/icon/icon.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/custom.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/fonts.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/flaticon.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/font-awesome.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/jquery-ui.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/nice-select.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/reset.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/style.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/web/css/responsive.css')}}" />
<link rel="shortcut icon" type="image/png" href="{{asset('/web/images/customcolor_logo.png')}}" />
</head>
<style>
  .swal2-select{
      display:none !important;
    }
  .menu_btn_box .cartbtn_nav {
    padding: 18px 23px;
  }
  .cartbtn_nav i{
    font-size: 34px;
    color: #D97333;
    margin: 0;
  }
  .cartbtn_nav span{
    position: absolute;
    right: 15px;
    top: 24px;
    width: 23px;
    font-size: 13px;
    font-weight: 600;
    height: 23px;
    background-color: #fff;
    border-radius: 50%;
    color: #1E532E;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid #1E532E;
    z-index: 1;
  }
</style>

<body>
<div class="jb_preloader">
  <div class="spinner_wrap">
    <div class="spinner"></div>
  </div>
</div>
<div class="cursor"></div>
<a href="javascript:" id="return-to-top"><i class="fas fa-angle-double-up"></i></a>
<nav class="cd-dropdown  d-block d-sm-block d-md-block d-lg-none d-xl-none">
  <h2>
    <?php 
      $headerlogo = Helper::Getheaderlogo();
      $header = Helper::GetCompanyPoratalheader();
      $appnedheader = Helper::GetCompanyPoratalheaderAppend();
      $cart = Helper::GetcartCount();
    ?> 

    <a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}"> 
      @if($headerlogo)
      <span><img src="{{asset('public/image_logo/'.@$headerlogo->header_secation_image)}}" alt="img" style=" height: 67px;width: 247px;"></span>
      @else
      <span><img src="{{asset('/web/images/logo.png')}}" alt="img"></span>
      @endif
    </a>
</h2>
  <a href="#0" class="cd-close">Close</a>
  <ul class="cd-dropdown-content">
  @if(empty($header))  
  <ul class="main_nav_ul">

        <li><a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}" class="gc_main_navigation {{ request()->is('business/shop-portal/'.request('username')) ? 'active_class' : '' }}">Home </a></li>

        <li><a href="{{url('/event/all')}}" class="gc_main_navigation {{ request()->is('event/*') ? 'active_class' : '' }}">Event</a></li>

        <li> <a href="{{url('/product/all')}}" class="gc_main_navigation {{ request()->is('product/*') ? 'active_class' : '' }}"> Clubs</a></li>

        <li><a href="{{route('facility_all',request('username'))}}" class="gc_main_navigation {{ request()->is('business/shop-portal/' . request('username') . '/facility/*') ? 'active_class' : 'active_class' }}">Facility</a></li>

        <li><a href="{{url('/membership/all')}}" class="gc_main_navigation {{ request()->is('/membership/*') ? 'active_class' : '' }}">Membership</a></li>

   

  </ul>
  @else
  <ul class="main_nav_ul">
      @if(@$header[1]['status'] == '1')
      <li><a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}" class="gc_main_navigation {{ request()->is('/') ? 'active_class' : '' }}">{{@$header[0]['menu']}} </a></li>
      @endif
      @if(@$header[1]['status'] == '1')
      <li><a href="{{url('/event/all')}}" class="gc_main_navigation {{ request()->is('event/*') ? 'active_class' : '' }}">{{@$header[1]['menu']}}</a></li>
      @endif
      @if(@$header[2]['status'] == '1')
      <li> <a href="{{url('/product/all')}}" class="gc_main_navigation {{ request()->is('product/*') ? 'active_class' : '' }}"> {{@$header[2]['menu']}}</a></li>
      @endif
      @if(@$header[3]['status'] == '1')
      <li><a href="{{url('/facility/all')}}" class="gc_main_navigation {{ request()->is('/facility/*') ? 'active_class' : '' }}">{{@$header[3]['menu']}}</a></li>
      @endif
      @if(@$header[4]['status'] == '1')
      <li><a href="{{url('/membership/all')}}" class="gc_main_navigation {{ request()->is('/membership/*') ? 'active_class' : '' }}">{{@$header[4]['menu']}}</a></li>
      @endif
      @foreach ($appnedheader as $val)
        <li><a href="{{$val->url}}" class="gc_main_navigation" target="_blank">{{$val->menu}}</a></li>
      @endforeach
  </ul>
  @endif
</nav>

<div class="cp_navi_main_wrapper jb_cover">
  <div class="container-fluid">
    <div class="cp_logo_wrapper"> <a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}"> 
      @if($headerlogo)
      <img src="{{asset('public/image_logo/'.@$headerlogo->header_secation_image)}}" alt="logo" style=" height: 61px;">
      @else
      <img src="{{asset('/web/images/logo.png')}}" alt="logo">
      @endif
      
    
    </a> </div>
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
    <div class="menu_btn_box">
      <ul class="pt-3">
        <li><a href="{{url('/cart-list')}}" class="cartbtn_nav"><span class="notification_count">{{count($cart)}}</span><i class="fas fa-shopping-cart"></i></a> 
      </li>
      </ul>
    </div>
    <div class="jb_navigation_wrapper">
      <div class="mainmenu d-xl-block d-lg-block d-md-none d-sm-none d-none">
      @if(empty($header))  
        <ul class="main_nav_ul">
          <li><a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}" class="gc_main_navigation {{ request()->is('/') ? 'active_class' : '' }}">Home </a></li>

          <li><a href="{{url('/event/all')}}" class="gc_main_navigation {{ request()->is('event/*') ? 'active_class' : '' }}">Event</a></li>

          <li> <a href="{{url('/product/all')}}" class="gc_main_navigation {{ request()->is('product/*') ? 'active_class' : '' }}"> Clubs</a></li>

          <li><a href="{{url('/facility/all')}}" class="gc_main_navigation {{ request()->is('/facility/*') ? 'active_class' : '' }}">Facility</a></li>

          <li><a href="{{url('/membership/all')}}" class="gc_main_navigation {{ request()->is('/membership/*') ? 'active_class' : '' }}">Membership</a></li>

        </ul>
      @else
      <ul class="main_nav_ul">
          @if(@$header[0]['status'] == '1')
          <li><a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}" class="gc_main_navigation {{ request()->is('/') ? 'active_class' : '' }}">{{@$header[0]['menu']}} </a></li>
          @endif
          @if(@$header[1]['status'] == '1')
          <li><a href="{{url('/event/all')}}" class="gc_main_navigation {{ request()->is('event/*') ? 'active_class' : '' }}">{{@$header[1]['menu']}}</a></li>
          @endif
          @if(@$header[2]['status'] == '1')
          <li> <a href="{{url('/product/all')}}" class="gc_main_navigation {{ request()->is('product/*') ? 'active_class' : '' }}"> {{@$header[2]['menu']}}</a></li>
          @endif
          @if(@$header[3]['status'] == '1')
          <li><a href="{{url('/facility/all')}}" class="gc_main_navigation {{ request()->is('/facility/*') ? 'active_class' : '' }}">{{@$header[3]['menu']}}</a></li>
          @endif
          @if(@$header[4]['status'] == '1')
          <li><a href="{{url('/membership/all')}}" class="gc_main_navigation {{ request()->is('/membership/*') ? 'active_class' : '' }}">{{@$header[4]['menu']}}</a></li>
          @endif
          @foreach ($appnedheader as $val)
            <li><a href="{{$val->url ?? '#'}}" class="gc_main_navigation" target="_blank">{{$val->menu}}</a></li>
          @endforeach
        </ul>
      @endif
      </div>
    </div>
  </div>
</div>