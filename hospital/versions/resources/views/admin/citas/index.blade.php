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
          <button id="citar" type="button" class="btn btn-info ">
            <i class="fa fa-calendar fa-2x"></i><br/>Agendar
          </button>
        <?php }?>
      </div>

      <div class="pull-right">
        <a href="{{ url('/admin/citas/excel' . $query) }}" class="btn btn-success" title="Exportar a Excel">
          <i class="fa fa-copy fa-2x"></i><br/>E. Excel
        </a>
        <a href="{{ url('/admin/citas/pdf' . $query) }}" class="btn btn-danger" title="Exportar a PDF">
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
        <div class="panel-heading">Listado de Registros</div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
              <div class="table-responsive">
                <div id="calendar"></div>
              </div>
            </div>
            <div class="panel-footer"> {{ $data->links('vendor.pagination.default') }} </div>
        </div>
      </div>
    </form>
  </div>
  <!-- Termina listado de registros -->

</div>

<div class="modal fade" id="modalCitar" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1200px !Important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel"> Agendar Cita Medica </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <form action="<?php echo url('/'); ?>/admin/citas/add" id="formValidation" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
										<!-- Paciente_id Start -->
										<div class="col-md-12">
									    <div class="form-group">
									        <label for="paciente_nombre" class="control-label"> Paciente </label>
                          <div class="input-group">
                            <input type="text" class="form-control" name="paciente_nombre" id="paciente_nombre" value="" readonly/>
                            <input type="hidden" name="paciente_id" id="paciente_id" value=""/>
                            <span class="input-group-btn">
                              <button type="button" class="btn waves-effect waves-light btn-info" onclick="buscaPaciente();"><i class="fa fa-search"></i></button>
                            </span>
                          </div>
									        <div class="label label-danger">{{ $errors->first("paciente_id") }}</div>
									     </div>
									  </div>
									  <!-- Paciente_id End -->


										<!-- Medico_id Start -->
										<div class="col-md-12">
									    <div class="form-group">
									        <label for="medico_id" class="control-label"> Medico </label>
                          <?php if($full) { ?>

                            <div class="input-group">
                              <input type="text" class="form-control" name="medico_nombre" id="medico_nombre" value="" readonly/>
                              <input type="hidden" name="medico_id" id="medico_id" value=""/>
                              <span class="input-group-btn">
                                <button type="button" class="btn waves-effect waves-light btn-info" onclick="buscarMedicos();"><i class="fa fa-search"></i></button>
                              </span>
                            </div>

                          <?php } else { ?>

                            <?php if($multiple) { ?>

                              <select id="medico_id" name="medico_id" class="form-control">
    															<option value=""> [-SELECCIONE-] </option>
    									            <?php foreach ($medicos as $value) { ?>
                                      <?php if(in_array($value->id,$doctores)) { ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo $value->nombre; ?></option>
                                      <?php } ?>
    									            <?php } ?>
    									        </select>

                            <?php } else { ?>
                              <input type="hidden" class="form-control" name="medico_id" id="medico_id" value="{{ Auth::user()->medico_id}}" />
                              <div class="col-md-12">
                                <h4>
                                  <?php
                                    $medico = \App\admin\Medicos::find(Auth::user()->id);
                                    echo $medico->nombre . ' ' . $medico->especialidad;
                                  ?>
                                </h4>
                                <hr/>
                              </div>
                            <?php } ?>

                          <?php } ?>






									        <div class="label label-danger">{{ $errors->first("medico_id") }}</div>
									     </div>
									  </div>
									  <!-- Medico_id End -->


										<!-- Fecha Start -->
										<div class="col-md-6">
										 <div class="form-group">
										  <label for="fecha" class="control-label"> Fecha </label>
										    <input type="text" class="form-control dates" id="fecha" name="fecha"
										    value="{{{ isset($data->fecha ) ? $data->fecha  : old('fecha') }}}">
										    <div class="label label-danger">{{ $errors->first("fecha") }}</div>
									   </div>
										</div>
										<!-- Fecha End -->

										<!-- Hora Start -->
										<div class="col-md-6">
										 <div class="form-group">
										  <label for="hora" class="control-label"> Hora </label>
                      <input type="text" class="form-control timepicker" name="hora" id="hora"
                      value="{{{ isset($data->hora ) ? $data->hora  : old('hora') }}}"/>
										   <div class="label label-danger">{{ $errors->first("hora") }}</div>
									   </div>
										</div>
										<!-- Hora End -->

										<!-- Comentarios Start -->
										<div class="col-md-12">
										 <div class="form-group">
										  <label for="comentarios" class="control-label"> Comentarios </label>
                      <textarea class="form-control" id="comentarios" name="comentarios">{{{ isset($data->comentarios ) ? $data->comentarios  : old('comentarios') }}}</textarea>
                      <div class="label label-danger">{{ $errors->first("comentarios") }}</div>
									   </div>
										</div>
										<!-- Comentarios End -->

                    <input type="hidden" class="form-control" id="status" name="status" value="1">


                </form>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">

                <?php if(Auth::user()->permisos->addRecord == 1) { ?>
                  <button  class="btn btn-success" title="Agendar Cita" onclick="$('#formValidation').submit();">
                    <i class="fa fa-save fa-lg"></i>  Agendar
                  </button>
                <?php } ?>


                <button  class="btn btn-default" title="Cerrar Ventana" data-dismiss="modal" >
                  <i class="fa fa-times fa-lg"></i> Cerrar
                </button>

              </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalFicha" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel"> Informacion de la Cita </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-5" id="paciente"><h3 class="text-center"></h3></div>
                <div class="col-md-2"> <li class="fa fa-arrow-right fa-2x"></li> </div>
                <div class="col-md-5" id="medico"><h4></h4></div>

                <div class="col-md-12"><hr/></div>



                <div class="col-md-4 text-center"><h4 id="especialidad"></h4></div>
                <div class="col-md-4 text-center"><h4 id="fechaCita"></h4></div>
                <div class="col-md-4 text-center"><h4 id="horaCita"></h4></div>

                <div class="col-md-12"><hr/></div>


                <div class="col-md-12" id="comentario"></div>

              </div>
            </div>
            <div class="modal-footer">
              <div class="row">

                <?php if(Auth::user()->permisos->addRecord == 1) { ?>
                  <a href="#" id="consultaUrl"  class="btn btn-success" title="Iniciar consulta" type="button">
                    <i class="fa fa-stethoscope fa-lg"></i>  Consulta
                  </a>
                <?php } ?>

                <?php if(Auth::user()->permisos->deleteRecord == 1) { ?>
                  <button  class="btn btn-danger delete" id="btnDelete"  data-toggle="tooltip" data-url="" data-title="Cancelar Cita">
                    <i class="fa fa-times-circle fa-lg"></i>  Cancelar
                  </button>
                <?php } ?>

                <button  class="btn btn-default" title="Cerrar Ventana" data-dismiss="modal" >
                  <i class="fa fa-times fa-lg"></i> Cerrar
                </button>

              </div>
            </div>
        </div>
    </div>
