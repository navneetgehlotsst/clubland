<div class="footer jb_cover">

  <div class="container">

    <div class="row">

      <div class="col-lg-3 col-sm-6 col-12">

        <div class="footerNav jb_cover">

          <h5>Clubland</h5>

          <ul class="footer_first_contact">

            <!-- <li><i class="flaticon-telephone"></i>

              <p>1 -234 -456 -7890 <br>

                1 -234 -456 -7890</p>

            </li> -->

            <li><i class="flaticon-envelope"></i> <a class="mt-2" href="mailto:info@clublandservices.com">info@clublandservices.com </a> 

          </ul>

          <ul class="icon_list_news jb_cover">

            <li><a href="https://www.facebook.com/clublandservices"><i class="fab fa-facebook-f"></i></a></li>

            <li> <a href="https://twitter.com/clublandservice"><i class="fab fa-twitter"></i> </a> </li>

            <li><a href="https://www.instagram.com/clubland_services/"><i class="fab fa-instagram"></i></a></li>

            <li><a href="https://www.youtube.com/@ClublandServices"><i class="fab fa-youtube"></i></a></li>

          </ul>

        </div>

      </div>

      <div class="col-lg-3 col-sm-6 col-12">

        <div class="footerNav jb_cover footer_border_displ">

          <h5>Businesses</h5>

          <ul class="nav-widget">

          <li><a href="{{route('how_it_work')}}"><i class="fa fa-square"></i>How it works </a></li>

          @if(Auth::check())

           

            @else

              <li><a href="{{route('business_register')}}"><i class="fa fa-square"></i>Register </a></li>

            @endif

            



          </ul>

        </div>

      </div>

      <div class="col-lg-3 col-sm-6 col-12">

        <div class="footerNav jb_cover footer_border_displ">

          <h5>About</h5>

          <ul class="nav-widget">

            <li><a href="{{route('about_us')}}"><i class="fa fa-square"></i>About us</a></li>

            <li><a href="{{route('cms_all_pages','privacy_policy')}}"><i class="fa fa-square"></i>Privacy Policy</a></li>

            <li><a href="{{route('cms_all_pages','terms_conditions')}}"><i class="fa fa-square"></i>Terms & Conditions</a></li>

          </ul>

        </div>

      </div>

      <div class="col-lg-3 col-sm-6 col-12">

        <div class="footerNav jb_cover footer_border_displ">

          <h5>Contact</h5>

          <ul class="nav-widget">

            <li> <a href="{{route('contact_us')}}"><i class="fa fa-square"></i>Contact </a> </li>

            <li> <a href="{{route('cms_all_pages','pricing')}}"><i class="fa fa-square"></i>Pricing</a> </li>

          </ul>

        </div>

      </div>

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

   <!-- calendar modal -->

   <div id="modal-view-event" class="modal modal-top fade calendar-modal">

    <div class="modal-dialog modal-dialog-centered">

      <div class="modal-content">

        <div class="modal-body">

          <h4 class="modal-title"><span class="event-icon"></span><span class="event-title"></span><lable style="float: right;color: #009134;" id="editreminder" data-id=""><i class="fas fa-edit pr-1"></i></lable></h4>

          

          <div class="event-body" style="overflow: scroll; overflow-x: auto;overflow-y: auto;height: 400px;"></div>

        </div>

        <div class="modal-footer">

        <div class="button_div float-end mt-30">

              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>

        </div>

      </div>

    </div>

  </div>



  

</div>

<!-- Product Delete Modal Start-->

<div class="modal fade" id="ProductdeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 185px;">

  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel"></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <div class="text-center py-5">

          <h3 class="font-weight-bold mb-2">Are you sure you want to delete this product ?</h3>

          <p>This will delete this post permanently. You cannot undo this action</p>

        </div>

      </div>

      <div class="modal-footer button_div text-center">

        <button type="button" class="btn orange-border-btn btn-50" data-dismiss="modal">Close</button>

        <form class="dashboard_form" action="{{route('product_remove')}}" name="productform" method="post">

              @csrf

              <input type="hidden" id="product_id" name="product_id" value="">

              <button type="submit" class="btn btn-50">Delete</button>

        </form>      

      </div>

    </div>

  </div>

</div>

<!-- Product Delete Modal End-->

<!-- Event Delete Modal Start-->

<div class="modal fade" id="EvtntdeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 185px;">

  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel"></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <div class="text-center py-5">

          <h3 class="font-weight-bold mb-2">Are you sure you want to delete this event ?</h3>

          <p>This will delete this post permanently. You cannot undo this action</p>

        </div>

      </div>

      <div class="modal-footer button_div text-center">

        <button type="button" class="btn orange-border-btn btn-50" data-dismiss="modal">Close</button>

        <form class="dashboard_form" action="{{route('event_remove')}}" name="event" method="post">

              @csrf

              <input type="hidden" id="event_id" name="event_id" value="">

              <button type="submit" class="btn btn-50">Delete</button>

        </form>      

      </div>

    </div>

  </div>

</div>

<!-- Event Delete Modal End-->



<!-- Ficility Delete Modal Start-->

