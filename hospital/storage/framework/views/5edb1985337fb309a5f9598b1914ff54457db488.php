<div style="width:49%; float: left; ">
  <?php if($empresa->logotipo) { ?>
    <img src="<?php echo e(asset('uploads/empresa/' . $empresa->logotipo)); ?>" width="20%"/>
  <?php } else {  ?>

  <?php } ?>
</div>
<div style="width:49%; float: left; text-align:right; font-size: 8px">
  <?php echo $empresa->nombre; ?><br/>
  <?php echo $empresa->direccion . ' ' . $empresa->colonia . ' <br/>' . $empresa->ciudad . ' ' . $empresa->estado . ' <br/>' . $empresa->cp; ?><br/>
  <?php echo $empresa->telefono; ?><br/>
  <?php echo $empresa->correo; ?><br/>
  <b>Fecha: </b><?php echo e(date('d/Y/m',strtotime($data->fecha))); ?>


</div>


<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>


<div style="width:100%; text-align:center; margin-left: 10px; font-size:12px;clear:both">
  <h2>FICHA SERVICIO DE  AMBULANCIAS</h2>
</div>


<div style="width:100%; text-align:left;font-size:12px;clear:both"></div>

<div style="width:99%; float: left; ">
  <table style="width:100%;" cellspacing="0">
    <tr>
      <td style="border:1px solid #CCC; padding:5px; font-size:12px; background: #F9F9F9; font-weight:bold">Servicio</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:12px"><?php echo e($data->servicio); ?></td>
      <td style="border:1px solid #CCC; padding:5px; font-size:12px; background: #F9F9F9; font-weight:bold">Unidad</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:12px"><?php echo e($data->unidad); ?></td>
      <td colspan="2" style="border:1px solid #CCC; padding:5px; font-size:12px; background: #F9F9F9; font-weight:bold">Chofer</td>
      <td colspan="2" style="border:1px solid #CCC; padding:5px; font-size:12px"><?php echo e($data->chofer); ?></td>
    </tr>
    <tr>
      <td colspan="2" style="border:1px solid #CCC; padding:5px; font-size:12px; background: #F9F9F9; font-weight:bold">Medico</td>
      <td colspan="2" style="border:1px solid #CCC; padding:5px; font-size:12px"><?php echo e($data->medico); ?></td>
      <td colspan="2" style="border:1px solid #CCC; padding:5px; font-size:12px; background: #F9F9F9;  font-weight:bold">Enfermera</td>
      <td colspan="2" style="border:1px solid #CCC; padding:5px; font-size:12px"><?php echo e($data->enfermera); ?></td>
    </tr>

    <tr>
      <td colspan="2" style="border:1px solid #CCC; padding:5px; font-size:12px; background: #F9F9F9; font-weight:bold">Paciente</td>
      <td colspan="6" style="border:1px solid #CCC; padding:5px; font-size:12px"><?php echo e($data->paciente); ?></td>
    </tr>

    <tr>
      <td colspan="2" style="border:1px solid #CCC; padding:5px; font-size:12px; background: #F9F9F9; font-weight:bold">Acompañante</td>
      <td colspan="6" style="border:1px solid #CCC; padding:5px; font-size:12px"><?php echo e($data->acompanante); ?></td>
    </tr>


    <tr>
      <td colspan="4" style="border:1px solid #CCC; padding:5px; font-size:12px; background: #F9F9F9; font-weight:bold">Origen</td>
      <td colspan="4" style="border:1px solid #CCC; padding:5px; font-size:12px; background: #F9F9F9; font-weight:bold">Destino</td>
    </tr>
    <tr>
      <td colspan="4" style="border:1px solid #CCC; padding:5px; font-size:12px; height:70px; vertical-align:text-top;padding-top:10px;"><?php echo e($data->origen); ?></td>
      <td colspan="4" style="border:1px solid #CCC; padding:5px; font-size:12px; height:70px; vertical-align:text-top;padding-top:10px;"><?php echo e($data->destino); ?></td>
    </tr>
    <tr>
      <td colspan="8" style="border:1px solid #CCC; padding:5px; font-size:12px; background: #F9F9F9; font-weight:bold">Diagnostico</td>
    </tr>
    <tr>
      <td colspan="8" style="border:1px solid #CCC; padding:5px; font-size:12px; height:250px; vertical-align:text-top;padding-top:10px;"><?php echo e($data->diagnostico); ?></td>
    </tr>
    <tr>
      <td colspan="8" style="border:1px solid #CCC; padding:5px; font-size:12px; background: #F9F9F9; font-weight:bold">Comentarios</td>
    </tr>
    <tr>
      <td colspan="8" style="border:1px solid #CCC; padding:5px; font-size:12px; height:250px; vertical-align:text-top;padding-top:10px;"><?php echo e($data->comentario); ?></td>
    </tr>
    <tr>
      <td colspan="8" style="border:1px solid #CCC; padding:5px; font-size:12px; background: #F9F9F9; font-weight:bold; text-align:center;"></td>
    </tr>
    <tr>
      <td colspan="8" style="border:1px solid #CCC; padding:5px; font-size:12px; height:50px; vertical-align:text-top;padding-top:10px;"></td>
    </tr>
    <tr>
      <td colspan="8" style="border:1px solid #CCC; padding:5px; font-size:12px; background: #F9F9F9; font-weight:bold; text-align:center;">Nombre y firma de quien autoriza</td>
    </tr>

  </table>
</div>
