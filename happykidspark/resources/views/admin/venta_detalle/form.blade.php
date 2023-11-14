

												<!-- Id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="id" class="control-label"> Id </label>
													    <input type="text" class="form-control" id="id" name="id"
													    value="{{{ isset($data->id ) ? $data->id  : old('id') }}}">
													    <div class="label label-danger">{{ $errors->first("id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Id End -->
												
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
												
												<!-- Temporizador_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="temporizador_id" class="control-label"> Temporizador_id </label>
													    <input type="text" class="form-control" id="temporizador_id" name="temporizador_id"
													    value="{{{ isset($data->temporizador_id ) ? $data->temporizador_id  : old('temporizador_id') }}}">
													    <div class="label label-danger">{{ $errors->first("temporizador_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Temporizador_id End -->
												
												<!-- Cantidad Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="cantidad" class="control-label"> Cantidad </label>
													    <input type="text" class="form-control" id="cantidad" name="cantidad"
													    value="{{{ isset($data->cantidad ) ? $data->cantidad  : old('cantidad') }}}">
													    <div class="label label-danger">{{ $errors->first("cantidad") }}</div>
												   </div>
													</div>
												</div>
												<!-- Cantidad End -->
												
												<!-- Precio Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="precio" class="control-label"> Precio </label>
													    <input type="text" class="form-control" id="precio" name="precio"
													    value="{{{ isset($data->precio ) ? $data->precio  : old('precio') }}}">
													    <div class="label label-danger">{{ $errors->first("precio") }}</div>
												   </div>
													</div>
												</div>
												<!-- Precio End -->
												
												<!-- Importe Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="importe" class="control-label"> Importe </label>
													    <input type="text" class="form-control" id="importe" name="importe"
													    value="{{{ isset($data->importe ) ? $data->importe  : old('importe') }}}">
													    <div class="label label-danger">{{ $errors->first("importe") }}</div>
												   </div>
													</div>
												</div>
												<!-- Importe End -->
												
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
