<div class="col-md-12">
	<div class="card">
		<div class="card-header">
				<h4 class="card-title">Agregar pacientes</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<!-- Delegacion_id Start -->
				<div class="col-md-6">
					<div class="mb-1">
					 <div class="form-group">
						<label for="delegacion_id" class="control-label"> Delegacion </label>
						<select class="form-control" id="delegacion_id" name="delegacion_id" required>
							<option value="">[ Seleccione ]</option>
							@foreach (\App\admin\Delegaciones::where('status',1)->get() as $value)
								<option value="{{ $value->id }}" @if($data->delegacion_id == $value->id) selected @endif> {{ $value->nombre}} </option>
							@endforeach
						</select>
						<div class="label label-danger">{{ $errors->first("delegacion_id") }}</div>
					 </div>
					</div>
				</div>
				<!-- Delegacion_id End -->

				<!-- Area_id Start -->
				<div class="col-md-6">
					<div class="mb-1">
					 <div class="form-group">
						<label for="area_id" class="control-label"> Area </label>
						<select class="form-control" id="area_id" name="area_id" required>
							<option value="">[ Seleccione ]</option>
							@foreach (\App\admin\Delegaciones::where('status',1)->get() as $value)
								<option value="{{ $value->id }}" @if($data->area_id == $value->id) selected @endif> {{ $value->nombre}} </option>
							@endforeach
						</select>
							<div class="label label-danger">{{ $errors->first("area_id") }}</div>
					 </div>
					</div>
				</div>
				<!-- Area_id End -->

				<!-- Nombre Start -->
				<div class="col-md-8">
					<div class="mb-1">
					 <div class="form-group">
						<label for="nombre" class="control-label"> Nombre </label>
							<input type="text" class="form-control" id="nombre" name="nombre"
							value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
							<div class="label label-danger">{{ $errors->first("nombre") }}</div>
					 </div>
					</div>
				</div>
				<!-- Nombre End -->

				<!-- Curp Start -->
				<div class="col-md-4">
					<div class="mb-1">
					 <div class="form-group">
						<label for="curp" class="control-label"> Curp </label>
							<input type="text" class="form-control" id="curp" name="curp"
							value="{{{ isset($data->curp ) ? $data->curp  : old('curp') }}}">
							<div class="label label-danger">{{ $errors->first("curp") }}</div>
					 </div>
					</div>
				</div>
				<!-- Curp End -->

				<!-- Telefono Start -->
				<div class="col-md-6">
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
				<div class="col-md-6">
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


<div class="col-md-12">
	<div class="card">
		<div class="card-header">
				<h4 class="card-title">Agregar pacientes</h4>
		</div>
		<div class="card-body">
			<div class="row">
			</div>

		</div>
		<div class="card-footer">
			<div class="row">
			</div>
		</div>
	</div>
</div>





												<!-- Domicilio Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="domicilio" class="control-label"> Domicilio </label>
													    <input type="text" class="form-control" id="domicilio" name="domicilio"
													    value="{{{ isset($data->domicilio ) ? $data->domicilio  : old('domicilio') }}}">
													    <div class="label label-danger">{{ $errors->first("domicilio") }}</div>
												   </div>
													</div>
												</div>
												<!-- Domicilio End -->													

												<!-- Edad Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="edad" class="control-label"> Edad </label>
													    <input type="text" class="form-control" id="edad" name="edad"
													    value="{{{ isset($data->edad ) ? $data->edad  : old('edad') }}}">
													    <div class="label label-danger">{{ $errors->first("edad") }}</div>
												   </div>
													</div>
												</div>
												<!-- Edad End -->

												<!-- Hijos Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="hijos" class="control-label"> Hijos </label>
													    <input type="text" class="form-control" id="hijos" name="hijos"
													    value="{{{ isset($data->hijos ) ? $data->hijos  : old('hijos') }}}">
													    <div class="label label-danger">{{ $errors->first("hijos") }}</div>
												   </div>
													</div>
												</div>
												<!-- Hijos End -->

												<!-- Lugar_nacimiento Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="lugar_nacimiento" class="control-label"> Lugar_nacimiento </label>
													    <input type="text" class="form-control" id="lugar_nacimiento" name="lugar_nacimiento"
													    value="{{{ isset($data->lugar_nacimiento ) ? $data->lugar_nacimiento  : old('lugar_nacimiento') }}}">
													    <div class="label label-danger">{{ $errors->first("lugar_nacimiento") }}</div>
												   </div>
													</div>
												</div>
												<!-- Lugar_nacimiento End -->

												<!-- Residencia Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="residencia" class="control-label"> Residencia </label>
													    <input type="text" class="form-control" id="residencia" name="residencia"
													    value="{{{ isset($data->residencia ) ? $data->residencia  : old('residencia') }}}">
													    <div class="label label-danger">{{ $errors->first("residencia") }}</div>
												   </div>
													</div>
												</div>
												<!-- Residencia End -->

												<!-- Canalizado Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="canalizado" class="control-label"> Canalizado </label>
													    <input type="text" class="form-control" id="canalizado" name="canalizado"
													    value="{{{ isset($data->canalizado ) ? $data->canalizado  : old('canalizado') }}}">
													    <div class="label label-danger">{{ $errors->first("canalizado") }}</div>
												   </div>
													</div>
												</div>
												<!-- Canalizado End -->

												<!-- Fotografia Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="fotografia" class="control-label"> Fotografia </label>
													    <input type="text" class="form-control" id="fotografia" name="fotografia"
													    value="{{{ isset($data->fotografia ) ? $data->fotografia  : old('fotografia') }}}">
													    <div class="label label-danger">{{ $errors->first("fotografia") }}</div>
												   </div>
													</div>
												</div>
												<!-- Fotografia End -->

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
