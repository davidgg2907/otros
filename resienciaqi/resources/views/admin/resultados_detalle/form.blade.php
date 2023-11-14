

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
												
												<!-- Resultado_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="resultado_id" class="control-label"> Resultado_id </label>
													    <input type="text" class="form-control" id="resultado_id" name="resultado_id"
													    value="{{{ isset($data->resultado_id ) ? $data->resultado_id  : old('resultado_id') }}}">
													    <div class="label label-danger">{{ $errors->first("resultado_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Resultado_id End -->
												
												<!-- Pregunta_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="pregunta_id" class="control-label"> Pregunta_id </label>
													    <input type="text" class="form-control" id="pregunta_id" name="pregunta_id"
													    value="{{{ isset($data->pregunta_id ) ? $data->pregunta_id  : old('pregunta_id') }}}">
													    <div class="label label-danger">{{ $errors->first("pregunta_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Pregunta_id End -->
												
												<!-- Respuesta_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="respuesta_id" class="control-label"> Respuesta_id </label>
													    <input type="text" class="form-control" id="respuesta_id" name="respuesta_id"
													    value="{{{ isset($data->respuesta_id ) ? $data->respuesta_id  : old('respuesta_id') }}}">
													    <div class="label label-danger">{{ $errors->first("respuesta_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Respuesta_id End -->
												
												<!-- Valor Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="valor" class="control-label"> Valor </label>
													    <input type="text" class="form-control" id="valor" name="valor"
													    value="{{{ isset($data->valor ) ? $data->valor  : old('valor') }}}">
													    <div class="label label-danger">{{ $errors->first("valor") }}</div>
												   </div>
													</div>
												</div>
												<!-- Valor End -->
												
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
