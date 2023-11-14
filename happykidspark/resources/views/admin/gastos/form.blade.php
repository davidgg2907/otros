
<!-- Fgasto Start -->
<div class="col-md-8">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="fgasto" class="control-label"> Tienda </label>
		<select class="form-control" id="tienda_id" name="tienda_id" required>
			<option value="">[ SELECCIONE ]</option>
			<?php foreach(\App\admin\Tiendas::where('status',1)->get() as $provs) { ?>
				<option value="{{ $provs->id }}">{{ $provs->nombre }}</option>
			<?php } ?>
		</select>
	    <div class="label label-danger">{{ $errors->first("fgasto") }}</div>
   </div>
	</div>
</div>


<div class="col-md-4">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="fgasto" class="control-label"> Tipo de Gasto </label>
		<select class="form-control" id="clasificacion" name="clasificacion" required>
			<option value="">[ SELECCIONE ]</option>
			<option value="Publicidad ML">Publicidad ML</option>
			<option value="Impuestos">Impuestos</option>
			<option value="Nomina">Nomina</option>
			<option value="Intereses bancarios">Intereses bancarios</option>
			<option value="Otros">Otros</option>
		</select>
	    <div class="label label-danger">{{ $errors->first("fgasto") }}</div>
   </div>
	</div>
</div>
<!-- Fgasto End -->

<!-- Fgasto Start -->
<div class="col-md-6">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="fgasto" class="control-label"> Fecha del Gasto </label>
	    <input type="text" class="form-control flatpickr-basic flatpickr-input" required id="fgasto" name="fgasto"
	    value="{{{ isset($data->fgasto ) ? $data->fgasto  : old('fgasto') }}}">
	    <div class="label label-danger">{{ $errors->first("fgasto") }}</div>
   </div>
	</div>
</div>
<!-- Fgasto End -->


<!-- Importe Start -->
<div class="col-md-6">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="importe" class="control-label"> Importe </label>

		<div class="input-group mb-2">
			<span class="input-group-text" style="font-weight:bold;background: #EEE;">$ </span>
			<input type="text" class="form-control" required id="importe" name="importe"
	    value="{{{ isset($data->importe ) ? $data->importe  : old('importe') }}}">
			<span class="input-group-text" style="font-weight:bold;background: #EEE;">MXN</span>
		</div>
	   <div class="label label-danger">{{ $errors->first("importe") }}</div>
   </div>
	</div>
</div>
<!-- Importe End -->

<!-- Concepto Start -->
<div class="col-md-12">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="concepto" class="control-label"> Concepto </label>
		<textarea class="form-control" id="concepto" required name="concepto">{{{ isset($data->concepto ) ? $data->concepto  : old('concepto') }}}</textarea>
	   <div class="label label-danger">{{ $errors->first("concepto") }}</div>
   </div>
	</div>
</div>
<!-- Concepto End -->

<input type="hidden" class="form-control" id="status" name="status" value="1">



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
