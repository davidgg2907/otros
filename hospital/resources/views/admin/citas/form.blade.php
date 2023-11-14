

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

											
												<!-- Consultorio_id Start -->
												<div class="col-md-6">
											    <div class="form-group">
											        <label for="consultorio_id" class="control-label"> Consultorio_id </label>
											        <select id="consultorio_id" name="consultorio_id" class="form-control">
																	<option value=""> [-SELECCIONE-] </option>
											            <?php foreach ($consultorios as $value) { ?>
											               <option value="<?php echo $value->id; ?>" <?php if($data->consultorio_id == $value->id) { echo 'selected'; }?>><?php echo $value->id; ?></option>
											            <?php } ?>
											        </select>
											        <div class="label label-danger">{{ $errors->first("consultorio_id") }}</div>
											     </div>
											  </div>
											  <!-- Consultorio_id End -->

											
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
												
												<!-- Hora Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="hora" class="control-label"> Hora </label>
												    <input type="text" class="form-control" id="hora" name="hora"
												    value="{{{ isset($data->hora ) ? $data->hora  : old('hora') }}}">
												    <div class="label label-danger">{{ $errors->first("hora") }}</div>
											   </div>
												</div>
												<!-- Hora End -->
												
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
												
