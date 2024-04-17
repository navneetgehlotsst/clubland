<div class="footer jb_cover">

  <div class="container">

    <div class="row">

    <?php 

      $footeremail = Helper::GetCompanyPoratalFooterEmail();

      $footerphone = Helper::GetCompanyPoratalFooterPhone();

      $footerSecationFirst = Helper::GetCompanyPoratalFooterSecationFirst();

      $footerSecationSecaond = Helper::GetCompanyPoratalFooterSecationSecond();

      $media = Helper::GetCompanyPoratalMediasecation();

      

    ?> 

      <div class="col-lg-4 col-sm-6 col-12">

        <div class="footerNav jb_cover">

          @if($footerphone->count() > 0 && $footeremail->count() > 0)

          <h5>{{@$footerphone[0]['name'] ?? 'Company'}}</h5>

          @else

          <h5>Company</h5>

          @endif

          <ul class="footer_first_contact">

            @if($footerphone->count() > 0)

            <li><i class="flaticon-telephone"></i>

              @foreach ($footerphone as $valu)

                <p>{{$valu->number}} <br>

              @endforeach

             </li>

            @endif

            @if($footeremail->count() > 0)

            <li>

              <i class="flaticon-envelope"></i> 

              @foreach ($footeremail as $values)

              <a href="mailto:info@clubland.com.au">{{$values->email}} </a> 

              @endforeach

              <br>

            </li>

           

            @else

          

            <li>

              <i class="flaticon-envelope"></i> 

              <a href="mailto:info@clubland.com.au" class="mt-2">info@clubland.com.au </a> <br>

            </li>

            @endif

          </ul>

          <ul class="icon_list_news jb_cover">

            @if($media->facebook)

              <li><a href="{{$media->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>

            @endif

            @if($media->twitter)

            <li> <a href="{{$media->twitter}}" target="_blank"><i class="fab fa-twitter"></i> </a> </li>

            @endif

            @if($media->linkedin)

            <li><a href="{{$media->linkedin}}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>

            @endif

            @if($media->instagram)

            <li><a href="{{$media->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>

            @endif



            

            

            

          </ul>

        </div>

      </div>

      <div class="col-lg-4 col-sm-6 col-12">

        <div class="footerNav jb_cover footer_border_displ">

          

          

          @if($footerSecationFirst->count() > 0)

          <h5>{{$footerSecationFirst['0']['name'] ?? 'Businesses'}}</h5>

            <ul class="nav-widget">

               @foreach ($footerSecationFirst as $first)

                <li><a href="{{$first->url}}" scroll-trigger="section1"><i class="fa fa-square"></i>{{$first->menu}} </a></li>

               @endforeach 

            </ul>

          

          @else

         

          <h5>Businesses</h5>

            <ul class="nav-widget">

              <li><a href="{{url('/product/all')}}" scroll-trigger="section1"><i class="fa fa-square"></i>Club </a></li>

              <li><a href="{{url('/event/all')}}" scroll-trigger="section2"><i class="fa fa-square"></i>Events </a></li>

              <li><a href="{{url('/facility/all')}}" scroll-trigger="section3"><i class="fa fa-square"></i>Facility </a></li>

            </ul>

          @endif

         

        </div>

      </div>

      <div class="col-lg-4 col-sm-6 col-12">

        <div class="footerNav jb_cover footer_border_displ">

         

          @if($footerSecationSecaond->count() > 0)

          <h5>{{$footerSecationSecaond['0']['name'] ?? 'About'}}</h5>

            <ul class="nav-widget">

               @foreach ($footerSecationSecaond as $first)

                <li><a href="{{$first->url}}" scroll-trigger="section1"><i class="fa fa-square"></i>{{$first->menu}} </a></li>

               @endforeach 

            </ul>

          @else

          

          

            <h5>About</h5>

          <ul class="nav-widget">

          <li><a href="{{url('/about-us')}}"><i class="fa fa-square"></i>About us</a></li>

          </ul>

          @endif

        </div>

      </div>

     <!-- <div class="col-lg-3 col-sm-6 col-12">

        <div class="footerNav jb_cover footer_border_displ">

          <h5>Contact</h5>

          <ul class="nav-widget">

          <li> <a href="{{route('portal_contact_us',$businessSlug)}}"><i class="fa fa-square"></i>Contact </a> </li>

            <li> <a href="mailto:info@clubland.com.au"><i class="fa fa-square"></i>Email </a> </li>

             <li> <a href=""><i class="fa fa-square"></i>Help Center </a> </li> 

          </ul>

        </div>

      </div>  -->

      <div class="copyright_left"><i class="fa fa-copyright"></i> 2024 Clubland Services |  All Rights Reserved. Design by Supportsoft. </div>

      <div class="clearfix"></div>

    </div>

  </div>

  <div class="waveWrapper waveAnimation">

    <div class="waveWrapperInner bgTop gradient-color">

      <div class="wave waveTop"></div>

    </div>

    <div class="waveWrapperInner bgMiddle">

      <div class="wave waveMiddle"></div>

    </div>

    <div class="waveWrapperInner bgBottom">

      <div class="wave waveBottom"></div>

    </div>

  </div>

