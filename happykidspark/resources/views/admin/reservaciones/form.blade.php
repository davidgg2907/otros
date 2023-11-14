<!-- Cliente_id Start -->
<div class="col-md-8">
	<div class="mb-1">
		<label for="tutor" class="control-label"> Cliente que desea reservar </label>
	 <div class="form-group">
		<select class="form-control" id="cliente_id" name="cliente_id" required>
			<option value="">[ Seleccione ]</option>
			@foreach(\App\admin\Clientes::where('status',1)->get() as $value)
				<option value="{{ $value->id }}" @if($data->cliente_id = $value->id)  selected @endif> {{ $value->nombre }} </option>
			@endforeach
		</select>
		<div class="label label-danger">{{ $errors->first("cliente_id") }}</div>
	 </div>
	</div>
</div>
<!-- Cliente_id End -->

<!-- Fecha_reserva Start -->
<div class="col-md-4">
	<div class="mb-1">
	 <div class="form-group">
		<label for="fecha_reserva" class="control-label"> Fecha_reserva </label>
			<input type="text" class="form-control flatpickr-basic flatpickr-input" id="fecha_reserva" name="fecha_reserva"
			value="{{{ isset($data->fecha_reserva ) ? $data->fecha_reserva  : old('fecha_reserva') }}}">
			<div class="label label-danger">{{ $errors->first("fecha_reserva") }}</div>
	 </div>
	</div>
</div>
<!-- Fecha_reserva End -->


<!-- Fecha_reserva Start -->
<div class="col-md-6">
	<div class="mb-1">
	 <div class="form-group">
		<label for="tutor" class="control-label"> Nombre del Tutor o nombre que aparecera en las pulseras </label>
			<input type="text" class="form-control" id="tutor" name="tutor"
			value="{{{ isset($data->tutor ) ? $data->tutor  : old('tutor') }}}">
			<div class="label label-danger">{{ $errors->first("tutor") }}</div>
	 </div>
	</div>
</div>

<div class="col-md-3">
	<div class="mb-1">
	 <div class="form-group">
		<label for="telefono" class="control-label"> No Telefono </label>
			<input type="text" class="form-control" id="telefono" name="telefono"
			value="{{{ isset($data->telefono ) ? $data->telefono  : old('telefono') }}}">
			<div class="label label-danger">{{ $errors->first("telefono") }}</div>
	 </div>
	</div>
</div>
<!-- Fecha_reserva End -->

<!-- Fecha_reserva Start -->
<div class="col-md-3">
	<div class="mb-1">
	 <div class="form-group">
		<label for="cantidad" class="control-label"> Cantidad de Niños </label>
			<input type="text" class="form-control" id="cantidad" name="cantidad"
			value="{{{ isset($data->cantidad ) ? $data->cantidad  : old('cantidad') }}}">
			<div class="label label-danger">{{ $errors->first("cantidad") }}</div>
	 </div>
	</div>
</div>
<!-- Fecha_reserva End -->


<!-- Fecha_reserva Start -->
<?php $selecteds = explode(',',$data->productos_id); ?>
<div class="col-md-5">
	<div class="mb-1">
	 <div class="form-group">
		<label for="productos" class="control-label"> Productos que desea reservas </label>
		<select class="form-control select2" id="productos" name="productos">
			@foreach(\App\admin\Productos::where('status',1)->where('tipo',2)->get() as $prods)
			<option value="{{ $prods->id }}" @if(in_array($prods->id,$selecteds)) selected @endif>{{ $prods->nombre }}</option>
			@endforeach
		</select>
		<div class="label label-danger">{{ $errors->first("cantidad") }}</div>
	 </div>
	</div>
</div>

<div class="col-md-4">
	<div class="mb-1">
	 <div class="form-group">
		<label for="productos" class="control-label"> Tiempo de Uso </label>
		<select class="form-control" id="tiempo_id" name="tiempo_id">
			@foreach(\App\admin\Tiempos::where('status',1)->get() as $prods)
			<option value="{{ $prods->id }}">{{ $prods->minutos }} Minutos</option>
			@endforeach
		</select>
		<div class="label label-danger">{{ $errors->first("cantidad") }}</div>
	 </div>
	</div>
</div>



<div class="col-md-3">
	<div class="mb-1">
	 <div class="form-group">
		<label for="productos" class="control-label"> Bandas a Usar </label>
		<select class="form-control" id="banda_id" name="banda_id">
			<option value=""> [ SELECCIONE ] </option>
			@foreach(\App\admin\Bandas::where('status',1)->get() as $bandas)
			<option value="{{ $bandas->id }}" @if($data->banda_id == $bandas->id) selected @endif>{{ $bandas->color }} {{ $bandas->serie }}{{ $bandas->inicia }} -> {{ $bandas->serie }}{{ $bandas->termina }} </option>
			@endforeach
		</select>
		<div class="label label-danger">{{ $errors->first("cantidad") }}</div>
	 </div>
	</div>
</div>

<!-- Fecha_reserva End -->

@section('scripts')

<script>

var bootstrapForm = $('.needs-validation'),
	jqForm = $('#jquery-val-form');

$('.select2').select2();
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
