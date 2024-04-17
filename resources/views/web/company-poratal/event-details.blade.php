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
   input[type="number"]::-webkit-inner-spin-button,
   input[type="number"]::-webkit-outer-spin-button {
   -webkit-appearance: none;
   margin: 0;
   }
   input[type="number"] {
   -moz-appearance: textfield;
   }
</style>
<div class="page_title_section">
   <div class="page_header">
      <div class="container">
         <div class="row">
            <div class="col-lg-9 col-md-8 col-12 col-sm-7 align-items-center d-flex">
               <h1>Event</h1>
            </div>
            <div class="col-lg-3 col-md-4 col-12 col-sm-5">
               <div class="sub_title_section">
                  <ul class="sub_title">
                     <li> <a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}"> Home </a>&nbsp; / &nbsp; </li>
                     <li>Event Details</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<section class="shop_details">
   <div class="container">
   <div class="feature_box">
      <div class="row">
         <div class="col-lg-5">
            <div class="wrapper pl-0">
               <div class="big-img">
                  @if(isset($event->geteventImage))
                     <img src="{{asset('/event_image/'.$event->geteventImage[0]['image'])}}" class="display-img" alt="event-image">
                  @else
                     <img src="{{asset('/web/images/size-500-500.jpg')}}" class="display-img" alt="event-image">
                  @endif
               </div>
               <div class="img-selection position-zoom-list-img mt-3">
                  @if(isset($event->geteventImage))
                  @foreach ($event->geteventImage as $key => $val)
                  <div class="img-thumbnail selected mt-0 mr-1 mr-lg-3">
                     <img src="{{asset('/event_image/'.$val->image)}}" width="100%">
                  </div>
                  @endforeach
                  @endif  
               </div>
            </div>
         </div>
         <div class="col-lg-7">
            <div class="feature_content">
               <h2 class="border_bottom">{{ucfirst($event->name)}}</h2>
               <div class="price_div">
                  @if($event->ticket_type == 'Free')
                  <p><span>Free</span></p>
                  @else
                  @endif
               </div>
               <div class="mt-2">
                  @if($event->ticket_type == 'Free')
                  <img src="{{asset('web/images/icon/tickets.svg')}}" alt="" class="pr-1"><span class="text-green font-weight-bold mt-2">{{$event->quantity}}</span>/ Available Ticket
                  @else
                  @endif
               </div>
               <!-- <form action="{{route('book_now_event',[$businessSlug,'event',$event->ticket_type,$event->slug])}}" method="get"> -->
               @if($cartcheck)
               <form id="updateaddtocart">

               @else
               <form id="checkaddtocart">

               @endif   
                    <input type="hidden" name="event_id" value="{{$event->slug}}">
                    <input type="hidden" name="type" value="event">
                  @csrf
                  @if($event->ticket_type != 'Free')
                  <div class="size_color_div" style="border-top: none !important; ">
                     @else
                     <div class="size_color_div">
                        @endif
                        @php
                        $checkQ = 0;
                        @endphp
                        <div class="row">
                           @if($event->ticket_type != 'Free')
                            <input type="hidden" name="event_type" value="paid">
                           <div class="col-lg-12 col-12">
                              <div class="table-responsive">
                                 <table class="table">
                                    <thead>
                                       <tr>
                                          <th scope="col">Ticket Name</th>
                                          <th scope="col">Ticket price</th>
                                          <th scope="col">Available ticket</th>
                                          <th scope="col" style="text-align: center;">Quantity</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($event->geteventTicket as $key => $val)
                                       @php
                                       $checkQ += $val->ticket_quantity;
                                       @endphp
                                       <input type="hidden" value="{{$val->id}}" name="ticket_id[]" >
                                       <tr>
                                          <th scope="row" class="align-middle">{{ucfirst($val->ticket_name)}}</th>
                                          <td class="align-middle">
                                             <div class="price_div">
                                                <p><span>
                                                   ${{$val->ticket_cost}}
                                                   </span>
                                                </p>
                                             </div>
                                          </td>
                                          <td class="align-middle">
                                             <div class="">
                                                <img src="{{asset('web/images/icon/tickets.svg')}}" alt="" class="pr-1"> <span class="h5 font-weight-bold mt-2">{{$val->ticket_quantity}}</span>
                                             </div>
                                          </td>
                                          <td class="align-middle">
                                             @if($val->ticket_quantity > 0)
                                             
                                             <div class="button_div ticket-quantity d-flex mt-0">
                                                <div class="quantity">
                                                   @if($cartcheck)
                                                      <button type="button" class="paideventminus" data-id="{{$val->id}}"><span class=""><i class="icon-minus"></i></span></button>
                                                      <div class="quantity_value">
                                                         <input type="number" value="{{$cartcheck->geteventticketdata[$key]['quantity'] ?? '0'}}" min="0" name="quantity[]" max="{{$val->ticket_quantity}}" class="number count eventplusdata_{{$val->id}}" style="width: 30px;border: none;" onkeyup="changeeventquantity({{$val->id}})">
                                                         </div>
                                                      <button type="button" class="paideventplus" data-id="{{$val->id}}"><span class=""><i class="icon-plus"></i></span></button>
                                                   @else
                                                   <button type="button" class="paideventminus" data-id="{{$val->id}}"><span class=""><i class="icon-minus"></i></span></button>
                                                      <div class="quantity_value">
                                                         <input type="number" value="0" min="0" name="quantity[]" max="{{$val->ticket_quantity}}" class="number count eventplusdata_{{$val->id}}" style="width: 30px;border: none;" onkeyup="changeeventquantity({{$val->id}})">
                                                      </div>
                                                      <button type="button" class="paideventplus" data-id="{{$val->id}}"><span class=""><i class="icon-plus"></i></span></button>
                                                   @endif   
                                                </div>
                                             </div>
                                             @else
                                             <p style="text-align: center; color: #cf1b1b;font-weight: bold;">Out of stock</p>
                                             @endif
                                          </td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <hr>
                           <div class="col-lg-12 col-12">
                              <label for=""><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp; Location :</label>
                              {{$event->location}}
                           </div>
                           @else   
                            <input type="hidden" name="event_type" value="free">
                           <hr>
                           <div class="col-lg-12 col-12">
                              <label for=""><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp; Location :</label>
                              {{$event->location}}
                           </div>
                           <div class="col-lg-5 col-6">
                              <div class="button_div ticket-quantity d-flex">
                                 <div class="quantity">
                                    <button class="minus"><span class="minus"><i class="icon-minus"></i></span></button>
                                    <div class="quantity_value">
                                       <input type="number" value="1" min="1" name="quantity" id="eventquanity" max="{{$event->quantity}}" class="number count eventplusdata_{{$event->id}}" style="width: 37px;border: none;">
                                    </div>
                                    <button type="button" class="paideventplus" data-id="{{$event->id}}"><span ><i class="icon-plus"></i></span></button>
                                 </div>
                              </div>
                           </div>
                           @endif
                        </div>
                     </div>
                     <div class="description">
                        <p>{{$event->sort_description}}</p>
                     </div>
                     @if($event->ticket_type == 'Free')
                        @if($event->quantity != 0)
                           @if($cartcheck)
                           <div class="button_div d-flex">
                              <button type="submit" class="btn ml-3"><i class="fa fa-shopping-cart" style="font-size:14px"></i> Update To CART</button>
                              </div>
                           @else
                              <div class="button_div d-flex">
                                 <button type="submit" class="btn ml-3"><i class="fa fa-shopping-cart" style="font-size:14px"></i> ADD To CART</button>
                              </div>
                           @endif
                        @else
                              <p style="color: #cf1b1b;font-weight: bold;">Out of stock</p>
                        @endif
                     @else
                        @if($checkQ > 0)
                           @if($cartcheck)
                           <div class="button_div d-flex">
                              <button type="submit" class="btn ml-3"><i class="fa fa-shopping-cart" style="font-size:14px"></i> Update To CART</button>
                              </div>
                           @else
                              <div class="button_div d-flex">
                                 
                                 <button type="submit" class="btn ml-3"><i class="fa fa-shopping-cart" style="font-size:14px"></i> ADD To CART</button>
                              </div>
                              <div id="errorcart" style="display:none;"><p style="color:red; margin-top: 13px;">Please select event quantity.</p></div>
                           @endif
                        @endif
                     @endif
                     <div id="allredayadd" style="display:none;"><p style="color:red; margin-top: 13px;">This event all ready added this cart list</p></div>
                     
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="other_details">
   <div class="container">
      <ul class="nav nav-pills" id="pills-tab" role="tablist">
         @if($event->term_condition)
         <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Event Description</a>
         </li>
         @endif
         @if($event->event_description)
         <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Terms & Conditions</a>
         </li>
         @endif
      </ul>
      <div class="tab-content" id="pills-tabContent">
         <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="description">
               {!!$event->event_description!!}
            </div>
         </div>
         <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="description">
               {!!$event->term_condition!!}
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
@section('script')
<script>
   $(document).ready(function() {
       
       $('#eventquanity').keyup(function () {
           var input = $(this).val(); 
   
         var max = $("#eventquanity").attr('max');
           if(input == 0){
             $("#eventquanity").val(max);
           }
           if (parseInt(input) >= parseInt(max)) { 
             $("#eventquanity").val(max);
             return false;
           }
         });
   
         //Cart List Script
       $('.paideventplus').click(function () {
           var eventId = $(this).data('id');
           var $eventinput = $(this).parent().parent().find('input');
           var eventmax = $(".eventplusdata_"+eventId).attr('max');
           if (eventmax == $eventinput.val()) {
               $(".eventplusdata_"+eventId).val(eventmax);
           } else {
               $eventinput.val(parseInt($eventinput.val()) + 1);
               $eventinput.change(); // Trigger the change event if needed
           }
   
       });
       
       $('.paideventminus').click(function () {
         var $input = $(this).parent().parent().find('input');
         var count = parseInt($input.val()) - 1;
         count = count < 0 ? 0 : count;
         var id = $(this).data('id');
         $input.val(count);
         $input.change();
         
       });
   });
   function changeeventquantity(id){
     var input = $(".eventplusdata_" + id);  // Use the correct selector to get the input element
     var max = input.attr('max');
     var inputValue = parseFloat(input.val());  // Parse the input value to a float
     if(inputValue == 0){
       $(".eventplusdata_"+ id).val('0');
     }
       if (max && inputValue >= parseFloat(max)) { 
             $(".eventplusdata_"+ id).val(max);
       } else {
         var add = $(".eventplusdata_"+ id).val();
         $(".eventplusdata_"+ id).change();
         var price = $('.eventplusdata_'+ id).data('price');
         var disprice = $('.eventplusdata_'+ id).data('disprice');
       }
   }

   // $('.checkouteventminusCheck').click(function () {
   //    var $input = $(this).parent().parent().parent().find('input');
   //       var count = parseInt($input.val()) - 1;
   //       count = count < 0 ? 0 : count;
   //       var id = $(this).data('id');
   //       $input.val(count);
   //       $input.change();

   //       var price = $('.eventplusdata_'+ id).data('price');
   //       var quantity = $input.val();
   //       var totalprice = (price * quantity).toFixed(2);
   //       $(".eventquantityprice_" + id).find(".eventamount").html(totalprice);
   //       var eventamount = 0;
   //       $('.eventamount').each(function(){
   //       eventamount += parseFloat($(this).text());  
   //       });
   //       var sum = 0;
   //       $('.productamount').each(function(){
   //          sum += parseFloat($(this).text());  
   //       });
         
   //       var cartamount = (eventamount + sum).toFixed(2)
   //       $(".totalamount").html("$"+cartamount);
   //       $.ajax({
   //          url: " {{route('event_cart_update',$businessSlug)}}",
   //          type: "POST",
   //          data: {
   //             "_token": "{{ csrf_token() }}",
   //             "id": id,
   //             "quantity":quantity
   //          },
   //          success: function(data) {
   //             // Handle success if needed
   //          },
   //          error: function(xhr, status, error) {
   //             // Handle errors if needed
   //          }
   //       });
   //       return false;
   // });
   // $('.checkouteventpluscheck').click(function () {
   //       var $input = $(this).parent().parent().parent().find('input');
   //       var id = $(this).data('id');
   //       var max= $(".eventplusdata_" + id).attr('max');
   //       console.log(max + 'xgvfdgfdg' + $input.val());
   //       if(max == $input.val()){
   //       $(".eventplusdata_" + id).val(max);
   //       }else{
   //       $input.val(parseInt($input.val()) + 1);
   //       $input.change();
   //       var price = $('.eventplusdata_'+ id).data('price');
   //       var quantity = $input.val();
   //       var totalprice = (price * quantity).toFixed(2);
   //       $(".eventquantityprice_" + id).find(".eventamount").html(totalprice);
   //       var sum = 0;
   //       $('.productamount').each(function(){
   //             sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
   //       });
   //       var eventamount = 0;
   //       $('.eventamount').each(function(){
   //          eventamount += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
   //       });
   //       var cartamount = (eventamount + sum).toFixed(2)
   //       $(".totalamount").html("$"+cartamount);
   //       $.ajax({
   //             url: " {{route('event_cart_update',$businessSlug)}}",
   //             type: "POST",
   //             data: {
   //             "_token": "{{ csrf_token() }}",
   //             "id": id,
   //             "quantity":quantity
   //             },
   //             success: function(data) {
   //             //  $('.jb_preloader').addClass('loaded');
   //             }
   //       });
   //       }
   //       return false;
   // });

   // function checkouteventcustomeCheck(id){
   //    var input = $(".eventplusdata_" + id);  // Use the correct selector to get the input element
   //    var max = input.attr('max');
   //    console.log(input.val()+"fsddsfsd"+max);
   //    var inputValue = parseFloat(input.val());  // Parse the input value to a float
   //    if(inputValue == 0){
   //       $(".eventplusdata_"+ id).val('0');
   //    }
   //    if (max && inputValue >= parseFloat(max)) { 
   //          $(".eventplusdata_"+ id).val(max);
   //    } else {
   //    $(".eventplusdata_"+ id).change();
      
   //    }
   //    var quantity = input.val();
   //    $.ajax({
   //             url: " {{route('event_cart_update',$businessSlug)}}",
   //             type: "POST",
   //             data: {
   //             "_token": "{{ csrf_token() }}",
   //             "id": id,
   //             "quantity":quantity
   //             },
   //             success: function(data) {
   //             //  $('.jb_preloader').addClass('loaded');
   //             }
   //       });
   // }
</script>
@endsection