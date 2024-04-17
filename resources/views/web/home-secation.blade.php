@extends('web.layout.master')

@section('content')





<div class="jb_banner_wrapper jb_cover">

  <div class="jb_banner_left">

    <h5 class="theme-color font-weight-medium">Welcome to Clubland Services</h5>

    <h1 class="font-weight-medium">The easy way to get more business</h1>

    <p>Clubland Services is your one-stop-shop for Membership, Event, Merchandise and Facility Management. We allow you to consolidate these functions to remove the need for multiple apps or platforms, improving financial tracking, reducing workloads on volunteers, and allowing better oversight and tracking of your organisation’s day to day.</p>

    <div class="header_btn search_btn jb_cover"> 
    @if(Auth::check())
    @else
        <a href="{{route('business_register')}}">Register</a>
    @endif
      
     </div>

  </div>

  <div class="jb_banner_right d-none d-sm-none d-md-none d-lg-none d-xl-block"> </div>

</div>

<div class="services_wrapper jb_cover">

  <div class="container">

    <div class="row">

      <div class="col-lg-8 m-auto">

        <div class="jb_heading_wraper">

          <h3 class="mb-3">Become a member to power <br>

          your organisation.</h3>

          <p>With Clubland Services, you will be joining a platform dedicated to improving efficiency, reducing workload and supporting its members, allowing you to take your organisation to the next level. </p>

        </div>

      </div>

      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

        <div class="services_content jb_cover"> <img src="{{asset('/web/images/registration.png')}}" alt="img">

          <h3><a href="javascript:void();">Easy Registration</a></h3>

          <p>Sign up is quick and easy, there is no membership fee and there is no lock-in contract.</p>

        </div>

      </div>

      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

        <div class="services_content jb_cover"> <img src="{{asset('/web/images/access.png')}}" alt="img">

          <h3><a href="javascript:void();">One Stop Platform </a></h3>

          <p>Consolidate all your events and products in one place through your own individual portal. Sell, manage, track and report all financial transactions through one place, improving accuracy and efficiency.</p>

        </div>

      </div>

      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

        <div class="services_content jb_cover"> <img src="{{asset('/web/images/dash.png')}}" alt="img">

          <h3><a href="javascript:void();">Financial Dashboard </a></h3>

          <p>Track financials through your own dashboard. Report on sales, profits, expenses and more.  </p>

        </div>

      </div>

      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

        <div class="services_content jb_cover"> <img src="{{asset('/web/images/communication.png')}}" alt="img">

          <h3><a href="javascript:void();">Communications</a></h3>

          <p>Send communications to members, event attendees and designated groups. </p>

        </div>

      </div>

    </div>

  </div>

</div>
<div class="jb_category_wrapper jb_cover">

  <div class="container">

    <div class="row">

      <div class="col-lg-10 m-auto">

        <div class="jb_heading_wraper">

          <h3>Features We Provide</h3>

          <!-- <p class="theme-color">Your next level Product lorem ipsum management system</p> -->

        </div>

      </div>

      <div class="col-lg-3 col-md-6 col-sm-12 col-6">

        <div class="jb_browse_category jb_cover"> <a href="javascript:;">

          <div class="hover-block"></div>

          <img src="{{asset('/web/images/membership.png')}}" alt="">

          <h3>Membership sales and management</h3><br>
          <p>Promote, sell, track and manage your members in one easy to use platform.</p>

          </a> </div>

      </div>

      <div class="col-lg-3 col-md-6 col-sm-12 col-6">

        <div class="jb_browse_category jb_cover"> <a href="javascript:">

          <div class="hover-block"></div>

          <img src="{{asset('/web/images/events.png')}}" alt="">

          <h3>Events sales and management</h3>
<br>
<p>Promote, sell, track and manage events, ticket sales, attendees and finances.</p>
          </a> </div>

      </div>

      <div class="col-lg-3 col-md-6 col-sm-12 col-6">

        <div class="jb_browse_category jb_cover"> <a href="javascript:">

          <div class="hover-block"></div>

          <img src="{{asset('/web/images/shop.png')}}" alt="">

          <h3>Online shop </h3>
