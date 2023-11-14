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
</div>


<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>


<div style="width:100%; text-align:center; margin-left: 10px; font-size:12px;clear:both">
  <h2>FICHA CLINICA DE PACIENTE</h2>
</div>

<div style="width:100%; text-align:left;font-size:12px;clear:both"></div>

<div style="width:99%; float: left; ">
  <table style="width:100%;" cellspacing="0">
    <tr>
      <td rowspan="5" style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:23%">
        <?php if($data->fotografia) { ?>
          <img src="<?php echo asset('uploads/pacientes/' . $data->fotografia)?>" width="150px">
        <?php } else { ?>
          <img src="<?php echo asset('uploads/paciente.jpeg')?>" width="150px">
        <?php } ?>
      </td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Nombre</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px" colspan="3"><?php echo $data->nombre; ?></td>
      <!--<td style="border:1px solid #CCC; padding:5px; font-size:8px">F. Nacimiento</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px">Edad</td>-->
    </tr>
    <tr>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Telefono</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->telefono; ?></td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Celular</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->celular; ?></td>
    </tr>
    <tr>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">F. Nacimiento</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->nacimiento; ?></td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Edad</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->nacimiento; ?></td>
      <!--<td style="border:1px solid #CCC; padding:5px; font-size:8px">F. Nacimiento</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px">Edad</td>-->
    </tr>
    <tr>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Sexo</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->tsangre; ?></td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">T. Sangre</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->sexo; ?></td>
    </tr>
    <tr>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Domicilio</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px" colspan="3"><?php echo $data->domicilio; ?></td>
    </tr>
  </table>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both">
  <h3>Antecedentes Hereditarios</h3>
  <p> <?php echo $data->hereditarias; ?> </p>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both">
  <h3>Antecedentes Patologicos</h3>
  <p> <?php echo $data->alergias; ?> </p>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both">
  <h3>Padecimiento Actual</h3>
  <p> <?php echo $data->cirugias; ?> </p>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both">
  <h3>Exploracion Fisica</h3>
  <p> <?php echo $data->vicios; ?> </p>
</div>
