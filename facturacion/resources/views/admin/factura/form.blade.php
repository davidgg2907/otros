

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
												
												<!-- Emisor Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="emisor" class="control-label"> Emisor </label>
													    <input type="text" class="form-control" id="emisor" name="emisor"
													    value="{{{ isset($data->emisor ) ? $data->emisor  : old('emisor') }}}">
													    <div class="label label-danger">{{ $errors->first("emisor") }}</div>
												   </div>
													</div>
												</div>
												<!-- Emisor End -->
												
												<!-- MetodoPago Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="metodoPago" class="control-label"> MetodoPago </label>
													    <input type="text" class="form-control" id="metodoPago" name="metodoPago"
													    value="{{{ isset($data->metodoPago ) ? $data->metodoPago  : old('metodoPago') }}}">
													    <div class="label label-danger">{{ $errors->first("metodoPago") }}</div>
												   </div>
													</div>
												</div>
												<!-- MetodoPago End -->
												
												<!-- LugarExpedicion Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="lugarExpedicion" class="control-label"> LugarExpedicion </label>
													    <input type="text" class="form-control" id="lugarExpedicion" name="lugarExpedicion"
													    value="{{{ isset($data->lugarExpedicion ) ? $data->lugarExpedicion  : old('lugarExpedicion') }}}">
													    <div class="label label-danger">{{ $errors->first("lugarExpedicion") }}</div>
												   </div>
													</div>
												</div>
												<!-- LugarExpedicion End -->
												
												<!-- DegimenFiscal Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="degimenFiscal" class="control-label"> DegimenFiscal </label>
													    <input type="text" class="form-control" id="degimenFiscal" name="degimenFiscal"
													    value="{{{ isset($data->degimenFiscal ) ? $data->degimenFiscal  : old('degimenFiscal') }}}">
													    <div class="label label-danger">{{ $errors->first("degimenFiscal") }}</div>
												   </div>
													</div>
												</div>
												<!-- DegimenFiscal End -->
												
												<!-- Deceptor Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="deceptor" class="control-label"> Deceptor </label>
													    <input type="text" class="form-control" id="deceptor" name="deceptor"
													    value="{{{ isset($data->deceptor ) ? $data->deceptor  : old('deceptor') }}}">
													    <div class="label label-danger">{{ $errors->first("deceptor") }}</div>
												   </div>
													</div>
												</div>
												<!-- Deceptor End -->
												
												<!-- DomicilioReceptor Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="domicilioReceptor" class="control-label"> DomicilioReceptor </label>
													    <input type="text" class="form-control" id="domicilioReceptor" name="domicilioReceptor"
													    value="{{{ isset($data->domicilioReceptor ) ? $data->domicilioReceptor  : old('domicilioReceptor') }}}">
													    <div class="label label-danger">{{ $errors->first("domicilioReceptor") }}</div>
												   </div>
													</div>
												</div>
												<!-- DomicilioReceptor End -->
												
												<!-- RegimenFiscalReceptor Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="regimenFiscalReceptor" class="control-label"> RegimenFiscalReceptor </label>
													    <input type="text" class="form-control" id="regimenFiscalReceptor" name="regimenFiscalReceptor"
													    value="{{{ isset($data->regimenFiscalReceptor ) ? $data->regimenFiscalReceptor  : old('regimenFiscalReceptor') }}}">
													    <div class="label label-danger">{{ $errors->first("regimenFiscalReceptor") }}</div>
												   </div>
													</div>
												</div>
												<!-- RegimenFiscalReceptor End -->
												
												<!-- UsoCFDI Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="usoCFDI" class="control-label"> UsoCFDI </label>
													    <input type="text" class="form-control" id="usoCFDI" name="usoCFDI"
													    value="{{{ isset($data->usoCFDI ) ? $data->usoCFDI  : old('usoCFDI') }}}">
													    <div class="label label-danger">{{ $errors->first("usoCFDI") }}</div>
												   </div>
													</div>
												</div>
												<!-- UsoCFDI End -->
												
												<!-- Sello Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="sello" class="control-label"> Sello </label>
													    <input type="text" class="form-control" id="sello" name="sello"
													    value="{{{ isset($data->sello ) ? $data->sello  : old('sello') }}}">
													    <div class="label label-danger">{{ $errors->first("sello") }}</div>
												   </div>
													</div>
												</div>
												<!-- Sello End -->
												
												<!-- NoCertificado Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="noCertificado" class="control-label"> NoCertificado </label>
													    <input type="text" class="form-control" id="noCertificado" name="noCertificado"
													    value="{{{ isset($data->noCertificado ) ? $data->noCertificado  : old('noCertificado') }}}">
													    <div class="label label-danger">{{ $errors->first("noCertificado") }}</div>
												   </div>
													</div>
												</div>
												<!-- NoCertificado End -->
												
												<!-- Certificado Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="certificado" class="control-label"> Certificado </label>
													    <input type="text" class="form-control" id="certificado" name="certificado"
													    value="{{{ isset($data->certificado ) ? $data->certificado  : old('certificado') }}}">
													    <div class="label label-danger">{{ $errors->first("certificado") }}</div>
												   </div>
													</div>
												</div>
												<!-- Certificado End -->
												
												<!-- SubTotal Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="subTotal" class="control-label"> SubTotal </label>
													    <input type="text" class="form-control" id="subTotal" name="subTotal"
													    value="{{{ isset($data->subTotal ) ? $data->subTotal  : old('subTotal') }}}">
													    <div class="label label-danger">{{ $errors->first("subTotal") }}</div>
												   </div>
													</div>
												</div>
												<!-- SubTotal End -->
												
												<!-- Moneda Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="moneda" class="control-label"> Moneda </label>
													    <input type="text" class="form-control" id="moneda" name="moneda"
													    value="{{{ isset($data->moneda ) ? $data->moneda  : old('moneda') }}}">
													    <div class="label label-danger">{{ $errors->first("moneda") }}</div>
												   </div>
													</div>
												</div>
												<!-- Moneda End -->
												
												<!-- Total Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="total" class="control-label"> Total </label>
													    <input type="text" class="form-control" id="total" name="total"
													    value="{{{ isset($data->total ) ? $data->total  : old('total') }}}">
													    <div class="label label-danger">{{ $errors->first("total") }}</div>
												   </div>
													</div>
												</div>
												<!-- Total End -->
												
												<!-- TipoDeComprobante Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="tipoDeComprobante" class="control-label"> TipoDeComprobante </label>
													    <input type="text" class="form-control" id="tipoDeComprobante" name="tipoDeComprobante"
													    value="{{{ isset($data->tipoDeComprobante ) ? $data->tipoDeComprobante  : old('tipoDeComprobante') }}}">
													    <div class="label label-danger">{{ $errors->first("tipoDeComprobante") }}</div>
												   </div>
													</div>
												</div>
												<!-- TipoDeComprobante End -->
												
												<!-- UUID Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="UUID" class="control-label"> UUID </label>
													    <input type="text" class="form-control" id="UUID" name="UUID"
													    value="{{{ isset($data->UUID ) ? $data->UUID  : old('UUID') }}}">
													    <div class="label label-danger">{{ $errors->first("UUID") }}</div>
												   </div>
													</div>
												</div>
												<!-- UUID End -->
												
												<!-- FechaTimbrado Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="fechaTimbrado" class="control-label"> FechaTimbrado </label>
													    <input type="text" class="form-control" id="fechaTimbrado" name="fechaTimbrado"
													    value="{{{ isset($data->fechaTimbrado ) ? $data->fechaTimbrado  : old('fechaTimbrado') }}}">
													    <div class="label label-danger">{{ $errors->first("fechaTimbrado") }}</div>
												   </div>
													</div>
												</div>
												<!-- FechaTimbrado End -->
												
												<!-- RfcProvCertif Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="rfcProvCertif" class="control-label"> RfcProvCertif </label>
													    <input type="text" class="form-control" id="rfcProvCertif" name="rfcProvCertif"
													    value="{{{ isset($data->rfcProvCertif ) ? $data->rfcProvCertif  : old('rfcProvCertif') }}}">
													    <div class="label label-danger">{{ $errors->first("rfcProvCertif") }}</div>
												   </div>
													</div>
												</div>
												<!-- RfcProvCertif End -->
												
												<!-- SelloCFD Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="selloCFD" class="control-label"> SelloCFD </label>
													    <input type="text" class="form-control" id="selloCFD" name="selloCFD"
													    value="{{{ isset($data->selloCFD ) ? $data->selloCFD  : old('selloCFD') }}}">
													    <div class="label label-danger">{{ $errors->first("selloCFD") }}</div>
												   </div>
													</div>
												</div>
												<!-- SelloCFD End -->
												
												<!-- NoCertificadoSAT Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="noCertificadoSAT" class="control-label"> NoCertificadoSAT </label>
													    <input type="text" class="form-control" id="noCertificadoSAT" name="noCertificadoSAT"
													    value="{{{ isset($data->noCertificadoSAT ) ? $data->noCertificadoSAT  : old('noCertificadoSAT') }}}">
													    <div class="label label-danger">{{ $errors->first("noCertificadoSAT") }}</div>
												   </div>
													</div>
												</div>
												<!-- NoCertificadoSAT End -->
												
												<!-- SelloSAT Start -->
												<div class="col-md-6">
													<div class="mb-1">
													 <div class="form-group">
													  <label for="selloSAT" class="control-label"> SelloSAT </label>
													    <input type="text" class="form-control" id="selloSAT" name="selloSAT"
													    value="{{{ isset($data->selloSAT ) ? $data->selloSAT  : old('selloSAT') }}}">
													    <div class="label label-danger">{{ $errors->first("selloSAT") }}</div>
												   </div>
													</div>
												</div>
												<!-- SelloSAT End -->
												
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
