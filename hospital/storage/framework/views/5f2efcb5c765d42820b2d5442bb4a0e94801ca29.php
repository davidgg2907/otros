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
          <a href="<?php echo e(url('/admin/farmacia/add')); ?>" class="btn btn-info ">
            <i class="fa fa-plus fa-2x"></i><br/>Nuevo</a>
        <?php } ?>

          <button class="btn btn-default" data-toggle="modal" title="Imprimir Listado" data-target="#modalSearch">
            <i class="fa fa-search fa-2x"></i><br/>Buscar
          </button>
      </div>


      <div class="clear"></div>

    </div>

  </div>
  <!-- Terminan botones de Accion -->


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
                    <th>Habitacion</th>
                    <th>Solicitante</th>
                    <th>F. Solicitud</th>
                    <th>F. Surtido</th>
						        <th>Estatus</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
				            <td> <?php echo e($value->cuarto->numero); ?> <?php echo e($value->cuarto->descripcion); ?> </td>
				            <td> <?php echo e($value->solicitante); ?> </td>
                    <td> <?php echo e($value->fecha_registro); ?> </td>
                    <td> <?php echo e($value->fecha_surtido); ?> </td>
                    <td><button onclick="imprimeOrden(<?php echo e($value->id); ?>);" class="<?php  echo $value->status == 1 ? 'btn btn-info btn-rounded' : 'btn btn-success btn-rounded'; ?>"> <?php  echo $value->status == 1 ? 'ACTIVA' : 'SURTIDA'; ?></button> </td>
                    <td>
                      <?php if(Auth::user()->permisos->addRecord == 1) { ?>
  						           <a href="<?php echo url("/"); ?>/admin/farmacia/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
  						            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
  						           </a>
                       <?php } ?>

                       <?php if($value->status == 1) { ?>
                         <?php if(Auth::user()->permisos->editRecord == 1) { ?>
                           <a href="<?php echo url("/"); ?>/admin/farmacia/alta/<?php echo $value->id; ?>" title="Orden Atendida" data-toggle="tooltip">
    						            <i class="fa fa-check-circle fa-lg text-success m-r-10"></i>
    						           </a>
                         <?php } ?>
                         <?php if(Auth::user()->permisos->deleteRecord == 1) { ?>
                           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/farmacia/baja/<?php echo $value->id; ?>" data-title="Eliminar farmacia" style="border:0px; background:none">
    						           <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
    						           </button>
                         <?php } ?>
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


<div class="modal fade" id="modalViewer" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel"> Orden de Farmacia
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </h5>

            </div>
            <div class="modal-body">
              <div class="row">

                <iframe src="" style="width:100%; height: 500px" id="ifrViewer"></iframe>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">

                <button  class="btn btn-danger" title="Cerrar Ventana" data-dismiss="modal" >
                  <span class="btn-label"><i class="fa fa-times fa-lg"></i></span>Cerrar
                </button>

              </div>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>


<script>
function imprimeOrden(id) {

  var url = "<?php echo e(url('admin/farmacia/view')); ?>/" + id;

  $('#ifrViewer').attr('src',url);

  $('#modalViewer').modal({

    backdrop: 'static',

    keyboard: false,

    focus: true

  });

}
</script>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>