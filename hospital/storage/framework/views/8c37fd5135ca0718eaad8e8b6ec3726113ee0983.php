<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Informacion General </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Paciente_id Start -->
				<div class="col-md-12" <?php if(!$general_view) { echo 'style="display:none"'; }?>>
					<div class="form-group">
							<label for="paciente_id" class="control-label"> Paciente </label>

							<div class="input-group">
								<input type="text" class="form-control" name="paciente_nombre" id="paciente_nombre" value="<?php echo e($data->paciente->nombre); ?>" readonly/>
								<input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo e(isset($data->paciente_id ) ? $data->paciente_id  : old('paciente_id')); ?>"/>
								<span class="input-group-btn">
									<button type="button" class="btn waves-effect waves-light btn-info" onclick="buscaPaciente();"><i class="fa fa-search"></i></button>
								</span>
							</div>
							<input type="hidden" class="form-control" id="cita_id" name="cita_id" value="<?php echo e(isset($data->cita_id ) ? $data->cita_id  : old('cita_id')); ?>">
							<div class="label label-danger"><?php echo e($errors->first("paciente_id")); ?></div>
					 </div>
				</div>
				<!-- Paciente_id End -->

				<!-- Doctor_id Start -->
				<div class="col-md-8">
					<div class="form-group" <?php if(!$general_view) { echo 'style="display:block"'; }?>>
							<?php if(Auth::user()->medico_id == 0) { ?>
								<label for="medico_id" class="control-label"> Doctor que lo atendio </label>

								<div class="input-group">
									<input type="text" class="form-control" name="medico_nombre" id="medico_nombre" value="<?php echo e($data->doctor->nombre); ?>" readonly/>
									<input type="hidden" name="doctor_id" id="medico_id" value="<?php echo e(isset($data->medico_id ) ? $data->medico_id  : old('medico_id')); ?>"/>
									<span class="input-group-btn">
										<button type="button" class="btn waves-effect waves-light btn-info" onclick="buscarMedicos();"><i class="fa fa-search"></i></button>
									</span>
								</div>

							<?php } else { ?>

								<input type="hidden" class="form-control" name="doctor_id" id="medico_id" value="<?php echo e(Auth::user()->medico_id); ?>" />

							<?php } ?>


							<input type="hidden" class="form-control" id="enfermera_id" name="enfermera_id" value="<?php echo e(isset($data->enfermera_id ) ? $data->enfermera_id  : old('enfermera_id')); ?>">

							<input type="hidden" class="form-control" id="signos_id" name="signos_id" value="<?php echo e(isset($data->signos_id ) ? $data->signos_id  : old('signos_id')); ?>">

							<div class="label label-danger"><?php echo e($errors->first("doctor_id")); ?></div>
					 </div>
				</div>
				<!-- Doctor_id End -->

				<div class="col-md-4">
				 <div class="form-group">
					<label for="rfc" class="control-label"> Costo del Servicio </label>
						<input type="text" class="form-control" id="costo" name="costo"
						value="<?php echo e(isset($data->costo ) ? $data->costo  : old('costo')); ?>">
				 </div>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="col-md-12" id="step1">

	<div class="panel panel-default">
		<div class="panel-heading"> Signos Vitales </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<div class="col-md-3">
				 <div class="form-group">
					 <label for="fecha" class="control-label"> F.C </label>
					 <div class="input-group">
						 <input type="text" class="form-control" id="fc" name="fc"
						 value="<?php echo e(isset($data->fc ) ? $data->fc  : old('fc')); ?>">
							<span class="input-group-addon"> X </span>
						</div>
				 </div>
				</div>

				<div class="col-md-3">
				 <div class="form-group">
					 <label for="fecha" class="control-label"> F.R </label>
					 <div class="input-group">
						 <input type="text" class="form-control" id="fr" name="fr"
						 value="<?php echo e(isset($data->fr ) ? $data->fr  : old('fr')); ?>">
							<span class="input-group-addon"> X </span>
						</div>
				 </div>
				</div>

				<div class="col-md-3">
				 <div class="form-group">
					 <label for="fecha" class="control-label"> Temperatura </label>
					 <div class="input-group">
						 <input type="text" class="form-control" id="temperatura" name="temperatura"
						 value="<?php echo e(isset($data->temperatura ) ? $data->temperatura  : old('temperatura')); ?>">
							<span class="input-group-addon"> °C </span>
						</div>
				 </div>
				</div>

				<div class="col-md-3">
				 <div class="form-group">
					 <label for="fecha" class="control-label"> Peso </label>
					 <div class="input-group">
						 <input type="text" class="form-control" id="peso" name="peso"
						 value="<?php echo e(isset($data->peso ) ? $data->peso  : old('peso')); ?>">
							<span class="input-group-addon"> K.g </span>
						</div>
				 </div>
				</div>


				<div class="col-md-4">
				 <div class="form-group">
					 <label for="fecha" class="control-label"> Talla </label>
					 <div class="input-group">
						 <input type="text" class="form-control" id="talla" name="talla"
						 value="<?php echo e(isset($data->talla ) ? $data->talla  : old('talla')); ?>">
							<span class="input-group-addon"> C.m. </span>
						</div>
				 </div>
				</div>

				<div class="col-md-4">
				 <div class="form-group">
					 <label for="fecha" class="control-label"> T/A </label>
					 <div class="input-group">
						 <input type="text" class="form-control" id="t1" name="t1"
						 value="<?php echo e(isset($data->t1 ) ? $data->t1  : old('t1')); ?>">
							<span class="input-group-addon"> / </span>
							<input type="text" class="form-control" id="t2" name="t2"
 						 value="<?php echo e(isset($data->t2 ) ? $data->t2  : old('t2')); ?>">
						</div>
				 </div>
				</div>

				<div class="col-md-4">
				 <div class="form-group">
					 <label for="fecha" class="control-label"> Saturacion 	O<sup>2</sup> </label>
					 <div class="input-group">
						 <input type="text" class="form-control" id="t1" name="sato2"
						 value="<?php echo e(isset($data->sato2 ) ? $data->sato2  : old('sato2')); ?>">
							<span class="input-group-addon"> % </span>
						</div>
				 </div>
				</div>

			</div>
		</div>
	</div>


	<div class="panel panel-default">
		<div class="panel-heading"> Seguimiento Clinico </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Razon_visita Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <textarea class="form-control summernote" id="razon_visita" name="razon_visita"><?php echo e(isset($data->razon_visita ) ? $data->razon_visita  : old('razon_visita')); ?></textarea>
					 <div class="label label-danger"><?php echo e($errors->first("razon_visita")); ?></div>
				 </div>
				</div>
				<!-- Razon_visita End -->
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="pull-right">
						<button type="button" class="btn btn-info" onclick="steps(1,2)" ><span class="btn-label"><i class="fa fa-arrow-right fa-lg"></i></span>Siguiente </button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12" id="step2" style="display: none">
	<div class="panel panel-default">
		<div class="panel-heading"> Diagnostico Clinico</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Diagnostico Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <textarea class="form-control summernote" id="diagnostico" name="diagnostico"><?php echo e(isset($data->diagnostico ) ? $data->diagnostico  : old('diagnostico')); ?></textarea>
					 <input type="hidden" class="form-control" id="recomendaciones" name="recomendaciones" value="<?php echo e(isset($data->recomendaciones ) ? $data->recomendaciones  : old('recomendaciones')); ?>"/>
					 <div class="label label-danger"><?php echo e($errors->first("diagnostico")); ?></div>
				 </div>
				</div>
				<!-- Diagnostico End -->
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="pull-left">
						<button type="button" class="btn btn-default" onclick="steps(2,1)"><span class="btn-label"><i class="fa fa-arrow-left fa-lg"></i></span>Atras </button>
					</div>
					<div class="pull-right">
						<button type="button" class="btn btn-info" onclick="steps(2,3)" ><span class="btn-label"><i class="fa fa-arrow-right fa-lg"></i></span>Siguiente </button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12" id="step3" style="display: none">
	<div class="panel panel-default">
		<div class="panel-heading"> Tratamiento Clinico</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Diagnostico Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <textarea class="form-control summernote" id="tratamiento" name="tratamiento"><?php echo e(isset($data->tratamiento ) ? $data->tratamiento  : old('tratamiento')); ?></textarea>
					 <div class="label label-danger"><?php echo e($errors->first("tratamiento")); ?></div>
				 </div>
				</div>
				<!-- Diagnostico End -->
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="pull-left">
						<button type="button" class="btn btn-default" onclick="steps(2,3)"><span class="btn-label"><i class="fa fa-arrow-left fa-lg"></i></span>Atras </button>
					</div>
					<div class="pull-right">
						<button type="button" class="btn btn-info" onclick="steps(3,4)" ><span class="btn-label"><i class="fa fa-arrow-right fa-lg"></i></span>Siguiente </button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12" id="step4" style="display: none">
	<div class="panel panel-default">
		<div class="panel-heading"> Receta: Medicamentos y prescripcion medica, </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Recomendaciones Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <textarea class="form-control summernote" id="medicamentos" name="medicamentos"><?php echo e(isset($data->medicamentos ) ? $data->medicamentos  : old('medicamentos')); ?></textarea>
						<div class="label label-danger"><?php echo e($errors->first("medicamentos")); ?></div>
				 </div>
				</div>
				<!-- Recomendaciones End -->
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="pull-left">
						<button type="button" class="btn btn-default" onclick="steps(3,4)"><span class="btn-label"><i class="fa fa-arrow-left fa-lg"></i></span>Atras </button>
					</div>
					<div class="pull-right">
						<button type="button" class="btn btn-success" onclick="finalizar()" ><span class="btn-label"><i class="fa fa-check-circle fa-lg"></i></span>Finalizar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" class="form-control" id="status" name="status" value="1">


