<div class="col-md-3">
	<div class="panel panel-default">
		<div class="panel-heading">Fotografia </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Logotipo Start -->
				<div class="col-md-12">
					<div class="form-group">
			     	<input type="file" name="logotipo" class="dropify"
						<?php if($data->logotipo) { ?>
								data-default-file="<?php echo asset('uploads/empresa/' . $data->logotipo) ?>"
						<?php } ?>
						/>
			      <input type="hidden" name="old_imagen" value="<?php echo $data->logotipo; ?>" />
			      <div class="label label-danger"><?php echo e($errors->first("imagen")); ?></div>
			    </div>
			  </div>
				<!-- Logotipo End -->

			</div>
		</div>
	</div>
</div>

<div class="col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">Datos Generales </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Nombre Start -->
				<div class="col-md-12">
				 <div class="form-group">
				  <label for="nombre" class="control-label"> Nombre </label>
				    <input type="text" class="form-control" id="nombre" name="nombre"
				    value="<?php echo e(isset($data->nombre ) ? $data->nombre  : old('nombre')); ?>">
				    <div class="label label-danger"><?php echo e($errors->first("nombre")); ?></div>
				 </div>
				</div>
				<!-- Nombre End -->

				<div class="col-md-12">
				 <div class="form-group">
				  <p> <br/> </p>
				 </div>
				</div>

				<!-- Telefono Start -->
				<div class="col-md-6">
				 <div class="form-group">
				  <label for="telefono" class="control-label"> Telefono </label>
				    <input type="text" class="form-control" id="telefono" name="telefono"
				    value="<?php echo e(isset($data->telefono ) ? $data->telefono  : old('telefono')); ?>">
				    <div class="label label-danger"><?php echo e($errors->first("telefono")); ?></div>
				 </div>
				</div>
				<!-- Telefono End -->

				<!-- Celular Start -->
				<div class="col-md-6">
				 <div class="form-group">
				  <label for="celular" class="control-label"> Celular </label>
				    <input type="text" class="form-control" id="celular" name="celular"
				    value="<?php echo e(isset($data->celular ) ? $data->celular  : old('celular')); ?>">
				    <div class="label label-danger"><?php echo e($errors->first("celular")); ?></div>
				 </div>
				</div>
				<!-- Celular End -->


			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Domicilio</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<div class="row">

					<div class="col-md-2">
					 <div class="form-group">
						<label for="nombre" class="control-label">  C. Postal </label>
							<input type="text" class="form-control" id="cp" name="cp"
							value="<?php echo e(isset($data->cp ) ? $data->cp  : old('cp')); ?>">
							<div class="label label-danger"><?php echo e($errors->first("cp")); ?></div>
					 </div>
					</div>

					<div class="col-md-7">
					 <div class="form-group">
						<label for="nombre" class="control-label">Calle y Num</label>
							<input type="text" class="form-control address" id="direccion" name="direccion" onchange="getAddress()"
							value="<?php echo e(isset($data->direccion ) ? $data->direccion  : old('direccion')); ?>">
					 </div>
					</div>

					<div class="col-md-3">
					 <div class="form-group">
						<label for="nombre" class="control-label">Colonia </label>
						<select class="form-control address" id="colonia" name="colonia" onchange="getAddress()">
							<option value="">[ SELECCIONE ]</option>
						</select>
					 </div>
					</div>

					<div class="col-md-6">
					 <div class="form-group">
						<label for="nombre" class="control-label">Ciudad </label>
							<input type="text" class="form-control address" id="ciudad" name="ciudad" onchange="getAddress()"
							value="<?php echo e(isset($data->ciudad ) ? $data->ciudad  : old('ciudad')); ?>">
					 </div>
					</div>

					<div class="col-md-6">
					 <div class="form-group">
						<label for="nombre" class="control-label">Estado </label>
							<input type="text" class="form-control address" id="estado" name="estado" onchange="getAddress()"
							value="<?php echo e(isset($data->estado ) ? $data->estado  : old('estado')); ?>">
					 </div>
					</div>

				</div>
				<div class="row">
					<div id="map"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Parametros</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<div class="row">

					<div class="col-md-4">
					 <div class="form-group">
						<label for="nombre" class="control-label">  Valor de Impuesto ( IVA ) </label>
						<div class="input-group">
							<input type="text" class="form-control" name="impuesto" id="impuesto"
										 value="<?php echo e(isset($data->impuesto ) ? round($data->impuesto,2)  : old('impuesto')); ?>">
							<span class="input-group-addon"> % </span>
						</div>
						<div class="label label-danger"><?php echo e($errors->first("impuesto")); ?></div>
					 </div>
					</div>


					<div class="col-md-8">
					 <div class="form-group">
						<label for="nombre" class="control-label">  Coreo Electronico </label>
							<input type="text" class="form-control" name="correo" id="correo"
										 value="<?php echo e(isset($data->correo ) ? $data->correo  : old('correo')); ?>">
						</div>
				 </div>


				 <div class="col-md-12">
					<div class="form-group">
						<label for="nombre" class="control-label">  Concepto de hospedaje por hospitalizacion </label>
						<div class="input-group">
							<input type="text" class="form-control" name="hospedaje" id="hospedaje"
 										value="<?php echo e(isset($data->hospedaje ) ? $data->hospedaje  : old('hospedaje')); ?>">
							<span class="input-group-addon"> Aplica IVA </span>
							<select class="form-control" name="hospedaje_iva" id="hospedaje_iva">
								<option value="0" <?php if($data->hospedaje_iva == 0) { echo 'selected'; } ?>>NO</option>
								<option value="1" <?php if($data->hospedaje_iva == 1) { echo 'selected'; } ?>>SI</option>
							</select>
						</div>



					 </div>
				</div>

				</div>

			</div>
		</div>
	</div>
