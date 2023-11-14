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
        <?php if(Auth::user()->permisos->addRecord == 1) { ?>
          <a href="{{ url('/admin/users/add') }}" class="btn btn-info ">
            <i class="fa fa-plus fa-2x"></i><br/>Nuevo</a>
        <?php } ?>

          <button class="btn btn-default" data-toggle="modal" title="Imprimir Listado" data-target="#modalSearch">
            <i class="fa fa-search fa-2x"></i><br/>Buscar
          </button>
      </div>

      <div class="clear"></div>

    </div>

  </div>
  <!-- Terminan botones de Accion -->

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
              			<th>Rol</th>
                    <th>Nombre</th>
              			<th>Correo</th>
              			<th>Estatus</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
				            <td> <li class="fa fa-lock fa-lg"></li> {{{ $value->permisos->name }}} </td>
						        <td> {{{ $value->name }}} </td>
                    <td> {{{ $value->email }}} </td>
                    <td>
                      <?php
                        if($value->status == 1) {
                          echo '<span class="text-success">ACTIVO</span>';
                        } else if($value->status == 2) {
                          echo '<span class="text-warning">SUSPENDIDO</span>';
                        } elseif($value->status == 0) {
                          echo '<span class="text-danger">BAJA</span>';
                        }
                      ?>
                    </td>
                    <td>

                     <?php if(Auth::user()->permisos->editRecord == 1) { ?>
  					           <a href="<?php echo url("/"); ?>/admin/users/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
  					            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
  					           </a>
                     <?php } ?>

                     <?php if(Auth::user()->permisos->deleteRecord == 1) { ?>
                       <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/users/baja/<?php echo $value->id; ?>" data-title="Eliminar users" style="border:0px; background:none">
    					           <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
  					           </button>
                     <?php } ?>
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
