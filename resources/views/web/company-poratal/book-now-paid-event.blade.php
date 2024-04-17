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
   .error{
   color:red;
   }
</style>
<div class="page_title_section">
   <div class="page_header">
      <div class="container">
         <div class="row">
            <div class="col-lg-9 col-md-8 col-12 col-sm-7 align-items-center d-flex">
               <h1>Booking Details</h1>
            </div>
            <div class="col-lg-3 col-md-4 col-12 col-sm-5">
               <div class="sub_title_section">
                  <ul class="sub_title">
                     <li> <a href="{{route('shop_portal',$businessSlug)}}"> Home </a>&nbsp; / &nbsp; </li>
                     <li>Booking Details</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<section class="shop_details">
   <div class="container">
      <div class="row">
         <div class="col-lg-10 m-auto">
            <div class="feature_box rounded">
               <div class="feature_content">
                  <h2 class="border_bottom">{{ucfirst($event->name)}}</h2>
                  <div class="row">
                     <div class="col-lg-12 col-12">
                        <div class="table-responsive">
                           <table class="table">
                              <thead>
                                 <tr>
                                    <th scope="col">Ticket type</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Amount</th>
                                 </tr>
                              </thead>
                              <tbody>
                                <?php $i=1; ?>
                                 @foreach ($event->geteventTicket as $key=> $val)
                                  @if($val->ticket_quantity != 0)
                                      @if($quanitiy[$key] != 0)
                                      <tr>
                                          <th scope="row" class="align-middle">{{ucfirst($val->ticket_name)}}</th>
                                          <td class="align-middle">
                                            <span class="ml-4">{{$quanitiy[$key]}}</span>
                                          </td>
                                          <td class="align-middle">
                                            <span><b>
                                            ${{number_format(((3.75 / 100) * $val->ticket_cost) + 0.50 + $val->ticket_cost,2) * $quanitiy[$key]}}
                                            </b></span>
                                          </td>
                                      </tr>
                                      <?php for ($i = 1; $i <= $quanitiy[$key]; $i++) { ?>
                                      <tr>
                                          <th scope="row" class="align-middle">
                                            <lable>Name</lable>
                                              <input type="name" required name="name[]" class="form-control" placeholder="Name"></th>
                                          <td class="align-middle">
                                              <lable>Email</lable>
                                                <input type="email" required name="email[]" class="form-control" placeholder="Email">
                                          </td>
                                          <td class="align-middle">
                                              <lable>Phone Number</lable>
                                                <input type="name" required name="phone[]" class="form-control" placeholder="Name">
                                          </td>
                                      </tr>
                                      <?php } ?>
                                      
                                      
                                      @endif
                                  @endif
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <hr>
                  <h5>Billing Details</h5>
                  <form action="{{route('payment.payment',[$businessSlug,$event->slug,'event-paid'])}}" name="payment" method="post">
                     <div class="row mt-3">
                        @csrf
                        @foreach ($event->geteventTicket as $key=> $val)
                          @if($val->ticket_quantity != 0)
                              @if($quanitiy[$key] != 0)
                              <input type="hidden" name="quanitiy[]" value="{{$quanitiy[$key]}}">
                              <input type="hidden" name="ticket_id[]" value="{{$val['id']}}">
                              @endif
                          @endif
                        @endforeach
                        <div class="col-lg-6">
                           <div class="form-group comments_form">
                              <lable>Name</lable>
                              <input type="name" required name="user_name" class="form-control" placeholder="Name">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group comments_form">
                              <lable>Phone Number</lable>
                              <input type="text" name="phone_number" required class="form-control number" placeholder="Phone Number">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group comments_form">
                              <lable>Email</lable>
                              <input type="email" required name="email" class="form-control" placeholder="Email">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group comments_form">
                              <lable>Address</lable>
                              <input type="text" required name="address" class="form-control" placeholder="Address">
                           </div>
                        </div>
                        @if($event->ticket_type_check == '1')
                        <div class="col-lg-6">
                           <div class="form-group comments_form">
                              <lable>Any Query</lable>
                              <input type="text" name="user_query" class="form-control" placeholder="Any Query">
                           </div>
                        </div>
                        @endif
                        <div class="col-lg-12">
                           <div class="button_div mt-25" style="margin-top: 15px !important;">
                              <input type="submit" value="Continue" class="btn btn-50">
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
@endsection