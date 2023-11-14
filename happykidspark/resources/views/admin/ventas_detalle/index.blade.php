@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/ventas_detalle/add') }}" class="btn btn-relief-info ">
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
          <h4 class="card-title">Listado de ventas_detalle</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table text-center">
              <thead>
                <tr>
                  <?php $sortSym=isset($_GET["order"]) && $_GET["order"]=="asc" ? "up" : "down"; ?><th>Id</th>
						<th>Venta_id</th>
						<th>Almacen_id</th>
						<th>Producto_id</th>
						<th>Variante</th>
						<th>Cantidad</th>
						<th>Costo</th>
						<th>Ingreso_ml</th>
						<th>Envio_ml</th>
						<th>Comision_ml</th>
						<th>Reembolso_ml</th>
						<th>Ganancia</th>
						<th>Pventa</th>
						<th>Status</th>
						
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    
																            <td>
																            {{{ $value->id }}}
																            </td>
                
																            <td>
																            {{{ $value->venta_id }}}
																            </td>
                
																            <td>
																            {{{ $value->almacen_id }}}
																            </td>
                
																            <td>
																            {{{ $value->producto_id }}}
																            </td>
                
																            <td>
																            {{{ $value->variante }}}
																            </td>
                
																            <td>
																            {{{ $value->cantidad }}}
																            </td>
                
																            <td>
																            {{{ $value->costo }}}
																            </td>
                
																            <td>
																            {{{ $value->ingreso_ml }}}
																            </td>
                
																            <td>
																            {{{ $value->envio_ml }}}
																            </td>
                
																            <td>
																            {{{ $value->comision_ml }}}
																            </td>
                
																            <td>
																            {{{ $value->reembolso_ml }}}
																            </td>
                
																            <td>
																            {{{ $value->ganancia }}}
																            </td>
                
																            <td>
																            {{{ $value->pventa }}}
																            </td>
                
																            <td>
																            {{{ $value->status }}}
																            </td>
                 <td>
												           <a href="<?php echo url("/"); ?>/admin/ventas_detalle/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
												            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
												           </a>
												           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/ventas_detalle/baja/<?php echo $value->id; ?>" data-title="Eliminar ventas_detalle" style="border:0px; background:none">
												           <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
												           </button>

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
