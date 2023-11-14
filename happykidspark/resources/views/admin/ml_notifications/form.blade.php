

												<!-- Ml_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="ml_id" class="control-label"> Ml_id </label>
													    <input type="text" class="form-control" id="ml_id" name="ml_id"
													    value="{{{ isset($data->ml_id ) ? $data->ml_id  : old('ml_id') }}}">
													    <div class="label label-danger">{{ $errors->first("ml_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Ml_id End -->
												
												<!-- Resource Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="resource" class="control-label"> Resource </label>
													    <input type="text" class="form-control" id="resource" name="resource"
													    value="{{{ isset($data->resource ) ? $data->resource  : old('resource') }}}">
													    <div class="label label-danger">{{ $errors->first("resource") }}</div>
												   </div>
													</div>
												</div>
												<!-- Resource End -->
												
												<!-- User_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="user_id" class="control-label"> User_id </label>
													    <input type="text" class="form-control" id="user_id" name="user_id"
													    value="{{{ isset($data->user_id ) ? $data->user_id  : old('user_id') }}}">
													    <div class="label label-danger">{{ $errors->first("user_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- User_id End -->
												
												<!-- Application_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="application_id" class="control-label"> Application_id </label>
													    <input type="text" class="form-control" id="application_id" name="application_id"
													    value="{{{ isset($data->application_id ) ? $data->application_id  : old('application_id') }}}">
													    <div class="label label-danger">{{ $errors->first("application_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Application_id End -->
												
												<!-- Attempts Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="attempts" class="control-label"> Attempts </label>
													    <input type="text" class="form-control" id="attempts" name="attempts"
													    value="{{{ isset($data->attempts ) ? $data->attempts  : old('attempts') }}}">
													    <div class="label label-danger">{{ $errors->first("attempts") }}</div>
												   </div>
													</div>
												</div>
												<!-- Attempts End -->
												
												<!-- Sent Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="sent" class="control-label"> Sent </label>
													    <input type="text" class="form-control" id="sent" name="sent"
													    value="{{{ isset($data->sent ) ? $data->sent  : old('sent') }}}">
													    <div class="label label-danger">{{ $errors->first("sent") }}</div>
												   </div>
													</div>
												</div>
												<!-- Sent End -->
												
												<!-- Received Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="received" class="control-label"> Received </label>
													    <input type="text" class="form-control" id="received" name="received"
													    value="{{{ isset($data->received ) ? $data->received  : old('received') }}}">
													    <div class="label label-danger">{{ $errors->first("received") }}</div>
												   </div>
													</div>
												</div>
												<!-- Received End -->
												
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
