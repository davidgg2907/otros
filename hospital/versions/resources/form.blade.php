<div class="col-md-12" <?php if(!$general_view) { echo 'style="display:block"'; }?>>
	<div class="panel panel-default">
		<div class="panel-heading">Informacion General </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Paciente_id Start -->
				<div class="col-md-12">
					<div class="form-group">
							<label for="paciente_id" class="control-label"> Paciente </label>

							<div class="input-group">
								<input type="text" class="form-control" name="paciente_nombre" id="paciente_nombre" value="" readonly/>
								<input type="hidden" name="paciente_id" id="paciente_id" value="{{{ isset($data->paciente_id ) ? $data->paciente_id  : old('paciente_id') }}}"/>
								<span class="input-group-btn">
									<button type="button" class="btn waves-effect waves-light btn-info" onclick="buscaPaciente();"><i class="fa fa-search"></i></button>
								</span>
							</div>
							<input type="hidden" class="form-control" id="cita_id" name="cita_id" value="{{{ isset($data->cita_id ) ? $data->cita_id  : old('cita_id') }}}">
							<div class="label label-danger">{{ $errors->first("paciente_id") }}</div>
					 </div>
				</div>
				<!-- Paciente_id End -->

				<!-- Doctor_id Start -->
				<div class="col-md-8">
					<div class="form-group">



							<?php if(Auth::user()->medico_id == 0) { ?>
								<label for="medico_id" class="control-label"> Doctor que lo atendio </label>

								<div class="input-group">
									<input type="text" class="form-control" name="medico_nombre" id="medico_nombre" value="" readonly/>
									<input type="hidden" name="doctor_id" id="medico_id" value="{{{ isset($data->medico_id ) ? $data->medico_id  : old('medico_id') }}}"/>
									<span class="input-group-btn">
										<button type="button" class="btn waves-effect waves-light btn-info" onclick="buscarMedicos();"><i class="fa fa-search"></i></button>
									</span>
								</div>

							<?php } else { ?>

								<input type="hidden" class="form-control" name="doctor_id" id="doctor_id" value="{{ Auth::user()->medico_id }}" />

							<?php } ?>


							<input type="hidden" class="form-control" id="enfermera_id" name="enfermera_id" value="{{{ isset($data->enfermera_id ) ? $data->enfermera_id  : old('enfermera_id') }}}">

							<input type="hidden" class="form-control" id="signos_id" name="signos_id" value="{{{ isset($data->signos_id ) ? $data->signos_id  : old('signos_id') }}}">

							<div class="label label-danger">{{ $errors->first("doctor_id") }}</div>
					 </div>
				</div>
				<!-- Doctor_id End -->

				<div class="col-md-4">
				 <div class="form-group">
					<label for="rfc" class="control-label"> Costo del Servicio </label>
						<input type="text" class="form-control" id="costo" name="costo"
						value="{{{ isset($data->costo ) ? $data->costo  : old('costo') }}}">
				 </div>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="col-md-12" id="step1">
	<div class="panel panel-default">
		<div class="panel-heading"> Motivo de la Visita ( Sintomas o malestares )</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Razon_visita Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <textarea class="form-control summernote" id="razon_visita" name="razon_visita">{{{ isset($data->razon_visita ) ? $data->razon_visita  : old('razon_visita') }}}</textarea>
					 <div class="label label-danger">{{ $errors->first("razon_visita") }}</div>
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
		<div class="panel-heading"> Diagnostico</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Diagnostico Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <textarea class="form-control summernote" id="diagnostico" name="diagnostico">{{{ isset($data->diagnostico ) ? $data->diagnostico  : old('diagnostico') }}}</textarea>
					 <div class="label label-danger">{{ $errors->first("diagnostico") }}</div>
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
		<div class="panel-heading"> Receta: Medicamentos y prescripcion medica, </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Recomendaciones Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <textarea class="form-control summernote" id="medicamentos" name="medicamentos">{{{ isset($data->medicamentos ) ? $data->medicamentos  : old('medicamentos') }}}</textarea>
						<div class="label label-danger">{{ $errors->first("medicamentos") }}</div>
				 </div>
				</div>
				<!-- Recomendaciones End -->
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="pull-left">
						<button type="button" class="btn btn-default" onclick="steps(3,2)"><span class="btn-label"><i class="fa fa-arrow-left fa-lg"></i></span>Atras </button>
					</div>
					<div class="pull-right">
						<button type="button" class="btn btn-info" onclick="steps(3,4)" ><span class="btn-label"><i class="fa fa-commenting fa-lg"></i></span>Agregar Recomendaciones </button>

						<button type="button" class="btn btn-success" onclick="finalizar()" ><span class="btn-label"><i class="fa fa-check-circle fa-lg"></i></span>Finalizar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12" id="step4" style="display: none">
	<div class="panel panel-default">
		<div class="panel-heading"> Recomendaciones adicionales</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Recomendaciones Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <textarea class="form-control summernote" id="recomendaciones" name="recomendaciones">{{{ isset($data->recomendaciones ) ? $data->recomendaciones  : old('recomendaciones') }}}</textarea>
						<div class="label label-danger">{{ $errors->first("recomendaciones") }}</div>
				 </div>
				</div>
				<!-- Recomendaciones End -->
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="pull-left">
						<button type="button" class="btn btn-default" onclick="steps(4,3)"><span class="btn-label"><i class="fa fa-arrow-left fa-lg"></i></span>Atras </button>
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



@include('admin.buscadores.medicos')

@include('admin.buscadores.pacientes')

@section('scripts')
<script>

function steps(anterior,siguiente) {

	var diagnostico = $('#diagnostico').val();

	var motivo 			= $('#razon_visita').val();

	if(siguiente == 2) {

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

	$('#step' + anterior).fadeOut();
	$('#step' + siguiente).fadeIn();

}


function finalizar() {

	var paciente_id = $('#paciente_id').val();

	var medico_id  	= $('#medico_id').val();

	var costo  			= $('#costo').val();

	if(!paciente_id) {
		swal({ title: " ¡ ATENCION !",
				text: "No hay registro de paciente asignado a la consulta, no se puede proceder con la solicitud",
				type: "warning"});
		return false;
	}


	if(!medico_id) {
		swal({ title: " ¡ ATENCION !",
				text: "No hay registro de medico asignado a la consulta, no se puede proceder con la solicitud",
				type: "warning"});
		return false;
	}

	if(!medico_id) {
		swal({ title: " ¡ ATENCION !",
				text: "No se ha especificado el costo de la consulta, no se puede proceder con la solicitud",
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

<?php if(Auth::user()->medico_id != 0) { echo "$('#doctor_id').trigger('change');"; }?>

@include('admin.buscadores.medscript')

@include('admin.buscadores.pacscript')

</script>

@endsection
