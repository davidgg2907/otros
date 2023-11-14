

												<!-- Grupo_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="grupo_id" class="control-label"> Grupo_id </label>
													    <input type="text" class="form-control" id="grupo_id" name="grupo_id"
													    value="{{{ isset($data->grupo_id ) ? $data->grupo_id  : old('grupo_id') }}}">
													    <div class="label label-danger">{{ $errors->first("grupo_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Grupo_id End -->
												
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
