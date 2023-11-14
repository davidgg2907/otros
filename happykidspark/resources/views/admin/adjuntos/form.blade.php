

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
												
												<!-- Producto_adjunto_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="producto_adjunto_id" class="control-label"> Producto_adjunto_id </label>
													    <input type="text" class="form-control" id="producto_adjunto_id" name="producto_adjunto_id"
													    value="{{{ isset($data->producto_adjunto_id ) ? $data->producto_adjunto_id  : old('producto_adjunto_id') }}}">
													    <div class="label label-danger">{{ $errors->first("producto_adjunto_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Producto_adjunto_id End -->
												
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
