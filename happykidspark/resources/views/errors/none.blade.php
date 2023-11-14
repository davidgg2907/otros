<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="David Garduño Gomez DG Studio MX">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>BODLEA:: Administrador de Canales Multimedia</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('themes/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('themes/js/jPlayer/jplayer.flat.css') }}" type="text/css" />
    <!-- Menu CSS -->
    <link href="{{ asset('themes/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{ asset('themes/css/animate.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('themes/css/style.css') }}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{ asset('themes/css/colors/light.css') }} " id="theme" rel="stylesheet">
    <!-- chosen CSS -->
    <link href="{{ asset('themes/plugins/chosen/chosen.min.css') }}" rel="stylesheet">
    <!-- Dropify CSS -->
    <link href="{{ asset('themes/plugins//bower_components/dropify/dist/css/dropify.css') }}" rel="stylesheet">
    <!-- sweetalert CSS -->
    <link href="{{ asset('themes/plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <link href="{{ asset('themes/css/a.css') }}" rel="stylesheet">
    <!-- timepicker CSS -->
    <link href="{{ asset('themes/plugins/bower_components/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- jPlayer -->
    <link rel="stylesheet" href="{{ asset('themes/js/jPlayer/jplayer.flat.css') }}" type="text/css" />
    <!-- Animation CSS -->
    <link href="{{ asset('themes/css/animate.css') }}" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{ asset('themes/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('themes/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{ asset('themes/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{ asset('themes/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('themes/js/waves.js') }}"></script>
    <script type="text/javascript" src="{{ asset('themes/js/jPlayer/jquery.jplayer.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('themes/js/jPlayer/add-on/jplayer.playlist.min.js') }}"></script>

    <!-- Chosen JavaScript -->
    <script src="{{ asset('themes/plugins/chosen/chosen.jquery.min.js') }}"></script>
    <!-- Dropify JS -->
    <script src="{{ asset('themes/plugins//bower_components/dropify/dist/js/dropify.min.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('themes/js/custom.min.js') }} "></script>
    <!--Style Switcher -->
    <script src="{{ asset('themes/plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
    <!-- sweetalert JavaScript -->
    <script src="{{ asset('themes/plugins/bower_components/sweetalert/sweetalert.min.js') }}" ></script>
    <!-- timepicker JavaScript -->
    <script src="{{ asset('themes/plugins/bower_components/timepicker/bootstrap-timepicker.min.js') }}"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o), m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-19175540-9', 'auto');
        ga('send', 'pageview');
    </script>

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
                  <a class="logo" href="{{ url('/') }}">
                    <b><img src="{{ asset('themes/plugins/images/') }}" alt="BODLEA" width="100%"/></b>
                    <span class="hidden-xs"><strong>&nbsp;&nbsp;</strong>Player</span>
                  </a>
                </div>
            </div>
            <!-- /.navbar-header -->
        </nav>

        <div id="page-wrapper" style="margin: 0px 0 0px 0px !Important; background: rgb(255,255,255)">

          <div class="container-fluid">

              <div class="row" style="margin-bottom:50px">
                <h1 class="text-center <?php echo $config['title_text']; ?>"> <?php echo $config['titulo']; ?></h1>
              </div>


              <div class="row text-center" style="margin-bottom:50px">
                <img src="{{ asset('themes/plugins/images/logotipo.jpeg') }}" width="40%" />
              </div>

              <div class="row">
                <h2 class="text-center <?php echo $config['msg_text']; ?>"> <?php echo $config['mensaje']; ?></h2>
              </div>

          </div>

          <footer class="footer text-center"> {{ date('Y') }} &copy; BODLEA Todos los derechos reservados </footer>

        </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

<script>

$(document).ready(function() {

    function monitorea(){

      $.ajax({
        url: "<?php echo url('admin/programacion/monitorea/' . $config['canal_id']); ?>",
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        success: function(json) {

          if(json['apertura'] == 1) {

            location.reload();

          }

        }

      });

    }

    setInterval(monitorea, 3000);

});

  <?php if(Session::has('message')) { ?>
    <?php if(Session::has('exito')) { ?>

      swal({ title: "EXITO", text: "<?php echo Session::get('message'); ?>", type: "success"});

    <?php } else if(Session::has('fracaso')) { ?>

      swal({ title: "ATENCION", text: "<?php echo Session::get('message'); ?>", type: "warning"});

    <?php } ?>

  <?php } ?>



</script>

</body>

</html>
