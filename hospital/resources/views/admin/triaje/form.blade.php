<div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Datos Generales </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
          <div class="panel-body">
		
				<!-- Fecha Start -->
				<div class="col-md-2">
					<div class="form-group">
					<label for="fecha" class="control-label"> Fecha </label>
					<input type="text" class="form-control" id="fecha" name="fecha" reaonly	
					value="{{{ date('d/m/Y H:i:s') }}}">
					<div class="label label-danger">{{ $errors->first("fecha") }}</div>
				</div>
				</div>
				<!-- Fecha End -->
		
				<!-- Tarjeta Start -->
				<div class="col-md-2">
					<div class="form-group">
					<label for="tarjeta" class="control-label"> Tarjeta </label>
					<select class="form-control" id="tarjeta" name="tarjeta">
						<option value="">Especifique</option>
						<option value="ROJO" <?php if($value->tarjeta == "ROJO") { echo 'selected'; } ?>>ROJO</option>
						<option value="AMARILLO" <?php if($value->tarjeta == "AMARILLO") { echo 'selected'; } ?>>AMARILLO</option>
						<option value="VERDE" <?php if($value->tarjeta == "VERDE") { echo 'selected'; } ?>>VERDE</option>
					</select>
					<div class="label label-danger">{{ $errors->first("tarjeta") }}</div>
				</div>
				</div>
				<!-- Tarjeta End -->
		
				<!-- Paciente Start -->
				<div class="col-md-8">
					<div class="form-group">
					<label for="paciente" class="control-label"> Nombre del Paciente </label>
					<input type="text" class="form-control" id="paciente" name="paciente"
					value="{{{ isset($data->paciente ) ? $data->paciente  : old('paciente') }}}">
					<div class="label label-danger">{{ $errors->first("paciente") }}</div>
				</div>
				</div>
				<!-- Paciente End -->
				
				<!-- Edad Start -->
				<div class="col-md-3">
					<div class="form-group">
					<label for="edad" class="control-label"> Edad </label>
					<input type="text" class="form-control" id="edad" name="edad"
					value="{{{ isset($data->edad ) ? $data->edad  : old('edad') }}}">
					<div class="label label-danger">{{ $errors->first("edad") }}</div>
				</div>
				</div>
				<!-- Edad End -->
				
				<!-- Genero Start -->
				<div class="col-md-3">
					<div class="form-group">
					<label for="genero" class="control-label"> Genero </label>
					<input type="text" class="form-control" id="genero" name="genero"
					value="{{{ isset($data->genero ) ? $data->genero  : old('genero') }}}">
					<div class="label label-danger">{{ $errors->first("genero") }}</div>
				</div>
				</div>
				<!-- Genero End -->
		
				<!-- Peso Start -->
				<div class="col-md-3">
					<div class="form-group">
					<label for="peso" class="control-label"> Peso </label>
					<input type="text" class="form-control" id="peso" name="peso"
					value="{{{ isset($data->peso ) ? $data->peso  : old('peso') }}}">
					<div class="label label-danger">{{ $errors->first("peso") }}</div>
				</div>
				</div>
				<!-- Peso End -->
				
				<!-- Talla Start -->
				<div class="col-md-3">
					<div class="form-group">
					<label for="talla" class="control-label"> Talla </label>
					<input type="text" class="form-control" id="talla" name="talla"
					value="{{{ isset($data->talla ) ? $data->talla  : old('talla') }}}">
					<div class="label label-danger">{{ $errors->first("talla") }}</div>
				</div>
				</div>
				<!-- Talla End -->

				<!-- Valoracion Start -->
				<div class="col-md-6">
					<div class="form-group">
						<label for="domicilio" class="control-label"> Domicilio</label>
						<input type="text" class="form-control" id="domicilio" name="domicilio" value="{{{ isset($data->domicilio ) ? $data->domicilio  : old('domicilio') }}}">
						<div class="label label-danger">{{ $errors->first("domicilio") }}</div>
					</div>
				</div>
				<!-- Valoracion End -->

				<!-- Valoracion Start -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="colonia" class="control-label"> Colonia</label>
						<input type="text" class="form-control" id="colonia" name="colonia" value="{{{ isset($data->colonia ) ? $data->colonia  : old('colonia') }}}">
						<div class="label label-danger">{{ $errors->first("colonia") }}</div>
					</div>
				</div>
				<!-- Valoracion End -->

				<!-- Valoracion Start -->
				<div class="col-md-2">
					<div class="form-group">
						<label for="cp" class="control-label"> Codigo Postal.</label>
						<input type="text" class="form-control" id="cp" name="cp" value="{{{ isset($data->cp ) ? $data->cp  : old('cp') }}}">
						<div class="label label-danger">{{ $errors->first("cp") }}</div>
					</div>
				</div>
				<!-- Valoracion End -->
				
          </div>

        </div>
      </div>
