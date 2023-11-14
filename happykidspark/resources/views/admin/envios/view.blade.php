@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/css/pages/app-invoice.css">

@section('content')


<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
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
                            <h3 class="text-primary invoice-logo">{{ \App\admin\Configuracion::getInfo()->nombre }}</h3>
                          </div>
                          <p class="card-text mb-25">{{ \App\admin\Configuracion::getInfo()->direccion }} {{ \App\admin\Configuracion::getInfo()->colonia }}</p>
                          <p class="card-text mb-25">{{ \App\admin\Configuracion::getInfo()->ciudad }} {{ \App\admin\Configuracion::getInfo()->estado }} {{ \App\admin\Configuracion::getInfo()->cp }}</p>
                          <p class="card-text mb-0">{{ \App\admin\Configuracion::getInfo()->telefono }}, {{ \App\admin\Configuracion::getInfo()->celular }}</p>
                      </div>
                      <div class="mt-md-0 mt-2">
                          <h4 class="invoice-title">
                              No Orden
                              <span class="invoice-number"># {{ $data->folioml }}</span>
                          </h4>
                          <div class="invoice-date-wrapper">
                              <p class="invoice-date-title">F. Venta:</p>
                              <p class="invoice-date">{{ $data->fecha }}</p>
                          </div>
                          <?php if($data->llegada) { ?>
                            <div class="invoice-date-wrapper">
                                <p class="invoice-date-title text-success">F. de Llegada:</p>
                                <p class="invoice-date text-success">{{ $data->llegada }}</p>
                            </div>
                          <?php } ?>
                          <div class="invoice-date-wrapper">
                              <p class="invoice-date-title">Cliente:</p>
                              <p class="invoice-date">{{ $data->cliente->nombre }}</p>
                          </div>
                      </div>
                  </div>
                  <!-- Header ends -->
              </div>

              <hr class="invoice-spacing">

              <div class="card-body invoice-padding pt-0">
                  <div class="row invoice-spacing">
                      <div class="col-xl-8 p-0">
                          <h6 class="mb-2">Datos de Facturación</h6>
                          <?php $facturacion = \App\admin\Ventas_facturacion::where('venta_id',$data->id)->first(); ?>
                          <h6 class="mb-25">{{ $facturacion->nombre != "" ? $facturacion->nombre : $data->cliente->nombre }}</h6>
                          <p class="card-text mb-25">Documento: {{ $facturacion->documento }}</p>
                          <p class="card-text mb-25">Domicilio: {{ $facturacion->domicilio }}</p>
                          <p class="card-text mb-25">T. Contribuyente: {{ $facturacion->tipoc }}</p>
                      </div>
                      <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                          <h6 class="mb-2">Datos de Envio</h6>
                          <?php $envio = \App\admin\Envios::where('venta_id',$data->id)->first(); ?>
                          <table>
                              <tbody>
                                  <tr>
                                      <td class="pe-1">Forma:</td>
                                      <td><span class="fw-bold">{{ $envio->forma}}</span></td>
                                  </tr>
                                  <tr>
                                      <td class="pe-1">F. Envio:</td>
                                      <td>{{ $envio->fecha_envio }}</td>
                                  </tr>
                                  <tr>
                                      <td class="pe-1">F. LLegada:</td>
                                      <td>{{ $envio->fecha_entrega }}</td>
                                  </tr>
                                  <tr>
                                      <td class="pe-1">Transportista:</td>
                                      <td>{{ $envio->transportista }}</td>
                                  </tr>
                                  <tr>
                                      <td class="pe-1">No Guia  :</td>
                                      <td>{{ $envio->guia }}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>

              <!-- Invoice Description starts -->
              <div class="table-responsive">
                <h3 style="margin-left:20px; margin-bottom:20px;">Confirmacion de recepcion de mercancia</h3>
                  <table class="table">
                      <thead>
                          <tr>
                              <th class="py-1">Producto</th>
                              <th class="py-1">Cantidad</th>
                              <th class="py-1">P. Venta ML</th>
                              <th class="py-1">Ingreso </th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach(\App\admin\Ventas_detalle::where('venta_id',$data->id)->get() as $value) { ?>
                          <tr>
                              <td class="py-1">{{ $value->producto->descripcion}}</td>
                              <td class="py-1" style="width:15%"> {{ $value->cantidad }}</td>
                              <td class="py-1 text-info" style="width:15%"> $ {{ number_format($value->pventa,2,".",",") }} </td>
                              <td class="py-1 text-success" style="width:15%"> $ {{ number_format($value->ingreso_ml,2,".",",") }} </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                  </table>
              </div>

              <div class="card-body invoice-padding pb-0">
                  <div class="row invoice-sales-total-wrapper">
                      <div class="col-md-4 order-md-1 order-2 mt-md-0 mt-3">
                          <p class="card-text mb-0">
                              <span class="fw-bold"></span> <span class="ms-75"></span>
                          </p>
                      </div>
                      <div class="col-md-8 d-flex justify-content-end order-md-2 order-1">
                          <div class="invoice-total-wrapper">
                              <div class="invoice-total-item">
                                  <p class="invoice-total-title">Subtotal:</p>
                                  <p class="invoice-total-amount" id="lblSubtotal">
                                    <?php if($data->subtotal_llegada != "") { ?>
                                      <span class="text-success">$ {{ number_format($data->subtotal_llegada,2,".",",") }} </span>
                                    <?php } else { ?>
                                      $ {{ number_format($data->subtotal,2,".",",") }}
                                    <?php } ?>
                                  </p>
                              </div>
                              <div class="invoice-total-item">
                                  <p class="invoice-total-title">Flete:</p>
                                  <p class="invoice-total-amount">
                                    <?php if($data->flete_llegada != "") { ?>
                                      <span class="text-success">$ {{ number_format($data->flete_llegada,2,".",",") }} </span>
                                    <?php } else { ?>
                                      $ {{ number_format($data->envio,2,".",",") }}
                                    <?php } ?>
                                  </p>
                              </div>
                              <div class="invoice-total-item">
                                  <p class="invoice-total-title">Importacion:</p>
                                  <p class="invoice-total-amount">
                                    <?php if($data->importacion_llegada != "") { ?>
                                      <span class="text-success">$ {{ number_format($data->importacion_llegada,2,".",",") }} </span>
                                    <?php } else { ?>
                                      $ {{ number_format($data->importacion,2,".",",") }}
                                    <?php } ?>
                                  </p>
                              </div>
                              <hr class="my-50">
                              <div class="invoice-total-item">
                                  <p class="invoice-total-title">IVA:</p>
                                  <p class="invoice-total-amount" id="lblIva">
                                    <?php if($data->iva_llegada != "") { ?>
                                      <span class="text-success">$ {{ number_format($data->iva_llegada,2,".",",") }} </span>
                                    <?php } else { ?>
                                      $ {{ number_format($data->iva,2,".",",") }}
                                    <?php } ?>
                                  </p>
                              </div>
                              <hr class="my-50">
                              <div class="invoice-total-item">
                                  <p class="invoice-total-title">Total:</p>
                                  <p class="invoice-total-amount" id="lblTotal">
                                    <?php if($data->total_llegada != "") { ?>
                                      <span class="text-success">$ {{ number_format($data->total_llegada,2,".",",") }} </span>
                                    <?php } else { ?>
                                      $ {{ number_format($data->total,2,".",",") }}
                                    <?php } ?>
                                  </p>
                              </div>
                          </div>
                      </div>
                  </div>
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
