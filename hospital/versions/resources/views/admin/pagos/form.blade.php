<div class="col-md-6">
	<div class="white-box">
		<div class="row">

			<div class="col-md-12">
			 <div class="form-group">
				 <h4> <li class="fa fa-user fa-lg"></li> {{ $data->paciente->nombre }} </h4>
			 </div>
			 <hr/>
			</div>

			<div class="col-md-6">
			 <div class="form-group text-left">
				 <p> <li class="fa fa-phone fa-lg"></li> Tel: {{ $data->paciente->telefono }}  </p>
			 </div>
			</div>


			<div class="col-md-6">
			 <div class="form-group text-right">
				 <p>
					 <li class="fa fa-mobile fa-lg"></li> Cel: {{ $data->paciente->celular }}
				 </p>
			 </div>
			</div>


			<div class="col-md-12">
			 <div class="form-group">
				 <p>
					 <li class="fa fa-home fa-lg"></li> {{ $data->paciente->domicilio }} <br/>
				 </p>
			 </div>
			</div>

		</div>
	</div>
</div>


<div class="col-md-6">
	<div class="white-box">
		<div class="row">

			<div class="col-md-12">
			 <div class="form-group">
				 <h4> <li class="fa fa-user fa-lg"></li> {{ $data->paciente->nombre }} </h4>
			 </div>
			 <hr/>
			</div>


		</div>
	</div>
</div>



<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Concepto de pagos </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">



			</div>
		</div>
	</div>
</div>


<!-- Paciente_id Start -->
<div class="col-md-6">
  <div class="form-group">
      <label for="paciente_id" class="control-label"> Paciente </label>
      <div class="label label-danger">{{ $errors->first("paciente_id") }}</div>
   </div>
</div>
<!-- Paciente_id End -->


<!-- Consulta_id Start -->
<div class="col-md-6">
  <div class="form-group">
      <label for="consulta_id" class="control-label"> F. Consulta </label>
      <select id="consulta_id" name="consulta_id" class="form-control">
					<option value=""> [-SELECCIONE-] </option>
          <?php foreach ($consultas as $value) { ?>
             <option value="<?php echo $value->id; ?>" <?php if($data->consulta_id == $value->id) { echo 'selected'; }?>><?php echo $value->fecha; ?></option>
          <?php } ?>
      </select>
      <div class="label label-danger">{{ $errors->first("consulta_id") }}</div>
   </div>
</div>
<!-- Consulta_id End -->


<!-- Medico_id Start -->
<div class="col-md-6">
  <div class="form-group">
      <label for="medico_id" class="control-label"> Medico </label>
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



<!-- Fecha_pago Start -->
<div class="col-md-6">
 <div class="form-group">
  <label for="fecha_pago" class="control-label"> Fecha_pago </label>
    <input type="text" class="form-control" id="fecha_pago" name="fecha_pago"
    value="{{{ isset($data->fecha_pago ) ? $data->fecha_pago  : old('fecha_pago') }}}">
    <div class="label label-danger">{{ $errors->first("fecha_pago") }}</div>
 </div>
</div>
<!-- Fecha_pago End -->

<!-- Monto Start -->
<div class="col-md-6">
 <div class="form-group">
  <label for="monto" class="control-label"> Monto </label>
    <input type="text" class="form-control" id="monto" name="monto"
    value="{{{ isset($data->monto ) ? $data->monto  : old('monto') }}}">
    <div class="label label-danger">{{ $errors->first("monto") }}</div>
 </div>
</div>
<!-- Monto End -->

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
