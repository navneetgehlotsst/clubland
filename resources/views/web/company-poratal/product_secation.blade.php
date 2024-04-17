<!-- product -->
@if($productdata->status == 1)
  <section class="shop_listing" style="margin-bottom: -100px!important;">
    <div class="container">
      <div class="d-flex align-content-center justify-content-between">
        <div class="heading_block">
          <h2>Shop/Products</h2>
        </div>
        <div class="button_div">
          <a href="{{url('/product/all')}}" class="btn btn-border">View All</a>
        </div>
      </div>
      <div class="row">
        @forelse ($products as $product)
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="feature_box p-0">
              <div class="media_div">
                <a href="{{url('/product/details/'.$product->slug)}}">
                    @if($product->getproductImage)
                      <img src="{{asset('/product_image/'.@$product->getproductImage[0]['image'])}}" alt="product-image">
                    @else
                      <img src="{{asset('/web/images/size-500-500.jpg')}}" alt="product-image">
                    @endif
                </a>
              </div>
              <div class="feature_content">
                <h3><a href="{{url('/product/details/'.$product->slug)}}">{{$product->product_name}} </a></h3>
                <P class="description">{{mb_strimwidth($product->sort_description, 0, 50, '...')}}</P>
                @if($product->product_discount == 0)
                <p class="price">
                <!-- ${{number_format(((3.75 / 100) * $product->product_price) + 0.50 + $product->product_price,2)}} -->
                ${{$product->product_price}}
               </p>
                @else
                  <!-- <p class="price ">${{number_format(((3.75 / 100) * $product->product_discount) + 0.50 + $product->product_discount,2)}} <del> ${{number_format(((3.75 / 100) * $product->product_price) + 0.50 + $product->product_price,2)}}</del></p> -->
                  <p class="price ">${{$product->product_discount}} <del> ${{$product->product_price}}</del></p>

                @endif
                <div class="button_div">
                  <a href="{{url('/product/details/'.$product->slug)}}" class="btn btn-50">Add to cart</a>
                </div>
              </div>
            </div>
          </div>
          @empty
            <div class="col-lg-12 col-md-12 col-sm-12">
                <p style="text-align: center;">No product yet!</p>
            </div>
          @endforelse
      </div>
    </div>
  </section>
  @endif

<!-- product -->