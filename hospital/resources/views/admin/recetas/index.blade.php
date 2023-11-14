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
          <a href="{{ url('/admin/recetas/add') }}" class="btn btn-info ">
            <i class="fa fa-plus fa-2x"></i><br/>Nuevo</a>
        <?php } ?>

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
              <!-- Paciente_id Start -->
              <div class="col-md-6">
               <div class="form-group">
                <label for="fecha_apertura" class="control-label"> Paciente </label>
                  <input type="text" class="form-control" id="paciente" name="paciente">
               </div>
              </div>
      				<!-- Paciente_id End -->

      				<!-- Doctor_id Start -->
              <div class="col-md-6">
               <div class="form-group">
                <label for="fecha_apertura" class="control-label"> Doctor </label>
                  <input type="text" class="form-control" id="doctor" name="doctor">
               </div>
              </div>
      				<!-- Doctor_id End -->

              <!-- Doctor_id Start -->
      				<div class="col-md-4">
      					<div class="form-group">
      							<label for="fecha" class="control-label"> F. de Ingreso</label>
                    <input type="text" class="form-control dates" name="fecha" id="fecha" />
      					 </div>
      				</div>
      				<!-- Doctor_id End -->

              <!-- Doctor_id Start -->
      				<div class="col-md-4">
      					<div class="form-group">
      							<label for="razon_visita" class="control-label"> Folio </label>
                    <input type="text" class="form-control" name="id" id="id" />
      					 </div>
      				</div>
      				<!-- Doctor_id End -->


              <!-- Medicamentos Start -->
              <div class="col-md-4">
                <div class="form-group">
                    <label for="fecha" class="control-label"> Medicamento</label>
                    <input type="text" class="form-control" name="medicamentos" id="medicamentos" />
                 </div>
              </div>
              <!-- Medicamentos End -->

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
                    <th>Paciente</th>
                    <th>Doctor</th>
                    <th>F. de Emision</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
  			            <td> {{{ $value->paciente->nombre }}} </td>
  			            <td> {{{ $value->doctor->nombre }}} </td>
  					        <td> {{{ $value->fecha }}} </td>
                    <td>
                      <?php if(Auth::user()->permisos->editRecord == 1) { ?>
  					           <a href="<?php echo url("/"); ?>/admin/recetas/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
  					            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
  					           </a>
                       <?php } ?>

                       <?php if(Auth::user()->permisos->viewRecord == 1) { ?>
                       <a target="_blank" href="<?php echo url("/"); ?>/admin/recetas/print/<?php echo $value->id; ?>" title="Imprimir Receta" data-toggle="tooltip">
  					            <i class="fa fa-print fa-lg text-success m-r-10"></i>
  					           </a>
                       <?php } ?>

                       <?php if(Auth::user()->permisos->deleteRecord == 1) { ?>
                         <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/recetas/baja/<?php echo $value->id; ?>" data-title="Eliminar recetas" style="border:0px; background:none">
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
