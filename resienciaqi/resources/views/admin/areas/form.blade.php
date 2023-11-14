<!-- Delegacion_id Start -->
<div class="col-md-12">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="delegacion_id" class="control-label"> Delegacion o empresa a la que pertenece </label>
		<select class="form-control" id="delegacion_id" name="delegacion_id">
			<option value="">[ Seleccione ]</option>
			<?php foreach(\App\admin\Delegaciones::where('status',1)->get() as $delegaciones) { ?>
				<option value="{{ $delegaciones->id }}" @if($delegaciones->id == $data->delegacion_id) selected @endif>{{ $delegaciones->nombre }}</option>
			<?php } ?>
		</select>
	    <div class="label label-danger">{{ $errors->first("delegacion_id") }}</div>
   </div>
	</div>
</div>
<!-- Delegacion_id End -->

<!-- Nombre Start -->
<div class="col-md-12">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="nombre" class="control-label"> Nombre del Area </label>
	    <input type="text" class="form-control" id="nombre" name="nombre"
	    value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
	    <div class="label label-danger">{{ $errors->first("nombre") }}</div>
   </div>
	</div>
</div>
<!-- Nombre End -->

<input type="text" class="form-control" id="status" name="status" value="1">




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
