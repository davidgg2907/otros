

												<!-- Usr_crea_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="usr_crea_id" class="control-label"> Usr_crea_id </label>
													    <input type="text" class="form-control" id="usr_crea_id" name="usr_crea_id"
													    value="{{{ isset($data->usr_crea_id ) ? $data->usr_crea_id  : old('usr_crea_id') }}}">
													    <div class="label label-danger">{{ $errors->first("usr_crea_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Usr_crea_id End -->
												
												<!-- Usr_usa_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="usr_usa_id" class="control-label"> Usr_usa_id </label>
													    <input type="text" class="form-control" id="usr_usa_id" name="usr_usa_id"
													    value="{{{ isset($data->usr_usa_id ) ? $data->usr_usa_id  : old('usr_usa_id') }}}">
													    <div class="label label-danger">{{ $errors->first("usr_usa_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Usr_usa_id End -->
												
												<!-- Creado Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="creado" class="control-label"> Creado </label>
													    <input type="text" class="form-control" id="creado" name="creado"
													    value="{{{ isset($data->creado ) ? $data->creado  : old('creado') }}}">
													    <div class="label label-danger">{{ $errors->first("creado") }}</div>
												   </div>
													</div>
												</div>
												<!-- Creado End -->
												
												<!-- Caducado Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="caducado" class="control-label"> Caducado </label>
													    <input type="text" class="form-control" id="caducado" name="caducado"
													    value="{{{ isset($data->caducado ) ? $data->caducado  : old('caducado') }}}">
													    <div class="label label-danger">{{ $errors->first("caducado") }}</div>
												   </div>
													</div>
												</div>
												<!-- Caducado End -->
												
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
