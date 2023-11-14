<div class="col-md-4">
	<div class="card">
			<div class="card-header">
					<h4 class="card-title">Logotipo</h4>
			</div>
			<div class="card-body">
				<div class="row">

					<!-- Photo Start -->
					<div class="col-md-12">
						<div class="align-self-center halfway-fab text-center" id="imgPreview">
								<?php if($data->logo) { ?>
									<img onclick="$('#profile_image').trigger('click')" src="{{ asset('uploads/empresa/' . $data->logo) }}" class="img-border gradient-summer" height="200" alt="Card image">
								<?php } else { ?>
									<img onclick="$('#profile_image').trigger('click')" src="{{ asset('/') }}images/portrait/small/avatar-s-4.jpg" class="img-border gradient-summer " height="220" alt="Card image">
								<?php } ?>
						</div>
						<input type="file" name="photo" class="images_select" id="profile_image" style="display:none" data-indice="0" />
					</div>
					<!-- Photo End -->

				</div>
			</div>
			<div class="card-footer">
				<div class="row">
				</div>
			</div>
		</div>
</div>

<div class="col-md-8">
	<div class="card">
			<div class="card-header">
					<h4 class="card-title">Datos Generales</h4>
			</div>
			<div class="card-body">
				<div class="row">

					<!-- Nombre Start -->
					<div class="col-md-12">
						<div class="mb-1">
						 <div class="form-group">
							<label for="nombre" class="control-label"> Nombre </label>
								<input type="text" class="form-control" id="nombre" name="nombre"
								value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
								<div class="label label-danger">{{ $errors->first("nombre") }}</div>
						 </div>
						</div>
					</div>
					<!-- Nombre End -->

					<!-- Correo Start -->
					<div class="col-md-6">
						<div class="mb-1">
						 <div class="form-group">
							<label for="correo" class="control-label"> Correo </label>
								<input type="text" class="form-control" id="correo" name="correo"
								value="{{{ isset($data->correo ) ? $data->correo  : old('correo') }}}">
								<div class="label label-danger">{{ $errors->first("correo") }}</div>
						 </div>
						</div>
					</div>
					<!-- Correo End -->

					<!-- Telefono Start -->
					<div class="col-md-3">
						<div class="mb-1">
						 <div class="form-group">
							<label for="telefono" class="control-label"> Telefono </label>
								<input type="text" class="form-control" id="telefono" name="telefono"
								value="{{{ isset($data->telefono ) ? $data->telefono  : old('telefono') }}}">
								<div class="label label-danger">{{ $errors->first("telefono") }}</div>
						 </div>
						</div>
					</div>
					<!-- Telefono End -->

					<!-- Celular Start -->
					<div class="col-md-3">
						<div class="mb-1">
						 <div class="form-group">
							<label for="celular" class="control-label"> Celular </label>
								<input type="text" class="form-control" id="celular" name="celular"
								value="{{{ isset($data->celular ) ? $data->celular  : old('celular') }}}">
								<div class="label label-danger">{{ $errors->first("celular") }}</div>
						 </div>
						</div>
					</div>
					<!-- Celular End -->

					<!-- Iva Start -->
					<div class="col-md-6">
						<div class="mb-1">
						 <div class="form-group">
							<label for="iva" class="control-label"> % I.V.A. </label>
								<input type="text" class="form-control" id="iva" name="iva"
								value="{{{ isset($data->iva ) ? $data->iva  : old('iva') }}}">
								<div class="label label-danger">{{ $errors->first("iva") }}</div>
						 </div>
						</div>
					</div>
					<!-- Iva End -->

					<!-- Ttraspaso Start -->
					<div class="col-md-6">
						<div class="mb-1">
						 <div class="form-group">
							<label for="ttraspaso" class="control-label"> Traspasos </label>
							<select class="form-control" id="ttraspaso" name="ttraspaso">
								<option value="1" <?php if($data->ttraspaso == 1) { echo 'selected'; } ?>>Automatico</option>
								<option value="2" <?php if($data->ttraspaso == 2) { echo 'selected'; } ?>>Con Autorizacion</option>
							</select>
								<div class="label label-danger">{{ $errors->first("ttraspaso") }}</div>
						 </div>
						</div>
					</div>
					<!-- Ttraspaso End -->


				</div>
			</div>
			<div class="card-footer">
				<div class="row">
				</div>
			</div>
		</div>
</div>

