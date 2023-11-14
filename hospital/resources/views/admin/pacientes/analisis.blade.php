<div style="width:49%; float: left; ">
  <?php if($empresa->logotipo) { ?>
    <img src="{{ asset('uploads/empresa/' . $empresa->logotipo) }}" width="20%"/>
  <?php } else {  ?>

  <?php } ?>
</div>
<div style="width:49%; float: left; text-align:right; font-size: 8px">
  <?php echo $empresa->nombre; ?><br/>
  <?php echo $empresa->direccion . ' ' . $empresa->colonia . ' <br/>' . $empresa->ciudad . ' ' . $empresa->estado . ' <br/>' . $empresa->cp; ?><br/>
  <?php echo $empresa->telefono; ?><br/>
  <?php echo $empresa->correo; ?><br/>
  <?php echo $data->fecha; ?>
</div>


<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>


<div style="width:100%; text-align:center; margin-left: 10px; font-size:12px;clear:both">
  <h2>ESTUDIOS DE LABOTARIO Y GABINETE</h2>
</div>

<div style="width:100%; text-align:left;font-size:12px;clear:both"></div>

<div style="width:99%; float: left; ">
  <table style="width:100%;" cellspacing="0">
    <tr>
      <td rowspan="5" style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:23%">
        <?php if($data->paciente->fotografia) { ?>
          <img src="<?php echo asset('uploads/pacientes/' . $data->paciente->fotografia)?>" width="150px">
        <?php } else { ?>
          <img src="<?php echo asset('uploads/paciente.jpeg')?>" width="150px">
        <?php } ?>
      </td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Nombre</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px" colspan="3"><?php echo $data->paciente->nombre; ?></td>
      <!--<td style="border:1px solid #CCC; padding:5px; font-size:8px">F. Nacimiento</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px">Edad</td>-->
    </tr>
    <tr>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Telefono</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->paciente->telefono; ?></td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Celular</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->paciente->celular; ?></td>
    </tr>
    <tr>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">F. Nacimiento</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->paciente->nacimiento; ?></td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Edad</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->paciente->nacimiento; ?></td>
      <!--<td style="border:1px solid #CCC; padding:5px; font-size:8px">F. Nacimiento</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px">Edad</td>-->
    </tr>
    <tr>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Sexo</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->paciente->tsangre; ?></td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">T. Sangre</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->paciente->sexo; ?></td>
    </tr>
    <tr>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Domicilio</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px" colspan="3"><?php echo $data->domicilio; ?></td>
    </tr>
  </table>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>


<div style="width:100%; margin-left: 10px; font-size:10px;clear:both;padding-top:10px;">
  <table style="width:100%; text-align:left;">
    <tr>
      <td style="text-align:left; font-size: 12px; border-right: 1px solid; text-align:center;"><?php echo $data->medico->especialidad; ?></td>
      <td style="text-align:left; font-size: 12px; border-right: 1px solid; text-align:center;"><?php echo $data->medico->nombre; ?></td>
      <td style="text-align:left; font-size: 12px; text-align:center;"><?php echo $data->medico->cedula; ?></td>
    </tr>
  </table>

</div>

<div style="width:100%; text-align:left; margin-top:10px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>


<div style="width:100%; text-align:left; margin-top:20px;font-size:10px;clear:both">
  <h3>RESULTADOS</h3>

  <p> <?php echo $data->diagnostico; ?> </p>
</div>
