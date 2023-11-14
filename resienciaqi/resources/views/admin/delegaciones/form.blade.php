<!-- Nombre Start -->
<div class="col-md-12">
	<div class="mb-1">
	 <div class="form-group">
	  <label for="nombre" class="control-label"> Nombre </label>
	    <input type="text" class="form-control" id="nombre" name="nombre" required
	    value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
	    <div class="label label-danger">{{ $errors->first("nombre") }}</div>
   </div>
	</div>
</div>
<!-- Nombre End -->


<input type="hidden" class="form-control" id="seo" name="seo" value="{{{ isset($data->seo ) ? $data->seo  : old('seo') }}}">
<input type="hidden" class="form-control" id="status" name="status" value="1">

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