</div>

<div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Personal clinico que atendio la urgencia </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
          <div class="panel-body">
		
				<!-- Dr. Que Atendio Start -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="doctor" class="control-label"> Dr. que atendio</label>
						<input type="text" class="form-control" id="doctor" name="doctor"
						value="{{{ isset($data->doctor ) ? $data->doctor  : old('doctor') }}}">
						<div class="label label-danger">{{ $errors->first("doctor") }}</div>
					</div>
				</div>
				<!-- Dr. Que Atendio End -->

				<!-- Dr. Que Atendio Start -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="enfermera" class="control-label"> Enfermera que realizo el triaje</label>
						<input type="text" class="form-control" id="enfermera" name="enfermera"
						value="{{{ isset($data->enfermera ) ? $data->enfermera  : old('enfermera') }}}">
						<div class="label label-danger">{{ $errors->first("enfermera") }}</div>
					</div>
				</div>
				<!-- Dr. Que Atendio End -->

				<!-- Dr. Que Atendio Start -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="jefa" class="control-label"> Jefa en turno de enfermeria</label>
						<input type="text" class="form-control" id="jefa" name="jefa"
						value="{{{ isset($data->jefa ) ? $data->jefa  : old('jefa') }}}">
						<div class="label label-danger">{{ $errors->first("jefa") }}</div>
					</div>
				</div>
				<!-- Dr. Que Atendio End -->



          </div>

        </div>
      </div>
</div>

<div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Valoracion </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
          <div class="panel-body">
	
			<!-- Valoracion Start -->
			<div class="col-md-12">
				<div class="form-group">
					<textarea rows="5" class="form-control" id="valoracion" name="valoracion">{{{ isset($data->valoracion ) ? $data->valoracion  : old('valoracion') }}}</textarea>					
					<div class="label label-danger">{{ $errors->first("valoracion") }}</div>
				</div>
			</div>
			<!-- Valoracion End -->
          </div>

        </div>
      </div>
</div>



