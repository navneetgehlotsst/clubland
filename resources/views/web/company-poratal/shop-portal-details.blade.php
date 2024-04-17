@extends('web.layout.portal-master')

@section('content')

<style>

  .shop_details .feature_content .button_div .quantity div {

    width: 64px !important;

}

.position-zoom-list-img{

  position: relative !important;

  display: -webkit-box !important;

}

.nice-select.form-control.form-select.w-100 {

    display: none !important;

}

#color {

    display: block !important ;

}

#size {

    display: block !important;

}

select.form-control:not([size]):not([multiple]) {

    height: 53px !important;

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

<div class="page_title_section">

    <div class="page_header">

      <div class="container">

        <div class="row">

          <div class="col-lg-9 col-md-8 col-12 col-sm-7 align-items-center d-flex">

            <h1>Shop</h1>

          </div>

          <div class="col-lg-3 col-md-4 col-12 col-sm-5">

            <div class="sub_title_section">

              <ul class="sub_title">

                <li> <a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}"> Home </a>&nbsp; / &nbsp; </li>

                <li>Shop Details</li>

                

              </ul>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>



<section class="shop_details">

    <div class="container">

        <div class="feature_box">

            <div class="row">

                <div class="col-lg-6">

                    <div class="wrapper pl-0">

                        

                        <div class="big-img">

                            @if(isset($product->getproductImage))

                              <img src="{{asset('/product_image/'.$product->getproductImage[0]['image'])}}" class="display-img" alt="product-image">

                            @else

                              <img src="{{asset('/web/images/size-500-500.jpg')}}" class="display-img" alt="product-image">

                            @endif

                        </div>

                        <div class="img-selection position-zoom-list-img mt-3">

                        @if(isset($product->getproductImage))

                          @foreach ($product->getproductImage as $key => $val)

                          <div class="img-thumbnail selected mt-0 mr-1 mr-lg-3">

                            <img src="{{asset('/product_image/'.$val->image)}}" width="100%">

                          </div>

                          @endforeach

                          

                        @endif  

                         </div>

                      </div>



                </div>

                <div class="col-lg-6">
                @if($product->product_stock == 1)
                  <form id="checkaddtocart">
                @else
                <form>

                @endif
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="hidden" id="variation_id" name="variation_id" value="">
                    <input type="hidden" name="type" value="product">
                    <div class="feature_content">
                        <h2 class="border_bottom">{{$product->product_name}}</h2>
                        <div class="price_div">
                            @if($product->product_discount == 0)
                              <!-- <span class="discount-amount">
                                ${{number_format(((3.75 / 100) * $product->product_price) + 0.50 + $product->product_price,2)}}
                              </span> -->
                              <span class="discount-amount">
                                ${{$product->product_price}}
                              </span>
                            @else
                              <span class="discount-amount">${{$product->product_discount}} <del> ${{$product->product_price}}</del></span>
                              <!-- <span class="discount-amount">${{number_format(((3.75 / 100) * $product->product_discount) + 0.50 + $product->product_discount,2)}} <del> ${{number_format(((3.75 / 100) * $product->product_price) + 0.50 + $product->product_price,2)}}</del></span> -->
                            @endif

                        </div>
                        @if($product->getproductVariation->count() > 0)
                          <div class="size_color_div">
                              <div class="row">
                                @if($product->getproductVariationSizeCount->count() > 0)
                                
                                  <div class="col-6">
                                      <div class="comments_form mb-0 ">
                                      @if($product->product_stock == 1 && $product->product_quantity > 0)
                                          <select class="form-control form-select w-100" id="size" required name="size">
                                      @else
                                         <select class="form-control form-select w-100" disabled id="size" required name="size">
                                      @endif
                                            <option value="" selected>--Select Size--</option>
                                              @foreach ($product->getproductVariationSizeShoPortal as  $result)
                                                <option value="{{$result->size}}">{{ucfirst($result->size)}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  @endif
                                  @if($product->getproductVariationColorCount->count() > 0)
                                    <div class="col-6">
                                        <div class="comments_form mb-0 ">
                                        @if($product->product_stock == 1 && $product->product_quantity > 0)
                                          <select class="form-control form-select w-100" id="color" required name="color">
                                        @else
                                        <select class="form-control form-select w-100" disabled id="color" required name="color">

                                        @endif
                                            <option value="" selected>--Select Color--</option>
                                            @foreach ($product->getproductVariationColorShoPortal as  $color)
                                                <option value="{{$color->id}}">{{ucfirst($color->color)}}</option>
                                              @endforeach
                                          </select>
                                        </div>
                                    </div>
                                  @endif
                              </div>
                          </div>
                        @endif

                        <div class="description">

                          {{$product->sort_description}}

                        </div>

                        <div class="button_div d-flex">
                            @if($product->product_stock == 1 && $product->product_quantity > 0)
                                <div class="quantity">
                                    <button class="minus" type="button"><span class="minus"><i class="icon-minus"></i></span></button>
                                    <div class="quantity_value">
                                      <input type="number" value="1" name="quantity" min="1" max="{{$product->product_quantity}}" class="number" id="productCart" data-price="{{$product->product_price}}" data-disprice="{{$product->product_discount}}" style="width: 63px;border: none;">
                                    </div>
                                    <button type="button" class="plus"><span class="plus"><i class="icon-plus"></i></span></button>
                                </div>
                                <button type="submit" class="btn ml-3 addtocartbutton" ><i class="fa fa-shopping-cart" style="font-size:14px"></i> ADD To CART</button>
                            @else
                                <p style="color: #cf1b1b;font-weight: bold;">Product out of stock</p>
                            @endif
                        </div>
                        <div id="errorcart" style="display:none;"><p style="color:red; margin-top: 13px;">Product out of stock</p></div>
                        <div id="allredayadd" style="display:none;"><p style="color:red; margin-top: 13px;">This product all ready added this cart list</p></div>

                    </div>

                  </form>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="other_details">

    <div class="container">

        <ul class="nav nav-pills" id="pills-tab" role="tablist">

            @if($product->product_description)

            <li class="nav-item">

              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Product Description</a>

            </li>

            @endif

            @if($product->terms)

            <li class="nav-item">

              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Terms & Conditions</a>

            </li>

            @endif

        </ul>

        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                <div class="description">

                    {!!$product->product_description!!}

                </div>

            </div>

            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                <div class="description">

                {!!$product->terms!!}

                </div>

            </div>

        </div>

    </div>

</section>

  @endsection

  @section('script')
  <script>
      function appendOptionsToSelect(data) {
          var select = document.getElementById('color');
          select.innerHTML = ''; // Clear existing options
          select.insertAdjacentHTML('beforeend', data);
      }

      $('#size').change(function(){
        var size = $(this).val();
        $('.jb_preloader').removeClass('loaded');

        $.ajax({
            url: " {{url('/product/size/variation')}}",
            type: "POST",
            data: {
              "_token": "{{ csrf_token() }}",
              "product_id": "{{$product->id}}",
              "size":size
            },
            success: function(data) {
              $('.jb_preloader').addClass('loaded');
              var dataprice = parseFloat(data.size.price);
              var datadisprice = parseFloat(data.size.discount_price);
              $('#productCart').val('1');
              $('#productCart').attr('min', '1');
              $('#productCart').attr('max', data.size.quantity);
              if(data.size.discount_price != 0){
                $('#productCart').attr('data-price', dataprice);
                $('#productCart').attr('data-disprice', datadisprice);
              }else{
                 $('#productCart').attr('data-price', datadisprice);
                $('#productCart').attr('data-disprice', dataprice);
               
              }
              
              $('#variation_id').val(data.size.id);

              if(data.size.color == null){
                if(data.size.quantity != '0'){
                  $('.addtocartbutton').show();
                  $('#errorcart').hide();
                  $('.quantity').show();
                }else{
                  $('.addtocartbutton').hide();
                  $('#errorcart').show();
                  $('.quantity').hide();
                }
              }  
              var paltformfeeprice = ((3.75 / 100) * dataprice) + 0.50;
              var price = parseFloat(dataprice + paltformfeeprice).toFixed(2);

              var paltformfeediscount = ((3.75 / 100) * datadisprice) + 0.50;
              var discount = parseFloat(datadisprice + paltformfeediscount).toFixed(2);

              if(data.size.discount_price != 0){
                 $('.discount-amount').html('$' + datadisprice + ' <del>$'+ dataprice +'</del>')
              }else{
                 $('.discount-amount').html('$'+ dataprice +'</del>')
              }
              appendOptionsToSelect(data.data);
            }
        });
      })


      $('#color').change(function(){
        var colorId = $(this).val();
        var paltformfeeprice= '';
        var paltformfeediscount= '';
        $.ajax({
            url: " {{url('/product/price/variation')}}",
            type: "POST",
            data: {
              "_token": "{{ csrf_token() }}",
              "product_id": "{{$product->id}}",
              "color_id":colorId
            },
            success: function(data) {
              var dataprice = parseFloat(data.data.price);
              var datadisprice = parseFloat(data.data.discount_price);
              if(data.data.quantity != '0'){
                $('.addtocartbutton').show();
                $('#errorcart').hide();
                $('.quantity').show();
              }else{
                $('.addtocartbutton').hide();
                $('#errorcart').show();
                $('.quantity').hide();
              }
              $('#productCart').val('1');
              $('#productCart').attr('min', '1');
              $('#productCart').attr('max', data.data.quantity);
              if(data.data.discount_price != 0){
                 $('#productCart').attr('data-price', datadisprice);
                 $('#productCart').attr('data-disprice', dataprice);
              }else{
                 $('#productCart').attr('data-price', dataprice);
                 $('#productCart').attr('data-disprice', datadisprice);
               
              }
              $('#variation_id').val(data.data.id);

              var paltformfeeprice = ((3.75 / 100) * dataprice) + 0.50;
              var price = parseFloat(dataprice + paltformfeeprice).toFixed(2);

              var paltformfeediscount = ((3.75 / 100) * datadisprice) + 0.50;
              var discount = parseFloat(datadisprice + paltformfeediscount).toFixed(2);
              
              if(data.data.discount_price != 0){
              $('.discount-amount').html('$' + datadisprice + ' <del>$'+ dataprice +'</del>')
              }else{
              $('.discount-amount').html('$'+ dataprice +'</del>')
                
              }
            }
        });
      })
</script>
  @endsection