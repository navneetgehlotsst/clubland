@extends('web.layout.master')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />

<style>
    .error{
    color:red;
  }
  label#formFile-error {

  position: absolute;
    bottom: -32px;
    z-index: 1;
    left: 0;

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
.bootstrap-tagsinput {
	margin: 0;
	width: 100%;
	padding: 0.5rem 0.75rem 0;
	font-size: 1rem;
  line-height: 1.25;
	transition: border-color 0.15s ease-in-out;
	
	&.has-focus {
    background-color: #fff;
    border-color: #5cb3fd;
	}
	
	.label-info {
		display: inline-block;
		background-color: #636c72;
		padding: 0 .4em .15em;
		border-radius: .25rem;
		margin-bottom: 0.4em;
	}
	
	input {
		margin-bottom: 0.5em;
	}
}

.bootstrap-tagsinput .tag [data-role="remove"]:after {
	content: '\00d7';
}
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type="number"] {
  -moz-appearance: textfield;
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
                <li>Edit Product Variation</li>
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
                <h2 class="border_bottom mb-0">Edit Product Variation</h2>
              </div>
            </div>
          </div>
         <form class="dashboard_form" action="{{ route('product_variation_update',$data->slug) }}" name="addproductform" enctype="multipart/form-data" method="post">
              @csrf
             <div class="feature_box">
              <div class="row">
                @if($data->getproductVariation->count() > 0)
                  <div id="myDiv">
                    <div class="col-lg-12 mt-3">
                      <label class="form-label"><h5>Product Variations</h5></label> 
                      <!-- <p class="mt-2 text-danger" style="font-size:13px;">Note : (3.75% + 50c) will be added to the price and discount price. </p> -->
                    </div>                                 
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-3 mt-3">
                          <label class="form-label">Variations</label>
                        </div>
                        <div class="col-lg-2 mt-3">
                          <label class="form-label">Quantity</label>
                        </div>
                        <div class="col-lg-3 mt-3">
                          <label class="form-label">Price</label>
                        </div>
                        <div class="col-lg-2 mt-3">
                          <label class="form-label">Discount Price</label>
                        </div>
                      
                      </div>
                    </div>  

                    @foreach ($data->getproductVariation as $ke =>  $result)
                    <input type="hidden" name="variation_id[]" required value="{{$result->id}}" class="form-control">

                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-3 mt-3">
                            <h5 class="h6">
                              {{$result->size}}
                              @if($result->color && $result->size)
                              / 
                              @endif
                              {{$result->color}}
                            </h5>
                          </div>
                          <div class="col-lg-2 mt-3">
                            <input type="text" name="queintity[]" value="{{$result->quantity ?? '0'}}" class="form-control">
                          </div>
                          <div class="col-lg-3 mt-3">
                            <input type="number" min="1" name="price[{{$ke}}]" value="{{$result->price ?? $data->product_price}}" class="form-control">
                           
                          </div>
                          <div class="col-lg-2 mt-3">
                            <input type="text" name="discount_price[]" value="{{$result->discount_price ?? $data->product_discount}}" class="form-control">
                           
                          </div>
                          
                        </div>
                      </div>
                    @endforeach
                  </div>
                  <div class="col-lg-12">
                  <div class="button_div float-end mt-30"><button type="submit" class="btn btn-50">Update</button></div>
                </div>
                @else
                <p style="text-align:center;">No Variation Yet.</p>
                @endif
               
              </div>
            </div>            
          </form>
        </div>
      </div>
      </div>
      </div>
    </div>
  </section>
  <!-- Dashboard Inner Content Section End -->
  @endsection
