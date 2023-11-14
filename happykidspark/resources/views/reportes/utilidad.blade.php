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
                <div class="col-md-6">
                  <div class="mb-1">
                   <div class="form-group">
                    <label for="cliente_id" class="control-label"> Tienda </label>
                    <select class="form-control" name="tienda_id" id="tienda_id">
                      <option value="">[ TODAS ]</option>
                      <?php foreach(\App\admin\Tiendas::where('status',1)->get() as $value) { ?>
                        <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                      <?php } ?>
                    </select>
                    </div>
                  </div>
                </div>
                <!-- Cliente_id End -->


                <!-- Cliente_id Start -->
                <div class="col-md-6">
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
                <div class="col-md-12">
                  <div class="mb-1">
                   <div class="form-group">
                    <label for="cliente_id" class="control-label"> Producto </label>
                    <select class="form-control select2" name="producto_id" id="producto_id">
                      <option value="">[ TODOS ]</option>
                      <?php foreach(\App\admin\Productos::where('status',1)->get() as $value) { ?>
                        <option value="{{ $value->id }}">{{ $value->sku }} {{ $value->descripcion }}</option>
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
                  <th>Tienda</th>
                  <th>Folio ML</th>
                  <th>Producto</th>
      						<th>Cantidad</th>
                  <th>Precio Ml</th>
                  <th>Ingreso</th>
                  <th>Costo</th>
                  <th>Utilidad</th>
                  <th>% Util.</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $total_ingresos = 0;
                  $total_utilidad = 0;
                  $total_pventas = 0;
                ?>
                <?php foreach($data as $value) { ?>
                  <?php
                    $total_ingresos     += $value->ingreso_ml;
                    $total_pventas      += $value->pventa;
                    $costo_neto         = $value->costo * $value->cantidad;
                    $total_utilidad     += $value->ingreso_ml - $costo_neto;

                    if($value->costo != 0) {
                      $porc_util         = (($value->ingreso_ml - $costo_neto)/$costo_neto) * 100;
                    } else { $porc_util  = 100; }
                  ?>
                  <tr>
                    <td style="width:10%">{{ $value->tienda }}</td>
                    <td style="width:10%">{{ $value->foliomldet != "" ? $value->foliomldet : $value->folioml }}</td>
                    <td style="width:40%">{{ $value->sku }} {{ $value->descripcion }}</td>
        						<td>{{ $value->cantidad }}</td>
                    <td>$ {{ number_format(($value->punit * $value->cantidad),2,".",",") }}</td>
                    <td>$ {{ number_format($value->ingreso_ml,2,".",",") }}</td>
                    <td>$ {{ number_format($costo_neto,2,".",",") }}</td>
                    <td>$ {{ number_format($value->ingreso_ml - $costo_neto,2,".",",") }}</td>
                    <td class=" <?php if($porc_util < 30) { echo 'text-danger'; } elseif($porc_util < 50) { echo 'text-warning'; } else { echo 'text-success'; }?>">
                      {{ round((int)$porc_util,2) }} %
                    </td>

                  </tr>
                <?php }  ?>
              </tbody>
              <tfoot style="border-top:1px solid;">
                <tr>
                  <td colspan="4" style="text-align:right; font-weight:bold;">Total Venta</td>
                  <td colspan="2">$ {{ number_format($total_pventas,2,".",",") }}</td>
                </tr>
                <tr>
                  <td colspan="4" style="text-align:right; font-weight:bold;">Ingreso Bruto</td>
                  <td colspan="2">$ {{ number_format($total_ingresos,2,".",",") }}</td>
                </tr>
                <tr>
                  <td colspan="4" style="text-align:right; font-weight:bold;">Utilidad Neta</td>
                  <td colspan="2" class="text-success" style="font-weight:bold; font-size:20px">$ {{ number_format($total_utilidad,2,".",",") }}</td>
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
