

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
												
												<!-- Fechadenacimiento Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="fechadenacimiento" class="control-label"> Fechadenacimiento </label>
													    <input type="text" class="form-control" id="fechadenacimiento" name="fechadenacimiento"
													    value="{{{ isset($data->fechadenacimiento ) ? $data->fechadenacimiento  : old('fechadenacimiento') }}}">
													    <div class="label label-danger">{{ $errors->first("fechadenacimiento") }}</div>
												   </div>
													</div>
												</div>
												<!-- Fechadenacimiento End -->
												
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
												
												<!-- Fechaaplicacion Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="fechaaplicacion" class="control-label"> Fechaaplicacion </label>
													    <input type="text" class="form-control" id="fechaaplicacion" name="fechaaplicacion"
													    value="{{{ isset($data->fechaaplicacion ) ? $data->fechaaplicacion  : old('fechaaplicacion') }}}">
													    <div class="label label-danger">{{ $errors->first("fechaaplicacion") }}</div>
												   </div>
													</div>
												</div>
												<!-- Fechaaplicacion End -->
												
												<!-- Area Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="area" class="control-label"> Area </label>
													    <input type="text" class="form-control" id="area" name="area"
													    value="{{{ isset($data->area ) ? $data->area  : old('area') }}}">
													    <div class="label label-danger">{{ $errors->first("area") }}</div>
												   </div>
													</div>
												</div>
												<!-- Area End -->
												
												<!-- Organizacion Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="organizacion" class="control-label"> Organizacion </label>
													    <input type="text" class="form-control" id="organizacion" name="organizacion"
													    value="{{{ isset($data->organizacion ) ? $data->organizacion  : old('organizacion') }}}">
													    <div class="label label-danger">{{ $errors->first("organizacion") }}</div>
												   </div>
													</div>
												</div>
												<!-- Organizacion End -->
												



@section('scripts')

<script>

var bootstrapForm = $('.needs-validation'),
	jqForm = $('#jquery-val-form');


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
