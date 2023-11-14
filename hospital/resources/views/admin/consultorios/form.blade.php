<!-- Dia_laboral Start -->
<div class="col-md-4">
 <div class="form-group">
  <label for="consultorio" class="control-label"> Nro de Consultorio </label>
    <input type="text" class="form-control" id="consultorio" name="consultorio"
    value="{{{ isset($data->consultorio ) ? $data->consultorio  : old('consultorio') }}}">
    <div class="label label-danger">{{ $errors->first("consultorio") }}</div>
 </div>
</div>
<!-- Dia_laboral End -->


<!-- Dia_laboral Start -->
<div class="col-md-8">
 <div class="form-group">
  <label for="descripcion" class="control-label"> Nombre o Alias </label>
    <input type="text" class="form-control" id="descripcion" name="descripcion"
    value="{{{ isset($data->descripcion ) ? $data->descripcion  : old('descripcion') }}}">
    <div class="label label-danger">{{ $errors->first("descripcion") }}</div>
 </div>
</div>
<!-- Dia_laboral End -->


<!-- Medico_id Start -->
<div class="col-md-6">
  <div class="form-group">
      <label for="medico_id" class="control-label"> Medico de Turno </label>
      <select id="medico_id" name="medico_id" class="form-control">
					<option value="0"> [-NINGUNO-] </option>
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
      <label for="enfermera_id" class="control-label"> Auxiliar de Enfermeria </label>
      <select id="enfermera_id" name="enfermera_id" class="form-control">
					<option value="0"> [-NINGUNO-] </option>
          <?php foreach ($enfermeria as $value) { ?>
             <option value="<?php echo $value->id; ?>" <?php if($data->enfermera_id == $value->id) { echo 'selected'; }?>><?php echo $value->nombre; ?></option>
          <?php } ?>
      </select>
      <div class="label label-danger">{{ $errors->first("enfermera_id") }}</div>
   </div>
</div>
<!-- Enfermera_id End -->


<!-- Dia_laboral Start -->
<div class="col-md-4">
 <div class="form-group">
  <label for="dia_laboral" class="control-label"> Dia Laboral </label>
  <select class="form-control" id="dia_laboral" name="dia_laboral">
    <option value="Lunes" <?php if($data->dia_laboral == "Lunes") { echo 'selected'; } ?>>Lunes</option>
    <option value="Martes" <?php if($data->dia_laboral == "Martes") { echo 'selected'; } ?>>Martes</option>
    <option value="Miercoles" <?php if($data->dia_laboral == "Miercoles") { echo 'selected'; } ?>>Miercoles</option>
    <option value="Jueves" <?php if($data->dia_laboral == "Jueves") { echo 'selected'; } ?>>Jueves</option>
    <option value="Viernes" <?php if($data->dia_laboral == "Viernes") { echo 'selected'; } ?>>Viernes</option>
    <option value="Sabado" <?php if($data->dia_laboral == "Sabado") { echo 'selected'; } ?>>Sabado</option>
    <option value="Domingo" <?php if($data->dia_laboral == "Domingo") { echo 'selected'; } ?>>Domingo</option>
  </select>
  <div class="label label-danger">{{ $errors->first("dia_laboral") }}</div>
 </div>
</div>
<!-- Dia_laboral End -->

<!-- Hora_inicio Start -->
<div class="col-md-4">
 <div class="form-group">
  <label for="hora_inicio" class="control-label"> Hora de Inicio </label>
    <input type="text" class="form-control timepicker" id="hora_inicio" name="hora_inicio"
    value="{{{ isset($data->hora_inicio ) ? $data->hora_inicio  : old('hora_inicio') }}}">
    <div class="label label-danger">{{ $errors->first("hora_inicio") }}</div>
 </div>
</div>
<!-- Hora_inicio End -->

<!-- Hora_fin Start -->
<div class="col-md-4">
 <div class="form-group">
  <label for="hora_fin" class="control-label"> Hora de Termino </label>
    <input type="text" class="form-control timepicker" id="hora_fin" name="hora_fin"
    value="{{{ isset($data->hora_fin ) ? $data->hora_fin  : old('hora_fin') }}}">
    <div class="label label-danger">{{ $errors->first("hora_fin") }}</div>
 </div>
</div>
<!-- Hora_fin End -->

<input type="hidden" class="form-control" id="status" name="status" value="1">
