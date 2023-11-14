<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Datos Generales </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<div class="row">
					<div class="col-md-6"></div>
					<!-- Fecha Start -->
					<div class="col-md-3">
					 <div class="form-group">
						<label for="fecha" class="control-label"> Fecha </label>
							<input type="text" class="form-control" id="fecha" name="fecha" value="{{ date('Y-m-d') }}" readonly>
					 </div>
					</div>
					<!-- Fecha End -->

					<!-- Hora Start -->
					<div class="col-md-3">
					 <div class="form-group">
						<label for="hora" class="control-label"> Hora </label>
							<input type="text" class="form-control" id="hora" name="hora" value="{{ date('H:i:s') }}" readonly>
					 </div>
					</div>
					<!-- Hora End -->
				</div>

				<div class="row">
					<!-- Medico_id Start -->
					<div class="col-md-12">
						<div class="form-group">
								<label for="medico_id" class="control-label"> Medico </label>
								<div class="input-group">
									<input type="text" class="form-control" name="medico_nombre" id="medico_nombre" value="" readonly/>
									<input type="hidden" name="medico_id" id="medico_id" value=""/>
									<span class="input-group-btn">
										<button type="button" class="btn waves-effect waves-light btn-info" onclick="buscarMedicos();"><i class="fa fa-search"></i></button>
									</span>
								</div>
								<div class="label label-danger">{{ $errors->first("medico_id") }}</div>
						 </div>
					</div>
					<!-- Medico_id End -->

					<!-- Paciente Start -->
					<div class="col-md-12">
					 <div class="form-group">
						<label for="paciente" class="control-label"> Nombre del Paciente </label>
							<input type="text" class="form-control" id="paciente" name="paciente"
							value="{{{ isset($data->paciente ) ? $data->paciente  : old('paciente') }}}">
							<div class="label label-danger">{{ $errors->first("paciente") }}</div>
					 </div>
					</div>
					<!-- Paciente End -->


				</div>

				<div class="row">

					<!-- Edad Start -->
					<div class="col-md-4">
					 <div class="form-group">
						<label for="edad" class="control-label"> Edad </label>
							<input type="text" class="form-control" id="edad" name="edad"
							value="{{{ isset($data->edad ) ? $data->edad  : old('edad') }}}">
							<div class="label label-danger">{{ $errors->first("edad") }}</div>
					 </div>
					</div>
					<!-- Edad End -->

					<!-- Peso Start -->
					<div class="col-md-4">
					 <div class="form-group">
						<label for="peso" class="control-label"> Peso </label>
							<input type="text" class="form-control" id="peso" name="peso"
							value="{{{ isset($data->peso ) ? $data->peso  : old('peso') }}}">
							<div class="label label-danger">{{ $errors->first("peso") }}</div>
					 </div>
					</div>
					<!-- Peso End -->

					<!-- Talla Start -->
					<div class="col-md-4">
					 <div class="form-group">
						<label for="talla" class="control-label"> Talla </label>
							<input type="text" class="form-control" id="talla" name="talla"
							value="{{{ isset($data->talla ) ? $data->talla  : old('talla') }}}">
							<div class="label label-danger">{{ $errors->first("talla") }}</div>
					 </div>
					</div>
					<!-- Talla End -->
				</div>

			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Motivo de Consulta</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<div class="col-md-12">
					<p>
						<small>paciente quien se presenta a urgencias traído por (causa principal)</small>
					</p>
				</div>

				<!-- Motivo Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<label for="motivo" class="control-label"> Motivo de ingreso a Urgencias</label>
					<textarea class="form-control summernote" id="motivo" name="motivo">{{{ isset($data->motivo ) ? $data->motivo  : old('motivo') }}}</textarea>
						<div class="label label-danger">{{ $errors->first("motivo") }}</div>
				 </div>
				</div>
				<!-- Motivo End -->


			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Antecedentes Heredofamiliares</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<div class="col-md-12">
					<p>
						por parte de sus padres, abuelos, tios, hermanos, primos maternos o paternos,
						hayan padecido alguna de las siguientes enfermedades:
					</p>
				</div>

				<!-- Heredo_diabetes Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="heredo_diabetes" class="control-label"> Diabetes </label>
						<input type="text" class="form-control" id="heredo_diabetes" name="heredo_diabetes"
						value="{{{ isset($data->heredo_diabetes ) ? $data->heredo_diabetes  : old('heredo_diabetes') }}}">
						<div class="label label-danger">{{ $errors->first("heredo_diabetes") }}</div>
				 </div>
				</div>
				<!-- Heredo_diabetes End -->

				<!-- Heredo_hipertencion Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="heredo_hipertencion" class="control-label"> Hipertension </label>
						<input type="text" class="form-control" id="heredo_hipertencion" name="heredo_hipertencion"
						value="{{{ isset($data->heredo_hipertencion ) ? $data->heredo_hipertencion  : old('heredo_hipertencion') }}}">
						<div class="label label-danger">{{ $errors->first("heredo_hipertencion") }}</div>
				 </div>
				</div>
				<!-- Heredo_hipertencion End -->

				<!-- Heredo_cancer Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="heredo_cancer" class="control-label"> Cancer </label>
						<input type="text" class="form-control" id="heredo_cancer" name="heredo_cancer"
						value="{{{ isset($data->heredo_cancer ) ? $data->heredo_cancer  : old('heredo_cancer') }}}">
						<div class="label label-danger">{{ $errors->first("heredo_cancer") }}</div>
				 </div>
				</div>
				<!-- Heredo_cancer End -->

				<!-- Heredo_convulsiones Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="heredo_convulsiones" class="control-label"> Convulsiones </label>
						<input type="text" class="form-control" id="heredo_convulsiones" name="heredo_convulsiones"
						value="{{{ isset($data->heredo_convulsiones ) ? $data->heredo_convulsiones  : old('heredo_convulsiones') }}}">
						<div class="label label-danger">{{ $errors->first("heredo_convulsiones") }}</div>
				 </div>
				</div>
				<!-- Heredo_convulsiones End -->

				<!-- Heredo_lar Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="heredo_lar" class="control-label"> Lupus, artritis reumatoide, </label>
						<input type="text" class="form-control" id="heredo_lar" name="heredo_lar"
						value="{{{ isset($data->heredo_lar ) ? $data->heredo_lar  : old('heredo_lar') }}}">
						<div class="label label-danger">{{ $errors->first("heredo_lar") }}</div>
				 </div>
				</div>
				<!-- Heredo_lar End -->

				<!-- Heredo_leulin Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="heredo_leulin" class="control-label"> Leucemia o linfoma </label>
						<input type="text" class="form-control" id="heredo_leulin" name="heredo_leulin"
						value="{{{ isset($data->heredo_leulin ) ? $data->heredo_leulin  : old('heredo_leulin') }}}">
						<div class="label label-danger">{{ $errors->first("heredo_leulin") }}</div>
				 </div>
				</div>
				<!-- Heredo_leulin End -->

			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Antecedentes Personales Patologicos</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<div class="col-md-12">
					<p>
						Se refiere a que si el paciente cuenta con las siguientes enfermedades YA diagnosticadas previamente,
						tiempo de evolución y tratamiento recibido hasta la fecha, excluyendo la patología por la que acude
						el día de hoy.
					</p>
				</div>

				<!-- Patolo_diabetes Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="patolo_diabetes" class="control-label"> Diabetes </label>
						<input type="text" class="form-control" id="patolo_diabetes" name="patolo_diabetes"
						value="{{{ isset($data->patolo_diabetes ) ? $data->patolo_diabetes  : old('patolo_diabetes') }}}">
						<div class="label label-danger">{{ $errors->first("patolo_diabetes") }}</div>
				 </div>
				</div>
				<!-- Patolo_diabetes End -->

				<!-- Patolo_hipertencion Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="patolo_hipertencion" class="control-label"> Hipertension </label>
						<input type="text" class="form-control" id="patolo_hipertencion" name="patolo_hipertencion"
						value="{{{ isset($data->patolo_hipertencion ) ? $data->patolo_hipertencion  : old('patolo_hipertencion') }}}">
						<div class="label label-danger">{{ $errors->first("patolo_hipertencion") }}</div>
				 </div>
				</div>
				<!-- Patolo_hipertencion End -->

				<!-- Patolo_cancer Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="patolo_cancer" class="control-label"> Cancer </label>
						<input type="text" class="form-control" id="patolo_cancer" name="patolo_cancer"
						value="{{{ isset($data->patolo_cancer ) ? $data->patolo_cancer  : old('patolo_cancer') }}}">
						<div class="label label-danger">{{ $errors->first("patolo_cancer") }}</div>
				 </div>
				</div>
				<!-- Patolo_cancer End -->

				<!-- Patolo_otros Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="patolo_otros" class="control-label"> Otras </label>
						<input type="text" class="form-control" id="patolo_otros" name="patolo_otros"
						value="{{{ isset($data->patolo_otros ) ? $data->patolo_otros  : old('patolo_otros') }}}">
						<div class="label label-danger">{{ $errors->first("patolo_otros") }}</div>
				 </div>
				</div>
				<!-- Patolo_otros End -->


			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Preguntas Generales</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Operaciones Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<label for="operaciones" class="control-label"> Le han operado de alguna cirugia, cual y en que fecha aproximada </label>
						<input type="text" class="form-control" id="operaciones" name="operaciones"
						value="{{{ isset($data->operaciones ) ? $data->operaciones  : old('operaciones') }}}">
						<div class="label label-danger">{{ $errors->first("operaciones") }}</div>
				 </div>
				</div>
				<!-- Operaciones End -->

				<!-- Transfuciones Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<label for="transfuciones" class="control-label"> Ha recibido transfuciones de sangre, Si, No y en que fecha aproximada </label>
						<input type="text" class="form-control" id="transfuciones" name="transfuciones"
						value="{{{ isset($data->transfuciones ) ? $data->transfuciones  : old('transfuciones') }}}">
						<div class="label label-danger">{{ $errors->first("transfuciones") }}</div>
				 </div>
				</div>
				<!-- Transfuciones End -->

				<!-- Fracturas Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<label for="fracturas" class="control-label"> Se ha fracturado o luxado algun hueso del cuerpo, cual y en que fecha aproximada </label>
						<input type="text" class="form-control" id="fracturas" name="fracturas"
						value="{{{ isset($data->fracturas ) ? $data->fracturas  : old('fracturas') }}}">
						<div class="label label-danger">{{ $errors->first("fracturas") }}</div>
				 </div>
				</div>
				<!-- Fracturas End -->

				<!-- Alergias Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<label for="alergias" class="control-label"> Es ustd alergico a algun medicamento, si, no Cual  </label>
						<input type="text" class="form-control" id="alergias" name="alergias"
						value="{{{ isset($data->alergias ) ? $data->alergias  : old('alergias') }}}">
						<div class="label label-danger">{{ $errors->first("alergias") }}</div>
				 </div>
				</div>
				<!-- Alergias End -->

				<input type="hidden" class="form-control" id="status" name="status" value="1">

			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Padecimiento Actual</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<div class="col-md-12">
					<p> <small> fecha de inicio del primer síntoma que lo trae a consulta, inicia con . . .</small>
					</p>
				</div>

				<!-- Padecimiento Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<label for="padecimiento" class="control-label"> Padecimiento actual del paciente</label>
					<textarea class="form-control summernote" id="padecimiento" name="padecimiento">{{{ isset($data->padecimiento ) ? $data->padecimiento  : old('padecimiento') }}}</textarea>
						<div class="label label-danger">{{ $errors->first("padecimiento") }}</div>
				 </div>
				</div>
				<!-- Padecimiento End -->

			</div>
		</div>
	</div>
</div>

@include('admin.buscadores.medicos')

@section('scripts')

<script>

  @include('admin.buscadores.medscript')


$(document).ready(function() {
	$('.summernote').summernote({
			height: 300, // set editor height
			minHeight: null, // set minimum height of editor
			maxHeight: null, // set maximum height of editor
			focus: false // set focus to editable area after initializing summernote
	});
	$('.inline-editor').summernote({
			airMode: true
	});
});
window.edit = function () {
		$(".click2edit").summernote()
}, window.save = function () {
		$(".click2edit").summernote('destroy');
}

</script>
@endsection
