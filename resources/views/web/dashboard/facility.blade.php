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
                <li>All Facility</li>
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
                <h2 class="border_bottom">All Facility</h2>
              </div>
              <div class="add_new">
                <div class="button_div"><a class="btn mr-1" href="{{route('add_facility')}}"><i class="icon-facility"></i> Add New Facility</a></div>
              </div>
            </div>
            <!--Product list start-->
            <div class="product-list">
              <div class="card border-0">
                <h5 class="card-header hedding-top">Facility List</h5>
                <div class="card-body border p-0 border-top-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                <th>Image</th>
                                    <th>Name</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Available Days/Time</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse ($data as $val)
                                <tr>
                                <td class="align-middle text-center" style="width: 70px;">
                                @if(@$val->getfacilityImage[0]['image'])
                                  <img src="{{asset('/facility_image/'.@$val->getfacilityImage[0]['image'])}}" alt="facility img" class="img-fluid rounded">
                                @else
                                  <img src="{{asset('/web/images/size-500-500.jpg')}}" alt="profile-upload-image">
                                
                                @endif
                                </td>
                                    <td class="align-middle text-nowrap font-weight-bold"><a href="javascript:void();" class="text-dark">{{$val->name}}</a></td>
                                    <td class="align-middle text-center"><span class="font-weight-bold">${{$val->price}}</span></td>
                                    <td class="align-middle text-center"><span class="bg-quantity">{{date('d-m-Y H:i', strtotime($val->start_hours))}}</span> - <span class="bg-red-box">{{date('d-m-Y H:i', strtotime($val->end_hours))}}</span></td>
                                    <td class="align-middle text-nowrap text-center">
                                      <a href="{{route('facility_edit',$val->id)}}" class="py-2 px-1"><i class="fas fa-edit pr-1"></i></a>
                                      <a href="javascript:void(0);" class="py-2 px-1" data-toggle="modal" data-target="#FacilitydeleteModal" onclick="return DeleteFacility({{$val->id}})"><i class="fas fa-trash pr-2" style="color: #c93131;"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                <td class="align-middle text-center" colspan="6"><b>No facility yet!</b></td>
                                    
                                </tr>
                                @endforelse
                               
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
              <div class="mt-3" style="float: right;">
                  {{$data->links('pagination::bootstrap-4')}}
              </div>
            </div>
            <!--Product list End-->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Dashboard Inner Content Section End -->
  @endsection