<div class="modal fade" id="FacilitydeleteModal" tabindex="-1" role="dialog" aria-labelledby="FacilitydeleteModal" aria-hidden="true" style="margin-top: 185px;">

  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="FacilitydeleteModal"></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <div class="text-center py-5">

          <h3 class="font-weight-bold mb-2">Are you sure you want to delete this Facility ?</h3>

          <p>This will delete this post permanently. You cannot undo this action</p>

        </div>

      </div>

      <div class="modal-footer button_div text-center">

        <button type="button" class="btn orange-border-btn btn-50" data-dismiss="modal">Close</button>

        <form class="dashboard_form" action="{{route('facility_remove')}}" name="event" method="post">

              @csrf

              <input type="hidden" id="facility_id" name="facility_id" value="">

              <button type="submit" class="btn btn-50">Delete</button>

        </form>      

      </div>

    </div>

  </div>

</div>

<!-- Ficility Delete Modal End-->



<!-- <div class="modal fade other" tabindex="-1" role="dialog">

  <div class="modal-dialog" role="document" style="margin-top: 13%;">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Modal title</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>

      <form name="contactUsForm" id="contactUsForm" method="post" action="javascript:void(0)">

        @csrf

      <div class="modal-body">

        <label class="form-label">Category Name</label>

        <input type="text" id="new_cat" required class="form-control" name="new_cat" placeholder="Enter CategoryName">

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="submit" id="submit" class="btn btn-primary">Save</button>

      </div>

    </div>

  </div>

</div> -->

<div class="modal fade" id="AccountdeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 185px;">

  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel"></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <div class="text-center py-5">

          <h3 class="font-weight-bold mb-2">Are you sure you want to delete this Account ?</h3>

          <p>This will delete this post permanently. You cannot undo this action</p>

        </div>

      </div>

      <div class="modal-footer button_div text-center">

        <button type="button" class="btn orange-border-btn btn-50" data-dismiss="modal">Close</button>

        <form class="dashboard_form" action="{{route('account_remove')}}" name="account_remove" method="post">

              @csrf

              <input type="hidden" id="account_id" name="account_id" value="">

              <button type="submit" class="btn btn-50">Delete</button>

        </form>      

      </div>

    </div>

  </div>

</div>



<script src="{{asset('/web/js/jquery-3.3.1.min.js')}}"></script> 

  

<script src="{{asset('/web/js/popper.min.js')}}"></script>

<script src="{{asset('/web/js/gijgo.min.js')}}" type="text/javascript"></script>

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

  <script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>

  

  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>







