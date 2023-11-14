

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
												
												<!-- Paciente_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="paciente_id" class="control-label"> Paciente_id </label>
													    <input type="text" class="form-control" id="paciente_id" name="paciente_id"
													    value="{{{ isset($data->paciente_id ) ? $data->paciente_id  : old('paciente_id') }}}">
													    <div class="label label-danger">{{ $errors->first("paciente_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Paciente_id End -->
												
												<!-- Delegacion_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="delegacion_id" class="control-label"> Delegacion_id </label>
													    <input type="text" class="form-control" id="delegacion_id" name="delegacion_id"
													    value="{{{ isset($data->delegacion_id ) ? $data->delegacion_id  : old('delegacion_id') }}}">
													    <div class="label label-danger">{{ $errors->first("delegacion_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Delegacion_id End -->
												
												<!-- Area_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="area_id" class="control-label"> Area_id </label>
													    <input type="text" class="form-control" id="area_id" name="area_id"
													    value="{{{ isset($data->area_id ) ? $data->area_id  : old('area_id') }}}">
													    <div class="label label-danger">{{ $errors->first("area_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Area_id End -->
												
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
