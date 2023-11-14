<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
<link href="{{ asset('themes/eliteadmin-inverse/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('themes/eliteadmin-inverse/css/style.css') }}" rel="stylesheet">
<title>TRAKING DE RUTAS Y PAQUETERIA</title>
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box login-sidebar">
    <div class="white-box">
      <form class="form-horizontal form-material" role="form" method="POST" action="{{ route('register') }}" >
        <h3 class="box-title m-b-20">Registrarse</h3>
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <div class="col-xs-12">
            <div class="col-md-12">
                <label for="email" class="col-md-12 ">Ingrese su nombre completo</label>
            </div>
            <div class="col-md-12">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Nombre">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
          </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <div class="col-xs-12">
            <div class="col-md-12">
                <label for="email" class="col-md-12 ">Ingrese su correo electronico</label>
            </div>
            <div class="col-md-12">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Correo electronico">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
          </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <div class="col-xs-12">
            <div class="col-md-12">
                <label for="email" class="col-md-12 ">Ingrese su nueva contraseña</label>
            </div>
            <div class="col-md-12">
                <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <div class="col-md-12">
                <label for="email" class="col-md-12 ">Repita su contraseña</label>
            </div>
            <div class="col-md-12">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Repita contraseña">
            </div>
          </div>
        </div>
        <div class="form-group text-center m-t-20">
            <div class="col-xs-6">
                <a class="btn btn-default btn-lg btn-block text-uppercase waves-effect waves-light" href="{{ route('login') }}">Regresar</a>
            </div>
            <div class="col-xs-6">
                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Registrarse</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</section>
<script src="{{ asset('themes/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('themes/eliteadmin-inverse/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- <script src="{{ asset('themes/plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script> -->
<script src="{{ asset('themes/eliteadmin-inverse/js/jquery.slimscroll.js') }}"></script>
<!-- <script src="{{ asset('themes/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script> -->
<script src="{{ asset('themes/eliteadmin-inverse/js/custom.min.js') }}"></script>
