@extends('layouts.app')

@section('content')

<?php
$searchValue = isset($_GET['searchValue'])?$_GET['searchValue']:'';
$searchBy = isset($_GET['searchBy'])?$_GET['searchBy']:'';
$order_by = isset($_GET['order_by'])?$_GET['order_by']:'';
$order = isset($_GET['order'])?$_GET['order']:'';
$redirect = url('/').'/admin/documentos?'.urlencode($_SERVER["QUERY_STRING"]);
?>


<!-- Page Content -->

<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">{{{ $config['titulo'] }}}</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    @include('layouts.breadcrumbs',[ 'breadcrumbs' => $config['breadcrumbs'] ])
  </div>
</div>


<div class="row">

  <!-- Inicia botones de Accion -->
  <div class="col-sm-12">

    <div class="white-box">

      <div class="pull-left">
        <a href="{{ url('/admin/medicamentos/add') }}" class="btn btn-info ">
          <i class="fa fa-plus fa-2x"></i><br/>Nuevo</a>

      </div>


      <div class="clear"></div>

    </div>

  </div>
  <!-- Terminan botones de Accion -->

  <!-- Inicia listado de registros -->
  <div class="col-sm-12" id="frmListado">
    <form method="get" enctype="multipart/form-data">
      <div class="panel panel-default">
        <div class="panel-heading">
          Filtrar Listado
          <div class="panel-action">
            <a id="itemPanel" href="#" data-perform="panel-collapse"><i class="ti-plus"></i></a>
          </div>
        </div>
        <div class="panel-wrapper collapse">
            <div class="panel-body">
              <div class="row">
                <!-- Comercial Start -->
        				<div class="col-md-6">
        				 <div class="form-group">
        				  <label for="comercial" class="control-label"> Nombre Comercial </label>
        				    <input type="text" class="form-control" id="comercial" name="comercial"
        				    value="{{{ isset($data->comercial ) ? $data->comercial  : old('comercial') }}}">
        				    <div class="label label-danger">{{ $errors->first("comercial") }}</div>
        				 </div>
        				</div>
        				<!-- Comercial End -->

        				<!-- Generico Start -->
        				<div class="col-md-6">
        				 <div class="form-group">
        				  <label for="generico" class="control-label"> Nombre Generico </label>
        				    <input type="text" class="form-control" id="generico" name="generico"
        				    value="{{{ isset($data->generico ) ? $data->generico  : old('generico') }}}">
        				    <div class="label label-danger">{{ $errors->first("generico") }}</div>
        				 </div>
        				</div>
        				<!-- Generico End -->

        				<!-- Componentes Start -->
        				<div class="col-md-6">
        				 <div class="form-group">
        				  <label for="componentes" class="control-label"> Componentes </label>
        				    <input type="text" class="form-control" id="componentes" name="componentes"
        				    value="{{{ isset($data->componentes ) ? $data->componentes  : old('componentes') }}}">
        				    <div class="label label-danger">{{ $errors->first("componentes") }}</div>
        				 </div>
        				</div>
        				<!-- Componentes End -->

        				<!-- Farmaceutica Start -->
        				<div class="col-md-6">
        				 <div class="form-group">
        				  <label for="farmaceutica" class="control-label"> Farmaceutica </label>
        				    <input type="text" class="form-control" id="farmaceutica" name="farmaceutica"
        				    value="{{{ isset($data->farmaceutica ) ? $data->farmaceutica  : old('farmaceutica') }}}">
        				    <div class="label label-danger">{{ $errors->first("farmaceutica") }}</div>
        				 </div>
        				</div>
        				<!-- Farmaceutica End -->
              </div>
            </div>
            <div class="panel-footer">
              <div class="row text-right">
                <button class="btn btn-default waves-effect waves-light" type="submit">
                  <span class="btn-label"><i class="fa fa-search"></i></span>Buscar
                </button>
              </div>
            </div>
        </div>
      </div>
    </form>
  </div>
  <!-- Termina listado de registros -->


  <!-- Inicia listado de registros -->
  <div class="col-sm-12" id="frmListado">

    <div class="panel panel-default">
      <div class="panel-heading">Listado de Registros</div>
      <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="table-responsive">

              <table class="table display" id="table-content">
                <thead>
                  <tr>
                    <th>Nombre</th>
						        <th>Activo</th>
                    <th>Farmaceutica</th>
                    <th>Cantidad</th>
        						<th>Costo</th>
        						<th>Precio</th>
        						<th>Caducidad</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
				            <td> {{{ $value->comercial }}} <br/> <small class="text-info"> {{{ $value->generico }}} </small></td>
				            <td> {{{ $value->activo }}} </td>
				            <td> {{{ $value->farmaceutica }}} </td>
				            <td> {{{ $value->cantidad }}} </td>
				            <td> $ {{{ number_format($value->costo,2,".",",") }}} </td>
				            <td> $ {{{ number_format($value->precio,2,".",",") }}} </td>
				            <td> {{{ $value->caducidad }}} </td>
                    <td>
						           <a href="<?php echo url("/"); ?>/admin/medicamentos/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
						            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
						           </a>
						           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/medicamentos/baja/<?php echo $value->id; ?>" data-title="Eliminar medicamentos" style="border:0px; background:none">
						           <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
						           </button>

					 				  </td>
                  </tr>
                <?php }  ?>
                </tbody>
              </table>

            </div>
          </div>
          <div class="panel-footer"> {{ $data->links('vendor.pagination.default') }} </div>
      </div>
    </div>

  </div>
  <!-- Termina listado de registros -->

</div>



@endsection
