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
          <a href="{{ url('/admin/urgencias/add') }}" class="btn btn-info ">
            <i class="fa fa-plus fa-2x"></i><br/>Nuevo</a>
        <?php } ?>


          <button class="btn btn-default" data-toggle="modal" title="Imprimir Listado" data-target="#modalSearch">
            <i class="fa fa-search fa-2x"></i><br/>Buscar
          </button>
      </div>

      <div class="pull-right">
        <a href="{{ url('/admin/urgencias/excel' . $query) }}" class="btn btn-success" title="Exportar a Excel">
          <i class="fa fa-copy fa-2x"></i><br/>E. Excel
        </a>

        <a href="{{ url('/admin/urgencias/pdf' . $query) }}" class="btn btn-danger" title="Exportar a PDF">
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

              <table class="table" id="table-content">
                <thead>
                  <tr>
                    <th>Fecha</th>
        						<th>Hora</th>
                    <th>Medico</th>
						        <th>Paciente</th>
        						<th>Edad</th>
        						<th>Peso</th>
        						<th>Talla</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <tr>
                      <td> {{ $value->fecha }} </td>
                      <td> {{ $value->hora }} </td>
                      <td> {{ $value->medico->nombre }} </td>
                      <td> {{ $value->paciente }} </td>
                      <td> {{ $value->edad }} Años</td>
                      <td> {{ $value->peso }} Kgs.</td>
                      <td> {{ $value->talla }} Cm.</td>
                      <td style="width:15%" class="text-center">

                        <?php if(Auth::user()->permisos->viewRecord == 1 && $value->status == 2) { ?>
                          <a href="<?php echo url("/"); ?>/admin/urgencias/view/<?php echo $value->id; ?>" title="Ver Ficha" data-toggle="tooltip">
                           <i class="fa fa-file-pdf-o fa-lg text-info m-r-10"></i>
                          </a>
                        <?php } ?>

                        <?php if(Auth::user()->permisos->addRecord == 1 && $value->status == 1) { ?>
                          <a href="<?php echo url("/"); ?>/admin/urgencias/servicios/<?php echo $value->id; ?>" title="Agregar Servicios" data-toggle="tooltip">
                           <i class="fa fa-plus-circle fa-lg text-info m-r-10"></i>
                          </a>
                        <?php } ?>

                        <?php if(Auth::user()->permisos->editRecord == 1 && $value->status == 1) { ?>

                          <a href="<?php echo url("/"); ?>/admin/urgencias/edit/<?php echo $value->id; ?>" title="Editar Ficha" data-toggle="tooltip">
                           <i class="fa fa-edit fa-lg text-info m-r-10"></i>
                          </a>
                        <?php } ?>

                        <?php if(Auth::user()->permisos->deleteRecord == 1 && $value->status == 1) { ?>
                          <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/urgencias/baja/<?php echo $value->id; ?>" data-title="Eliminar fichF" style="border:0px; background:none">
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
