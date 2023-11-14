@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/garantia/add') }}" class="btn btn-relief-info ">
                <i class="fa fa-plus fa-lg"></i> Crear Nuevo</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<section id="extended">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Listado de garantia</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table text-left">
              <thead>
                <tr>
      						<th>Folio Vta</th>
      						<th>Producto</th>
      						<th>Cantidad</th>
      						<th>Situacion</th>
      						<th>Motivo</th>
      						<th>F. Movimiento</th
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td>
                      <?php if($value->venta->folioml != "") { ?>

                        <?php if($value->venta->foliomldet != "") { ?>
                          <!-- EL DETALLE ES DE CARRITO LO PRESENTAMOS COMO MAYOR Y MASTER COMO MINIATURA-->
                          <span class="text-success">{{ $value->venta->foliomldet }}  </span><br/>
                          <small class="text-info">{{ $value->venta->folioml }} </small>
                        <?php } else { ?>
                          {{ $value->venta->folioml }}
                        <?php } ?>
                      <?php } else { ?>
                        VENTA EXTERNA
                      <?php } ?>
                    </td>
                    <td> {{{ $value->producto->sku }}} {{{ $value->producto->descripcion }}} </td>
                    <td> {{{ $value->cantidad }}} </td>
                    <td> {{{ \App\admin\Garantia::SITUACIONES[$value->situacion] }}} </td>
                    <td> {{{ $value->motivo }}} </td>
                    <td> {{{ $value->fecha_operacion }}} </td>
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
