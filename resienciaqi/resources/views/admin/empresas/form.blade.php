<div class="col-sm-4">
	<div class="card">
			<div class="card-header">
					<h4 class="card-title">Informacion General</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<!-- Logotipo Start -->
					<div class="col-md-12">
						<div class="mb-1">
						 <div class="form-group">
							<label for="logotipo" class="control-label"> Logotipo </label>
								<input type="file" class="form-control dropify" id="logotipo" name="logotipo" value="{{{ isset($data->logotipo ) ? $data->logotipo  : old('logotipo') }}}">
								<div class="label label-danger">{{ $errors->first("logotipo") }}</div>
						 </div>
						</div>
					</div>
					<!-- Logotipo End -->
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
				</div>
			</div>
		</div>
</div>

<div class="col-sm-8">
	<div class="card">
			<div class="card-header">
					<h4 class="card-title">Informacion General</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<!-- Nombre Start -->
					<div class="col-md-12">
						<div class="mb-1">
						 <div class="form-group">
							<label for="nombre" class="control-label"> Nombre Comercial o Razon social</label>
								<input type="text" class="form-control" id="nombre" name="nombre"
								value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
								<div class="label label-danger">{{ $errors->first("nombre") }}</div>
						 </div>
						</div>
					</div>
					<!-- Nombre End -->


					<!-- Correo Start -->
					<div class="col-md-6">
						<div class="mb-1">
						 <div class="form-group">
							<label for="correo" class="control-label"> Correo </label>
								<input type="text" class="form-control" id="correo" name="correo"
								value="{{{ isset($data->correo ) ? $data->correo  : old('correo') }}}">
								<div class="label label-danger">{{ $errors->first("correo") }}</div>
						 </div>
						</div>
					</div>
					<!-- Correo End -->

					<!-- Telefono Start -->
					<div class="col-md-3">
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

					<!-- Celular Start -->
					<div class="col-md-3">
						<div class="mb-1">
						 <div class="form-group">
							<label for="celular" class="control-label"> Celular </label>
								<input type="text" class="form-control" id="celular" name="celular"
								value="{{{ isset($data->celular ) ? $data->celular  : old('celular') }}}">
								<div class="label label-danger">{{ $errors->first("celular") }}</div>
						 </div>
						</div>
					</div>
					<!-- Celular End -->
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
				</div>
			</div>
		</div>
</div>

<div class="col-sm-12">
	<div class="card">
			<div class="card-header">
					<h4 class="card-title">Domicilio</h4>
			</div>
			<div class="card-body">
				<div class="row">

					<!-- Direccion Start -->
					<div class="col-md-8">
						<div class="mb-1">
						 <div class="form-group">
							<label for="direccion" class="control-label"> Direccion </label>
								<input type="text" class="form-control" id="direccion" name="direccion"
								value="{{{ isset($data->direccion ) ? $data->direccion  : old('direccion') }}}">
								<div class="label label-danger">{{ $errors->first("direccion") }}</div>
						 </div>
						</div>
					</div>
					<!-- Direccion End -->

					<!-- Colonia Start -->
					<div class="col-md-4">
						<div class="mb-1">
						 <div class="form-group">
							<label for="colonia" class="control-label"> Colonia </label>
								<input type="text" class="form-control" id="colonia" name="colonia"
								value="{{{ isset($data->colonia ) ? $data->colonia  : old('colonia') }}}">
								<div class="label label-danger">{{ $errors->first("colonia") }}</div>
						 </div>
						</div>
					</div>
					<!-- Colonia End -->

					<!-- Estado Start -->
					<div class="col-md-5">
						<div class="mb-1">
						 <div class="form-group">
							<label for="estado" class="control-label"> Estado </label>
								<input type="text" class="form-control" id="estado" name="estado"
								value="{{{ isset($data->estado ) ? $data->estado  : old('estado') }}}">
								<div class="label label-danger">{{ $errors->first("estado") }}</div>
						 </div>
						</div>
					</div>
					<!-- Estado End -->

					<!-- Ciudad Start -->
					<div class="col-md-5">
						<div class="mb-1">
						 <div class="form-group">
							<label for="ciudad" class="control-label"> Ciudad </label>
								<input type="text" class="form-control" id="ciudad" name="ciudad"
								value="{{{ isset($data->ciudad ) ? $data->ciudad  : old('ciudad') }}}">
								<div class="label label-danger">{{ $errors->first("ciudad") }}</div>
						 </div>
						</div>
					</div>
					<!-- Ciudad End -->

					<!-- Cp Start -->
					<div class="col-md-2">
						<div class="mb-1">
						 <div class="form-group">
							<label for="cp" class="control-label"> Codigo Postal </label>
								<input type="text" class="form-control" id="cp" name="cp"
								value="{{{ isset($data->cp ) ? $data->cp  : old('cp') }}}">
								<div class="label label-danger">{{ $errors->first("cp") }}</div>
						 </div>
						</div>
					</div>
					<!-- Cp End -->

				</div>
			</div>
			<div class="card-footer">
				<div class="row">
				</div>
			</div>
		</div>
</div>

<div class="col-sm-12">
	<div class="card">
			<div class="card-header">
					<h4 class="card-title">Redes sociales</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<!-- Twitter Start -->
					<div class="col-md-4">
						<div class="mb-1">
						 <div class="form-group">
							<label for="twitter" class="control-label"> Twitter </label>
								<input type="text" class="form-control" id="twitter" name="twitter"
								value="{{{ isset($data->twitter ) ? $data->twitter  : old('twitter') }}}">
								<div class="label label-danger">{{ $errors->first("twitter") }}</div>
						 </div>
						</div>
					</div>
					<!-- Twitter End -->

					<!-- Facebook Start -->
					<div class="col-md-4">
						<div class="mb-1">
						 <div class="form-group">
							<label for="facebook" class="control-label"> Facebook </label>
								<input type="text" class="form-control" id="facebook" name="facebook"
								value="{{{ isset($data->facebook ) ? $data->facebook  : old('facebook') }}}">
								<div class="label label-danger">{{ $errors->first("facebook") }}</div>
						 </div>
						</div>
					</div>
					<!-- Facebook End -->

					<!-- Instagram Start -->
					<div class="col-md-4">
						<div class="mb-1">
						 <div class="form-group">
							<label for="instagram" class="control-label"> Instagram </label>
								<input type="text" class="form-control" id="instagram" name="instagram"
								value="{{{ isset($data->instagram ) ? $data->instagram  : old('instagram') }}}">
								<div class="label label-danger">{{ $errors->first("instagram") }}</div>
						 </div>
						</div>
					</div>
					<!-- Instagram End -->
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
				</div>
			</div>
		</div>
</div>

<input type="hidden" class="form-control" id="hospedaje" name="hospedaje" value="{{{ isset($data->hospedaje ) ? $data->hospedaje  : old('hospedaje') }}}">
<input type="hidden" class="form-control" id="hospedaje_iva" name="hospedaje_iva" value="{{{ isset($data->hospedaje_iva ) ? $data->hospedaje_iva  : old('hospedaje_iva') }}}">
<input type="hidden" class="form-control" id="status" name="status" value="{{{ isset($data->status ) ? $data->status  : old('status') }}}">
<input type="hidden" class="form-control" id="impuesto" name="impuesto" value="{{{ isset($data->impuesto ) ? $data->impuesto  : old('impuesto') }}}">

@section('scripts')

<script>

var bootstrapForm = $('.needs-validation'),
	jqForm = $('#jquery-val-form');


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
