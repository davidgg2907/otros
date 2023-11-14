<table style="width:100%; margin-bottom:20px;" cellpadding="0" cellspacing="0">
  <tr>
    <td style="border:1px solid; text-align:center"><img src="{{ asset('images/logo.png') }}" style="height:30px !important; width:100%;max-width:none;"></td>
    <td style="border:1px solid; text-align:center">REEMBOLSO DE GASTOS </td>
    <td style="border:1px solid; text-align:center">Fecha de Pago</td>
  </tr>
  <tr>
    <td style="border:1px solid; text-align:center" colspan="2">Grupo Energía México Gemex, SA de CV</td>
    <td style="border:1px solid; text-align:center"> {{ date('m/d/Y') }}</td>
  </tr>
</table>

<table style="width:100%; margin-bottom:20px;" cellpadding="0" cellspacing="0">
  <tr>
    <td>Nombre del empleado:</td>
    <td style="border-bottom:1px solid; width:90%"></td>
  </tr>
  <tr>
    <td>Clabe Interbancaria::</td>
    <td style="border-bottom:1px solid; width:90%"></td>
  </tr>
  <tr>
    <td>Motivo:</td>
    <td style="margin-bottom:10px;border-bottom:1px solid; width:90%"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="margin-bottom:10px;border-bottom:1px solid; width:90%"></td>
  </tr>
  <tr>
    <td>Período:</td>
    <td style="margin-bottom:10px;border-bottom:1px solid; width:90%"></td>
  </tr>
  <tr>
    <td>Departamento:</td>
    <td style="margin-bottom:10px;border-bottom:1px solid; width:90%"></td>
  </tr>
  <tr>
    <td>Subdepartamento:</td>
    <td style="margin-bottom:10px;border-bottom:1px solid; width:90%"></td>
  </tr>
  <tr>
    <td>Proyecto:</td>
    <td style="margin-bottom:10px;border-bottom:1px solid; width:90%"></td>
  </tr>
</table>


<table style="width:100%" cellpadding="0" cellspacing="0">
  <thead>
      <tr>
        <th style="border:1px solid; padding:5px;">Fecha Factura</th>
        <th style="border:1px solid; padding:5px;">Factura</th>    
        <th style="border:1px solid; padding:5px;">Proveedor</th>
        <th style="border:1px solid; padding:5px;">Concepto</th>
        <th style="border:1px solid; padding:5px;"> Subtotal </th>
        <th style="border:1px solid; padding:5px;">Descuento</th>
        <th style="border:1px solid; padding:5px;">ISH u otros impuestos locales </th>
        <th style="border:1px solid; padding:5px;">IVA </th>
        <th style="border:1px solid; padding:5px;">Total </th> 
      </tr>
  </thead>
  <tbody>                                              
      @foreach($data as $value)
        <tr>
          <td style="border:1px solid; padding:5px;">{{ $value->fechaTimbrado }}</td>
          <td style="border:1px solid; padding:5px;">{{ substr($value->UUID,strlen($value->UUID) - 5, strlen($value->UUID)) }}</td>
          <td style="border:1px solid; padding:5px;">{{ $value->emisor }} </td>
          <td style="border:1px solid; padding:5px;">{{ $value->Descripcion }} </td>
          <td style="border:1px solid; padding:5px;">{{ number_format($value->Importe,2,".",",") }}</td>
          <td style="border:1px solid; padding:5px;">{{ number_format($value->Descuento,2,".",",") }}</td>
          <td style="border:1px solid; padding:5px;">{{ number_format($value->iva,2,".",",") }}</td>
          <td style="border:1px solid; padding:5px;">{{ number_format($value->ieps,2,".",",") }}</td>
          <td style="border:1px solid; padding:5px;">{{ number_format($value->total,2,".",",") }}</td> 
        </tr>
      @endforeach                      
  </tbody>
</table>