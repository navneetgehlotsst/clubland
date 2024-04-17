@extends('web.layout.master')
@section('content')
<style>
  .error{
    color:red;
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
.iti__flag-container {
    height: 50px;
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
    top: 50px;
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

.title_div h2.border_bottom::after {
    width: 203px !important;
}

.nice-select.form-control.form-select.small {
    margin-bottom: 14px !important;
}
.iti {
 
    display: block !important;
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
                <li>Bank Add</li>
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
                <h2 class="border_bottom mb-0">Add Bank Account</h2>
              </div>
            </div>
          </div>
          
            @if($data)
               <form class="dashboard_form" action="{{route('add.bankaccount.update')}}" id="add_bank" method="post" enctype="multipart/form-data">
            @else
               <form class="dashboard_form" action="{{route('add.bankaccount')}}" id="add_bank" method="post" enctype="multipart/form-data">
            @endif        
            @csrf
            <div class="feature_box border-bottom-0">
              <div class="media_div userprofile">
                    @if($img)
                    <img id="perview_userprofile" src="{{ asset('public/document/' . $img->image) }}"  style=" height: 100px; width: 100px;"/>
                    @else
                    <img id="perview_userprofile" src="{{ asset('web/default-duc.webp') }}" style=" height: 100px; width: 100px;"/>
                    @endif
              </div>
              <div class="feature_content">
                <span> Photo Id Document (Driving Licence, Passport)</span>
                <div class="browse_div header_btn search_btn jb_cover">
                    <label for="formFile" class="btn">Browse image</label>
                    @if($img)
                    <input class="form-control" tyle="file" style="left:59px !important;" data-multiple-caption="{count} files selected"  name="image" type="file" id="formFile" accept="image/*">
                    @else
                    <input class="form-control" tyle="file" required style="left:59px !important;" data-multiple-caption="{count} files selected"  name="image" type="file" id="formFile" accept="image/*">
                    @endif
                    
                </div>
              </div>
            </div>
            <div class="feature_box">
              <div class="row">
                  <div class="col-lg-12">
                      <b>Personal Details <span style="color:red;">*</span></b><br><hr>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">First Name</label>
                      <input type="text" class="form-control" value="{{$data->first_name ?? old('first_name')}}" required name="first_name" placeholder="Eg: jack">
                      @if ($errors->has('first_name'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('first_name') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">Last Name</label>
                      <input type="text" class="form-control" value="{{$data->last_name ?? old('last_name')}}" required name="last_name" placeholder="Eg: jones">
                      @if ($errors->has('last_name'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('last_name') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">Phone Number</label>
                      <input type="hidden" id="code" name="country_code" value="{{$data->country_code ?? old('country_code')}}">
                      <input type="text" class="form-control number" id="bankcontect" required name="phone_number" placeholder="Eg:000000000" maxlength="13" value="{{$data->phone_number ?? old('phone_number')}}">
                      @if ($errors->has('phone_number'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('phone_number') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">DOB</label>
                      <input type='text' value="{{$data->dob ?? old('dob')}}" name="dob" readonly required class="addBankdatetimepicker form-control calendar-icon" placeholder="Enter DOB" >

                      @if ($errors->has('dob'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('dob') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-12">
                        <b>Account Deatils <span style="color:red;">*</span></b><br><hr>
                  </div>
                <div class="col-lg-6">
                   <div class="form-group comments_form">
                    <label class="form-label">Account Number</label>
                    <input type="text" class="form-control number" maxlength="18" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Eg:000123456" value="{{$data->account_number ?? old('account_number')}}" required name="account_number" >
                    @if ($errors->has('account_number'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('account_number') }}</span>
                    @endif
                  </div>
                </div>
                <div class="col-lg-6">
                   <div class="form-group comments_form">
                    <label class="form-label">BSB (Bank service branch code)</label>
                    <input type="text" class="form-control" maxlength="18" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0_, this.maxLength);" placeholder="Eg:110000" value="{{$data->routing_number ?? old('routing_number')}}" required name="routing_number">
                    @if ($errors->has('routing_number'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('routing_number') }}</span>
                    @endif
                  </div>
                </div>
                <!-- <div class="col-lg-6">
                   <div class="form-group comments_form">
                    <label class="form-label">ID Number</label>
                    <input type="text" class="form-control" required name="id_number" placeholder="Eg:000000" maxlength="18" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="{{$data->id_number ?? old('id_number')}}">
                    @if ($errors->has('id_number'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('id_number') }}</span>
                    @endif
                  </div>
                </div> -->
                <div class="col-lg-12">
                        <b>Address <span style="color:red;">*</span></b> <br><hr>
                  </div>

                <div class="col-lg-6">
                   <div class="form-group comments_form require">
                    <label class="form-label">Country</label>
                    <div class="comments_form mb-0">
                      <select class="form-control form-select w-100" required name="country" aria-label="Default select example">
                        <option value="{{$countries->id}}" {{ @$data->country == $countries->id ? 'selected' : '' }}>{{$countries->name}}</option>
                      </select>
                    </div>
                    @if ($errors->has('country'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('country') }}</span>
                    @endif
                  </div>
                </div>
                <div class="col-lg-6">
                   <div class="form-group comments_form require">
                    <label class="form-label">State</label>
                      <select class="form-control form-select w-100" required name="state" aria-label="Default select example">
                        <option value="">Select State</option>
                        @foreach($states as $val)
                        @if (old('state') == $val->id)
                            <option value="{{$val->id}}" selected>{{$val->name}}</option>
                        @else
                        <option value="{{$val->id}}" {{ @$data->state == $val->id ? 'selected' : '' }}>{{$val->name}}</option>
                        @endif

                        @endforeach
                      </select>
                    @if ($errors->has('id_number'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('id_number') }}</span>
                    @endif
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">City</label>
                    <input type="text" class="form-control" required name="city" placeholder="Enter City" value="{{$data->city ?? old('city')}}">
                    @if ($errors->has('city'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('city') }}</span>
                    @endif
                  </div>
                </div>
                
                <div class="col-lg-12">
                  <div class="button_div float-end mt-30">
                    @if($data)
                      <button type="submit" class="btn btn-50">Update</button>
                    @else
                      <button type="submit" class="btn btn-50">Save</button>
                    @endif
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
  @section('script')
  <script>

    $("#bankcontect").intlTelInput({
      preferredCountries: ["us", "gb", "au"],
    separateDialCode: true,
    initialCountry: "au",
    dropdownContainer: "body", // This ensures the dropdown is appended to the body
    formatOnDisplay: false, // This prevents the input value from being reformatted when the dropdown is disabled
    }).on('countrychange', function (e, countryData) {
        $("#code").val(($("#bankcontect").intlTelInput("getSelectedCountryData").dialCode));
        $(this).intlTelInput("disableDropdown", true);

    });
    
    let number =   $("#phone_code").val();
    $('#bankcontect').intlTelInput("setNumber",number);

   

</script>
@endsection