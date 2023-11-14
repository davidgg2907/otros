

												<!-- Medico_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="medico_id" class="control-label"> Medico_id </label>
												    <input type="text" class="form-control" id="medico_id" name="medico_id"
												    value="{{{ isset($data->medico_id ) ? $data->medico_id  : old('medico_id') }}}">
												    <div class="label label-danger">{{ $errors->first("medico_id") }}</div>
											   </div>
												</div>
												<!-- Medico_id End -->
												
												<!-- Paciente_id Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="paciente_id" class="control-label"> Paciente_id </label>
												    <input type="text" class="form-control" id="paciente_id" name="paciente_id"
												    value="{{{ isset($data->paciente_id ) ? $data->paciente_id  : old('paciente_id') }}}">
												    <div class="label label-danger">{{ $errors->first("paciente_id") }}</div>
											   </div>
												</div>
												<!-- Paciente_id End -->
												
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
												
												<!-- Tipo_descripcion Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="tipo_descripcion" class="control-label"> Tipo_descripcion </label>
												    <input type="text" class="form-control" id="tipo_descripcion" name="tipo_descripcion"
												    value="{{{ isset($data->tipo_descripcion ) ? $data->tipo_descripcion  : old('tipo_descripcion') }}}">
												    <div class="label label-danger">{{ $errors->first("tipo_descripcion") }}</div>
											   </div>
												</div>
												<!-- Tipo_descripcion End -->
												
												<!-- Nota_medica Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="nota_medica" class="control-label"> Nota_medica </label>
												    <input type="text" class="form-control" id="nota_medica" name="nota_medica"
												    value="{{{ isset($data->nota_medica ) ? $data->nota_medica  : old('nota_medica') }}}">
												    <div class="label label-danger">{{ $errors->first("nota_medica") }}</div>
											   </div>
												</div>
												<!-- Nota_medica End -->
												
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
												
