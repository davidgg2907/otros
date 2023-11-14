<input type="hidden" name="medico_id" class="form-control" id="medico_id" value="<?php echo e(isset($data->medico_id ) ? $data->medico_id  : 0); ?>" />
<input type="hidden" name="enfermera_id" class="form-control" id="enfermera_id" value="<?php echo e(isset($data->enfermera_id ) ? $data->enfermera_id  : 0); ?>" />
<input type="hidden" name="paciente_id" class="form-control" id="paciente_id" value="<?php echo e(isset($data->paciente_id ) ? $data->paciente_id  : 0); ?>" />
<input type="hidden" name="asistente_id" class="form-control" id="asistente_id" value="<?php echo e(isset($data->asistente_id ) ? $data->asistente_id  : 0); ?>" />

<!-- Rol Start -->
<div class="col-md-4">
  <div class="form-group">
      <label for="rol" class="control-label"> Rol asignado </label>
      <select id="rol" name="rol" class="form-control">
          <?php foreach ($roles as $value) { ?>
             <option value="<?php echo $value->id; ?>" <?php if($data->rol == $value->id) { echo 'selected'; }?>><?php echo $value->name; ?></option>
          <?php } ?>
      </select>
      <div class="label label-danger"><?php echo e($errors->first("rol")); ?></div>
   </div>
</div>
<!-- Rol End -->

<!-- Name Start -->
<div class="col-md-8">
 <div class="form-group">
  <label for="name" class="control-label"> Nombre o Alias </label>
    <input type="text" class="form-control" id="name" name="name"
    value="<?php echo e(isset($data->name ) ? $data->name  : old('name')); ?>">
    <div class="label label-danger"><?php echo e($errors->first("name")); ?></div>
 </div>
</div>
<!-- Name End -->

<!-- Email Start -->
<div class="col-md-6">
 <div class="form-group">
  <label for="email" class="control-label"> Email </label>
    <input type="text" class="form-control" id="email" name="email"
    value="<?php echo e(isset($data->email ) ? $data->email  : old('email')); ?>">
    <div class="label label-danger"><?php echo e($errors->first("email")); ?></div>
 </div>
</div>
<!-- Email End -->

<!-- Password Start -->
<div class="col-md-3">
 <div class="form-group">
	<label for="password" class="control-label"> Password </label>
		<input type="text" class="form-control" id="password" name="password">
		<div class="label label-danger"><?php echo e($errors->first("password")); ?></div>
 </div>
</div>
<!-- Password End -->


<!-- Password Start -->
<div class="col-md-3">
 <div class="form-group">
	<label for="password" class="control-label"> Confirmar Contraseña </label>
		<input type="text" class="form-control" id="password_confirmation" name="password_confirmation">
 </div>
</div>
<!-- Password End -->

<input type="hidden" class="form-control" id="status" name="status" value="1">
