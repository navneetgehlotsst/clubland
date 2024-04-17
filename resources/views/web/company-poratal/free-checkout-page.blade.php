@extends('web.layout.portal-master')

@section('content')

<style>



.error{

  color:red;

}

.btn-link {

    color: #d97333 !important;

}



.accordion .card-header:after {

    content: "";

    float: right;

    position: absolute;

    right: 15px;

    top: 13px;

    background:url('{{ asset('web/images/down-arrow.png') }}');

    height: 12px;

    width: 16px;

}



</style>

  <div class="page_title_section">

    <div class="page_header">

      <div class="container">

        <div class="row">

          <div class="col-lg-9 col-md-8 col-12 col-sm-7 align-items-center d-flex">

            <h1>Billing Details</h1>

          </div>

          <div class="col-lg-3 col-md-4 col-12 col-sm-5">

            <div class="sub_title_section">

              <ul class="sub_title">

                <li> <a href="{{route('shop_portal',$businessSlug)}}"> Home </a>&nbsp; / &nbsp; </li>

                <li>Billing Details</li>

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

        <div class="col-lg-12 m-auto">

          <div class="feature_content">

            <div class="feature_box bg-white">

              <form class="needs-validation" action="{{url('/payment/checkout/event-free')}}"  name="checkout" method="post">

               @csrf

                <div class="row">

                      <div class="col-md-7 col-lg-8">

                        <h4 class="mb-3"  style="margin-top: 25px;">Billing Details</h4>

                          <div class="row g-3">

                            <div class="col-sm-6 form-group comments_form">

                              <label for="firstName" class="form-label">Full name</label>

                              <input type="text" class="form-control" name="user_name" id="firstName" placeholder="Enter Full Name" value="" required="">

                              <div class="invalid-feedback">

                                Valid first name is required.

                            </div>

                          </div>

                            <div class="col-sm-6 form-group comments_form">

                              <label for="number" class="form-label">Mobile Number</label>

                              <div class="input-group has-validation">

                                <input type="text" class="form-control" name="phone_number" id="username" placeholder="Mobile number" required="">

                                <div class="invalid-feedback">

                                  Your username is required.

                                </div>

                              </div>

                            </div>

                            <div class="col-12 form-group comments_form">

                              <label for="email" class="form-label">Email</label>

                              <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" required>

                              <div class="invalid-feedback">

                                Please enter a valid email address for shipping updates.

                              </div>

                            </div>

                            <div class="col-12 form-group comments_form">

                              <label for="address" class="form-label">Address</label>

                              <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" required="">

                              <div class="invalid-feedback">

                                Please enter your shipping address.

                              </div>

                            </div>

                          </div>

                      </div>

                  <div class="col-md-5 col-lg-4 order-md-last">

                    <h4 class="d-flex justify-content-between align-items-center mb-3">

                      <span class="text-primary text-dark">Your cart</span>

                      <span class="badge bg-blue-box rounded-pill">{{ count($data) + count($eventdata)}}</span>

                    </h4>

                    <ul class="list-group mb-3">

                      @foreach($data as $val)

                        <li class="list-group-item d-flex justify-content-between lh-sm">

                          <div>

                            <h6 class="my-0">{{@$val->getproductdata['product_name']}}</h6>

                          </div>
                          
                            @if(isset($val->variation_id))
                                @if($val->getvariationdata->discount_price == 0)
                                    <span class="text-muted checkoutprice">
                                        {{number_format(((3.75 / 100) * $val->getvariationdata->price) + 0.50 + $val->getvariationdata->price,2) * $val->quantity}}
                                    </span>
                                @else
                                   <span class="text-muted checkoutprice">
                                    {{number_format(((3.75 / 100) * $val->getvariationdata->discount_price) + 0.50 + $val->getvariationdata->discount_price,2) * $val->quantity}}
                                  </span>
                                @endif
                            @else
                              @if($val->getproductdata->product_discount == 0)

                                <span class="text-muted checkoutprice">

                                {{number_format(((3.75 / 100) * $val->getproductdata['product_price']) + 0.50 + $val->getproductdata['product_price'],2) * $val->quantity}}

                                </span>

                              @else

                                <span class="text-muted checkoutprice">
                                {{number_format(((3.75 / 100) * $val->getproductdata['product_discount']) + 0.50 + $val->getproductdata['product_discount'],2) * $val->quantity}}
                                </span>

                              @endif
                            @endif
                        

                        </li>

                      @endforeach

                      @foreach($eventdata as $res)

                        @if($res->event_type == 'Paid')

                          <li class="list-group-item d-flex justify-content-between lh-sm">

                            <div>

                              <h6 class="my-0">{{ucfirst(@$res->geteventdata['name'])}}</h6>

                            </div>

                                <span class="text-muted checkoutprice eventcheckout">

                                {{number_format(((3.75 / 100) * $res->price) + 0.50 + $res->price,2) * $res->quantity}}

                                </span>

                          </li>

                        @else

                          <li class="list-group-item d-flex justify-content-between lh-sm">

                            <div>

                              <h6 class="my-0">{{ucfirst(@$res->geteventdata['name'])}}</h6>

                            </div>

                                <span class="text-muted">

                                0.00 (Free)

                                </span>

                          </li>

                        @endif

                      @endforeach

                      <li class="list-group-item bg-dark-box d-flex justify-content-between">

                        <span class="font-weight-bold">Total Amount</span>

                        <strong class="font-weight-bold finalamount"></strong>

                      </li>

                    </ul>

                    <hr class="my-4">

                      <div class="button_div mt-0">
                        <button type="submit" class="btn btn-50 w-100 freeevent">Booked Now</button>

                        <button type="submit" class="btn btn-50 w-100 paidevent">Continue to checkout</button>
                      </div>

                  </div>
                </div>

                    <div class="row g-5">
                      <div class="col-md-7 col-lg-8">
                        @if(count($eventdata) > 0)
                          <h4 class="mb-3">Event Ticket Details</h4>

                              @foreach($eventdata as $keys => $res)

                              <input type="hidden" value="{{$res->product_id}}" name="event_id[]">
                           
                                @if($res->event_type == 'Paid')

                                  <div class="feature_box">

                                      <h2 class="border_bottom mb-1">{{ucfirst(@$res->geteventdata['name'])}}</h2>

                                      <div class="row">

                                        <div class="col-md-4 col-4 text-center text-lg-left"><h3 class="font-weight-bold h6">Ticket type</h3></div>

                                        <div class="col-md-4 col-4 text-center text-lg-left"><h3 class="font-weight-bold h6">Quantity</h3></div>

                                        <div class="col-md-4 col-4 text-center text-lg-left"><h3 class="font-weight-bold h6">Amount</h3></div>

                                      </div>

                                    @foreach ($res->geteventticketdata as $key=> $ticket)

                                        <div class="accordion" id="accordionExample{{$ticket->id}}">

                                          <div class="card mt-2">

                                            <div class="card-header accordion-btn-after p-0" id="headingOne{{$ticket->id}}">

                                            <div class="row border-bottom border-success p-2" data-toggle="collapse" data-target="#collapseOne{{$ticket->id}}" aria-expanded="true" aria-controls="collapseOne{{$ticket->id}}">

                                              <div class="col-md-4 col-4 text-center text-lg-left font-weight-bold py-1">{{ucfirst($ticket->getticketdata->ticket_name)}}</div>

                                              <div class="col-md-4 col-4 text-center text-lg-left py-1">{{$ticket->quantity}}</div>

                                              <div class="col-md-4 col-4 text-center text-lg-left py-1 font-weight-bold">$ <span class="totalCheckouteventPrice">{{number_format(((3.75 / 100) * $ticket->price) + 0.50 + $ticket->price,2) * $ticket->quantity}}</span> </div>

                                            </div>

                                            </div>



                                            <div id="collapseOne{{$ticket->id}}" class="collapse show" aria-labelledby="headingOne{{$ticket->id}}" data-parent="#accordionExample{{$ticket->id}}">

                                              <div class="card-body">

                                                  <?php for ($i = 1; $i <= $ticket->quantity; $i++) { ?>

                                                      <div class="row border-bottom border-success">

                                                      <input type="hidden" value="{{$ticket->id}}" name="ticket_id[{{$res->product_id}}][{{$ticket->id}}][{{$i}}]">

                                                        <div class="col-md-4">

                                                          <div class="pb-3">

                                                            <lable>{{$i}}.Person Name</lable>

                                                                        <input type="text" required name="name[{{$res->product_id}}][{{$ticket->id}}][{{$i}}]" class="form-control" placeholder="Name">

                                                          </div>

                                                        </div>

                                                        <div class="col-md-4">

                                                          <div class="pb-3">

                                                            <lable>Person Email</lable>

                                                                        <input type="email" name="emails[{{$res->product_id}}][{{$ticket->id}}][{{$i}}]" class="form-control" placeholder="Email">

                                                          </div>

                                                        </div>

                                                        <div class="col-md-4">

                                                          <div class="pb-3">

                                                            <lable>Person Phone Number</lable>

                                                                        <input type="text" name="phone[{{$res->product_id}}][{{$ticket->id}}][{{$i}}]" class="form-control" placeholder="Phone Number">

                                                          </div>

                                                        </div>

                                                        

                                                      </div>

                                                  <?php } ?>

                                              </div>

                                              

                                            </div>

                                          </div>

                                          

                                        </div>

                                      

                                    @endforeach

                                    @if(@$res->geteventdata['ticket_type_check'] == '1')

                                      <div class="mt-3">

                                        <div class="form-group comments_form">

                                            <lable>Any Query</lable>

                                            <textarea class="form-control" required name="user_query[{{$res->product_id}}]" placeholder="Any Query"></textarea>

                                        </div>

                                      </div>

                                    @endif

                                  </div>

                                @else

                                  <div class="feature_box mt-4">

                                      <h2 class="border_bottom mb-1">{{ucfirst(@$res->geteventdata['name'])}}</h2>

                                      <div class="row">

                                        <div class="col-md-4 col-4 text-center text-lg-left"><h3 class="font-weight-bold h6 py-3">Ticket type</h3></div>

                                        <div class="col-md-4 col-4 text-center text-lg-left"><h3 class="font-weight-bold h6 py-3">Quantity</h3></div>

                                        <div class="col-md-4 col-4 text-center text-lg-left"><h3 class="font-weight-bold h6 py-3">Amount</h3></div>

                                      </div>

                                      

                                      <div class="accordion" id="accordionExample{{$res->product_id.ucfirst(@$res->geteventdata['name'])}}">

                                          <div class="card mt-2">

                                            <div class="card-header p-0" id="headingOne{{$res->product_id.ucfirst(@$res->geteventdata['name'])}}">

                                              <div class="row border-bottom border-success p-2" data-toggle="collapse" data-target="#collapseOne{{$res->product_id.ucfirst(@$res->geteventdata['name'])}}" aria-expanded="true" aria-controls="collapseOne{{$res->product_id.ucfirst(@$res->geteventdata['name'])}}">

                                                <div class="col-md-4 col-4 text-center text-lg-left font-weight-bold py-1">{{ucfirst(@$res->geteventdata['name'])}}</div>

                                                <div class="col-md-4 col-4 text-center text-lg-left font-weight-bold py-1">{{$res->quantity}}</div>

                                                <div class="col-md-4 col-4 text-center text-lg-left font-weight-bold py-1 font-weight-bold">$ 0.00 (Free)</div>

                                              </div>

                                            </div>



                                            <div id="collapseOne{{$res->product_id.ucfirst(@$res->geteventdata['name'])}}" class="collapse show" aria-labelledby="headingOne{{$res->product_id.ucfirst(@$res->geteventdata['name'])}}" data-parent="#accordionExample{{$res->product_id.ucfirst(@$res->geteventdata['name'])}}">

                                              <div class="card-body">

                                                  <?php for ($j = 1; $j <= $res->quantity; $j++) { ?>

                                                  <div class="row border-bottom border-success">

                                                  <div class="col-md-4">

                                                      <div class="pb-3">

                                                        <lable>{{$j}}.Person Name</lable>

                                                                    <input type="text" required name="name[{{$res->product_id}}][{{$res->product_id}}][{{$j}}]" class="form-control" placeholder="Name">

                                                      </div>

                                                    </div>

                                                    <div class="col-md-4">

                                                      <div class="pb-3">

                                                        <lable>Person Email</lable>

                                                                    <input type="email" required name="emails[{{$res->product_id}}][{{$res->product_id}}][{{$j}}]" class="form-control" placeholder="Email">

                                                      </div>

                                                    </div>

                                                    <div class="col-md-4">

                                                      <div class="pb-3">

                                                        <lable>Person Phone Number</lable>

                                                                    <input type="text" required name="phone[{{$res->product_id}}][{{$res->product_id}}][{{$j}}]" class="form-control" placeholder="Phone Number">

                                                      </div>

                                                    </div>

                                                  </div>

                                                  <?php } ?>

                                                  </div>

                                            </div>

                                          </div>

                                      </div>
                                     

                                  </div>

                                @endif

                              @endforeach

                        @endif
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