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
        <a href="<?php echo e(url('/admin/triaje/add')); ?>" class="btn btn-info ">
          <i class="fa fa-plus fa-2x"></i><br/>Nuevo</a>

      </div>

      <div class="pull-right">
        <a href="<?php echo e(url('/admin/triaje/excel' . $query)); ?>" class="btn btn-success" title="Exportar a Excel">
          <i class="fa fa-copy fa-2x"></i><br/>E. Excel
        </a>
      </div>

      <div class="clear"></div>

    </div>

  </div>
  <!-- Terminan botones de Accion -->

  <!-- Inicia busqueda de registros -->
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

			  <!-- Fecha Start -->	
				<div class="col-md-2">
					<div class="form-group">
					<label for="fecha" class="control-label"> Fecha </label>
					<input type="text" class="form-control dates" id="fecha" name="fecha" >
				</div>
				</div>
				<!-- Fecha End -->

				<!-- Paciente Start -->
				<div class="col-md-5">
					<div class="form-group">
					<label for="paciente" class="control-label"> Nombre del Paciente </label>
					<input type="text" class="form-control" id="paciente" name="paciente"
					value="<?php echo e(isset($data->paciente ) ? $data->paciente  : old('paciente')); ?>">
					<div class="label label-danger"><?php echo e($errors->first("paciente")); ?></div>
				</div>
				</div>
				<!-- Paciente End -->
		
				<!-- Valoracion Start -->
				<div class="col-md-5">
					<div class="form-group">
						<label for="talla" class="control-label"> Valoracion</label>
						<input type="text" class="form-control" id="valoracion" name="valoracion"
						value="<?php echo e(isset($data->valoracion ) ? $data->valoracion  : old('valoracion')); ?>">
						<div class="label label-danger"><?php echo e($errors->first("valoracion")); ?></div>
					</div>
				</div>
				<!-- Valoracion End -->

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
  <!-- Termina busqueda de registros -->


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
                    <?php $sortSym=isset($_GET["order"]) && $_GET["order"]=="asc" ? "up" : "down"; ?><th>Folio</th>
						<th>Fecha/Hora</th>
						<th>Paciente</th>
						<th>Edad</th>
						<th>Genero</th>
						<th>Peso</th>
						<th>Talla</th>
						<th>Valoracion</th>						
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" class="<?php if($value->status == 0): ?> danger <?php endif; ?>">
				  <td> 
					<?php if($value->tarjeta=="ROJO") { $color="text-danger"; } elseif($value->tarjeta=="AMARILLO") { $color="text-warning"; } else { $color="text-success"; }?>
					# <?php echo e($value->id); ?>

					<i class="fa fa-circle fa-lg <?php echo e($color); ?>"></i>	
				  	 
				  </td>
                  <td> <?php echo e($value->fecha); ?> <?php echo e($value->hora); ?> </td>
				  <td> <?php echo e($value->paciente); ?> </td>
				  <td> <?php echo e($value->edad); ?> </td>
				  <td> <?php echo e($value->genero); ?> </td>
				  <td> <?php echo e($value->peso); ?> </td>
				  <td> <?php echo e($value->talla); ?> </td>
				  <td> <?php echo e($value->valoracion); ?> </td>                
          <td class="text-center">
				  <a href="<?php echo url("/"); ?>/admin/triaje/view/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip" target="_blank">
					<i class="fa fa-file-pdf-o fa-lg text-info m-r-10"></i>
					</a>
          <?php if($value->status == 1): ?>
					<a href="<?php echo url("/"); ?>/admin/triaje/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
					<i class="fa fa-edit fa-lg text-info m-r-10"></i>
					</a>
					<button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/triaje/baja/<?php echo $value->id; ?>" data-title="Eliminar triaje" style="border:0px; background:none">
					<i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
					</button>
          <?php endif; ?>
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