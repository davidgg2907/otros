
<div style="width:49%; float: left; text-align:left; margin-bottom: 10px;">
  <?php if($empresa->logotipo) { ?>
    <img src="<?php echo e(asset('uploads/empresa/' . $empresa->logotipo)); ?>" width="100"/>
  <?php } else {  ?>

  <?php } ?>
</div>

<div style="width:49%; float: left; text-align:right; margin-bottom: 10px; font-size: 11px;">
  Doctor: <?php echo $data->doctor->nombre; ?><br/>
  <?php echo $data->doctor->especialidad; ?><br/>
    Celular: <?php echo $data->doctor->celular; ?><br/>
  Cedula: <?php echo $data->doctor->cedula; ?><br/>
  <?php echo $data->doctor->rfc; ?><br/>
  <?php echo $data->doctor->telefono; ?><br/>
</div>

<div style="width:49%; float: left; text-align:left; margin-top:10px; margin-left: 10px; font-size:10px;">
  <?php echo $data->paciente->nombre; ?><br/>
  <?php if($data->paciente->sexo =='F') { echo 'Femenino'; } else { echo 'Masculino'; }; ?><br/>
  <?php echo date('Y') - date('Y',strtotime($data->paciente->nacimiento)); ?> Años<br/>
</div>

<div style="width:49%; float: left;  text-align:right; margin-top:10px; margin-left: 10px; font-size:10px">
    Fecha: <?php echo date('Y-m-d H:i:s',strtotime($data->fecha)); ?>
</div>
<div style="width:100%; margin-top:10px"><hr style="border:1px solid #F9F9F9"></div>
<!--
<div style="width:100%; margin-top:10px; font-size: 10px;">
  <h3>Signos Vitales</h3>
  <table style="font-size: 10px; width:100%">
    <tbody>
      <tr>
        <td style="width:3%">F.C.</td>
        <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($consulta->fc); ?></td>
        <td style="width:3%">F.R.</td>
        <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($consulta->fr); ?></td>
        <td style="width:2%">T.</td>
        <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($consulta->temperatura); ?></td>
        <td style="width:5%">Peso</td>
        <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($consulta->peso); ?> Kg.</td>
        <td style="width:5%">Talla</td>
        <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($consulta->talla); ?> C.m</td>
        <td style="width:3%">T/A</td>
        <td style="border-bottom:1px solid #999999; text-align:center"> <?php echo e($consulta->ta1); ?>/ <?php echo e($consulta->ta2); ?> </td>
        <td style="width:5%">Sat O <sup>2</sup></td>
        <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($consulta->sato2); ?> %</td>
      </tr>
    </tbody>
  </table>
</div>
<div style="width:100%; margin-top:20px"><hr style="border:1px solid #F9F9F9"></div>
-->
<div style="width:100%; margin-top:20px; font-size: 10px">
  <?php echo $data->medicamentos; ?>

</div>

<div style="width:100%; margin-top:20px"><hr style="border:1px solid #F9F9F9"></div>


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

<div style="float:left; width:100%; margin-top:10px"></div>
