<div style="width:100%; margin-top:50px clear: both; text-align:center">
   <b>  Voucher  # <?php echo   $data->id; ?> </b>
</div>


<div style="width:49%; float: left; text-align:left; margin-bottom: 10px;">
  <?php if($empresa->logotipo) { ?>
    <img src="{{ asset('uploads/empresa/' . $empresa->logotipo) }}" width="100"/>
  <?php } else {  ?>

  <?php } ?>
</div>

<div style="width:49%; float: left; text-align:right; margin-bottom: 10px; font-size: 11px;">
  Doctor: <?php echo $data->doctor->nombre; ?><br/>
  <?php echo $data->doctor->especialidad; ?><br/>
  Cedula: <?php echo $data->doctor->cedula; ?><br/>
  <?php echo $data->doctor->rfc; ?><br/>
  <?php echo $data->doctor->telefono; ?><br/>
</div>

<div style="width:49%; float: left; text-align:left; margin-top:10px; margin-left: 10px; font-size:10px;">
  <?php if($data->paciente_id != 0) { ?>
    <?php echo $data->paciente->nombre; ?><br/>
    <?php if($data->paciente->sexo =='F') { echo 'Femenino'; } else { echo 'Masculino'; }; ?><br/>
    <?php echo date('Y') - date('Y',strtotime($data->paciente->nacimiento)); ?> Años<br/>
  <?php } else { ?>
    <?php echo $data->urgencia->paciente; ?><br/>
  <?php } ?>
</div>

<div style="width:49%; float: left;  text-align:right; margin-top:10px; margin-left: 10px; font-size:10px">
    Fecha: <?php echo date('Y-m-d H:i:s',strtotime($data->fecha)); ?>
</div>

<div style="width:100%; margin-top:5px"><hr style="border:1px solid #F9F9F9"></div>

<div style="width:49%;float:left; text-align:left; font-size: 10px">
  <?php
    if($data->hospitalizacion_id != 0) {

      echo ' Hospitalizacion del ' . $data->hospitalizacion->fecha_ingreso . ' al ' .  $data->hospitalizacion->fecha_alta;

    } else if($data->consulta_id != 0) {

      echo 'Consulta: ' . $data->consulta->fecha . ' ' . $data->consulta->doctor->nombre;

    } else if($data->urgencia_id != 0) {
      echo ' Servicio de Urgencias ' . $data->urgencia->fecha . ' ' . $data->urgencia->hora;
    }
  ?>
</div>

<div style="width:49%;float:left; text-align:right;  font-size: 10px">
  $ {{ number_format($data->monto,2,".",",") }}
</div>

<div style="width:100%; margin-top:5px"><hr style="border:1px solid #F9F9F9"></div>


<div style="width:100%;float:left; text-align:left; font-size: 10px">
  <h4 style="text-align:center">Servicio Liquidados</h4>
  <?php if($data->hospitalizacion_id != 0) { ?>
    <table style="width:100%; font-size: 10px">
      <thead>
        <tr>
          <th>Concepto</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Importe</th>
        </tr>
        <tr>
          <th colspan="4"> <hr/> </th>
        </tr>
      </thead>
      <?php $servicios = explode(',',$data->servicios); ?>
      <?php foreach($servicios as $value) { ?>
        <?php $servicio_pagado = $data->hospitalizacion->getServicio($value);?>
        <tr>
          <td> {{ $servicio_pagado->descripcion }} </td>
          <td style="border-bottom: 1px: solid #F9F9F9; text-align: center; padding:5px;" > {{ $servicio_pagado->cantidad }} </td>
          <td style="border-bottom: 1px: solid #F9F9F9; text-align: center;" > $ {{ number_format($servicio_pagado->precio,2,".",",") }}</td>
          <td style="border-bottom: 1px: solid #F9F9F9; text-align: center;" > $ {{ number_format($servicio_pagado->importe,2,".",",") }} </td>
        </tr>

        <tr>
          <td colspan="4"> <hr/> </td>
        </tr>
      <?php } ?>

        </table>
      </div>
  <?php } ?>

  <?php if($data->urgencia_id != 0) { ?>
    <table style="width:100%; font-size: 10px">
      <thead>
        <tr>
          <th>Concepto</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Importe</th>
        </tr>
        <tr>
          <th colspan="4"> <hr/> </th>
        </tr>
      </thead>
      <?php $servicios = explode(',',$data->servicios); ?>
      <?php foreach($servicios as $value) { ?>
        <?php $servicio_pagado = $data->urgencia->getServicio($value);?>
        <tr>
          <td> {{ $servicio_pagado->descripcion }} </td>
          <td style="border-bottom: 1px: solid #F9F9F9; text-align: center; padding:5px;" > {{ $servicio_pagado->cantidad }} </td>
          <td style="border-bottom: 1px: solid #F9F9F9; text-align: center;" > $ {{ number_format($servicio_pagado->precio,2,".",",") }}</td>
          <td style="border-bottom: 1px: solid #F9F9F9; text-align: center;" > $ {{ number_format($servicio_pagado->importe,2,".",",") }} </td>
        </tr>

        <tr>
          <td colspan="4"> <hr/> </td>
        </tr>
      <?php } ?>

        </table>
      </div>
  <?php } ?>

</div>

<div style="width:100%; margin-top:5px"><hr style="border:1px solid #F9F9F9"></div>


<div style="width:100%;float:left; text-align:right;  font-size: 10px">
  <h4>Total a Pagar $ {{ number_format($data->monto,2,".",",") }}</h4>
</div>


<div style="position: fixed; left: 0; bottom: 0; width: 100%; text-align: center; margin-top:5px; text-align: center; font-size:10px">

  <div style="width:100%; margin-top:20px"><p></p></div>

  <p>
    <?php echo $empresa->nombre; ?><br/>
    <?php echo $empresa->direccion . ' ' . $empresa->colonia . ' ' . $empresa->ciudad . ' ' . $empresa->estado . ' ' . $empresa->cp; ?><br/>
    <?php echo $empresa->telefono; ?><br/>
    <?php echo $empresa->correo; ?><br/>
  </p>

</div>

<div style="float:left; width:100%; margin-top:10px"></div>
