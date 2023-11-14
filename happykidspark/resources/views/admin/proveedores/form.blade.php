<div class="card">
		<div class="card-header">
				<h4 class="card-title">Datos de la empresa</h4>
		</div>
		<div class="card-body">
			<div class="row">

				<!-- Nombre Start -->
				<div class="col-md-8">
					<div class="mb-1">
					 <div class="form-group">
						<label for="nombre" class="control-label"> Nombre </label>

						<div class="input-group mb-2">
					    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-building fa-lg"></i> </span>
							<input type="text" class="form-control" id="nombre" name="nombre" required
							value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
						</div>
							<div class="label label-danger">{{ $errors->first("nombre") }}</div>
					 </div>
					</div>
				</div>
				<!-- Nombre End -->

				<!-- Celular Start -->
				<div class="col-md-4">
					<div class="mb-1">
					 <div class="form-group">
						<label for="celular" class="control-label"> Celular </label>
						<div class="input-group mb-2">
					    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-mobile fa-lg"></i> </span>
							<input type="text" class="form-control" id="celular" name="celular" required
							value="{{{ isset($data->celular ) ? $data->celular  : old('celular') }}}">
						</div>
							<div class="label label-danger">{{ $errors->first("celular") }}</div>
					 </div>
					</div>
				</div>
				<!-- Celular End -->

				<!-- Correo Start -->
				<div class="col-md-5">
					<div class="mb-1">
					 <div class="form-group">
						<label for="correo" class="control-label"> Correo </label>
						<div class="input-group mb-2">
					    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-envelope fa-lg"></i> </span>
							<input type="text" class="form-control" id="correo" name="correo"
							value="{{{ isset($data->correo ) ? $data->correo  : old('correo') }}}">
						</div>
							<div class="label label-danger">{{ $errors->first("correo") }}</div>
					 </div>
					</div>
				</div>
				<!-- Correo End -->

				<!-- Direccion Start -->
				<div class="col-md-7">
					<div class="mb-1">
					 <div class="form-group">
						<label for="direccion" class="control-label"> Direccion </label>
						<div class="input-group mb-2">
					    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-home fa-lg"></i> </span>
							<input type="text" class="form-control" id="direccion" name="direccion"
							value="{{{ isset($data->direccion ) ? $data->direccion  : old('direccion') }}}">
						</div>
						<div class="label label-danger">{{ $errors->first("direccion") }}</div>
					 </div>
					</div>
				</div>
				<!-- Direccion End -->



			</div>
		</div>
		<div class="card-footer">
			<div class="row">
			</div>
		</div>
	</div>

	<div class="card">
			<div class="card-header">
					<h4 class="card-title">Informacion del Vendedor</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<!-- Vendedor Start -->
					<div class="col-md-12">
						<div class="mb-1">
						 <div class="form-group">
							<label for="vendedor" class="control-label"> Nombre del Vendedor </label>
							<div class="input-group mb-2">
						    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-user-secret fa-lg"></i> </span>
								<input type="text" class="form-control" id="vendedor" name="vendedor"
								value="{{{ isset($data->vendedor ) ? $data->vendedor  : old('vendedor') }}}">
							</div>
							<div class="label label-danger">{{ $errors->first("vendedor") }}</div>
						 </div>
						</div>
					</div>
					<!-- Vendedor End -->

					<!-- Vededor_celular Start -->
					<div class="col-md-4">
						<div class="mb-1">
						 <div class="form-group">
							<label for="vededor_celular" class="control-label"> No Celular </label>
							<div class="input-group mb-2">
						    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-mobile fa-lg"></i> </span>
								<input type="text" class="form-control" id="vededor_celular" name="vededor_celular"
								value="{{{ isset($data->vededor_celular ) ? $data->vededor_celular  : old('vededor_celular') }}}">
							</div>
							<div class="label label-danger">{{ $errors->first("vededor_celular") }}</div>
						 </div>
						</div>
					</div>
					<!-- Vededor_celular End -->

					<!-- Vendedor_correo Start -->
					<div class="col-md-8">
						<div class="mb-1">
						 <div class="form-group">
							<label for="vendedor_correo" class="control-label"> Corroe Electronico </label>
							<div class="input-group mb-2">
						    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-envelope fa-lg"></i> </span>
								<input type="text" class="form-control" id="vendedor_correo" name="vendedor_correo"
								value="{{{ isset($data->vendedor_correo ) ? $data->vendedor_correo  : old('vendedor_correo') }}}">
							</div><div class="label label-danger">{{ $errors->first("vendedor_correo") }}</div>
						 </div>
						</div>
					</div>
					<!-- Vendedor_correo End -->
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
				</div>
			</div>
		</div>

		<input type="text" class="form-control" id="status" name="status" value="1">}




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
