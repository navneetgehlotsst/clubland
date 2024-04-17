@extends('web.layout.master')
@section('content')
<style>

#upload-demo{
	width: 100%;
	height: 250px;
  padding-bottom:25px;
}

#upload-demo2{
	width: 100%;
	height: 250px;
  padding-bottom:25px;
}


  .error{
    color:red;
  }
  label#formFile-error {
    position: relative;
    padding-left: 154px;
}

  
  .btn-holder {
  width: 400px;
  height: 300px;
  margin: 50px auto 0;
}
.btn-lg.btn-toggle {
  padding: 0;
  margin: 0 5rem;
  position: relative;
  height: 2.5rem;
  width: 6rem;
  border-radius: 3rem;
  color: #6b7381;
  background: #bdc1c8;
  margin-bottom: 30px;
}
.btn-toggle.btn-lg > .switch {
    position: absolute;
    top: 0.2rem;
    left: 0.1rem;
    width: 2rem;
    height: 2rem;
    border-radius: 1.875rem;
    background: #fff;
    transition: left .25s;
}
.btn-toggle.active {
    background-color: #ff8800;
}
.btn-toggle.btn-lg.active > .switch {
    left: 3.75rem;
    transition: left .25s;
}

.btn-lg.btn-toggle:after {
    content: "Active";
    right: -5rem;
    opacity: 0.5;
    line-height: 2.5rem;
    width: 5rem;
    text-align: center;
    font-weight: 600;
    font-size: 1rem;
    letter-spacing: 2px;
    position: absolute;
    bottom: 0;
    transition: opacity .25s;
}

.btn-lg.btn-toggle.active:after {
  opacity: 1;
}

/*------------ CHECKBOX -------------*/
.toggle-switch {
  margin: 0 auto;
  margin-top: 20px;
  position: relative;
  margin-right: 141px;
}
.toggle-switch label {
  padding: 0;
}
input#cb-switch0 {
  display: none;
}
input#cb-switch1 {
  display: none;
}
input#cb-switch2 {
  display: none;
}
input#cb-switch3 {
  display: none;
}
input#cb-switch4{
    display: none;
}
.toggle-switch label input + span {
  position: relative;
    display: inline-block;
    margin-right: 0px;
    width: 3.2rem;
    height: 1.7rem;
    background: #bdc1c8;
    border: 1px solid #eee;
    border-radius: 50px;
    transition: all 0.3s ease-in-out;
    box-shadow: inset 0 0 5px #c8c8c8;
}
.toggle-switch label input + span small {
  position: absolute;
    display: block;
    width: 1.2rem;
    height: 1.2rem;
    border-radius: 1.875rem;
    background: #fff;
    transition: all 0.3s ease-in-out;
    top: 0.2rem;
    left: 0.2rem;
}
.toggle-switch label input:checked + span {
  background-color: #1e532e;
}
.toggle-switch label input:checked + span small{
    left: 1.7rem;
    transition: left .25s;
}

