<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Datos Generales</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Medico_id Start -->
				<div class="col-md-12">
					<div class="form-group">
							<label for="medico_id" class="control-label"> Medico que genera el ingreso </label>
							<div class="input-group">
								<input type="text" class="form-control" name="medico_nombre" id="medico_nombre" value="{{ $data->medico_id != "" ? $data->doctor->nombre :  old('medico_nombre') }}" readonly/>
								<input type="hidden" name="medico_id" id="medico_id" value="{{ $data->medico_id != "" ? $data->medico_id :  old('medico_id') }}"/>
								<span class="input-group-btn">
									<button type="button" class="btn waves-effect waves-light btn-info" onclick="buscarMedicos();"><i class="fa fa-search"></i></button>
								</span>
							</div>
							<div class="label label-danger">{{ $errors->first("medico_id") }}</div>
					 </div>
				</div>
				<!-- Medico_id End -->


				<!-- Paciente_id Start -->
				<div class="col-md-6">
					<div class="form-group">
							<label for="paciente_id" class="control-label"> Paciente Ingresado </label>
							<div class="input-group">
								<input type="text" class="form-control" name="paciente_nombre" id="paciente_nombre" value="{{ $data->paciente_id != "" ? $data->paciente->nombre: old('paciente_nombre') }}" readonly/>
								<input type="hidden" name="paciente_id" id="paciente_id" value="{{ $data->paciente_id != "" ? $data->paciente_id: old('paciente_id') }}"/>
								<span class="input-group-btn">
									<button type="button" class="btn waves-effect waves-light btn-info" onclick="buscaPaciente();"><i class="fa fa-search"></i></button>
								</span>
							</div>
							<div class="label label-danger">{{ $errors->first("paciente_id") }}</div>
					 </div>
				</div>
				<!-- Paciente_id End -->


				<!-- Cuarto_id Start -->
				<div class="col-md-6">
					<div class="form-group">
							<label for="cuarto_id" class="control-label"> Cuarto Asignado </label>
							<select id="cuarto_id" name="cuarto_id" class="form-control">
									<option value=""> [-SELECCIONE-] </option>
									<?php foreach ($cuartos as $value) { ?>
										 <option value="<?php echo $value->id; ?>" <?php if($data->cuarto_id == $value->id) { echo 'selected'; }?>><?php echo $value->descripcion; ?></option>
									<?php } ?>
							</select>
							<div class="label label-danger">{{ $errors->first("cuarto_id") }}</div>
					 </div>
				</div>
				<!-- Cuarto_id End -->

			</div>
		</div>
	</div>
</div>


<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading"> Motivo del ingreso a hospitalizacion</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Recomendaciones Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <textarea class="form-control summernote" id="motivo" name="motivo">{{{ isset($data->motivo ) ? $data->motivo  : old('motivo') }}}</textarea>
						<div class="label label-danger">{{ $errors->first("recomendaciones") }}</div>
				 </div>
				</div>
				<!-- Recomendaciones End -->
			</div>
		</div>
	</div>
</div>


<!--START agregamos el servicio de hospedaje -->
	<input type="hidden" name="concepto" class="form-control" value="{{ $empresa->hospedaje }}"/>
	<input type="hidden" name="cantidad" class="form-control" value="1"/>
	<input type="hidden" name="precio" id="precio_hospitalizacion" class="form-control" value="0"/>
	<input type="hidden" name="iva_hospitalizacion" id="iva_hospitalizacion" class="form-control" value="0"/>
	<input type="hidden" name="importe" id="importe_hospitalizacion" class="form-control montos" value="0" readonly/>
<!--END agregamos el servicio de hospedaje -->

<input type="hidden" class="form-control" id="subtotal" name="subtotal" value="0">
<input type="hidden" class="form-control" id="iva" name="iva" value="0">
<input type="hidden" class="form-control" id="total" name="total" value="0">
<input type="hidden" class="form-control" id="status" name="status" value="1">


@include('admin.buscadores.medicos')

@include('admin.buscadores.pacientes')

@section('scripts')
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


@include('admin.buscadores.medscript')

@include('admin.buscadores.pacscript')

$('#cuarto_id').on('change',function(){

	if($(this).val() != "") {
		$.ajax({
			url: "{{ url('admin/cuartos/ajax') }}/" +  $(this).val(),
			dataType: 'json',
			contentType: "application/json; charset=utf-8",
			success: function(json) {

				if(json['error'] == 0) {

	        var costo_dia = parseFloat(json['data'].costo_dia);

					var iva = 0;

					var subtotal = 0;

					var importe = 0;

					if(isNaN(costo_dia)) {costo_dia = 0;}

					if(costo_dia <= 0) {
						swal({ title: "¡¡ ATENCION !!", text: 'La Habitacion seleccionada no cuenta con un costo por dia, realice la correccion para continuar', type: "error"});
						return false;
					}

					<?php if($empresa->hospedaje_iva == 1) { ?>
						iva = costo_dia * <?php echo ($empresa->impuesto / 100); ?>;
						subtotal = costo_dia + iva
					<?php } else {?>
						subtotal = costo_dia;
					<?php } ?>
					 importe = subtotal;

					 $('#precio_hospitalizacion').val(costo_dia.toFixed(2));
					 $('#iva_hospitalizacion').val(iva.toFixed(2));
					 $('#importe_hospitalizacion').val(importe.toFixed(2));

	      } else {

	        swal({ title: "ERROR!!", text: json['msg'], type: "error"});

	      }


			}

		});
	}

});

</script>

@endsection
