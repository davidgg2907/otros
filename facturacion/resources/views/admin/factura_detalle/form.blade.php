

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
												
												<!-- ClaveProdServ Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="ClaveProdServ" class="control-label"> ClaveProdServ </label>
													    <input type="text" class="form-control" id="ClaveProdServ" name="ClaveProdServ"
													    value="{{{ isset($data->ClaveProdServ ) ? $data->ClaveProdServ  : old('ClaveProdServ') }}}">
													    <div class="label label-danger">{{ $errors->first("ClaveProdServ") }}</div>
												   </div>
													</div>
												</div>
												<!-- ClaveProdServ End -->
												
												<!-- NoIdentificacion Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="NoIdentificacion" class="control-label"> NoIdentificacion </label>
													    <input type="text" class="form-control" id="NoIdentificacion" name="NoIdentificacion"
													    value="{{{ isset($data->NoIdentificacion ) ? $data->NoIdentificacion  : old('NoIdentificacion') }}}">
													    <div class="label label-danger">{{ $errors->first("NoIdentificacion") }}</div>
												   </div>
													</div>
												</div>
												<!-- NoIdentificacion End -->
												
												<!-- Cantidad Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="Cantidad" class="control-label"> Cantidad </label>
													    <input type="text" class="form-control" id="Cantidad" name="Cantidad"
													    value="{{{ isset($data->Cantidad ) ? $data->Cantidad  : old('Cantidad') }}}">
													    <div class="label label-danger">{{ $errors->first("Cantidad") }}</div>
												   </div>
													</div>
												</div>
												<!-- Cantidad End -->
												
												<!-- ClaveUnidad Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="ClaveUnidad" class="control-label"> ClaveUnidad </label>
													    <input type="text" class="form-control" id="ClaveUnidad" name="ClaveUnidad"
													    value="{{{ isset($data->ClaveUnidad ) ? $data->ClaveUnidad  : old('ClaveUnidad') }}}">
													    <div class="label label-danger">{{ $errors->first("ClaveUnidad") }}</div>
												   </div>
													</div>
												</div>
												<!-- ClaveUnidad End -->
												
												<!-- Unidad Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="Unidad" class="control-label"> Unidad </label>
													    <input type="text" class="form-control" id="Unidad" name="Unidad"
													    value="{{{ isset($data->Unidad ) ? $data->Unidad  : old('Unidad') }}}">
													    <div class="label label-danger">{{ $errors->first("Unidad") }}</div>
												   </div>
													</div>
												</div>
												<!-- Unidad End -->
												
												<!-- Descripcion Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="Descripcion" class="control-label"> Descripcion </label>
													    <input type="text" class="form-control" id="Descripcion" name="Descripcion"
													    value="{{{ isset($data->Descripcion ) ? $data->Descripcion  : old('Descripcion') }}}">
													    <div class="label label-danger">{{ $errors->first("Descripcion") }}</div>
												   </div>
													</div>
												</div>
												<!-- Descripcion End -->
												
												<!-- ValorUnitario Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="ValorUnitario" class="control-label"> ValorUnitario </label>
													    <input type="text" class="form-control" id="ValorUnitario" name="ValorUnitario"
													    value="{{{ isset($data->ValorUnitario ) ? $data->ValorUnitario  : old('ValorUnitario') }}}">
													    <div class="label label-danger">{{ $errors->first("ValorUnitario") }}</div>
												   </div>
													</div>
												</div>
												<!-- ValorUnitario End -->
												
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
