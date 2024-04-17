@extends('web.layout.master')
@section('content')
<style> 
.error{
    color:red;
  }
  label#formFile-error {
    position: relative;
    padding-left: 139px;
    padding-top: 8px;
}
label#formFile1-error {
    position: relative;
    padding-left: 139px;
    padding-top: 8px;
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
input#cb-switch1 {
  display: none;
}
input#cb-switch2 {
  display: none;
}
input#cb-switch3 {
  display: none;
}
input#cb-switch4 {
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
                <li>AboutUs Section</li>
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
                <h2 class="border_bottom mb-0">About Us Page Edit</h2>
              </div>
            </div>
          </div>
          @if($data)
          <form class="dashboard_form" name="aboutsecation" action="{{route('aboutsecation_update')}}" enctype="multipart/form-data" method="post">
          @else
          <form class="dashboard_form" name="aboutsecation" action="{{route('aboutsecation_store')}}" enctype="multipart/form-data" method="post">
          @endif
          @csrf
            <div class="feature_box border-bottom-0">
              <div class="media_div userprofile">
              @if(isset($data->home_image))
                <img id="perview_userprofile" src="{{asset('/public/AboutBannerImage/'.@$data->home_image)}}" alt="profile-upload-image">
              @else
              <img id="perview_userprofile" src="{{asset('web/images/img-icon1920x650.png')}}" alt="profile-upload-image">
              @endif
              </div>
              <div class="feature_content">
                <span>JPEG or PNG 1920x 650px Home Banner</span>
                <div class="browse_div header_btn search_btn jb_cover">
                    <label for="formFile" class="btn">browse image</label>
                    @if(isset($data->home_image))
                    <input class="form-control" accept="image/jpeg"  type="file" id="formFile" name="about_banner">
                    @else
                    <input class="form-control" accept="image/jpeg" required type="file" id="formFile" name="about_banner">
                    @endif
                </div>
              </div>
            </div>
            <div class="feature_box d-block">
              <div class="edit-section-box">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                  <div class="titile-edit-section">
                    <h2 class="mb-0">About Section Edit</h2>
                  </div>

                  <!-- <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="about_status" id="customSwitch1" {{ @$data->status ? 'checked' : '' }}>
                    <div class="btn-toggle-switch">
                      <div class="handle"></div>
                    </div>
                    <label class="custom-control-label ml-3" for="customSwitch1">Inactive / Active</label>
                  </div> -->

                  <div class="custom-control custom-switch toggle-switch">
                    <label for="cb-switch1">
                      <input type="checkbox" id="cb-switch1" class="aboutSecationImage" name="about_status" {{ @$data->status ? 'checked' : '' }}>
                      <span>
                        <small></small>
                      </span>
                    </label>
                    <label class="custom-control-label ml-3" style="margin-right: -122px;" for="Shop">Inactive / Active</label>
                  </div>

                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">Image Show</label>
                      <select class="form-control form-select w-100" required name="about_Image_status" aria-label="Default select example" onchange="ImageyDiv(this)">
                      <option value="1" {{ @$data->image_hide_show == 1 ? 'selected' : '' }}>YES</option>
                        <option value="2" {{ @$data->image_hide_show == 2 ? 'selected' : '' }}>NO</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    @if(isset($data) && @$data->image_hide_show == 2)
                      <div class="form-group comments_form"  id="imageside" style="display:none;">
                    @else
                      <div class="form-group comments_form"  id="imageside">
                    @endif
                      <label class="form-label">Image Left/Right </label>
                      <select class="form-control form-select w-100" required name="about_Image_side" aria-label="Default select example">
                        <option value="1" {{ @$data->image_left_right == 1 ? 'selected' : '' }}>Left Side</option>
                        <option value="2" {{ @$data->image_left_right == 2 ? 'selected' : '' }}>Right Side</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-12 mt-3">
                    <div class="form-group comments_form textarea-h-120">
                      <label>About Description</label>
                      <textarea class="form-control" id="editor" required name="about_description" placeholder="Description">{{@$data->description}}</textarea>
                    </div>
                  </div>
                  @if(isset($data->image_hide_show) && @$data->image_hide_show == 2)
                  <div class="col-lg-12" id="imageSecation" style="display:none;">
                  @else
                  <div class="col-lg-12" id="imageSecation">
                  @endif
                    <div class="feature_box">
                      <div class="media_div userprofile">
                      @if(@$data->about_image != '')
                        <img id="perview_banner" src="{{asset('/public/aboutSecation/'.@$data->about_image)}}" alt="profile-upload-image">
                      @else
                      <img id="perview_banner" src="{{asset('web/images/user-profile-default.jpg')}}" alt="profile-upload-image">

                      @endif
                      </div>
                      <div class="feature_content">
                        <span>JPEG or PNG 500x 300px About Image</span>
                        <div class="browse_div header_btn search_btn jb_cover">
                            <label for="formFile1" class="btn">browse image</label>
                            @if(isset($data->about_image))
                            <input class="form-control" accept="image/jpeg"  type="file" id="formFile1" name="about_image">
                            @else
                            <input class="form-control" accept="image/jpeg" type="file" id="formFile1" name="about_image">

                            @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="edit-section-box">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                  <div class="titile-edit-section">
                    <h2 class="mb-0">Our Core Values Section Edit</h2>
                  </div>
                  
                  <!-- <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch4" name="we_secation_status" {{ @$aboutcontent->we_secation_status ? 'checked' : '' }}>
                    <div class="btn-toggle-switch">
                      <div class="handle"></div>
                    </div>
                    <label class="custom-control-label ml-3" for="customSwitch4">Inactive / Active</label>
                  </div> -->

                  <div class="custom-control custom-switch toggle-switch">
                    <label for="cb-switch2">
                      <input type="checkbox" id="cb-switch2" class="aboutsecationOur" name="we_secation_status" {{ @$aboutcontent->we_secation_status ? 'checked' : '' }}>
                      <span>
                        <small></small>
                      </span>
                    </label>
                    <label class="custom-control-label ml-3" style="margin-right: -122px;" for="Shop">Inactive / Active</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 mt-3">
                    <div class="form-group comments_form">
                      <label class="form-label">Title</label>
                      <input type="text" class="form-control ourTitle" value="{{@$aboutcontent->we_secation_title}}"  name="we_secation_title" placeholder="Title">
                    </div>
                  </div>
                  <div class="col-lg-12 mt-3">
                    <div class="form-group comments_form textarea-h-120">
                      <label>About Description</label>
                      <textarea class="form-control" id="editor1" required name="we_secation_description" placeholder="Description">{{@$aboutcontent->we_secation_description}}</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="edit-section-box">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                  <div class="titile-edit-section">
                    <h2 class="mb-0">Our Vision Section Edit</h2>
                  </div>
                  
                  <!-- <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" {{ @$aboutcontent->our_secation_status ? 'checked' : '' }}  name="our_secation_status" id="customSwitch2">
                    <div class="btn-toggle-switch">
                      <div class="handle"></div>
                    </div>
                    <label class="custom-control-label ml-3"  for="customSwitch2">Inactive / Active</label>
                  </div> -->

                  <div class="custom-control custom-switch toggle-switch">
                    <label for="cb-switch3">
                      <input type="checkbox" id="cb-switch3" class="aboutVision" name="our_secation_status" {{ @$aboutcontent->our_secation_status ? 'checked' : '' }}>
                      <span>
                        <small></small>
                      </span>
                    </label>
                    <label class="custom-control-label ml-3" style="margin-right: -122px;" for="Shop">Inactive / Active</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 mt-3">
                    <div class="form-group comments_form">
                      <label class="form-label">Title</label>
                      <input type="text" class="form-control VisionTitle" value="{{@$aboutcontent->our_secation_title}}"  placeholder="Title" name="our_secation_title">
                    </div>
                  </div>
                  <div class="col-lg-12 mt-3">
                    <div class="form-group comments_form textarea-h-120">
                      <label>About Description</label>
                      <textarea class="form-control" required id="editor2" name="our_secation_description" placeholder="Description">{{@$aboutcontent->our_secation_description}}</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="edit-section-box">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                  <div class="titile-edit-section">
                    <h2 class="mb-0">Our Mission Section Edit</h2>
                  </div>
                  
                  <!-- <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="mis_secation_status" id="customSwitch3" {{ @$aboutcontent->mis_secation_status ? 'checked' : '' }}>
                    <div class="btn-toggle-switch">
                      <div class="handle"></div>
                    </div>
                    <label class="custom-control-label ml-3" for="customSwitch3">Inactive / Active</label>
                  </div> -->

                  <div class="custom-control custom-switch toggle-switch">
                    <label for="cb-switch4">
                      <input type="checkbox" id="cb-switch4" class="AboutMission" name="mis_secation_status" {{ @$aboutcontent->mis_secation_status ? 'checked' : '' }}>
                      <span>
                        <small></small>
                      </span>
                    </label>
                    <label class="custom-control-label ml-3" style="margin-right: -122px;" for="Shop">Inactive / Active</label>
                  </div>

                </div>
                <div class="row">
                  <div class="col-lg-12 mt-3">
                    <div class="form-group comments_form">
                      <label class="form-label">Title</label>
                      <input type="text" class="form-control missionTilte"  name="mis_secation_title" placeholder="Title" value="{{@$aboutcontent->mis_secation_title}}">
                    </div>
                  </div>
                  <div class="col-lg-12 mt-3">
                    <div class="form-group comments_form textarea-h-120">
                      <label>About Description</label>
                      <textarea class="form-control" required name="mis_secation_description" id="editor3" placeholder="Description">{{@$aboutcontent->mis_secation_description}}</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 pl-0">
                <div class="button_div float-end mt-30"><button type="submit" class="btn btn-50">Submit</button></div>
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