<div class="modal fade" id="expediente" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel"> Informacion de la Cita </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding:8px !Important">
							<div class="row" id="historial_html" style="background: #C9C9C9; padding: 15px;"></div>
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

<?php echo $__env->make('admin.buscadores.medicos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('admin.buscadores.pacientes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection('scripts'); ?>
<script>

function steps(anterior,siguiente) {

	var diagnostico = $('#diagnostico').val();

	var tratamiento = $('#tratamiento').val();

	var motivo 			= $('#razon_visita').val();

	if(siguiente == 2) {

		if($('#paciente_id').val() == "") {

			swal({ title: " ¡ ATENCION !",
					text: "No hay registro de paciente asignado a la consulta, no se puede proceder con la solicitud",
					type: "warning"});

			return false;
		}


		if($('#medico_id').val() == "") {

			swal({ title: " ¡ ATENCION !",
					text: "No hay registro de medico asignado a la consulta, no se puede proceder con la solicitud",
					type: "warning"});
			return false;
		}

		if(!motivo) {

			swal({ title: " ¡ ATENCION !",
					text: "Debe especificar el motivo o razon de visita del paciente para continuar",
					type: "warning"});
			return false;

		}

	}

	if(siguiente == 3) {

		if(!diagnostico) {
			swal({ title: " ¡ ATENCION !",
					text: "Debe especificar el diagnostico para continuar con el proceso",
					type: "warning"});
			return false;
		}

	}

	if(siguiente == 4) {

		if(!tratamiento) {
			swal({ title: " ¡ ATENCION !",
					text: "Debe especificar el tratamiento que se llevara acabo en el paciente",
					type: "warning"});
			return false;
		}

	}


	if(siguiente < 4) {

		$('#step' + anterior).fadeOut();
		$('#step' + siguiente).fadeIn();

	} else {

		swal({
				title: "Emitir Receta",
				text: "¿ Desea crear una receta para contiar ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "SI, Emitir",
				cancelButtonText: "No, Finalizar",
				closeOnConfirm: true,
				closeOnCancel: true
		}, function(isConfirm){
				if (isConfirm) {

					$('#step' + anterior).fadeOut();
					$('#step' + siguiente).fadeIn();

				} else {

 					$('#formValidation').submit();
				}

		});

	}

}

function finalizar() {

	if($('#paciente_id').val() == "") {

		swal({ title: " ¡ ATENCION !",
				text: "No hay registro de paciente asignado a la consulta, no se puede proceder con la solicitud",
				type: "warning"});

		return false;
	}


	if($('#medico_id').val() == "") {
		alert('no hay medico seleccionado');
		swal({ title: " ¡ ATENCION !",
				text: "No hay registro de medico asignado a la consulta, no se puede proceder con la solicitud",
				type: "warning"});
		return false;
	}

	$('#formValidation').submit();

}

$(document).ready(function() {
	$('.summernote').summernote({
			height: 250, // set editor height
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

$('#medico_id').on('change',function(){

	$.ajax({
			url: "<?php echo url('admin/medicos/ajax'); ?>/" + $(this).val(),
			dataType: 'json',
			contentType: "application/json; charset=utf-8",
			success: function(json) {

				if(json['error'] == 0) {
					$('#costo').val(json['data'].honorarios);

				} else {

					swal({ title: "ERROR!!", text: json['msg'], type: "error"});

				}

			}
		});

});

$('#btnHclinico').on('click',function(){

	if($('#paciente_id').val() != "") {

		$.ajax({
				url: "<?php echo url('admin/paciente/historial/micro'); ?>/" + $('#paciente_id').val(),
				dataType: 'html',
				contentType: "application/json; charset=utf-8",
				success: function(html) {

					$('#historial_html').html(html);

					$('#expediente').modal({

						backdrop: 'static',

						keyboard: true,

						focus: true

					});

				}
			});

	} else {
		swal({ title: "¡¡ ERROR !!", text: "No ha seleccionado un paciente, no se puede proceder con la solicitud", type: "error"});
	}

});

<?php if($data->medico_id != 0) { echo "$('#medico_id').trigger('change');"; }?>

<?php if(Auth::user()->medico_id != 0) { echo " $('#medico_id').trigger('change');"; }?>

<?php echo $__env->make('admin.buscadores.medscript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('admin.buscadores.pacscript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


</script>

<?php $__env->stopSection(); ?>
