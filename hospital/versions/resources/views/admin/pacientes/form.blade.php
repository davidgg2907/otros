<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">Fotografia </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body" style="padding:0px">
				<!-- Fotografia Start -->
				<input type="file" name="fotografia" class="dropify"
				<?php if($data->fotografia) { ?>
								data-default-file="<?= asset('/uploads/pacientes/' . $data->fotografia); ?>"
				<?php } ?>
				/>
				<input type="hidden" name="old_fotografia" value="<?php if (isset($data->fotografia) && $data->fotografia!=""){echo $data->fotografia; } ?>" />
				<div class="label label-danger">{{ $errors->first("fotografia") }}</div>
				<!-- Fotografia End -->
			</div>
		</div>
	</div>
</div>

<div class="col-md-8">
	<div class="panel panel-default">
		<div class="panel-heading">Datos Generales </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Nombre Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<label for="nombre" class="control-label"> Nombre </label>
						<input type="text" class="form-control" id="nombre" name="nombre"
						value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
						<div class="label label-danger">{{ $errors->first("nombre") }}</div>
				 </div>
				</div>
				<!-- Nombre End -->

				<!-- Telefono Start -->
				<div class="col-md-4">
				 <div class="form-group">
					<label for="telefono" class="control-label"> Telefono </label>
						<input type="text" class="form-control" id="telefono" name="telefono"
						value="{{{ isset($data->telefono ) ? $data->telefono  : old('telefono') }}}">
						<div class="label label-danger">{{ $errors->first("telefono") }}</div>
				 </div>
				</div>
				<!-- Telefono End -->

				<!-- Celular Start -->
				<div class="col-md-4">
				 <div class="form-group">
					<label for="celular" class="control-label"> Celular </label>
						<input type="text" class="form-control" id="celular" name="celular"
						value="{{{ isset($data->celular ) ? $data->celular  : old('celular') }}}">
						<div class="label label-danger">{{ $errors->first("celular") }}</div>
				 </div>
				</div>
				<!-- Celular End -->

				<!-- Sexo Start -->
				<div class="col-md-4">
				 <div class="form-group">
					<label for="sexo" class="control-label"> Sexo </label>
					<select class="form-control" id="sexo" name="sexo">
						<option value="">[-SELECCIONE-]</option>
						<option value="F">FEMENINO</option>
						<option value="M">MASCULINO</option>
					</select>
					<div class="label label-danger">{{ $errors->first("sexo") }}</div>
				 </div>
				</div>
				<!-- Sexo End -->



				<!-- Tsangre Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="tsangre" class="control-label"> Tsangre </label>
						<input type="text" class="form-control" id="tsangre" name="tsangre"
						value="{{{ isset($data->tsangre ) ? $data->tsangre  : old('tsangre') }}}">
						<div class="label label-danger">{{ $errors->first("tsangre") }}</div>
				 </div>
				</div>
				<!-- Tsangre End -->



				<!-- Nacimiento Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="nacimiento" class="control-label" style="padding-left:15px"> Nacimiento </label>
					<input type="text" class="form-control dates" id="nacimiento" name="nacimiento"
					value="{{{ isset($data->nacimiento ) ? $data->nacimiento  : old('nacimiento') }}}">
					<div class="label label-danger">{{ $errors->first("nacimiento") }}</div>
				 </div>
				</div>
				<!-- Nacimiento End -->


				<!-- Domicilio Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<label for="domicilio" class="control-label"> Domicilio </label>
					<textarea class="form-control" id="domicilio" name="domicilio">{{{ isset($data->domicilio ) ? $data->domicilio  : old('domicilio') }}}</textarea>
					<div class="label label-danger">{{ $errors->first("domicilio") }}</div>
				 </div>
				</div>
				<!-- Domicilio End -->

			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading"> Antecedentes Hereditarios </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Hereditarias Start -->
				<div class="col-md-12">
				 <div class="form-group">
						<textarea class="form-control summernote" id="hereditarias" name="hereditarias">{{{ isset($data->hereditarias ) ? $data->hereditarias  : old('hereditarias') }}}</textarea>
						<div class="label label-danger">{{ $errors->first("hereditarias") }}</div>
				 </div>
				</div>
				<!-- Hereditarias End -->
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading"> Antecedentes Patologicos </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Alergias Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<textarea class="form-control summernote" id="alergias" name="alergias">{{{ isset($data->alergias ) ? $data->alergias  : old('alergias') }}}</textarea>
						<div class="label label-danger">{{ $errors->first("alergias") }}</div>
				 </div>
				</div>
				<!-- Alergias End -->
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading"> Padecimiento Actual </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Cirugias Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<textarea class="form-control summernote" id="cirugias" name="cirugias">{{{ isset($data->cirugias ) ? $data->cirugias  : old('cirugias') }}}</textarea>
					<div class="label label-danger">{{ $errors->first("cirugias") }}</div>
				 </div>
				</div>
				<!-- Cirugias End -->
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading"> Exploracion Fisica </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Vicios Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<textarea class="form-control summernote" id="mymce" name="vicios">{{{ isset($data->vicios ) ? $data->vicios  : old('vicios') }}}</textarea>
					<div class="label label-danger">{{ $errors->first("vicios") }}</div>
				 </div>
				</div>
				<!-- Vicios End -->

			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading"> Diagnostico </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Vicios Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<textarea class="form-control summernote" id="mymce" name="diagnostico">{{{ isset($data->diagnostico ) ? $data->diagnostico  : old('diagnostico') }}}</textarea>
					<div class="label label-danger">{{ $errors->first("diagnostico") }}</div>
				 </div>
				</div>
				<!-- Vicios End -->

			</div>
		</div>
	</div>
</div>

<input type="hidden" class="form-control" id="status" name="status" value="1">

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


$('#clinico').on('click',function(){

	$('#modalSearch').modal({

    backdrop: 'static',

    keyboard: true,

    focus: true

  });

});
</script>

<style> .dropify-wrapper{ height: 380px; } .dropify-wrapper .dropify-preview{ padding:0px !important; } </style>

@endsection
