@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/proveedores/add') }}" class="btn btn-relief-info ">
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
                <div class="col-md-6">
                  <div class="mb-1">
                   <div class="form-group">
                    <label for="nombre" class="control-label"> Nombre </label>
                    <div class="input-group mb-2">
                      <span class="input-group-text" id="basic-addon1"> <i class="fa fa-bank fa-lg"></i> </span>
                      <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="label label-danger">{{ $errors->first("nombre") }}</div>
                   </div>
                  </div>
                </div>
                <!-- Nombre End -->


                <!-- Nombre Start -->
                <div class="col-md-6">
                  <div class="mb-1">
                   <div class="form-group">
                    <label for="nombre" class="control-label"> Vendedor </label>
                    <div class="input-group mb-2">
                      <span class="input-group-text" id="basic-addon1"> <i class="fa fa-user-secret fa-lg"></i> </span>
                      <input type="text" class="form-control" id="vendedor" name="vendedor">
                    </div>
                   </div>
                  </div>
                </div>
                <!-- Nombre End -->


                <!-- Telefono Start -->
                <div class="col-md-4">
                  <div class="mb-1">
                   <div class="form-group">
                    <label for="telefono" class="control-label"> Celular Empresa </label>
                    <div class="input-group mb-2">
                      <span class="input-group-text" id="basic-addon1"> <i class="fa fa-phone fa-lg"></i> </span>
                      <input type="text" class="form-control" id="telefono" name="telefono">
                    </div>
                    <div class="label label-danger">{{ $errors->first("telefono") }}</div>
                   </div>
                  </div>
                </div>
                <!-- Telefono End -->

                <!-- Celular Start -->
                <div class="col-md-4">
                  <div class="mb-1">
                   <div class="form-group">
                    <label for="celular" class="control-label"> Celular </label>
                    <div class="input-group mb-2">
                      <span class="input-group-text" id="basic-addon1"> <i class="fa fa-mobile fa-lg"></i> </span>
                      <input type="text" class="form-control" id="celular" name="celular">
                    </div>
                    <div class="label label-danger">{{ $errors->first("celular") }}</div>
                   </div>
                  </div>
                </div>
                <!-- Celular End -->


                <!-- Celular Start -->
                <div class="col-md-4">
                  <div class="mb-1">
                   <div class="form-group">
                    <label for="celular" class="control-label"> Correo </label>
                    <div class="input-group mb-2">
                      <span class="input-group-text" id="basic-addon1"> <i class="fa fa-envelope fa-lg"></i> </span>
                      <input type="text" class="form-control" id="correo" name="correo">
                    </div>
                    <div class="label label-danger">{{ $errors->first("celular") }}</div>
                   </div>
                  </div>
                </div>
                <!-- Celular End -->


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
          <h4 class="card-title">Listado de proveedores</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Empresa</th>
      						<th>Correo</th>
						      <th>Vendedor</th>
						      <th><i class="fa fa-user-secret"></i> Celuar</th>
						      <th><i class="fa fa-user-secret"></i> Correo</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td> {{{ $value->nombre }}} </td>
                    <td> {{{ $value->celular }}} </td>
                    <td> {{{ $value->vendedor }}} </td>
                    <td> {{{ $value->vededor_celular }}} </td>
                    <td> {{{ $value->vendedor_correo }}} </td>
                    <td class="text-center" style="width:10%">
						           <a href="<?php echo url("/"); ?>/admin/proveedores/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
						            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
						           </a>
						           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/proveedores/baja/<?php echo $value->id; ?>" data-title="Eliminar proveedores" style="border:0px; background:none">
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
