

												<!-- Pregunta Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="pregunta" class="control-label"> Pregunta </label>
													    <input type="text" class="form-control" id="pregunta" name="pregunta"
													    value="{{{ isset($data->pregunta ) ? $data->pregunta  : old('pregunta') }}}">
													    <div class="label label-danger">{{ $errors->first("pregunta") }}</div>
												   </div>
													</div>
												</div>
												<!-- Pregunta End -->
												
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
												
												<!-- Grupo Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="grupo" class="control-label"> Grupo </label>
													    <input type="text" class="form-control" id="grupo" name="grupo"
													    value="{{{ isset($data->grupo ) ? $data->grupo  : old('grupo') }}}">
													    <div class="label label-danger">{{ $errors->first("grupo") }}</div>
												   </div>
													</div>
												</div>
												<!-- Grupo End -->
												
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
