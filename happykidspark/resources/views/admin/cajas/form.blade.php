

												<!-- User_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="user_id" class="control-label"> User_id </label>
													    <input type="text" class="form-control" id="user_id" name="user_id"
													    value="{{{ isset($data->user_id ) ? $data->user_id  : old('user_id') }}}">
													    <div class="label label-danger">{{ $errors->first("user_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- User_id End -->
												
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
												
												<!-- Monto_inicial Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="monto_inicial" class="control-label"> Monto_inicial </label>
													    <input type="text" class="form-control" id="monto_inicial" name="monto_inicial"
													    value="{{{ isset($data->monto_inicial ) ? $data->monto_inicial  : old('monto_inicial') }}}">
													    <div class="label label-danger">{{ $errors->first("monto_inicial") }}</div>
												   </div>
													</div>
												</div>
												<!-- Monto_inicial End -->
												
												<!-- Monto_final Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="monto_final" class="control-label"> Monto_final </label>
													    <input type="text" class="form-control" id="monto_final" name="monto_final"
													    value="{{{ isset($data->monto_final ) ? $data->monto_final  : old('monto_final') }}}">
													    <div class="label label-danger">{{ $errors->first("monto_final") }}</div>
												   </div>
													</div>
												</div>
												<!-- Monto_final End -->
												
												<!-- Ventas Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="ventas" class="control-label"> Ventas </label>
													    <input type="text" class="form-control" id="ventas" name="ventas"
													    value="{{{ isset($data->ventas ) ? $data->ventas  : old('ventas') }}}">
													    <div class="label label-danger">{{ $errors->first("ventas") }}</div>
												   </div>
													</div>
												</div>
												<!-- Ventas End -->
												
												<!-- Cancelaciones Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="cancelaciones" class="control-label"> Cancelaciones </label>
													    <input type="text" class="form-control" id="cancelaciones" name="cancelaciones"
													    value="{{{ isset($data->cancelaciones ) ? $data->cancelaciones  : old('cancelaciones') }}}">
													    <div class="label label-danger">{{ $errors->first("cancelaciones") }}</div>
												   </div>
													</div>
												</div>
												<!-- Cancelaciones End -->
												
												<!-- Temporizadores Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="temporizadores" class="control-label"> Temporizadores </label>
													    <input type="text" class="form-control" id="temporizadores" name="temporizadores"
													    value="{{{ isset($data->temporizadores ) ? $data->temporizadores  : old('temporizadores') }}}">
													    <div class="label label-danger">{{ $errors->first("temporizadores") }}</div>
												   </div>
													</div>
												</div>
												<!-- Temporizadores End -->
												
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
