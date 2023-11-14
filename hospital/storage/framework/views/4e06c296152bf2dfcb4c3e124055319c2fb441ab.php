<!DOCTYPE html>
<html lang="en">
<?php
$fotografia = asset("uploads/medico.png");

$user = \App\admin\Users::find(Auth::user()->id);

if($user->medico_id != 0) {

  if($user->medico->fotografia) {

    $fotografia =  asset('uploads/medicos/' . $user->medico->fotografia);

  }

}
 else  if($user->paciente_id != 0) {

  if(Auth::user()->paciente->fotografia) {

    $fotografia = asset('uploads/pacientes/' . $user->paciente->fotografia);

  }

} else if($user->enfermera_id != 0) {

  if($user->enfermera->fotografia) {

    $fotografia = asset('uploads/enfermeras/' . $user->enfermera->fotografia);

  }

}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('themes/plugins/images/favicon.png')); ?>">
    <title>Control Hospitalario</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo e(asset('themes/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo e(asset('themes/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')); ?>" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo e(asset('themes/plugins/bower_components/morrisjs/morris.css')); ?>" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo e(asset('themes/css/animate.css')); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('themes/css/style.css')); ?>" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo e(asset('themes/css/colors/blue-dark.css')); ?>" id="theme" rel="stylesheet">
    <!-- chosen CSS -->
    <link href="<?php echo e(asset('themes/plugins/chosen/chosen.min.css')); ?>" rel="stylesheet">
    <!-- datepicker CSS -->
    <link href="<?php echo e(asset('themes/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('themes/plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>" rel="stylesheet" />
    <!-- timepicker CSS -->
    <link href="<?php echo e(asset('themes/plugins/bower_components/timepicker/bootstrap-timepicker.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- clockpicker -->
    <link href="<?php echo e(asset('themes/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css')); ?>"  rel="stylesheet" type="text/css" />
    <!-- Dropify CSS -->
    <link href="<?php echo e(asset('themes/plugins//bower_components/dropify/dist/css/dropify.css')); ?>" rel="stylesheet">
    <!-- font-awesome.min CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- sweetalert CSS -->
    <link href="<?php echo e(asset('themes/plugins/bower_components/sweetalert/sweetalert.css')); ?>" rel="stylesheet">
    <!-- summernotes CSS -->
    <link href="<?php echo e(asset('themes/plugins/bower_components/summernote/dist/summernote.css')); ?>" rel="stylesheet" />
    <!-- Calendar CSS -->
    <link href="<?php echo e(asset('themes/plugins/bower_components/calendar/dist/fullcalendar.css')); ?>" rel="stylesheet" />

    <!-- picker CSS -->
    <link href="<?php echo e(asset('themes/plugins/bower_components/pickadate/themes/classic.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('themes/plugins/bower_components/pickadate/themes/classic.date.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('themes/plugins/bower_components/pickadate/themes/classic.time.css')); ?>" rel="stylesheet">

    <!-- Custom select select2-->
    <link href="<?php echo e(asset('themes/plugins/bower_components/custom-select/custom-select.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="top-left-part">
                  <a class="logo" href="<?php echo e(url('/')); ?>">
                    <b>

                      <?php $empresa = \App\admin\Empresas::find(1); ?>
                      <img src="<?php if($empresa->logotipo != "") { echo asset('uploads/empresa/' . $empresa->logotipo); } else { echo asset('themes/plugins/images/logo.png'); }?>" width="80%" height="80%" alt="home" class="light-logo" />

                    </b>
                  </a>
                </div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                  <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                  <li class="dropdown">
                      <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                        <img src="<?php echo e($fotografia); ?>" alt="user-img" width="36" class="img-circle">
                        <b class="hidden-xs"><?php echo e(Auth::user()->name); ?></b>
                      </a>
                      <ul class="dropdown-menu dropdown-user animated flipInY">
                          <li><a href="<?php echo e(url('admin/users/perfil')); ?>"><i class="ti-user"></i>  Mi Perfil</a></li>
                          <li><a href="<?php echo e(url('logout')); ?>"><i class="fa fa-power-off"></i>  Cerrar Sesion</a></li>
                      </ul>
                      <!-- /.dropdown-user -->
                  </li>
                  <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                  <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">

                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
                            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li class="user-pro">
                        <a href="#" class="waves-effect">
                          <img src="<?php echo e($fotografia); ?>" alt="user-img" class="img-circle">
                          <span class="hide-menu"><?php echo e(Auth::user()->name); ?><span class="fa arrow"></span></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo e(url('admin/users/perfil')); ?>"><i class="ti-user"></i> Mi Perfil</a></li>
                            <li><a href="<?php echo e(url('logout')); ?>"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>

                    <li> <a href="<?php echo e(url('/')); ?>" class="waves-effect"><i class="fa fa-dashboard fa-lg"></i> <span class="hide-menu">Escritorio</span></a></li>

                    <li class="nav-small-cap m-t-10">----- MENU DE SISTEMA </li>

                    <?php
                      $roles = new \App\admin\Roles;
                      echo $roles->imprimeMenu(Auth::user()->rol);
                    ?>

                </ul>

                <ul class="nav" id="side-menu">

                  <li class="nav-small-cap m-t-10">----- OTROS </li>

                  <li> <a href="<?php echo e(url('/logout')); ?>" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Cerrar sesión</span></a></li>
                </ul>

            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
          <div class="container-fluid">

              <?php echo $__env->yieldContent('content'); ?>

          </div>
          <!-- /.container-fluid -->
          <footer class="footer text-center"> <?php echo e(date('Y')); ?> &copy; Todos los derechos reservados </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

<!-- jQuery -->
<script src="<?php echo e(asset('themes/plugins/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo e(asset('themes/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?php echo e(asset('themes/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')); ?>"></script>
<!--slimscroll JavaScript -->
<script src="<?php echo e(asset('themes/js/jquery.slimscroll.js')); ?>"></script>
<!-- Chosen JavaScript -->
<script src="<?php echo e(asset('themes/plugins/chosen/chosen.jquery.min.js')); ?>"></script>
<!--Wave Effects -->
<script src="<?php echo e(asset('themes/js/waves.js')); ?>"></script>

<!-- Sparkline chart JavaScript -->
<script src="<?php echo e(asset('themes/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js')); ?>"></script>
<!-- jQuery peity -->
<script src="<?php echo e(asset('themes/plugins/bower_components/peity/jquery.peity.min.js')); ?>"></script>
<script src="<?php echo e(asset('themes/plugins/bower_components/peity/jquery.peity.init.js')); ?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo e(asset('themes/js/custom.min.js')); ?>"></script>

<!--Morris JavaScript -->
<script src="<?php echo e(asset('themes/plugins/bower_components/raphael/raphael-min.js')); ?>"></script>
<script src="<?php echo e(asset('themes/plugins/bower_components/morrisjs/morris.js')); ?>"></script>


<!--Style Switcher -->
<script src="<?php echo e(asset('themes/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')); ?>"></script>
<!-- datepicker JavaScript -->
<script src="<?php echo e(asset('themes/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<!-- timepicker JavaScript -->
<script src="<?php echo e(asset('themes/plugins/bower_components/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
<!-- Dropify JS -->
<script src="<?php echo e(asset('themes/plugins//bower_components/dropify/dist/js/dropify.min.js')); ?>"></script>

<!-- jquery-clockpicker -->
<script src="<?php echo e(asset('themes/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js')); ?>"></script>
<!-- sweetalert JavaScript -->
<script src="<?php echo e(asset('themes/plugins/bower_components/sweetalert/sweetalert.min.js')); ?>" ></script>
<script src="<?php echo e(asset('themes/plugins/bower_components/summernote/dist/summernote.min.js')); ?>"></script>
<!-- FULL CALENDAR MOMENT-->
<script src="<?php echo e(asset('themes/plugins/bower_components/moment/moment.js')); ?>"></script>
<!-- FULL CALENDAR-->
<script src="<?php echo e(asset('themes/plugins/bower_components/calendar/dist/fullcalendar.min.js')); ?>"></script>
<script src="<?php echo e(asset('themes/plugins/bower_components/calendar/dist/jquery.fullcalendar.js')); ?>"></script>

<!-- picker JS -->
<script src="<?php echo e(asset('themes/plugins/bower_components/pickadate/picker.js')); ?>"></script>
<script src="<?php echo e(asset('themes/plugins/bower_components/pickadate/picker.date.js')); ?>"></script>
<script src="<?php echo e(asset('themes/plugins/bower_components/pickadate/picker.time.js')); ?>"></script>

<!-- custom-select select2-->
<script src="<?php echo e(asset('themes/plugins/bower_components/custom-select/custom-select.min.js')); ?>" type="text/javascript"></script>

<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.js"/></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.js"/></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script src="<?php echo e(asset('js/config_datatable.js')); ?>"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script type="text/javascript">
   $(document).ready(function() {

     $('.display').DataTable({
       dom: 'lBfrtip',
       "ordering": false,
       "paging": true,
       "pageLength": 50,
       "processing": true,
       "language": {
           "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
           "lengthMenu": "Ver _MENU_ Registros / Pagina",
           "zeroRecords": "No se encontraron registros",
           "info": "Viendo Pagina _PAGE_ de _PAGES_",
           "search": " Filtrar: ",
           "infoEmpty": "No hay registros a visualizar",
           "infoFiltered": "(filtered from _MAX_ total records)",
           "infoFiltered": "(filtered from _MAX_ total records)",
           "paginate": {
             "previous": "Anterior",
             "next": "Siguiente",
             "last": "Ultimo",
             "first": "Primero",
           }
         },
         buttons: [
              {
                  extend: 'copyHtml5',
                  exportOptions: {
                   columns: ':contains("Office")'
                 },
                 orientation: 'portrait',
                 pageSize: 'LEGAL',
              },
              'excelHtml5',
              'csvHtml5',
              'pdfHtml5',
              'copyHtml5',
              'print'
          ]
    });


    $.fn.datepicker.dates['es-MX'] = {
        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
        daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        today: "Hoy",
        clear: "Limpiar",
        format: 'dd-mm-yyyy',
        titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
        weekStart: 0
    };
      // var date  = new Date().toJSON().slice(0,10).split('-').reverse().join('/')

      // Translated
    $('.dropify').dropify({
      messages: {
          default: 'Arrastre el archivo o de click para cargarlo',
          replace: 'Arrastre el archivo o de click cargar y sustituir el archivo',
          remove:  'Eliminar',
          error:   'Se ha producido un error inesperado, consulte al administrador'
      }
    });

    // Used events
    var drEvent = $('#input-file-events').dropify();

    drEvent.on('dropify.beforeClear', function(event, element){
      return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });

    drEvent.on('dropify.afterClear', function(event, element){

    });

    drEvent.on('dropify.errors', function(event, element){
          console.log('Has Errors');
    });

    var drDestroy = $('#input-file-to-destroy').dropify();
      drDestroy = drDestroy.data('dropify')
      $('#toggleDropify').on('click', function(e){
          e.preventDefault();
          if (drDestroy.isDropified()) {
              drDestroy.destroy();
          } else {
              drDestroy.init();
          }
    });

      // alert(date)
    $('.dates').datepicker({
        todayHighlight: true,
        language: 'es-MX'
    });

    $('.dateValid').datepicker({
        language: 'es-MX',
        todayHighlight: true,
        startDate : true
    });

    $('.timepicker').pickatime({
      format: 'h:i',
      formatLabel: '<b>h</b>:i <!i>a</!i>',
      formatSubmit: 'HH:i:s',
      hiddenPrefix: 'prefix__',
      hiddenSuffix: '__suffix'
    });


    $('.select2').select2();

    $('.delete').on('click',function(){

      var url = $(this).attr('data-url');

      if(url != "") {

        swal({
            title: " ¿Esta seguro ?",
            text: "¿Realmente desea realizar esta operación?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

              location =  url;

            } else {

            }
        });

      }

    });

    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'

    });

    $('.clockpicker').clockpicker({
            donetext: 'Done',

        })
        .find('input').change(function() {
            console.log(this.value);
        });

    $('#check-minutes').click(function(e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show')
            .clockpicker('toggleView', 'minutes');
    });

    function ejecutaLink(url) {

      if(url != "") {

        swal({
            title: " ¿Esta seguro ?",
            text: "¿Realmente desea realizar esta operación?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

              location =  url;

            } else {

            }
        });

      }
    }
});
    <?php if(Session::has('message')) { ?>
      <?php if(Session::has('exito')) { ?>

        swal({ title: "EXITO", text: "<?php echo Session::get('message'); ?>", type: "success"});

      <?php } else if(Session::has('fracaso')) { ?>

        swal({ title: "ATENCION", text: "<?php echo Session::get('message'); ?>", type: "warning"});

      <?php } ?>

    <?php } ?>

    $(".chosen-select").chosen();

</script>


<style>

.dataTables_length { display: none; }

.dataTables_filter { display: none; }

.dataTables_info { display: none; }

.dataTables_paginate { display: none; }

.asColorPicker-trigger {
    position: absolute;
    top: 0;
    right: -35px;
    height: 38px;
    width: 37px;
    border: 0;
}

.dt-buttons {

  display: none;

}

.zoomContainer{
z-index: 2000 !important;
}
</style>

<?php echo $__env->yieldContent('scripts'); ?>

</body>

</html>
