

												<!-- Receta_id Start -->
												<div class="col-md-6">
											    <div class="form-group">
											        <label for="receta_id" class="control-label"> Receta_id </label>
											        <select id="receta_id" name="receta_id" class="form-control">
																	<option value=""> [-SELECCIONE-] </option>
											            <?php foreach ($medicamentos as $value) { ?>
											               <option value="<?php echo $value->id; ?>" <?php if($data->receta_id == $value->id) { echo 'selected'; }?>><?php echo $value->comercial; ?></option>
											            <?php } ?>
											        </select>
											        <div class="label label-danger">{{ $errors->first("receta_id") }}</div>
											     </div>
											  </div>
											  <!-- Receta_id End -->

											
												<!-- Medicamento_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="medicamento_id" class="control-label"> Medicamento_id </label>
												    <input type="text" class="form-control" id="medicamento_id" name="medicamento_id"
												    value="{{{ isset($data->medicamento_id ) ? $data->medicamento_id  : old('medicamento_id') }}}">
												    <div class="label label-danger">{{ $errors->first("medicamento_id") }}</div>
											   </div>
												</div>
												<!-- Medicamento_id End -->
												
												<!-- Dosificacion Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="dosificacion" class="control-label"> Dosificacion </label>
												    <input type="text" class="form-control" id="dosificacion" name="dosificacion"
												    value="{{{ isset($data->dosificacion ) ? $data->dosificacion  : old('dosificacion') }}}">
												    <div class="label label-danger">{{ $errors->first("dosificacion") }}</div>
											   </div>
												</div>
												<!-- Dosificacion End -->
												
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
												
