<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">Fotografia </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body" style="padding:0px;">
				<input type="file" name="fotografia" class="dropify"
				<?php if($data->fotografia) { ?>
								data-default-file="<?= asset('/uploads/enfermeras/' . $data->fotografia); ?>"
				<?php } ?>
				/>
				<input type="hidden" name="old_fotografia" value="<?php if (isset($data->fotografia) && $data->fotografia!=""){echo $data->fotografia; } ?>" />
				<div class="label label-danger">{{ $errors->first("fotografia") }}</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-8">
	<div class="panel panel-default">
		<div class="panel-heading">Datos Generales </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Nombre Start -->
				<div class="col-md-12">
				 <div class="form-group">
					<label for="nombre" class="control-label"> Nombre </label>
						<input type="text" class="form-control" id="nombre" name="nombre"
						value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
						<div class="label label-danger">{{ $errors->first("nombre") }}</div>
				 </div>
				</div>
				<!-- Nombre End -->

				<!-- Cedula Start -->
				<div class="col-md-4">
				 <div class="form-group">
					<label for="cedula" class="control-label"> Cedula </label>
						<input type="text" class="form-control" id="cedula" name="cedula"
						value="{{{ isset($data->cedula ) ? $data->cedula  : old('cedula') }}}">
						<div class="label label-danger">{{ $errors->first("cedula") }}</div>
				 </div>
				</div>
				<!-- Cedula End -->

				<!-- Rfc Start -->
				<div class="col-md-4">
				 <div class="form-group">
					<label for="rfc" class="control-label"> R.F.C </label>
						<input type="text" class="form-control" id="rfc" name="rfc"
						value="{{{ isset($data->rfc ) ? $data->rfc  : old('rfc') }}}">
						<div class="label label-danger">{{ $errors->first("rfc") }}</div>
				 </div>
				</div>
				<!-- Rfc End -->



				<!-- Curp Start -->
				<div class="col-md-4">
				 <div class="form-group">
					<label for="curp" class="control-label"> C.U.R.P </label>
						<input type="text" class="form-control" id="curp" name="curp"
						value="{{{ isset($data->curp ) ? $data->curp  : old('curp') }}}">
						<div class="label label-danger">{{ $errors->first("curp") }}</div>
				 </div>
				</div>
				<!-- Curp End -->

				<!-- Celular Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="celular" class="control-label"> Celular </label>
						<input type="text" class="form-control" id="celular" name="celular"
						value="{{{ isset($data->celular ) ? $data->celular  : old('celular') }}}">
						<div class="label label-danger">{{ $errors->first("celular") }}</div>
				 </div>
				</div>
				<!-- Celular End -->



				<!-- Honorarios Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="honorarios" class="control-label"> Honorarios </label>
						<input type="text" class="form-control" id="honorarios" name="honorarios"
						value="{{{ isset($data->honorarios ) ? $data->honorarios  : old('honorarios') }}}">
						<div class="label label-danger">{{ $errors->first("honorarios") }}</div>
				 </div>
				</div>
				<!-- Honorarios End -->

				<div class="col-md-12">
				 <div class="form-group">
					 <label for="domicilio" class="control-label"> Domicilio </label>
					<textarea rows="5" class="form-control" id="domicilio" name="domicilio">{{{ isset($data->domicilio ) ? $data->domicilio  : old('domicilio') }}}</textarea>
					<div class="label label-danger">{{ $errors->first("domicilio") }}</div>
				 </div>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Credenciales de acceso</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<!-- Email Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="email" class="control-label"> Email </label>
						<input type="text" class="form-control" id="email" name="email"
						value="{{{ isset($user->email ) ? $user->email  : old('email') }}}">
						<div class="label label-danger">{{ $errors->first("email") }}</div>
				 </div>
				</div>
				<!-- Email End -->

				<!-- Email Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="email" class="control-label"> Permisos de Sistema </label>
					<select class="form-control" name="rol_id" id="rol_id">
						<option value=""> [-SELECCIONE-]</option>
						<?php foreach($roles as $value) { ?>
							<option value="<?php echo $value->id; ?>" <?php if($user->rol == $value->id) { echo 'selected'; } elseif(old('password') == $value->id) { echo 'selected'; } ?>><?php echo $value->name; ?></option>
						<?php } ?>
					</select>
					<div class="label label-danger">{{ $errors->first("rol_id") }}</div>
				 </div>
				</div>
				<!-- Email End -->

				<!-- Password Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="password" class="control-label"> Password </label>
						<input type="text" class="form-control" id="password" name="password"
						value="{{{ isset($data->password ) ? $data->password  : old('password') }}}">
						<div class="label label-danger">{{ $errors->first("password") }}</div>
				 </div>
				</div>
				<!-- Password End -->


				<!-- Password Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="password" class="control-label"> Confirmar Contraseña </label>
						<input type="text" class="form-control" id="password_confirmation" name="password_confirmation">
				 </div>
				</div>
				<!-- Password End -->

			</div>
		</div>
	</div>
</div>

<input type="hidden" class="form-control" id="status" name="status" value="1">

<style> .dropify-wrapper{ height: 490px; } </style>
