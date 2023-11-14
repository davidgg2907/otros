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
        <a href="{{ url('/admin/signos_vitales/add') }}" class="btn btn-info ">
          <i class="fa fa-plus fa-2x"></i><br/>Nuevo</a>

          <button class="btn btn-default" data-toggle="modal" title="Imprimir Listado" data-target="#modalSearch">
            <i class="fa fa-search fa-2x"></i><br/>Buscar
          </button>
      </div>

      <div class="pull-right">
        <a href="{{ url('/admin/signos_vitales/excel' . $query) }}" class="btn btn-success" title="Exportar a Excel">
          <i class="fa fa-copy fa-2x"></i><br/>E. Excel
        </a>

        <a href="{{ url('/admin/signos_vitales/pdf' . $query) }}" class="btn btn-danger" title="Exportar a PDF">
          <i class="fa fa-copy fa-2x"></i><br/>E. PDF
        </a>
      </div>

      <div class="clear"></div>

    </div>

  </div>
  <!-- Terminan botones de Accion -->

  <!-- Inicia listado de registros -->
  <div class="col-sm-12" id="frmListado">

    <div class="panel panel-default">
      <div class="panel-heading">
        Filtrar Listado
        <div class="panel-action">
          <a id="itemPanel" href="#" data-perform="panel-collapse"><i class="ti-plus"></i></a>
        </div>
      </div>
      <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="table-responsive">
              <div class="row">

              </div>
            </div>
          </div>
          <div class="panel-footer"> {{ $data->links('vendor.pagination.default') }} </div>
      </div>
    </div>

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
                    <?php $sortSym=isset($_GET["order"]) && $_GET["order"]=="asc" ? "up" : "down"; ?><th>Paciente_id</th><th>Medico_id</th><th>Enfermera_id</th><th>Cita_id</th>
						<th>Hospitalizacion_id</th>
						<th>Fecha</th>
						<th>Presion</th>
						<th>Temperatura</th>
						<th>Pulsaciones</th>
						<th>Altura</th>
						<th>Peso</th>
						<th>Comentarios</th>
						<th>Status</th>
						
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    
														            <td>
														            {{{ $value->paciente_id }}}
														            </td>
                        
														            <td>
														            {{{ $value->medico_id }}}
														            </td>
                        
														            <td>
														            {{{ $value->enfermera_id }}}
														            </td>
                        
																            <td>
																            {{{ $value->cita_id }}}
																            </td>
                
																            <td>
																            {{{ $value->hospitalizacion_id }}}
																            </td>
                
																            <td>
																            {{{ $value->fecha }}}
																            </td>
                
																            <td>
																            {{{ $value->presion }}}
																            </td>
                
																            <td>
																            {{{ $value->temperatura }}}
																            </td>
                
																            <td>
																            {{{ $value->pulsaciones }}}
																            </td>
                
																            <td>
																            {{{ $value->altura }}}
																            </td>
                
																            <td>
																            {{{ $value->peso }}}
																            </td>
                
																            <td>
																            {{{ $value->comentarios }}}
																            </td>
                
																            <td>
																            {{{ $value->status }}}
																            </td>
                 <td>
												           <a href="<?php echo url("/"); ?>/admin/signos_vitales/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
												            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
												           </a>
												           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/signos_vitales/baja/<?php echo $value->id; ?>" data-title="Eliminar signos_vitales" style="border:0px; background:none">
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
