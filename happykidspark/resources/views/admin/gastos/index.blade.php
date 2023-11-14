@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/gastos/add') }}" class="btn btn-relief-info ">
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

                  <!-- Fgasto Start -->
                  <div class="col-md-4">
                  	<div class="mb-1">
                  	 <div class="form-group">
                  	  <label for="fgasto" class="control-label"> Tienda </label>
                  		<select class="form-control" id="tienda_id" name="tienda_id">
                  			<option value="">[ SELECCIONE ]</option>
                  			<?php foreach(\App\admin\Tiendas::where('status',1)->get() as $provs) { ?>
                  				<option value="{{ $provs->id }}">{{ $provs->nombre }}</option>
                  			<?php } ?>
                  		</select>
                  	    <div class="label label-danger">{{ $errors->first("fgasto") }}</div>
                     </div>
                  	</div>
                  </div>


                  <div class="col-md-4">
                  	<div class="mb-1">
                  	 <div class="form-group">
                  	  <label for="fgasto" class="control-label"> Tipo de Gasto </label>
                  		<select class="form-control" id="clasificacion" name="clasificacion">
                  			<option value="">[ SELECCIONE ]</option>
                  			<option value="Publicidad ML">Publicidad ML</option>
                  			<option value="Impuestos">Impuestos</option>
                  			<option value="Nomina">Nomina</option>
                  			<option value="Intereses bancarios">Intereses bancarios</option>
                  			<option value="Otros">Otros</option>
                  		</select>
                  	    <div class="label label-danger">{{ $errors->first("fgasto") }}</div>
                     </div>
                  	</div>
                  </div>
                  <!-- Fgasto End -->

                  <!-- Fgasto Start -->
                  <div class="col-md-4">
                  	<div class="mb-1">
                  	 <div class="form-group">
                  	  <label for="fgasto" class="control-label"> Fecha del Gasto </label>
                  	    <input type="text" class="form-control flatpickr-basic flatpickr-input" required id="fgasto" name="fgasto"
                  	    value="{{{ isset($data->fgasto ) ? $data->fgasto  : old('fgasto') }}}">
                  	    <div class="label label-danger">{{ $errors->first("fgasto") }}</div>
                     </div>
                  	</div>
                  </div>
                  <!-- Fgasto End -->


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
          <h4 class="card-title">Listado de gastos</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table text-left">
              <thead>
                <tr>
                  <th>clasificacion</th>
      						<th>F. Gasto</th>
                  <th>Tienda</th>
      						<th>Concepto</th>
      						<th>Importe</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td> {{{ $value->clasificacion }}} </td>
                    <td> {{{ $value->fgasto }}} </td>
                    <td> {{{ $value->tienda->nombre }}} </td>
                    <td> {{{ $value->concepto }}} </td>
                    <td>$ {{{ number_format($value->importe,2,".",",") }}} </td>
                    <td>
						           <a href="<?php echo url("/"); ?>/admin/gastos/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
						            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
						           </a>
						           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/gastos/baja/<?php echo $value->id; ?>" data-title="Eliminar gastos" style="border:0px; background:none">
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