<script>



  $(document).ready(function() {

    $(function() {

  $("form[name='add_reminder']").validate({

    rules: {

      // Other field validations

      ename: {

        required: true

      },

      e_start_date: {

        required: true

      },

      e_end_date: {

        required: true

      },

      edesc: {

        required: true

      },

     



    },

    submitHandler: function(form) {

      form.submit();

    }

  });

});



    $("#plan_search").blur(function(){

      $("#planSerach").submit();

        // $.ajax({

        //   url: "{{route('event_serach')}}",

        //   type: "get",

        //   data:{

        //     "_token": "{{ csrf_token() }}",

        //     "search" :search

        //   },

        //   dataType: "json",

        //   success: function( response ) {

        //     console.log(response);

        //   }

        // });

    });

    if ($("#contactUsForm").length > 0) {

          $("#contactUsForm").validate({

            rules: {

              new_cat: {

            },

            },

            messages: {

              new_cat: {

              required: "Please enter name category",

            },

            },

            submitHandler: function(form) {

              $('#submit').html('Please Wait...');

              $("#submit"). attr("disabled", true);

                  $.ajax({

                    url: "{{route('add_business_cat')}}",

                    type: "POST",

                    data:{

                      "_token": "{{ csrf_token() }}",

                      "new_cat" :$('#new_cat').val() 

                    },

                    dataType: "json",

                    success: function( response ) {

                      $('#submit').html('Submit');

                      $("#submit"). attr("disabled", false);

                      $('#change').html('');

                      $('#change').append(response.data);

                      alert('Your Event Category Add Successfully.')

                      $('.other').modal('hide');

                      document.getElementById("contactUsForm").reset(); 

                    }

                  });

            }

          })

    }

  });



  $('#change').change(function(){

    var title = $(this).val();

    if(title == "other"){

      $('#otherEvent').show();

    }else{

      $('#otherEvent').hide();

    }

  });



  $('#changeClub').change(function(){

    var title = $(this).val();

    if(title == "other"){

        $('#other').show();

        $("#NewType").attr("required", "required"); // Add "required" attribute

    } else {

        $('#other').hide();

        $("#NewType").removeAttr("required"); // Remove "required" attribute

    }

});

    $(".js-example-basic-multiple-limit").select2({

    });

    $(document).ready(function() {

      $('#editreminder').click(function(){

        var reminderId = $(this).attr("data-id");

        $("#modal-view-event").modal('hide');

        $.ajax({

          url: " {{route('get_reminder_data')}}",

          type : "get",

          data: {

            "_token": "{{ csrf_token() }}",

            "reminderId": reminderId,

          },

          success: function(data) {

            var eventStartDate = moment(data.data.event_start_date);

            var start = eventStartDate.format('MM/DD/YYYY HH:mm');

            var eventEndDate = moment(data.data.event_end_date);

            var end = eventEndDate.format('MM/DD/YYYY HH:mm');

            $("#ename").val(data.data.event_name);

            $("#remindereditID").val(data.data.id);

            

            $("#e_start_date").val(start);

            $("#e_end_date").val(end);

            $("#edesc").val(data.data.event_description);

            $("#modal-view-event-edit").modal('show');

          }

        });

      })

      CKEDITOR.replace('editor1', {

        skin: 'moono',

        enterMode: CKEDITOR.ENTER_BR,

        shiftEnterMode:CKEDITOR.ENTER_P,

        toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },

          { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },

          { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },

          { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },

          { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },

          { name: 'links', items: [ 'Link', 'Unlink' ] },

          { name: 'insert', items: [ 'Image'] },

          { name: 'spell', items: [ 'jQuerySpellChecker' ] },

          { name: 'table', items: [ 'Table' ] }

      ],

      });

      CKEDITOR.replace('editor2', {

        skin: 'moono',

        enterMode: CKEDITOR.ENTER_BR,

        shiftEnterMode:CKEDITOR.ENTER_P,

        toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },

          { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },

          { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },

          { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },

          { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },

          { name: 'links', items: [ 'Link', 'Unlink' ] },

          { name: 'insert', items: [ 'Image'] },

          { name: 'spell', items: [ 'jQuerySpellChecker' ] },

          { name: 'table', items: [ 'Table' ] }

      ],

      });

      CKEDITOR.replace('editor3', {

        skin: 'moono',

        enterMode: CKEDITOR.ENTER_BR,

        shiftEnterMode:CKEDITOR.ENTER_P,

        toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },

          { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },

          { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },

          { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },

          { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },

          { name: 'links', items: [ 'Link', 'Unlink' ] },

          { name: 'insert', items: [ 'Image'] },

          { name: 'spell', items: [ 'jQuerySpellChecker' ] },

          { name: 'table', items: [ 'Table' ] }

      ],

      });

      CKEDITOR.replace('editor', {

        skin: 'moono',

        enterMode: CKEDITOR.ENTER_BR,

        shiftEnterMode:CKEDITOR.ENTER_P,

        toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },

          { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },

          { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },

          { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },

          { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },

          { name: 'links', items: [ 'Link', 'Unlink' ] },

          { name: 'insert', items: [ 'Image'] },

          { name: 'spell', items: [ 'jQuerySpellChecker' ] },

          { name: 'table', items: [ 'Table' ] }

      ],

      });







});



    jQuery(document).ready(function () {

      var dateToday = new Date();    



      jQuery('.datetimepicker').datepicker({

        timepicker: true,

        language: 'en',

        range: false,

        multipleDates: false,

        multipleDatesSeparator: " - ",

        minDate: dateToday

      });

      jQuery('.EventStartDate').datepicker({
          timepicker: true,
          language: 'en',
          range: false,
          multipleDates: false,
          multipleDatesSeparator: " - ",
          minDate: new Date() // Assuming 'dateToday' is a valid date object
      });

      jQuery('.EventEndDate').datepicker({

          timepicker: true,
          language: 'en',
          range: false,
          multipleDates: false,
          multipleDatesSeparator: " - ",
          minDate: new Date() // Assuming 'dateToday' is a valid date object

      });

      



      jQuery('.addBankdatetimepicker').datepicker({

        timepicker: false,

        language: 'en',

        range: false,

        multipleDates: false,

        multipleDatesSeparator: " - ",

     

      });

      jQuery("#add-event").submit(function () {

        var values = {};

        $.each($('#add-event').serializeArray(), function (i, field) {

          values[field.name] = field.value;

        });

        console.log(

          values

        );

      });

    });



    (function () {

      'use strict';

      // ------------------------------------------------------- //

      // Calendar

      // ------------------------------------------------------ //

      jQuery(function () {

        var users = [];

        var months = [];

            <?php



              if(!empty($monthlyUsers)){

                  foreach($monthlyUsers as $monthlyUserItem){ ?>

                      months.push("<?php echo ($monthlyUserItem['month'] ?? 0); ?>")

                      users.push(<?php echo ($monthlyUserItem['users'] ?? 0); ?>)

                  <?php }

              }



            ?>

        // page is ready

        jQuery('#calendar').fullCalendar({

          themeSystem: 'bootstrap4',

          // emphasizes business hours

          businessHours: false,

          defaultView: 'month',

          // event dragging & resizing

          editable: true,

          // header

          header: {

            left: 'title',

            center: 'month,agendaWeek,agendaDay',

            right: 'today prev,next'

          },

          events: [

            <?php 

            $reminders = Helper::GetEventReminder();

            if (!empty($reminders)) {

              foreach ($reminders as $remin) { ?>

                {

                  id: '{{$remin->id}}',

                  title: '{{$remin->event_name}}',

                  description: '{{ $remin->event_description }}',

                  start: '{{$remin->event_start_date}}',

                  end: '{{$remin->event_end_date}}',

                },

            <?php

              }

            }

            ?>

          ],

          eventRender: function (event, element) {

            if (event.icon) {

              element.find(".fc-title").prepend("<i class='fa fa-" + event.icon + "'></i>");

            }

          },

          dayClick: function () {

            jQuery('#modal-view-event-add').modal();

          },

          eventClick: function (event, jsEvent, view) {

            jQuery('.event-icon').html("<i class='fa fa-" + event.icon + "'></i>");

            jQuery('#editreminder').attr('data-id',event.id);

            jQuery('.event-title').html(event.title);

            jQuery('.event-body').html(event.description);

            jQuery('.eventUrl').attr('href', event.url);

            jQuery('#modal-view-event').modal();

          },

        })

      });



    })(jQuery);





var $uploadCrop, tempFilename, rawImg, imageId;

function readFile(input) {

  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function (e) {

      $(".upload-demo").addClass("ready");

      $("#cropImagePop").modal("show");

      rawImg = e.target.result;

    };

    reader.readAsDataURL(input.files[0]);

  } else {

    swal("Sorry - you're browser doesn't support the FileReader API");

  }

}



