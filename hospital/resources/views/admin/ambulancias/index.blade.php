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
        <a href="{{ url('/admin/ambulancias/add') }}" class="btn btn-info ">
          <i class="fa fa-plus fa-2x"></i><br/>Nuevo</a>
      </div>

      <div class="pull-right">
        <a href="{{ url('/admin/ambulancias/excel?' . $query) }}" class="btn btn-success" title="Exportar a Excel">
          <i class="fa fa-copy fa-2x"></i><br/>E. Excel
        </a>
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
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
              <div class="row">
                <!-- Servicio Start -->
          			<div class="col-md-4">
          			 <div class="form-group">
          				<label for="servicio" class="control-label"> Servicio </label>
          					<input type="text" maxlength="150" class="form-control" id="servicio" name="servicio">
          			 </div>
          			</div>
          			<!-- Servicio End -->

          			<!-- Unidad Start -->
          			<div class="col-md-3">
          			 <div class="form-group">
          				<label for="unidad" class="control-label"># Unidad </label>
          					<input type="text" maxlength="50" class="form-control" id="unidad" name="unidad">
          			 </div>
          			</div>
          			<!-- Unidad End -->

          			<!-- Chofer Start -->
          			<div class="col-md-5">
          			 <div class="form-group">
          				<label for="chofer" class="control-label"> Chofer </label>
          					<input type="text" maxlength="150" class="form-control" id="chofer" name="chofer">
          			 </div>
          			</div>
          			<!-- Chofer End -->

          			<!-- Enfermera Start -->
          			<div class="col-md-4">
          			 <div class="form-group">
          				<label for="enfermera" class="control-label"> Enfermera </label>
          					<input type="text" maxlength="150" class="form-control" id="enfermera" name="enfermera">
          			 </div>
          			</div>
          			<!-- Enfermera End -->

          			<!-- Medico Start -->
          			<div class="col-md-4">
          			 <div class="form-group">
          				<label for="medico" class="control-label"> Medico </label>
          					<input type="text" maxlength="150" class="form-control" id="medico" name="medico">
          			 </div>
          			</div>
          			<!-- Medico End -->

          			<!-- Paciente Start -->
          			<div class="col-md-4">
          			 <div class="form-group">
          				<label for="paciente" class="control-label"> Paciente </label>
          					<input type="text" maxlength="150" class="form-control" id="paciente" name="paciente">
          			 </div>
          			</div>
          			<!-- Paciente End -->

                <!-- Paciente Start -->
          			<div class="col-md-6">
          			 <div class="form-group">
          				<label for="paciente" class="control-label"> Direccion Origen </label>
          					<input type="text" maxlength="150" class="form-control" id="origen" name="origen">
          			 </div>
          			</div>
          			<!-- Paciente End -->

                <!-- Paciente Start -->
          			<div class="col-md-6">
          			 <div class="form-group">
          				<label for="paciente" class="control-label"> Direccion Destino </label>
          					<input type="text" maxlength="150" class="form-control" id="destino" name="destino">
          			 </div>
          			</div>
          			<!-- Paciente End -->


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
                    <th>Fecha</th>
        						<th style="width:5%">Servicio</th>
        						<th style="width:10%">Unidad</th>
        						<th style="width:12%">Chofer</th>
        						<th style="width:12%">Medico</th>
        						<th style="width:12%">Paciente</th>
        						<th style="width:17%">Origen</th>
        						<th style="width:17%">Destino</th>
                    <th style="width:20%"></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td> {{{ $value->fecha }}} </td>
                    <td> {{{ $value->servicio }}} </td>
                    <td> {{{ $value->unidad }}} </td>
                    <td> {{{ $value->chofer }}} </td>
                    <td> {{{ $value->medico }}} </td>
                    <td> {{{ $value->paciente }}} </td>
                    <td> {{{ $value->origen }}} </td>
                    <td> {{{ $value->destino }}} </td>
                    <td>
  					           <a href="<?php echo url("/"); ?>/admin/ambulancias/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
  					            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
  					           </a>
                       <a target="_blank" href="<?php echo url("/"); ?>/admin/ambulancias/ficha/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
  					            <i class="fa fa-file-pdf-o fa-lg text-info m-r-10"></i>
  					           </a>
  					           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/ambulancias/baja/<?php echo $value->id; ?>" data-title="Eliminar ambulancias" style="border:0px; background:none">
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
