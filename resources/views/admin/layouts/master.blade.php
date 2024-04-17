<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Clubland Services</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Clubland Service" name="description" />
    <meta content="Clubland Service" name="author" />
    <link rel="shortcut icon" type="image/png" href="{{asset('/web/images/customcolor_logo.png')}}" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- third party css -->
    <link href="{{asset('assets/css/vendor/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/vendor/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/vendor/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/vendor/select.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/sweet-alert/sweetalert.min.css') }}" rel="stylesheet" />
    <!-- third party css end -->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{asset('assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
  </head>
  <style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      padding: 0 !important;
    }
    .preloader {
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    background-color: #f4f6f9;
    height: 100vh;
    width: 100%;
    transition: height .2s linear;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 9999;
}
.animation__shake {
    -webkit-animation: shake 1.5s;
    animation: shake 1.5s;
}
    </style>
  <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper"> 
    <div id="preloader" class="preloader flex-column justify-content-center align-items-center" >
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden"></span>
        </div>
    </div>
      @include('admin.layouts.partials.sidemenu') 
      <div class="content-page">
        <div class="content">
           <!-- @if (\Session::has('message')) 
              <div class="alert alert-success">
               {!! \Session::get('message') !!} 
              </div> @endif @if (\Session::has('error')) 
              <div class="alert alert-danger"> 
                {!! \Session::get('error') !!} 
              </div>
          @endif  -->
          @include('admin.layouts.partials.header') @yield('content') 
        </div>
        @include('admin.layouts.partials.footer') 
        @yield('script') 
        @include('admin.layouts.sweet_alerts')
      </div>
    </div>
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <!-- third party js -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/js/vendor/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('assets/js/vendor/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/dataTables.select.min.js')}}"></script>
    <!-- third party js ends -->
    <script src="{{asset('assets/js/ui/component.todo.js')}}"></script>
    <!-- demo app -->
    <script src="{{asset('assets/js/pages/demo.datatable-init.js')}}"></script>
    <script src="{{ asset('assets/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- end demo js-->
    <script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        document.addEventListener("DOMContentLoaded", function () {
        // Hide the preloader when the page is fully loaded
        document.getElementById("preloader").style.display = "none";
    }); 
        $('#service_datas').DataTable({
        });

        $('#itemcat_datas').DataTable({
        });
        $('#Event').DataTable({
          columnDefs: [{
            orderable: false,
            targets: 0
          }],
          order: [
            [1, 'asc']
          ]
        });
        
        $('#color').DataTable({
          order: [
            [1, 'desc']
          ]
        });
        $('#cmsList').DataTable({
          columnDefs: [{
            orderable: false,
            targets: 0
          }],
          order: [
            [1, 'desc']
          ]
        });
        $('#user_datas').DataTable({
          columnDefs: [{
            orderable: false,
            targets: 0
          }],
          order: [
            [1, 'desc']
          ]
        });
        $('#cms').DataTable({
          columnDefs: [{
            orderable: false,
            targets: 0
          }],
          order: [
            [1, 'asc']
          ]
        });
        $('#faq').DataTable({
          columnDefs: [{
            orderable: false,
            targets: 0
          }],
          order: [
            [1, 'asc']
          ]
        });
        $('#inquerdata').DataTable({
          columnDefs: [{
            orderable: false,
            targets: 0
          }],
          order: [
            [1, 'asc']
          ]
        });
      });
      function EventChange(event_id) {
        var status = $(this).prop('checked') == true ? 1 : 0;
        $.ajax({
          url: "{{route('event_category_status')}}",
          type : "POST",
          data: {
            "_token": "{{ csrf_token() }}",
            "event_id": event_id,
            "status": status
          },
          success: function(data) {
            swal("Updated!", " Status changed successfully.", "success");
          // /  window.location.reload();
          }
        });
      }

      function ClubTypeChange(id) {
        var status = $(this).prop('checked') == true ? 1 : 0;
        $.ajax({
          url: "{{route('clubtype_status')}}",
          type : "POST",
          data: {
            "_token": "{{ csrf_token() }}",
            "id": id,
            "status": status
          },
          success: function(data) {
            swal("Updated!", " Status changed successfully.", "success");
          // /  window.location.reload();
          }
        });
      }

      function UserTypeChange(id) {
        var status = $(this).prop('checked') == true ? 1 : 0;
        $.ajax({
          url: "{{route('business_status')}}",
          type : "POST",
          data: {
            "_token": "{{ csrf_token() }}",
            "id": id,
            "status": status
          },
          success: function(data) {
            swal("Updated!", " Status changed successfully.", "success");
          // /  window.location.reload();
          }
        });
      }

      function ClubTypeConfirm(id) {
        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this data!.",
          type: "error",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: "Delete"
        }, function(isConfirm) {
          if (isConfirm) {
            $.ajax({
              url: " {{route('clubtype_delete')}}",
              type : "POST",
              data: {
                "_token": "{{ csrf_token() }}",
                "id": id
              },
              success: function(data) {
                swal("Deleted!", "Club Type deleted successfully.", "success");
                window.location.reload();
              }
            });
          } else {
            swal("Cancelled", "Your data is safe", "error");
          }
        });
      }

      function EventConfirm(id) {
        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this data!.",
          type: "error",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: "Delete"
        }, function(isConfirm) {
          if (isConfirm) {
            $.ajax({
              url: " {{route('event_category_delete')}}",
              type : "POST",
              data: {
                "_token": "{{ csrf_token() }}",
                "id": id
              },
              success: function(data) {
                swal("Deleted!", "Event data deleted successfully.", "success");
                window.location.reload();
              }
            });
          } else {
            swal("Cancelled", "Your data is safe", "error");
          }
        });
      }

      

      

      function confirm(id) {
        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this data!.",
          type: "error",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: "Delete"
        }, function(isConfirm) {
          if (isConfirm) {
            $.ajax({
              url: " {{route('business_delete')}}",
              type : "POST",
              data: {
                "_token": "{{ csrf_token() }}",
                "user_id": id
              },
              success: function(data) {
                swal("Deleted!", "User data deleted successfully.", "success");
                window.location.reload();
              }
            });
          } else {
            swal("Cancelled", "Your data is safe", "error");
          }
        });
      }
      function faqconfirm(id) {
        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this data!.",
          type: "error",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: "Delete"
        }, function(isConfirm) {
          if (isConfirm) {
            $.ajax({
              url: " {{route('faq_delete')}}",
              type : "POST",
              data: {
                "_token": "{{ csrf_token() }}",
                "id": id
              },
              success: function(data) {
                swal("Deleted!", "Faq deleted successfully.", "success");
                window.location.reload();
              }
            });
          } else {
            swal("Cancelled", "Your data is safe", "error");
          }
        });
      }
      
      function confirmInquery(id) {
        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this data!.",
          type: "error",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: "Delete"
        }, function(isConfirm) {
          if (isConfirm) {
            $.ajax({
              url: " {{route('inquiry_delete')}}",
              type : "POST",
              data: {
                "_token": "{{ csrf_token() }}",
                "id": id
              },
              success: function(data) {
                swal("Deleted!", "Inquiry deleted successfully.", "success");
                window.location.reload();
              }
            });
          } else {
            swal("Cancelled", "Your data is safe", "error");
          }
        });
      }

      function confirmContactUs(id) {
        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this data!.",
          type: "error",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: "Delete"
        }, function(isConfirm) {
          if (isConfirm) {
            $.ajax({
              url: " {{route('contact_us_delete')}}",
              type : "POST",
              data: {
                "_token": "{{ csrf_token() }}",
                "id": id
              },
              success: function(data) {
                swal("Deleted!", "Contact Us deleted successfully.", "success");
                window.location.reload();
              }
            });
          } else {
            swal("Cancelled", "Your data is safe", "error");
          }
        });
      }

     
      const chooseFile = document.getElementById("choose-file");
      const imgPreview = document.getElementById("img-preview");
      if (imgPreview || chooseFile) {
        chooseFile.addEventListener("change", function() {
          getImgData();
        });
      }

      function getImgData() {
        const files = chooseFile.files[0];
        if (files) {
          const fileReader = new FileReader();
          fileReader.readAsDataURL(files);
          fileReader.addEventListener("load", function() {
            imgPreview.style.display = "block";
            imgPreview.innerHTML = ' < img src = "' + this.result + '" / > ';
          });
        }
      }

      
    </script>
    <script>
$(document).ready(function() {

//  CKEDITOR.replace( 'editor' );
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

  $(function() {
      $("input[name='phone_number']").on('input', function(e) {
          $(this).val($(this).val().replace(/[^0-9]/g, ''));
      });
  });
</script>
  </body>
</html>