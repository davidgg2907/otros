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
          <a href="<?php echo e(url('/admin/consultorios/add')); ?>" class="btn btn-info ">
            <i class="fa fa-plus fa-2x"></i><br/>Nuevo</a>
        <?php } ?>
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

              <!-- Dia_laboral Start -->
              <div class="col-md-4">
               <div class="form-group">
                <label for="consultorio" class="control-label"> Nro de Consultorio </label>
                  <input type="text" class="form-control" id="consultorio" name="consultorio"
                  value="<?php echo e(isset($data->consultorio ) ? $data->consultorio  : old('consultorio')); ?>">
                  <div class="label label-danger"><?php echo e($errors->first("consultorio")); ?></div>
               </div>
              </div>
              <!-- Dia_laboral End -->


              <!-- Dia_laboral Start -->
              <div class="col-md-8">
               <div class="form-group">
                <label for="descripcion" class="control-label"> Nombre o Alias </label>
                  <input type="text" class="form-control" id="descripcion" name="descripcion"
                  value="<?php echo e(isset($data->descripcion ) ? $data->descripcion  : old('descripcion')); ?>">
                  <div class="label label-danger"><?php echo e($errors->first("descripcion")); ?></div>
               </div>
              </div>
              <!-- Dia_laboral End -->

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

    <div class="panel panel-default">
      <div class="panel-heading">Listado de Registros</div>
      <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="table-responsive">

              <table class="table display" id="table-content">
                <thead>
                  <tr>
        						<th>Doctor</th>
                    <th>Auxiliar</th>
                    <th>Dia Laboral</th>
        						<th>Horario</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
				            <td> <?php echo e($value->medico->nombre); ?> </td>
                    <td> <?php echo e($value->enfermeria->nombre != "" ?  $value->enfermeria->nombre : " [-NINGUNO-] "); ?> </td>
                    <td> <?php echo e($value->dia_laboral); ?> </td>
                    <td> De <?php echo e($value->hora_inicio); ?> A  <?php echo e($value->hora_fin); ?> </td>
                    <td>
                      <?php if(Auth::user()->permisos->editRecord == 1) { ?>
                        <a href="<?php echo url("/"); ?>/admin/consultorios/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
  											  <i class="fa fa-edit fa-lg text-info m-r-10"></i>
  											</a>
                      <?php } ?>
                      <?php if(Auth::user()->permisos->deleteRecord == 1) { ?>
  											<button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/consultorios/baja/<?php echo $value->id; ?>" data-title="Eliminar consultorios" style="border:0px; background:none">
  											  <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
  											</button>
                      <?php } ?>
            					 					</td>
                  </tr>
                <?php }  ?>
                </tbody>
              </table>

            </div>
          </div>
          <div class="panel-footer"> <?php echo e($data->links('vendor.pagination.default')); ?> </div>
      </div>
    </div>

  </div>
  <!-- Termina listado de registros -->

</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>