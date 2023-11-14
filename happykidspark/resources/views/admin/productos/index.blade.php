@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/productos/add') }}" class="btn btn-relief-info ">
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

                <!-- Nombre Start -->
        				<div class="col-md-5">
        					<div class="mb-1">
        					 <div class="form-group">
        					  <label for="nombre" class="control-label"> Nombre </label>
        						<div class="input-group mb-2">
        							<span class="input-group-text" id="basic-addon1"> <i class="fa fa-shopping-cart"></i> </span>
        							<input type="text" class="form-control" id="nombre" name="nombre">
        						</div>
        					    <div class="label label-danger">{{ $errors->first("nombre") }}</div>
        				   </div>
        					</div>
        				</div>
        				<!-- Nombre End -->

                <!-- Categoria_id Start -->
        				<div class="col-md-4">
        					<div class="mb-1">
        					 <div class="form-group">
        					  <label for="categoria_id" class="control-label"> Categoria </label>
        						<div class="input-group mb-2">
        							<span class="input-group-text" id="basic-addon1"> <i class="fa fa-sitemap"></i> </span>
        							<select class="form-control" id="categoria_id" name="categoria_id">
        								<option value="">[ Seleccione ]</option>
        								<?php foreach(\App\admin\Categorias::where('status',1)->get() as $cats) { ?>
        									<option value="{{ $cats->id }}">{{ $cats->nombre }}</option>
        								<?php } ?>
        							</select>
        						</div>
        					  <div class="label label-danger">{{ $errors->first("categoria_id") }}</div>
        				   </div>
        					</div>
        				</div>
        				<!-- Categoria_id End -->

        				<!-- Tipo Start -->
        				<div class="col-md-3">
        					<div class="mb-1">
        					 <div class="form-group">
        					  <label for="tipo" class="control-label"> Tipo de Costo</label>
        						<div class="input-group mb-2">
        							<select class="form-control" id="categoria_id" name="categoria_id">
        								<option value="">[ Seleccione ]</option>
                        @foreach(\App\admin\Productos::TIPOS as $key => $tipo)
        									<option value="{{ $key }}">{{ $tipo }}</option>
        								@endforeach
        							</select>
        							<span class="input-group-text" id="basic-addon1"> <i class="fa fa-question-circle fa-lg"></i> </span>
        						</div>
        					    <div class="label label-danger">{{ $errors->first("tipo") }}</div>
        				   </div>
        					</div>
        				</div>
        				<!-- Tipo End -->

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
          <h4 class="card-title">Listado de productos</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table">
              <thead>
                <tr>
      						<th>Categoria</th>
      						<th>Nombre</th>
      						<th>Tipo</th>
      						<th>Precio</th>
      						<th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td> {{{ $value->categoria->nombre }}} </td>
                    <td> {{{ $value->nombre }}} </td>
                    <td> {{{ \App\admin\Productos::TIPOS[$value->tipo] }}} </td>
                    <td> $ {{{ number_format($value->precio,0,".",",") }}} </td>
                    <td class="text-center">
						           <a href="<?php echo url("/"); ?>/admin/productos/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
						            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
						           </a>
						           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/productos/baja/<?php echo $value->id; ?>" data-title="Eliminar productos" style="border:0px; background:none">
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
