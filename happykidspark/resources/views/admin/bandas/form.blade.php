

<!-- Color Start -->
<div class="col-md-6">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="color" class="control-label"> Color </label>
		<div class="input-group mb-2">
	     <span class="input-group-text" style="background: #E8E8E8;">Nombre</span>
			 <input type="text" class="form-control" id="color" name="color" required
 	    value="{{{ isset($data->color ) ? $data->color  : old('color') }}}">
			 <span class="input-group-text" style="background: #E8E8E8;">RGB</span>
			 <input type="color" class="form-control" id="rgb" name="rgb" required value="{{{ isset($data->rgb ) ? $data->rgb  : '0' }}}">
	   </div>
	   <div class="label label-danger">{{ $errors->first("color") }}</div>
   </div>
	</div>
</div>
<!-- Color End -->

<!-- Color Start -->
<div class="col-md-6">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="color" class="control-label"> Unidades </label>
	    <input type="text" class="form-control" id="unidades" name="unidades" required
	    value="{{{ isset($data->unidades ) ? $data->unidades  : old('unidades') }}}">
	    <div class="label label-danger">{{ $errors->first("color") }}</div>
   </div>
	</div>
</div>
<!-- Color End -->


<!-- Inicia Start -->
<div class="col-md-4">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="inicia" class="control-label"> Serie </label>
		<div class="input-group mb-2">
	     <span class="input-group-text" style="background: #E8E8E8;"> <i class="fa fa-barcode fa-lg"></i> </span>
			 <input type="text" class="form-control" id="serie" name="serie" placeholder="ABCD..."
 	    value="{{{ isset($data->serie ) ? $data->serie  : old('serie') }}}">
		</div>
	    <div class="label label-danger">{{ $errors->first("serie") }}</div>
   </div>
	</div>
</div>
<!-- Inicia End -->

<!-- Inicia Start -->
<div class="col-md-4">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="inicia" class="control-label"> Inicia </label>
		<div class="input-group mb-2">
	     <span class="input-group-text" style="background: #E8E8E8;"> <i class="fa fa-sort-numeric-up-alt fa-lg"></i> </span>
			 <input type="number" class="form-control" id="inicia" name="inicia" required placeholder="0-9"
 	    value="{{{ isset($data->inicia ) ? $data->inicia  : old('inicia') }}}">
		</div>
	    <div class="label label-danger">{{ $errors->first("inicia") }}</div>
   </div>
	</div>
</div>
<!-- Inicia End -->

<!-- Termina Start -->
<div class="col-md-4">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="termina" class="control-label"> Termina </label>
		<div class="input-group mb-2">
	     <span class="input-group-text" style="background: #E8E8E8;"><i class="fa fa-sort-numeric-down-alt fa-lg"></i></span>
			 <input type="number" class="form-control" id="termina" name="termina" required placeholder="0-9"
 	    value="{{{ isset($data->termina ) ? $data->termina  : old('termina') }}}">
		</div>
	  <div class="label label-danger">{{ $errors->first("termina") }}</div>
   </div>
	</div>
</div>
<!-- Termina End -->

<input type="hidden" class="form-control" id="usadas" name="usadas" value="{{{ isset($data->usadas ) ? $data->usadas  : '0' }}}">

<input type="hidden" class="form-control" id="actual" name="actual" value="{{{ isset($data->actual ) ? $data->actual  : '0' }}}">
<input type="hidden" class="form-control" id="status" name="status" value="{{{ isset($data->status ) ? $data->status  : '0' }}}">


@section('scripts')

<script>

$('#inicia').on('change',function(){
	calculaTotalBandas();
});

$('#unidades').on('change',function(){
	calculaTotalBandas();
});


function calculaTotalBandas() {
	var inicial = parseInt($('#inicia').val());
	var final 	= parseInt($('#termina').val());
	var units 	= parseInt($('#unidades').val());

	if(isNaN(inicial)) { inicial = 0;	 }
	if(isNaN(final)) { final = 0; }

	if(!isNaN(units)) {

		var final = units + (inicial -1);
		$('#termina').val(final);

	} else {
		return false;

	}

}

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
