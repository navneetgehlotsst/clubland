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
                <li>Product Edit</li>
                @else
                <li>Product Add</li>
 
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
                <h2 class="border_bottom mb-0">Edit Product</h2>
                @else
                <h2 class="border_bottom mb-0">Add Product</h2>

                @endif
              </div>
            </div>
          </div>
          @if($data)
        <form class="dashboard_form" action="{{ route('product_update',$data->slug) }}" name="addproductform" enctype="multipart/form-data" method="post">
         <input type="hidden" value="{{$data->id}}" name="product_id">
          @else
          <form class="dashboard_form" action="{{ route('product_store') }}" name="addproductform" enctype="multipart/form-data" method="post">
          @endif
              @csrf
            <div class="feature_box border-bottom-0">
              <div class="media_div userprofile">
                  @if(@$data->getproductImage[0]['image'])
                    <img id="perview_userprofile" src="{{asset('/product_image/'.$data->getproductImage[0]['image'])}}" alt="profile-upload-image">
                  @else
                    <img id="perview_userprofile" src="{{asset('/web/images/size-500-500.jpg')}}" alt="profile-upload-image">
                  @endif
              </div>
              <div class="feature_content">
                <span>JPEG or PNG 500x500px Thumbnail</span>
                <div class="browse_div header_btn search_btn jb_cover">
                    <label for="formFile" class="btn">browse image</label>
                    
                    @if(@$data->getproductImage[0]['image'])
                    <input class="form-control" style="left:50px !important;"  type="file" id="formFile" name="image[]" data-multiple-caption="{count} files selected" multiple="" accept="image/jpeg">
                    @else
                    <input class="form-control" style="left:50px !important;" required type="file" id="formFile" name="image[]" data-multiple-caption="{count} files selected" multiple="" accept="image/jpeg">

                     @endif
                  </div>
                    @if ($errors->has('image'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('image') }}</span>
                    @endif
              </div>
            </div>
            <div class="feature_box">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group comments_form">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" value="{{$data->product_name ?? old('product_name')}}" required name="product_name" placeholder="Product Name">
                    @if ($errors->has('product_name'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('product_name') }}</span>
                    @endif
                  </div>
                    
                </div>
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">Original Price</label>
                    <input type="number" min="1" class="form-control number priceAmount" id="product_price" value="{{$data->product_price ?? old('product_price')}}" onkeyup="changequantity()" required name="product_price" placeholder="Original Price">
                    <!-- <p class="mt-2 text-danger" style="font-size:13px;">Note : (3.75% + 50c) will be added to the original price. </p> -->
                    @if ($errors->has('product_price'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('product_price') }}</span>
                    @endif
                  </div>
                </div>
                
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">Discount Price</label>
                    <input type="number" class="form-control number discountamount" id="product_discount" name="product_discount"  placeholder="Discount Price" onkeyup="changediscount()" value="{{ $data->product_discount ?? old('product_discount') }}">
                    <!-- <p class="mt-2 text-danger" style="font-size:13px;">Note : (3.75% + 50c) will be added to the discount price. </p> -->
                    @if ($errors->has('product_discount'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('product_discount') }}</span>
                    @endif
                  </div>
                </div>
                <!-- @if($data)
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">Final Original Price</label>
                    <input type="text" class="form-control finalamount" disabled value="{{number_format(((3.75 / 100) * $data->product_price) + 0.50 + $data->product_price,2)}}"  placeholder="Final Original Price">
                   
                  </div>
                </div>
                @else
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">Final Original Price</label>
                    <input type="text" class="form-control finalamount" disabled value=""  placeholder="Final Original Price">
                   
                  </div>
                </div>
                @endif
                @if($data)
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">Final Discount Price</label>
                    <input type="text" class="form-control finaldiscountamount" disabled value="{{number_format(((3.75 / 100) * $data->product_discount) + 0.50 + $data->product_discount,2)}}"  placeholder="Final Discount Price">
                   
                  </div>
                </div>
                @else
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">Final Discount Price</label>
                    <input type="text" class="form-control finaldiscountamount" disabled value=""  placeholder="Final Discount Price">
                   
                  </div>
                </div>
                @endif -->
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">Quantity</label>
                    <input type="text" class="form-control number" required name="product_quantity" placeholder="Quantity" value="{{$data->product_quantity ?? old('product_quantity')}}">
                    @if ($errors->has('product_quantity'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('product_quantity') }}</span>
                    @endif
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">SKU Number</label>
                    <input type="text" class="form-control" required name="product_sku" placeholder="SKU Number" value="{{$data->product_sku ?? old('product_sku')}}">
                    @if ($errors->has('product_sku'))
                      <span class="text-danger" style="float: left;">{{ $errors->first('product_sku') }}</span>
                    @endif
                  </div>
                </div>
                
               
                <div class="col-lg-6">
                  <div class="form-group comments_form">
                    <label class="form-label">Out Of Stock Status</label>
                    <select class="form-control form-select w-100"  name="product_stock" aria-label="Default select example" required>
                      <option value="" selected>Select Status</option>
                      <option value="1" {{ @$data->product_stock == 1 ? 'selected' : '' }}>In Stock</option>
                      <option value="2" {{ @$data->product_stock == 2 ? 'selected' : '' }}>Out Of Stock</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-12 mt-3">
                  @if($data)
                  <?php 
                    $sizevariation = $data->getproductVariationOptionSize->pluck('option')->toArray();
                    $size = implode(',', $sizevariation);
                  ?>
                   <?php 
                    $colorvariation = $data->getproductVariationOptionColor->pluck('option')->toArray();
                    $color = implode(',', $colorvariation);
                  ?>
                  @endif
                  <label class="form-label">Size (optional)</label>

                  <input id="size" class="form-control" required value="{{$size ?? old('size')}}" name="size" data-role="tagsinput" type="text">
                  <small class="form-text text-muted">Separate keywords with a comma, space bar, or enter key</small>
                </div>
                <div class="col-lg-12 mt-3">
               
                  <label class="form-label">Color (optional)</label>
                  <input id="color" class="form-control" required name="product_color" value="{{$color ?? old('product_color')}}" data-role="tagsinput" type="text">
                  <small class="form-text text-muted">Separate keywords with a comma, space bar, or enter key</small>
                </div>
                <div class="col-lg-12 mt-3">
                  <div class="form-group comments_form textarea-h-120">
                    <label>Short Description</label>
                    <textarea class="form-control" maxlength="250" required name="sort_description" placeholder="Short Description">{{$data->sort_description ?? old('sort_description')}}</textarea>
                  </div>
                </div>
                <div class="col-lg-12 mt-3">
                  <div class="form-group comments_form textarea-h-120">
                    <label>Product Description</label>
                    <textarea class="form-control" id="editor1" required name="product_description" placeholder="Description">{{$data->product_description ?? old('product_description')}}</textarea>
                  </div>
                </div>
                <div class="col-lg-12 mt-3">
                  <div class="form-group comments_form textarea-h-120">
                    <label>Terms and Conditions</label>
                    <textarea class="form-control" id="editor2" required name="terms" placeholder="Terms and Conditions">{{$data->terms ?? old('terms') }}</textarea>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group comments_form">
                    <label class="form-label">Meta Title</label>
                    <input type="text" class="form-control" value="{{$data->meta_title ?? old('meta_title')}}" name="meta_title" placeholder="Meta Tag Title">
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group comments_form textarea-h-120">
                    <label>Meta Description</label>
                    <textarea class="form-control" name="meta_description" placeholder="Meta Tag Description">{{$data->meta_description ?? old('meta_description')}}</textarea>
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
    </div>
  </section>
  <!-- Dashboard Inner Content Section End -->
  @endsection
