<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ str_replace('_',' ',env('TITULO_APP')) }} :: PANEL DE CONTROL</title>
    <link rel="apple-touch-icon" href="{{ asset('/') }}images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/plugins/extensions/ext-component-toastr.css">


    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/themes/semi-dark-layout.css">
    <link href="{{ asset('js/dropify/dist/css/dropify.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/pickers/flatpickr/flatpickr.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/pickers/flatpickr/flatpickr.min.css">

    <link href="{{ asset('vendors/summernote/dist/summernote.css') }}" rel="stylesheet" />



    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/plugins/forms/pickers/form-pickadate.css">



    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/pages/app-invoice-list.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/pages/app-user.css">
    <!-- END: Page CSS-->


</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">


    <!-- BEGIN: Content-->
    <div class="app-content content " style="margin-left:0px; padding-top:50px;">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper p-0">
        <div class="content-header row">
          @include('layouts.breadcrumbs')
        </div>
        <div class="content-body" style="margin-left:10%; margin-right:10%">
          @yield('content')
        </div>
      </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    <div class="modal fade text-start" id="modalLoader" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            <div class="demo-inline-spacing">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden"></span>
                </div>
                <h3>PROCESANDO INFORMACION...</h3>
              </div>
          </div>
        </div>
      </div>
    </div>


    <!-- BEGIN: Footer-->
    @include('layouts.footer')

    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('/') }}vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS
      <script src="{{ asset('/') }}vendors/js/charts/apexcharts.min.js"></script>
      <script src="{{ asset('/') }}vendors/js/extensions/toastr.min.js"></script>
    -->
    <script src="{{ asset('js//dropify/dist/js/dropify.js') }}"></script>
    <script src="{{ asset('/') }}vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ asset('/') }}vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="{{ asset('/') }}vendors/js/extensions/polyfill.min.js"></script>

    <script src="{{ asset('/') }}vendors/js/extensions/toastr.min.js"></script>

    <!-- END: Page Vendor JS-->



    <script src="{{ asset('/') }}vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ asset('/') }}vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{ asset('/') }}vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{ asset('/') }}vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{ asset('/') }}vendors/js/pickers/flatpickr/flatpickr.min.js"></script>

    <script src="{{ asset('vendors//summernote/dist/summernote.min.js') }}"></script>


    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('/') }}js/scripts/forms/pickers/form-pickers.js"></script>
    <script src="{{ asset('/') }}js/core/app-menu.js"></script>
    <script src="{{ asset('/') }}js/core/app.js"></script>
    <!-- END: Theme JS-->

    <script src="{{ asset('/') }}vendors/js/forms/cleave/cleave.min.js"></script>
    <script src="{{ asset('/') }}vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>


    <!--Fontawesome js -->
    <script src="https://kit.fontawesome.com/992bac1782.js" crossorigin="anonymous"></script>

    <!-- BEGIN: Page JS
    <script src="{{ asset('/') }}js/scripts/pages/dashboard-ecommerce.js"></script>
    END: Page JS-->
    <style>
      .card-header { border-bottom:1px solid #E8E2E2; margin-bottom:20px; }
    </style>
    <script>

      $('.dropify').dropify();

      $(window).on('load', function() {
          if (feather) {
              feather.replace({
                  width: 14,
                  height: 14
              });
          }
      })

      function procesando() {

        var myModal = new bootstrap.Modal(document.getElementById('modalLoader'), { backdrop: 'static',keyboard: false })

        myModal.show();

      }

      $('.delete').on('click',function(){

        var url = $(this).attr('data-url');

        if(url != "") {

          Swal.fire({
            title: '¿Esta seguro ?',
            text: "¿Realmente desea realizar esta operación?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si',
            customClass: {
              confirmButton: 'btn btn-primary',
              cancelButton: 'btn btn-outline-danger ms-1'
            },
            buttonsStyling: false
          }).then(function (result) {
            if (result.value) {
              location =  url;
            }
          });

        }

      });

      <?php if(Session::has('message')) { ?>
        <?php if(Session::has('exito')) { ?>

          Swal.fire({
            title: ' EXITO !',
            text: "{{ Session::get('message') }}",
            icon: 'success',
            customClass: {
              confirmButton: 'btn btn-success'
            },
            buttonsStyling: false
          });

        <?php } else if(Session::has('fracaso')) { ?>

          Swal.fire({
            title: ' ¡ ATENCION !',
            text: "{{ Session::get('message') }}",
            icon: 'warning',
            customClass: {
              confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
          });


        <?php } ?>

      <?php } ?>

    </script>

    @yield('scripts')

</body>
<!-- END: Body-->

</html>
