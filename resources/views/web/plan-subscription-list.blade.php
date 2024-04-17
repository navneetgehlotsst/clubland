@extends('web.layout.master')
@section('content')
<div class="page_title_section">
  <div class="page_header">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-8 col-12 col-sm-7">
          <h1>Membership</h1>
        </div>
        <div class="col-lg-3 col-md-4 col-12 col-sm-5">
          <div class="sub_title_section">
            <ul class="sub_title">
              <li> <a href="#"> Home </a>&nbsp; / &nbsp; </li>
              <li>Subscription</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="pricing_plan_wrapper jb_cover">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12 col-sm-12">
                <div class="jb_heading_wraper">

                    <h3>Choose Pricing Plan</h3>

                    <p class="theme-color">Your next level Product developemnt company assets</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                

            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                <div class="pricing_box_wrapper jb_cover">
                    <h1 class="font-weight-medium">Free Plan</h1>
                    <div class="main_pdet jb_cover">
                        <h2><span class="dollarr"> $ </span> 00 </h2> 
                        <span class="monthly"></span>
                    <div>
                      <h6 class="mt-3 text-white">4% of sales + $.50 per transaction</h6>
                  </div>
                    </div>
                    <ul class="pricing_list22">
                        <li>Lorem ipsum feature
                        </li>
                        <li>Lorem ipsum feature
                        </li>
                        <li>
                          Lorem ipsum feature

                        </li>
                        <li>Lorem ipsum feature
                        </li>
                        <li>Lorem ipsum feature

                        </li>

                    </ul>
                    <a href="{{route('purchase_plan')}}" class="price_btn">Select Plan</a>
                </div>

            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                

            </div>
        </div>
    </div>
</div>
	
@include('web.layout.faq-page')

@endsection