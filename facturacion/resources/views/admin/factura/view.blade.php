@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/css/pages/app-invoice.css">

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">
            <div class="col-md-6" style="text-align:left">
              <a target="_blank" href="{{ url('admin/ventas/voucher/' . $data->id) }}" class="btn btn-primary mb-75 waves-effect">
                <i class="fa fa-receipt fa-lg m-r-10"></i> Imprimir Ticket
              </a>
             
              
            </div>
            <div class="col-md-6" style="text-align:right">
              <a href="{{{ $config['cancelar'] }}}" class="btn btn-danger mb-75 waves-effect"><i class="fa-sharp fa-solid fa-rotate-left"></i></i>Atras</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<section class="invoice-preview-wrapper">
  <div class="row invoice-preview">
      <!-- Invoice -->
      <div class="col-xl-12 col-md-12 col-12">
          <div class="card invoice-preview-card">
              <div class="card-body invoice-padding pb-0">
                  <!-- Header starts -->
                  <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                      <div>
                          <div class="logo-wrapper">
                            <h3 class="text-primary invoice-logo">{{ $data->receptor }}</h3>
                          </div>
                          <p class="card-text mb-25">RFC: {{ $data->receptorRfc }}<br/></p>
                          <p class="card-text mb-25">Domicilio Cp: {{ $data->domicilioReceptor }}<br/></p>
                          <p class="card-text mb-25">Regimen: {{ $data->regimenFiscalReceptor }}<br/></p>
                      </div>
                      <div class="mt-md-0 mt-2">
                          <h4 class="invoice-title">
                            {{ $data->UUID }}
                          </h4>
                          <div class="invoice-date-wrapper">
                              <p class="invoice-date-title">F. Venta:</p>
                              <p class="invoice-date">{{ $data->fechaTimbrado }}</p>
                          </div>
                          <div class="invoice-date-wrapper">
                              <p class="invoice-date-title">Emisor:</p>
                              <p class="invoice-date">{{ $data->emisor }}</p>
                          </div>
                          <div class="invoice-date-wrapper">
                              <p class="invoice-date-title">RFC:</p>
                              <p class="invoice-date">{{ $data->emisorRfc }}</p>
                          </div>
                      </div>
                  </div>
                  <!-- Header ends -->
              </div>

              <hr class="invoice-spacing">

              <!-- Invoice Description starts -->
              <div class="table-responsive">
                <h3 style="margin-left:20px; margin-bottom:20px;">Producto o Servicios Adquiridos</h3>
                  <table class="table">
                      <thead>
                          <tr>
                              <th class="py-1">ClaveProdServ</th>
                              <th class="py-1">NoIdentificacion</th>
                              <th class="py-1">ClaveUnidad</th>
                              <th class="py-1">Unidad </th>
                              <th class="py-1">Descripcion </th>
                              <th class="py-1">ValorUnitario </th>
                              <th class="py-1">Importe </th>
                              <th class="py-1">Descuento </th> 
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach(\App\admin\Factura_detalle::where('factura_id',$data->id)->get() as $value) { ?>
                          <tr>
                              <td class="py-1">{{ $value->ClaveProdServ }}</td>
                              <td class="py-1">{{ $value->NoIdentificacion }}</thtd>
                              <td class="py-1">{{ $value->ClaveUnidad }}</td>
                              <td class="py-1">{{ $value->Unidad }}</td>
                              <td class="py-1">{{ $value->Descripcion }}</td>
                              <td class="py-1">{{ $value->ValorUnitario }}</td>
                              <td class="py-1">$ {{ number_format($value->Importe,2,".",",") }}</td>
                              <td class="py-1">$ {{ number_format($value->Descuento,2,".",",") }}</td> 
                          </tr>
                        <?php } ?>
                      </tbody>
                  </table>
              </div>

              <hr class="invoice-spacing">
              
              <!-- Invoice Description starts -->
              <div class="table-responsive">
                <h3 style="margin-left:20px; margin-bottom:20px;">Impuestos</h3>
                  <table class="table">
                      <thead>
                          <tr>
                              <th class="py-1">Tipo</th>
                              <th class="py-1">Base</th>
                              <th class="py-1">Impuesto </th>
                              <th class="py-1">Tasa Cuota </th>
                              <th class="py-1">Importe </th> 
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach(\App\admin\Factura_impuestos::where('factura_id',$data->id)->get() as $value) { ?>
                          <tr>
                              <td class="py-1">{{ $value->tipo }}</td>
                              <td class="py-1">{{ $value->base }}</thtd>
                              <td class="py-1">{{ \App\admin\Factura::IMPUESTOS[$value->impuesto] }}</td>
                              <td class="py-1">$ {{ number_format($value->tasacuota,2,".",",") }}</td>
                              <td class="py-1">$ {{ number_format($value->importe,2,".",",") }}</td>                               
                          </tr>
                        <?php } ?>
                      </tbody>
                  </table>
              </div>

              <hr class="invoice-spacing">

              <!-- Invoice Description starts -->
              <div class="table-responsive">
                  <table class="table">
                      <tfoot>
                        <tr>
                          <td style="text-align:right; width:80%;"><b>Metodo Pago:</b></td>
                          <td class="text-success">{{ $data->metodoPago }}</td>
                        </tr>
                        
                        <tr>
                          <td style="text-align:right; width:80%;"><b>Subtotal:</b></td>
                          <td class="text-success">$ {{ number_format($data->subTotal,0,".",",") }}</td>
                        </tr>
                        
                        @if($data->iva)
                          <tr>
                            <td style="text-align:right; width:80%;"><b>IVA:</b></td>
                            <td class="text-warning">$ {{ number_format($data->iva,2,".",",") }}</td>
                          </tr>
                        @endif

                        @if($data->ieps)
                          <tr>
                            <td style="text-align:right; width:80%;"><b>IEPS:</b></td>
                            <td class="text-warning">$ {{ number_format($data->ieps,2,".",",") }}</td>
                          </tr>
                        @endif

                        @if($data->isr_retenido)
                        <tr>
                          <td style="text-align:right; width:80%;"><b>ISR Retenido:</b></td>
                          <td class="text-warning">$ {{ number_format($data->isr_retenido,2,".",",") }}</td>
                        </tr>
                        @endif

                        @if($data->ieps_retenido)
                          <tr>
                            <td style="text-align:right; width:80%;"><b>IEPS Retenido:</b></td>
                            <td class="text-warning">$ {{ number_format($data->ieps_retenido,2,".",",") }}</td>
                          </tr>
                        @endif

                        @if($data->iva_retenido)
                          <tr>
                            <td style="text-align:right; width:80%;"><b>IVA Retenido:</b></td>
                            <td class="text-warning">$ {{ number_format($data->iva_retenido,2,".",",") }}</td>
                          </tr>
                        @endif

                        @if($data->retencion_local)
                          <tr>
                            <td style="text-align:right; width:80%;"><b>Retenciones Locales:</b></td>
                            <td class="text-warning">$ {{ number_format($data->retencion_local,2,".",",") }}</td>
                          </tr>
                        @endif

                        @if($data->impuesto_local)
                          <tr>
                            <td style="text-align:right; width:80%;"><b>Impuestos Locales:</b></td>
                            <td class="text-warning">$ {{ number_format($data->impuesto_local,2,".",",") }}</td>
                          </tr> 
                        @endif
                        <tr>
                          <td style="text-align:right; width:80%;"><b>Total:</b></td>
                          <td class="text-success">$ {{ number_format($data->total,0,".",",") }}</td>
                        </tr>

                      </tfoot>
                  </table>
              </div>
              <!-- Invoice Description ends -->

              <hr class="invoice-spacing">

              <!-- Invoice Note starts -->
              <div class="card-body invoice-padding pt-0">
                  <div class="row">
                      <div class="col-12 text-danger">
                          <span class="fw-bold">NOTA:</span>
                          <span>Las cantidades ingresadas y confirmadas seran aplicadas como entradas de almacen y no podran ser modificadas </span>
                      </div>
                  </div>
              </div>
              <!-- Invoice Note ends -->
          </div>
      </div>
      <!-- /Invoice -->


  </div>
</section>

@endsection