<div class="col-md-3">
	<div class="panel panel-default">
	<div class="panel-heading">Signos Vitales </div>
	<div class="panel-wrapper collapse in" aria-expanded="true">
		<div class="panel-body">

			<!-- Ta Start -->
			<div class="col-md-12">
				<div class="form-group">
				<label for="ta" class="control-label"> Ta </label>
				<input type="text" class="form-control" id="ta" name="ta"
				value="{{{ isset($data->ta ) ? $data->ta  : old('ta') }}}">
				<div class="label label-danger">{{ $errors->first("ta") }}</div>
			</div>
			</div>
			<!-- Ta End -->
			
			<!-- Fr Start -->
			<div class="col-md-12">
				<div class="form-group">
				<label for="fr" class="control-label"> Fr </label>
				<input type="text" class="form-control" id="fr" name="fr"
				value="{{{ isset($data->fr ) ? $data->fr  : old('fr') }}}">
				<div class="label label-danger">{{ $errors->first("fr") }}</div>
			</div>
			</div>
			<!-- Fr End -->
			
			<!-- Fc Start -->
			<div class="col-md-12">
				<div class="form-group">
				<label for="fc" class="control-label"> Fc </label>
				<input type="text" class="form-control" id="fc" name="fc"
				value="{{{ isset($data->fc ) ? $data->fc  : old('fc') }}}">
				<div class="label label-danger">{{ $errors->first("fc") }}</div>
			</div>
			</div>
			<!-- Fc End -->
			
			<!-- T Start -->
			<div class="col-md-12">
				<div class="form-group">
				<label for="t" class="control-label"> T </label>
				<input type="text" class="form-control" id="t" name="t"
				value="{{{ isset($data->t ) ? $data->t  : old('t') }}}">
				<div class="label label-danger">{{ $errors->first("t") }}</div>
			</div>
			</div>
			<!-- T End -->
			
			<!-- Sp02 Start -->
			<div class="col-md-12">
				<div class="form-group">
				<label for="sp02" class="control-label"> Sp02 </label>
				<input type="text" class="form-control" id="sp02" name="sp02"
				value="{{{ isset($data->sp02 ) ? $data->sp02  : old('sp02') }}}">
				<div class="label label-danger">{{ $errors->first("sp02") }}</div>
			</div>
			</div>
			<!-- Sp02 End -->

			<div class="col-md-12">
				<div class="form-group"> <p><br/><br/><br/></p></div>
			</div>
			
		</div>

	</div>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-default">
	<div class="panel-heading">Glasgow </div>
	<div class="panel-wrapper collapse in" aria-expanded="true">
		<div class="panel-body">

		<!-- Gcapilar Start -->
		<div class="col-md-12">
			<div class="form-group">
			<label for="gcapilar" class="control-label"> Capilar </label>
			<input type="number" class="form-control" id="gcapilar" name="gcapilar" onchange="calculaTotalGlass()";
			value="{{{ isset($data->gcapilar ) ? $data->gcapilar  : '0' }}}">
			<div class="label label-danger">{{ $errors->first("gcapilar") }}</div>
		</div>
		</div>
		<!-- Gcapilar End -->
		
		<!-- Ocular Start -->
		<div class="col-md-12">
			<div class="form-group">
			<label for="ocular" class="control-label"> Ocular </label>
			<input type="number" class="form-control" id="ocular" name="ocular" onchange="calculaTotalGlass()";
			value="{{{ isset($data->ocular ) ? $data->ocular  : '0' }}}">
			<div class="label label-danger">{{ $errors->first("ocular") }}</div>
		</div>
		</div>
		<!-- Ocular End -->
		
		<!-- Verbal Start -->
		<div class="col-md-12">
			<div class="form-group">
			<label for="verbal" class="control-label"> Verbal </label>
			<input type="number" class="form-control" id="verbal" name="verbal" onchange="calculaTotalGlass()";
			value="{{{ isset($data->verbal ) ? $data->verbal  : '0' }}}">
			<div class="label label-danger">{{ $errors->first("verbal") }}</div>
		</div>
		</div>
		<!-- Verbal End -->
		
		<!-- Motriz Start -->
		<div class="col-md-12">
			<div class="form-group">
			<label for="motriz" class="control-label"> Motriz </label>
			<input type="number" class="form-control" id="motriz" name="motriz" onchange="calculaTotalGlass()";
			value="{{{ isset($data->motriz ) ? $data->motriz  : '0' }}}">
			<div class="label label-danger">{{ $errors->first("motriz") }}</div>
		</div>
		</div>
		<!-- Motriz End -->
		
		<!-- Gtotal Start -->
		<div class="col-md-12">
			<div class="form-group">
			<label for="gtotal" class="control-label"> Total </label>
			<input type="number" class="form-control" id="gtotal" name="gtotal" readonly style="background: #CCC;"
			value="{{{ isset($data->gtotal ) ? $data->gtotal  : old('gtotal') }}}">
			<div class="label label-danger">{{ $errors->first("gtotal") }}</div>
		</div>
		</div>
		<!-- Gtotal End -->

			<div class="col-md-12">
				<div class="form-group"> <p><br/><br/><br/></p></div>
			</div>

		</div>

	</div>
	</div>
</div>

