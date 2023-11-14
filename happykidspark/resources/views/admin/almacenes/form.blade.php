<!-- Tienda_id Start -->
<div class="col-md-12">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="tienda_id" class="control-label"> Tienda_id </label>
		<select class="form-control" id="tienda_id" name="tienda_id" required>
			<option value=""> [ SELECCIONE ] </option>
			<?php foreach(\App\admin\Tiendas::where('status',1)->get() as $stores) { ?>
				<option value="{{ $stores->id }}" <?php if($data->tienda_id == $stores->id) { echo 'selected'; } ?>> {{ $stores->nombre }} </option>
			<?php } ?>
		</select>
		<div class="label label-danger">{{ $errors->first("tienda_id") }}</div>
   </div>
	</div>
</div>
<!-- Tienda_id End -->

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

<!-- Fisico_digital Start -->
<div class="col-md-4">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="fisico_digital" class="control-label"> Tipo </label>
		<select class="form-control" id="fisico_digital" name="fisico_digital" required>
			<option value=""> [ SELECCIONE ] </option>
			<option value="FISICA"> FISICA </option>
			<option value="VIRTUAL"> VIRTUAL </option>
		</select>
	    <div class="label label-danger">{{ $errors->first("fisico_digital") }}</div>
   </div>
	</div>
</div>
<!-- Fisico_digital End -->

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
