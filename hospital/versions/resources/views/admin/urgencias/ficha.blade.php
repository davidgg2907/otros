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
        <img src="<?php echo asset('uploads/paciente.jpeg')?>" width="150px">
      </td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Nombre</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px" colspan="5"><?php echo $data->paciente; ?></td>
    </tr>
    <tr>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Edad</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->años; ?> Años</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Peso</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->peso; ?> Kg.</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px; background: #F9F9F9; width:10%">Talla</td>
      <td style="border:1px solid #CCC; padding:5px; font-size:8px"><?php echo $data->talla; ?> Mts.</td>
    </tr>

  </table>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>

<!-- MOTIVO DE LA CONSULTA-->
<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both">
  <h3>Motivo de la consulta</h3>
  <p> <?php echo $data->motivo; ?> </p>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>


<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both">
  <h3>ANTECEDENTES HEREDOFAMILIARES:</h3>
  <p> <hr/> </p>
  <p>Diabetes {!! $data->heredo_diabetes !!}</p>
  <p> <hr/> </p>
  <p>Hipertencion {!! $data->heredo_hipertencion !!}</p>
  <p> <hr/> </p>
  <p>Cancer {!! $data->heredo_cancer !!}</p>
  <p> <hr/> </p>
  <p>Convulsiones {!! $data->heredo_convulsiones !!}</p>
  <p> <hr/> </p>
  <p>Lupus, Artitris Reumatoide {!! $data->Heredo_lar !!}</p>
  <p> <hr/> </p>
  <p>Leucemia o Linfoma {!! $data->heredo_leulin !!}</p>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both">
  <h3>ANTECEDENTES PERSONALES PATOLOGICOS:</h3>
  <p>Diabetes {!! $data->patolo_diabetes !!}</p>
  <p> <hr/> </p>
  <p>Hipertencion {!! $data->patolo_hipertencion !!}</p>
  <p> <hr/> </p>
  <p>Cancer {!! $data->patolo_cancer !!}</p>
  <p> <hr/> </p>
  <p>Otras Patologias {!! $data->patolo_otros !!}</p>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both">
  <h3>LE HAN OPERADO DE ALGUNA CIRUGIA, FECHA APROXIMADA</h3>
  <p> <?php echo $data->operaciones; ?> </p>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>


<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both">
  <h3>LE HAN PASADO SANGRE, FECHA APROXIMADA</h3>
  <p> <?php echo $data->transfuciones; ?> </p>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>


<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both">
  <h3>SE HA ROTO UN HUESO, FECHA APROXIMADA</h3>
  <p> <?php echo $data->fracturas; ?> </p>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>


<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both">
  <h3>ES USTED ALERGICO A ALGUN ALIMENTO O MEDICAMENTO CONOCIDO</h3>
  <p> <?php echo $data->alergias; ?> </p>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>




<!-- PADECIMIENTO ACTUAL -->
<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both">
  <h3>Padecimiento Actual</h3>
  <p> <?php echo $data->padecimiento; ?> </p>
</div>

<div style="width:100%; text-align:left; margin-top:20px;font-size:12px;clear:both"><hr style="border:1px solid #CCC;"/></div>
