
<div style="width:49%; float: left; text-align:left; margin-bottom: 10px;">
  <?php if($empresa->logotipo) { ?>
    <img src="{{ asset('uploads/empresa/' . $empresa->logotipo) }}" width="100"/>
  <?php } else {  ?>

  <?php } ?>
</div>

<div style="width:49%; float: left; text-align:right; padding-top: 25px; margin-bottom: 10px;">
  <b>  Orden   # <?php echo   $data->id; ?> </b>
</div>


<div style="width:100%; margin-top:5px; clear: both;"><hr style="border:1px solid #F9F9F9"></div>

<div style="width:100%; text-align: center; margin-top:5px; clear: both; padding: 5px; color; #FFFFFF; background: <?php if($data->status == 1) { echo '#03a9f3'; } else { echo '#00c292'; } ?>">
  <?php if($data->status == 1) { ?>
    <span style="color:#FFF">PENDIENTE</span>
  <?php } else { ?>
    <span style="color:#FFF">PROCESADA</span>
  <?php } ?>
</div>


<div style="width:100%; margin-top:5px; clear: both;"><hr style="border:1px solid #F9F9F9"></div>



<div style="width:49%; float: left; text-align:left; margin-top:10px; margin-left: 10px; font-size:10px;">
  <p>F. Solicitud: {{ $data->fecha_registro }}</p>
  <p>{{ $data->solicitante}}</p>
</div>

<div style="width:49%; float: left;  text-align:right; margin-top:10px; margin-left: 10px; font-size:10px">
    F. Surtido: {{ $data->fecha_surtido }}
</div>

<div style="width:100%; margin-top:5px; clear;both"><hr style="border:1px solid #F9F9F9"></div>


<div style="width:100%;float:left; text-align:left; font-size: 10px">
  <h4 style="text-align:center">Insumos Solicitados</h4>
  {!! $data->solicitado !!}
</div>

<div style="width:100%; margin-top:5px"><hr style="border:1px solid #F9F9F9"></div>


<div style="float:left; width:100%; margin-top:10px"></div>