</div>

@include('admin.buscadores.medicos')

@include('admin.buscadores.pacientes')

@endsection


@section('scripts')

<script>

  $('#citar').on('click',function(){

    $('#modalCitar').modal({

      backdrop: 'static',

      keyboard: true,

      focus: true

    });

  });

  $('#calendar').fullCalendar({
    lang: 'es',
    events: 'appointment/getAppointmentByJason',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    buttonText: {
      today:    'Hoy',
      month:    'Mes',
      week:     'Semanas',
      day:      'Dia',
      list:     'Listado'
    },
    //Eventos
    eventClick: function(eventObj) {
      $.ajax({
    		url: "{{ url('admin/citas/ajax') }}/" +  eventObj.id,
    		dataType: 'json',
    		contentType: "application/json; charset=utf-8",
    		success: function(json) {

          $('#paciente').html(json['data'].paciente);
          $('#medico').html(json['data'].medico);
          $('#especialidad').html(json['data'].especialidad);

          $('#fechaCita').html(json['data'].fecha);
          $('#horaCita').html(json['data'].hora);

          $('#comentario').html(json['data'].comentario);

          $('#consultaUrl').attr('href',"{{ url('admin/consultas/add?cita_id=')}}" + eventObj.id);

          $('#btnDelete').attr('data-url','<?php echo url("/"); ?>/admin/citas/baja/' + eventObj.id)
          $('#modalFicha').modal({

            backdrop: 'static',

            keyboard: true,

            focus: true

          });

    		}

    	});
    },
    defaultDate: '<?PHP echo date('Y-m-d')?>',
        navLinks: false, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        slotDuration: '00:5:00',
        businessHours: false,
        slotEventOverlap: false,
        selectable: false,
        lazyFetching: true,
        minTime: "6:00:00",
        maxTime: "24:00:00",

        events: [
          <?php
            foreach($data as $value) {
              echo "{ id: '" . $value->id . "',
                      title: '" . $value->paciente->nombre . "',
                      start: '" . date('Y-m-d',strtotime($value->fecha)). "T" . date('H:i:s',strtotime($value->hora)) . "',
                      color  : '#03a9f3'},";
            }
          ?>
        ]
  });

  @include('admin.buscadores.medscript')

  @include('admin.buscadores.pacscript')
</script>

@endsection
