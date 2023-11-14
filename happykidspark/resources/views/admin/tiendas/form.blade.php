<!-- Plataforma Start -->
<div class="col-md-4">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="plataforma" class="control-label"> Plataforma </label>
	    <input type="text" class="form-control" id="plataforma" name="plataforma"
	    value="{{{ isset($data->plataforma ) ? $data->plataforma  : old('plataforma') }}}">
	    <div class="label label-danger">{{ $errors->first("plataforma") }}</div>
   </div>
	</div>
</div>
<!-- Plataforma End -->

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
