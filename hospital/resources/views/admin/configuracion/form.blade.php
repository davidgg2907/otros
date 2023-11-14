<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading"> Origen de Embarco  </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<div class="row">

					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label"> Razon Social </label>
							<input type="text" name="config[3]" id="" value="{{ $conf->getKey('nombre_origen') }}" class="form-control"/>
						 </div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label"> Domicilio de Salida </label>
								<input type="text" name="config[2]" id="" value="{{ $conf->getKey('direccion_origen') }}" class="form-control"/>
								<div class="label label-danger">{{ $errors->first("sucursal_id") }}</div>
						 </div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading"> Google Maps </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<div class="row">

					<div class="col-md-12">
						<p></p>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label"> Public Api Key </label>
							<input type="text" name="config[1]" id="" value="{{ $conf->getKey('maps_key') }}" class="form-control"/>
						 </div>
					</div>



				</div>
			</div>
		</div>
	</div>
</div>
