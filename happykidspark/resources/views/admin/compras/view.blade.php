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
                            <h3 class="text-primary invoice-logo">{{ \App\admin\Configuracion::getConfig()->nombre }}</h3>
                          </div>
                          <p class="card-text mb-25">{{ \App\admin\Configuracion::getConfig()->direccion }} {{ \App\admin\Configuracion::getConfig()->colonia }}</p>
                          <p class="card-text mb-25">{{ \App\admin\Configuracion::getConfig()->ciudad }} {{ \App\admin\Configuracion::getConfig()->estado }} {{ \App\admin\Configuracion::getConfig()->cp }}</p>
                          <p class="card-text mb-0">{{ \App\admin\Configuracion::getConfig()->telefono }}, {{ \App\admin\Configuracion::getConfig()->celular }}</p>
                      </div>
                      <div class="mt-md-0 mt-2">
                          <h4 class="invoice-title">
                              No Compra
                              <span class="invoice-number"># {{ $data->id }}</span>
                          </h4>
                          <div class="invoice-date-wrapper">
                              <p class="invoice-date-title">F. Venta:</p>
                              <p class="invoice-date">{{ $data->fecha_compra }}</p>
                          </div>
                          <div class="invoice-date-wrapper">
                              <p class="invoice-date-title">Proveedor:</p>
                              <p class="invoice-date">{{ $data->proveedor->nombre }}</p>
                          </div>
                      </div>
                  </div>
                  <!-- Header ends -->
              </div>

              <hr class="invoice-spacing">

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
                        <?php foreach(\App\admin\Venta_detalle::where('venta_id',$data->id)->get() as $value) { ?>

                          <?php $temporizador = \App\admin\Temporizador::where('venta_id',$data->id)->where('vtadetalle_id',$value->id)->get(); ?>

                          <tr>
                              <td class="py-1">
                                {{ $value->productos->nombre}} <br/>
                                <?php foreach($temporizador as $tempo) { ?>
                                  <span><i>
                                    {{ $tempo->nombre}}  {{ $tempo->tiempo->minutos}} Minutos
                                    De: {{ date('G:i:s',strtotime($tempo->inicia)) }}  a {{ date('G:i:s',strtotime($tempo->termina)) }}
                                  </i></span>
                                <?php } ?>
                              </td>
                              <td class="py-1" style="width:15%"> {{ $value->cantidad }}</td>
                              <td class="py-1 text-info" style="width:15%"> $ {{ number_format($value->precio,0,".",",") }} </td>
                              <td class="py-1 text-success" style="width:15%"> $ {{ number_format($value->importe,0,".",",") }} </td>
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

                              <hr class="my-50">
                              <div class="invoice-total-item">
                                  <p class="invoice-total-title">Subtotal:</p>
                                  <p class="invoice-total-amount" id="lblTotal">
                                    <span class="text-success">$ {{ number_format($data->subtotal,0,".",",") }} </span>
                                  </p>
                              </div>
                              <hr class="my-50">
                              <div class="invoice-total-item">
                                  <p class="invoice-total-title">Total:</p>
                                  <p class="invoice-total-amount" id="lblTotal">
                                    <span class="text-success">$ {{ number_format($data->total,0,".",",") }} </span>
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
