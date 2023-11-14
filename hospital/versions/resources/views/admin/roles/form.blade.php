<div class="panel">
	<div class="panel-wrapper collapse in" aria-expanded="true">
		<div class="panel-heading">Datos Generales</div>
		<div class="panel-body">

			<!-- Name Start -->
			<div class="col-md-9">
			 <div class="form-group">
			  <label for="name" class="control-label"> Nombre o descripcion del rol </label>
			    <input type="text" class="form-control" id="name" name="name" value="{{{ isset($data->name ) ? $data->name  : old('name') }}}">
					<input type="hidden" class="form-control" id="status" name="status" value="1">
					<input type="hidden" class="form-control" id="perfil" name="perfil" value="1">

					<input type="hidden" class="form-control" id="visual" name="visual" value="1">
			    <div class="label label-danger">{{ $errors->first("name") }}</div>
			 </div>
			</div>
			<!-- Name End -->


			<!-- Name Start -->
			<div class="col-md-3">
			 <div class="form-group">
			  <label for="name" class="control-label"> Visulizacion de Informacion </label>
				<select class="form-control" id="visual" name="visual">
					<option value="1" <?php if($data->visual == 1) { echo 'selected'; } ?>> TODA LA INFORMACION </option>
					<option value="2" <?php if($data->visual == 2) { echo 'selected'; } ?>> SOLO SU INFORMACION </option>
				</select>
			    <div class="label label-danger">{{ $errors->first("name") }}</div>
			 </div>
			</div>
			<!-- Name End -->

		</div>

	</div>
</div>

<div class="panel">
	<div class="panel-wrapper collapse in" aria-expanded="true">
		<div class="panel-heading"> Acciones generales permitidos </div>
		<div class="panel-body">

			<div class="col-md-3">
			 <div class="form-group">
			  <label for="name" class="control-label"> Crear Registros </label>
				<select class="form-control" id="addRecord" name="addRecord">
					<option value="1" <?php if($data->addRecord == 1) { echo 'selected'; } ?>> SI </option>
					<option value="0" <?php if($data->addRecord == 0) { echo 'selected'; } ?>> NO </option>
				</select>
			 </div>
			</div>

			<div class="col-md-3">
			 <div class="form-group">
			  <label for="name" class="control-label"> Eliminar Registros </label>
				<select class="form-control" id="deleteRecord" name="deleteRecord">
					<option value="1" <?php if($data->deleteRecord == 1) { echo 'selected'; } ?>> SI </option>
					<option value="0" <?php if($data->deleteRecord == 0) { echo 'selected'; } ?>> NO </option>
				</select>
			 </div>
			</div>

			<div class="col-md-3">
			 <div class="form-group">
			  <label for="name" class="control-label"> Editar Registros </label>
				<select class="form-control" id="editRecord" name="editRecord">
					<option value="1" <?php if($data->editRecord == 1) { echo 'selected'; } ?>> SI </option>
					<option value="0" <?php if($data->editRecord == 0) { echo 'selected'; } ?>> NO </option>
				</select>
			 </div>
			</div>

			<div class="col-md-3">
			 <div class="form-group">
			  <label for="name" class="control-label"> Visualizar Registros </label>
				<select class="form-control" id="viewRecord" name="viewRecord">
					<option value="1" <?php if($data->viewRecord == 1) { echo 'selected'; } ?>> SI </option>
					<option value="0" <?php if($data->viewRecord == 0) { echo 'selected'; } ?>> NO </option>
				</select>
			 </div>
			</div>


		</div>
	</div>
</div>

<div class="panel">
	<div class="panel-wrapper collapse in" aria-expanded="true">
		<div class="panel-heading">Asignacion de Modulos</div>
		<div class="panel-body">

			<div class="row">
				<?php foreach($modulos as $modulo) { ?>

					<div class="col-md-4" style="margin-bottom:20px">
							<div class="checkbox checkbox-info">
									<input name="modulo[<?php echo $modulo['id']; ?>][modulo]" id="modulo_<?php echo $modulo['id']; ?>"
												 value="<?php echo $modulo['id']; ?>" type="checkbox" onclick="$('.item-<?php echo strtolower(str_replace(' ','',$modulo['id'])); ?>').prop('checked', this.checked);"
												 <?php if(in_array($modulo['id'],$seleccionados)) { echo 'checked'; } ?>>
									<label for="modulo_<?php echo $modulo['id']; ?>">
										<li class="fa <?php echo $modulo['icon_font']; ?> fa-lg"></li> <?php echo $modulo['nombre']; ?>
									</label>
							</div>

							<?php if($modulo['childs']) { ?>

								<?php foreach($modulo['childs'] as $childs) { ?>

									<div class="col-md-12" style="margin-bottom:5px; margin-left:20px">

										<div class="checkbox checkbox-info">

											<input class="item-<?php echo strtolower(str_replace(' ','',$modulo['id'])); ?>" name="modulo[<?php echo $childs['id']; ?>][modulo]" id="modulo_<?php echo $childs['id']; ?>"
														 value="<?php echo $childs['id']; ?>" type="checkbox"
														 <?php if(in_array($childs['id'],$seleccionados)) { echo 'checked'; } ?>>
											<label for="modulo_<?php echo $childs['id']; ?>">
												<?php echo $childs['nombre']; ?>
											</label>

										</div>

									</div>

								<?php } ?>

							<?php } ?>

						</div>

				<?php } ?>
			</div>

		</div>
		<div class="panel-footer text-right">

		</div>
	</div>
</div>

@section('beforeBody')

</script>')

<script>
	$(".chosen-select").chosen();
</script>

@endsection
