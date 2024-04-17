@extends('web.layout.master')
@section('content')
<style>
.error{
    color:red;
  }
  </style>
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
                <li>Footer Section</li>
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
          <div class="feature_box d-block border-bottom-0">
            <div class="title_div d-flex align-items-center justify-content-between">
              <div class="titile_content">
                <h2 class="border_bottom mb-0">Footer Edit</h2>
              </div>
            </div>
          </div>
          <form class="dashboard_form" action="{{ route('footer_uplode') }}" name="footer_form_data" enctype="multipart/form-data" method="post">
            @csrf
            <input type="hidden" value="{{auth()->user()->id}}" name="business_id">

            <div class="feature_box d-block">
              <div class="edit-section-box">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                  <div class="titile-edit-section">
                    <h2 class="mb-0">Address Section Edit</h2>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-lg-12">
                    <div class="form-group comments_form">
                      <label class="form-label">Section Name</label>
                      <input type="text" class="form-control" name="secation_first" value="{{@$number[0]->name}}" placeholder="Enter Section Name">
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-lg-11">
                    <div class="form-group comments_form">
                      <label class="form-label">Phone Number </label>
                      <input type="text" class="form-control number"  maxlength="12"   name="number[0]" value="{{@$number[0]->number}}" placeholder="Enter Phone Number">
                    </div>
                  </div>
               
                  <div class="col-lg-1 col-4 pl-3 pl-lg-0">
                    <div class="add-more-btn">
                      <a href="javascript:void(0)" id="footernumber" data-count="{{count(@$number)}}"><i class="icon-plus text-white"></i></a>
                    </div>
                  </div>
                </div>
                <div id="req_input_footer">
                  @if(isset($number[1]->number))
                     <div class="row mb-2">
                        <div class="col-lg-11">
                          <div class="form-group comments_form">
                            <input type="text" class="form-control number"  maxlength="12"  name="number[1]"  placeholder="Enter Phone Number" value="{{@$number[1]->number}}">
                          </div>
                        </div>
                        <div class="col-lg-1 col-4 pl-3 pl-lg-0">
                          <div class="close-more-btn mt-3">
                            <a href="javascript:void(0)" onclick="RemoveAddress({{@$number[1]->id}},'number')" class="footerinputRemoveNu bg-red"><i class="icon-close text-white"></i></a>
                          </div>
                        </div>
                      </div>
                   @endif 
                   @if(isset($number[2]->number))
                      <div class="row mb-2">
                        <div class="col-lg-11">
                          <div class="form-group comments_form">
                            <input type="text" class="form-control number" maxlength="12" name="number[2]" required placeholder="Enter Phone Number" value="{{@$number[1]->number}}">
                          </div>
                        </div>
                        <div class="col-lg-1 col-4 pl-3 pl-lg-0">
                          <div class="close-more-btn mt-3">
                            <a href="javascript:void(0)" class="footerinputRemoveNu bg-red" onclick="RemoveAddress({{@$number[2]->id}},'number')"><i class="icon-close text-white"></i></a>
                          </div>
                        </div>
                      </div>
                   @endif 
                   @if(isset($number[3]->number))
                      <div class="row mb-2">
                        <div class="col-lg-11">
                          <div class="form-group comments_form">
                            <input type="text" class="form-control number" maxlength="12" name="number[3]" required placeholder="Enter Phone Number" value="{{@$number[2]->number}}">
                          </div>
                        </div>
                        <div class="col-lg-1 col-4 pl-3 pl-lg-0">
                          <div class="close-more-btn mt-3">
                            <a href="javascript:void(0)" class="footerinputRemoveNu bg-red" onclick="RemoveAddress({{@$number[3]->id}},'number')"><i class="icon-close text-white"></i></a>
                          </div>
                        </div>
                      </div>
                   @endif 
                </div>

              <div class="edit-section-box mt-3">
                <div class="row mt-3">
                  <div class="col-lg-11">
                    <div class="form-group comments_form">
                      <label class="form-label">Email </label>
                      <input type="email" class="form-control"  name="email[0]" value="{{@$email[0]->email}}" placeholder="Enter Email">
                    </div>
                  </div>
                  
                  <div class="col-lg-1 col-4 pl-3 pl-lg-0">
                    <div class="add-more-btn">
                      <a href="javascript:void(0)" id="footeremail" data-count="{{count(@$email)}}"><i class="icon-plus text-white"></i></a>
                    </div>
                  </div>
                </div>
                <div id="req_input_email">
                   @if(isset($email[1]->email))
                      <div class="row mb-2">
                        <div class="col-lg-11">
                          <div class="form-group comments_form">
                            <input type="email" class="form-control" name="email[1]"  placeholder="Enter Email" value="{{@$email[1]->email}}" >
                          </div>
                        </div>
                        <div class="col-lg-1 col-4 pl-3 pl-lg-0">
                          <div class="close-more-btn mt-3">
                            <a href="javascript:void(0)" class="footerinputRemove bg-red" onclick="RemoveAddress({{@$email[1]->id}},'email')"><i class="icon-close text-white"></i></a>
                          </div>
                        </div>
                      </div>
                   @endif 
                   @if(isset($email[2]->email))
                      <div class="row mb-2">
                        <div class="col-lg-11">
                          <div class="form-group comments_form">
                            <input type="text" class="form-control" name="email[2]" required placeholder="Enter Email" value="{{@$email[1]->email}}">
                          </div>
                        </div>
                        <div class="col-lg-1 col-4 pl-3 pl-lg-0">
                          <div class="close-more-btn mt-3">
                            <a href="javascript:void(0)" class="footerinputRemove bg-red" onclick="RemoveAddress({{@$email[2]->id}},'email')"><i class="icon-close text-white"></i></a>
                          </div>
                        </div>
                      </div>
                   @endif 
                   @if(isset($email[3]->email))
                      <div class="row mb-2">
                          <div class="col-lg-11">
                            <div class="form-group comments_form">
                              <input type="text" class="form-control" name="email[3]" required placeholder="Enter Email" value="{{@$email[2]->email}}">
                            </div>
                          </div>
                          <div class="col-lg-1 col-4 pl-3 pl-lg-0">
                            <div class="close-more-btn mt-3">
                              <a href="javascript:void(0)" class="footerinputRemove bg-red" onclick="RemoveAddress({{@$email[3]->id}},'email')"><i class="icon-close text-white"></i></a>
                            </div>
                          </div>
                      </div>
                   @endif 
                </div>
              </div>
              <hr>
              <div class="edit-section-box">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                  <div class="titile-edit-section">
                    <h2 class="mb-0">Quick Links Section 1</h2>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-lg-12">
                    <div class="form-group comments_form">
                      <label class="form-label">Section Name</label>
                      <input type="text" class="form-control"  name="secation_second" placeholder="Enter Section Name" value="{{@$firstSec[0]->name}}">
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-lg-5">
                    <div class="form-group comments_form">
                      <label class="form-label">Add Menu </label>
                      <input type="text" class="form-control" name="sec_menu[]" placeholder="Enter Menu"
                      value="{{@$firstSec[0]->menu}}">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group comments_form">
                      <label class="form-label">URL </label>
                      <input type="text" class="form-control" name="sec_url[]" placeholder="Enter Url"
                      value="{{@$firstSec[0]->url}}">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group comments_form">
                      <label class="form-label">Order </label>
                      <input type="text" class="form-control number" name="sec_order[]" placeholder="Order" value="{{@$firstSec[0]->order}}">
                    </div>
                  </div>
                  <div class="col-lg-1 col-4 pl-3 pl-lg-0">
                    <div class="add-more-btn">
                      <a href="javascript:void(0)" id="footersecation1"><i class="icon-plus text-white"></i></a>
                    </div>
                  </div>
                </div>
                
                @foreach ($firstSec as $keyfirst => $values)
                @if($keyfirst > 0)
                <div class="row mb-2">
                  <div class="col-lg-5">
                    <div class="form-group comments_form">
                      <input type="text" class="form-control" name="sec_menu[{{$keyfirst}}]" placeholder="Enter Menu" value="{{@$values->menu}}">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group comments_form">
                      <input type="text" class="form-control" name="sec_url[{{$keyfirst}}]" placeholder="Enter Url" value="{{@$values->url}}">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group comments_form">
                      <input type="text" class="form-control number" name="sec_order[{{$keyfirst}}]" placeholder="Order" value="{{@$values->order}}">
                    </div>
                  </div>
                  <div class="col-lg-1 col-4 pl-3 pl-lg-0">
                    <div class="close-more-btn mt-3">
                      <a href="javascript:void(0)" class="footerSec1Remove bg-red" onclick="RemoveAddress({{@$values->id}},'secation')"><i class="icon-close text-white"></i></a>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
                <div id="req_input_secation_1">
                 
                </div>
                
              
              </div>
              <hr>
              <div class="edit-section-box">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                  <div class="titile-edit-section">
                    <h2 class="mb-0">Quick Links Section 2</h2>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-lg-12">
                    <div class="form-group comments_form">
                      <label class="form-label">Section Name</label>
                      <input type="text" class="form-control" name="secation_third" placeholder="Enter Section Name" value="{{@$SecondSec[0]->name}}">
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-lg-5">
                    <div class="form-group comments_form">
                      <label class="form-label">Add Menu </label>
                      <input type="text" class="form-control" name="sec_menu_2[]" placeholder="Enter Menu" value="{{@$SecondSec[0]->menu}}">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group comments_form">
                      <label class="form-label">URL </label>
                      <input type="text" class="form-control" name="sec_url_2[]" placeholder="Enter Url"
                      value="{{@$SecondSec[0]->url}}">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group comments_form">
                      <label class="form-label">Order </label>
                      <input type="text" class="form-control number" name="sec_order_2[]" placeholder="Order" value="{{@$SecondSec[0]->order}}">
                    </div>
                  </div>
                  <div class="col-lg-1 col-4 pl-3 pl-lg-0">
                    <div class="add-more-btn">
                      <a href="javascript:void(0)" id="footersecation2"><i class="icon-plus text-white"></i></a>
                    </div>
                  </div>
                </div>

               
                @foreach ($SecondSec as $keythird => $res)
                @if($keythird > 0)
                <div class="row mb-2">
                  <div class="col-lg-5">
                    <div class="form-group comments_form">
                      <input type="text" class="form-control" name="sec_menu_2[{{$keythird}}]"  placeholder="Enter Menu" value="{{@$res->menu}}">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group comments_form">
                      <input type="text" class="form-control" name="sec_url_2[{{$keythird}}]" placeholder="Enter Url" value="{{@$res->url}}">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group comments_form">
                      <input type="text" class="form-control number" name="sec_order_2[{{$keythird}}]" placeholder="Order" value="{{@$res->order}}">
                    </div>
                  </div>
                  <div class="col-lg-1 col-4 pl-3 pl-lg-0">
                    <div class="close-more-btn mt-3">
                      <a href="javascript:void(0)" class="footerSec2Remove bg-red" onclick="RemoveAddress({{@$res->id}},'secation')"><i class="icon-close text-white"></i></a>
                    </div>
                  </div>
                </div>
                @endif

                @endforeach
                <div id="req_input_secation_2">
                 
                 </div>
              </div>
              <hr>
              <div class="col-lg-12 pl-0">
                <div class="button_div float-end mt-30"><button type="submit" class="btn btn-50">Update </button></div>
              </div>
            </div>            
          </form>
        </div>
      </div>
      </div>
    </div>
  </section>
  <!-- Dashboard Inner Content Section End -->
  @endsection