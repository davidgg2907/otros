<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
<link href="<?php echo e(asset('themes/eliteadmin-inverse/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('themes/eliteadmin-inverse/css/style.css')); ?>" rel="stylesheet">
<title>Control Hospitalario</title>
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box">
    <div class="white-box">
      <form class="form-horizontal form-material" role="form" method="POST" action="<?php echo e(route('password.email')); ?>" >
        <h3 class="box-title m-b-20">Restablecer contraseña</h3>
        <div class="form-group">
            <?php if(session('status')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
        </div>
        <?php echo e(csrf_field()); ?>

        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
          <div class="col-xs-12">
            <div class="col-md-12">
                <label for="email" class="col-md-12 ">Ingrese su correo electronico</label>
            </div>
            <div class="col-md-12">
                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus placeholder="Correo electronico">
                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="form-group text-center m-t-20">
            <div class="col-xs-6">
                <a class="btn btn-default btn-lg btn-block text-uppercase waves-effect waves-light" href="<?php echo e(route('login')); ?>">Regresar</a>
            </div>
            <div class="col-xs-6">
                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Enviar correo</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</section>
<script src="<?php echo e(asset('themes/plugins/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('themes/eliteadmin-inverse/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- <script src="<?php echo e(asset('themes/plugins/bower_components/toast-master/js/jquery.toast.js')); ?>"></script> -->
<script src="<?php echo e(asset('themes/eliteadmin-inverse/js/jquery.slimscroll.js')); ?>"></script>
<!-- <script src="<?php echo e(asset('themes/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')); ?>"></script> -->
<script src="<?php echo e(asset('themes/eliteadmin-inverse/js/custom.min.js')); ?>"></script>