$uploadCrop = $("#upload-demo").croppie({

  viewport: {

    width: 275,

    height: 60

  },

  enforceBoundary: false,

  enableExif: true

});



$("#cropImagePop").on("shown.bs.modal", function () {

  // alert('Shown pop');

  $uploadCrop

    .croppie("bind", {

      url: rawImg

    })

    .then(function () {

      console.log("jQuery bind complete");

    });

});



$(".item-img").on("change", function () {

  imageId = $(this).data("id");

  console.log(imageId);

  tempFilename = $(this).val();

  $("#cancelCropBtn").data("id", imageId);

  readFile(this);

});

$("#cropImageBtn").on("click", function (ev) {

  $uploadCrop

    .croppie("result", {

      type: "base64",

      format: "jpeg",

      size: { width: 500, height: 500 }

    })

    .then(function (resp) {

      $("#perview_userprofile").attr("src", resp);

      $("#cropImagePop").modal("hide");

    });

});







$('#contect').keypress(function (event) {

    if (event.keyCode == 46 || event.keyCode == 8) {

        // Allow delete and backspace

    } else if (event.keyCode >= 48 && event.keyCode <= 57 && digitCount < 13) {

        // Allow digits (0-9) and limit to 13 digits

      //  digitCount++;

    } else {

        event.preventDefault();

    }

});



$('#contect').keyup(function (event) {

    if (event.keyCode == 46 || event.keyCode == 8) {

        // Handle delete and backspace to decrement the digit count

        if (digitCount > 0) {

        // digitCount++;

        }

    }

});



$('#ticketType').on('change', function() {

  $('.appendTicket').css('display', 'none');

  $('#ticketQuantity').css('display', 'block');



  if ( $(this).val() === 'Paid' ) {

    $('#ticketQuantity').css('display', 'none');

    $('.appendTicket').css('display', 'block');

  }

});



$('#PlanType').on('change', function() {

  if ( $(this).val() === 'Paid' ) {

    $('.planoptino').css('display', 'block');

  }else{

    $('.planoptino').css('display', 'none');



  }

});

var maxAppend = 1;

$(document).ready(function() {

  



 



  $("#addmore").click(function() {

    



    var resultcount = $('#addmore').attr('data-count');

     if(resultcount >= 4){

      return false;

     }else{

      var x = parseInt(resultcount) + 1;

      $('#addmore').attr('data-count', x);

      if (maxAppend >= 4) return;

     }



  var addinput = $(`<div class="row mb-2 required_inp">

  <div class="col-lg-5">

      <div class="form-group comments_form">

        <input type="text" name="menu_name[`+ x +`]"  required class="form-control" placeholder="Enter New Add Menu">

      </div>

  </div>

  <div class="col-lg-4">

    <div class="form-group comments_form">

      <input type="text" name="url[`+ x +`]" class="form-control" required  placeholder="Enter Url">

    </div>

  </div>

  <div class="col-lg-2">

    <div class="form-group comments_form">

      <input type="text" name="order[`+ x +`]" min="6" class="form-control number" required placeholder="Order">

    </div>

  </div>

  <div class="col-lg-1 col-4 pl-3 pl-lg-0">

    <div class="close-more-btn mt-3">

      <a href="javascript:void(0)" class="inputRemove bg-red"><i class="icon-close text-white"></i></a>

    </div>

  </div>

</div>`);

  maxAppend++;



  $("#req_input").append(addinput);

  });

  

  $('body').on('click','.inputRemove',function() {

    maxAppend--;

    var resultcount = $('#addmore').attr('data-count');

    var x = parseInt(resultcount) - 1;

    $('#addmore').attr('data-count', x);

    $(this).parent('div').parent('div').parent('div').remove()

  });

});



$(function() {

  $("form[name='headerform']").validate({

    

    submitHandler: function(form) {

      form.submit();

    }

  });

});

$(function() {

  $("#add_bank").validate({

    

    submitHandler: function(form) {

      form.submit();

    }

  });

});





$(document).ready(function () {

   $("#password").keyup(validatePassword1);

});

function validatePassword1() {

    var password = $("#password").val();

    if (password.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@%!#$&~*()+])[0-9a-zA-Z@%!#$&~*()+]{8,}$/)){

      $("#divPasswordValidationResult1").html(" ");

      $('#submitdisable').removeAttr('disabled');

    }else{

      $('#submitdisable').attr('disabled','disabled');

      $("#divPasswordValidationResult1").html("It must include a mix of uppercase letters, lowercase letters, numbers, and special characters (!, @, #, $, etc.).");

    }

}



$(document).ready(function () {

   $("#newpassword").keyup(validatePassword2);

});

function validatePassword2() {

    var password = $("#password").val();

    if (password.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@%!#$&~*()+])[0-9a-zA-Z@%!#$&~*()+]{8,}$/)){

      $("#divPasswordValidationResult2").html(" ");

      $('#submitdisable').removeAttr('disabled');







    }else{

      $('#submitdisable').attr('disabled','disabled');

      $("#divPasswordValidationResult2").html("It must include a mix of uppercase letters, lowercase letters, numbers, and special characters (!, @, #, $, etc.).");

    }

}





$(function() {

  $("form[name='eventform']").validate({

    rules: {

      // Other field validations

      category_id: {

        required: true

      },

      ticket_type: {

        required: true

      },
      quantity: {

        min:1

      },

     

    },

    submitHandler: function(form) {

      form.submit();

    }

  });

});





