<div style="width:33%; float:left; text-align:left; font-size:10px;">
  <h5>Folio: <?php echo $data->id; ?></h5>
  <h5>Fecha: <?php echo $data->fecha; ?></h5>
</div>

<div style="width:33%; float: left; text-align:center">
  <?php if($empresa->logotipo) { ?>
    <img src="{{ asset('uploads/empresa/' . $empresa->logotipo) }}" width="50"/>
  <?php } else {  ?>

  <?php } ?>
</div>


<div style="width:33%; float: left; text-align:right; font-size: 10px">
  <?php echo $empresa->nombre; ?><br/>
  <?php echo $empresa->direccion . ' ' . $empresa->colonia . ' <br/>' . $empresa->ciudad . ' ' . $empresa->estado . ' <br/>' . $empresa->cp; ?><br/>
  <?php echo $empresa->telefono; ?><br/>
  <?php echo $empresa->correo; ?><br/>
</div>

<div style="width:100%; text-align:left; font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>

<div style="width:100%; text-align:center; margin-left: 10px; font-size:10px;clear:both; margin-bottom: 15px">
  <table style="width:100%">
    <tr>
      <td style="text-align:center; font-size: 12px"><?php echo $data->doctor->especialidad; ?></td>
      <td style="text-align:center; font-size: 12px"><?php echo $data->doctor->nombre; ?></td>
      <td style="text-align:center; font-size: 12px"><?php echo $data->doctor->cedula; ?></td>
    </tr>
  </table>
</div>

<div style="width:100%; float: left; margin-top: -10px; font-size: 10px; clear: both;">
  <table style="width:100%;" cellspacing="0">
    <tr>
      <td rowspan="5" style="text-align: center;; border:1px solid #CCC; padding:5px; font-size: 10px">
        <?php if($data->paciente->fotografia) { ?>
          <img src="<?php echo asset('uploads/pacientes/' . $data->paciente->fotografia)?>" width="10%">
        <?php } else { ?>
          <img src="<?php echo asset('uploads/paciente.jpeg')?>" width="10%">
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td style="border:1px solid #CCC; padding:5px; font-size: 10px">Nombre</td>
      <td style="border:1px solid #CCC; padding:5px; font-size: 10px">F. Nacimiento</td>
      <td style="border:1px solid #CCC; padding:5px; font-size: 10px">Edad</td>
    </tr>
    <tr>
      <td style="border:1px solid #CCC; padding:5px; font-size: 10px"><?php echo $data->paciente->nombre; ?></td>
      <td style="border:1px solid #CCC; padding:5px; font-size: 10px"><?php echo $data->paciente->nacimiento; ?></td>
      <td style="border:1px solid #CCC; padding:5px; font-size: 10px"><?php echo $data->paciente->nombre; ?></td>
    </tr>
    <tr>
      <td style="border:1px solid #CCC; padding:5px; font-size: 10px">Tipo Sangre</td>
      <td style="border:1px solid #CCC; padding:5px; font-size: 10px">Sexo</td>
      <td style="border:1px solid #CCC; padding:5px; font-size: 10px">F. Consulta</td>
    </tr>
    <tr>
      <td style="border:1px solid #CCC; padding:5px; font-size: 10px"><?php echo $data->paciente->tsangre; ?></td>
      <td style="border:1px solid #CCC; padding:5px; font-size: 10px"><?php echo $data->paciente->sexo; ?></td>
      <td style="border:1px solid #CCC; padding:5px; font-size: 10px"><?php echo $data->fecha; ?></td>
    </tr>
  </table>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"></div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:10px;clear:both">
  <h3>Seguimiento Clinico</h3>
  <p> <?php echo $data->razon_visita; ?> </p>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:10px;clear:both"><hr style="border:1px solid #CCC;"/></div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:10px;clear:both">
  <h3>Diagnostico Clinico</h3>
  <p> <?php echo $data->diagnostico; ?> </p>
</div>




<div style="position: fixed; left: 0; bottom: 0; width: 100%; text-align: center; margin-top:5px; text-align: center; font-size:10px">

  <div style="width:100%; margin-top:20px; font-size: 10px; text-align:center">
    _______________________________________________
  </div>

  <div style="width:100%; margin-top:20px; font-size: 10px; text-align:center">
    FIRMA DEL DOCTOR
  </div>

  <div style="width:100%; margin-top:20px"><p></p></div>

  <p>
    <?php echo $empresa->nombre; ?><br/>
    <?php echo $empresa->direccion . ' ' . $empresa->colonia . ' ' . $empresa->ciudad . ' ' . $empresa->estado . ' ' . $empresa->cp; ?><br/>
    <?php echo $empresa->telefono; ?><br/>
    <?php echo $empresa->correo; ?><br/>
  </p>

</div>
