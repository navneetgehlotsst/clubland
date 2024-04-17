@extends('web.layout.master')
@section('content')


<div class="top_company_wrapper theme-bg jb_cover how-it-works">
  <div class="overlay-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="top_hiring_cpmpany_heading jb_cover">
            <div class="jb_heading_wraper left_jb_jeading">
              <h3 class="text-white text-center">About Us</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="grow_next_wrapper jb_cover bg-white">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-12 col-sm-12 align-self-center">
        <div class="grow_next_img jb_cover"> <img src="{{asset('/web/images/about-us-img.png')}}" class="img-responsive" alt="img"> </div>
      </div>
      <div class="col-lg-6 col-md-12 col-12 col-sm-12 align-self-center pl-0 pl-lg-5">
        <div class="jb_heading_wraper left_jb_jeading">
          <h3>About Clubland services</h3>
        </div>
        <div class="grow_next_text jb_cover">
          <p>Clubland Services was born by the idea that there was a world of efficiency available in the administration of sporting clubs, community organisations and any group that has a membership base, sells merchandise, runs events, or wishes to bring people together.</p>
          <p>With decades of experience in the administration of clubs and organisations behind it, Clubland Services was designed by administrators, for administrators. We know the struggles because we’ve lived the struggles, and we wanted to change that.</p>
          <p>Clubland Services is a one-stop-shop for the management of Memberships, Events, Merchandise and more, removing the need for multiple apps or platforms, and consolidating financial reporting into one place. Improve access, increase sales, and gain greater oversight all while reducing the workload on your biggest asset: your volunteers.</p>
          <p>At Clubland Services, we understand the importance of community organisations because we’ve been involved in them for decades. That’s why we have committed to investing back into community organisations through grants, scholarships, and sponsorships. We are committed to improving access to sports and clubs for underprivileged kids, providing support to talented people to access pathways for progress and to helping struggling clubs attract and retain talent.</p>
          <p>So join us and be a part of retaining, growing and promoting these integral pillars of the community and improving access for the next generation, all while improving the administration experience and reducing the workload of your volunteers.</p>

          <div class="header_btn search_btn jb_cover">
          @if(Auth::check())

          @else
          <a href="{{route('business_register')}}">Register Now</a>
          @endif
             
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="grow_next_wrapper pt-0 jb_cover bg-white">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-12 col-12 col-sm-12">
        <div class="mt-3">
          <h4>Our Core Values</h4>
          <p class="mt-3">At Clubland Services we grew up around clubs and groups and understand their value to the community. Whether it be a sporting club, community organisation, not for profit or any other group, we want to help you succeed.</p>
          <p class="mt-3">We understand that volunteers are the backbone of these organisations and have strived to develop a way to reduce their workload while improving their efficiency.</p>
          <p class="mt-3">We do this so our members can spend more time doing what they do best, helping their communities. That’s why we have committed to helping too, investing back into local communities through grants, scholarships and sponsorships so we can help everyone feel the joy we have felt over our years in these organisations.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-12 col-12 col-sm-12">
        <div class="mt-3">
          <h4>Our vision</h4>
          <p class="mt-3">Clubland services aims to provide an opportunity for clubs, groups and organisations to take their revenue to the next level all while reducing workload and simplifying functions. We aim to do this to not only help your organisation remain viable, but to flourish.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-12 col-12 col-sm-12">
        <div class="mt-3">
          <h4>Our mission</h4>
          <p class="mt-3">Clubland Services is dedicated to improving the viability and strength of community groups, sports clubs and organisations. We believe these groups are the backbone of communities, so we strive to improve their ability to maintain and grow their future. </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- <div class="grow_next_wrapper pt-0 jb_cover bg-white">
  <div class="container">
    <div class="green-box pt-4 py-lg-5">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-6 col-sm-12 mb-3">
          <div class="about-progress">
            <img src="{{asset('/web/images/icon/registrar-club.svg')}}" alt="icon">
            <h4 class="mt-3">5K</h4>
            <p class="text-white">Registrar Club</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 col-sm-12 mb-3">
          <div class="about-progress">
            <img src="{{asset('/web/images/icon/product-listing-box.svg')}}" alt="icon">
            <h4 class="mt-3">30K</h4>
            <p class="text-white">Product Listing</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 col-sm-12 mb-3">
          <div class="about-progress">
            <img src="{{asset('/web/images/icon/happy-customer.svg')}}" alt="icon">
            <h4 class="mt-3">130K</h4>
            <p class="text-white">Happy Customer</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 col-sm-12 mb-3">
          <div class="about-progress">
            <img src="{{asset('/web/images/icon/positive-reviews.svg')}}" alt="icon">
            <h4 class="mt-3">97%</h4>
            <p class="text-white">Positive Reviews</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->


<!-- <div class="services_wrapper jb_cover pt-0">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 col-md-12 col-sm-12 m-auto">
        <div class="jb_heading_wraper">
          <h3 class="mb-3">Meet our team</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam feugiat neque sed lacus condimentum, id bibendum velit vehicula. Sed est lacus, luctus in pulvinar ut, sollicitudin sed lorem. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
        <div class="our-team-box text-center py-5 px-3">
          <img src="{{asset('/web/images/user-photo.png')}}" alt="img">
          <h3 class="my-3">James Symes</h3>
          <span class="text-green">CO-Founder</span>
          <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
        <div class="our-team-box text-center py-5 px-3">
          <img src="{{asset('/web/images/user-photo.png')}}" alt="img">
          <h3 class="my-3">James Symes</h3>
          <span class="text-green">CO-Founder</span>
          <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
        <div class="our-team-box text-center py-5 px-3">
          <img src="{{asset('/web/images/user-photo.png')}}" alt="img">
          <h3 class="my-3">James Symes</h3>
          <span class="text-green">CO-Founder</span>
          <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
        <div class="our-team-box text-center py-5 px-3">
          <img src="{{asset('/web/images/user-photo.png')}}" alt="img">
          <h3 class="my-3">James Symes</h3>
          <span class="text-green">CO-Founder</span>
          <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
        <div class="our-team-box text-center py-5 px-3">
          <img src="{{asset('/web/images/user-photo.png')}}" alt="img">
          <h3 class="my-3">James Symes</h3>
          <span class="text-green">CO-Founder</span>
          <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
        <div class="our-team-box text-center py-5 px-3">
          <img src="{{asset('/web/images/user-photo.png')}}" alt="img">
          <h3 class="my-3">James Symes</h3>
          <span class="text-green">CO-Founder</span>
          <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
    </div>
  </div>
</div> -->


<div class="counter_wrapper jb_cover">
  <div class="counter_overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 offset-lg-1 offset-md-1 col-md-10 col-sm-12 col-xs-12 m-auto">
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

@include('web.layout.faq-page')
@endsection