

												<!-- Employe_id Start -->
												<div class="col-md-6">
											    <div class="form-group">
											        <label for="employe_id" class="control-label"> Employe_id </label>
											        <select id="employe_id" name="employe_id" class="form-control">
																	<option value=""> [-SELECCIONE-] </option>
											            <?php foreach ($employees as $value) { ?>
											               <option value="<?php echo $value->id; ?>" <?php if($data->employe_id == $value->id) { echo 'selected'; }?>><?php echo $value->nombre; ?></option>
											            <?php } ?>
											        </select>
											        <div class="label label-danger">{{ $errors->first("employe_id") }}</div>
											     </div>
											  </div>
											  <!-- Employe_id End -->

											
												<!-- Tarea Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="tarea" class="control-label"> Tarea </label>
													    <input type="text" class="form-control" id="tarea" name="tarea"
													    value="{{{ isset($data->tarea ) ? $data->tarea  : old('tarea') }}}">
													    <div class="label label-danger">{{ $errors->first("tarea") }}</div>
												   </div>
													</div>
												</div>
												<!-- Tarea End -->
												
												<!-- Descripcion Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="descripcion" class="control-label"> Descripcion </label>
													    <input type="text" class="form-control" id="descripcion" name="descripcion"
													    value="{{{ isset($data->descripcion ) ? $data->descripcion  : old('descripcion') }}}">
													    <div class="label label-danger">{{ $errors->first("descripcion") }}</div>
												   </div>
													</div>
												</div>
												<!-- Descripcion End -->
												
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
												
												<!-- Asignacion Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="asignacion" class="control-label"> Asignacion </label>
													    <input type="text" class="form-control" id="asignacion" name="asignacion"
													    value="{{{ isset($data->asignacion ) ? $data->asignacion  : old('asignacion') }}}">
													    <div class="label label-danger">{{ $errors->first("asignacion") }}</div>
												   </div>
													</div>
												</div>
												<!-- Asignacion End -->
												
												<!-- Estatus Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="estatus" class="control-label"> Estatus </label>
													    <input type="text" class="form-control" id="estatus" name="estatus"
													    value="{{{ isset($data->estatus ) ? $data->estatus  : old('estatus') }}}">
													    <div class="label label-danger">{{ $errors->first("estatus") }}</div>
												   </div>
													</div>
												</div>
												<!-- Estatus End -->
												



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
