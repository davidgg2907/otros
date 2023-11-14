@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/almacenes/add') }}" class="btn btn-relief-info ">
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
                  <!-- Tienda_id Start -->
                  <div class="col-md-12">
                  	<div class="mb-1">
                  	 <div class="form-group">
                  	  <label for="tienda_id" class="control-label"> Tienda_id </label>
                  		<select class="form-control" id="tienda_id" name="tienda_id">
                  			<option value=""> [ SELECCIONE ] </option>
                  			<?php foreach(\App\admin\Tiendas::where('status',1)->get() as $stores) { ?>
                  				<option value="{{ $stores->id }}" <?php if($data->tienda_id == $stores->id) { echo 'selected'; } ?>> {{ $stores->nombre }} </option>
                  			<?php } ?>
                  		</select>
                     </div>
                  	</div>
                  </div>
                  <!-- Tienda_id End -->

                  <!-- Nombre Start -->
                  <div class="col-md-8">
                  	<div class="mb-1">
                  	 <div class="form-group">
                  	  <label for="nombre" class="control-label"> Nombre </label>
                  	    <input type="text" class="form-control" id="nombre" name="nombre">
                     </div>
                  	</div>
                  </div>
                  <!-- Nombre End -->

                  <!-- Fisico_digital Start -->
                  <div class="col-md-4">
                  	<div class="mb-1">
                  	 <div class="form-group">
                  	  <label for="fisico_digital" class="control-label"> Tipo </label>
                  		<select class="form-control" id="fisico_digital" name="fisico_digital">
                  			<option value=""> [ SELECCIONE ] </option>
                  			<option value="FISICA"> FISICA </option>
                  			<option value="VIRTUAL"> VIRTUAL </option>
                  		</select>
                     </div>
                  	</div>
                  </div>
                  <!-- Fisico_digital End -->
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
          <h4 class="card-title">Listado de almacenes</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table text-left">
              <thead>
                <tr>
                  <th>Tienda</th>
      						<th>Nombre</th>
      						<th>Tipo</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td> {{{ $value->tienda->nombre }}} </td>
                    <td> {{{ $value->nombre }}} </td>
                    <td> {{{ $value->fisico_digital }}} </td>
                    <td>
  				           <a href="<?php echo url("/"); ?>/admin/almacenes/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
  				            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
  				           </a>
  				           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/almacenes/baja/<?php echo $value->id; ?>" data-title="Eliminar almacenes" style="border:0px; background:none">
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
