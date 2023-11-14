

												<!-- Venta_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="venta_id" class="control-label"> Venta_id </label>
													    <input type="text" class="form-control" id="venta_id" name="venta_id"
													    value="{{{ isset($data->venta_id ) ? $data->venta_id  : old('venta_id') }}}">
													    <div class="label label-danger">{{ $errors->first("venta_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Venta_id End -->
												
												<!-- Vtadetalle_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="vtadetalle_id" class="control-label"> Vtadetalle_id </label>
													    <input type="text" class="form-control" id="vtadetalle_id" name="vtadetalle_id"
													    value="{{{ isset($data->vtadetalle_id ) ? $data->vtadetalle_id  : old('vtadetalle_id') }}}">
													    <div class="label label-danger">{{ $errors->first("vtadetalle_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Vtadetalle_id End -->
												
												<!-- Cliente_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="cliente_id" class="control-label"> Cliente_id </label>
													    <input type="text" class="form-control" id="cliente_id" name="cliente_id"
													    value="{{{ isset($data->cliente_id ) ? $data->cliente_id  : old('cliente_id') }}}">
													    <div class="label label-danger">{{ $errors->first("cliente_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Cliente_id End -->
												
												<!-- Tiempo_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="tiempo_id" class="control-label"> Tiempo_id </label>
													    <input type="text" class="form-control" id="tiempo_id" name="tiempo_id"
													    value="{{{ isset($data->tiempo_id ) ? $data->tiempo_id  : old('tiempo_id') }}}">
													    <div class="label label-danger">{{ $errors->first("tiempo_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Tiempo_id End -->
												
												<!-- Producto_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="producto_id" class="control-label"> Producto_id </label>
													    <input type="text" class="form-control" id="producto_id" name="producto_id"
													    value="{{{ isset($data->producto_id ) ? $data->producto_id  : old('producto_id') }}}">
													    <div class="label label-danger">{{ $errors->first("producto_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Producto_id End -->
												
												<!-- Inicia Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="inicia" class="control-label"> Inicia </label>
													    <input type="text" class="form-control" id="inicia" name="inicia"
													    value="{{{ isset($data->inicia ) ? $data->inicia  : old('inicia') }}}">
													    <div class="label label-danger">{{ $errors->first("inicia") }}</div>
												   </div>
													</div>
												</div>
												<!-- Inicia End -->
												
												<!-- Termina Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="termina" class="control-label"> Termina </label>
													    <input type="text" class="form-control" id="termina" name="termina"
													    value="{{{ isset($data->termina ) ? $data->termina  : old('termina') }}}">
													    <div class="label label-danger">{{ $errors->first("termina") }}</div>
												   </div>
													</div>
												</div>
												<!-- Termina End -->
												
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
												
												<!-- Qr Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="qr" class="control-label"> Qr </label>
													    <input type="text" class="form-control" id="qr" name="qr"
													    value="{{{ isset($data->qr ) ? $data->qr  : old('qr') }}}">
													    <div class="label label-danger">{{ $errors->first("qr") }}</div>
												   </div>
													</div>
												</div>
												<!-- Qr End -->
												
												<!-- Barras Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="barras" class="control-label"> Barras </label>
													    <input type="text" class="form-control" id="barras" name="barras"
													    value="{{{ isset($data->barras ) ? $data->barras  : old('barras') }}}">
													    <div class="label label-danger">{{ $errors->first("barras") }}</div>
												   </div>
													</div>
												</div>
												<!-- Barras End -->
												
												<!-- Status Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="status" class="control-label"> Status </label>
													    <input type="text" class="form-control" id="status" name="status"
													    value="{{{ isset($data->status ) ? $data->status  : old('status') }}}">
													    <div class="label label-danger">{{ $errors->first("status") }}</div>
												   </div>
													</div>
												</div>
												<!-- Status End -->
												



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
