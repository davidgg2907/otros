<div class="card" id="searchItems">
	<div class="card-header">
			<h4 class="card-title">Buscar Venta</h4>
	</div>
	<div class="card-body">
		<div class="row">
			<!-- Proveedor_id Start -->
			<div class="col-md-4">
				<div class="mb-1">
				 <div class="form-group">
					<label for="proveedor_id" class="control-label"> Tienda </label>
					<select class="form-control select2" id="tienda_id" name="tienda_id">
						<option value="0">TODAS</option>
						<?php foreach(\App\admin\Tiendas::where('status',1)->get() as $provs) { ?>
							<option value="{{ $provs->id }}">{{ $provs->nombre }}</option>
						<?php } ?>
					</select>
						<div class="label label-danger">{{ $errors->first("proveedor_id") }}</div>
				 </div>
				</div>
			</div>
			<!-- Proveedor_id End -->

			<!-- Fecha Start -->
			<div class="col-md-4">
				<div class="mb-1">
				 <div class="form-group">
					<label for="fecha" class="control-label"> Folio M.L</label>
						<input type="text" class="form-control" id="folioml" name="folioml">
				 </div>
				</div>
			</div>
			<!-- Fecha End -->


			<div class="col-md-4">
				<div class="mb-1">
				 <div class="form-group">
					<label for="fecha" class="control-label"> S.k.U</label>
						<input type="text" class="form-control" id="sku" name="sku">
				 </div>
				</div>
			</div>


		</div>
	</div>
	<div class="card-footer">
		<div class="row">
			<div class="col-md-10">
			</div>
			<div class="col-md-2">
				<button type="button" onclick="buscarVta();" class="btn btn-relief-info w-100 mb-75 waves-effect"><i class="fa fa-search fa-lg"></i> Buscar </button>
			</div>
		</div>
	</div>
</div>


<div class="card" id="viewItems" style="display:none">
		<div class="card-header">
				<h4 class="card-title">Productos a Devolver</h4>
		</div>
		<div class="card-body table-responsive">
			<table class="table text-left">
				<thead>
					<thead>
						<tr>
							<th>Folio</th>
							<th>Cliente</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Cant. Ingresar</th>
							<th></th>
						</tr>
					</thead>
				</thead>
				<tbody id="itemsView">

				</tbody>
				<tfoot>
				</tr>
					<td colspan="6"><b>Motivo de la Devolucion</b></td>
				</tr>
				</tr>
					<td colspan="6">
						<textarea class="form-control" name="motivo" id="motivo" rows="5"></textarea>
					</td>
				</tr>
					<tr>
						<td colspan="4"><b>Tipo de Movimiento</b></td>
						<td colspan="2">
							<select class="form-control select2" id="situacion" name="situacion">
								<option value="1">Ingresar a almacen</option>
								<option value="2">Enviar a Garantia</option>
								<option value="3">Producto Dañado, Desechar</option>
								<option value="4">Reparacion</option>
							</select>
						</td>
					<tr>
				</tfoot>
			</table>
		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-md-3">
					<button type="button" onclick="atras()" class="btn btn-relief-warning w-100 mb-75 waves-effect"><i class="fa fa-search fa-lg"></i> Buscar Otra Venta </button>
				</div>
				<div class="col-md-6">
				</div>
				<div class="col-md-3">
					<button type="submit" class="btn btn-relief-success w-100 mb-75 waves-effect"><i class="fa fa-check fa-lg"></i> Procesar Devolucion/Garantia </button>
				</div>
			</div>
		</div>
	</div>

@section('scripts')

<script>

function buscarVta() {


	if($('#tienda_id').val() == "" || $('#tienda_id').val() == "" || $('#tienda_id').val() == "" ) {
		Swal.fire({
			title: ' ¡ ATENCION !',
			text: "Debe especificiar al menos un campo para realizar la busqueda",
			icon: 'warning',
			customClass: {
				confirmButton: 'btn btn-danger'
			},
			buttonsStyling: false
		});
		return false;
	}

	var parametros = '?tienda_id=' + $('#tienda_id').val();
			parametros += '&folioml=' + $('#folioml').val();
			parametros += '&sku=' + $('#sku').val();

		$.ajax({
			url: "<?php echo url('admin/ventas/devolver'); ?>/" + parametros,
			dataType: 'json',
			contentType: "application/json; charset=utf-8",
			success: function(json) {

				if(json['error'] == 0) {

					$('#itemsView').html(json['html']);
					$('#searchItems').fadeOut();
					$('#viewItems').fadeIn();

				} else {
					Swal.fire({
						title: ' ¡ ATENCION !',
						text: "No se encontraron ventas que conincidan con su filtro solicitado",
						icon: 'warning',
						customClass: {
							confirmButton: 'btn btn-danger'
						},
						buttonsStyling: false
					});
				}

			}

		});

}

function atras() {
	$('#itemsView').html('');
	$('#searchItems').fadeIn();
	$('#viewItems').fadeOut();
}

var bootstrapForm = $('.needs-validation'),
jqForm = $('#jquery-val-form'),
picker = $('.picker'),
select = $('.select2');


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