.toggle-switch label input:checked + span:after {
  opacity: 1;
}
.right_menu .feature_box .media_div.userprofile {
    width: 182px !important;
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
                <li>Header Section</li>
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
                  <h2 class="border_bottom mb-0">Header Edit</h2>
                </div>
              </div>
            </div>
            <form class="dashboard_form" action="{{ route('header_uplode') }}" name="headerform" enctype="multipart/form-data" method="post">
              @csrf
              <input type="hidden" value="{{auth()->user()->id}}" name="business_id">
              <div class="cabinet center-blocka feature_box border-bottom-0">
                  <div class="media_div userprofile">
                    @if(@$headerlogo->header_secation_image)
                  
                    <img id="perview_userprofile" src="{{asset('public/image_logo/'.@$headerlogo->header_secation_image)}}" alt="profile-upload-image">
                    @else
                    <img id="perview_userprofile" src="{{asset('/web/images/size-500-500.jpg')}}" alt="profile-upload-image">
                    @endif
                  </div>
                  <div class="feature_content">
                  
                    <span>JPEG or PNG 275x 60px Logo</span>
                    <div class="browse_div header_btn search_btn jb_cover">
                        <label for="formFile" class="btn">browse image</label>
                        @if(@$headerlogo->header_secation_image)
                        <input class="form-control item-img file center-block" name="image_logo"  accept="image/png, image/jpeg" type="file" id="formFile">
                        @else
                        <input class="form-control item-img file center-block" name="image_logo" required accept="image/png, image/jpeg" type="file" id="formFile">

                        @endif
                    </div>
                    @if ($errors->has('image_logo'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('image_logo') }}</span>
                    @endif
                  </div>
                </div>
                <div class="feature_box d-block">
                  <div class="edit-section-box">
                    <div class="title_div d-flex align-items-center justify-content-between mb-20">
                      <div class="titile-edit-section">
                        <h2 class="mb-0">Header Edit</h2>
                      </div>
                    </div>
                    <div class="title_div d-flex align-items-center justify-content-between mb-20">
                      <div class="titile-edit-section">
                        <h5 class="mb-0">Default Menu</h5>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-lg-5">
                        <div class="form-group comments_form">
                        <label class="form-label">Menu *</label>
                          <input type="text" name="de_menu[0]" readonly value="{{ @$data[0]->menu ?? 'Home' }}" class="form-control" placeholder="Add New">
                        </div>
                       
                      </div>
                     
                      <div class="col-lg-2">
                        <div class="form-group comments_form">
                        <label class="form-label">Order *</label>
                          <input type="text" name="de_order[0]" readonly value="{{ @$data[0]->order ?? '1' }}" class="form-control number" placeholder="Order">
                        </div>
                      </div>
                      <div class="col-lg-5">
                      <!-- <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input"  name="de_status[0]" id="Home" {{ @$data[0]->status ? 'checked' : '' }}>
                        <div class="btn-toggle-switch" >
                          <div class="handle"></div>
                        </div>
                        <label class="custom-control-label ml-3" for="Home">Inactive / Active</label>
                      </div> -->
                        <div class="custom-control custom-switch toggle-switch">
                          <label for="cb-switch0">
                            <input type="checkbox" id="cb-switch0" name="de_status[0]" {{ @$data[0]->status ? 'checked' : 'checked' }}>
                            <span>
                              <small></small>
                            </span>
                          </label>
                          <label class="custom-control-label ml-3" style="margin-right: -122px;" for="Shop">Inactive / Active</label>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-lg-5">
                        <div class="form-group comments_form">
                          <input type="text" name="de_menu[1]" readonly value="{{ @$data[1]->menu ?? 'Event' }}" class="form-control" placeholder="Add New">
                        </div>
                       
                      </div>
                     
                      <div class="col-lg-2">
                        <div class="form-group comments_form">
                          <input type="text" name="de_order[1]" readonly value="{{ @$data[1]->order ?? '2' }}" class="form-control number" placeholder="Order">
                        </div>
                      </div>
                      <div class="col-lg-5">
                      <!-- <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="de_status[1]" id="Event" {{ @$data[1]->status ? 'checked' : '' }}>
                        <div class="btn-toggle-switch">
                          <div class="handle"></div>
                        </div>
                        <label class="custom-control-label ml-3" for="Event">Inactive / Active</label>
                      </div> -->

                        <div class="custom-control custom-switch toggle-switch">
                          <label for="cb-switch1">
                            <input type="checkbox" id="cb-switch1" name="de_status[1]" {{ @$data[1]->status ? 'checked' : '' }}>
                            <span>
                              <small></small>
                            </span>
                          </label>
                          <label class="custom-control-label ml-3" style="margin-right: -122px;" for="Shop">Inactive / Active</label>
                        </div>

                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-lg-5">
                        <div class="form-group comments_form">
                          <input type="text" name="de_menu[2]" readonly value="{{ @$data[2]->menu ?? 'Club' }}" class="form-control" placeholder="Add New">
                        </div>
                       
                      </div>
                     
                      <div class="col-lg-2">
                        <div class="form-group comments_form">
                          <input type="text" name="de_order[2]" readonly value="{{ @$data[2]->order ?? '3' }}" class="form-control number" placeholder="Order">
                        </div>
                      </div>
                      <div class="col-lg-5">
                        <!-- <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" name="de_status[2]" id="Club" {{ @$data[2]->status ? 'checked' : '' }}>
                          <div class="btn-toggle-switch">
                            <div class="handle"></div>
                          </div>
                          <label class="custom-control-label ml-3" for="Club">Inactive / Active</label>
                        </div> -->

                        <div class="custom-control custom-switch toggle-switch">
                          <label for="cb-switch2">
                            <input type="checkbox" id="cb-switch2" name="de_status[2]" {{ @$data[2]->status ? 'checked' : '' }}>
                            <span>
                              <small></small>
                            </span>
                          </label>
                          <label class="custom-control-label ml-3" style="margin-right: -122px;" for="Shop">Inactive / Active</label>
                        </div>

                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-lg-5">
                        <div class="form-group comments_form">
                          <input type="text" name="de_menu[3]" readonly value="{{ @$data[3]->menu ?? 'Facility' }}" class="form-control" placeholder="Add New">
                        </div>
                       
                      </div>
                     
                      <div class="col-lg-2">
                        <div class="form-group comments_form">
                          <input type="text" name="de_order[3]" readonly value="{{ @$data[3]->order ?? '4' }}" class="form-control number" placeholder="Order">
                        </div>
                      </div>
                      <div class="col-lg-5">
                        <!-- <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" name="de_status[3]" id="facility" {{ @$data[3]->status ? 'checked' : '' }}>
                          <div class="btn-toggle-switch">
                            <div class="handle"></div>
                          </div>
                          <label class="custom-control-label ml-3" for="facility">Inactive / Active</label>
                        </div> -->
                        <div class="custom-control custom-switch toggle-switch">
                          <label for="cb-switch3">
                            <input type="checkbox" id="cb-switch3" name="de_status[3]" {{ @$data[3]->status ? 'checked' : '' }}>
                            <span>
                              <small></small>
                            </span>
                          </label>
                          <label class="custom-control-label ml-3" style="margin-right: -122px;" for="Shop">Inactive / Active</label>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-lg-5">
                        <div class="form-group comments_form">
                          <input type="text" name="de_menu[4]" readonly value="{{ @$data[4]->menu ?? 'Memberships' }}" class="form-control" placeholder="Add New">
                        </div>
                       
                      </div>
                     
                      <div class="col-lg-2">
                        <div class="form-group comments_form">
                          <input type="text" name="de_order[4]" readonly value="{{ @$data[4]->order ?? '5' }}" class="form-control number" placeholder="Order">
                        </div>
                      </div>
                      <div class="col-lg-5">
                        <!-- <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" name="de_status[4]" id="member" {{ @$data[4]->status ? 'checked' : '' }}>
                          <div class="btn-toggle-switch">
                            <div class="handle"></div>
                          </div>
                          <label class="custom-control-label ml-3" for="member">Inactive / Active</label>
                        </div> -->
                        <div class="custom-control custom-switch toggle-switch">
                          <label for="cb-switch4">
                            <input type="checkbox" id="cb-switch4" name="de_status[4]" {{ @$data[4]->status ? 'checked' : '' }}>
                            <span>
                              <small></small>
                            </span>
                          </label>
                          <label class="custom-control-label ml-3" style="margin-right: -122px;" for="Shop">Inactive / Active</label>
                        </div>
                      </div>
                    </div>
                      
                    <div class="row mt-3">
                     <div class="col-lg-6">
                        <div class="add-more-btn" style="margin-bottom: 35px;">
                          <a href="javascript:void(0)" id="addmore" data-count="{{count($header)}}"><span style="color: white;">Add New Menu +</span></a>
                        </div>
                      </div>
                    </div>

                    <div id="req_input">

                      @if(isset($header))
                      @foreach ($header as $key => $values)
                      <div class="row mb-2 required_inp">
                        <div class="col-lg-5">
                            <div class="form-group comments_form">
                              <input type="text" name="menu_name[{{$key}}]" required="" value="{{@$values->menu}}" class="form-control" placeholder="Enter New Add Menu">
                            </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group comments_form">
                            <input type="text" name="url[{{$key}}]" class="form-control" value="{{@$values->url}}" required="" placeholder="Enter Url">
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="form-group comments_form">
                            <input type="text" name="order[{{$key}}]"  min="6" class="form-control number" value="{{@$values->order}}" required="" placeholder="Enter Order">
                          </div>
                        </div>
                        <div class="col-lg-1 col-4 pl-3 pl-lg-0">
                          <div class="close-more-btn mt-3">
                            <a href="javascript:void(0)" class="inputRemove bg-red"><i class="icon-close text-white"></i></a>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      @endif
                    </div>
                  </div>
                    
                  <div class="col-lg-12 pl-0">
                    <div class="button_div float-end mt-30">
                      <button type="submit" class="btn btn-50">Update </button>
                    </div>
                  </div>
                </div>            
              </div>
            </form>
          </div>
        </div>
        <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">
                      
                      </h4>
                  </div>
                  <div class="modal-body">
                      <div id="upload-demo" class="center-block"></div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
                  </div>
                </div>
            </div>
        </div>
        </div>
      </div>
    
  </section>
  
  <!-- Dashboard Inner Content Section End -->
  @endsection