

												<!-- Tipo Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="tipo" class="control-label"> Tipo </label>
													    <input type="text" class="form-control" id="tipo" name="tipo"
													    value="{{{ isset($data->tipo ) ? $data->tipo  : old('tipo') }}}">
													    <div class="label label-danger">{{ $errors->first("tipo") }}</div>
												   </div>
													</div>
												</div>
												<!-- Tipo End -->
												
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
												
												<!-- Concepto Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="concepto" class="control-label"> Concepto </label>
													    <input type="text" class="form-control" id="concepto" name="concepto"
													    value="{{{ isset($data->concepto ) ? $data->concepto  : old('concepto') }}}">
													    <div class="label label-danger">{{ $errors->first("concepto") }}</div>
												   </div>
													</div>
												</div>
												<!-- Concepto End -->
												
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
