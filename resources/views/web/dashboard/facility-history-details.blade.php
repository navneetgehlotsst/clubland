@extends('web.layout.master')
@section('content')
<style>
   .error{
   color:red;
   }
   .datepicker {
   display: none !important;
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
               <!--Event list start-->
               <div class="card border-0">
                  <h5 class="card-header hedding-top">Order Details #ORDERID00{{$data->id}}</h5>
                  <div class="card-body border p-0 border-top-0">
                     <div class="table-responsive">
                        <div class="card mb-4">
                           <div class="card-body">
                           <div class="row">
                              <div class="col-sm-3">
                                 <p class="mb-0">Full Name</p>
                              </div>
                              <div class="col-sm-9">
                                 <p class="text-muted mb-0">{{$data->user_name}}</p>
                              </div>
                           </div>
                           <hr>
                           <div class="row">
                              <div class="col-sm-3">
                                 <p class="mb-0">Email</p>
                              </div>
                              <div class="col-sm-9">
                                 <p class="text-muted mb-0">{{$data->user_email}}</p>
                              </div>
                           </div>
                           <hr>
                           <div class="row">
                              <div class="col-sm-3">
                                 <p class="mb-0">Phone</p>
                              </div>
                              <div class="col-sm-9">
                                 <p class="text-muted mb-0">{{$data->phone_number}}</p>
                              </div>
                           </div>
                           <hr>
                           <div class="row">
                              <div class="col-sm-3">
                                 <p class="mb-0">Address</p>
                              </div>
                              <div class="col-sm-9">
                                 <p class="text-muted mb-0">{{$data->address ?? ''}}</p>
                              </div>
                           </div>
                           </div>
                        </div>
                        <table class="table">
                           <thead>
                              <tr>
                                 <th>Name</th>
                                 <th class="text-center">Rate</th>
                                 <th class="text-center">Quantity</th>
                                 <th class="text-right">Price</th>

                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td class="align-middle text-nowrap">{{@$data->getFacility->name}}</td>
                                 <td class="align-middle text-center"><span class="sku-bg-box">${{number_format(@$data->getFacility->price,2)}}</span></td>
                                 <td class="align-middle text-center"><span class="sku-bg-box">1</span></td>
                                 <td class="align-middle text-right"><span class="font-weight-bold">${{number_format($data->total_amount,2)}}</span></td>
                              </tr>
                            </tbody>
                        </table>
                     </div>
                     <div class="payment-info px-3">
                        <hr class="line">
                        <div class="d-flex justify-content-between information">
                           <span>Subtotal</span>
                           <span>${{number_format($data->total_amount,2)}}</span>
                        </div>
                        <div class="d-flex justify-content-between information">
                           <span>Platform fee</span>
                           <span>${{number_format($data->commission_amount,2)}}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between information mb-3">
                           <span class="font-weight-bold">Total(Incl. Platform fee)</span>
                           <span class="font-weight-bold">${{number_format($data->destination_amount,2)}}</span>
                        </div>
                     </div>
                  </div>
               </div>
               <!--Event list End-->
            </div>
         </div>
      </div>
   </div>
   </div>
</section>
<!-- Dashboard Inner Content Section End -->
@endsection