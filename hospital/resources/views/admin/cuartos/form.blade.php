<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Datos Generales </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Descripcion Start -->
				<div class="col-md-6">
				 <div class="form-group">
				  <label for="descripcion" class="control-label"> Descripcion </label>
				    <input type="text" class="form-control" id="descripcion" name="descripcion"
				    value="{{{ isset($data->descripcion ) ? $data->descripcion  : old('descripcion') }}}">
				    <div class="label label-danger">{{ $errors->first("descripcion") }}</div>
				 </div>
				</div>
				<!-- Descripcion End -->

				<!-- Numero Start -->
				<div class="col-md-3">
				 <div class="form-group">
				  <label for="numero" class="control-label"> Nro Habitacion </label>
				    <input type="text" class="form-control" id="numero" name="numero"
				    value="{{{ isset($data->numero ) ? $data->numero  : old('numero') }}}">
				    <div class="label label-danger">{{ $errors->first("numero") }}</div>
				 </div>
				</div>
				<!-- Numero End -->


				<!-- Costo_dia Start -->
				<div class="col-md-3">
				 <div class="form-group">
				  <label for="costo_dia" class="control-label"> Costo por Dia </label>
				    <input type="text" class="form-control" id="costo_dia" name="costo_dia"
				    value="{{{ isset($data->costo_dia ) ? $data->costo_dia  : old('costo_dia') }}}">
				    <div class="label label-danger">{{ $errors->first("costo_dia") }}</div>
				 </div>
				</div>
				<!-- Costo_dia End -->
			</div>
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading">Equipo Medico disponible en la habitacion</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Equipo Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<textarea rows="5" class="form-control" id="equipo" name="equipo">{{{ isset($data->equipo ) ? $data->equipo  : old('equipo') }}}</textarea>
				  <div class="label label-danger">{{ $errors->first("equipo") }}</div>
				 </div>
				</div>
				<!-- Equipo End -->
			</div>
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading">Amenidades con las que cuenta la habitacion</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Amenidades Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<textarea rows="5" class="form-control" id="amenidades" name="amenidades">{{{ isset($data->amenidades ) ? $data->amenidades  : old('amenidades') }}}</textarea>
					<div class="label label-danger">{{ $errors->first("amenidades") }}</div>
				 </div>
				</div>
				<!-- Amenidades End -->

			</div>
		</div>
	</div>
</div>




<input type="hidden" class="form-control" id="status" name="status" value="1">
