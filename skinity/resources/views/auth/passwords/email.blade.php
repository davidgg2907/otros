<!DOCTYPE html>
<html lang="en" class="loading">
  <!-- BEGIN : Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Apex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Apex admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ env('TITULO_APP') }} :: RESTABLECER CONTRASEÑA</title>
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/') }}/img/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/') }}/img/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/') }}/img/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/') }}/img/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}/img/ico/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/') }}/img/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}/fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}/css/prism.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}/css/app.css">
    <!-- END APEX CSS-->
    <!-- BEGIN Page Level CSS-->
    <!-- END Page Level CSS-->
  </head>
  <!-- END : Head-->

  <!-- BEGIN : Body-->
  <body data-col="1-column" class=" 1-column  blank-page">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
      <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!--Forgot Password Starts-->
<section id="forgot-password">
  <div class="container-fluid forgot-password-bg">
    <div class="row full-height-vh m-0 d-flex align-items-center justify-content-center">
      <div class="col-md-7 col-sm-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body fg-image">
              <div class="row m-0">
                <div class="col-lg-6 d-none d-lg-block text-center py-2">
                  <img src="{{ asset('/') }}/img/gallery/forgot.png" alt="" class="img-fluid" width="300" height="230">
                </div>
                <div class="col-lg-6 col-md-12 bg-white px-4 pt-3">
                  <form class="form-horizontal form-material" role="form" method="POST" action="{{ route('password.email') }}" >

                    <div class="form-group">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    {{ csrf_field() }}

                  <h4 class="mb-2 card-title">Recuperar Contraseña</h4>
                  <p class="card-text mb-3">
                    Por favor ingrese su nombre de usuario o email, enviaremos las instrucciones
                    para restablecer la contraseña a su correo electronico
                  </p>

                  <input id="email" type="email" class="form-control mb-3" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo electronico">
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif

                  <!-- <input type="text" class="form-control mb-3" placeholder="Email" />-->
                  <div class="fg-actions d-flex justify-content-between">
                    <div class="login-btn">
                      <a href="{{ route('login') }}" class="text-decoration-none btn btn-outline-primary">Iniciar Sesion</a>
                    </div>
                    <div class="recover-pass">
                      <button class="btn btn-primary">
                        Recuperar Contraseña
                      </button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Forgot Password Ends-->

          </div>
        </div>
        <!-- END : End Main Content-->
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('/') }}/js/core/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}/js/core/popper.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}/js/prism.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}/js/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}/js/screenfull.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}/js/pace/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN APEX JS-->
    <script src="{{ asset('/') }}/js/app-sidebar.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}/js/notification-sidebar.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}/js/customizer.js" type="text/javascript"></script>
    <!-- END APEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
  </body>
  <!-- END : Body-->
</html>
