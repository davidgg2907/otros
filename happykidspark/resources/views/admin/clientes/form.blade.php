<!-- Nombre Start -->
<div class="col-md-6">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="nombre" class="control-label"> Nombre </label>
		<div class="input-group mb-2">
	    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-id-card fa-lg"></i> </span>
	    <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="100"
	    value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
    </div>
	  <div class="label label-danger">{{ $errors->first("nombre") }}</div>
   </div>
	</div>
</div>
<!-- Nombre End -->

<!-- Telefono Start -->
<div class="col-md-3">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="telefono" class="control-label"> Telefono </label>
		<div class="input-group mb-2">
	    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-phone fa-lg"></i> </span>
			<input type="text" class="form-control" id="telefono" name="telefono" maxlength="15"
	    value="{{{ isset($data->telefono ) ? $data->telefono  : old('telefono') }}}">
		</div>
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
		<div class="input-group mb-2">
	    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-mobile fa-lg"></i> </span>
			<input type="text" class="form-control" id="celular" name="celular" required maxlength="15"
	    value="{{{ isset($data->celular ) ? $data->celular  : old('celular') }}}">
		</div>
	  <div class="label label-danger">{{ $errors->first("celular") }}</div>
   </div>
	</div>
</div>
<!-- Celular End -->

<!-- Direccion Start -->
<div class="col-md-12">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="direccion" class="control-label"> Direccion </label>
		<div class="input-group mb-2">
	    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-home fa-lg"></i> </span>
			<input type="text" class="form-control" id="direccion" name="direccion" maxlength="150"
	    value="{{{ isset($data->direccion ) ? $data->direccion  : old('direccion') }}}">
		</div>
	   <div class="label label-danger">{{ $errors->first("direccion") }}</div>
   </div>
	</div>
</div>
<!-- Direccion End -->

<input type="hidden" class="form-control" id="status" name="status" value="{{{ isset($data->status ) ? $data->status  : '1' }}}">



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
