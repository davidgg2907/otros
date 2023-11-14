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
          <a href="<?php echo e(url('/admin/pacientes/add')); ?>" class="btn btn-info ">
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

                <!-- Nombre Start -->
        				<div class="col-md-9">
        				 <div class="form-group">
        					<label for="nombre" class="control-label"> Nombre </label>
        						<input type="text" class="form-control" id="nombre" name="nombre"
        						value="<?php echo e(isset($data->nombre ) ? $data->nombre  : old('nombre')); ?>">
        						<div class="label label-danger"><?php echo e($errors->first("nombre")); ?></div>
        				 </div>
        				</div>
        				<!-- Nombre End -->

                <!-- Sexo Start -->
        				<div class="col-md-3">
        				 <div class="form-group">
        					<label for="sexo" class="control-label"> Sexo </label>
        					<select class="form-control" id="sexo" name="sexo">
        						<option value="">[-AMBOS-]</option>
        						<option value="F">FEMENINO</option>
        						<option value="M">MASCULINO</option>
        					</select>
        					<div class="label label-danger"><?php echo e($errors->first("sexo")); ?></div>
        				 </div>
        				</div>
        				<!-- Sexo End -->

        				<!-- Telefono Start -->
        				<div class="col-md-4">
        				 <div class="form-group">
        					<label for="telefono" class="control-label"> Telefono </label>
        						<input type="text" class="form-control" id="telefono" name="telefono"
        						value="<?php echo e(isset($data->telefono ) ? $data->telefono  : old('telefono')); ?>">
        						<div class="label label-danger"><?php echo e($errors->first("telefono")); ?></div>
        				 </div>
        				</div>
        				<!-- Telefono End -->

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

        				<!-- Tsangre Start -->
        				<div class="col-md-4">
        				 <div class="form-group">
        					<label for="tsangre" class="control-label"> Tsangre </label>
        						<input type="text" class="form-control" id="tsangre" name="tsangre"
        						value="<?php echo e(isset($data->tsangre ) ? $data->tsangre  : old('tsangre')); ?>">
        						<div class="label label-danger"><?php echo e($errors->first("tsangre")); ?></div>
        				 </div>
        				</div>
        				<!-- Tsangre End -->

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
                    <th></th>
        						<th>Nombre</th>
        						<th>Telefono</th>
        						<th>Celular</th>
        						<th>T. Sangre</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
  			            <td>
                      <?php if($value->fotografia) { ?>
                        <img src="<?php echo e(asset('uploads/pacientes/' . $value->fotografia)); ?>" width="40" class="img-circle img-responsive">
                      <?php } else { ?>
                        <img src="<?php echo e(asset('uploads/paciente.jpeg')); ?>" alt="user" width="40" class="img-circle img-responsive">
                      <?php } ?>
                    </td>
                    <td> <?php echo e($value->nombre); ?> </td>
  			            <td> <?php echo e($value->telefono); ?> </td>
  			            <td> <?php echo e($value->celular); ?> </td>
                    <td> <?php echo e($value->tsangre); ?> </td>
                    <td class="text-center">

                      <?php if(Auth::user()->permisos->viewRecord == 1) { ?>
                        <!--<button onclick="imprime(<?php echo e($value->id); ?>,1)" type="button" data-toggle="tooltip" style="border:0px; background:none" title="Imprimir Ficha de signos vitales">
                           <i class="fa fa fa-heartbeat fa-lg fa-lg text-info m-r-10"></i>
                         </button>-->
                      <?php } ?>

                      <?php if(Auth::user()->permisos->viewRecord == 1) { ?>
                        <a href="<?php echo url("/"); ?>/admin/pacientes/view/<?php echo $value->id; ?>" title="Ver Ficha" data-toggle="tooltip">
                          <i class="fa fa-file-pdf-o fa-lg text-info m-r-10"></i>
                        </a>
                      <?php } ?>

                      <?php if(Auth::user()->permisos->editRecord == 1) { ?>

                        <button onclick="insertaNota(<?php echo $value->id; ?>)" type="button" data-toggle="tooltip" data-title="Generar Nota Medica" style="border:0px; background:none">
                          <i class="fa fa-commenting-o fa-lg text-primary m-r-10"></i>
                        </button>

                        <?php if(in_array(Auth::user()->medico_id,array(0,$value->propietario_id))) { ?>
                          <a href="<?php echo url("/"); ?>/admin/pacientes/edit/<?php echo $value->id; ?>" title="Editar" data-toggle="tooltip">
                            <i class="fa fa-edit fa-lg text-info fa-lg m-r-10"></i>
                          </a>
                        <?php } ?>

                      <?php } ?>

                      <?php if(Auth::user()->permisos->viewRecord == 1) { ?>
                        <a href="<?php echo url("/"); ?>/admin/pacientes/expediente/<?php echo $value->id; ?>" title="Expediente Clinico" data-toggle="tooltip">
                          <i class="fa fa-folder-open fa-lg text-success m-r-10"></i>
                        </a>
                      <?php } ?>

                      <?php if(Auth::user()->permisos->deleteRecord == 1) { ?>

                        <?php if(in_array(Auth::user()->medico_id,array(0,$value->propietario_id))) { ?>
                          <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/pacientes/baja/<?php echo $value->id; ?>" data-title="Eliminar Paciente" style="border:0px; background:none">
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

<div class="modal fade" id="modalNota" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1200px !Important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel">
                  Notas Medica
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </h5>
            </div>
            <div class="modal-body">
              <div class="row">
                <form action="<?php echo url('/'); ?>/admin/notas/add" id="formValidation" method="post" enctype="multipart/form-data">
                  <?php echo e(csrf_field()); ?>


                  <input type="hidden" name="redirect" id="redirect" value="admin/pacientes"/>
                  <input type="hidden" name="paciente_id" id="pacienteNotaId" value=""/>

                  <?php if(Auth::user()->medico_id == 0) { ?>
                    <!-- Medico_id Start -->
										<div class="col-md-12">
									    <div class="form-group">
									        <label for="medico_id" class="control-label"> Medico </label>
                          <select id="medico_id" name="medico_id" class="form-control">
                              <option value=""> [-SELECCIONE-] </option>
                              <?php foreach ($medicos as $value) { ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->nombre; ?></option>
                              <?php } ?>
                          </select>
									        <div class="label label-danger"><?php echo e($errors->first("medico_id")); ?></div>
									     </div>
									  </div>
									  <!-- Medico_id End -->
                  <?php } else { ?>
                    <input type="hidden" class="form-control" name="medico_id" id="medico_id" value="<?php echo e(Auth::user()->medico_id); ?>" />
                  <?php } ?>

                    <!-- Comentarios Start -->
										<div class="col-md-12">
										 <div class="form-group">
										  <label for="comentarios" class="control-label"> Tipo de Nota </label>
                      <select id="tipo" name="tipo" class="form-control">
                        <option value=""> [-SELECCIONE-] </option>
                        <option value="1"> Analisis Laboratoriales </option>
                        <option value="2"> Estudios de Imagen </option>
                        <option value="3"> Medicamentos </option>
                      </select>
									   </div>
										</div>

										<!-- Comentarios End -->
										<!-- Comentarios Start -->
										<div class="col-md-12">
										 <div class="form-group">
										  <label for="comentarios" class="control-label"> Nota Medica </label>
                      <textarea class="form-control summernote" id="comentarios" name="comentarios"><?php echo e(isset($data->comentarios ) ? $data->comentarios  : old('comentarios')); ?></textarea>
                      <div class="label label-danger"><?php echo e($errors->first("comentarios")); ?></div>
									   </div>
										</div>
										<!-- Comentarios End -->

                    <input type="hidden" class="form-control" id="status" name="status" value="1">


                </form>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">

                <?php if(Auth::user()->permisos->addRecord == 1) { ?>
                  <button  class="btn btn-success" title="Agendar Cita" onclick="$('#formValidation').submit();">
                    <i class="fa fa-save fa-lg"></i>  Guardar
                  </button>
                <?php } ?>


                <button  class="btn btn-default" title="Cerrar Ventana" data-dismiss="modal" >
                  <i class="fa fa-times fa-lg"></i> Cerrar
                </button>

              </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPrint" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1200px !Important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel"> Imprimir </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <iframe id="contentIframe" src="" style="width:100%; height: 400px; border:0px;"></iframe>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button  class="btn btn-default" title="Cerrar Ventana" data-dismiss="modal" >
                  <i class="fa fa-times fa-lg"></i> Cerrar
                </button>

              </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script>

$(document).ready(function() {
	$('.summernote').summernote({
			height: 350, // set editor height
			minHeight: null, // set minimum height of editor
			maxHeight: null, // set maximum height of editor
			focus: false // set focus to editable area after initializing summernote
	});
	$('.inline-editor').summernote({
			airMode: true
	});
});
window.edit = function () {
		$(".click2edit").summernote()
}, window.save = function () {
		$(".click2edit").summernote('destroy');
}


function insertaNota(id) {

  $('#pacienteNotaId').val(id);

  $('#modalNota').modal({

    backdrop: 'static',

    keyboard: true,

    focus: true

  });

}

function imprime(id) {

  var  url = "<?php echo e(url('admin/pacientes/signos/')); ?>/" + id

  $('#contentIframe').attr('src',url);

  $('#modalPrint').modal({

    backdrop: 'static',

    keyboard: true,

    focus: true

  });

}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>