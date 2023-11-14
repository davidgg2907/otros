

												<!-- Id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="id" class="control-label"> Id </label>
													    <input type="text" class="form-control" id="id" name="id"
													    value="{{{ isset($data->id ) ? $data->id  : old('id') }}}">
													    <div class="label label-danger">{{ $errors->first("id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Id End -->
												
												<!-- Venta_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="venta_id" class="control-label"> Venta_id </label>
													    <input type="text" class="form-control" id="venta_id" name="venta_id"
													    value="{{{ isset($data->venta_id ) ? $data->venta_id  : old('venta_id') }}}">
													    <div class="label label-danger">{{ $errors->first("venta_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Venta_id End -->
												
												<!-- Almacen_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="almacen_id" class="control-label"> Almacen_id </label>
													    <input type="text" class="form-control" id="almacen_id" name="almacen_id"
													    value="{{{ isset($data->almacen_id ) ? $data->almacen_id  : old('almacen_id') }}}">
													    <div class="label label-danger">{{ $errors->first("almacen_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Almacen_id End -->
												
												<!-- Producto_id Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="producto_id" class="control-label"> Producto_id </label>
													    <input type="text" class="form-control" id="producto_id" name="producto_id"
													    value="{{{ isset($data->producto_id ) ? $data->producto_id  : old('producto_id') }}}">
													    <div class="label label-danger">{{ $errors->first("producto_id") }}</div>
												   </div>
													</div>
												</div>
												<!-- Producto_id End -->
												
												<!-- Variante Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="variante" class="control-label"> Variante </label>
													    <input type="text" class="form-control" id="variante" name="variante"
													    value="{{{ isset($data->variante ) ? $data->variante  : old('variante') }}}">
													    <div class="label label-danger">{{ $errors->first("variante") }}</div>
												   </div>
													</div>
												</div>
												<!-- Variante End -->
												
												<!-- Cantidad Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="cantidad" class="control-label"> Cantidad </label>
													    <input type="text" class="form-control" id="cantidad" name="cantidad"
													    value="{{{ isset($data->cantidad ) ? $data->cantidad  : old('cantidad') }}}">
													    <div class="label label-danger">{{ $errors->first("cantidad") }}</div>
												   </div>
													</div>
												</div>
												<!-- Cantidad End -->
												
												<!-- Costo Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="costo" class="control-label"> Costo </label>
													    <input type="text" class="form-control" id="costo" name="costo"
													    value="{{{ isset($data->costo ) ? $data->costo  : old('costo') }}}">
													    <div class="label label-danger">{{ $errors->first("costo") }}</div>
												   </div>
													</div>
												</div>
												<!-- Costo End -->
												
												<!-- Ingreso_ml Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="ingreso_ml" class="control-label"> Ingreso_ml </label>
													    <input type="text" class="form-control" id="ingreso_ml" name="ingreso_ml"
													    value="{{{ isset($data->ingreso_ml ) ? $data->ingreso_ml  : old('ingreso_ml') }}}">
													    <div class="label label-danger">{{ $errors->first("ingreso_ml") }}</div>
												   </div>
													</div>
												</div>
												<!-- Ingreso_ml End -->
												
												<!-- Envio_ml Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="envio_ml" class="control-label"> Envio_ml </label>
													    <input type="text" class="form-control" id="envio_ml" name="envio_ml"
													    value="{{{ isset($data->envio_ml ) ? $data->envio_ml  : old('envio_ml') }}}">
													    <div class="label label-danger">{{ $errors->first("envio_ml") }}</div>
												   </div>
													</div>
												</div>
												<!-- Envio_ml End -->
												
												<!-- Comision_ml Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="comision_ml" class="control-label"> Comision_ml </label>
													    <input type="text" class="form-control" id="comision_ml" name="comision_ml"
													    value="{{{ isset($data->comision_ml ) ? $data->comision_ml  : old('comision_ml') }}}">
													    <div class="label label-danger">{{ $errors->first("comision_ml") }}</div>
												   </div>
													</div>
												</div>
												<!-- Comision_ml End -->
												
												<!-- Reembolso_ml Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="reembolso_ml" class="control-label"> Reembolso_ml </label>
													    <input type="text" class="form-control" id="reembolso_ml" name="reembolso_ml"
													    value="{{{ isset($data->reembolso_ml ) ? $data->reembolso_ml  : old('reembolso_ml') }}}">
													    <div class="label label-danger">{{ $errors->first("reembolso_ml") }}</div>
												   </div>
													</div>
												</div>
												<!-- Reembolso_ml End -->
												
												<!-- Ganancia Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="ganancia" class="control-label"> Ganancia </label>
													    <input type="text" class="form-control" id="ganancia" name="ganancia"
													    value="{{{ isset($data->ganancia ) ? $data->ganancia  : old('ganancia') }}}">
													    <div class="label label-danger">{{ $errors->first("ganancia") }}</div>
												   </div>
													</div>
												</div>
												<!-- Ganancia End -->
												
												<!-- Pventa Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="pventa" class="control-label"> Pventa </label>
													    <input type="text" class="form-control" id="pventa" name="pventa"
													    value="{{{ isset($data->pventa ) ? $data->pventa  : old('pventa') }}}">
													    <div class="label label-danger">{{ $errors->first("pventa") }}</div>
												   </div>
													</div>
												</div>
												<!-- Pventa End -->
												
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