$(function() {

  $("form[name='profileUpdate']").validate({

   

    submitHandler: function(form) {

      form.submit();

    }

  });

});



$(function() {

  $("form[name='facilityform']").validate({

   

    submitHandler: function(form) {

      form.submit();

    }

  });

});



$(function() {

  $("form[name='addPlanform']").validate({

   

    submitHandler: function(form) {

      form.submit();

    }

  });

});

$(function() {

  $("form[name='homeForme']").validate({

   

    rules: {

      "product_id[]": {

        required: true

      },

      "event_id[]": {

        required: true

      },

      "membership_id[]": {

        required: true

      },

      "facility_id[]": {

        required: true

      },

    },

    messages: {

      "product_id[]": {

        required: "Please select product",

      },

      "event_id[]": {

        required: "Please select event",

      },

      "membership_id[]": {

        required: "Please select membership",

      },

      "facility_id[]": {

        required: "Please select facility",

      },



    },

    

    submitHandler: function(form) {

      form.submit();

    },

    // submitHandler: function(form) {

    //   form.submit();

    // }

  });

});



$(function() {

  $("form[name='aboutsecation']").validate({

   

    submitHandler: function(form) {

      form.submit();

    }

  });

});


$(function() {

$("form[name='mailchimp']").validate({

 

  submitHandler: function(form) {

    form.submit();

  }

});

});




$(function() {

  $("form[name='productform']").validate({

   

    submitHandler: function(form) {

      form.submit();

    }

  });

});



$(function() {

  $.validator.addMethod("lessThan", function(value, element, param) {

    return parseFloat(value) < parseFloat($(param).val());

  }, "Discount price must be less than the original  price");



  $("form[name='addproductform']").validate({
    submitHandler: function(form) {
      form.submit();
    }

  });

});



$(function() {

  $("form[name='planform']").validate({

   

    submitHandler: function(form) {

      form.submit();

    }

  });

});

$(function() {

  $("form[name='footer_form_data']").validate({

   

    submitHandler: function(form) {

      form.submit();

    }

  });

});









$(function(){

   $(".number").keypress(function (e) {

   

     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {

   

    }

   });

});





//Footer Secation

var footerappend = 1;

