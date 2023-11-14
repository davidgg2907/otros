<?php $__env->startSection('content'); ?>

<?php
$searchValue = isset($_GET['searchValue'])?$_GET['searchValue']:'';
$searchBy = isset($_GET['searchBy'])?$_GET['searchBy']:'';
$order_by = isset($_GET['order_by'])?$_GET['order_by']:'';
$order = isset($_GET['order'])?$_GET['order']:'';
$redirect = url('/').'/admin/documentos?'.urlencode($_SERVER["QUERY_STRING"]);
?>


<!-- Page Content -->

<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title"><?php echo e($config['titulo']); ?></h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <?php echo $__env->make('layouts.breadcrumbs',[ 'breadcrumbs' => $config['breadcrumbs'] ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
</div>


<div class="row">

  <!-- Inicia botones de Accion -->
  <div class="col-sm-12">

    <div class="white-box">

      <div class="pull-left">
        <?php if(Auth::user()->permisos->addRecord == 1) { ?>
          <a href="<?php echo e(url('/admin/enfermeria/add')); ?>" class="btn btn-info ">
            <i class="fa fa-plus fa-2x"></i><br/>Nuevo</a>
        <?php }?>
      </div>


      <div class="clear"></div>

    </div>

  </div>
  <!-- Terminan botones de Accion -->

  <!-- Inicia listado de registros -->
  <div class="col-sm-12" id="frmListado">
    <form method="get" enctype="multipart/form-data">
      <div class="panel panel-default">
        <div class="panel-heading">
          Filtrar Listado
          <div class="panel-action">
            <a id="itemPanel" href="#" data-perform="panel-collapse"><i class="ti-plus"></i></a>
          </div>
        </div>
        <div class="panel-wrapper collapse">
            <div class="panel-body">
              <div class="row">
                <!-- Nombre Start -->
                <div class="col-md-12">
                 <div class="form-group">
                  <label for="nombre" class="control-label"> Nombre </label>
                    <input type="text" class="form-control" id="nombre" name="nombre"
                    value="<?php echo e(isset($data->nombre ) ? $data->nombre  : old('nombre')); ?>">
                    <div class="label label-danger"><?php echo e($errors->first("nombre")); ?></div>
                 </div>
                </div>
                <!-- Nombre End -->

                <!-- Cedula Start -->
                <div class="col-md-4">
                 <div class="form-group">
                  <label for="cedula" class="control-label"> Cedula </label>
                    <input type="text" class="form-control" id="cedula" name="cedula"
                    value="<?php echo e(isset($data->cedula ) ? $data->cedula  : old('cedula')); ?>">
                    <div class="label label-danger"><?php echo e($errors->first("cedula")); ?></div>
                 </div>
                </div>
                <!-- Cedula End -->

                <!-- Rfc Start -->
                <div class="col-md-4">
                 <div class="form-group">
                  <label for="rfc" class="control-label"> R.F.C </label>
                    <input type="text" class="form-control" id="rfc" name="rfc"
                    value="<?php echo e(isset($data->rfc ) ? $data->rfc  : old('rfc')); ?>">
                    <div class="label label-danger"><?php echo e($errors->first("rfc")); ?></div>
                 </div>
                </div>
                <!-- Rfc End -->

                <!-- Celular Start -->
                <div class="col-md-4">
                 <div class="form-group">
                  <label for="celular" class="control-label"> Celular </label>
                    <input type="text" class="form-control" id="celular" name="celular"
                    value="<?php echo e(isset($data->celular ) ? $data->celular  : old('celular')); ?>">
                    <div class="label label-danger"><?php echo e($errors->first("celular")); ?></div>
                 </div>
                </div>
                <!-- Celular End -->
              </div>
            </div>
            <div class="panel-footer">
              <div class="row text-right">
                <button class="btn btn-default waves-effect waves-light" type="submit">
                  <span class="btn-label"><i class="fa fa-search"></i></span>Buscar
                </button>
              </div>
            </div>
        </div>
      </div>
    </form>
  </div>
  <!-- Termina listado de registros -->

  <!-- Inicia listado de registros -->
  <div class="col-sm-12" id="frmListado">

    <div class="row">
      <?php foreach($data as $value) { ?>
        <!-- .col -->
        <div class="col-md-4 col-sm-4">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-4 col-sm-4 text-center">
                      <a href="<?php echo e(url('admin/enfermeria/view/' . $value->id)); ?>">
                      <?php if($value->fotografia) { ?>
                        <img src="<?php echo e(asset('uploads/enfermeras/' . $value->fotografia)); ?>" alt="user" class="img-circle img-responsive">
                      <?php } else { ?>
                        <img src="<?php echo e(asset('uploads/medico.png')); ?>" alt="user" class="img-circle img-responsive">
                      <?php } ?>
                      </a>


                    </div>
                    <div class="col-md-8 col-sm-8">
                        <a href="<?php echo e(url('admin/enfermeria/view/' . $value->id)); ?>">
                          <h3 class="box-title m-b-0" title="<?php echo e($value->nombre); ?>"><?php echo e(substr($value->nombre,0,20)); ?></h3> <small><?php echo e($value->especialidad); ?></small>
                        </a>
                        <p> </p>
                        <address>
                          <abbr title="Phone">T:</abbr> <?php echo e($value->celular); ?>

                        </address>
                        <p></p>
                    </div>

                    <div class="col-md-12">
                      <div class="pull-left">
                      </div>

                      <div class="pull-right">
                        <?php if(Auth::user()->permisos->editRecord == 1) { ?>
                          <a title="Actualizar Informacion" href="<?php echo e(url('admin/enfermeria/edit/' . $value->id)); ?>" class="btn btn-twitter waves-effect waves-light">
                            <li class="fa fa-edit fa-lg"></li>
                          </a>
                        <?php } ?>
                        <?php if(Auth::user()->permisos->deleteRecord == 1) { ?>
                          <button type="button" data-toggle="tooltip" class="btn btn-danger waves-effect waves-light delete" data-url="<?php echo url("/"); ?>/admin/enfermeria/baja/<?php echo $value->id; ?>" data-title="Eliminar pacientes">
                          <i class="fa fa-trash-o fa-lg"></i>
                          </button>
                        <?php } ?>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
      <?php }  ?>
      </div>

      <div class="row">
         <?php echo e($data->links('vendor.pagination.default')); ?>

      </div>

  </div>
  <!-- Termina listado de registros -->

</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>