<br><p>Upload your merchandise and track orders, sales, stock levels and more.</p>
          </a> </div>

      </div>

      <div class="col-lg-3 col-md-6 col-sm-12 col-6">

        <div class="jb_browse_category jb_cover"> <a href="javascript:">

          <div class="hover-block"></div>

          <img src="{{asset('/web/images/facility.png')}}" alt="">

          <h3>Facility booking and management</h3>
          <br><p>Promote and track facility bookings, calendars and process payments.</p>
          </a> </div>

      </div>

      <div class="col-lg-10 m-auto pd5">

        <div class="row">

          <div class="col-lg-4 col-md-6 col-sm-12 col-6">

            <div class="jb_browse_category jb_cover"> <a href="javascript:">

              <div class="hover-block"></div>

              <img src="{{asset('/web/images/communications.png')}}" alt="">

              <h3>Communications </h3>
              <br><p>Enable bulk communications with members, staff, players, committee and more. </p>
              </a> </div>

          </div>

          <div class="col-lg-4 col-md-6 col-sm-12 col-6">

            <div class="jb_browse_category jb_cover"> <a href="javascript:">

              <div class="hover-block"></div>

              <img src="{{asset('/web/images/tasks.png')}}" alt="">

              <h3>Task management</h3>

              </a> </div>

          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">

            <div class="jb_browse_category jb_cover"> <a href="javascript:">

              <div class="hover-block"></div>

              <img src="{{asset('/web/images/supports.png')}}" alt="">

              <h3>Support</h3>

              </a> </div>

          </div>

        </div>

      </div>

      <div class="header_btn search_btn load_btn jb_cover"> <a href="javascript:void(0); ">Know more</a> </div>

    </div>

  </div>

</div>



<div class="top_company_wrapper theme-bg jb_cover">

  <div class="container">

    <div class="row">

      <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

        <div class="top_hiring_cpmpany_heading jb_cover">

          <div class="jb_heading_wraper left_jb_jeading">

            <h3 class="text-white">Who Works With Us?</h3>

          </div>

          <p class="text-white">Clubland Services provides support and access for sporting clubs, community organisations, community groups, not for profits and any other group or individual looking to improve access, sales and financial reporting. </p>

        </div>

      </div>

      <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

        <div class="animation-circle-inverse"><i></i><i></i><i></i></div>

        <div class="top_company_slider_wrapper jb_cover">

          <div class="owl-carousel owl-theme">

            <div class="item">

              <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12  col-6">

                  <div class="company_main_wrapper">

                    <div class="company_img_wrapper"><img src="{{asset('/web/images/clubs-bg.jpg')}}" alt=""></div>

                    <div class="company_img_cont_wrapper">

                      <h4 class="font-weight-medium">CLUBS</h4>

                    </div>

                  </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-12  col-6">

                  <div class="company_main_wrapper">

                    <div class="company_img_wrapper"><img src="{{asset('/web/images/vendors-bg.jpg')}}" alt=""></div>

                    <div class="company_img_cont_wrapper">

                      <h4 class="font-weight-medium">VENDORS</h4>

                    </div>

                  </div>

                </div>

              </div>

            </div>

            <div class="item">

              <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12  col-6">

                  <div class="company_main_wrapper">

                    <div class="company_img_wrapper"><img src="{{asset('/web/images/clubs-bg.jpg')}}" alt=""></div>

                    <div class="company_img_cont_wrapper">

                      <h4 class="font-weight-medium">CLUBS</h4>

                    </div>

                  </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-12  col-6">

                  <div class="company_main_wrapper">

                    <div class="company_img_wrapper"><img src="{{asset('/web/images/vendors-bg.jpg')}}" alt=""></div>

                    <div class="company_img_cont_wrapper">

                      <h4 class="font-weight-medium">VENDORS</h4>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<div class="grow_next_wrapper jb_cover">

  <div class="container">

    <div class="row">

      <div class="col-lg-6 col-md-12 col-12 col-sm-12">

        <div class="jb_heading_wraper left_jb_jeading">

          <h3>Grow next level business</h3>

          <!-- <p class="theme-color">#1 lorem ispum trusted  company</p> -->

        </div>

        <div class="grow_next_text jb_cover">

          <p>Grow your organisation by streamlining the sales and management of your biggest financial products. Increase access to sales, improve tracking and reporting and allow ease of use for your customers through your own personalised portal, all without the need for the expense involved with developing your own website.<br>


          </p>

          <div class="header_btn search_btn jb_cover"> 
          @if(Auth::check())
       
          @else
          <a class="w-50" href="{{route('business_register')}}">Register your business</a> 
          @endif
          
          </div>

        </div>

      </div>

      <div class="col-lg-6 col-md-12 col-12 col-sm-12">

        <div class="grow_next_img jb_cover"> <img src="{{asset('/web/images/grow-bg.jpg')}}" class="img-responsive" alt="img"> </div>

      </div>

    </div>

  </div>