<div class="col-md-6">
	<div class="panel panel-default">
	<div class="panel-heading">Antecedentes </div>
	<div class="panel-wrapper collapse in" aria-expanded="true">
		<div class="panel-body">

			<!-- Diabetes Start -->
			<div class="col-md-12">
				<div class="form-group">
				<label for="diabetes" class="control-label"> Diabetes </label>
				<input type="text" class="form-control" id="diabetes" name="diabetes"
				value="{{{ isset($data->diabetes ) ? $data->diabetes  : old('diabetes') }}}">
				<div class="label label-danger">{{ $errors->first("diabetes") }}</div>
			</div>
			</div>
			<!-- Diabetes End -->
			
			<!-- Hipertencion Start -->
			<div class="col-md-12">
				<div class="form-group">
				<label for="hipertencion" class="control-label"> Hipertension </label>
				<input type="text" class="form-control" id="hipertencion" name="hipertencion"
				value="{{{ isset($data->hipertencion ) ? $data->hipertencion  : old('hipertencion') }}}">
				<div class="label label-danger">{{ $errors->first("hipertencion") }}</div>
			</div>
			</div>
			<!-- Hipertencion End -->
			
			<!-- Alergias Start -->
			<div class="col-md-12">
				<div class="form-group">
				<label for="alergias" class="control-label"> Alergias </label>
				<input type="text" class="form-control" id="alergias" name="alergias"
				value="{{{ isset($data->alergias ) ? $data->alergias  : old('alergias') }}}">
				<div class="label label-danger">{{ $errors->first("alergias") }}</div>
			</div>
			</div>
			<!-- Alergias End -->
			
			<!-- Fum Start -->
			<div class="col-md-12">
				<div class="form-group">
				<label for="fum" class="control-label"> Fum </label>
				<input type="text" class="form-control" id="fum" name="fum"
				value="{{{ isset($data->fum ) ? $data->fum  : old('fum') }}}">
				<div class="label label-danger">{{ $errors->first("fum") }}</div>
			</div>
			</div>
			<!-- Fum End -->
			
			<!-- Ecardiacas Start -->
			<div class="col-md-12">
				<div class="form-group">
				<label for="ecardiacas" class="control-label"> Ecardiacas </label>
				<input type="text" class="form-control" id="ecardiacas" name="ecardiacas"
				value="{{{ isset($data->ecardiacas ) ? $data->ecardiacas  : old('ecardiacas') }}}">
				<div class="label label-danger">{{ $errors->first("ecardiacas") }}</div>
			</div>
			</div>
			<!-- Ecardiacas End -->
			
			<!-- Otras Start -->
			<div class="col-md-12">
				<div class="form-group">
				<label for="otras" class="control-label"> Otras </label>
				<input type="text" class="form-control" id="otras" name="otras"
				value="{{{ isset($data->otras ) ? $data->otras  : old('otras') }}}">
				<div class="label label-danger">{{ $errors->first("otras") }}</div>
			</div>
			</div>
			<!-- Otras End -->			
		</div>

	</div>
	</div>
</div>

@section('scripts')

<script>
	function calculaTotalGlass() {
		
		var gcapilar 	= parseFloat($('#gcapilar').val());
		var ocular 		= parseFloat($('#ocular').val());
		var verbal 		= parseFloat($('#verbal').val());
		var motriz 		= parseFloat($('#motriz').val());
		
		if(isNaN(gcapilar)) {
			swal({ title: "ATENCION", text: "El valor capilar definido no es correcto", type: "warning"});
			return false;
		}

		if(isNaN(ocular)) {
			swal({ title: "ATENCION", text: "El valor ocular definido no es correcto", type: "warning"});
			return false;
		}

		if(isNaN(verbal)) {
			swal({ title: "ATENCION", text: "El verbal definido no es correcto", type: "warning"});
			return false;
		}

		if(isNaN(motriz)) {
			swal({ title: "ATENCION", text: "El  motriz definido no es correcto", type: "warning"});
			return false;
		}
	
		var total = gcapilar + ocular + verbal + motriz;
		
		$('#gtotal').val(total.toFixed(2));
	}	
</script>
@endsection