<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Datos Generales</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Comercial Start -->
				<div class="col-md-6">
				 <div class="form-group">
				  <label for="comercial" class="control-label"> Nombre Comercial </label>
				    <input type="text" class="form-control" id="comercial" name="comercial"
				    value="{{{ isset($data->comercial ) ? $data->comercial  : old('comercial') }}}">
				    <div class="label label-danger">{{ $errors->first("comercial") }}</div>
				 </div>
				</div>
				<!-- Comercial End -->

				<!-- Generico Start -->
				<div class="col-md-6">
				 <div class="form-group">
				  <label for="generico" class="control-label"> Nombre Generico </label>
				    <input type="text" class="form-control" id="generico" name="generico"
				    value="{{{ isset($data->generico ) ? $data->generico  : old('generico') }}}">
				    <div class="label label-danger">{{ $errors->first("generico") }}</div>
				 </div>
				</div>
				<!-- Generico End -->

				<!-- Activo Start -->
				<div class="col-md-4">
				 <div class="form-group">
				  <label for="activo" class="control-label"> Activo </label>
				    <input type="text" class="form-control" id="activo" name="activo"
				    value="{{{ isset($data->activo ) ? $data->activo  : old('activo') }}}">
				    <div class="label label-danger">{{ $errors->first("activo") }}</div>
				 </div>
				</div>
				<!-- Activo End -->

				<!-- Componentes Start -->
				<div class="col-md-4">
				 <div class="form-group">
				  <label for="componentes" class="control-label"> Componentes </label>
				    <input type="text" class="form-control" id="componentes" name="componentes"
				    value="{{{ isset($data->componentes ) ? $data->componentes  : old('componentes') }}}">
				    <div class="label label-danger">{{ $errors->first("componentes") }}</div>
				 </div>
				</div>
				<!-- Componentes End -->

				<!-- Farmaceutica Start -->
				<div class="col-md-4">
				 <div class="form-group">
				  <label for="farmaceutica" class="control-label"> Farmaceutica </label>
				    <input type="text" class="form-control" id="farmaceutica" name="farmaceutica"
				    value="{{{ isset($data->farmaceutica ) ? $data->farmaceutica  : old('farmaceutica') }}}">
				    <div class="label label-danger">{{ $errors->first("farmaceutica") }}</div>
				 </div>
				</div>
				<!-- Farmaceutica End -->


			</div>
		</div>
	</div>
</div>


<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Inventario y Costos </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Cantidad Start -->
				<div class="col-md-6">
				 <div class="form-group">
				  <label for="cantidad" class="control-label"> Existencias </label>
				    <input type="text" class="form-control" id="cantidad" name="cantidad"
				    value="{{{ isset($data->cantidad ) ? $data->cantidad  : old('cantidad') }}}">
				    <div class="label label-danger">{{ $errors->first("cantidad") }}</div>
				 </div>
				</div>
				<!-- Cantidad End -->

				<!-- Costo Start -->
				<div class="col-md-6">
				 <div class="form-group">
				  <label for="costo" class="control-label"> Precio de Compra </label>
				    <input type="text" class="form-control" id="costo" name="costo"
				    value="{{{ isset($data->costo ) ? $data->costo  : old('costo') }}}">
				    <div class="label label-danger">{{ $errors->first("costo") }}</div>
				 </div>
				</div>
				<!-- Costo End -->

				<!-- Precio Start -->
				<div class="col-md-6">
				 <div class="form-group">
				  <label for="precio" class="control-label"> Precio de Venta</label>
				    <input type="text" class="form-control" id="precio" name="precio"
				    value="{{{ isset($data->precio ) ? $data->precio  : old('precio') }}}">
				    <div class="label label-danger">{{ $errors->first("precio") }}</div>
				 </div>
				</div>
				<!-- Precio End -->

				<!-- Caducidad Start -->
				<div class="col-md-6">
				 <div class="form-group">
				  <label for="caducidad" class="control-label"> Caducidad </label>
				    <input type="text" class="form-control" id="caducidad" name="caducidad"
				    value="{{{ isset($data->caducidad ) ? $data->caducidad  : old('caducidad') }}}">
				    <div class="label label-danger">{{ $errors->first("caducidad") }}</div>
				 </div>
				</div>
				<!-- Caducidad End -->

			</div>
		</div>
	</div>
</div>




<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Recomendaciones y Efectos Secundarios</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Efectos Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<label for="efectos" class="control-label"> Efectos </label>
					<textarea class="form-control" id="efectos" name="efectos">{{{ isset($data->efectos ) ? $data->efectos  : old('efectos') }}}</textarea>
					<div class="label label-danger">{{ $errors->first("efectos") }}</div>
				 </div>
				</div>
				<!-- Efectos End -->

				<!-- Recomendaciones Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<label for="recomendaciones" class="control-label"> Recomendaciones </label>
					<textarea class="form-control" id="recomendaciones" name="recomendaciones">{{{ isset($data->recomendaciones ) ? $data->recomendaciones  : old('recomendaciones') }}}</textarea>
					<div class="label label-danger">{{ $errors->first("recomendaciones") }}</div>
				 </div>
				</div>
				<!-- Recomendaciones End -->

			</div>
		</div>
	</div>
</div>

<input type="hidden" class="form-control" id="status" name="status" value="1">
