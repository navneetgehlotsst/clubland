@extends('web.layout.master')
@section('content')
<style>
   .error{
   color:red;
   }
   .datepicker {
   display: none !important;
   }
   .card-body.user-details p{
      font-size:14px;
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
               @if($data->payment_status == '')
               <h5 class="card-header hedding-top">Order Details #ORDERID00{{$data->id}}</h5>
               @else
               <h5 class="card-header hedding-top">Order Details #ORDERID00{{$data->booking_id}}</h5>
               @endif
                  
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
                           <hr>
                           <!-- <div class="row">
                              <div class="col-sm-3">
                                 <p class="mb-0">User Query</p>
                              </div>
                              <div class="col-sm-9">
                                 <p class="text-muted mb-0">{{$data->user_query ?? ''}}</p>
                              </div>
                           </div> -->
                           </div>
                           
                        </div>
                        <?php $j=0; ?>
                        <?php $r=0; ?>
                        @foreach($eventdata as $ke => $values)
                        
                        @if($values->ticket_type != 'Free')
                              @foreach($values['geteventTicket'] as $kes => $res)
                                 <div class="mb-2">
                                    <div class="row px-4">
                                       <div class="col-lg-12">
                                          <div class="event-details">
                                             <div class="d-lg-flex d-md-block justify-content-between">
                                                <h5 class="pb-2 h6">Event Name : <span> {{$values->name}}</span></h5>
                                                <h5 class="pb-2 h6">Ticket Name : <span>{{$res->ticket_name}}</span></h5>
                                             </div>
                                             <div class="d-flex justify-content-between">
                                                <p class="pb-2">Ticket Quantity : <span class="font-weight-bold">{{@$quanitiy[$kes]['quantity']}}</span></p>
                                                <p class="pb-2">Total : <span class="font-weight-bold">${{$res->ticket_cost * $quanitiy[$kes]['quantity']}}</span></p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row px-4">
                                    
                                       <?php for ($i = 1; $i <= @$quanitiy[$kes]['quantity']; $i++ ) {?>
                                          <div class="col-lg-6 px-1 py-1">
                                             <div class="card border shadow-sm p-2 bg-white rounded">
                                                <div class="card-body user-details p-0">
                                                   <p class="pb-1"><i class="fas fa-user mr-2"></i> <span>{{@$eventuserdetails[$r]['name']}}</span></p>
                                                   <p class="pb-1"><i class="fas fa-envelope mr-2"></i> <span>{{@$eventuserdetails[$r]['email']}}</span></p>
                                                   <p class="pb-1"><i class="fas fa-phone-volume mr-2"></i> <span>{{@$eventuserdetails[$r]['phone']}}</span></p>
                                                </div>
                                             </div>
                                          </div>
                                       <?php $j++;  $r++;} ?>
                                    </div>
                                    <hr>
                                 </div>
                              @endforeach 
                              @else
                              <div class="mb-2">
                                    <div class="row px-4">
                                       <div class="col-lg-12">
                                          <div class="event-details">
                                             <h5 class="pb-2 h6">Event Name : <span> {{$values->name}}</span></h5>
                                             <div class="d-flex justify-content-between">
                                                <p class="pb-2">Ticket Quantity : <span class="font-weight-bold">{{$quanitiy[$ke]['quantity']}}</span></p>
                                                <p class="pb-2">Total : <span class="font-weight-bold">$ 0.00 (Free)</span></p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row px-4">
                                       <?php $n=0; ?>
                                       <?php for ($i = 1; $i <= @$quanitiy[$ke]['quantity']; $i++ ) { ?>
                                          <div class="col-lg-6 px-1 py-1">
                                             <div class="card border shadow-sm p-2 bg-white rounded">
                                                <div class="card-body user-details p-0">
                                                   <p class="pb-1"><i class="fas fa-user mr-2"></i> <span>{{@$eventuserdetails[$r]['name']}}</span></p>
                                                   <p class="pb-1"><i class="fas fa-envelope mr-2"></i> <span>{{@$eventuserdetails[$r]['email'] ?? 'Not email yet'}}</span></p>
                                                   <p class="pb-1"><i class="fas fa-phone-volume mr-2"></i> <span>{{@$eventuserdetails[$r]['phone'] ?? 'Not phone number yet'}}</span></p>
                                                </div>
                                             </div>
                                          </div>
                                       <?php $r++; } ?>
                                 
                                    </div>
                                    <hr>
                                 </div>
                              @endif
                        @endforeach   
                     </div>
                     <div class="payment-info px-3">
                        <hr class="line">
                        <div class="d-flex justify-content-between information">
                           <span>Subtotal</span>
                           <span class="">${{number_format($data['total_amount'],2)}}</span>
                        </div>
                        <div class="d-flex justify-content-between information">
                           <span>Platform fee</span>
                           <span class="">${{number_format($data['commission_amount'],2)}}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between information mb-3">
                           <span class="font-weight-bold">Total(Incl. Platform fee)</span>
                           <span class="font-weight-bold">${{number_format($data['total_amount'] + $data['commission_amount'],2)}}</span>
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