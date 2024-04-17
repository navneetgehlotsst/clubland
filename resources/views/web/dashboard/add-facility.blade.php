@extends('web.layout.master')
@section('content')
<style>
  button.btn.btn-outline-secondary.border-left-0 {
    top: 0px !important;
}

    .error{
    color:red;
  }
  /* .datepicker {
    display: none !important;
} */

  label#starttimepicker-error {
    position: absolute;
    top: 51px;
    z-index: 2;
}
label#endtimepicker-error {
    position: absolute;
    top: 51px;
    z-index: 2;
}
label#formFile-error {
  position: absolute;
    bottom: -32px;
    z-index: 1;
    left: 0;
}

label#startdatetimepicker-error {
    position: absolute;
    top: 51px;
    z-index: 2;
}
label#enddatetimepicker-error {
    position: absolute;
    top: 51px;
    z-index: 2;
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
                @if($data)
                  <li>Facility Edit</li>
                @else
                  <<li>Facility Add</li>
                @endif
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
              @if($data)
                <h2 class="border_bottom mb-0">Edit Facility</h2>
              @else
                <h2 class="border_bottom mb-0">Add Facility</h2>
              @endif
              </div>
            </div>
          </div>
          @if($data)
          <form class="dashboard_form" action="{{ route('facility_update',$data->id) }}" name="facilityform" enctype="multipart/form-data" method="post">
          @else
          <form class="dashboard_form" action="{{ route('facility_store') }}" name="facilityform" enctype="multipart/form-data" method="post">
          @endif
            @csrf
            <div class="feature_box border-bottom-0">
          


              <div class="media_div userprofile">
                  @if(@$data->getfacilityImage[0]['image'])
                    <img id="perview_userprofile" src="{{asset('/facility_image/'.$data->getfacilityImage[0]['image'])}}" alt="profile-upload-image">
                  @else
                    <img id="perview_userprofile" src="{{asset('/web/images/size-500-500.jpg')}}" alt="profile-upload-image">
                  @endif
              </div>
              <div class="feature_content">
                <span>JPEG or PNG 500x500px Thumbnail</span>
                <div class="browse_div header_btn search_btn jb_cover">
                    <label for="formFile" class="btn">browse image</label>
                    
                    @if(@$data->getfacilityImage[0]['image'])
                    <input class="form-control" style="left:50px !important;"  type="file" id="formFile" name="image[]" data-multiple-caption="{count} files selected" multiple="" accept="image/png, image/jpeg">
                    @else
                    <input class="form-control" style="left:50px !important;" required type="file" id="formFile" name="image[]" data-multiple-caption="{count} files selected" multiple="" accept="image/png, image/jpeg">

                     @endif
                  </div>
                    @if ($errors->has('image'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('image') }}</span>
                    @endif
              </div>
            </div>
            <div class="feature_box">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">Facility Name</label>
                    <input type="text" class="form-control" required value="{{$data->name ?? old('name')}}" name="name" placeholder="Facility Name">
                    @if ($errors->has('name'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                    
                </div>
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">Price</label>
                    <input type="number" min="1" class="form-control number priceAmount" required name="price" value="{{$data->price ?? old('price')}}" placeholder="Price" onkeyup="changequantity()">
                    <!-- <p class="mt-2 text-danger" style="font-size:13px;">Note : (3.75% + 50c) will be added to the total amount. </p> -->
                    @if ($errors->has('price'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('price') }}</span>
                    @endif
                  </div>
                    
                </div>
                <!-- @if($data)
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                        <label>Final Amount</label>
                          <input type="text" value="{{number_format(((3.75 / 100) * $data->price) + 0.50 + $data->price,2)}}" class="form-control finalamount" placeholder="Final Amount" disabled>
                  </div>
                </div>
                @else
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                        <label>Final Amount</label>
                          <input type="text" value="" class="form-control finalamount" placeholder="Enter Discount" disabled>
                  </div>
                </div>
                @endif -->
                <div class="col-lg-6" style="margin-bottom: 14px;">
                  <div class="form-group comments_form">
                    <label class="form-label">Start Available Hours</label>
                    <?php 
                      if(@$data->start_hours){
                        $startdate = date('m/d/Y H:i a ', strtotime(@$data->start_hours));
                      }else{
                        $startdate ='';
                      }
                    ?>
                    <input type='text' value="{{$startdate ?? old('start_hours')}}" name="start_hours" readonly required class="datetimepicker form-control calendar-icon" placeholder="Start Date/Time" >

                    <!-- <input id="startdatetimepicker" type="text" required value="{{$startdate ?? old('start_hours')}}" name="start_hours" readonly class="form-control calendar-icon" placeholder="Start Time/Date"> -->
                    
                    @if ($errors->has('start_hours'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('start_hours') }}</span>
                    @endif
                  </div>
                    
                </div>
                
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">End Available Hours</label>
                    <?php 
                      if(@$data->end_hours){
                        $enddate = date('m/d/Y H:i a ', strtotime(@$data->end_hours));
                      }else{
                        $enddate ='';
                      }
                    ?>
                    <input type='text' value="{{$enddate ?? old('end_hours')}}" name="end_hours" readonly required class="datetimepicker form-control calendar-icon" placeholder="End Date/Time">

                    <!-- <input id="enddatetimepicker" type="text" required value="{{$enddate ?? old('end_hours')}}" name="end_hours" readonly class="form-control calendar-icon" placeholder="End Time/Date"> -->
                    @if ($errors->has('end_hours'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('end_hours') }}</span>
                    @endif
                  </div>
                   
                </div>
                <div class="col-lg-12">
                  <div class="form-group comments_form">
                    <label class="form-label">Facility Location</label>
                    <input type="text" class="form-control" required name="location" value="{{$data->location ?? old('location')}}" placeholder="Facility Location">
                    @if ($errors->has('location'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('location') }}</span>
                    @endif
                  </div>
                    
                </div>
                
                <div class="col-lg-12 mt-3">
                  <div class="form-group comments_form textarea-h-120">
                    <label>Short Description</label>
                    <textarea class="form-control" maxlength="250" name="sort_description" required placeholder="Short Description">{{$data->sort_description ?? old('sort_description')}}</textarea>
                    @if ($errors->has('sort_description'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('sort_description') }}</span>
                    @endif
                  </div>
                    
                </div>

                <div class="col-lg-12 mt-3">
                  <div class="form-group comments_form textarea-h-120">
                    <label>Description</label>
                    <textarea class="form-control" id="editor1" name="description"  placeholder="Description">{{$data->description ?? old('description')}}</textarea>
                    @if ($errors->has('description'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('description') }}</span>
                    @endif
                  </div>
                    
                </div>
                <div class="col-lg-12">
                  <div class="form-group comments_form textarea-h-120">
                    <label>Terms and Conditions</label>
                    <textarea class="form-control" id="editor2" name="terms" placeholder="Add Trms and Conditions">{{$data->terms ?? old('terms')}}</textarea>
                    @if ($errors->has('terms'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('terms') }}</span>
                    @endif
                  </div>
                    
                </div>
                <div class="col-lg-12">
                  <div class="button_div float-end mt-30"><button type="submit" class="btn btn-50">Submit</button></div>
                </div>
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