$(document).ready(function() {

  

  // Own Question

  $("#own_question").click(function() {

    var own_question = $('#own_question').attr('data-count');

    if(own_question >= 10){

      return false;

     }else{

      var x = parseInt(own_question) + 1;

      $('#own_question').attr('data-count', x);

      if (footerappend >= 10) return;

     }

      var addquestion = $(`

      <div class="added_benefit add-btn-class">

        <input type="text" class="form-control" name="own_question[`+ own_question +`]"  placeholder="Enter Own Question `+ own_question +`">

        <div class="own_questionremove icon_div bg-red">

        <a href="javascript:void(0)" class=" bg-red"><i class="icon-close"></i></a>

        </div>

      </div>`);

      own_question++;

      $("#own_question_append").append(addquestion);

  });

  

  $('body').on('click','.own_questionremove',function() {

    own_question--;

    var own_question = $('#own_question').attr('data-count');

    var x = parseInt(own_question) - 1;

    $('#own_question').attr('data-count', x);

    $(this).parent('div').remove()

  });



  //and Own Question



  // Benefits

  $("#plan_benefits").click(function() {

    var plan_benefits = $('#plan_benefits').attr('data-count');

    if(plan_benefits >= 10){

      return false;

     }else{

      var x = parseInt(plan_benefits) + 1;

      $('#plan_benefits').attr('data-count', x);

      if (footerappend >= 10) return;

     }

      var addbenefits = $(`

      <div class="added_benefit add-btn-class">

        <input type="text" class="form-control" name="benefit[`+ plan_benefits +`]" required placeholder="Enter benefits `+ plan_benefits +`">

        <div class="benifetsremove icon_div bg-red">

        <a href="javascript:void(0)" class=" bg-red"><i class="icon-close"></i></a>

        </div>

      </div>`);

      plan_benefits++;

      $("#paln_append").append(addbenefits);

  });

  

  $('body').on('click','.benifetsremove',function() {

    plan_benefits--;

    var plan_benefits = $('#plan_benefits').attr('data-count');

    var x = parseInt(plan_benefits) - 1;

    $('#plan_benefits').attr('data-count', x);

    $(this).parent('div').remove()

  });



  //and benefits









 //number 

  $("#footernumber").click(function() {

    var resultcount = $('#footernumber').attr('data-count');

     if(resultcount >= 4){

      return false;

     }else{

      var x = parseInt(resultcount) + 1;

      $('#footernumber').attr('data-count', x);

      if (footerappend >= 4) return;

     }

  var addinput = $(`

  <div class="row mb-2">

    <div class="col-lg-11">

      <div class="form-group comments_form">

        <input type="text" class="form-control number" maxlength="12" name="number[`+ footerappend +`]"  placeholder="Enter Phone Number">

      </div>

    </div>

    <div class="col-lg-1 col-4 pl-3 pl-lg-0">

      <div class="close-more-btn mt-3">

        <a href="javascript:void(0)" class="footerinputRemoveNu bg-red"><i class="icon-close text-white"></i></a>

      </div>

    </div>

  </div>`);

  footerappend++;



  $("#req_input_footer").append(addinput);

  });

  

  $('body').on('click','.footerinputRemoveNu',function() {

    footerappend--;

    var resultcount = $('#footernumber').attr('data-count');

    var x = parseInt(resultcount) - 1;

    $('#footernumber').attr('data-count', x);

    $(this).parent('div').parent('div').parent('div').remove()

  });



    



  //Email

  var  footeremail = 1;

  

  

  $("#footeremail").click(function() {

     var resultcount = $('#footeremail').attr('data-count');

     if(resultcount >= 4){

      return false;

     }else{

      var x = parseInt(resultcount) + 1;

      $('#footeremail').attr('data-count', x);

      if (footeremail >= 4) return;

     }

    



  var addinput = $(`

  <div class="row mb-2">

    <div class="col-lg-11">

      <div class="form-group comments_form">

        <input type="email" class="form-control" name="email[`+ footeremail +`]"  placeholder="Enter Email">

      </div>

    </div>

    <div class="col-lg-1 col-4 pl-3 pl-lg-0">

      <div class="close-more-btn mt-3">

        <a href="javascript:void(0)" class="footerinputRemove bg-red"><i class="icon-close text-white"></i></a>

      </div>

    </div>

  </div>`);

  footeremail++;



  $("#req_input_email").append(addinput);

  });

  

  $('body').on('click','.footerinputRemove',function() {

   

    footeremail--;

    var resultcount = $('#footeremail').attr('data-count');

    var x = parseInt(resultcount) - 1;

    $('#footeremail').attr('data-count', x);

    $(this).parent('div').parent('div').parent('div').remove()

  });



  //Seaction 1st

  footereseaction1 = 1;

  $("#footersecation1").click(function() {

    if (footereseaction1 >= 20) return;



  var addinput = $(`

  <div class="row mb-2">

  <div class="col-lg-5">

      <div class="form-group comments_form">

        <input type="text" class="form-control" name="sec_menu[`+ footereseaction1 +`]"  placeholder="Enter Menu">

      </div>

    </div>

    <div class="col-lg-4">

      <div class="form-group comments_form">

        <input type="text" class="form-control" name="sec_url[`+ footereseaction1 +`]"  placeholder="Enter Url">

      </div>

    </div>

    <div class="col-lg-2">

      <div class="form-group comments_form">

        <input type="text" class="form-control number" name="sec_order[`+ footereseaction1 +`]"  placeholder="Order">

      </div>

    </div>

    <div class="col-lg-1 col-4 pl-3 pl-lg-0">

      <div class="close-more-btn mt-3">

        <a href="javascript:void(0)" class="footerSec1Remove bg-red"><i class="icon-close text-white"></i></a>

      </div>

    </div>

  </div>`);

  footereseaction1++;



  $("#req_input_secation_1").append(addinput);

  });

  

  $('body').on('click','.footerSec1Remove',function() {

    footereseaction1--;

    $(this).parent('div').parent('div').parent('div').remove()

  });



  //Seaction 2st

  footereseaction2 = 1;

  $("#footersecation2").click(function() {

    if (footereseaction2 >= 20) return;



  var addinput = $(`

  <div class="row mb-2">

  <div class="col-lg-5">

      <div class="form-group comments_form">

        <input type="text" class="form-control" name="sec_menu_2[`+ footereseaction2 +`]"   placeholder="Enter Menu">

      </div>

    </div>

    <div class="col-lg-4">

      <div class="form-group comments_form">

        <input type="text" class="form-control" name="sec_url_2[`+ footereseaction2 +`]"  placeholder="Enter Url">

      </div>

    </div>

    <div class="col-lg-2">

      <div class="form-group comments_form">

        <input type="text" class="form-control number" name="sec_order_2[`+ footereseaction2 +`]"  placeholder="Order">

      </div>

    </div>

    <div class="col-lg-1 col-4 pl-3 pl-lg-0">

      <div class="close-more-btn mt-3">

        <a href="javascript:void(0)" class="footerSec2Remove bg-red"><i class="icon-close text-white"></i></a>

      </div>

    </div>

  </div>`);

  footereseaction2++;



  $("#req_input_secation_2").append(addinput);

  });

  

  $('body').on('click','.footerSec2Remove',function() {

    footereseaction2--;

    $(this).parent('div').parent('div').parent('div').remove();

    

  });

});



function RemoveAddress(id,type){

  $.ajax({

    url: " {{route('footer_remove')}}",

    type : "POST",

    data: {

      "_token": "{{ csrf_token() }}",

      "id": id,

      "type":type

    },

    success: function(data) {

     console.log(data);

    }

  });

}

function password_show_hide() {

  var x = document.getElementById("password");

  var show_eye = document.getElementById("show_eye");

  var hide_eye = document.getElementById("hide_eye");

  hide_eye.classList.remove("d-none");

  if (x.type === "password") {

    x.type = "text";

    show_eye.style.display = "none";

    hide_eye.style.display = "block";

  } else {

    x.type = "password";

    show_eye.style.display = "block";

    hide_eye.style.display = "none";

  }

}



function DeleteProduct(id){

  $('#product_id').val('');

  $('#product_id').val(id);

}



function FilterData(){

  document.getElementById("filter").submit();

}



function DeleteAccount(id){

  $('#account_id').val('');

  $('#account_id').val(id);

}



function DeletePlan(id){

  $('#plan_id').val('');

  $('#plan_id').val(id);

}

function Terminate(id){

$('#order_id').val('');
$('#status').val('');

$('#order_id').val(id);
$('#status').val('0');


}

