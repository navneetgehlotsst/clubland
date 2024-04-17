@extends('admin.layouts.master') @section('content')
<!-- Start Content-->
<div class="container-fluid">
  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box">
        <div class="page-title-right">
          <!-- <ol class="breadcrumb m-0"><li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li><li class="breadcrumb-item active">User Details</li></ol> -->
        </div>
      </div>
    </div>
  </div>
  <!-- end page title -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <div class="">
                    <div class="page-title-box">
                      <div class="title-left">
                        <h4>Club/Business Details</h4>
                      </div>
                      <div class="title-right"></div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="profile_detail_holder">
                    <div class="profile_detail_blk">
                      <table style="line-height:30px;">
                        <tbody>
                          <tr>
                            <th>Club Name</th>
                            <td>{{$data->business_info->club_name}}</td>
                          </tr>
                          <tr>
                            <th>Club Type</th>
                            <td>{{@$data->business_info->get_club_type->name}}</td>
                          </tr>
                          <tr>
                            <th>Person Name</th>
                            <td>{{$data->full_name}}</td>
                          </tr>
                          <tr>
                            <th>Email</th>
                            <td>{{$data->email}}</td>
                          </tr>

                          <tr>
                            <th>Contact Phone &nbsp;&nbsp;&nbsp;&nbsp;</th>
                              @if($data->country_code)
                              <td>+{{$data->country_code}} {{$data->phone_number}}</td>
                              @else
                              <td>{{$data->phone_number}}</td>
                              @endif
                            
                          </tr>
                          <tr>
                            <th>Club Address</th>
                            <td>{{$data->address}}</td>
                          </tr>
                          <tr>
                              @if(!empty(Helper::checkHomeSecation($data->id)))
                              <th> Home Secation</th>
                              <td><span class="text-success"><b>Complete</span></td>
                              @else
                              <th> Home Secation</th>
                              <td ><span class="text-warning "> <b>Pending </b></span></td>
                              @endif 
                              </tr>  
                              <tr>
                              @if($data->stripe_account_status == '3')
                              <th> Bank Account</th>
                              <td><span class="text-success"><b>Complete</b></span></td>
                              @else
                              <th> Bank Account</th>
                              <td ><span class="text-warning "><b> Pending </b></span></td>
                              @endif 
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <div class="">
                    <div class="page-title-box">
                      <div class="title-left">
                        <h4>Business Logo & Banner</h4>
                      </div>
                      <div class="title-right"></div>
                    </div>
                  </div>
                </div>
                <div class="card-body" style="height: 238px;">
                  <div class="profile_detail_holder">
                    <div class="profile_detail_blk">
                        <div style="float:left;">
                            <h5>Club Logo</h5>
                            @if(@$logo->header_secation_image)
                            <img src="{{ asset('public/image_logo/'.@$logo->header_secation_image)}}" alt="" width="260" height="80">
                            @else
                                  <p>No club logo yet !</p>
                            @endif
                            
                        </div>

                        <div style="float:right;">
                            <h5>Club Banner</h5>
                            @if(@$logo->header_secation_image)
                            <img src="{{ asset('public/homeSecation/'.@$banner->home_image)}}" alt="" width="260" height="80">
                            @else
                                  <p>No club banner yet !</p>
                            @endif
                            
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <div class="">
                    <div class="page-title-box">
                      <div class="title-left">
                        <h4>Business Social Networks</h4>
                      </div>
                      <div class="title-right"></div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="profile_detail_holder">
                    <div class="profile_detail_blk">
                    <table style="line-height:30px;">
                        <tbody>
                          <tr>
                            <th>Instagram &nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <td><a href="{{$data->business_info->instagram ?? '#'}}" target="_blank">{{@$data->business_info->instagram ?? ' No  Instagram link yet !'}}</a> </td>
                          </tr>
                          <tr>
                            <th>Facebook</th>
                            <td><a href="{{@$data->business_info->facebook ?? '#'}}" target="_blank">{{@$data->business_info->facebook ?? ' No Facebook link yet !'}}</a></td>
                          </tr>
                          <tr>
                            <th>Twitter</th>
                            <td><a href="{{@$data->business_info->twitter ?? '#'}}" target="_blank">{{@$data->business_info->twitter ?? ' No Twitter link yet !'}}</a></td>
                          </tr>
                          <tr>
                            <th>Linkedin</th>
                            <td><a href="{{@$data->business_info->linkedin ?? '#'}}" target="_blank">{{@$data->business_info->linkedin ?? ' No  Linkedin link yet !'}}</a></td>
                          </tr>
                        </tbody>
                      </table>
                        
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <div class="">
                    <div class="page-title-box">
                      <div class="title-left">
                        <h4>Business About</h4>
                      </div>
                      <div class="title-right"></div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="profile_detail_holder">
                    <div class="profile_detail_blk">
                    <table style="line-height:30px;">
                        <tbody>
                          <tr>
                            <th>{!! $data->about ?? 'No business about contant yet !' !!}</th>
                           
                          </tr>
                        </tbody>
                      </table>
                        
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end card-body-->
        </div>
      </div>
      <!-- end card-->
    </div>
    <!-- end col-->
  </div>
  <!-- end row-->
</div>
<!-- container --> @endsection