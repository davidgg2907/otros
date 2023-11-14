@extends('layouts.app')

@section('content')


<section id="extended">

  <div class="row">
      <form if="frmFilter" method="GET" action="">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Filtrar Resultados</h4>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li>
                        <a data-action="collapse" class="">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                            <polyline points="6 9 12 15 18 9"></polyline>
                          </svg>
                        </a>
                    </li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body table-responsive">
                <div class="row">

                  <!-- Cliente_id Start -->
                  <div class="col-md-4">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="cliente_id" class="control-label"> Cliente </label>
                      <select class="form-control select2" name="cliente_id" id="cliente_id">
                        <option value="">[ TODOS ]</option>
                        <?php foreach(\App\admin\Clientes::where('status',1)->get() as $value) { ?>
                          <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                        <?php } ?>
                      </select>
                     </div>
                    </div>
                  </div>
                  <!-- Cliente_id End -->

                  <!-- Cliente_id Start -->
                  <div class="col-md-4">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="cliente_id" class="control-label"> Fechas </label>
                      <div class="input-group mb-2">
                        <span class="input-group-text" style="background: #E8E8E8;">Desde</span>
                        <input type="text" class="form-control flatpickr-basic flatpickr-input" id="fecha_desde" name="fecha_desde">
                        <span class="input-group-text" style="background: #E8E8E8;">Hasta</span>
                        <input type="text" class="form-control flatpickr-basic flatpickr-input" id="fecha_hasta" name="fecha_hasta">
                      </div>
                     </div>
                    </div>
                  </div>
                  <!-- Cliente_id End -->


                  <!-- Cliente_id Start -->
                  <div class="col-md-4">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="cliente_id" class="control-label"> Producto </label>
                      <select class="form-control select2" name="producto_id" id="producto_id">
                        <option value="">[ TODOS ]</option>
                        <?php foreach(\App\admin\Productos::where('status',1)->get() as $value) { ?>
                          <option value="{{ $value->id }}">{{ $value->sku }} {{ $value->nombre }}</option>
                        <?php } ?>
                      </select>
                    </div>
                    </div>
                  </div>
                  <!-- Cliente_id End -->

                  <input type="hidden" class="form-control" id="sending" name="sending" value="1">

                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="row">
                    <div class="col-md-12" style="text-align:right">
                      <a href="{{ url('/admin/reportes/ventas') }}" class="btn btn-warning ">
                        <i class="fa fa-eraser fa-lg"></i> Limpiar</a>
                      <button type="submit" class="btn btn-success"> <i class="fa fa-chart-pie fa-lg"></i> Generar  </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Resultados</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table text-left">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Cajero</th>
                  <th>Producto</th>
      						<th>Cantidad</th>
                  <th>Precio</th>
                  <th>Importe</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $total_ingresos   = 0;
                  $total_prodpzs    = 0;
                  $total_prodtimes  = 0;
                  $total_reservas   = 0;
                ?>
                <?php foreach($data as $value) { ?>
                  <?php

                  $total_ingresos     += $value->importe;
                  if($value->reserva_id != 0) {
                    $total_reservas += $value->importe;
                  }

                  if($value->tipo == 1) {
                    $total_prodpzs    += $value->importe;
                  } else {
                    $total_prodtimes  += $value->importe;
                  }

                  ?>
                  <tr>
                    <td>{{ $value->fecha }}</td>
                    <td>{{ $value->cajero }}</td>
                    <td>{{ $value->sku }} {{ $value->nombre }}</td>
        						<td>{{ $value->cantidad }}</td>
                    <td>$ {{ number_format($value->precio,0,",",".") }}</td>
                    <td>$ {{ number_format($value->importe,0,",",".") }}</td>
                  </tr>
                <?php }  ?>
              </tbody>
              <tfoot style="border-top:1px solid;">
                <tr>
                  <td colspan="4" style="text-align:right; font-weight:bold;">Ingreso Neto</td>
                  <td colspan="2">$ {{ number_format($total_ingresos,0,",",".") }}</td>
                </tr>
                <tr>
                  <td colspan="4" style="text-align:right; font-weight:bold;">Ingreso por Productos (Pzs)</td>
                  <td colspan="2">$ {{ number_format($total_prodpzs,0,",",".") }}</td>
                </tr>
                <tr>
                  <td colspan="4" style="text-align:right; font-weight:bold;">Ingreso por Productos (Tiempo)</td>
                  <td colspan="2">$ {{ number_format($total_prodtimes,0,",",".") }}</td>
                </tr>
                <tr>
                  <td colspan="4" style="text-align:right; font-weight:bold;">Ingreso por Reservacion</td>
                  <td colspan="2">$ {{ number_format($total_reservas,0,",",".") }}</td>
                </tr>
              </tfoot>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection

@section('scripts')
<script>
  $('.select2').select2();
</script>
@endsection