function Restore(id){

$('#order_id').val('');
$('#status').val('');

$('#order_id').val(id);
$('#status').val('1');

}

function DeleteEvent(id){

  $('#event_id').val('');

  $('#event_id').val(id);

}



function DeleteFacility(id){

  $('#facility_id').val('');

  $('#facility_id').val(id);

}

function con_password_show_hide() {

  var x = document.getElementById("newpassword");

  var show_eye = document.getElementById("con_show_eye");

  var hide_eye = document.getElementById("con_hide_eye");

  hide_eye.classList.remove("d-none");

  if (x.type === "password") {

    x.type = "text";

    show_eye.style.display = "none";

    hide_eye.style.display = "block";

  } else {

    x.type = "password";

    show_eye.style.display = "block";

    hide_eye.style.display = "none";

  }

}



//start event append data

//Footer Secation

var eventAppend = 1;

$(document).ready(function() {

  

 //number 

  $("#eventAppend").click(function() {
    var eventcount = $('#eventAppend').attr('data-count');

    if(eventcount >= 100){

    return false;

    }else{

    var x = parseInt(eventcount) + 1;

    $('#eventAppend').attr('data-count', x);

    if (eventcount >= 100) return;

    }


  var addinput = $(`

  <div class="row">

    <div class="col-lg-4">

      <div class="form-group comments_form">

          <label class="form-label">Ticket Name</label>
          <input type="hidden" class="form-control" name="ticket_id[`+ eventcount +`]" value="">

          <input type="text" class="form-control" name="ticket_name[`+ eventcount +`]" required placeholder="Ticket Name">

      </div>

    </div>

    <div class="col-lg-3">

      <div class="form-group comments_form">

          <label class="form-label">Ticket Cost</label>

          <input type="number" min="1" class="form-control number priceAmount`+ eventcount +`" name="ticket_cost[`+ eventcount +`]" onkeyup="changequantityEvent(`+ eventcount +`)" required placeholder="Price">
          
      </div>

    </div>

    
    <div class="col-lg-3">

      <div class="form-group comments_form">

          <label class="form-label">Quantity</label>

          <input type="number" min="1" class="form-control number" name="ticket_quantity[`+ eventcount +`]" required placeholder="Quantity">

      </div>

    </div>

    <div class="col-lg-1 col-4 pl-3 pl-lg-0">

      <div class="add-more-btn">

        <a href="javascript:void(0)" class="eventRemove bg-red" style="background:red !important;">

          <i class="icon-close text-white"></i>

        </a>

      </div>

      

    </div>

  </div>`);

  eventcount++;



  $(".appendTicket").append(addinput);

  });

  

  $('body').on('click','.eventRemove',function() {

    eventcount--;
    var eventcount = $('#eventAppend').attr('data-count');

    var xy = parseInt(eventcount) - 1;

    $('#eventAppend').attr('data-count', xy);
    $(this).parent('div').parent('div').parent('div').remove()
    var idsss = $(this).attr('data-id');
      $.ajax({

          url: " {{route('event_ticket_remove')}}",

          type : "POST",

          data: {
            "_token": "{{ csrf_token() }}",
            "id": idsss,
          },

          success: function(data) {

          console.log(data);

          }
      });
  });

  });
  





//end event append data



function ProductDiv(select){

   if(select.value==1){

    document.getElementById('customeProduct').style.display = "block";

   } else{

    document.getElementById('customeProduct').style.display = "none";

   }

} 

function EventDiv(select){

   if(select.value==1){

    document.getElementById('customeEvent').style.display = "block";

   } else{

    document.getElementById('customeEvent').style.display = "none";

   }

} 

function FacilityDiv(select){

   if(select.value==1){

    document.getElementById('customeficility').style.display = "block";

   } else{

    document.getElementById('customeficility').style.display = "none";

   }

} 



function MembershipDiv(select){

   if(select.value==1){

    document.getElementById('customemembership').style.display = "block";

   } else{

    document.getElementById('customemembership').style.display = "none";

   }

} 



function ImageyDiv(select){

   if(select.value==1){

    document.getElementById('imageSecation').style.display = "block";

    document.getElementById('imageside').style.display = "block";

   } else{

    document.getElementById('imageSecation').style.display = "none";

    document.getElementById('imageside').style.display = "none";

   }

} 



$('#startdatetimepicker').datetimepicker({

      uiLibrary: 'bootstrap4',

      modal: false,

      footer: true,

      

      

  });

  $('#enddatetimepicker').datetimepicker({

      uiLibrary: 'bootstrap4',

      modal: false,

      footer: true

  });



    $('#starttimepicker').timepicker({

      uiLibrary: 'bootstrap4',

      modal: false,

      footer: true

    });

    $('#endtimepicker').timepicker({

      uiLibrary: 'bootstrap4',

      modal: false,

      footer: true

    });



  







