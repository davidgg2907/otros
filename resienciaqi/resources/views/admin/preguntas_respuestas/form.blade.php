

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
												
												<!-- Label Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="label" class="control-label"> Label </label>
													    <input type="text" class="form-control" id="label" name="label"
													    value="{{{ isset($data->label ) ? $data->label  : old('label') }}}">
													    <div class="label label-danger">{{ $errors->first("label") }}</div>
												   </div>
													</div>
												</div>
												<!-- Label End -->
												
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
