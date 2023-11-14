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
  <form action="<?php echo url('/'); ?>/admin/roles/edit" id="formValidation" method="post" enctype="multipart/form-data">

    <div class="col-sm-12">

      <div class="white-box">

          <div class="pull-left">
            <a href="<?php echo e($config['cancelar']); ?>" class="btn btn-danger">
              <i class="fa fa-times fa-2x"></i><br/>Cancelar
            </a>
          </div>
          <div class="pull-right">
            <button type="submit" class="btn btn-success">
              <i class="fa fa-save fa-2x"></i><br/>Guardar
            </button>
          </div>

          <div class="clear"></div>

      </div>

    </div>

    <div class="col-md-12">

      <?php echo e(csrf_field()); ?>


      <input type="hidden" name="id" value="<?php echo $data->id; ?>">

      <?php echo $__env->make('admin.roles.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>
  </form>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>