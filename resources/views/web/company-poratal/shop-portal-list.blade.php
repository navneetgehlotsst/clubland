@extends('web.layout.portal-master')
@section('content')
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
                <li>Shop List</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="shop_listing">
    <div class="container">
      <div class="row">
        @forelse ($product as $val)
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="feature_box p-0">
            <div class="media_div">
                <a href="{{url('/product/details/'.$val->slug)}}">
                    @if($val->getproductImage)
                        <img src="{{asset('/product_image/'.$val->getproductImage[0]['image'])}}" alt="product-image">
                    @else
                    <img src="{{asset('/web/images/size-500-500.jpg')}}" alt="product-image">
                    @endif
                </a>
            </div>
            <div class="feature_content">
              <h3><a href="{{url('/product/details/'.$val->slug)}}">{{$val->product_name}} </a></h3>
              <P class="description">{{mb_strimwidth($val->sort_description, 0, 50, '...')}}</P>

              @if($val->product_discount == null)
              <p class="price">
                ${{ $val->product_price}}
               </p>
              @else
              <p class="price ">${{$val->product_discount}} <del> ${{$val->product_price}}</del></p>

              @endif

              <div class="button_div">
                <a href="{{url('/product/details/'.$val->slug)}}" class="btn btn-50">Add to cart</a>
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
  @endsection