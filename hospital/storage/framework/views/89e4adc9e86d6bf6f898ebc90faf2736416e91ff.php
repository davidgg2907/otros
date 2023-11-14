<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
<link href="<?php echo e(asset('themes/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('themes/css/style.css')); ?>" rel="stylesheet">

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title>Control Hospitalario</title>

<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box">
    <div class="white-box">
      <form class="form-horizontal form-material" id="loginform" role="form" method="POST" action="<?php echo e(route('login')); ?>" >
        <h3 class="box-title m-b-20 text-center">Iniciar sesión</h3>
        <?php echo e(csrf_field()); ?>

        <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
          <div class="col-xs-12 text-center" style="margin-bottom:25px">
            <?php $empresa = \App\admin\Empresas::find(1); ?>
            <img src="<?php if($empresa->logotipo != "") { echo asset('uploads/empresa/' . $empresa->logotipo); } else { echo asset('themes/plugins/images/logo.png'); }?>" width="40%"/>

          </div>
          <div class="col-xs-12">
            <!-- <label for="email" class="col-md-12 control-label">Correo electronico</label> -->
            <!-- <div class="col-md-12"> -->
                <input id="email" type="text" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus placeholder="Usuario">
                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                <?php endif; ?>
            <!-- </div> -->
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <!-- <label for="password" class="col-md-12 control-label">Contraseña</label> -->
            <!-- <div class="col-md-12"> -->
                <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">
                <?php if($errors->has('password')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                <?php endif; ?>
            <!-- </div> -->
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-primary pull-left p-t-0">
              <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
              <label for="remember"> Redordar mi cuenta </label>
            </div>
            <a href="<?php echo e(route('password.request')); ?>" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Olvidé mi contraseña</a> </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Ingresar</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</section>
<script src="<?php echo e(asset('themes/plugins/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('themes/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- <script src="<?php echo e(asset('themes/plugins/bower_components/toast-master/js/jquery.toast.js')); ?>"></script> -->
<script src="<?php echo e(asset('themes/js/jquery.slimscroll.js')); ?>"></script>
<!-- <script src="<?php echo e(asset('themes/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')); ?>"></script> -->
<script src="<?php echo e(asset('themes/js/custom.min.js')); ?>"></script>