$(document).ready(function() {



  $('#cb-about').on('change', function() {

    var status = $(this).prop('checked') == true ? 1 : 0;

    if(status == '1'){

      $('.checkimage').prop('required',true);

    }else{

      $('.checkimage').prop('required',false);

    }

    

  });



  $('.aboutSecationImage').on('change', function() {

    var status = $(this).prop('checked') == true ? 1 : 0;

    if(status == '1'){

      $('#formFile1').prop('required',true);

    }else{

      $('#formFile1').prop('required',false);

    }

    

  });



  

  $('.aboutsecationOur').on('change', function() {

    var status = $(this).prop('checked') == true ? 1 : 0;

    if(status == '1'){

      $('.ourTitle').prop('required',true);

    }else{

      $('.ourTitle').prop('required',false);

    }

    

  });



  $('.aboutVision').on('change', function() {

    var status = $(this).prop('checked') == true ? 1 : 0;

    if(status == '1'){

      $('.VisionTitle').prop('required',true);

    }else{

      $('.VisionTitle').prop('required',false);

    }

    

  });

  $('.AboutMission').on('change', function() {

    var status = $(this).prop('checked') == true ? 1 : 0;

    if(status == '1'){

      $('.missionTilte').prop('required',true);

    }else{

      $('.missionTilte').prop('required',false);

    }

    

  });

  



  

  $('#color').tagsinput({

  });

  $('#size').tagsinput({

  });



  

});

$(document).ready(function() {

  

$('.minus').click(function () {		

  var th = $(this).closest('.quantity_value').find('.count');    	

  th.val(+th.val() + 1);

});

$('.plush').click(function () {

  var th = $(this).closest('.quantity_value').find('.count');    	

    	if (th.val() > 1) th.val(+th.val() - 1);

});



});

$(document).ready(function() {
              var sum = 0;
              $('.totalAmountList').each(function(){
                  sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
              });
//  console.log(sum);
              $(".totalamount").html("$"+sum.toFixed(2));
              var paltformfee = ((3.75 / 100) * sum) + 0.50;
              $(".platformefee").html("$"+paltformfee.toFixed(2));
              var totalIncAmount = parseFloat(sum + paltformfee);
              $(".totalIncAmount").html("$"+totalIncAmount.toFixed(2));



            });

            $('.notificationClick').click(function(){
                $(".jb_preloader").removeClass("loaded");

                id = $(this).data('id');
                route = $(this).data('url');
                $.ajax({
                  url: "{{route('single_notification')}}",
                  data:{
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                    },
                  method: "POST",
                  dataType: "json",
                  success: function(data) {
                    window.location.href = route;     
                    
                }
              });
            });

            $(document).ready(function() {
                $('.orderdata').on("change", function(e) {
                    const vals = $('.orderdata').not(this).map(function() { return this.value; }).get();
                    const that = this;

                    if (vals.indexOf(this.value) !== -1) {
                        that.value = "";
                        // You can display an error message using another element, for example:
                          alert("This number already exists");
                        setTimeout(function() {
                            $(that).focus();
                        }, 100);
                    }
                });
            });

            $(document).ready(function() {
              $(function() {
                $(".number").keypress(function (e) {
                  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    e.preventDefault(); // This prevents the default action for non-numeric keys
                  }
                });
              });
            });

    function changequantity(){
        var input = parseFloat($(".priceAmount").val()); // Convert input to float

        percentage = ((3.75 / 100) * input) + 0.50;

        console.log(percentage);
        console.log(input);

      ///  finalamount = parseFloat(percentage) + input; // Parse percentage as float
        amount = parseFloat(percentage) + input; // Parse percentage as float
        finalamount = parseFloat(amount).toFixed(2); // Parse percentage as float
        $(".finalamount").val(finalamount);
    }

    $(document).ready(function(){
    // Function to check discount
    function checkDiscount() {
        // Get the value entered in the input field
        var discountValue = parseInt($("#discountInput").val());
        var submitButton = $(".discountsubmit");
        // Check if discountValue is within the range 1-100
        if(discountValue >= 0 && discountValue < 100) {
            console.log("Discount value is valid: " + discountValue);
            $('.Discount').hide();
            submitButton.prop('disabled', false);

        } else {
          if(discountValue >= 1){
            $('.Discount').show();
             submitButton.prop('disabled', true);
            return false;
          }
          //  console.log("Discount value is not valid. Please enter a value between 1 and 99.");
        }
    }

    // Call the checkDiscount function when the input field changes
    $("#discountInput").on("input", function() {
        checkDiscount();
    });
    $(".discountsubmit").click(function(event) {
        if ($(this).is(":disabled")) {
            event.preventDefault();
            console.log("Please enter a valid discount value before publishing the plan.");
        }
    });
});

function changequantityEvent(id){
    var input = parseFloat($(".priceAmount"+id).val()); // Convert input to float
// alert('sd');  
    percentage = ((3.75 / 100) * input) + 0.50;

    console.log(percentage);
    console.log(input);

    amount = parseFloat(percentage) + input; // Parse percentage as float
    finalamount = parseFloat(amount).toFixed(2); // Parse percentage as float
   // alert(finalamount);
    $(".finalamount"+id).val(finalamount);
}


    

    function changediscount(){
        var input = parseFloat($(".discountamount").val()); // Convert input to float

        percentage = ((3.75 / 100) * input) + 0.50;

        console.log(percentage);
        console.log(input);

        //finalamount = parseFloat(percentage) + input; // Parse percentage as float
        amount = parseFloat(percentage) + input; // Parse percentage as float
        finalamount = parseFloat(amount).toFixed(2); // Parse percentage as float
        $(".finaldiscountamount").val(finalamount);
    }

  

    function RemoveVariation(id){
       var variationId = id;
       $.ajax({
        url: "{{route('remove_variation')}}",
        type: "POST",
        data:{
          "_token": "{{ csrf_token() }}",
          "id" : id ,
        },
        dataType: "json",
        success: function( response ) {
          $("#myDiv").load(location.href+" #myDiv>*","");
        }
      });
    }

    
  
  </script>

</body>

</html>



