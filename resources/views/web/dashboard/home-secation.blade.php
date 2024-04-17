@extends('web.layout.master')
@section('content')
<style>
  /*----------- BUTTON ----------*/
  #product{
    display: block !important;
  }
  #event{
    display: block !important;
  }
  #facility{
    display: block !important;
  }
  #membership{
    display: block !important;
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
input#cb-switch {
  display: none;
}
input#cb-event {
  display: none;
}
input#cb-facility {
  display: none;
}
input#cb-membership {
  display: none;
}
input#cb-about {
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
  #customeProduct{
    display: none;
  }
  #customeEvent{
    display: none;
  }
  #customeficility{
    display: none;
  }
  #customemembership{
    display: none;

  }
  label#formFile-error {
    position: absolute;
    top: 12px;
    z-index: 1;
    right: 0;
}
label#formFile1-error {
    position: absolute;
    top: 12px;
    z-index: 1;
    right: 0;
}

  span.select2.select2-container.select2-container--default {
    width: 100% !important;
}
.error{
    color:red;
  }
  .nice-select.form-control.form-select.w-100 {
  display: none!important;;
}
.change{
  display: block !important;height: 50px !important;

}
.right_menu .feature_box .media_div.userprofile {
    width: 180px !important;
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
                <li>Home Section</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @php               
                      $checkhomesecation = Helper::checkHomeSecation();
                @endphp
  <!-- Title Section End -->
  <!-- Dashboard Inner Content Section Start -->
  <section class="dashboard_inner_content">
    <div class="container">
    <div class="py-3">
        @if(empty($checkhomesecation))

          <div class="alert alert-info mb-3" role="alert">
          <p class="card-text"><i class="fas fa-info-circle"></i> For getting your clubs public url first you need to complete Homepage and header.<br>*Instruction:* Click on the Web Pages and then open the home tab. <a href="{{ route('home_secation') }}" class="text-danger fw-bold">Click to Add</a></p>
              
          </div>
        @endif
        @if(auth()->user()->stripe_account_status == '0')
            <div class="alert alert-warning mb-3" role="alert">
            <p class="card-text"><i class="fas fa-info-circle"></i> Please add your bank account for activate your public url and starting payouts directly to your bank account.  <a href="{{ route('bank.index') }}" class="text-danger fw-bold">Click to Add</a></p>
            </div>
        @endif
        @if(auth()->user()->stripe_account_status == '2' || auth()->user()->stripe_account_status == '1')
            <div class="alert alert-warning mb-3" role="alert">
            <p class="card-text"><i class="fas fa-info-circle"></i> Please complete your bank account for activate your public url and starting payouts directly to your bank account. <a href="{{ route('bank.index') }}" class="text-danger fw-bold">Click to Update</a></p>
            </div>
        @endif
        
    </div>
      <div class="row">
        @include('web.layout.sidebar')
        <div class="col-xl-9 col-lg-8">
        <div class="right_menu">
          <div class="feature_box d-block border-bottom-0">
            <div class="title_div d-flex align-items-center justify-content-between">
              <div class="titile_content">
                <h2 class="border_bottom mb-0">Home Page Edit</h2>
              </div>
            </div>
          </div>
          @if(@$data[0])
          <form class="dashboard_form" name="homeForme" action="{{route('homesecation_update')}}" enctype="multipart/form-data" method="post">
          @else
          <form class="dashboard_form" name="homeForme" action="{{route('homesecation_store')}}" enctype="multipart/form-data" method="post">
          @endif
          
            @csrf
            <div class="feature_box border-bottom-0">
              <div class="media_div userprofile">
              @if(isset($about))
                <img id="perview_userprofile" src="{{asset('/homeSecation/'.@$about->home_image)}}" alt="profile-upload-image">
              @else
              <img id="perview_userprofile" src="{{asset('web/images/img-icon1920x650.png')}}" alt="profile-upload-image">
              @endif
              </div>
              <div class="feature_content">
                <span>JPEG or PNG 1920x 650px Home Banner</span>
                <div class="browse_div header_btn search_btn jb_cover">
                    <label for="formFile" class="btn">browse image</label>
                    @if(isset($about))
                    <input class="form-control"  accept="image/png, image/jpeg"  type="file" id="formFile" name="banner_image">
                    @else
                    <input class="form-control"  accept="image/png, image/jpeg" required type="file" id="formFile" name="banner_image">

                    @endif
                    
                </div>
              </div>
            </div>
            <div class="feature_box d-block">
              <div class="edit-section-box">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                  <div class="titile-edit-section">
                    <h2 class="mb-0">Shop Section Edit</h2>
                  </div>
                  <!-- <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="Shop" name="product_status" {{ @$data[0]->status ? 'checked' : '' }}>
                    <div class="btn-toggle-switch">
                      <div class="handle"></div>
                    </div>
                    <label class="custom-control-label ml-3" for="Shop">Inactive / Active</label>
                  </div> -->
                  <div class="custom-control custom-switch toggle-switch">
                    <label for="cb-switch">
                      <input type="checkbox" id="cb-switch" name="product_status" {{ @$data[0]->status ? 'checked' : '' }}>
                      <span>
                        <small></small>
                      </span>
                    </label>
                    <label class="custom-control-label ml-3" style="margin-right: -122px;" for="Shop">Inactive / Active</label>
                  </div>
                </div>
                <div class="row">
                  <input type="hidden" name="product_secation" value="product_secation">
                  <input type="hidden" name="event_secation" value="event_secation">
                  <input type="hidden" name="facility_secation" value="facility_secation">
                  <input type="hidden" name="membership_secation" value="membership_secation">
                  <div class="col-lg-6">
                    <div class="form-group comments_form" id="productDiv">
                      <label class="form-label">Products Show</label>

                      <select class="form-control form-select w-100 change" required aria-label="Default select example" onchange="ProductDiv(this)" name="product_type">
                          <option value="" selected>Select Products</option>
                          <option value="1" {{ @$data[0]->type == 1 ? 'selected' : '' }}>Custom Product</option>
                          <option value="2" {{ @$data[0]->type == 2 ? 'selected' : '' }}>Recent 3 Product</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">Section Order</label>
                      <input type="text" class="form-control number orderdata" value="{{@$data[0]->order ?? old('product_order')}}" required placeholder="Section Order" name="product_order">
                      @if ($errors->has('product_order'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('product_order') }}</span>
                      @endif
                    </div>
                    
                  </div>
                  @if(isset($data[0]) && @$data[0]->type == 1)
                  <?php $pid = json_decode($data[0]->seaction_product_id); ?> 

                      <div class="col-lg-12" id="customeProduct" style="display:block;">
                  @else
                  <?php $pid = [] ?> 

                      <div class="col-lg-12" id="customeProduct">
                  @endif
                 

                    <div class="form-group comments_form">

                      <label class="form-label">Add Custom Product</label>
                      <select class="js-example-basic-multiple-limit form-control" id="product" required name="product_id[]" multiple>
                        @foreach ($product as $pro)
                          <option value="{{$pro->id}}" {{in_array($pro->id, $pid) ? 'selected' : ''}}>{{$pro->product_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="edit-section-box">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                  <div class="titile-edit-section">
                    <h2 class="mb-0">Events Section Edit</h2>
                  </div>
                  <!-- <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="Events" name="event_status" {{@$data[1]->status ? 'checked' : '' }}>
                    <div class="btn-toggle-switch">
                      <div class="handle"></div>
                    </div>
                    <label class="custom-control-label ml-3" for="Events">Inactive / Active</label>
                  </div> -->
                  <div class="custom-control custom-switch toggle-switch">
                    <label for="cb-event">
                      <input type="checkbox" id="cb-event" name="event_status" {{ @$data[1]->status ? 'checked' : '' }}>
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
                      <label class="form-label">Events Show</label>
                      <select class="form-control form-select w-100 change" required aria-label="Default select example" onchange="EventDiv(this)" name="event_type">
                        <option value="" selected>Select Events</option>
                        <option value="1" {{ @$data[1]->type == 1 ? 'selected' : '' }}>Custom Events</option>
                        <option value="2" {{ @$data[1]->type == 2 ? 'selected' : '' }}>Recent 3 Events</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6" >
                    <div class="form-group comments_form">
                      <label class="form-label">Section Order</label>
                      <input type="text" class="form-control number orderdata" required name="event_order" value="{{@$data[1]->order ?? old('event_order')}}" placeholder="Section Order">
                      @if ($errors->has('event_order'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('event_order') }}</span>
                      @endif
                    </div>
                  </div>
                  @if(isset($data[1]) && @$data[1]->type == 1)
                  <?php $eid = json_decode($data[1]->seaction_product_id); ?> 

                  <div class="col-lg-12" id="customeEvent" style="display:block;">
                  @else
                  <?php $eid = []; ?> 

                  <div class="col-lg-12" id="customeEvent">
                  @endif
                  
                    <div class="form-group comments_form">
                      <label class="form-label">Add Custom Events</label>
                      <select class="js-example-basic-multiple-limit form-control" id="event" required name="event_id[]" multiple>
                        @foreach ($event as $eve)
                          <option value="{{$eve->id}}" {{in_array($eve->id, $eid) ? 'selected' : ''}}>{{$eve->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="edit-section-box">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                  <div class="titile-edit-section">
                    <h2 class="mb-0">Facility Section Edit</h2>
                  </div>
                  <!-- <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="facility_status" id="Facility" {{@$data[2]->status ? 'checked' : '' }}>
                    <div class="btn-toggle-switch">
                      <div class="handle"></div>
                    </div>
                    <label class="custom-control-label ml-3" for="Facility">Inactive / Active</label>
                  </div> -->
                  <div class="custom-control custom-switch toggle-switch">
                    <label for="cb-facility">
                      <input type="checkbox" id="cb-facility" name="facility_status" {{ @$data[2]->status ? 'checked' : '' }}>
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
                      <label class="form-label">Facility Show</label>
                      <select class="form-control form-select w-100 change"  required name="facility_type" aria-label="Default select example" onchange="FacilityDiv(this)">
                        <option value="" selected>Select Facility</option>
                        <option value="1" {{ @$data[2]->type == 1 ? 'selected' : '' }}>Custom Facility</option>
                        <option value="2" {{ @$data[2]->type == 2 ? 'selected' : '' }}>Recent 3 Facility</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6" >
                    <div class="form-group comments_form">
                      <label class="form-label">Section Order</label>
                      <input type="text" class="form-control number orderdata" required name="facility_order" placeholder="Section Order" value="{{@$data[2]->order ?? old('facility_order')}}">
                      @if ($errors->has('facility_order'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('facility_order') }}</span>
                      @endif
                    </div>
                  </div>
                  @if(isset($data[2]) && @$data[2]->type == 1)
                  <?php $fid = json_decode($data[2]->seaction_product_id); ?> 

                  <div class="col-lg-12" id="customeficility" style="display:block;">
                  @else
                  <?php $fid = []; ?> 

                  <div class="col-lg-12" id="customeficility">
                  @endif
                    <div class="form-group comments_form">
                      <label class="form-label">Add Custom Facility</label>
                      <select class="js-example-basic-multiple-limit form-control" id="facility" required name="facility_id[]" multiple>
                        @foreach ($facility as $faci)
                          <option value="{{$faci->id}}" {{in_array($faci->id, $fid) ? 'selected' : ''}}>{{$faci->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="edit-section-box">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                  <div class="titile-edit-section">
                    <h2 class="mb-0">Membership Section Edit</h2>
                  </div>
                  <!-- <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="membership_status" id="membership" {{@$data[3]->status ? 'checked' : '' }}>
                    <div class="btn-toggle-switch">
                      <div class="handle"></div>
                    </div>
                    <label class="custom-control-label ml-3" for="membership">Inactive / Active</label>
                  </div> -->
                  <div class="custom-control custom-switch toggle-switch">
                    <label for="cb-membership">
                      <input type="checkbox" id="cb-membership" name="membership_status" {{ @$data[3]->status ? 'checked' : '' }}>
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
                      <label class="form-label">Membership Show</label>
                      <select class="form-control form-select w-100 change" required name="membership_type" aria-label="Default select example" onchange="MembershipDiv(this)">
                        <option value="" selected>Select Membership</option>
                        <option value="1" {{ @$data[3]->type == 1 ? 'selected' : '' }}>Custom Membership</option>
                        <option value="2" {{ @$data[3]->type == 2 ? 'selected' : '' }}>Recent 3 Membership</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6" >
                    <div class="form-group comments_form">
                      <label class="form-label">Section Order</label>
                      <input type="text" class="form-control number orderdata" required name="membership_order" placeholder="Section Order" value="{{@$data[3]->order ?? old('membership_order')}}">
                      @if ($errors->has('membership_order'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('membership_order') }}</span>
                      @endif
                    </div>
                  </div>
                  @if(isset($data[3]) && @$data[3]->type == 1)
                  <?php $mid = json_decode($data[3]->seaction_product_id); ?> 

                  <div class="col-lg-12" id="customemembership" style="display:block;">
                  @else
                  <?php $mid = []; ?> 

                  <div class="col-lg-12" id="customemembership">
                  @endif
                    <div class="form-group comments_form">
                      <label class="form-label">Add Custom membership</label>
                      <select class="js-example-basic-multiple-limit form-control"  id="membership" required name="membership_id[]" multiple>
                        @foreach ($membership as $members)
                          <option value="{{$members->id}}" {{in_array($members->id, $mid) ? 'selected' : ''}}>{{$members->plan_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="edit-section-box">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                  <div class="titile-edit-section">
                    <h2 class="mb-0">About Section Edit</h2>
                  </div>
                  <!-- <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input"  name="about_status" id="About" {{@$about->status ? 'checked' : '' }}>
                    <div class="btn-toggle-switch">
                      <div class="handle"></div>
                    </div>
                    <label class="custom-control-label ml-3" for="About">Inactive / Active</label>
                  </div> -->
                  <div class="custom-control custom-switch toggle-switch">
                    <label for="cb-about">
                      <input type="checkbox" id="cb-about" name="about_status" {{@$about->status ? 'checked' : '' }}>
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
                      <select class="form-control form-select w-100 change" required name="about_Image_status" aria-label="Default select example" onchange="ImageyDiv(this)">
                        <option value="1" {{ @$about->image_hide_show == 1 ? 'selected' : '' }}>YES</option>
                        <option value="2" {{ @$about->image_hide_show == 2 ? 'selected' : '' }}>NO</option>
                      </select>
                    </div>
                  </div>
                  @if(isset($about) && @$about->image_hide_show == 2)
                    <div class="col-lg-6" id="imageside" style="display:none;">
                  @else
                    <div class="col-lg-6" id="imageside">
                  @endif
                  
                    <div class="form-group comments_form">
                      <label class="form-label">Image Left/Right</label>
                      <select class="form-control form-select w-100 change" required name="about_Image_side" aria-label="Default select example" >
                        <option value="1" {{ @$about->image_left_right == 1 ? 'selected' : '' }}>Left Side</option>
                        <option value="2" {{ @$about->image_left_right == 2 ? 'selected' : '' }}>Right Side</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-12 mt-3">
                    <div class="form-group comments_form textarea-h-120">
                      <label>About Description</label>
                      <textarea class="form-control" id="editor1" name="about_description">{{@$about->description}}</textarea>
                    </div>
                  </div>
                  @if(isset($about) && @$about->image_hide_show == 2)
                  <div class="col-lg-12" id="imageSecation" style="display:none;">
                  @else
                  <div class="col-lg-12" id="imageSecation">
                  @endif
                  
                    <div class="feature_box">
                      <div class="media_div userprofile">
                        
                        @if(isset($about->about_image))
                          <img id="perview_banner" src="{{asset('/aboutSecation/'.@$about->about_image)}}" alt="profile-upload-image">
                        @else
                        <img id="perview_banner" src="{{asset('web/images/user-profile-default.jpg')}}" alt="profile-upload-image">
                        @endif
                      </div>
                      <div class="feature_content">
                        <span>JPEG or PNG 500x 300px About Image</span>
                        <div class="browse_div header_btn search_btn jb_cover">
                            <label for="formFile1" class="btn">browse image</label>
                            @if(isset($about->about_image))
                            <input accept="image/png, image/jpeg" class="form-control "  type="file" id="formFile1" name="about_image">
                            @else
                            <input accept="image/png, image/jpeg" class="form-control checkimage" type="file" id="formFile1" name="about_image">
                           
                            @endif
                        </div>
                      </div>
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