@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/compras/add') }}" class="btn btn-relief-info ">
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
            				<div class="col-md-8">
            					<div class="mb-1">
            					 <div class="form-group">
            						<label for="proveedor_id" class="control-label"> Proveedor </label>
            						<select class="form-control select2" id="proveedor_id" name="proveedor_id">
            							<option value="">[ SELECCIONE ]</option>
            							<?php foreach(\App\admin\Proveedores::where('status',1)->get() as $provs) { ?>
            								<option value="{{ $provs->id }}" <?php if($data->proveedor_id == $provs->id) { echo 'selected'; } ?>>{{ $provs->nombre }}</option>
            							<?php } ?>
            						</select>
            							<div class="label label-danger">{{ $errors->first("proveedor_id") }}</div>
            					 </div>
            					</div>
            				</div>
            				<!-- Proveedor_id End -->

                    <div class="col-md-4">
                      <div class="mb-1">
                        <div class="form-group">
                         <label for="cliente_id" class="control-label"> Rango de Fechas </label>
                         <div class="input-group mb-2">
                           <span class="input-group-text" style="background: #E8E8E8;">Desde</span>
                           <input type="text" class="form-control flatpickr-basic flatpickr-input" id="fecha_desde" name="fecha_desde">
                           <span class="input-group-text" style="background: #E8E8E8;">Hasta</span>
                           <input type="text" class="form-control flatpickr-basic flatpickr-input" id="fecha_hasta" name="fecha_hasta">
                         </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-12" style="text-align:right">
                      <a href="{{ url('/admin/compras') }}" class="btn btn-warning ">
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
          <h4 class="card-title">Listado de compras</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table">
              <thead>
                <tr>
      						<th>Proveedor</th>
      						<th>F. Compra</th>
      						<th>Subtotal</th>
      						<th>Total</th>
      						<th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td> {{{ $value->proveedor->nombre }}} </td>
                    <td> {{{ $value->fecha_compra }}} </td>
                    <td> $ {{{ number_format($value->subtotal,0,".",",") }}} </td>
                    <td> $ {{{ number_format($value->total,0,".",",") }}} </td>
                    <td class="text-center">
						           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/compras/baja/<?php echo $value->id; ?>" data-title="Eliminar compras" style="border:0px; background:none">
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
