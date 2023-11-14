<div style="width:33%; float:left; text-align:left; font-size:10px;">
  <h5>Fecha: <?php echo $data->fecha; ?></h5>
</div>

<div style="width:33%; float: left; text-align:center">
  <?php if($empresa->logotipo) { ?>
    <img src="<?php echo e(asset('uploads/empresa/' . $empresa->logotipo)); ?>" width="50"/>
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

<div style="width:100%; margin-top:10px; font-size: 10px;">
  <h3>Signos Vitales</h3>
  <table style="font-size: 10px; width:100%">
    <tbody>
      <tr>
        <td style="width:3%">F.C.</td>
        <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($data->fc); ?></td>
        <td style="width:3%">F.R.</td>
        <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($data->fr); ?></td>
        <td style="width:2%">T.</td>
        <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($data->temperatura); ?></td>
        <td style="width:5%">Peso</td>
        <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($data->peso); ?> Kg.</td>
        <td style="width:5%">Talla</td>
        <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($data->talla); ?> C.m</td>
        <td style="width:3%">T/A</td>
        <td style="border-bottom:1px solid #999999; text-align:center"> <?php echo e($data->ta1); ?>/ <?php echo e($data->ta2); ?> </td>
        <td style="width:5%">Sat O <sup>2</sup></td>
        <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($data->sato2); ?> %</td>
      </tr>
    </tbody>
  </table>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:10px;clear:both"><hr style="border:1px solid #CCC;"/></div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:10px;clear:both">
  <h3>Seguimiento Clinico</h3>
  <p> <?php echo $data->razon_visita; ?> </p>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:10px;clear:both"><hr style="border:1px solid #CCC;"/></div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:10px;clear:both">
  <h3>Diagnostico Clinico</h3>
  <p> <?php echo $data->diagnostico; ?> </p>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:10px;clear:both">
  <h3>Tratamiento Clinico</h3>
  <p> <?php echo $data->tratamiento; ?> </p>
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
