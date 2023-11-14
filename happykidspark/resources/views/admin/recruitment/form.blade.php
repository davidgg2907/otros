

												<!-- Nombre Start -->
												<div class="col-md-6">
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
												
												<!-- Edad Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="edad" class="control-label"> Edad </label>
													    <input type="text" class="form-control" id="edad" name="edad"
													    value="{{{ isset($data->edad ) ? $data->edad  : old('edad') }}}">
													    <div class="label label-danger">{{ $errors->first("edad") }}</div>
												   </div>
													</div>
												</div>
												<!-- Edad End -->
												
												<!-- Edo_civil Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="edo_civil" class="control-label"> Edo_civil </label>
													    <input type="text" class="form-control" id="edo_civil" name="edo_civil"
													    value="{{{ isset($data->edo_civil ) ? $data->edo_civil  : old('edo_civil') }}}">
													    <div class="label label-danger">{{ $errors->first("edo_civil") }}</div>
												   </div>
													</div>
												</div>
												<!-- Edo_civil End -->
												
												<!-- Escolaridad Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="escolaridad" class="control-label"> Escolaridad </label>
													    <input type="text" class="form-control" id="escolaridad" name="escolaridad"
													    value="{{{ isset($data->escolaridad ) ? $data->escolaridad  : old('escolaridad') }}}">
													    <div class="label label-danger">{{ $errors->first("escolaridad") }}</div>
												   </div>
													</div>
												</div>
												<!-- Escolaridad End -->
												
												<!-- Experiencia Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="experiencia" class="control-label"> Experiencia </label>
													    <input type="text" class="form-control" id="experiencia" name="experiencia"
													    value="{{{ isset($data->experiencia ) ? $data->experiencia  : old('experiencia') }}}">
													    <div class="label label-danger">{{ $errors->first("experiencia") }}</div>
												   </div>
													</div>
												</div>
												<!-- Experiencia End -->
												
												<!-- Habilidades Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="habilidades" class="control-label"> Habilidades </label>
													    <input type="text" class="form-control" id="habilidades" name="habilidades"
													    value="{{{ isset($data->habilidades ) ? $data->habilidades  : old('habilidades') }}}">
													    <div class="label label-danger">{{ $errors->first("habilidades") }}</div>
												   </div>
													</div>
												</div>
												<!-- Habilidades End -->
												
												<!-- Fortalezas Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="fortalezas" class="control-label"> Fortalezas </label>
													    <input type="text" class="form-control" id="fortalezas" name="fortalezas"
													    value="{{{ isset($data->fortalezas ) ? $data->fortalezas  : old('fortalezas') }}}">
													    <div class="label label-danger">{{ $errors->first("fortalezas") }}</div>
												   </div>
													</div>
												</div>
												<!-- Fortalezas End -->
												
												<!-- Debilidades Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="debilidades" class="control-label"> Debilidades </label>
													    <input type="text" class="form-control" id="debilidades" name="debilidades"
													    value="{{{ isset($data->debilidades ) ? $data->debilidades  : old('debilidades') }}}">
													    <div class="label label-danger">{{ $errors->first("debilidades") }}</div>
												   </div>
													</div>
												</div>
												<!-- Debilidades End -->
												
												<!-- Telefono Start -->
												<div class="col-md-6">
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
												

											    <!-- Cv Start -->
											    <div class="col-md-6">
														<div class="form-group">
											      	<label for="address" class="control-label"> Cv </label>
												      <input type="file" name="cv" class="dropify" />
												      <input type="hidden" name="old_cv" value="<?php if (isset($data->cv) && $data->cv!=""){echo $data->cv; } ?>" />
											        <div class="label label-danger">{{ $errors->first("cv") }}</div>
											      </div>
											    </div>
											    <!-- Cv End -->

											    



@section('scripts')

<script>

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
