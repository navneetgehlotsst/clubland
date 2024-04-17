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

input[type="number"]::-webkit-inner-spin-button,

input[type="number"]::-webkit-outer-spin-button {

  -webkit-appearance: none;

  margin: 0;

}



input[type="number"] {

  -moz-appearance: textfield;

}



div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {

  background-color: #1E532E;

}

span.font-weight-bold.totalamount {

    margin-right: 268px;

}



</style>

  <div class="page_title_section">

    <div class="page_header">

      <div class="container">

        <div class="row">

          <div class="col-lg-9 col-md-8 col-12 col-sm-7 align-items-center d-flex">

            <h1> Cart Listing</h1>

          </div>

          <div class="col-lg-3 col-md-4 col-12 col-sm-5">

            <div class="sub_title_section">

              <ul class="sub_title">

                <li> <a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}">Home </a>&nbsp; / &nbsp; </li>

                <li>Cart Listing</li>

              </ul>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

  @if(count($data) > 0 || count($eventdata) > 0)

  <section class="shop_details">

    <div class="container">

      <div class="feature_content">

        <div class="feature_box">

          <div class="row no-gutters">

            <div class="col-md-12">

                <div class="product-details mr-2">

                   

                    <div class="button_div mt-3"><a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}" class="btn btn-50" type="button"><span>Continue Shopping<i class="fas fa-arrow-right pl-2"></i></span></a></div>

                    <hr>

                    <h6 class="mb-0">Shopping cart</h6>

                    <div class="d-flex justify-content-between py-2"><span>You have {{ count($data) + count($eventdata)}} items in your cart</span></div>

                    @if(count($data) > 0)

                    <h2 class="border_bottom">Products</h2>

                      @foreach($data as $val)
                   
                      <div class="row align-items-center mt-3 p-2 border rounded" id="remove_{{$val->id}}">

                        <div class="col-lg-5">

                          <div class="d-flex flex-row"><img class="rounded" src="{{asset('/product_image/'.@$val->getproductdata->getproductImage['0']['image'])}}" width="80">

                            <div class="pl-2 my-auto">
                              <span class="font-weight-bold d-block">
                              {{@$val->getproductdata['product_name']}}
                              </span>
                              <span class="spec">
                                {{ substr(@$val->getproductdata['sort_description'], 0, 100) }}...
                              </span>
                              @if(isset($val->getvariationdata->size))
                              &nbsp;<span class="spec">
                               Size :  {{ucfirst($val->getvariationdata->size)}}
                              </span>
                              @endif
                              @if(isset($val->getvariationdata->color))
                              &nbsp;<span class="spec">
                               Color :  {{ucfirst($val->getvariationdata->color)}}
                              </span>
                              @endif
                              
                            </div>

                          </div>

                        </div>

                        <div class="col-lg-6 mt-3 mt-lg-0">

                          <div class="d-flex justify-content-between align-items-center">

                            <div class="button_div d-flex mt-0">

                              <div class="quantity">



                                  <!-- <button class="minus"><i class="icon-minus"></i></button>

                                  <div class="quantity_value">{{$val->total_quantity}}</div>

                                  <button class="plush"><i class="icon-plus"></i></button> -->



                                  <button class="cartminus" data-id="{{$val->id}}" type="button"><i class="icon-minus"></i></button>



                                  <div class="quantity_value">
                                    @if(isset($val->variation_id))
                                      @if($val->getvariationdata->discount_price == 0)
                                        <input type="number" value="{{$val->total_quantity}}" name="quantity" min="1" max="{{$val->getvariationdata->quantity}}" class="number plusdata_{{$val->id}}" data-price="{{$val->getvariationdata->discount_price}}" data-id="{{$val->id}}" data-disprice="{{$val->getvariationdata->price}}" style="width: 63px;border: none;" onkeyup="changequantity({{$val->id}})">
                                      @else
                                        <input type="number" value="{{$val->total_quantity}}" name="quantity" min="1" max="{{$val->getvariationdata->quantity}}" class="number plusdata_{{$val->id}}" data-price="{{$val->getvariationdata->price}}" data-id="{{$val->id}}" data-disprice="{{$val->getvariationdata->discount_price}}" style="width: 63px;border: none;" onkeyup="changequantity({{$val->id}})">
                                      @endif  
                                    @else
                                      <input type="number" value="{{$val->total_quantity}}" name="quantity" min="1" max="{{$val->getproductdata->product_quantity}}" class="number plusdata_{{$val->id}}" data-price="{{$val->getproductdata['product_price']}}" data-id="{{$val->id}}" data-disprice="{{$val->getproductdata['product_discount']}}" style="width: 63px;border: none;" onkeyup="changequantity({{$val->id}})">
                                    @endif
                                  </div>

                                  

                                  <button type="button" class="cartplus" data-id="{{$val->id}}"><i class="icon-plus"></i></button>



                              </div>

                            </div>
                            @if(isset($val->variation_id))
                                @if($val->getvariationdata->discount_price == 0)
                                      <span class="d-block font-weight-bold quantityprice_{{$val->id}}">$<span class="productamount">{{$val->getvariationdata->price * $val->total_quantity}}
                                    </span></span>
                                @else
                                    <span class="d-block font-weight-bold quantityprice_{{$val->id}}">$<span class="productamount">{{$val->getvariationdata->discount_price * $val->total_quantity}}
                                    </span></span>
                                @endif
                            @else
                                @if($val->getproductdata->product_discount == 0)

                                  <span class="d-block font-weight-bold quantityprice_{{$val->id}}">$<span class="productamount">{{$val->getproductdata['product_price'] * $val->total_quantity}}

                                  </span></span>

                                @else

                                  <span class="d-block font-weight-bold quantityprice_{{$val->id}}">$<span class="productamount">{{$val->getproductdata['product_discount'] * $val->total_quantity}}

                                  </span></span>

                                @endif
                            @endif    

                            <a href="javascript:void(0);" onclick="removecart({{$val->id}})" > <i class="pl-3 pr-3 far fa-trash-alt text-danger"></i></a>

                          </div>

                        </div>

                      </div>

                      @endforeach

                    @endif  

                    @if(count($eventdata) > 0)

                      <hr>

                      <h2 class="border_bottom">Events</h2>

                      <hr>

                      <div class="row">

                          <div class="col-lg-12 col-12">

                            @foreach($eventdata as $res)

                              @if($res->geteventdata['ticket_type'] == 'Paid')

                                <h2>{{ucfirst(@$res->geteventdata['name'])}}</h2>

                                <div class="table-responsive">

                                    <table class="table">

                                      <thead>

                                          <tr>

                                            <th scope="col">Ticket Name</th>

                                            <th scope="col" style="text-align: center;">Quantity</th>

                                            <th scope="col">&nbsp;</th>

                                            <th scope="col">&nbsp;</th>

                                            <th scope="col">Ticket price</th>

                                            <th scope="col">&nbsp;</th>



                                          </tr>

                                      </thead>

                                      <tbody>

                                        @foreach ($res->geteventticketdata as $ticket)

                                            <input type="hidden" value="{{$ticket->ticket_id}}" name="ticket_id[]" >

                                            <tr>

                                                <th scope="row" class="align-middle">{{ucfirst(@$ticket->getticketdata->ticket_name)}}</th>

                                                <td class="align-middle" style="text-align: center;">

                                                  <div class="button_div d-flex mt-0">

                                                      <div class="quantity m-auto">

                                                        <button type="button" class="checkoutpaideventminus" data-id="{{$ticket->id}}"><span class=""><i class="icon-minus"></i></span></button>

                                                        <div class="quantity_value">

                                                            <input type="number" value="{{$ticket->quantity}}" min="1" name="quantity[]" max="{{$ticket->getticketdata->ticket_quantity}}" class="number count eventplusdata_{{$ticket->id}}" style="width: 30px;border: none;" readonly data-price="{{$ticket->price}}">

                                                        </div>

                                                        <button type="button" class="checkoutpaideventplus" data-id="{{$ticket->id}}"><span class=""><i class="icon-plus"></i></span></button>

                                                      </div>

                                                  </div>

                                                </td>

                                                <td class="align-middle" style="text-align: center;">

                                                  &nbsp;

                                                </td>

                                                <td class="align-middle" style="text-align: center;">

                                                  &nbsp;

                                                </td>

                                                <td class="align-middle">

                                                <span class="d-block font-weight-bold eventquantityprice_{{$ticket->id}}">$<span class="eventamount">{{$ticket->price * $ticket->quantity}}

                                                      </span>

                                                      </span>

                                                </td>

                                                <td class="align-middle" >

                                                  <a href="javascript:void(0);" onclick="removeEventcart({{$ticket->id}})" > <i class="pl-3 pr-3 far fa-trash-alt text-danger"></i></a>

                                                </td>

                                            </tr>

                                        @endforeach

                                      </tbody>

                                    </table>

                                </div>

                              @else

                                <h2 >{{ucfirst(@$res->geteventdata['name'])}}</h2>

                                <div class="table-responsive">

                                    <table class="table">

                                      <thead>

                                          <tr>

                                            <th scope="col">Ticket Name</th>

                                            <th scope="col" style="text-align: center;">Quantity</th>

                                            <th scope="col">&nbsp;</th>

                                            <th scope="col">&nbsp;</th>

                                            <th scope="col">Ticket price</th>

                                            <th scope="col">&nbsp;</th>

                                          </tr>

                                      </thead>

                                      <tbody>

                                       

                                      

                                       <input type="hidden" value="{{$res->ticket_id}}" name="ticket_id[]" >

                                       <tr>

                                          <th scope="row" class="align-middle">{{ucfirst(@$res->geteventdata['name'])}}</th>

                                          

                                         

                                          <td class="align-middle" style="text-align: center;">

                                                <div class="button_div d-flex mt-0">

                                                    <div class="quantity m-auto">

                                                    <button class="eventcartmin" data-id="{{$res->id}}"><span><i class="icon-minus"></i></span></button>

                                                     

                                                      <div class="quantity_value">

                                                          <input type="number" value="{{$res->quantity}}" min="1" name="quantity" id="eventquanity_{{$res->id}}" max="{{$res->geteventdata['quantity']}}" class="number count eventplusdata_{{$res->ticket_id}}" style="width: 37px;border: none;">

                                                      </div>



                                                      <button type="button" class="eventcartplus" data-id="{{$res->id}}"><span><i class="icon-plus"></i></span></button>

                                                    </div>

                                                </div>

                                                

                                          </td>

                                          <td class="align-middle" style="text-align: center;">

                                             &nbsp;

                                          </td>

                                          <td class="align-middle" style="text-align: center;">

                                             &nbsp;

                                          </td>

                                          <td class="align-middle">

                                             <div class="">

                                                <p><b>

                                                $ 0.00 ({{$res->geteventdata['ticket_type']}})

                                                </b>

                                                </p>

                                             </div>

                                          </td>

                                          <td class="align-middle" >

                                            <a href="javascript:void(0);" onclick="removecart({{$res->id}})" > <i class="pl-3 pr-3 far fa-trash-alt text-danger"></i></a>

                                          </td>

                                       </tr>

                                      

                                    </tbody>

                                    </table>

                                </div>

                              @endif

                            @endforeach  

                          </div>

                          <hr>

                         

                        

                      </div>

                    @endif  

                </div>

            </div>

            <div class="col-md-12">

              <div class="payment-info">

                  

                  <div class="d-flex justify-content-between information">

                  &nbsp;

                  </div>



                  <!-- <div class="d-flex justify-content-between information">

                    <span>Platform fee</span>

                    <span class="platformefee">${{number_format(@$platformFee,2)}}</span>

                  </div> -->



                  <!-- <div class="d-flex justify-content-between information">

                    <span class="font-weight-bold">Total</span>

                    <span class="font-weight-bold totalIncAmount">${{number_format(@$finalAmount,2)}}</span>

                  </div> -->

                  <hr class="line">

                  <div class="d-flex justify-content-between information">

                  <span class="font-weight-bold">Total Amount</span>

                    <span class="font-weight-bold totalamount">${{number_format(@$totalAmount->total_amount,2)}}</span>

                  </div>



                  <hr class="line">

                  <div class="button_div float-right mt-3">

                    <a href="{{url('/checkout-page')}}" class="btn btn-50" type="button"><span>Checkout<i class="fas fa-arrow-right pl-2"></i></span></a>

                  </div>



              </div>

            </div>

          </div>         

        </div>

      </div>

    </div>

  </section>

  @else

  <section class="shop_details">

    <div class="container">

      <div class="feature_content">

        <div class="">

          <div class="row no-gutters">

            <div class="col-md-12">

                <div class="product-details text-center mr-2">

                  <img src="{{asset('/web/images/cart.png')}}" class="img-fluid">

                    <h2 class="my-3 text-center">Your Cart is empty</h2>

                    <p>Shop today’s deals</p>

                    <div class="d-flex justify-content-between py-2"><span></span></div>

                </div>

                <div class="button_div text-center mt-3"><a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}" class="btn btn-50" type="button"><span>Continue Shopping<i class="fas fa-arrow-right pl-2"></i></span></a></div>

            </div>

          </div>         

        </div>

      </div>

    </div>

  </section>

  @endif

  @endsection