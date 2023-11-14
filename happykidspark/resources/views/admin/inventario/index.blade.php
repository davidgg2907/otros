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
                <div class="row">

                  <!-- Proveedor_id Start -->
                  <div class="col-md-12">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="proveedor_id" class="control-label"> Producto </label>
                      <select class="form-control select2" id="tienda_id" name="tienda_id">
                        <option value="">[ SELECCIONE ]</option>
                        <?php foreach(\App\admin\Productos::where('status',1)->get() as $provs) { ?>
                          <option value="{{ $provs->id }}">{{ $provs->nombre }}</option>
                        <?php } ?>
                      </select>
                        <div class="label label-danger">{{ $errors->first("proveedor_id") }}</div>
                     </div>
                    </div>
                  </div>
                  <!-- Proveedor_id End -->

                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-md-12" style="text-align:right">
                  <a href="{{ url('/admin/inventario') }}" class="btn btn-warning ">
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
          <h4 class="card-title">Listado de inventario</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Producto</th>
      						<th>Cantidad</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td> {{{ $value->producto->nombre }}} </td>
                    <td> {{{ $value->cantidad }}} </td>
                    <td class="text-center">
						           <a href="{{ url('admin/inventario/view/' . $value->producto_id) }}" title="Edit" data-toggle="tooltip">
						            <i class="fa fa-timeline fa-lg text-info m-r-10"></i>
						           </a>
          					</td>
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
