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

                  <!-- Guia Start -->
                  <div class="col-md-3">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="guia" class="control-label"> Folio de Venta M.L </label>
                        <input type="text" class="form-control" id="folioml" name="folioml">
                     </div>
                    </div>
                  </div>
                  <!-- Guia End -->


                  <!-- Guia Start -->
                  <div class="col-md-5">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="guia" class="control-label"> Cliente </label>
                        <input type="text" class="form-control" id="cliente" name="cliente">
                     </div>
                    </div>
                  </div>
                  <!-- Guia End -->

                  <!-- Transportista Start -->
                  <div class="col-md-4">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="transportista" class="control-label"> Transportista </label>
                        <input type="text" class="form-control" id="transportista" name="transportista"
                        value="{{{ isset($data->transportista ) ? $data->transportista  : old('transportista') }}}">
                        <div class="label label-danger">{{ $errors->first("transportista") }}</div>
                     </div>
                    </div>
                  </div>
                  <!-- Transportista End -->

                  <!-- Guia Start -->
                  <div class="col-md-3">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="guia" class="control-label"> Nro Guia </label>
                        <input type="text" class="form-control" id="guia" name="guia"/>
                     </div>
                    </div>
                  </div>
                  <!-- Guia End -->

                  <!-- Tipo_envio Start -->
                  <div class="col-md-3">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="tipo_envio" class="control-label"> Tipo de Envio </label>
                        <input type="text" class="form-control" id="tipo_envio" name="tipo_envio">
                        <div class="label label-danger">{{ $errors->first("tipo_envio") }}</div>
                     </div>
                    </div>
                  </div>
                  <!-- Tipo_envio End -->


                  <!-- En_camino Start -->
                  <div class="col-md-3">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="en_camino" class="control-label"> F. En vio </label>
                        <input type="text" class="form-control" id="en_camino" name="en_camino">
                     </div>
                    </div>
                  </div>
                  <!-- En_camino End -->

                  <!-- Fecha_entrega Start -->
                  <div class="col-md-3">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="fecha_entrega" class="control-label"> F. de Entrega </label>
                        <input type="text" class="form-control" id="fecha_entrega" name="fecha_entrega">
                     </div>
                    </div>
                  </div>
                  <!-- Fecha_entrega End -->

                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-12" style="text-align:right">
                    <a href="{{ url('/admin/plazos') }}" class="btn btn-warning ">
                      <i class="fa fa-eraser fa-lg"></i> Limpiar</a>
                    <button type="submit" class="btn btn-success"> <i class="fa fa-search fa-lg"></i> Filtrar  </button>
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
          <h4 class="card-title">Listado de envios</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table text-left">
              <thead>
                <tr>
                  <th>Folio</th>
                  <th>Cliente</th>
                  <th>Metodo</th>
                  <th>F. Envio</th>
                  <th>F. Entrega</th>
                  <th>Transportista</th>
                  <th>Guia</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td> {{{ $value->venta->folioml }}} </td>
                    <td> {{{ $value->cliente->nombre }}} </td>
                    <td> {{{ $value->forma }}} </td>
                    <td> {{{ $value->fecha_envio }}} </td>
                    <td> {{{ $value->fecha_entrega }}} </td>
                    <td> {{{ $value->transportista }}} </td>
                    <td> {{{ $value->guia }}} </td>                    
                  </tr>
                <?php }  ?>
              </tbody>

            </table>
          </div>
        </div>
        <div class="card-footer">
          {{ $data->links('vendor.pagination.default') }}
        </div>
      </div>
    </div>
  </div>
</section>




@endsection
