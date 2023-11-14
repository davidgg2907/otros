<div class="col-md-12">
	<div class="card">
		<div class="card-header">
				<h4 class="card-title">Cliente al que se le realiza la venta</h4>
		</div>
		<div class="card-body">
			<div class="row">

				<!-- Cliente_id Start -->
				<div class="col-md-12">
					<div class="mb-1">
					 <div class="form-group">
						<select class="form-control" id="cliente_id" name="cliente_id" required>
							<option value="">[ Seleccione ]</option>
							@foreach(\App\admin\Clientes::where('status',1)->get() as $value)
								<option value="{{ $value->id }}"> {{ $value->nombre }} </option>
							@endforeach
						</select>
						<div class="label label-danger">{{ $errors->first("cliente_id") }}</div>
					 </div>
					</div>
				</div>
				<!-- Cliente_id End -->

			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
				<h4 class="card-title">Detalle de la compra</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Producto</th>
							<th>Costo</th>
							<th>Cantidad</th>
							<th>Importe</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr id="items_content">
							<td colspan="5">
								<select class="form-control" name="" id="producto_id">
									<option value="">[ Seleccione ]</option>
									@foreach(\App\admin\Productos::where('status',1)->where('tipo',1)->get() as $prods)
										<option value="{{ $prods->id }}"> {{ $prods->nombre }}</option>
									@endforeach
								</select>
							</td>
						</tr>
					</tbody>
					<tfoter>
						<tr>
							<td style="text-align:right" colspan="3"><h4>Subtotal</h4></td>
							<td colspan="2">
								<input type="hidden" class="form-control" id="subtotal" name="subtotal">
								<span id="lblSubtotal"> $ 0.0</span>
							</td>
						</tr>
						<tr>
							<td style="text-align:right" colspan="3"><h4>Impuestos</h4></td>
							<td colspan="2">
								<input type="hidden" class="form-control" id="impuestos" name="impuestos">
								<span id="lblIva"> $ 0.0</span>
							</td>
						</tr>
						<tr>
							<td style="text-align:right" colspan="3"><h4>Total</h4></td>
							<td colspan="2">
								<input type="hidden" class="form-control" id="total" name="total">
								<span id="lblTotal"> $ 0.0</span>
							</td>
						</tr>
					</tfoter>
				</table>
			</div>
		</div>
	</div>
</div>

<input type="hidden" class="form-control" id="status" name="status" value="{{{ isset($data->status ) ? $data->status  : '1' }}}">

@section('scripts')

<script>


var items = 1;

function agregarProducto() {

	var html = '<tr id="items_shop_' + items + '">';
				html += '<td style="width:25%"> <h4>';
					html += '<input type="hidden" class="form-control" name="compras[_' + items + '][producto_id]" id="producto_id_' + items + '" value="' + $('#producto_id').val() +'"/>';
					html += $('#producto_id option:selected').text();
				html += ' </h4></td>';
				html += '<td>';
					html += '<div class="input-group">';
				    html += '<span class="input-group-text" id="basic-addon1"> <i class="fa fa-sort-numeric-up-alt fa-lg"></i> </span>';
						html += '<input type="text" class="form-control" name="compras[_' + items + '][cantidad]" id="cantidad_' + items + '" value="1" onchange="calculaImporte(' + items + ')"/>';
					html += '</div>';
				html += '</td>';
				html += '<td>';
					html += '<div class="input-group">';
						html += '<span class="input-group-text" id="basic-addon1"> $ </span>';
						html += '<input type="text" class="form-control" name="compras[_' + items + '][precio]" id="precio_' + items + '" value="1" onchange="calculaImporte(' + items + ')"/>';
					html += '</div>';
				html += '</td>';
				html += '<td>';

					html += '<div class="input-group">';
						html += '<span class="input-group-text" id="basic-addon1"> $ </span>';
						html += '<input type="text" class="form-control importes" name="compras[_' + items + '][importe]" id="importe_' + items + '" value="1" onchange="calculaImporte(' + items + ')" readonly/>';
					html += '</div>';
				html += '</td>';
				html += '<td style="width:5%">';
					html += '<button class="btn btn-danger w-100 btn-icon" type="button" title="Agregar Producto" onclick="eliminaProducto(' + items + ')">';
						html += '<i class="fa fa-times-circle fa-lg"></i>';
					html += '</button>';
				html += '</td>';
			html += '</tr>';

	$('#producto_id').val('');
	$('#items_content').after(html);
	items++;
	calculaTotales();

}

function calculaTotales() {

	var importes 		= 0;
	var subtotal 		= 0;
	var iva 				= 0;
	var total 			= 0;
	var porcentaje	= parseFloat({{ (int)\App\admin\Configuracion::getConfig()->iva }});
	var valor_iva 	= 0;
	var valor_div		= parseFloat( '1.' + {{ (int)\App\admin\Configuracion::getConfig()->iva }});

	if(isNaN(porcentaje)) {

		porcentaje = 0;
		valor_iva  = 0;

	} else {
		valor_iva  = porcentaje / 100;
	}




	$('.importes').each(function() {

		importes = parseFloat($(this).val());

		if(isNaN(importes)) { importes = 0; }
		subtotal = subtotal + importes

	});

	<?php if(\App\admin\Configuracion::getConfig()->aplicacion_iva == 1) { ?>
		iva = subtotal * valor_iva;
		total = subtotal + iva;
	<?php } else { ?>

		var valor_siniva = subtotal / valor_div;
		iva = subtotal - valor_siniva;
		total = subtotal;
		subtotal = valor_siniva;
	<?php } ?>

	$('#subtotal').val(subtotal.toFixed(2));
	$('#impuestos').val(iva.toFixed(2));
	$('#total').val(total.toFixed(2));

	$('#lblSubtotal').html(subtotal.toFixed(2));
	$('#lblIva').html(iva.toFixed(2));
	$('#lblTotal').html(total.toFixed(2));

}

function eliminaProducto(index) {

	Swal.fire({
		title: 'Eliminar Producto',
		text: "Eliminar el producto de la lista de compras",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si Eliminar',
		customClass: {
			confirmButton: 'btn btn-primary',
			cancelButton: 'btn btn-outline-danger ms-1'
		},
		buttonsStyling: false
	}).then(function (result) {
		if (result.value) {
			$('#items_shop_' + index).remove()
		}
	});

}

function calculaImporte(index) {

	var cantidad = parseFloat($('#cantidad_' + index).val());
	var precio = parseFloat($('#precio_' + index).val());

	if(isNaN(cantidad)) { cantidad = 0; }
	if(isNaN(precio)) { precio = 0; }

	var importe = cantidad * precio;

	$('#importe_' + index).val(importe.toFixed(2));
	calculaTotales();

}

$('#producto_id').on('change',function(){
	agregarProducto();
});


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