</div>

<div class="counter_wrapper jb_cover">

  <div class="counter_overlay"></div>

  <div class="container">

    <div class="row">

      <div class="col-lg-10 m-auto">

        <div class="counter_mockup_design text-center jb_cover">

          <div class="animation-circle-inverse"><i></i><i></i><i></i></div>

          <div class="a-contemporary-membership">

            <h1 class="text-center text-white">A contemporary experience tailored

              for the modern organization.</h1>

            <p class="text-white mt-3">Bring your organisation into the future with improved access, simpler purchasing, greater reach and 24/7 access to products. Utilise the power of Clubland services to become a one stop shop for your members, supporters and community and improve efficiency and accuracy within your organisation.</p>

            <div class="header_btn text-center search_btn mt-5 load_btn testi_btn  jb_cover">

              <div class=" search_btn  learn_btn  "> 
              @if(Auth::check())

              @else
              <a href="{{route('business_register')}}">Register</a>
              @endif
             
                <a href="{{route('contact_us')}}">Contact</a> 
              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<div class="blog_wrapper pb-3 jb_cover">

  <div class="container pb-5">

    <div class="row">

      <div class="col-lg-4 col-md-12 col-sm-12">

        <div class="blog_newsleeter jb_cover">

          <div class="animation-circle-inverse"><i></i><i></i><i></i></div>

              <form action="{{route('inquiry.store')}}" method="post">

                @csrf

                <h1>Get in touch</h1>

                <p>To get in touch, please provide 

                  following information:</p>

                <div class="contect_form3 blog_letter">

                  <input type="text" required name="content" placeholder="How can we help ?">

                </div>

                <div class="contect_form3 blog_letter">

                  <input type="text" required name="name" placeholder="Your name">

                </div>

                <div class="contect_form3 blog_letter">

                  <input type="email" required name="email" placeholder="Your email">

                </div>

                <div class="header_btn search_btn submit_btn jb_cover">

                   <!-- <a href="#">submit</a> -->

                   <button type="submit" class="submit_btn btn btn-50 w-100 d-flex align-items-center justify-content-center text-white">submit</button> 

                  </div>

              </form>

        </div>

      </div>

      <div class="col-lg-8 col-md-12 col-sm-12">

        <div class="row">

          <div class="col-lg-12 col-md-12 col-sm-12">

            <div id="accordion" role="tablist" >

              <h1>Frequently Asked Question?</h1>

              @foreach($faq as $key => $val)

                <div class="card">

                  <div class="card_pagee" role="tab" id="heading1">

                    <h5 class="h5-md"> <a class="collapsed" data-toggle="collapse" href="#collapse{{$key}}" role="button" aria-expanded="false" aria-controls="collapse{{$key}}"> {{$val->question}} </a> </h5>

                  </div>

                  <div id="collapse{{$key}}" class="collapse" role="tabpanel" aria-labelledby="heading1" data-parent="#accordion" style="">

                    <div class="card-body">

                      <div class="card_cntnt">

                        <p>{{$val->answer}}</p>

                      </div>

                    </div>

                  </div>

                </div>

              @endforeach

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

@endsection