<div class="col-md-6">
	<div class="card">
			<div class="card-header">
					<h4 class="card-title">Agregar traspasos</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<!-- Almacen_origen_id Start -->
					<div class="col-md-12">
						<div class="mb-1">
						 <div class="form-group">
							<label for="almacen_origen_id" class="control-label"> Origen </label>
							<select class="form-control" id="almacen_origen_id" name="almacen_origen_id" required>
								<option value="">[ SELECCIONE ]</option>
								<?php foreach(\App\admin\Almacenes::where('status',1)->get() as $origen) { ?>
									<option value="{{ $origen->id }}"> {{ $origen->nombre }} </option>
								<?php } ?>
							</select>
								<div class="label label-danger">{{ $errors->first("almacen_origen_id") }}</div>
						 </div>
						</div>
					</div>
					<!-- Almacen_origen_id End -->
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
				</div>
			</div>
		</div>
</div>

<div class="col-md-6">
	<div class="card">
			<div class="card-header">
					<h4 class="card-title">Agregar traspasos</h4>
			</div>
			<div class="card-body">
				<div class="row">

					<!-- Almacen_origen_id Start -->
					<div class="col-md-12">
						<div class="mb-1">
						 <div class="form-group">
							<label for="almacen_origen_id" class="control-label"> Destino </label>
							<select class="form-control" id="almacen_destino_id" name="almacen_destino_id" required>
								<option value="">[ SELECCIONE ]</option>
								<?php foreach(\App\admin\Almacenes::where('status',1)->get() as $origen) { ?>
									<option value="{{ $origen->id }}"> {{ $origen->nombre }} </option>
								<?php } ?>
							</select>
							<div class="label label-danger">{{ $errors->first("almacen_origen_id") }}</div>
						 </div>
						</div>
					</div>
					<!-- Almacen_origen_id End -->

				</div>
			</div>
			<div class="card-footer">
				<div class="row">
				</div>
			</div>
		</div>
</div>

<div class="col-md-12">
	<div class="card">
			<div class="card-header">
					<h4 class="card-title">Agregar traspasos</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<table class="table text-left">
						<thead>
							<tr>
								<th>Producto</th>
								<th>Existencia</th>
								<th>Enviar</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr id="itemsTranfer">
								<td colspan="4">
									<select class="form-control select2" name="product_select" id="product_select">
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
				</div>
			</div>
		</div>
</div>


@section('scripts')

<script>


$('#almacen_origen_id').on('change',function(){

	$.ajax({
		url: "<?php echo url('admin/inventario/ajax/'); ?>/" + $(this).val(),
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {

			//Eliminamos todas las opciones pretenencientes  otro almacen a transferir

			if(json['error'] == 0) {
				$('.itemsTransferencia').remove();
				$('#product_select').html(json['html']);
			} else {

			}

		}

	});

});


$('#product_select').on('change',function(){

	product_select

	$.ajax({
		url: "<?php echo url('admin/inventario/existencias/'); ?>/?almacen_id=" + $('#almacen_origen_id').val() + "&producto_id=" + $(this).val(),
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {

			if(json['error'] == 0) {

				$('#itemsTranfer').before(json['html']);
			}

		}

	});

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
