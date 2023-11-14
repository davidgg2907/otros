

												<!-- Paciente_id Start -->
												<div class="col-md-6">
											    <div class="form-group">
											        <label for="paciente_id" class="control-label"> Paciente_id </label>
											        <select id="paciente_id" name="paciente_id" class="form-control">
																	<option value=""> [-SELECCIONE-] </option>
											            <?php foreach ($pacientes as $value) { ?>
											               <option value="<?php echo $value->id; ?>" <?php if($data->paciente_id == $value->id) { echo 'selected'; }?>><?php echo $value->nombre; ?></option>
											            <?php } ?>
											        </select>
											        <div class="label label-danger">{{ $errors->first("paciente_id") }}</div>
											     </div>
											  </div>
											  <!-- Paciente_id End -->

											
												<!-- Medico_id Start -->
												<div class="col-md-6">
											    <div class="form-group">
											        <label for="medico_id" class="control-label"> Medico_id </label>
											        <select id="medico_id" name="medico_id" class="form-control">
																	<option value=""> [-SELECCIONE-] </option>
											            <?php foreach ($medicos as $value) { ?>
											               <option value="<?php echo $value->id; ?>" <?php if($data->medico_id == $value->id) { echo 'selected'; }?>><?php echo $value->nombre; ?></option>
											            <?php } ?>
											        </select>
											        <div class="label label-danger">{{ $errors->first("medico_id") }}</div>
											     </div>
											  </div>
											  <!-- Medico_id End -->

											
												<!-- Enfermera_id Start -->
												<div class="col-md-6">
											    <div class="form-group">
											        <label for="enfermera_id" class="control-label"> Enfermera_id </label>
											        <select id="enfermera_id" name="enfermera_id" class="form-control">
																	<option value=""> [-SELECCIONE-] </option>
											            <?php foreach ($enfermeria as $value) { ?>
											               <option value="<?php echo $value->id; ?>" <?php if($data->enfermera_id == $value->id) { echo 'selected'; }?>><?php echo $value->nombre; ?></option>
											            <?php } ?>
											        </select>
											        <div class="label label-danger">{{ $errors->first("enfermera_id") }}</div>
											     </div>
											  </div>
											  <!-- Enfermera_id End -->

											
												<!-- Cita_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="cita_id" class="control-label"> Cita_id </label>
												    <input type="text" class="form-control" id="cita_id" name="cita_id"
												    value="{{{ isset($data->cita_id ) ? $data->cita_id  : old('cita_id') }}}">
												    <div class="label label-danger">{{ $errors->first("cita_id") }}</div>
											   </div>
												</div>
												<!-- Cita_id End -->
												
												<!-- Hospitalizacion_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="hospitalizacion_id" class="control-label"> Hospitalizacion_id </label>
												    <input type="text" class="form-control" id="hospitalizacion_id" name="hospitalizacion_id"
												    value="{{{ isset($data->hospitalizacion_id ) ? $data->hospitalizacion_id  : old('hospitalizacion_id') }}}">
												    <div class="label label-danger">{{ $errors->first("hospitalizacion_id") }}</div>
											   </div>
												</div>
												<!-- Hospitalizacion_id End -->
												
												<!-- Fecha Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fecha" class="control-label"> Fecha </label>
												    <input type="text" class="form-control" id="fecha" name="fecha"
												    value="{{{ isset($data->fecha ) ? $data->fecha  : old('fecha') }}}">
												    <div class="label label-danger">{{ $errors->first("fecha") }}</div>
											   </div>
												</div>
												<!-- Fecha End -->
												
												<!-- Presion Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="presion" class="control-label"> Presion </label>
												    <input type="text" class="form-control" id="presion" name="presion"
												    value="{{{ isset($data->presion ) ? $data->presion  : old('presion') }}}">
												    <div class="label label-danger">{{ $errors->first("presion") }}</div>
											   </div>
												</div>
												<!-- Presion End -->
												
												<!-- Temperatura Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="temperatura" class="control-label"> Temperatura </label>
												    <input type="text" class="form-control" id="temperatura" name="temperatura"
												    value="{{{ isset($data->temperatura ) ? $data->temperatura  : old('temperatura') }}}">
												    <div class="label label-danger">{{ $errors->first("temperatura") }}</div>
											   </div>
												</div>
												<!-- Temperatura End -->
												
												<!-- Pulsaciones Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="pulsaciones" class="control-label"> Pulsaciones </label>
												    <input type="text" class="form-control" id="pulsaciones" name="pulsaciones"
												    value="{{{ isset($data->pulsaciones ) ? $data->pulsaciones  : old('pulsaciones') }}}">
												    <div class="label label-danger">{{ $errors->first("pulsaciones") }}</div>
											   </div>
												</div>
												<!-- Pulsaciones End -->
												
												<!-- Altura Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="altura" class="control-label"> Altura </label>
												    <input type="text" class="form-control" id="altura" name="altura"
												    value="{{{ isset($data->altura ) ? $data->altura  : old('altura') }}}">
												    <div class="label label-danger">{{ $errors->first("altura") }}</div>
											   </div>
												</div>
												<!-- Altura End -->
												
												<!-- Peso Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="peso" class="control-label"> Peso </label>
												    <input type="text" class="form-control" id="peso" name="peso"
												    value="{{{ isset($data->peso ) ? $data->peso  : old('peso') }}}">
												    <div class="label label-danger">{{ $errors->first("peso") }}</div>
											   </div>
												</div>
												<!-- Peso End -->
												
												<!-- Comentarios Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="comentarios" class="control-label"> Comentarios </label>
												    <input type="text" class="form-control" id="comentarios" name="comentarios"
												    value="{{{ isset($data->comentarios ) ? $data->comentarios  : old('comentarios') }}}">
												    <div class="label label-danger">{{ $errors->first("comentarios") }}</div>
											   </div>
												</div>
												<!-- Comentarios End -->
												
												<!-- Status Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="status" class="control-label"> Status </label>
												    <input type="text" class="form-control" id="status" name="status"
												    value="{{{ isset($data->status ) ? $data->status  : old('status') }}}">
												    <div class="label label-danger">{{ $errors->first("status") }}</div>
											   </div>
												</div>
												<!-- Status End -->
												
