@extends('web.layout.master')
@section('content')


<div class="top_company_wrapper theme-bg jb_cover how-it-works">
  <div class="overlay-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="top_hiring_cpmpany_heading jb_cover">
            <div class="jb_heading_wraper left_jb_jeading">
              <h3 class="text-white text-center">How it works</h3>
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
        <div class="grow_next_img jb_cover"> <img src="{{asset('/web/images/club-registration.png')}}" class="img-responsive" alt="img"> </div>
      </div>
      <div class="col-lg-6 col-md-12 col-12 col-sm-12 align-self-center pl-0 pl-lg-5">
        <div class="jb_heading_wraper left_jb_jeading">
          <h3>Registration</h3>
        </div>
        <div class="grow_next_text jb_cover">
          <p>Registering for Clubland Services is quick, easy and, best of all, FREE. Once registered, you will have the ability to personalise your portal to best reflect your organisation. </p>
          <p>Add pictures, social media links and important information to your home page, essentially turning Clubland Services into your own personal website, free from the cost and hassle of developing one. Increase reach, reduce workload and improve financial tracking all with Clubland Services.</p>
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
<div class="grow_next_wrapper jb_cover bg-white">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-12 col-sm-12 align-self-center pr-0 pr-lg-5">
        <div class="jb_heading_wraper left_jb_jeading text-right">
          <h3>Membership and Product Selling</h3>
        </div>
        <div class="grow_next_text jb_cover text-right">
          <p>Allow your organisation to advertise and sell memberships, merchandise, and events online. Take the hassle out of selling by incorporating your major fundraising functions into your own portal. This makes Clubland Services the go-to place for your members, supporters and the general public. </p>
          <p>Create your own, individualised membership plans; upload and sell merchandise; create, promote and sell event tickets and manage facility bookings. Utilise the Clubland Services online payments system for easy purchasing and financial tracking. Track membership demographics, stock levels, event ticket sales and more while improving access, reducing work, and simplifying reporting all with Clubland Services.</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-12 col-sm-12 align-self-center">
        <div class="grow_next_img jb_cover"> <img src="{{asset('/web/images/membership-product-selling.png')}}" class="img-responsive" alt="img"> </div>
      </div>
    </div>
  </div>
</div>
<div class="grow_next_wrapper jb_cover bg-white">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-12 col-sm-12 align-self-center">
        <div class="grow_next_img jb_cover"> <img src="{{asset('/web/images/financial-dashboard.png')}}" class="img-responsive" alt="img"> </div>
      </div>
      <div class="col-lg-6 col-md-12 col-12 col-sm-12 align-self-center pl-0 pl-lg-5">
        <div class="jb_heading_wraper left_jb_jeading">
          <h3>Financial Dashboard</h3>
        </div>
        <div class="grow_next_text jb_cover">
          <p>Because of the payment system within Clubland Services, financial tracking is made easy. </p>
          <p>Easily track sales across multiple revenue streams, allowing greater accuracy of data while reducing the need to collate information from several sources. Remove the risk of poor record keeping and let Clubland Services manage your incoming revenue data, creating easy to access and use information for committee meetings, board reporting or the general day to day information required in running your organisation.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="grow_next_wrapper jb_cover bg-white">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-12 col-sm-12 align-self-center pr-0 pr-lg-5">
        <div class="jb_heading_wraper left_jb_jeading text-right">
          <h3>Grow Along With Us</h3>
        </div>
        <div class="grow_next_text jb_cover text-right">
          <p>When you join Clubland Services, you join a platform dedicated to improving clubs, groups, community organisations and anyone else who provides a service to their community.</p>
          <p>We provide the platform to increase your revenue while reducing the workload on your members and volunteers. This means we are always on the lookout for improvements and updates. Clubland Services members are encouraged to highlight potential value adding changes that will help us to help you.</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-12 col-sm-12 align-self-center">
        <div class="grow_next_img jb_cover"> <img src="{{asset('/web/images/grow-along.png')}}" class="img-responsive" alt="img"> </div>
      </div>
    </div>
  </div>
</div>
<div class="top_company_wrapper theme-bg jb_cover">
  <div class="container">
    <div class="pb-5">
      <h1 class="text-center text-white">Key features</h1>
      <!-- <p class="text-white text-center mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec<br> ullamcorper mattis, pulvinar dapibus leo.</p> -->
    </div>
    <div class="row">
      <div class="col-lg-4 mb-4">
        <div class="key-features-box p-0 p-lg-4">
          <div class="key-f-icon">
            <img src="{{asset('/web/images/icon/club-view-online.svg')}}" alt="icon">
          </div>
          <div class="pt-4">
            <h3 class="text-white pb-2">Member View Online</h3>
            <p class="text-white">Create and personalise your own portal to best represent your organisation. View all the important information from your personal dashboard to create and upload products and help track vital data.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="key-features-box p-0 p-lg-4">
          <div class="key-f-icon">
            <img src="{{asset('/web/images/icon/club-membership.svg')}}" alt="icon">
          </div>
          <div class="pt-4">
            <h3 class="text-white pb-2">Membership</h3>
            <p class="text-white">Sell, track and manage memberships. Create membership packages and easily track member demographics, sales, renewals and trends.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="key-features-box p-0 p-lg-4">
          <div class="key-f-icon">
            <img src="{{asset('/web/images/icon/cash-management.svg')}}" alt="icon">
          </div>
          <div class="pt-4">
            <h3 class="text-white pb-2">Cash Management</h3>
            <p class="text-white">Utilise the Clubland Services online payment system to allow ease of sale and financial tracking. Allow members, supporters and others to easily access your products and purchase online, removing the chance of forgotten orders or lost cash.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 mb-4">
        <div class="key-features-box p-0 p-lg-4">
          <div class="key-f-icon">
            <img src="{{asset('/web/images/icon/product-listing.svg')}}" alt="icon">
          </div>
          <div class="pt-4">
            <h3 class="text-white pb-2">Product Listing</h3>
            <p class="text-white">Advertise products through the online shop. Upload pictures, descriptions and easily track stock levels and sales figures. Add or remove items at any time through your portal and be notified when stock is running low. Remove the workload from volunteers and increase reach.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="key-features-box p-0 p-lg-4">
          <div class="key-f-icon">
            <img src="{{asset('/web/images/icon/product-buy.svg')}}" alt="icon">
          </div>
          <div class="pt-4">
            <h3 class="text-white pb-2">Product Sales</h3>
            <p class="text-white">Increase reach and ease of purchasing by utilising Clubland Services online payment platform. </p>
            <p class="text-white">Allow supporters, members and the public to easily browse, select and purchase products online, transforming your organisation in to a 24/7 business.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="key-features-box p-0 p-lg-4">
          <div class="key-f-icon">
            <img src="{{asset('/web/images/icon/grow-business.svg')}}" alt="icon">
          </div>
          <div class="pt-4">
            <h3 class="text-white pb-2">Grow Business</h3>
            <p class="text-white">Allowing all of these functions to be completed through one portal allows you to grow your reach, simplify purchasing and reduces the workload on volunteers, allowing your organisation to increase sales and accessibility.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('web.layout.faq-page')
@endsection