<div class="col-md-12">
	<div class="card">
			<div class="card-header">
					<h4 class="card-title">Domicilio</h4>
			</div>
			<div class="card-body">
				<div class="row">

					<!-- Direccion Start -->
					<div class="col-md-8">
						<div class="mb-1">
						 <div class="form-group">
							<label for="direccion" class="control-label"> Direccion </label>
								<input type="text" class="form-control" id="direccion" name="direccion"
								value="{{{ isset($data->direccion ) ? $data->direccion  : old('direccion') }}}">
								<div class="label label-danger">{{ $errors->first("direccion") }}</div>
						 </div>
						</div>
					</div>
					<!-- Direccion End -->

					<!-- Colonia Start -->
					<div class="col-md-4">
						<div class="mb-1">
						 <div class="form-group">
							<label for="colonia" class="control-label"> Colonia </label>
								<input type="text" class="form-control" id="colonia" name="colonia"
								value="{{{ isset($data->colonia ) ? $data->colonia  : old('colonia') }}}">
								<div class="label label-danger">{{ $errors->first("colonia") }}</div>
						 </div>
						</div>
					</div>
					<!-- Colonia End -->

					<!-- Estado Start -->
					<div class="col-md-5">
						<div class="mb-1">
						 <div class="form-group">
							<label for="estado" class="control-label"> Estado </label>
								<input type="text" class="form-control" id="estado" name="estado"
								value="{{{ isset($data->estado ) ? $data->estado  : old('estado') }}}">
								<div class="label label-danger">{{ $errors->first("estado") }}</div>
						 </div>
						</div>
					</div>
					<!-- Estado End -->

					<!-- Ciudad Start -->
					<div class="col-md-5">
						<div class="mb-1">
						 <div class="form-group">
							<label for="ciudad" class="control-label"> Ciudad </label>
								<input type="text" class="form-control" id="ciudad" name="ciudad"
								value="{{{ isset($data->ciudad ) ? $data->ciudad  : old('ciudad') }}}">
								<div class="label label-danger">{{ $errors->first("ciudad") }}</div>
						 </div>
						</div>
					</div>
					<!-- Ciudad End -->

					<!-- Cp Start -->
					<div class="col-md-2">
						<div class="mb-1">
						 <div class="form-group">
							<label for="cp" class="control-label"> Codigo Postal </label>
								<input type="text" class="form-control" id="cp" name="cp"
								value="{{{ isset($data->cp ) ? $data->cp  : old('cp') }}}">
								<div class="label label-danger">{{ $errors->first("cp") }}</div>
						 </div>
						</div>
					</div>
					<!-- Cp End -->
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
				</div>
			</div>
		</div>
</div>

<input type="hidden" class="form-control" id="icono" name="icono" value="{{{ isset($data->icono ) ? $data->icono  : old('icono') }}}">
<input type="hidden" class="form-control" id="status" name="status" value="1">


@section('scripts')

<script>



function readURL(input,indice) {
  if (input.files && input.files[0]) {
		$('#imgPreview' + indice).html('');
	  var reader = new FileReader();
    reader.onload = function(e) {
	   $('#imgPreview').html('<img src="' + e.target.result + '" class="rounded-circle img-border gradient-summer" height="200">');
    }
    reader.readAsDataURL(input.files[0]);
  } else {
    $('#imgPreview').attr('src', '<img src="{{ asset('/') }}/img/portrait/avatars/avatar-08.png" class="rounded-circle img-border gradient-summer " height="200" alt="Card image">');
  }
}

$(document).on('change', '.images_select', function () {

	var indice = $(this).attr('data-indice');

	readURL(this,indice);

});

var bootstrapForm = $('.needs-validation'),
	jqForm = $('#jquery-val-form'),
	picker = $('.picker'),
	select = $('.select2');

// select2
select.each(function () {
	var $this = $(this);
	$this.wrap('<div class="position-relative"></div>');
	$this
		.select2({
			placeholder: 'Select value',
			dropdownParent: $this.parent()
		})
		.change(function () {
			$(this).valid();
		});
});

// Picker
if (picker.length) {
	picker.flatpickr({
		allowInput: true,
		onReady: function (selectedDates, dateStr, instance) {
			if (instance.isMobile) {
				$(instance.mobileInput).attr('step', null);
			}
		}
	});
}

// Bootstrap Validation
// --------------------------------------------------------------------
if (bootstrapForm.length) {
	Array.prototype.filter.call(bootstrapForm, function (form) {
		form.addEventListener('submit', function (event) {
			if (form.checkValidity() === false) {
				form.classList.add('invalid');
			} else {
				procesando();
				form.submit();
			}

			form.classList.add('was-validated');
			event.preventDefault();

		});
	});
}

</script>

@endsection
