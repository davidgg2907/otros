

<!-- Minutos Start -->
<div class="col-md-6">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="minutos" class="control-label"> Minutos </label>
		<div class="input-group mb-2">
	    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-clock fa-lg"></i> </span>
			<input type="text" class="form-control" id="minutos" name="minutos" required
	    value="{{{ isset($data->minutos ) ? $data->minutos  : old('minutos') }}}">
			<span class="input-group-text" id="basic-addon1"> Minutos </span>
		</div>
	   <div class="label label-danger">{{ $errors->first("minutos") }}</div>
   </div>
	</div>
</div>
<!-- Minutos End -->

<!-- Costo Start -->
<div class="col-md-6">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="costo" class="control-label"> Costo </label>
		<div class="input-group mb-2">
	    <span class="input-group-text" id="basic-addon1"> $ </span>
			<input type="text" class="form-control" id="costo" name="costo" required
	    value="{{{ isset($data->costo ) ? round($data->costo,0)  : old('costo') }}}">
			<span class="input-group-text" id="basic-addon1"> CLP </span>
		</div>
	   <div class="label label-danger">{{ $errors->first("costo") }}</div>
   </div>
	</div>
</div>
<!-- Costo End -->

<input type="hidden" class="form-control" id="status" name="status" value="{{{ isset($data->status ) ? $data->status  : '1' }}}">


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
