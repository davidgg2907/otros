<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
<link href="{{ asset('themes/eliteadmin-inverse/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('themes/eliteadmin-inverse/css/style.css') }}" rel="stylesheet">
<title>Control Hospitalario</title>
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box">
    <div class="white-box">
      <form class="form-horizontal form-material" role="form" method="POST" action="{{ route('password.email') }}" >
        <h3 class="box-title m-b-20">Restablecer contraseña</h3>
        <div class="form-group">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <div class="col-xs-12">
            <div class="col-md-12">
                <label for="email" class="col-md-12 ">Ingrese su correo electronico</label>
            </div>
            <div class="col-md-12">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo electronico">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
          </div>
        </div>
        <div class="form-group text-center m-t-20">
            <div class="col-xs-6">
                <a class="btn btn-default btn-lg btn-block text-uppercase waves-effect waves-light" href="{{ route('login') }}">Regresar</a>
            </div>
            <div class="col-xs-6">
                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Enviar correo</button>
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
