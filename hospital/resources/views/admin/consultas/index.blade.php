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
        <a href="{{ url('/admin/consultas/add') }}" class="btn btn-info ">
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
      							<label for="fecha" class="control-label"> F. de Consulta</label>
                    <input type="text" class="form-control dates" name="fecha" id="fecha" />
      					 </div>
      				</div>
      				<!-- Doctor_id End -->

              <!-- Doctor_id Start -->
      				<div class="col-md-8">
      					<div class="form-group">
      							<label for="razon_visita" class="control-label"> Motivo o Diagnostico</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" />
      					 </div>
      				</div>
      				<!-- Doctor_id End -->

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
                    <th>Paciente</th>
                    <th>Doctor</th>
                    <th>Motivo de Visita</th>
        						<th>Diagnostico</th>
                    <th style="width:18%"></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
  			            <td> {{{ $value->fecha }}} </td>
                    <td> {{{ $value->paciente->nombre }}} </td>
  			            <td> {{{ $value->doctor->nombre }}} </td>
                    <td> {!! $value->razon_visita !!} </td>
                    <td> {!! $value->diagnostico !!} </td>
                    <td>
                      <?php if(Auth::user()->permisos->viewRecord == 1) { ?>
                        <?php if(count($value->receta)) { ?>
                           <button onclick="imprime({{{ $value->receta->id}}},2)" type="button" data-toggle="tooltip" style="border:0px; background:none" title="Imprimir Receta Medica">
                             <i class="fa fa-file-pdf-o fa-lg text-success m-r-10"></i>
                           </button>
                        <?php } ?>
                      <?php } ?>

                      <?php if(Auth::user()->permisos->viewRecord == 1) { ?>
                        <button onclick="imprime({{{ $value->id}}},1)" type="button" data-toggle="tooltip" style="border:0px; background:none" title="Imprimir Ficha de consulta0">
                           <i class="fa fa-print fa-lg text-success m-r-10"></i>
                         </button>
                       <?php } ?>

                       <?php if(Auth::user()->permisos->deleteRecord == 1) { ?>
    					           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/consultas/baja/<?php echo $value->id; ?>" data-title="Eliminar consultas" style="border:0px; background:none">
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


<div class="modal fade" id="modalPrint" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1200px !Important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel"> Imprimir </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <iframe id="contentIframe" src="" style="width:100%; height: 400px; border:0px;"></iframe>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button  class="btn btn-default" title="Cerrar Ventana" data-dismiss="modal" >
                  <i class="fa fa-times fa-lg"></i> Cerrar
                </button>

              </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

<script>

  function imprime(id,tipo) {

    var url = "";
    if(tipo == 1) {
      url = "{{ url('admin/consultas/ficha/') }}/" + id
    } else {
      url = "{{ url('admin/recetas/print/') }}/" + id
    }


    $('#contentIframe').attr('src',url);

    $('#modalPrint').modal({

      backdrop: 'static',

      keyboard: true,

      focus: true

    });

  }

  <?php if(Session::has('receta_id')) { ?>
    imprime(<?php echo Session::get('receta_id'); ?>,2)
  <?php } ?>
</script>
@endsection
