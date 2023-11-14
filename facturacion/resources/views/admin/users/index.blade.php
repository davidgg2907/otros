@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/users/add') }}" class="btn btn-relief-info ">
                <i class="fa fa-plus fa-lg"></i> Nuevo Usuarios</a>
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
          <form method="get">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Filtrar Resultados</h4>
              </div>
              <div class="card-content">
                <div class="card-body table-responsive">
                  <div class="row">

                    <!-- Name Start -->
      							<div class="col-md-6">
                      <div class="mb-1">
        							 <div class="form-group">
        								<label for="name" class="control-label"> Nombre Completo </label>
        									<input type="text" class="form-control" id="name" name="name">
        									<div class="invalid-tooltip">Corrija la siguiente informacion para continuar</div>
        							 </div>
                      </div>
      							</div>
      							<!-- Name End -->
                    
      							<!-- Email Start -->
      							<div class="col-md-6">
                      <div class="mb-1">
        							 <div class="form-group">
        								<label for="email" class="control-label"> Email </label>
        									<input type="text" class="form-control" id="email" name="email">
        									<div class="invalid-tooltip">Corrija la siguiente informacion para continuar</div>
        							 </div>
                     </div>
                    </div>
      							<!-- Email End -->

                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-12 text-right" style="text-align:right">
                    <a href="{{ url('/admin/users') }}" class="btn btn-warning ">
                      <i class="fa fa-eraser fa-lg"></i> Limpiar</a>
                    <button type="submit" class="btn btn-success"> <i class="fa fa-search fa-lg"></i> Filtrar </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Listado de users</h4>
        </div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
      						<th class="text-left">Nombre</th>
      						<th class="text-left">E-mail</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td class="text-left"> {{{ $value->name }}} </td>
                    <td class="text-left"> {{{ $value->email }}} </td>
                    <td>
  				           <a href="<?php echo url("/"); ?>/admin/users/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
  				            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
  				           </a>
  				           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/users/baja/<?php echo $value->id; ?>" data-title="Eliminar users" style="border:0px; background:none">
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
