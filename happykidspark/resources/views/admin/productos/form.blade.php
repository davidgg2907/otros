<div class="col-md-3">
	<div class="card">
		<div class="card-header">
      <h4 class="card-title">Imagen</h4>
    </div>
		<div class="card-body">
			<div class="row">
				<!-- Photo Start -->
				<div class="col-md-12">
					<div class="align-self-center halfway-fab text-center" id="imgPreview">
							<?php if($data->imagen) { ?>
								<img onclick="$('#profile_image').trigger('click')" src="{{ asset('uploads/' . $data->imagen) }}" class="img-border gradient-summer" height="240" width="100%" alt="Card image">
							<?php } else { ?>
								<img onclick="$('#profile_image').trigger('click')" src="{{ asset('/') }}images/portrait/small/avatar-s-4.jpg" class="img-border gradient-summer " height="240" width="100%" alt="Card image">
							<?php } ?>
					</div>
					<input type="file" name="imagen" class="images_select" id="profile_image" style="display:none" data-indice="0" />
				</div>
				<!-- Photo End -->
			</div>
		</div>
	</div>
</div>

<div class="col-md-9">
	<div class="card">
		<div class="card-header">
				<h4 class="card-title">Agregar productos</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<!-- Categoria_id Start -->
				<div class="col-md-4">
					<div class="mb-1">
					 <div class="form-group">
					  <label for="categoria_id" class="control-label"> Categoria </label>
						<div class="input-group mb-2">
							<span class="input-group-text" id="basic-addon1"> <i class="fa fa-sitemap"></i> </span>
							<select class="form-control" id="categoria_id" name="categoria_id" required>
								<option value="">[ Seleccione ]</option>
								<?php foreach(\App\admin\Categorias::where('status',1)->get() as $cats) { ?>
									<option value="{{ $cats->id }}" @if($data->categoria_id == $cats->id) selected @endif>{{ $cats->nombre }}</option>
								<?php } ?>
							</select>
						</div>
					  <div class="label label-danger">{{ $errors->first("categoria_id") }}</div>
				   </div>
					</div>
				</div>
				<!-- Categoria_id End -->

				<!-- Tipo Start -->
				<div class="col-md-4">
					<div class="mb-1">
					 <div class="form-group">
					  <label for="tipo" class="control-label"> Tipo de Costo</label>
						<div class="input-group mb-2">
							<select class="form-control" id="tipo" name="tipo" required>
								<option value="">[ Seleccione ]</option>
								@foreach(\App\admin\Productos::TIPOS as $key => $tipo)
									<option value="{{ $key }}" @if($data->tipo == $key) selected @endif>{{ $tipo }}</option>
								@endforeach
							</select>
							<span class="input-group-text" id="basic-addon1"> <i class="fa fa-question-circle fa-lg"></i> </span>
						</div>
					    <div class="label label-danger">{{ $errors->first("tipo") }}</div>
				   </div>
					</div>
				</div>
				<!-- Tipo End -->

				<!-- Impuesto Start -->
				<div class="col-md-4">
					<div class="mb-1">
					 <div class="form-group">
					  <label for="impuesto" class="control-label"> Inventariable </label>
						<select class="form-control" id="inventariable" name="inventariable" required>
							<option value="1" <?php if($data->inventariable == 1) { echo 'selected'; } ?>>SI</option>
							<option value="0" <?php if($data->inventariable == 0) { echo 'selected'; } ?>>NO</option>
						</select>
				   </div>
					</div>
				</div>
				<!-- Impuesto End -->

				<input type="hidden" class="form-control" id="impuesto" name="nombre" value="0">

				<!-- Nombre Start -->
				<div class="col-md-8">
					<div class="mb-1">
					 <div class="form-group">
					  <label for="nombre" class="control-label"> Nombre </label>
						<div class="input-group mb-2">
							<span class="input-group-text" id="basic-addon1"> <i class="fa fa-shopping-cart"></i> </span>
							<input type="text" class="form-control" id="nombre" name="nombre" required
					    value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
						</div>
					    <div class="label label-danger">{{ $errors->first("nombre") }}</div>
				   </div>
					</div>
				</div>
				<!-- Nombre End -->

				<!-- Precio Start -->
				<div class="col-md-4">
					<div class="mb-1">
					 <div class="form-group">
					  <label for="precio" class="control-label"> Precio </label>
						<div class="input-group mb-2">
					    <span class="input-group-text" id="basic-addon1"> $</span>
							<input type="text" class="form-control" id="precio" name="precio" required
					    value="{{{ isset($data->precio ) ? round($data->precio,0)  : old('precio') }}}">
							<span class="input-group-text" id="basic-addon1"> CPL	</span>
						</div>
					   <div class="label label-danger">{{ $errors->first("precio") }}</div>
				   </div>
					</div>
				</div>
				<!-- Precio End -->



				<!-- Precio Start -->
				<div class="col-md-12">
					<div class="mb-1">
					 <div class="form-group">
					  <label for="precio" class="control-label"> Descripcion </label>
						<div class="input-group mb-2">
					    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-list fa-lg"></i> </span>
							<input type="text" class="form-control" id="descripcion" name="descripcion"
					    value="{{{ isset($data->descripcion ) ? $data->descripcion  : old('descripcion') }}}">
						</div>
					   <div class="label label-danger">{{ $errors->first("precio") }}</div>
				   </div>
					</div>
				</div>
				<!-- Precio End -->

			</div>
		</div>
	</div>
</div>

