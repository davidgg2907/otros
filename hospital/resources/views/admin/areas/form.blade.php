

												<!-- Nombre Start -->
												<div class="col-md-6">
												 <div class="form-group">
												  <label for="nombre" class="control-label"> Nombre </label>
												    <input type="text" class="form-control" id="nombre" name="nombre"
												    value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
												    <div class="label label-danger">{{ $errors->first("nombre") }}</div>
											   </div>
												</div>
												<!-- Nombre End -->
												
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
												
