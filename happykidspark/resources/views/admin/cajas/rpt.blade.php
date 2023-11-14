  <table style="width:100%;" cellpadding="0" cellspacing="0">
    <tr>
      <td style="width:20%;text-align:left;padding:10px; background: #f3f2f7; border-bottom:1px solid #FFF;">Cajero</td>
      <td colspan="2" style="text-align:left;padding:10px; background: #FFF; border-bottom:1px solid #f3f2f7;">{{ $data->cajero->name }}</td>
    </tr>
    <tr>
      <td style="text-align:left;padding:10px; background: #f3f2f7; border-bottom:1px solid #FFF;">Apertura:</td>
      <td style="text-align:left;padding:10px; background: #FFF; border-bottom:1px solid #f3f2f7;">{{ date('Y-m-d H:i',strtotime($data->inicia)) }}</td>
      <td style="text-align:left;padding:10px; background: #f3f2f7; border-bottom:1px solid #FFF;">Cierre: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date('Y-m-d H:i',strtotime($data->termina)) }}</td>
    </tr>

    <tr>
      <td style="text-align:left;padding:10px; background: #f3f2f7; border-bottom:1px solid #FFF;">Saldo Inicial</td>
      <td style="text-align:left;padding:10px; background: #FFF; border-bottom:1px solid #f3f2f7;">$ {{ number_format($data->monto_inicial,0,".",",") }}</td>
      <td style="text-align:left;padding:10px; background: #f3f2f7; border-bottom:1px solid #FFF;">Saldo al Cierre: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $ {{ number_format($data->monto_final,0,".",",") }}</td>
    </tr>

    <tr>
      <td style="text-align:center;padding:10px; background: #f3f2f7; border-bottom:1px solid #FFF;">Ventas</td>
      <td style="text-align:center;padding:10px; background: #f3f2f7; border-bottom:1px solid #FFF;">Cancelaciones</td>
      <td style="text-align:center;padding:10px; background: #f3f2f7; border-bottom:1px solid #FFF;">Ingreso</td>
    </tr>
    <tr>
      <td style="text-align:center; padding:10px; background: #f3f2f7">{{ \App\admin\Ventas::where('status','!=',0)->where('caja_id',$data->id)->count() }} / $ {{ number_format(\App\admin\Ventas::where('status','!=',0)->where('caja_id',$data->id)->sum('totald'),0,".",",") }}</td>
      <td style="text-align:center; padding:10px; background: #f3f2f7">{{ \App\admin\Ventas::where('status',0)->where('caja_id',$data->id)->count() }} / $ {{ number_format(\App\admin\Ventas::where('status',0)->where('caja_id',$data->id)->sum('totald'),0,".",",") }}</td>
      <td style="text-align:center; padding:10px; background: #f3f2f7">$ {{ number_format(\App\admin\Ventas::where('status','!=',0)->where('caja_id',$data->id)->sum('totald'),0,".",",") }}</td>
    </tr>
  </table>
  <hr/>
  <h4> VENTAS REALIZADAS </h4>
  <hr/>
  <table style="width:100%;">
    <thead>
      <tr>
        <th style="padding:5px; background: #f3f2f7; text-align:center;">Hora</th>
        <th style="padding:5px; background: #f3f2f7; text-align:left;">Cliente</th>
        <th style="padding:5px; background: #f3f2f7; text-align:left;">Producto</th>
        <th style="padding:5px; background: #f3f2f7; text-align:center;">Precio</th>
        <th style="padding:5px; background: #f3f2f7; text-align:center;">Cantidad</th>
        <th style="padding:5px; background: #f3f2f7; text-align:center;">Total</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $detalles = \App\admin\Venta_detalle::select(array('ventas.hora','productos.nombre AS producto',
                                                           'productos.precio','clientes.nombre AS cliente',
                                                           'venta_detalle.importe','venta_detalle.cantidad'))
                                             ->join('ventas','ventas.id','venta_detalle.venta_id')
                                             ->join('productos','productos.id','venta_detalle.producto_id')
                                             ->join('clientes','clientes.id','ventas.cliente_id')
                                             ->where('ventas.caja_id',$data->id)
                                             ->get();

      ?>
      <?php foreach($detalles as $value) { ?>
        <tr
        @if($value->status == 0)
         class="table-danger"
        @elseif($value->status == 3)
          class="table-warning"
        @endif
         >
          <td style="padding:5px; border-bottom:1px solid #f3f2f7; text-align:center;"> {{{ $value->hora }}} </td>
          <td style="padding:5px; border-bottom:1px solid #f3f2f7; text-align:left;"> {{{ $value->cliente }}} </td>
          <td style="padding:5px; border-bottom:1px solid #f3f2f7; text-align:left;"> {{{ $value->producto }}} </td>
          <td style="padding:5px; border-bottom:1px solid #f3f2f7; text-align:center;"> $ {{{ number_format($value->precio,0,".",",") }}} </td>
          <td style="padding:5px; border-bottom:1px solid #f3f2f7; text-align:center;"> {{{ $value->cantidad }}} </td>
          <td style="padding:5px; border-bottom:1px solid #f3f2f7; text-align:center;"> $ {{{ number_format($value->importe,0,".",",") }}} </td>
        </tr>
      <?php }  ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4" style="padding:10px; border-bottom:1px solid #f3f2f7; text-align:right; background: #f3f2f7"> PAGOS EN EFECTIVO </td>
        <td colspan="2" style="padding:10px; border-bottom:1px solid #f3f2f7; text-align:left; background: #f3f2f7">
          $ {{ number_format(\App\admin\Ventas::where('status','!=',0)->where('metodo_pago','Efectivo')->where('caja_id',$data->id)->sum('totald'),0,".",",") }}
        </td>
      </tr>
      <tr>
        <td colspan="4" style="padding:10px; border-bottom:1px solid #f3f2f7; text-align:right; background: #f3f2f7"> PAGOS CON TARJETA CREDITO</td>
        <td colspan="2" style="padding:10px; border-bottom:1px solid #f3f2f7; text-align:left; background: #f3f2f7">
          {{ number_format(\App\admin\Ventas::where('status',1)->where('metodo_pago','Tarjeta Credito')->where('caja_id',$data->id)->sum('totald'),0,".",",") }}
        </td>
      </tr>
      <tr>
        <td colspan="4" style="padding:10px; border-bottom:1px solid #f3f2f7; text-align:right; background: #f3f2f7"> PAGOS CON TARJETA DEBITO</td>
        <td colspan="2" style="padding:10px; border-bottom:1px solid #f3f2f7; text-align:left; background: #f3f2f7">
          {{ number_format(\App\admin\Ventas::where('status',1)->where('metodo_pago','Tarjeta Debito')->where('caja_id',$data->id)->sum('totald'),0,".",",") }}
        </td>
      </tr>
      <tr>
        <td colspan="4" style="padding:10px; border-bottom:1px solid #f3f2f7; text-align:right; background: #f3f2f7"> PAGOS CON TRANSFERENCIA</td>
        <td colspan="2" style="padding:10px; border-bottom:1px solid #f3f2f7; text-align:left; background: #f3f2f7">
          $ {{ number_format(\App\admin\Ventas::where('status',1)->where('metodo_pago','Transferencia')->where('caja_id',$data->id)->sum('totald'),0,".",",") }}
        </td>
      </tr>
    </tfoot>
  </table>
  <hr/>
  <h4> FLUJO DE EFECTIVO </h4>
  <hr/>
  <table style="width:100%;">
    <thead>
      <tr>
        <th style="padding:5px; background: #f3f2f7">Movimiento</th>
        <th style="padding:5px; background: #f3f2f7">Importe</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach(\App\admin\Efectivo::where('caja_id',$data->id)->get() as $value) { ?>
        <tr>
          <td style="padding:5px;"> {{{ $value->tipo == "E" ? "Egreso" : "Ingreso"  }}} </td>
          <td style="padding:5px;"> $ {{{ round($value->importe,0) }}} </td>
        </tr>
        <tr>
          <td colspan="2" style="padding:10px; border-bottom:1px solid #f3f2f7;"> <b>Motivo: <br/> {{{ $value->concepto }}} </td>
        </tr>
      <?php }  ?>
    </tbody>
  </table>
