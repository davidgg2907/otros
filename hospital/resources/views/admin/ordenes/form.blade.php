

												<!-- Tipo Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="tipo" class="control-label"> Tipo </label>
												    <input type="text" class="form-control" id="tipo" name="tipo"
												    value="{{{ isset($data->tipo ) ? $data->tipo  : old('tipo') }}}">
												    <div class="label label-danger">{{ $errors->first("tipo") }}</div>
											   </div>
												</div>
												<!-- Tipo End -->
												
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

											
												<!-- Paciente_id Start -->
												<div class="col-md-6">
											    <div class="form-group">
											        <label for="paciente_id" class="control-label"> Paciente_id </label>
											        <select id="paciente_id" name="paciente_id" class="form-control">
																	<option value=""> [-SELECCIONE-] </option>
											            <?php foreach ($enfermeria as $value) { ?>
											               <option value="<?php echo $value->id; ?>" <?php if($data->paciente_id == $value->id) { echo 'selected'; }?>><?php echo $value->nombre; ?></option>
											            <?php } ?>
											        </select>
											        <div class="label label-danger">{{ $errors->first("paciente_id") }}</div>
											     </div>
											  </div>
											  <!-- Paciente_id End -->

											
												<!-- Fecha_solicitud Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fecha_solicitud" class="control-label"> Fecha_solicitud </label>
												    <input type="text" class="form-control" id="fecha_solicitud" name="fecha_solicitud"
												    value="{{{ isset($data->fecha_solicitud ) ? $data->fecha_solicitud  : old('fecha_solicitud') }}}">
												    <div class="label label-danger">{{ $errors->first("fecha_solicitud") }}</div>
											   </div>
												</div>
												<!-- Fecha_solicitud End -->
												
												<!-- Fecha_aplicacion Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="fecha_aplicacion" class="control-label"> Fecha_aplicacion </label>
												    <input type="text" class="form-control" id="fecha_aplicacion" name="fecha_aplicacion"
												    value="{{{ isset($data->fecha_aplicacion ) ? $data->fecha_aplicacion  : old('fecha_aplicacion') }}}">
												    <div class="label label-danger">{{ $errors->first("fecha_aplicacion") }}</div>
											   </div>
												</div>
												<!-- Fecha_aplicacion End -->
												
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
												
