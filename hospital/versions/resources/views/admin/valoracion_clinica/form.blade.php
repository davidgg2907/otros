

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
												
												<!-- Valoracion Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="valoracion" class="control-label"> Valoracion </label>
												    <input type="text" class="form-control" id="valoracion" name="valoracion"
												    value="{{{ isset($data->valoracion ) ? $data->valoracion  : old('valoracion') }}}">
												    <div class="label label-danger">{{ $errors->first("valoracion") }}</div>
											   </div>
												</div>
												<!-- Valoracion End -->
												
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
												
