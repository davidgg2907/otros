

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
												
												<!-- Fecha Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="fecha" class="control-label"> Fecha </label>
													    <input type="text" class="form-control" id="fecha" name="fecha"
													    value="{{{ isset($data->fecha ) ? $data->fecha  : old('fecha') }}}">
													    <div class="label label-danger">{{ $errors->first("fecha") }}</div>
												   </div>
													</div>
												</div>
												<!-- Fecha End -->
												
												<!-- Costo Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="costo" class="control-label"> Costo </label>
													    <input type="text" class="form-control" id="costo" name="costo"
													    value="{{{ isset($data->costo ) ? $data->costo  : old('costo') }}}">
													    <div class="label label-danger">{{ $errors->first("costo") }}</div>
												   </div>
													</div>
												</div>
												<!-- Costo End -->
												
												<!-- Venta Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="venta" class="control-label"> Venta </label>
													    <input type="text" class="form-control" id="venta" name="venta"
													    value="{{{ isset($data->venta ) ? $data->venta  : old('venta') }}}">
													    <div class="label label-danger">{{ $errors->first("venta") }}</div>
												   </div>
													</div>
												</div>
												<!-- Venta End -->
												
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
