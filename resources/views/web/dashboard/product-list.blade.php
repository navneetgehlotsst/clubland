@extends('web.layout.master')
@section('content')
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
                <li>Product List</li>
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
                <h2 class="border_bottom">All Products</h2>
              </div>
              <div class="add_new">
                <div class="button_div"><a class="btn mr-1" href="{{route('product_add')}}"><i class="fas fa-plus"></i> Add New Product</a></div>
              </div>
            </div>
            <!--Product list start-->
            <div class="product-list">
              <div class="card border-0">
                <h5 class="card-header hedding-top">Products List</h5>
                <div class="card-body border p-0 border-top-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center product-list-img">Image</th>
                                    <th>Name</th>
                                    <th class="text-center">SKU</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($data as $val)
                           
                                <tr>
                                    <td class="align-middle text-center"><img src="{{asset('/product_image/'.@$val->getproductImage[0]['image'])}}" alt="product img" class="img-fluid rounded"></td>
                                    <td class="align-middle text-nowrap font-weight-bold">{{$val->product_name}}</td>
                                    <td class="align-middle text-center"><span class="sku-bg-box">{{$val->product_sku}}</span></td>
                                    @if($val->product_discount == 0)
                                    <td class="align-middle text-center"><span class="font-weight-bold">${{$val->product_price}}
                                    </span></td>
                                    @else
                                    <td class="align-middle text-center"><span class="font-weight-bold">${{$val->product_discount}}
                                    </span></td>
                                    @endif
                                    <td class="align-middle text-center"><span class="bg-quantity">{{$val->product_quantity}}</span></td>
                                    <td class="align-middle text-nowrap text-center">
                                    <div class="d-flex">
                                        <div class="" role="button" data-toggle="dropdown" aria-expanded="false">
                                          <div class="user-content text-start">
                                          <p class="mb-0"><i class="fas fa-edit"></i></p>
                                          </div>
                                        </div>
                                        <div class="dropdown-menu px-3" x-placement="bottom-start" style="position: absolute; transform: translate3d(1743px, 77px, 0px); top: 0px; left: 0px; will-change: transform;">
                                          <a href="{{route('product_edit',$val->id)}}" class="dropdown-item py-2 px-1"><i class="fas fa-edit"></i> Product Edit</a></li>
                                          @if($val->getproductVariation->count() > 0)
                                          <a href="{{route('product_variation_edit',$val->id)}}" class="dropdown-item py-2 px-1"> <i class="fas fa-edit"></i> Variation Edit</a></li>
                                          @endif
                                        </div>
                                        <a href="javascript:void(0);" class="ml-3" data-toggle="modal" data-target="#ProductdeleteModal" onclick="return DeleteProduct({{$val->id}})"><i class="fas fa-trash" style="color: #c93131;"></i></a>
                                      </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="align-middle text-center" colspan="6"><b>No product added yet!</b></td>
                                           </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
              </div>
            <div class="mt-3" style="float: right;">
              {{$data->links('pagination::bootstrap-4')}}
            </div>
            <!--Product list End-->
          </div>
        </div>
      </div>
      </div>
    </div>
  </section>
  <!-- Dashboard Inner Content Section End -->
  @endsection