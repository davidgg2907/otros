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
  <h2>SIGNOS VITALES DEL PACIENTE</h2>
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

<div style="width:100%; text-align:left; margin-top:20px;font-size:10px;clear:both"><hr style="border:1px solid #CCC;"/></div>

<div style="width:100%; margin-top:10px; font-size: 10px;">
  <h3>Seguimiento Clinico</h3>
  <table style="font-size: 10px; width:100%">
    <tbody>
      <tr>
        <td style="width:3%">F.C.</td>
        <td style="border-bottom:1px solid #999999; text-align:center">{{ $data->fc }}</td>
        <td style="width:3%">F.R.</td>
        <td style="border-bottom:1px solid #999999; text-align:center">{{ $data->fr }}</td>
        <td style="width:2%">T.</td>
        <td style="border-bottom:1px solid #999999; text-align:center">{{ $data->temperatura }}</td>
        <td style="width:5%">Peso</td>
        <td style="border-bottom:1px solid #999999; text-align:center">{{ $data->peso }} Kg.</td>
        <td style="width:5%">Talla</td>
        <td style="border-bottom:1px solid #999999; text-align:center">{{ $data->talla }} C.m</td>
        <td style="width:3%">T/A</td>
        <td style="border-bottom:1px solid #999999; text-align:center"> {{ $data->ta1 }}/ {{ $data->ta2 }} </td>
        <td style="width:5%">Sat O <sup>2</sup></td>
        <td style="border-bottom:1px solid #999999; text-align:center">{{ $data->sato2 }} %</td>
      </tr>
    </tbody>
  </table>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:10px;clear:both"><hr style="border:1px solid #CCC;"/></div>