</div>

<script src="{{asset('/web/js/jquery-3.3.1.min.js')}}"></script> 

  

<script src="{{asset('/web/js/popper.min.js')}}"></script>

<script src="{{asset('/web/js/bootstrap.min.js')}}"></script> 

<script src="{{asset('/web/js/modernizr.js')}}"></script> 

<script src="{{asset('/web/js/jquery.menu-aim.js')}}"></script> 


<script src="{{asset('/web/js/owl.carousel.js')}}"></script> 

<script src="{{asset('/web/js/jquery-ui.js')}}"></script> 

<script src="{{asset('/web/js/jquery.inview.min.js')}}"></script> 

<script src="{{asset('/web/js/jquery.nice-select.min.js')}}"></script> 

<script src="{{asset('/web/js/isotope.pkgd.min.js')}}"></script> 

<script src="{{asset('/web/js/custom.js')}}"></script>



<script src="{{asset('/web/js/moment.js')}}"></script>

  <script src="{{asset('/web/js/fullcalendar.min.js')}}"></script>

  <script src="{{asset('/web/js/datepicker.js')}}"></script>

  <script src="{{asset('/web/js/datepicker.en.js')}}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
  <link href="{{ asset('assets/sweet-alert/sweetalert.min.css') }}" rel="stylesheet" />

      <script>

        var thumbs = $('.img-selection').find('img');
            thumbs.click(function(){
              var src = $(this).attr('src');
              var dp = $('.display-img');
              var img = $('.zoom');
              dp.attr('src', src);
              img.attr('src', src);
            });

            $(".img-thumbnail").click(function(){
              $('.img-thumbnail').removeClass('selected');
              $(this).addClass('selected');
            });

            var zoom = $('.big-img').find('img').attr('src');
            $('.big-img').append('<img class="zoom" src="'+zoom+'">');
            $('.big-img').mouseenter(function(){
              $(this).mousemove(function(event){
                  var offset = $(this).offset();
                  var left = event.pageX - offset.left;
                  var top = event.pageY - offset.top;
                  $(this).find('.zoom').css({
                  width: '200%',
                  opacity: 1,
                  left: -left,
                  top: -top,
                  });
              });
            });

            $('.big-img').mouseleave(function(){
              $(this).find('.zoom').css({
                  width: '100%',
                  opacity: 0,
                  left: 0,
                  top: 0,
              });
            });
            $(document).ready(function() {
              var sum = 0;
              var eventamount = 0;

              $('.productamount').each(function(){
                  sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
              });
              $('.eventamount').each(function(){
                eventamount += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
              });
              
              cartamount = (eventamount+sum).toFixed(2)
              $(".totalamount").html("$"+cartamount);
             // var paltformfee = ((3.75 / 100) * sum) + 0.50;
             // $(".platformefee").html("$"+paltformfee.toFixed(2));
              ///var totalIncAmount = parseFloat(sum + paltformfee);
             // $(".totalIncAmount").html("$"+totalIncAmount.toFixed(2));
              //check out page calculation 
              var checkoutprice = 0;
              $('.checkoutprice').each(function(){
                 checkoutprice += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
              });
             
              var checkpaltformfee = ((3.75 / 100) * checkoutprice) + 0.50;
              $(".checkoutplatform").html("$"+checkpaltformfee.toFixed(2));
              $(".finalamount").html("$"+ parseFloat(checkoutprice).toFixed(2));

              



            });

            $(document).ready(function() {
              $(function() {
                $(".number").keypress(function (e) {
                  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    e.preventDefault(); // This prevents the default action for non-numeric keys
                  }
                });
              });
              $('.minus').click(function () {
                //$('#errorcart').hide();
                var $input = $(this).parent().parent().parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                var price = $('#productCart').data('price');
                  var disprice = $('#productCart').data('disprice');
                  var quantity = $input.val();
                  var totalprice = price * quantity;
                  var totaldisprice = disprice * quantity;
                  var price = ((3.75 / 100) * totalprice) + 0.50;
                  var price_amount = parseFloat(price + totalprice).toFixed(2);

                  var discount = ((3.75 / 100) * totaldisprice) + 0.50;
                  var price_discount = parseFloat(totaldisprice + discount).toFixed(2);
                 
                  $(".price-amount").html("$" + totalprice);
                  if(totaldisprice != 0){
                    $(".discount-amount").html("$" + totaldisprice + " <del>$"+totalprice+"</del>");
                  }
                return false;
              });
              $('.plus').click(function () {

                var $input = $(this).parent().parent().parent().find('input');

                

                var max= $("#productCart").attr('max');

                if(max == $input.val()){
                //  alert('out of stock');
                  $("#productCart").val(max);

                }else{
                  $input.val(parseInt($input.val()) + 1);
                  $input.change();
                  var price = $('#productCart').data('price');
                  var disprice = $('#productCart').data('disprice');
                  var quantity = $input.val();
                  var totalprice = price * quantity;
                  var totaldisprice = disprice * quantity;

                  var price = ((3.75 / 100) * totalprice) + 0.50;
                  var price_amount = parseFloat(price + totalprice).toFixed(2);

                  var discount = ((3.75 / 100) * totaldisprice) + 0.50;
                  var price_discount = parseFloat(totaldisprice + discount).toFixed(2);

                  $(".price-amount").html("$" + totalprice);
                  $(".discount-amount").html("$" + totaldisprice + " <del>$"+totalprice+"</del>");
                }

                

                return false;

              });
              $('#productCart').keyup(function () {
                  var input = $(this).val(); 
                  var max = $("#productCart").attr('max');
                  if(input == 0){
                    $("#productCart").val('1');
                  }
                  if (parseInt(input) >= parseInt(max)) { 
                    //alert('out of stock');
                    $("#productCart").val(max);
                      var price = $('#productCart').data('price');
                      var disprice = $('#productCart').data('disprice');
                      var quantity = max;
                      var totalprice = price * quantity;
                      var totaldisprice = disprice * quantity;
                     
                      $(".price-amount").html("$" + totalprice);
                      $(".discount-amount").html("$" + totaldisprice + " &nbsp;<del>$"+totalprice+"</del>");
                    return false;
                  } else {
                      var add = $("#productCart").val();
                      $("#productCart").change();
                      var price = $('#productCart').data('price');
                      var disprice = $('#productCart').data('disprice');
                      var quantity = add;
                      var totalprice = price * quantity;
                      var totaldisprice = disprice * quantity;
                      
                      $(".price-amount").html("$" + totalprice);
                      $(".discount-amount").html("$" + totaldisprice + " &nbsp;<del>$"+totalprice+"</del>");

                  }
                 return false;
            });
              //Cart List Script
              $('.cartplus').click(function () {
                  var id = $(this).data('id');
                  var $input = $(this).parent().parent().find('input');
                  var max = $(".plusdata_"+id).attr('max');
                  if (max == $input.val()) {
                   //   alert('Out of stock');
                  } else {
                      $input.val(parseInt($input.val()) + 1);
                      $input.change(); // Trigger the change event if needed
                      var price = $('.plusdata_'+id).data('price');
                      var disprice = $('.plusdata_'+id).data('disprice');
                      var quantity = $input.val();
                      var totalprice = (price * quantity);
                      var totaldisprice = (disprice * quantity);
               
                      
                      $(".quantityprice_" + id).find(".productamount").html(totalprice);
                      $(".quantityprice_" + id).find(".productamount").html(totaldisprice);
                      var sum = 0;
                      $('.productamount').each(function(){
                          sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
                      });
                      var eventamount = 0;
                      $('.eventamount').each(function(){
                        eventamount += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
                      });
                      var cartamount = (eventamount + sum);
                      $(".totalamount").html("$" + cartamount);
                      // var paltformfee = ((3.75 / 100) * sum) + 0.50;
                      // $(".platformefee").html("$"+paltformfee.toFixed(2));
                      // var totalIncAmount = parseFloat(sum + paltformfee);
                      // $(".totalIncAmount").html("$"+totalIncAmount.toFixed(2));
                      //$('.jb_preloader').removeClass('loaded');

                      $.ajax({
                        url: " {{url('/update-cart')}}",
                        type: "POST",
                        data: {
                          "_token": "{{ csrf_token() }}",
                          "id": id,
                          "quantity":quantity
                        },
                        success: function(data) {
                        //  $('.jb_preloader').addClass('loaded');
                        }
                      });

                  }

              });
              $('.cartminus').click(function () {
                var $input = $(this).parent().parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                var id = $(this).data('id');
                $input.val(count);
                $input.change();
                var price = $('.plusdata_'+ id).data('price');
                var disprice = $('.plusdata_'+ id).data('disprice');
                var quantity = $input.val();
                var totalprice = (price * quantity);
                var totaldisprice = (disprice * quantity);
               

                $(".quantityprice_" + id).find(".productamount").html(totalprice);
                $(".quantityprice_" + id).find(".productamount").html(totaldisprice);
                var sum = 0;
                $('.productamount').each(function(){
                    sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
                });
                
                var eventamount = 0;
                      $('.eventamount').each(function(){
                        eventamount += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
                      });
                      var cartamount = (eventamount + sum)
                $(".totalamount").html("$"+cartamount);
                var paltformfee = ((3.75 / 100) * sum) + 0.50;
                $(".platformefee").html("$"+paltformfee.toFixed(2));
                var totalIncAmount = parseFloat(sum + paltformfee);
                $(".totalIncAmount").html("$"+totalIncAmount.toFixed(2));
                    $.ajax({
                        url: " {{url('/update-cart')}}",
                        type: "POST",
                        data: {
                          "_token": "{{ csrf_token() }}",
                          "id": id,
                          "quantity":quantity
                        },
                        success: function(data) {
                        //  $('.jb_preloader').addClass('loaded');
                        }
                    });
              });

              
		        });

            
            function removecart(id) {
                // Use the correct selector to hide the element
                $('#remove_' + id).hide();

                $.ajax({
                    url: "{{ url('/remove-cart') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Remove!',
                            text: 'Product removed from the cart successfully.',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function (error) {
                        // Handle error, if necessary
                        console.error('Error removing product from the cart:', error);
                    }
                });
            }


            function removeEventcart(id) {
                // Use the correct selector to hide the element
               // $('#remove_' + id).hide();

                $.ajax({
                    url: "{{ url('/remove-event-cart') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Remove!',
                            text: 'Product removed from the cart successfully.',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function (error) {
                        // Handle error, if necessary
                        console.error('Error removing product from the cart:', error);
                    }
                });
            }

            $('.plusdata').keyup(function () {
                  var input = $(this).val(); 
                  var max = $(".plusdata").attr('max');
                  var id = $(".plusdata").data('id');

                  if (parseInt(input) >= parseInt(max)) { 
                      $(".plusdata").val(max);
                      var price = $('.plusdata').data('price');
                      var disprice = $('.plusdata').data('disprice');
                      var quantity = input;
                      var totalprice = price * quantity;
                      var totaldisprice = disprice * quantity;
                      
                      $(".quantityprice").html("$" + totalprice);
                      $(".quantityprice").html("$" + totaldisprice);
                   //   alert('out of stock');
                  } else {
                      var add = $(".plusdata").val();
                      $(".plusdata").change();
                      var price = $('.plusdata').data('price');
                      var disprice = $('.plusdata').data('disprice');
                      var quantity = add;
                      var totalprice = price * quantity;
                      var totaldisprice = disprice * quantity;
                     
                      $(".quantityprice").html("$" + totalprice);
                      $(".quantityprice").html("$" + totaldisprice);
                      $.ajax({
                        url: " {{url('/update-cart')}}",
                        type: "POST",
                        data: {
                          "_token": "{{ csrf_token() }}",
                          "id": id,
                          "quantity":quantity
                        },
                        success: function(data) {
                        //  $('.jb_preloader').addClass('loaded');
                        }
                    });

                  }
                 return false;
            });

            function changequantity(id){

              var input = $(".plusdata_" + id);  // Use the correct selector to get the input element
              var max = input.attr('max');
              var inputValue = parseFloat(input.val());  // Parse the input value to a float
              if(inputValue == 0 || input.val() == '' ){
                $(".plusdata_"+ id).val('1');
              }
              if (max && inputValue >= parseFloat(max)) { 
                    $(".plusdata_"+ id).val(max);
                  //  alert(max);
                  //  alert('out of stock');
                    var price = $('.plusdata_'+ id).data('price');
                    var disprice = $('.plusdata_'+ id).data('disprice');
                    var quantity = max;
                    var totalprice = (price * quantity).toFixed(2);
                    var totaldisprice = (disprice * quantity).toFixed(2);
                    $(".quantityprice_" + id).find(".productamount").html(totalprice);
                    $(".quantityprice_" + id).find(".productamount").html(totaldisprice);
                    var sum = 0;
                    $('.productamount').each(function(){
                        sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
                    });

                    var eventamount = 0;
                      $('.eventamount').each(function(){
                        eventamount += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
                      });
                      var cartamount = (eventamount + sum).toFixed(2)
                    $(".totalamount").html("$"+cartamount);
                    var paltformfee = ((3.75 / 100) * sum) + 0.50;
                    $(".platformefee").html("$"+paltformfee.toFixed(2));
                    var totalIncAmount = parseFloat(sum + paltformfee);
                    $(".totalIncAmount").html("$"+sum.toFixed(2));
                } else {
                    var add = $(".plusdata_"+ id).val();
                    $(".plusdata_"+ id).change();
                    var price = $('.plusdata_'+ id).data('price');
                    var disprice = $('.plusdata_'+ id).data('disprice');
                    var quantity = add;
                    var totalprice = price * quantity;
                    var totaldisprice = disprice * quantity;
                    
                    $(".quantityprice_" + id).find(".productamount").html(totalprice);
                    $(".quantityprice_" + id).find(".productamount").html(totaldisprice);
                    var sum = 0;
                    $('.productamount').each(function(){
                        sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
                    });
                    var eventamount = 0;
                      $('.eventamount').each(function(){
                        eventamount += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
                      });
                      var cartamount = (eventamount + sum).toFixed(2)
                    $(".totalamount").html("$"+cartamount);
                    var paltformfee = ((3.75 / 100) * sum) + 0.50;
                    $(".platformefee").html("$"+paltformfee.toFixed(2));
                    var totalIncAmount = parseFloat(sum + paltformfee);
                    $(".totalIncAmount").html("$"+totalIncAmount.toFixed(2));
                    $.ajax({
                      url: " {{url('/update-cart')}}",
                      type: "POST",
                      data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "quantity":quantity
                      },
                      success: function(data) {
                      //  $('.jb_preloader').addClass('loaded');
                      }
                  });
                }
            }
            $(function() {
              $("form[name='payment']").validate({
                submitHandler: function(form) {
                  form.submit();
                }
              });
            });

            $(function() {
              $("form[name='checkaddtocart']").validate({
                rules: {
                  size: {
                    required: true
                  }, 
                  color: {
                    required: true
                  }
                },
                submitHandler: function(form) {
                  form.submit();
                }
              });
            });

            $(function() {
              $("form[name='updateaddtocart']").validate({
                rules: {
                  size: {
                    required: true
                  }, 
                  color: {
                    required: true
                  }
                },
                submitHandler: function(form) {
                  form.submit();
                }
              });
            });

            $('#updateaddtocart').submit(function(e){
              $('.jb_preloader').removeClass('loaded');
              e.preventDefault();
              let form = $('#updateaddtocart')[0];
              let data = new FormData(form);
              $.ajax({
                url: " {{url('/event-details-quintity-update')}}",
                type: "POST",
                data : data,
                dataType:"JSON",
                processData : false,
                contentType:false,
                success: function(data) {
                  
                  if(data.status == 'out of stock'){
                    $('#errorcart').show();
                    $('#allredayadd').hide();
                  }else if(data.status == 'all ready add'){
                  $('.jb_preloader').addClass('loaded');
                    $('#errorcart').hide();
                    $('#allredayadd').show();
                  }else if(data.status == 'select quantity'){
                    $('.jb_preloader').addClass('loaded');

                    $('#errorcart').show();
                    
                  }else{
                  //    $('.jb_preloader').addClass('loaded');
                    window.location.href = "{{route('cart_list',$businessSlug)}}";
                  }
                }
              });
            })
            $('#checkaddtocart').submit(function(e){
              $('.jb_preloader').removeClass('loaded');
              e.preventDefault();
              let form = $('#checkaddtocart')[0];
              let data = new FormData(form);
              $.ajax({
                url: " {{url('/add-to-cart')}}",
                type: "POST",
                data : data,
                dataType:"JSON",
                processData : false,
                contentType:false,
                success: function(data) {
                  
                  if(data.status == 'out of stock'){
                    $('#errorcart').show();
                    $('#allredayadd').hide();
                  }else if(data.status == 'all ready add'){
                  $('.jb_preloader').addClass('loaded');
                    $('#errorcart').hide();
                    $('#allredayadd').show();
                  }else if(data.status == 'select quantity'){
                    $('.jb_preloader').addClass('loaded');

                    $('#errorcart').show();
                    
                  }else{
                  //    $('.jb_preloader').addClass('loaded');
                    window.location.href = "{{url('/cart-list')}}";
                  }
                }
              });
            })

            $('.eventcartmin').click(function () {
                var $input = $(this).parent().parent().parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                var id = $(this).data('id');

                var quantity = $input.val();
                $.ajax({
                  url: " {{url('/update-cart')}}",
                  type: "POST",
                  data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "quantity":quantity
                  },
                  success: function(data) {
                  //  $('.jb_preloader').addClass('loaded');
                  }
                });
                return false;

            });
            
            $('.eventcartplus').click(function () {
              var $input = $(this).parent().parent().parent().find('input');
              var id = $(this).data('id');
              var max= $("#eventquanity_" + id).attr('max');
              if(max == $input.val()){
                $("#eventquanity_" + id).val(max);
              }else{
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                var quantity = $input.val();
                $.ajax({
                  url: "{{url('/update-cart')}}",
                  type: "POST",
                  data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "quantity":quantity
                  },
                  success: function(data) {
                  //  $('.jb_preloader').addClass('loaded');
                  }
                });
              }
              return false;
            });

            $('.checkoutpaideventminus').click(function () {
              var $input = $(this).parent().parent().parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                var id = $(this).data('id');
                $input.val(count);
                $input.change();

                var price = $('.eventplusdata_'+ id).data('price');
                var quantity = $input.val();
                var totalprice = (price * quantity);
                $(".eventquantityprice_" + id).find(".eventamount").html(totalprice);
                var eventamount = 0;
                $('.eventamount').each(function(){
                  eventamount += parseFloat($(this).text());  
                });
                var sum = 0;
                $('.productamount').each(function(){
                    sum += parseFloat($(this).text());  
                });
                
                var cartamount = (eventamount + sum).toFixed(2)
                $(".totalamount").html("$"+cartamount);
                $.ajax({
                    url: "{{url('/event-update-cart')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "quantity":quantity
                    },
                    success: function(data) {
                        // Handle success if needed
                    },
                    error: function(xhr, status, error) {
                        // Handle errors if needed
                    }
                });
                return false;
            });
            $('.checkoutpaideventplus').click(function () {
                var $input = $(this).parent().parent().parent().find('input');
                var id = $(this).data('id');
                var max= $(".eventplusdata_" + id).attr('max');
                if(max == $input.val()){
                  $(".eventplusdata_" + id).val(max);
                }else{
                  $input.val(parseInt($input.val()) + 1);
                  $input.change();

                  var price = $('.eventplusdata_'+ id).data('price');
                  var quantity = $input.val();
                  var totalprice = (price * quantity);
                  $(".eventquantityprice_" + id).find(".eventamount").html(totalprice);
                  var sum = 0;
                  $('.productamount').each(function(){
                      sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
                  });
                  var eventamount = 0;
                  $('.eventamount').each(function(){
                    eventamount += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
                  });
                  var cartamount = (eventamount + sum).toFixed(2)
                  $(".totalamount").html("$"+cartamount);
                  $.ajax({
                      url: "{{url('/event-update-cart')}}",
                      type: "POST",
                      data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "quantity":quantity
                      },
                      success: function(data) {
                      //  $('.jb_preloader').addClass('loaded');
                      }
                  });
                }
                return false;
            });

            //checkout callulation
            $(document).ready(function() {
              var sum =0;
              var productsum=0;
              var totalCheckouteventPrice = 0;
              $('.totalCheckouteventPrice').each(function(){
                totalCheckouteventPrice += parseFloat($(this).text());  
              });
             
             // $(".eventcheckout").html(parseFloat(totalCheckouteventPrice).toFixed(2));

              $('.checkoutprice').each(function(){
                productsum += parseFloat($(this).text());  
              });
                $('.cartamount').each(function(){

                  sum += parseFloat($(this).text());  
                });
                var cartamount = (productsum + sum).toFixed(2)
                
                if(cartamount == 0){
                  $('.freeevent').show();
                  $('.paidevent').hide();

                }else{
                  $('.freeevent').hide();
                  $('.paidevent').show();

                }
                $(".finalamount").html("$"+cartamount);
                

             

            });

  $(document).ready(function() {
    $("input[name$='check_age']").click(function() {
        var test = $(this).val();
        if(test == 1){
          $("#Guardians").show();
        }else{
          $("#Guardians").hide();
        }
    });
  });
            
      </script>

</body>

</html>



