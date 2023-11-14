@extends('layouts.app')

@section('content')

<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">{{{ $config['titulo'] }}}</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
     @include('layouts.breadcrumbs',[ 'breadcrumbs' => $config['breadcrumbs'] ])
  </div>
  <!-- /.col-lg-12 -->
</div>

<div class="row">
  <div class="col-sm-12">
      <div class="white-box">
        <div class="pull-left">

          <button type="button" data-toggle="tooltip" data-title="Generar Nota Medica" class="btn btn-info" onclick="insertaNota();">
            <li class="fa fa-commenting-o fa-2x"></li>&nbsp;<br>Nota M.
          </button>

          <a href="{{{ url('admin/pacientes/ficha/' . $data->id) }}}" target="_blank" class="btn btn-primary" title="Imprimir Ficha">
            <li class="fa fa-print fa-2x"></li>&nbsp;<br>imprimir
          </a>
        </div>
        <div class="pull-right">
          	<a href="{{{ $config['cancelar'] }}}" class="btn btn-default ">
              <li class="fa fa-times fa-2x"></li>&nbsp;<br>Cancelar
            </a>
          </div>
          <div class="clear"></div>
      </div>
    </div>
</div>

<div class="row">
  <div class="col-md-4 col-xs-12">
      <div class="white-box">
          <div class="user-bg" style="height: auto !important">
            <?php if($data->fotografia) { ?>
              <img width="100%" alt="user" src="<?php echo asset('uploads/pacientes/' . $data->fotografia)?>">
            <?php } else { ?>
              <img width="100%" alt="user" src="<?php echo asset('uploads/paciente.jpeg')?>">
            <?php } ?>
          </div>
          <div class="user-btm-box">
              <!-- .row -->
              <div class="row text-center m-t-10">
                  <div class="col-md-6 b-r"><strong>Nombre</strong>
                      <p>{{ $data->nombre }}</p>
                  </div>
                  <div class="col-md-6"><strong>Sexo</strong>
                      <p>{{ $data->sexo }}</p>
                  </div>
              </div>
              <!-- /.row -->
              <hr>
              <!-- .row -->
              <div class="row text-center m-t-10">
                  <div class="col-md-6 b-r"><strong>Telefono</strong>
                      <p>{{ $data->telefono }}</p>
                  </div>
                  <div class="col-md-6"><strong>Celular</strong>
                      <p>{{ $data->celular }}</p>
                  </div>
              </div>
              <!-- /.row -->
              <hr>
              <!-- .row -->
              <div class="row text-center m-t-10">
                  <div class="col-md-12"><strong>Domicilio</strong>
                      <p>{{ $data->domicilio }}</p>
                  </div>
              </div>
              <!-- /.row -->
          </div>
      </div>
  </div>
  <div class="col-md-8 col-xs-12">
      <div class="white-box">
        <div class="row">
            <div class="col-md-3 col-xs-6 b-r"> <strong>T. de Sangre</strong>
                <br>
                <p class="text-muted">{{ $data->tsangre }}</p>
            </div>
            <div class="col-md-3 col-xs-6 b-r"> <strong>F. Nacimiento</strong>
                <br>
                <p class="text-muted">{{ $data->nacimiento }}</p>
            </div>
            <div class="col-md-3 col-xs-6 b-r"> <strong>U. Consulta</strong>
                <br>
                <p class="text-muted">
                  <?php
                    $consulta = $data->ultimaConsulta($data->id);
                    if(count($consulta)) {
                      echo $consulta->fecha;
                    } else {
                      echo 'NINGUNA';
                    }
                  ?>
                </p>
            </div>
            <div class="col-md-3 col-xs-6"> <strong>U. Hospitalizacion</strong>
                <br>
                <p class="text-muted">
                  <?php
                    $ingreso = $data->ultimaHospitalizacion($data->id);
                    if(count($ingreso)) {
                      echo $ingreso->fecha;
                    } else {
                      echo 'NINGUNA';
                    }
                  ?>
                </p>
            </div>
          </div>
        <hr>

        <div class="row">
            <h3>Antecedentes Hereditarios</h3>
            <p>{!! $data->hereditarias != "" ? $data->hereditarias : "NINGUNA" !!}</p>
          </div>

        <div class="row"> <hr> </div>

        <div class="row">
            <h3>Antecedentes Patologicos</h3>
            <p>{!! $data->alergias != "" ? $data->alergias : "NINGUNA" !!}</p>
          </div>

        <div class="row"> <hr> </div>

        <div class="row">
            <h3>Padecimiento Actual</h3>
            <p>{!! $data->cirugias != "" ? $data->cirugias : "NINGUNA" !!}</p>
          </div>

        <div class="row"> <hr> </div>

        <div class="row">
            <h3>Exploracion Fisica</h3>
            <p>{!! $data->vicios != "" ? $data->vicios : "NINGUNA" !!}</p>
          </div>

      </div>
  </div>
</div>

<div class="modal fade" id="modalNota" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1200px !Important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel"> Notas Medica </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <form action="<?php echo url('/'); ?>/admin/notas/add" id="formValidation" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <input type="hidden" name="redirect" id="redirect" value="admin/pacientes/view/{{ $data->id }}"/>
                  <input type="hidden" name="paciente_id" id="pacienteNotaId" value="{{ $data->id }}"/>

										<!-- Medico_id Start -->
										<div class="col-md-12">
									    <div class="form-group">
									        <label for="medico_id" class="control-label"> Medico </label>
                          <select id="medico_id" name="medico_id" class="form-control">
                              <option value=""> [-SELECCIONE-] </option>
                              <?php foreach ($medicos as $value) { ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->nombre; ?></option>
                              <?php } ?>
                          </select>
									        <div class="label label-danger">{{ $errors->first("medico_id") }}</div>
									     </div>
									  </div>
									  <!-- Medico_id End -->

                    <!-- Comentarios Start -->
										<div class="col-md-12">
										 <div class="form-group">
										  <label for="comentarios" class="control-label"> Tipo de Nota </label>
                      <select id="tipo" name="tipo" class="form-control">
                        <option value=""> [-SELECCIONE-] </option>
                        <option value="1"> Analisis Laboratoriales </option>
                        <option value="2"> Estudios de Imagen </option>
                        <option value="3"> Medicamentos </option>
                      </select>
									   </div>
										</div>

										<!-- Comentarios End -->
										<!-- Comentarios Start -->
										<div class="col-md-12">
										 <div class="form-group">
										  <label for="comentarios" class="control-label"> Nota Medica </label>
                      <textarea class="form-control summernote" id="comentarios" name="comentarios">{{{ isset($data->comentarios ) ? $data->comentarios  : old('comentarios') }}}</textarea>
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
                    <i class="fa fa-save fa-lg"></i>  Guardar
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

@endsection


@section('scripts')

<script>

$(document).ready(function() {
	$('.summernote').summernote({
			height: 350, // set editor height
			minHeight: null, // set minimum height of editor
			maxHeight: null, // set maximum height of editor
			focus: false // set focus to editable area after initializing summernote
	});
	$('.inline-editor').summernote({
			airMode: true
	});
});
window.edit = function () {
		$(".click2edit").summernote()
}, window.save = function () {
		$(".click2edit").summernote('destroy');
}


function insertaNota() {

  $('#modalNota').modal({

    backdrop: 'static',

    keyboard: true,

    focus: true

  });

}
</script>
@endsection
