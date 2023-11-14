<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title"><i class="fa fa-list"></i> DATOS GENERALES</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<!-- Name Start -->
				<div class="col-md-12">
					<div class="mb-1">
					 <div class="form-group">
						<label for="name" class="control-label"> Nombre </label>
							<input type="text" class="form-control" id="name" name="name" required="required" pattern="[A-Za-zñÑ ]{3,}"
							value="{{{ isset($data->name ) ? $data->name  : old('name') }}}">
							<div class="label label-danger">{{ $errors->first("name") }}</div>
					 </div>
					</div>
				</div>
				<!-- Name End -->

				<!-- Description Start -->
				<div class="col-md-12">
					<div class="mb-1">
					 <div class="form-group">
						<label for="description" class="control-label"> Descripcion </label>
						<textarea required="required" pattern="[A-Za-zñÑ0-9 ]{3,}" class="form-control" id="description" name="description">{{{ isset($data->description ) ? $data->description  : old('description') }}}</textarea>
						<div class="label label-danger">{{ $errors->first("description") }}</div>
					 </div>
					</div>
				</div>
				<!-- Description End -->

				<input type="hidden" class="form-control" id="status" name="status" value="1">

			</div>

		</div>
	</div>
</div>


<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title"> <i class="fa fa-cubes"></i> MODULOS ACCESOS Y ACCIONES</h4>
		</div>
		<div class="card-content">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th class="text-sm-left">Modulo</th>
							<th class="text-sm-center">Visualizar</th>
							<th class="text-sm-center">Agregar</th>
							<th class="text-sm-center">Editar</th>
							<th class="text-sm-center">Eliminar</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($modulos as $module): ?>
							@include('admin.roles.modules',['module'=>$module,'seleccionados'=>$seleccionados,'child' => ''])
								@foreach ($module['childs'] as $child)
									@include('admin.roles.modules',['module'=>$child,'seleccionados'=>$seleccionados,'child' => '&nbsp;&nbsp;&nbsp;-> '])
								@endforeach
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="card-footer"></div>
		</div>
	</div>
</div>
