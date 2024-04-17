@extends('web.layout.master')
@section('content')
<style>
  .error{
    color:red;
  }

#mainCatDIv .nice-select.form-control.form-select{
  display: none;
}
.nice-select.form-control{

display: none;

}
.form-select {
    padding: 5px 23px;
    
}
.form-control.form-select {
    height: 50px !important;
    /* padding: 15px 23px; */
    font-size: 16px;
    border: 1px solid #e2e2e2;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
    box-shadow: none;
    -webkit-transition: all 0.3s ease 0s;
    -moz-transition: all 0.3s ease 0s;
    -o-transition: all 0.3s ease 0s;
    transition: all 0.3s ease 0s;
    background-color: #fff;
    
}

select.form-control.w-100 {

display: block !important;

}

#mainCatDIv .nice-select.form-control.form-select{
  display: none;
}
#change{
  display: block !important;
  height: 50px !important;

}

label#formFile-error {
    color: red;
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
#otherEvent{
  display:none;
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
                <li>Event Add</li>
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
                <h2 class="border_bottom mb-0">Create Event</h2>
              </div>
            </div>
          </div>
          
          <form class="dashboard_form" action="{{ route('event_store') }}" name="eventform" enctype="multipart/form-data" method="post">
            @csrf
            <div class="feature_box border-bottom-0">
              <div class="media_div userprofile">
                    <img id="perview_userprofile" src="{{asset('/web/images/size-500-500.jpg')}}" alt="profile-upload-image">
              </div>
              <div class="feature_content">
                <span>JPEG or PNG 500x500px Thumbnail</span>
                <div class="browse_div header_btn search_btn jb_cover">
                    <label for="formFile" class="btn">Browse image</label>
                    <input class="form-control" tyle="file" required style="left:50px !important;" data-multiple-caption="{count} files selected" multiple="" name="image[]" type="file" id="formFile" accept="image/png, image/jpeg">
                </div>
              </div>
            </div>
            <div class="feature_box">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group comments_form">
                    <label class="form-label">Event Name</label>
                    <input type="text" class="form-control" value="{{old('name')}}" required name="name" placeholder="Title">
                    @if ($errors->has('name'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('name') }}</span>
                    @endif
                  </div>

                </div>
                <div class="col-lg-6" id="mainCatDIv">
                  <div class="form-group comments_form">
                    <label class="form-label">Event Category</label>
                    <select class="form-control form-select w-100" id="change" required name="category_id" aria-label="Default select example">
                        <option value="">Select Category</option>
                        @foreach ($category as $val)
                          <option value="{{$val->id}}" {{ old('category_id') == $val->id ? 'selected' : '' }}>{{ucfirst($val->name)}}</option>
                        @endforeach
                        <option value="other">Other</option>

                    </select>
                  </div>
                </div>
                <div class="col-lg-6" id="otherEvent">
                <div class="form-group comments_form">
                 <label class="form-label">New Event Category</label>
                  <input type="text" class="form-control"  required value="{{old('new_event_cat')}}" name="new_event_cat" placeholder="Enter New Event Category">

                </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">Event location</label>
                    <input type="text" class="form-control" value="{{old('location')}}" name="location" required placeholder="Location">
                  </div>
                  
                </a>
                </div>
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">Event Start Date</label>
                    <input type='text' value="{{old('start_date')}}" name="start_date" readonly required class="EventStartDate form-control calendar-icon" >
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">Event End Date</label>
               
                    <input type='text' class="EventEndDate form-control calendar-icon" required value="{{old('end_date')}}" name="end_date" readonly>

                  </div>
                </div>
                
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">Ticket Types</label>
                    <select class="form-control form-select w-100" name="ticket_type" required id="ticketType" aria-label="Default select example">
                      <option value="" selected>Select Type</option>
                      <option value="Free" {{ @$data->ticket_type == "Free" ? 'selected' : '' }}>Free</option>
                      <option value="Paid" {{ @$data->ticket_type == "Paid" ? 'selected' : '' }}>Paid</option>
                    </select>
                  </div>
                </div>
                
               
                <div class="col-lg-6" id="ticketQuantity" style="display:none;">
                  <div class="form-group comments_form">
                    <label class="form-label">Ticket Quantity</label>
                    <input type="text" required  class="form-control number" value="{{$data->quantity ??  old('quantity')}}" name="quantity" placeholder="Ticket Quantity">
                  </div>
                </div>
                  <div class="col-lg-12 mt-3 appendTicket" style="display:none;">
                    <!-- <p class="mt-2 text-danger" style="font-size:13px;" >Note : (3.75% + 50c) will be added to the ticket cost.</p> -->
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group comments_form">
                            <label class="form-label">Ticket Name</label>
                            <input type="text" class="form-control" name="ticket_name[0]" required placeholder="Ticket Name">
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group comments_form">
                            <label class="form-label">Ticket Cost</label>
                            <input type="number" min="1" class="form-control number priceAmount"  name="ticket_cost[0]" required placeholder="Price" onkeyup="changequantity()">
                           
                        </div>
                      </div>
                      <!-- <div class="col-lg-3">
                        <div class="form-group comments_form">
                            <label class="form-label">Final Amount</label>
                            <input type="text" class="form-control finalamount" disabled placeholder="Final Amount">
                        </div>
                      </div> -->
                      <div class="col-lg-3">
                        <div class="form-group comments_form">
                            <label class="form-label">Quantity</label>
                            <input type="number" min="1" class="form-control number"  name="ticket_quantity[0]" required placeholder="Quantity">
                        </div>
                      </div>
                      <div class="col-lg-1 col-4 pl-3 pl-lg-0">
                        <div class="add-more-btn">
                            <a href="javascript:void(0)" id="eventAppend" data-count="1"><i class="icon-plus text-white"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                
                <div class="col-lg-12 mt-3">
                  <div class="login_remember_box mt-0">
                    <label class="control control--checkbox">Do you have any dietary requirements
                      <input type="checkbox" name="ticket_type_check" {{ @$data->ticket_type_check=="1"? 'checked':'' }}>
                      <span class="control__indicator"></span> </label>
                     </div> 
                </div>
                <div class="col-lg-12 mt-3">
                  <div class="form-group comments_form">
                    <label>Event Short Description</label>
                    <textarea class="form-control" maxlength="250" required name="sort_description" placeholder="Short Description">{{$data->sort_description ?? ""}}</textarea>
                  </div>
                </div>

                <div class="col-lg-12 mt-3">
                  <div class="form-group comments_form">
                    <label>Event Description</label>
                    <textarea class="form-control" id="editor1" name="event_description" placeholder="Description">{{$data->event_description ?? ""}}</textarea>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group comments_form">
                    <label>Terms &amp; Conditions</label>
                    <textarea class="form-control" id="editor2" name="term_condition" placeholder="Add Trms and Conditions">{{$data->term_condition ?? ""}}</textarea>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="button_div float-end mt-30">
                    <button type="submit" class="btn btn-50">Submit</button>
                  </div>
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