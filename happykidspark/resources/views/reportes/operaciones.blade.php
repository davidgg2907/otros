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
                  <div class="col-md-4">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="cliente_id" class="control-label"> Tipo Venta </label>
                      <select class="form-control" name="tipovta" id="tipovta">
                        <option value="">[ TODAS ]</option>
                        <option value="ML">MERCADO LIBRE</option>
                        <option value="AMZ">AMAZON</option>
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

                  <input type="hidden" class="form-control" id="sending" name="sending" value="1">

                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-12" style="text-align:right">
                    <a href="{{ url('/admin/reportes/operaciones') }}" class="btn btn-warning ">
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
            <p>Total Vendido: $ {{ number_format($gran_total,2,".",",") }}</p>
            <table class="table text-left table-bordered">
              <thead>
                <tr>
                  <th class="text-center" rowspan="2">Concepto</th>
                  <?php foreach($data_tiendas as $tiendas) { ?>
                    <th class="text-center" colspan="3"> <b> {{ $tiendas['nombre'] }} </b>
                    </th>
                  <?php } ?>
                </tr>
                <tr>
                  <?php foreach($data_tiendas as $tiendas) { ?>
                    <th class="text-center"> <br/>Importe</th>
                    <th class="text-center">{{ round(($tiendas['total'] / $gran_total) *100,2)  }} % <br/>Venta</th>
                    <th class="text-center">{{ round(($tiendas['utilidad'] / $gran_utilidad) * 100,2)  }} % <br/>Inversion</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                  <?php foreach($data as $key => $value) { ?>

                    <?php if(in_array($key,array('Utilidad_bruta','Utilidad_Neta'))) { ?>
                      <tr class="table-info">
                    <?php } else { ?>
                      <?php if(in_array($key,array('Gastos_totales'))) { ?>
                        <tr class="table-danger">
                      <?php } else { ?>
                        <tr>
                      <?php } ?>
                    <?php } ?>
                      <td> <b>{{ str_replace('_',' ',$key) }}</b> </td>
                      <?php foreach($data_tiendas as $tiendas) { ?>
                        <?php if(in_array($key,array('Unidades_vendidas'))) { ?>
                          <td>{{ $data[$key][$tiendas['id']]['total'] }}</td>
                        <?php } else { ?>
                          <td>$ {{ number_format($data[$key][$tiendas['id']]['total'],2,".",",") }}</td>
                        <?php } ?>
                        <td>{{ $data[$key][$tiendas['id']]['venta'] }}</td>
                        <td>{{ $data[$key][$tiendas['id']]['inversion'] }}</td>
                      <?php } ?>
                    </tr>

                <?php }  ?>
              </tbody>
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