<div class="col-md-12" id="kitContent" style="<?php if($data->tipo == '2') { echo 'display:block'; } else { echo 'display:none'; }?>">
	<div class="card">
			<div class="card-header">
					<h4 class="card-title">Productos de Kit</h4>
			</div>
			<div class="card-body">
				<div class="row">

					<table class="table text-left">
						<thead>
							<tr>
								<th>Producto</th>
								<th>Cantidad</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php $itemsKit = 0; ?>
							<?php foreach(\App\admin\Adjuntos::where('producto_id',$data->id)->get() as $adjuntos) { ?>
								<tr id="itemsKit{{ $adjuntos->id }}" class="itemsKitElements">
									<td>
										<input type="hidden" class="form-control" value="{{ $adjuntos->producto_adjunto_id }}" name="adjuntos[{{ $itemsKit }}][producto_id]"  id="producto_id_adjunto{{ $adjuntos->id }}" />
										{{ $adjuntos->adjunto->nombre }}
									</td>
									<td>
										<input type="hidden" class="form-control" data-indice="{{ $adjuntos->id }}" value="{{ $adjuntos->cantidad }}" name="adjuntos[{{ $itemsKit }}][cantidad]"  id="cant_adjunto{{ $adjuntos-id }}" />
										{{ $adjuntos->cantidad }} Pzs
									</td>
									<td>
										<button type="button" onclick="removeItems({{ $adjuntos->id }});" class="btn btn-danger rounded-circle btn-icon"> <i class="fa fa-times fa-lg" title="AGREGAR PRODUCTO A KIT"></i> </button>
									</td>
								</tr>
								<?php $itemsKit++; ?>
							<?php } ?>
							<tr id="itemsKit">
								<td style="width:50%">
									<select class="form-control select2" name="prod_adjunto_id" id="prod_adjunto_id">
										<option value="">[ SELECCIONE ]</option>
										<?php foreach(\App\admin\Productos::where('status',1)->where('tipo',1)->get() as $value) { ?>
											<option value="{{ $value->id }}">{{ $value->nombre }}</option>
										<?php } ?>
									</select>
								</td>
								<th><input class="form-control" name="cant_adjunto"  id="cant_adjunto" /></th>
								<th>
									<button type="button" onclick="addItems();" class="btn btn-info rounded-circle btn-icon"> <i class="fa fa-plus fa-lg" title="AGREGAR PRODUCTO A KIT"></i> </button>
								</th>
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

<input type="hidden" class="form-control" id="status" name="status" value="{{{ isset($data->status ) ? $data->status  : '1' }}}">

@section('scripts')

<script>

var bootstrapForm = $('.needs-validation'),
jqForm = $('#jquery-val-form');

$('#tipo').on('change',function() {

	if($(this).val() == "2") {
		$('#kitContent').fadeIn();
		$('#precio').val('0');
		$('#precio').attr('readonly','readonly');
		costo_kit =0;
	} else {
		$('#kitContent').fadeOut();
		$('#precio').removeAttr('readonly');
		$('.itemsKitElements').remove();
		costo_kit =0;
	}
});

var itemsKit  	= 0;
var costo_kit 	= 0;
var precio_kit 	= 0;

function addItems() {

	var html = '<tr id="itemsKit' + itemsKit + '" class="itemsKitElements">';
				html += '<td>';
					html += '<input type="hidden" class="form-control" value="' + $('#prod_adjunto_id').val() + '" name="adjuntos[' + itemsKit + '][producto_id]"  id="producto_id_adjunto' + itemsKit + '" />' + $('#prod_adjunto_id option:selected').text();
				html += '</td>';
				html += '<td>';
					html += '<input type="hidden" class="form-control " data-indice="' + itemsKit + '" value="' + $('#cant_adjunto').val() + '" name="adjuntos[' + itemsKit + '][cantidad]""  id="cant_adjunto_' + itemsKit + '" />';
					html += $('#cant_adjunto').val() + ' Pzs';
					html += '</td>';
				html += '<td>';
					html += '<button type="button" onclick="removeItems(' + itemsKit + ');" class="btn btn-danger rounded-circle btn-icon"> <i class="fa fa-times fa-lg" title="AGREGAR PRODUCTO A KIT"></i> </button>';
				html += '</td>';
			html += '</tr>';
	$('#itemsKit').before(html);
	itemsKit++;

}

function readURL(input,indice) {
  if (input.files && input.files[0]) {
		$('#imgPreview' + indice).html('');
	  var reader = new FileReader();
    reader.onload = function(e) {
	   $('#imgPreview').html('<img src="' + e.target.result + '" class="img-border gradient-summer" height="240" width="100%">');
    }
    reader.readAsDataURL(input.files[0]);
  } else {
    $('#imgPreview').attr('src', '<img src="{{ asset('/') }}/img/portrait/avatars/avatar-08.png" class="rounded-circle img-border gradient-summer " height="200" alt="Card image">');
  }
}

function removeItems(index) {

	Swal.fire({
		title: 'Quitar producto del KIT',
		text: "¿Realmente desea realizar esta operación?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si',
		customClass: {
			confirmButton: 'btn btn-primary',
			cancelButton: 'btn btn-outline-danger ms-1'
		},
		buttonsStyling: false
	}).then(function (result) {
		if (result.value) {

			//Eliminamos el item
			$('#itemsKit' + index).remove();
			recalculaCostoPrecioKit();
		}
	});

}


$(document).on('change', '.images_select', function () {

	var indice = $(this).attr('data-indice');

	readURL(this,indice);

});

$(document).ready(function () {
  'use strict'; // Fetch all the forms we want to apply custom Bootstrap validation styles to

  var forms = document.getElementsByClassName('needs-validation'); // Loop over them and prevent submission

  var validation = Array.prototype.filter.call(forms, function (form) {
    form.addEventListener('submit', function (event) {

			if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }else {

				procesando();

			}

      form.classList.add('was-validated');
    }, false);
  });
});


</script>

@endsection
