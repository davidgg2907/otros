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
    <title>{{ str_replace('_',' ',env('TITULO_APP')) }} :: INICIAR SESION</title>
    <link rel="apple-touch-icon" href="{{ asset('/') }}images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-basic px-2">
                    <div class="auth-inner my-2">
                        <!-- Login basic -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="index.html" class="brand-logo">
                                  @if(\App\admin\Configuracion::getConfig()->logo != "")
                                    <img src="{{ asset('uploads/empresa/' . \App\admin\Configuracion::getConfig()->logo) }}" height="100">
                                  @else
                                    <img src="{{ asset('images/logo/logo.png') }}">
                                  @endif
                                </a>

                                <h4 class="card-title mb-1">Bienvenido! 👋</h4>
                                <p class="card-text mb-2">

                                  @if (count($errors) > 0)
                                      <ul>
                                          @foreach ($errors->all() as $error)
                                              <li class="text-danger">{{ $error }}</li>
                                          @endforeach
                                      </ul>
                                  @endif
                                </p>

                                <form class="auth-login-form mt-2" id="loginform" role="form" method="POST" action="{{ route('login') }}" >
                                  {{ csrf_field() }}
                                    <div class="mb-1">
                                        <label class="form-label" for="login-email">Correo Electronico</label>
                                        <input class="form-control" id="login-email" type="text" name="email" placeholder="john@example.com" aria-describedby="login-email" autofocus="" tabindex="1" />
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="login-password">Contrase&ntilde;a</label>
                                            <a href="{{ url('password/reset') }}"><small>Olvide mi contrase&ntilde;a</small></a>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="login-password" type="password" name="password" placeholder="********" aria-describedby="login-password" tabindex="2" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <div class="form-check">
                                            <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" />
                                            <label class="form-check-label" for="remember-me"> Recordarme</label>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary w-100" tabindex="4">Iniciar Sesion</button>
                                </form>
                            </div>
                        </div>
                        <!-- /Login basic -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('/') }}vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('/') }}vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('/') }}js/core/app-menu.js"></script>
    <script src="{{ asset('/') }}js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('/') }}js/scripts/pages/auth-login.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>
