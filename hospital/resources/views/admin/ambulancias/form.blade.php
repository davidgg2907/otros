<input type="hidden" name="" class="form-control" id="status" name="status" value="1">
<div class="panel panel-default">
	<div class="panel-heading">Registrar Informacion </div>
	<div class="panel-wrapper collapse in" aria-expanded="true">
		<div class="panel-body">

			<!-- Servicio Start -->
			<div class="col-md-4">
			 <div class="form-group">
				<label for="servicio" class="control-label"> Servicio </label>
					<input type="text" maxlength="150" class="form-control" id="servicio" name="servicio"
					value="{{{ isset($data->servicio ) ? $data->servicio  : old('servicio') }}}">
					<div class="label label-danger">{{ $errors->first("servicio") }}</div>
			 </div>
			</div>
			<!-- Servicio End -->

			<!-- Unidad Start -->
			<div class="col-md-3">
			 <div class="form-group">
				<label for="unidad" class="control-label"># Unidad </label>
					<input type="text" maxlength="50" class="form-control" id="unidad" name="unidad"
					value="{{{ isset($data->unidad ) ? $data->unidad  : old('unidad') }}}">
					<div class="label label-danger">{{ $errors->first("unidad") }}</div>
			 </div>
			</div>
			<!-- Unidad End -->

			<!-- Chofer Start -->
			<div class="col-md-5">
			 <div class="form-group">
				<label for="chofer" class="control-label"> Chofer </label>
					<input type="text" maxlength="150" class="form-control" id="chofer" name="chofer"
					value="{{{ isset($data->chofer ) ? $data->chofer  : old('chofer') }}}">
					<div class="label label-danger">{{ $errors->first("chofer") }}</div>
			 </div>
			</div>
			<!-- Chofer End -->

			<!-- Enfermera Start -->
			<div class="col-md-6">
			 <div class="form-group">
				<label for="enfermera" class="control-label"> Enfermera </label>
					<input type="text" maxlength="150" class="form-control" id="enfermera" name="enfermera"
					value="{{{ isset($data->enfermera ) ? $data->enfermera  : old('enfermera') }}}">
					<div class="label label-danger">{{ $errors->first("enfermera") }}</div>
			 </div>
			</div>
			<!-- Enfermera End -->

			<!-- Medico Start -->
			<div class="col-md-6">
			 <div class="form-group">
				<label for="medico" class="control-label"> Medico </label>
					<input type="text" maxlength="150" class="form-control" id="medico" name="medico"
					value="{{{ isset($data->medico ) ? $data->medico  : old('medico') }}}">
					<div class="label label-danger">{{ $errors->first("medico") }}</div>
			 </div>
			</div>
			<!-- Medico End -->

			<!-- Paciente Start -->
			<div class="col-md-6">
			 <div class="form-group">
				<label for="paciente" class="control-label"> Paciente </label>
					<input type="text" maxlength="150" class="form-control" id="paciente" name="paciente"
					value="{{{ isset($data->paciente ) ? $data->paciente  : old('paciente') }}}">
					<div class="label label-danger">{{ $errors->first("paciente") }}</div>
			 </div>
			</div>
			<!-- Paciente End -->

			<!-- Acompanante Start -->
			<div class="col-md-6">
			 <div class="form-group">
				<label for="acompanante" class="control-label"> Acompanante </label>
					<input type="text" maxlength="150" class="form-control" id="acompanante" name="acompanante"
					value="{{{ isset($data->acompanante ) ? $data->acompanante  : old('acompanante') }}}">
					<div class="label label-danger">{{ $errors->first("acompanante") }}</div>
			 </div>
			</div>
			<!-- Acompanante End -->

		</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Diagnostico </div>
	<div class="panel-wrapper collapse in" aria-expanded="true">
		<div class="panel-body">
			<textarea class="form-control" maxlength="230" id="diagnostico" name="diagnostico">{{{ isset($data->diagnostico ) ? $data->diagnostico  : old('diagnostico') }}}</textarea>
			<div class="label label-danger">{{ $errors->first("diagnostico") }}</div>
		</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Traslado </div>
	<div class="panel-wrapper collapse in" aria-expanded="true">
		<div class="panel-body">


				<!-- Origen Start -->
				<div class="col-md-6">
				 <div class="form-group">
				  <label for="origen" class="control-label"> Origen </label>
					<textarea class="form-control" maxlength="230" id="origen" name="origen">{{{ isset($data->origen ) ? $data->origen  : old('origen') }}}</textarea>
					<div class="label label-danger">{{ $errors->first("origen") }}</div>
			   </div>
				</div>
				<!-- Origen End -->

				<!-- Destino Start -->
				<div class="col-md-6">
				 <div class="form-group">
				  <label for="destino" class="control-label"> Destino </label>
					<textarea class="form-control" maxlength="230" id="destino" name="destino">{{{ isset($data->destino ) ? $data->destino  : old('destino') }}}</textarea>
				  <div class="label label-danger">{{ $errors->first("destino") }}</div>
			   </div>
				</div>
				<!-- Destino End -->

		</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Comentarios </div>
	<div class="panel-wrapper collapse in" aria-expanded="true">
		<div class="panel-body">
			<textarea class="form-control" maxlength="230" id="comentario" name="comentario">{{{ isset($data->comentario ) ? $data->comentario  : old('comentario') }}}</textarea>
			<div class="label label-danger">{{ $errors->first("diagnostico") }}</div>
		</div>
	</div>
</div>
