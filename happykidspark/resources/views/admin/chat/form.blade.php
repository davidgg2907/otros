

												<!-- Usr_envia_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="usr_envia_id" class="control-label"> Usr_envia_id </label>
													    <input type="text" class="form-control" id="usr_envia_id" name="usr_envia_id"
													    value="{{{ isset($data->usr_envia_id ) ? $data->usr_envia_id  : old('usr_envia_id') }}}">
													    <div class="label label-danger">{{ $errors->first("usr_envia_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Usr_envia_id End -->
												
												<!-- Usr_recibe_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="usr_recibe_id" class="control-label"> Usr_recibe_id </label>
													    <input type="text" class="form-control" id="usr_recibe_id" name="usr_recibe_id"
													    value="{{{ isset($data->usr_recibe_id ) ? $data->usr_recibe_id  : old('usr_recibe_id') }}}">
													    <div class="label label-danger">{{ $errors->first("usr_recibe_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Usr_recibe_id End -->
												
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
												
												<!-- Hora Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="hora" class="control-label"> Hora </label>
													    <input type="text" class="form-control" id="hora" name="hora"
													    value="{{{ isset($data->hora ) ? $data->hora  : old('hora') }}}">
													    <div class="label label-danger">{{ $errors->first("hora") }}</div>
												   </div>
													</div>
												</div>
												<!-- Hora End -->
												
												<!-- Mensaje Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="mensaje" class="control-label"> Mensaje </label>
													    <input type="text" class="form-control" id="mensaje" name="mensaje"
													    value="{{{ isset($data->mensaje ) ? $data->mensaje  : old('mensaje') }}}">
													    <div class="label label-danger">{{ $errors->first("mensaje") }}</div>
												   </div>
													</div>
												</div>
												<!-- Mensaje End -->
												
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
