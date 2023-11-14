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

                  <!-- Proveedor_id Start -->
                  <div class="col-md-6">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="proveedor_id" class="control-label"> Tienda </label>
                      <select class="form-control select2" id="tienda_id" name="tienda_id">
                        <option value="">[ SELECCIONE ]</option>
                        <?php foreach(\App\admin\Tiendas::where('status',1)->get() as $provs) { ?>
                          <option value="{{ $provs->id }}">{{ $provs->nombre }}</option>
                        <?php } ?>
                      </select>
                        <div class="label label-danger">{{ $errors->first("proveedor_id") }}</div>
                     </div>
                    </div>
                  </div>
                  <!-- Proveedor_id End -->

                  <!-- Proveedor_id Start -->
                  <div class="col-md-6">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="proveedor_id" class="control-label"> Cliente </label>
                      <select class="form-control select2" id="cliente_id" name="cliente_id">
                        <option value="">[ SELECCIONE ]</option>
                        <?php foreach(\App\admin\Clientes::where('status',1)->get() as $provs) { ?>
                          <option value="{{ $provs->id }}">{{ $provs->nombre }}</option>
                        <?php } ?>
                      </select>
                        <div class="label label-danger">{{ $errors->first("proveedor_id") }}</div>
                     </div>
                    </div>
                  </div>
                  <!-- Proveedor_id End -->

                  <!-- Proveedor_id Start -->
                  <div class="col-md-3">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="proveedor_id" class="control-label"> Origen </label>
                      <select class="form-control select2" id="tipo" name="tipo">
                        <option value="">[ TODOS ]</option>
                        <option value="folioml"> Mercado Libre </option>
                        <option value="folioaws"> Amazon</option>
                        <option value="nullfml">Venta Externa </option>
                      </select>
                     </div>
                    </div>
                  </div>
                  <!-- Proveedor_id End -->


                  <!-- Fecha Start -->
                  <div class="col-md-4">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="fecha" class="control-label"> Folio M.L</label>
                        <input type="text" class="form-control" id="folioml" name="folioml">
                     </div>
                    </div>
                  </div>
                  <!-- Fecha End -->

                  <!-- Fecha Start -->
                  <div class="col-md-5">
                    <div class="mb-1">
                      <div class="form-group">
                       <label for="cliente_id" class="control-label"> Rango de Fechas </label>
                       <div class="input-group mb-2">
                         <span class="input-group-text" style="background: #E8E8E8;">Desde</span>
                         <input type="text" class="form-control" id="fecha_desde" name="fecha_desde">
                         <span class="input-group-text" style="background: #E8E8E8;">Hasta</span>
                         <input type="text" class="form-control" id="fecha_hasta" name="fecha_hasta">
                       </div>
                      </div>
                    </div>
                  </div>

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
          <h4 class="card-title">Listado de ventas_facturacion</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table text-left">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Venta</th>
                  <th>F. Adjunta</th>
      						<th>Razon Social</th>
      						<th>Documento</th>
      						<th>T. Contribuyente.</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td> {{{ $value->cliente->nombre }}} </td>
                    <td> {{{ $value->venta->folioml }}} </td>
                    <td> {{{ $value->adjunta }}} </td>
                    <td> {{{ $value->nombre }}} </td>
                    <td> {{{ $value->documento }}} </td>
                    <td> {{{ $value->tipoc }}} </td>
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
