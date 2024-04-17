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
                <li>Profile</li>
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
                <h2 class="border_bottom">Profile</h2>
              </div>
              <div class="add_new">
                <div class="button_div"><a class="btn mr-1" href="{{route('business_edit_profile')}}"><i class="fas fa-edit"></i> Update Profile</a></div>
              </div>
            </div>
           
              <div class="feature_box">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <p class="form-label">Club Name</p>
                      <h6 class="font-weight-bold mt-2">{{$data->business_info->club_name}}</h6>
                      
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <p class="form-label">Club Type</p>
                      @foreach ($category as $types)
                            @if($data->business_info->club_type == $types->id)
                              <h6 class="font-weight-bold mt-2">{{$types->name}}</h6>
                            @endif
                            @endforeach
                     
                      
                    </div>
                  </div>
                  
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <p class="form-label">Contact Person Name </p>
                      <h6 class="font-weight-bold mt-2">{{$data->full_name}}</h6>
                     
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <p class="form-label">Contact Person Position</p>
                      <h6 class="font-weight-bold mt-2">{{$data->business_info->position}}</h6>

                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <p class="form-label">Contact Email</p>
                      <h6 class="font-weight-bold mt-2">{{$data->email}}</h6>

                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <p class="form-label">Contact phone</p>
                      <h6 class="font-weight-bold mt-2">+{{$data->country_code}} {{$data->phone_number}}</h6>

                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group comments_form">
                      <p class="form-label">Club address</p>
                      <h6 class="font-weight-bold mt-2">{{$data->address}}</h6>
                    </div>
                  </div>
                </div>
              </div>
              
              @if($data->about)
              <div class="feature_box d-block mt-30">
                <div class="feature_header">
                  <h3>About Club</h3>
                  
                 
                </div>
                <div class="feature_content">
                  <p>{!! $data->about !!}</p>
                </div>
              </div>
              @endif
              @if($data->business_info->instagram || $data->business_info->instagram || $data->business_info->twitter || $data->business_info->linkedin)
              <div class="feature_box d-block mt-30">
             
                <div class="feature_header">
                  <h3>Social Networks</h3>
                </div>
              
                <div class="row">
                  @if($data->business_info->instagram)
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <p class="form-label">instagram</p>
                      <h6 class="font-weight-bold mt-2">{{$data->business_info->instagram ?? 'Not yet link'}}</h6>
                    </div>
                  </div>
                  @endif
                  @if($data->business_info->facebook)
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <p class="form-label">facebook</p>
                      <h6 class="font-weight-bold mt-2">{{$data->business_info->facebook  ?? 'Not yet link'}}</h6>
                    </div>
                  </div>
                  @endif
                  @if($data->business_info->twitter)
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <p class="form-label">twitter</p>
                      <h6 class="font-weight-bold mt-2">{{$data->business_info->twitter  ?? 'Not yet link'}}</h6>
                    </div>
                  </div>
                  @endif
                  @if($data->business_info->linkedin)
                  <div class="col-lg-6">
                    <div class="form-group comments_form">
                      <p class="form-label">linkedin</p>
                      <h6 class="font-weight-bold mt-2">{{$data->business_info->linkedin  ?? 'Not yet link'}}</h6>
                    </div>
                  </div>
                  @endif
                </div>
              </div>
              @endif
         
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
  