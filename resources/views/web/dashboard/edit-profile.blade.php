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

  #other{
  display:none;
}
.iti{
        width: 100%;
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
                <li>Edit Profile</li>
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
          <div class="title_div d-flex align-items-center justify-content-between mb-20">
              <div class="titile_content">
                <h2 class="border_bottom">Edit Profile</h2>
              </div>
             
            </div>
            <form class="dashboard_form" action="{{ route('business_update') }}" name='profileUpdate' method="post" enctype="multipart/form-data">
              @csrf
              <div class="feature_box">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">Club Name</label>
                      <input type="text" value="{{$data->business_info->club_name}}" name="club_name" class="form-control" placeholder="Club name">
                      @if ($errors->has('club_name'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('club_name') }}</span>
                    @endif
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">Club Type</label>
                      <select class="form-control form-select w-100" name="club_type" id="changeClub" aria-label="Default select example">
                          <option value="">Select club type</option>
                            @foreach ($category as $types)
                            <option value="{{$types->id}}" {{ $data->business_info->club_type == $types->id ? 'selected' : '' }}>{{$types->name}}</option>
                            @endforeach
                            <option value="other">Other</option>
                      </select>
                      @if ($errors->has('club_type'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('club_type') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-6" id="other">
                  <div class="form-group comments_form">
                  <label class="form-label">New Club Type</label>
                    <input type="text" class="form-control"  required value="{{old('new_club_type')}}" name="new_club_type" placeholder="Enter New Club Type">

                  </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">Contact Person Name </label>
                      <input type="text" class="form-control" value="{{$data->full_name}}" name="name" placeholder="Contact person name">
                      @if ($errors->has('name'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">Contact Person Position</label>
                      <input type="text" class="form-control" value="{{$data->business_info->position}}" name="position" placeholder="Contact person position">
                      @if ($errors->has('position'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('position') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">Contact Email</label>
                      <input type="text" class="form-control" readonly value="{{$data->email}}" name="email" placeholder="Contact email">
                      @if ($errors->has('email'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">Contact phone</label>
                      <input type="hidden" id="code" name="country_code" value="{{$data->country_code}}">
                      <input type="text" class="number form-control " id="editcontect" required value="{{$data->phone_number}}" name="phone_number" placeholder="Contact phone number">
                      @if ($errors->has('phone_number'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('phone_number') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group comments_form">
                      <label class="form-label">Club address</label>
                      <input type="text" class="form-control" name="address" value="{{$data->address}}" placeholder="Enter full address of club">
                      @if ($errors->has('address'))
                        <span class="text-danger" style="float: left;">{{ $errors->first('address') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              

              <div class="feature_box d-block mt-30">
                <div class="feature_header">
                  <h3>About Club</h3>
                </div>
                <div class="feature_content">
                <textarea class="form-control" id="editor1" name="content">{{$data->about}}</textarea>
                </div>
              </div>
              <div class="feature_box d-block mt-30">
                <div class="feature_header">
                  <h3>Social Networks</h3>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">instagram</label>
                      <input type="url" class="form-control" name="instagram" value="{{$data->business_info->instagram}}" placeholder="Enter instagram url">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">facebook</label>
                      <input type="url" class="form-control" name="facebook" value="{{$data->business_info->facebook}}" placeholder="Enter facebook url">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">twitter</label>
                      <input type="url" class="form-control" name="twitter" value="{{$data->business_info->twitter}}" placeholder="Enter twitter url">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <label class="form-label">linkedin</label>
                      <input type="url" class="form-control" name="linkedin" value="{{$data->business_info->linkedin}}" placeholder="Enter linkedin url">
                    </div>
                  </div>
                </div>
              </div>
              <input type="hidden" name="phone_code" id="phone_code" value="+{{$data->country_code}}{{$data->phone_number}}">



              <div class="button_div float-end mt-30"><button type="submit" class="btn btn-50">Save Changes</button></div>
              
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
    $("#editcontect").intlTelInput({
        preferredCountries: ["us", "gb", "au"],
        separateDialCode: true,
        initialCountry: "au"
    }).on('countrychange', function (e, countryData) {
        $("#code").val(($("#editcontect").intlTelInput("getSelectedCountryData").dialCode));

    });
    
    let number =   $("#phone_code").val();
    $('#editcontect').intlTelInput("setNumber",number);

   

</script>
@endsection
  