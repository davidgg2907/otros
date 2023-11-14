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

                  <input type="hidden" class="form-control" id="sending" name="sending" value="1">
                  
                  <!-- Cliente_id Start -->
                  <div class="col-md-5">
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
                  <div class="col-md-7">
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
                    <a href="{{ url('/admin/reportes/movimientos') }}" class="btn btn-warning ">
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
                  <th>Producto</th>
      						<th>Entradas</th>
                  <th>Salidas</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $key => $value) { ?>
                  <tr>
                    <td>{{ $key }} {{ $value['descripcion'] }}</td>
                    <td>{{ $value['entradas'] }}</td>
        						<td>{{ $value['salidas'] }}</td>
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
