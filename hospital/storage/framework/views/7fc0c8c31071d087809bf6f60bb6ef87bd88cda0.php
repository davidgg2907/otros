<?php $__env->startSection('content'); ?>

<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title"><?php echo e($config['titulo']); ?></h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
     <?php echo $__env->make('layouts.breadcrumbs',[ 'breadcrumbs' => $config['breadcrumbs'] ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
  <!-- /.col-lg-12 -->
</div>

<div class="row">
  <form action="<?php echo url('/'); ?>/admin/==table==/add" id="formValidation" method="post" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>


    <div class="col-sm-12">
      <div class="white-box">
          <div class="pull-right">
          	<a href="<?php echo e($config['cancelar']); ?>" class="btn btn-default ">
              <li class="fa fa-times fa-2x"></li>&nbsp;<br>Cancelar
            </a>
          </div>
          <div class="clear"></div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="panel panel-info">
        <div class="panel-heading"><?php echo e($config['titulo']); ?></div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
          <div class="panel-body">
            <?php echo e(csrf_field()); ?>

              <table class='table table-bordered' style='width:70%;' align='center'>
												<tr>
												 <td>
												   <label for="id" class="col-sm-3 control-label"> Id </label>
												 </td>
												 <td>
												   <?php echo e($data->id); ?>

												 </td>
												</tr>

							    <!-- Rol Start -->
								<tr>
								 <td>
								  <label class="control-label col-md-3"> Rol </label>
								 </td>
								 <td>
							     <?php echo e($data->name); ?>

								 </td>
								</tr>
							    <!-- Rol End -->


												<tr>
												 <td>
												   <label for="tipo" class="col-sm-3 control-label"> Tipo </label>
												 </td>
												 <td>
												   <?php echo e($data->tipo); ?>

												 </td>
												</tr>
												<tr>
												 <td>
												   <label for="estado" class="col-sm-3 control-label"> Estado </label>
												 </td>
												 <td>
												   <?php echo e($data->estado); ?>

												 </td>
												</tr>
												<tr>
												 <td>
												   <label for="telefono" class="col-sm-3 control-label"> Telefono </label>
												 </td>
												 <td>
												   <?php echo e($data->telefono); ?>

												 </td>
												</tr>
												<tr>
												 <td>
												   <label for="celular" class="col-sm-3 control-label"> Celular </label>
												 </td>
												 <td>
												   <?php echo e($data->celular); ?>

												 </td>
												</tr>
												<tr>
												 <td>
												   <label for="direccion" class="col-sm-3 control-label"> Direccion </label>
												 </td>
												 <td>
												   <?php echo e($data->direccion); ?>

												 </td>
												</tr>
												<tr>
												 <td>
												   <label for="name" class="col-sm-3 control-label"> Name </label>
												 </td>
												 <td>
												   <?php echo e($data->name); ?>

												 </td>
												</tr>
												<tr>
												 <td>
												   <label for="email" class="col-sm-3 control-label"> Email </label>
												 </td>
												 <td>
												   <?php echo e($data->email); ?>

												 </td>
												</tr>
												<tr>
												 <td>
												   <label for="password" class="col-sm-3 control-label"> Password </label>
												 </td>
												 <td>
												   <?php echo e($data->password); ?>

												 </td>
												</tr>
												<tr>
												 <td>
												   <label for="remember_token" class="col-sm-3 control-label"> Remember_token </label>
												 </td>
												 <td>
												   <?php echo e($data->remember_token); ?>

												 </td>
												</tr>
												<tr>
												 <td>
												   <label for="created_at" class="col-sm-3 control-label"> Created_at </label>
												 </td>
												 <td>
												   <?php echo e($data->created_at); ?>

												 </td>
												</tr>
												<tr>
												 <td>
												   <label for="updated_at" class="col-sm-3 control-label"> Updated_at </label>
												 </td>
												 <td>
												   <?php echo e($data->updated_at); ?>

												 </td>
												</tr>
												<tr>
												 <td>
												   <label for="time_login" class="col-sm-3 control-label"> Time_login </label>
												 </td>
												 <td>
												   <?php echo e($data->time_login); ?>

												 </td>
												</tr>
												<tr>
												 <td>
												   <label for="online" class="col-sm-3 control-label"> Online </label>
												 </td>
												 <td>
												   <?php echo e($data->online); ?>

												 </td>
												</tr>
												<tr>
												 <td>
												   <label for="status" class="col-sm-3 control-label"> Status </label>
												 </td>
												 <td>
												   <?php echo e($data->status); ?>

												 </td>
												</tr></table>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>