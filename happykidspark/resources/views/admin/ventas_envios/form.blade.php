

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
												
												<!-- Usr_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="usr_id" class="control-label"> Usr_id </label>
													    <input type="text" class="form-control" id="usr_id" name="usr_id"
													    value="{{{ isset($data->usr_id ) ? $data->usr_id  : old('usr_id') }}}">
													    <div class="label label-danger">{{ $errors->first("usr_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Usr_id End -->
												
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
												
												<!-- Forma_envio Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="forma_envio" class="control-label"> Forma_envio </label>
													    <input type="text" class="form-control" id="forma_envio" name="forma_envio"
													    value="{{{ isset($data->forma_envio ) ? $data->forma_envio  : old('forma_envio') }}}">
													    <div class="label label-danger">{{ $errors->first("forma_envio") }}</div>
												   </div>
													</div>
												</div>
												<!-- Forma_envio End -->
												
												<!-- En_camino Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="en_camino" class="control-label"> En_camino </label>
													    <input type="text" class="form-control" id="en_camino" name="en_camino"
													    value="{{{ isset($data->en_camino ) ? $data->en_camino  : old('en_camino') }}}">
													    <div class="label label-danger">{{ $errors->first("en_camino") }}</div>
												   </div>
													</div>
												</div>
												<!-- En_camino End -->
												
												<!-- Fecha_entrega Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="fecha_entrega" class="control-label"> Fecha_entrega </label>
													    <input type="text" class="form-control" id="fecha_entrega" name="fecha_entrega"
													    value="{{{ isset($data->fecha_entrega ) ? $data->fecha_entrega  : old('fecha_entrega') }}}">
													    <div class="label label-danger">{{ $errors->first("fecha_entrega") }}</div>
												   </div>
													</div>
												</div>
												<!-- Fecha_entrega End -->
												
												<!-- Transportista Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="transportista" class="control-label"> Transportista </label>
													    <input type="text" class="form-control" id="transportista" name="transportista"
													    value="{{{ isset($data->transportista ) ? $data->transportista  : old('transportista') }}}">
													    <div class="label label-danger">{{ $errors->first("transportista") }}</div>
												   </div>
													</div>
												</div>
												<!-- Transportista End -->
												
												<!-- Guia Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="guia" class="control-label"> Guia </label>
													    <input type="text" class="form-control" id="guia" name="guia"
													    value="{{{ isset($data->guia ) ? $data->guia  : old('guia') }}}">
													    <div class="label label-danger">{{ $errors->first("guia") }}</div>
												   </div>
													</div>
												</div>
												<!-- Guia End -->
												
												<!-- Tipo_envio Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="tipo_envio" class="control-label"> Tipo_envio </label>
													    <input type="text" class="form-control" id="tipo_envio" name="tipo_envio"
													    value="{{{ isset($data->tipo_envio ) ? $data->tipo_envio  : old('tipo_envio') }}}">
													    <div class="label label-danger">{{ $errors->first("tipo_envio") }}</div>
												   </div>
													</div>
												</div>
												<!-- Tipo_envio End -->
												
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
