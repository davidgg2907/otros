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
          <button class="btn btn-default" data-toggle="modal" title="Imprimir Listado" data-target="#modalSearch">
            <i class="fa fa-search fa-2x"></i><br/>Buscar
          </button>
      </div>

      <div class="pull-right">
        <a href="{{ url('/admin/pagos/excel' . $query) }}" class="btn btn-success" title="Exportar a Excel">
          <i class="fa fa-copy fa-2x"></i><br/>E. Excel
        </a>

        <a href="{{ url('/admin/pagos/pdf' . $query) }}" class="btn btn-danger" title="Exportar a PDF">
          <i class="fa fa-copy fa-2x"></i><br/>E. PDF
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
      <div class="panel-wrapper collapse">
          <div class="panel-body">
            <div class="row">

                <div class="col-md-6">
                 <div class="form-group">
                  <label for="fecha_apertura" class="control-label"> Paciente </label>
                    <input type="text" class="form-control" id="paciente" name="paciente">
                 </div>
                </div>

                <div class="col-md-6">
                 <div class="form-group">
                  <label for="fecha_apertura" class="control-label"> Doctor </label>
                    <input type="text" class="form-control" id="doctor" name="doctor">
                 </div>
                </div>


                <div class="col-md-6">
                 <div class="form-group">
                  <label for="fecha_apertura" class="control-label"> F. Apertura </label>
                    <input type="text" class="form-control" id="fecha_apertura" name="fecha_apertura">
                 </div>
                </div>

                <div class="col-md-6">
                 <div class="form-group">
                  <label for="fecha_apertura" class="control-label"> Fecha Pago </label>
                    <input type="text" class="form-control" id="fecha_pago" name="fecha_pago">
                 </div>
                </div>

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

              <table class="table" id="table-content">
                <thead>
                  <tr>
                    <th>Folio</th>
                    <th>Paciente</th>
                    <th>Doctor</th>
                    <th>Origen</th>
                    <th>F. Apertura</th>
                    <th>Fecha_pago</th>
						        <th>Monto</th>
						        <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
					            <td>{{{ $value->id }}}</td>
                      <td>
                        <?php if($value->paciente_id != 0) { ?>
                          {{{ $value->paciente->nombre }}}
                        <?php } else { ?>
                            <?php if($value->urgencia_id != 0) { ?>
                              <?php echo $value->urgencia->paciente; ?>
                            <?php } ?>
                        <?php } ?>

                      </td>
					            <td> {{{ $value->doctor->nombre }}} </td>
                      <td>
                        <?php if($value->consulta_id != 0) { ?>
                          Consulta {{ date('d/m/Y',strtotime($value->consulta->fecha)) }}
                        <?php } elseif($value->hospitalizacion_id != 0) { ?>
                          hospitalizacion {{ date('d/m/Y',strtotime($value->hospitalizacion->fecha_ingreso)) }}
                        <?php } elseif($value->urgencia_id != 0) { ?>
                          Serv. de Urgencia {{ date('d/m/Y',strtotime($value->urgencia->fecha)) }}
                        <?php } ?>
                      </td>
                      <td> {{{ $value->fecha_apertura }}} </td>
                      <td> {{{ $value->fecha_pago }}} </td>
                      <td> $ {{{ number_format($value->monto,2,".",",") }}} </td>
                      <td>
                        <?php if($value->status == 1) { ?>
                         <?php if(Auth::user()->permisos->editRecord == 1) { ?>
                            <button type="button" data-toggle="tooltip" onclick="aplicarPago({{ $value->id }},{{ round($value->monto,2) }});" style="border:0px; background:none">
     						             <i class="fa fa-credit-card fa-lg text-success fa-lg m-r-10"></i>
     						           </button>
                         <?php } ?>

                         <?php if(Auth::user()->permisos->editRecord == 1) { ?>
                           <a href="<?php echo url("/"); ?>/admin/pagos/edit/<?php echo $value->id; ?>" title="Editar Pago" data-toggle="tooltip">
    						            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
    						           </a>
                         <?php } ?>

                         <?php if(Auth::user()->permisos->deleteRecord == 1) { ?>
    						           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/pagos/baja/<?php echo $value->id; ?>" data-title="Cancelar Pago" style="border:0px; background:none">
    						             <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
    						           </button>
                         <?php } ?>

                        <?php }elseif($value->status == 2) { ?>
                          <?php if(Auth::user()->permisos->viewRecord == 1) { ?>
                            <button type="button" data-toggle="tooltip" onclick="imprimeVoucher({{ $value->id }});" style="border:0px; background:none">
                             <i class="fa fa-file-pdf-o fa-lg text-info m-r-10"></i>
                           </button>
                         <?php } ?>
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


<div class="modal fade" id="modalPagar" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1200px !Important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel"> Aplicar Pago </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form action="<?php echo url('/'); ?>/admin/pagos/edit" id="formValidation" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type="hidden" name="id" id="pago_id" valuel="" />
                <div class="row">


                  <div class="col-md-12" id="htmlContent">
                  </div>

                  <div class="col-md-12"><hr/></div>

                  <div class="col-md-12">

                    <div class="col-md-6">
            				 <div class="form-group">
            					<label for="rfc" class="control-label"> Costo del Servicio </label>
            						<input type="text" class="form-control" id="costo" name="costo" readonly>
            				 </div>
            				</div>

                    <div class="col-md-6">
            				 <div class="form-group">
            					<label for="rfc" class="control-label"> Total a pagar </label>
            						<input type="text" class="form-control" id="costo_total" name="costo_total">
            				 </div>
            				</div>

                  </div>

                </div>
              </form>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button  class="btn btn-success" title="Aplicar Pago" onclick="$('#formValidation').submit();">
                  <i class="fa fa-check-circle fa-lg"></i> &nbsp; Aplicar Pago
                </button>
                <button  class="btn btn-default" title="Cerrar Ventana" data-dismiss="modal" >
                  <i class="fa fa-times fa-lg"></i> Cerrar
                </button>

              </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPrint" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1200px !Important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel"> Aplicar Pago </h5>
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
  function aplicarPago(id,monto) {

    $('#pago_id').val(id);
    $('#costo').val(monto);
    $('#costo_total').val(monto);

    $.ajax({
      url: "{{ url('admin/pagos/ajax') }}/" +  id,
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
      success: function(json) {

        //$('#pacienteHtml').html(json['data'].paciente);
        //$('#medico').html(json['data'].medico);
        //$('#especialidad').html(json['data'].especialidad);

        //$('#fechaCita').html(json['data'].fecha);
        //$('#horaCita').html(json['data'].hora);

        $('#htmlContent').html(json['data'].html);

        $('#modalPagar').modal({

          backdrop: 'static',

          keyboard: false,

          focus: true

        });

      }

    });

  }

  function imprimeVoucher(id) {

    var url = "{{ url('admin/pagos/view') }}/" + id;

    $('#contentIframe').attr('src',url);

    $('#modalPrint').modal({

      backdrop: 'static',

      keyboard: true,

      focus: true

    });

  }

  <?php if(Session::has('pago_id')) { ?>
    imprimeVoucher(<?php echo Session::get('pago_id'); ?>)
  <?php } ?>
</script>
@endsection