</div>


<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Redes Sociales </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<input type="hidden" class="form-control" id="status" name="status" value="1">

				<!-- Twitter Start -->
				<div class="col-md-4">
				 <div class="form-group">
				  <label for="twitter" class="control-label"> Twitter </label>
					<div class="input-group">
						<span class="input-group-btn">
							 <button title="Agregar Producto" type="button" class="btn waves-effect waves-light btn-info"><i class="fa fa-twitter"></i></button>
						</span>
						<input type="text" class="form-control" id="twitter" name="twitter" value="<?php echo e(isset($data->twitter ) ? $data->twitter  : old('twitter')); ?>">
					 </div>
				    <div class="label label-danger"><?php echo e($errors->first("twitter")); ?></div>
				 </div>
				</div>
				<!-- Twitter End -->

				<!-- Facebook Start -->
				<div class="col-md-4">
				 <div class="form-group">
				  <label for="facebook" class="control-label"> Facebook </label>
					<div class="input-group">
						<span class="input-group-btn">
							 <button title="Agregar Producto" type="button" class="btn waves-effect waves-light btn-info"><i class="fa fa-facebook"></i></button>
						</span>
						<input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo e(isset($data->facebook ) ? $data->facebook  : old('facebook')); ?>">
					 </div>
				    <div class="label label-danger"><?php echo e($errors->first("facebook")); ?></div>
				 </div>
				</div>
				<!-- Facebook End -->

				<!-- Instagram Start -->
				<div class="col-md-4">
				 <div class="form-group">
				  <label for="instagram" class="control-label"> Instagram </label>
					<div class="input-group">
						<span class="input-group-btn">
							 <button title="Agregar Producto" type="button" class="btn waves-effect waves-light btn-instagram"><i class="fa fa-instagram"></i></button>
						</span>
						<input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo e(isset($data->instagram ) ? $data->instagram  : old('instagram')); ?>">
					 </div>
				    <div class="label label-danger"><?php echo e($errors->first("instagram")); ?></div>
				 </div>
				</div>
				<!-- Instagram End -->

			</div>
		</div>
	</div>
</div>

<script>

 $('#cp').on('change',function(){

	 if($(this).val() != "") {

     $.ajax({
   		url: "https://api-sepomex.hckdrk.mx/query/info_cp/" + $(this).val() + "?type=simplified",
   		dataType: 'json',
   		contentType: "application/json; charset=utf-8",
   		success: function(json) {

         $('#estado').val(json['response'].estado);

         $('#ciudad').val(json['response'].municipio);

				 var html = '';

				 for(var i=0; i < json['response'].asentamiento.length; i++) {

					 var selected = "<?php echo $data->colonia; ?>";

					 var select = "";


					 if(selected == json['response'].asentamiento[i]) { select = "selected"; } else { select = ""; }
					 html += '<option value="' + json['response'].asentamiento[i] + '" ' + select + '>' + json['response'].asentamiento[i] + '</option>';

				 }

				 $('#colonia').html(html);

				 getAddress();

			}

   	});

   }

 });

 <?php if($data->cp) { echo "$('#cp').trigger('change')"; }?>

</script>
