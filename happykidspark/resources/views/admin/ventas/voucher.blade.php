<style>
 table td { font-size:8px;}
 html { margin: 5px}
</style>
<table style="width:100%">
  <thead>
    <tr>
      <th style="text-align:left; font-size:8px;">
        {{ \App\admin\Configuracion::getConfig()->direccion }} {{ \App\admin\Configuracion::getConfig()->colonia }}<br/>
        {{ \App\admin\Configuracion::getConfig()->ciudad }} {{ \App\admin\Configuracion::getConfig()->estado }} {{ \App\admin\Configuracion::getConfig()->cp }}<br/>
        {{ \App\admin\Configuracion::getConfig()->telefono }}, {{ \App\admin\Configuracion::getConfig()->celular }}
      </th>
      <th style="text-align:right; font-size:8px;">
        Fecha: {{ date('d/m/Y',strtotime($data->fecha)) }}<br/>
        Hora: {{ $data->hora }}<br/>
        Cliente: {{ $data->cliente->nombre }}
      </th>
    </tr>
    <tr>
      <th colspan="2">
        <hr>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="2" >
        <table style="width:100%">
            <thead>
                <tr>
                  <th style="text-align:center">Cant</th>
                  <th style="text-align:left">Descripcion</th>
                  <th style="text-align:center">Precio Unit</th>
                  <th style="text-align:center">Importe</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach(\App\admin\Venta_detalle::where('venta_id',$data->id)->get() as $value) { ?>

                <?php $temporizador = \App\admin\Temporizador::where('venta_id',$data->id)->where('vtadetalle_id',$value->id)->get(); ?>

                <tr>
                  <td style="width:5% text-align:center; padding-bottom:10px; border-bottom:1px solid #E9E9E9"> {{ $value->cantidad }}</td>
                  <td style="text-align:left; padding-bottom:10px; border-bottom:1px solid #E9E9E9">
                    {{ $value->productos->nombre}} <br/>
                    <?php foreach($temporizador as $tempo) { ?>
                      <span style="font-size:4px; padding-left:5px;">
                        {{ $tempo->tiempo->minutos}} Minutos - <b>{{ $tempo->nombre}}</ b> <br/>
                      </span>
                    <?php } ?>
                  </td>
                  <td style="width:15%;text-align:center; padding-bottom:10px; border-bottom:1px solid #E9E9E9"> $ {{ number_format($value->precio,0,".",",") }} </td>
                  <td style="width:15%;text-align:center; padding-bottom:10px; border-bottom:1px solid #E9E9E9"> $ {{ number_format($value->importe,0,".",",") }} </td>
                </tr>
              <?php } ?>
            </tbody>

        </table>

      </td>
    </tr>
    <tr>
      <th colspan="2">
        <hr>
      </th>
    </tr>
  </tbody>
  <tfoot>

    <tr>
      <td style="text-align:right">Metodo de Pago:</td>
      <td style="text-align:right">{{ $data->metodo_pago }}</td>
    </tr>
    @if($data->autorizacion)
      <tr>
        <td style="text-align:right">No Autorizacion:</td>
        <td style="text-align:right">{{ $data->autorizacion }}</td>
      </tr>
    @endif
    <tr>
      <td style="text-align:right">Subtotal:</td>
      <td style="text-align:right">$ {{ number_format($data->subtotal,0,".",",") }}</td>
    </tr>
    <tr>
      <td style="text-align:right">Total:</td>
      <td style="text-align:right">$ {{ number_format($data->totald,0,".",",") }}</td>
    </tr>

    @if($data->efectivo)
      <tr>
        <td style="text-align:right">Efectivo:</td>
        <td style="text-align:right">$ {{ number_format($data->efectivo,0,".",",") }}</td>
      </tr>
      <tr>
        <td style="text-align:right">Cambio:</td>
        <td style="text-align:right">$ {{ number_format($data->cambio,0,".",",") }}</td>
      </tr>
    @endif

    @if($data->autorizacion)
      <tr>
        <td style="text-align:right">Devuelto:</td>
        <td style="text-align:right">$ {{ number_format($data->cambio,0,".",",") }}</td>
      </tr>
    @endif

    <tr>
      <tr>
        <th colspan="2"> <hr> </th>
      </tr>
      <th colspan="2" style="text-align:center">
        <h4>¡ GRACIAS POR SU COMPRA VUELVA PRONTO ! </h4>
      </th>
    </tr>
    <tr>
      <th colspan="2">
        <hr>
      </th>
    </tr>
  </tfoot>
</table>
