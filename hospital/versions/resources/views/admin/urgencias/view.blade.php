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
          <a href="{{{ url('admin/urgencias/ficha/' . $data->id) }}}" target="_blank" class="btn btn-primary" title="Imprimir Ficha">
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
                  <div class="col-md-12 b-r"><strong>Nombre</strong>
                      <p>{{ $data->paciente }}</p>
                  </div>
              </div>
              <!-- /.row -->
              <hr>
              <!-- .row -->
              <div class="row text-center m-t-10">
                <div class="col-md-4"><strong>Edad</strong>
                    <p>{{ $data->edad }} Edad </p>
                </div>
                <div class="col-md-4 b-r"><strong>Peso</strong>
                    <p>{{ $data->peso }} Kg.</p>
                </div>
                <div class="col-md-4"><strong>Talla</strong>
                    <p>{{ $data->talla }} Mts.</p>
                </div>
              </div>
              <!-- /.row -->
          </div>
      </div>
  </div>
  <div class="col-md-8 col-xs-12">
    <div class="white-box">

      <div class="row">
          <h4>ANTECEDENTES HEREDOFAMILIARES:</h4>
          <p>por parte de sus padres, abuelos, tios, hermanos, primos maternos o paternos,
             hayan padecido alguna de las siguientes enfermedades:</p>
      </div>
      <div class="row"> <hr/> </div>
      <p>Diabetes {!! $data->heredo_diabetes !!}</p>
      <div class="row"> <hr/> </div>
      <p>Hipertension {!! $data->heredo_hipertencion !!}</p>
      <div class="row"> <hr/> </div>
      <p>Cancer {!! $data->heredo_cancer !!}</p>
      <div class="row"> <hr/> </div>
      <p>Convulsiones {!! $data->heredo_convulsiones !!}</p>
      <div class="row"> <hr/> </div>
      <p>Lupus, Artitris Reumatoide {!! $data->Heredo_lar !!}</p>
      <div class="row"> <hr/> </div>
      <p>Leucemia o Linfoma {!! $data->heredo_leulin !!}</p>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-xs-12">

      <div class="white-box">
        <div class="row">
            <h4> ANTECEDENTES PERSONALES PATOLOGICOS: </h4>
            <p>
              <small>Se refiere a que si el paciente cuenta con las siguientes
                     enfermedades YA diagnosticadas previamente, tiempo de evolución y
                     tratamiento recibido hasta la fecha, excluyendo la patología por
                     la que acude el día de hoy.</small>
            </p>
        </div>
        <div class="row"> <hr/> </div>
        <div class="row"> <hr/> </div>
        <p>Diabetes {!! $data->patolo_diabetes !!}</p>
        <div class="row"> <hr/> </div>
        <p>Hipertension {!! $data->patolo_hipertencion !!}</p>
        <div class="row"> <hr/> </div>
        <p>Cancer {!! $data->patolo_cancer !!}</p>
        <div class="row"> <hr/> </div>
        <p>Otras Patologias {!! $data->patolo_otros !!}</p>

      </div>


      <div class="white-box">
        <div class="row">
            <h4>LE HAN OPERADO DE ALGUNA CIRUGIA, FECHA APROXIMADA</h4>
        </div>
        <div class="row"> <hr/> </div>
        <p>{{ $data->operaciones }}</p>
      </div>

      <div class="white-box">
        <div class="row">
          <h4>LE HAN PASADO SANGRE, FECHA APROXIMADA</h4>
        </div>
        <div class="row"> <hr/> </div>
        <p>{{ $data->transfuciones }}</p>
      </div>

      <div class="white-box">
        <div class="row">
          <h4>SE HA ROTO UN HUESO, FECHA APROXIMADA</h4>
        </div>
        <div class="row"> <hr/> </div>
        <p>{{ $data->fracturas }}</p>
      </div>

      <div class="white-box">
        <div class="row">
          <h4>ES USTED ALERGICO A ALGUN ALIMENTO O MEDICAMENTO CONOCIDO</h4>
        </div>
        <div class="row"> <hr/> </div>
        <p>{{ $data->alergias }}</p>
      </div>

      <div class="white-box">
        <div class="row">
          <h4>MOTIVO DE CONSULTA:</h4>
          <p> paciente quien se presenta a urgencias traído por (causa principal)</p>
        </div>
        <div class="row"> <hr/> </div>
        <p>{!! $data->padecimiento !!}</p>
      </div>

      <div class="white-box">
        <div class="row">
            <h4>PADECIMIENTO ACTUAL: fecha de inicio del primer síntoma que lo trae a consulta, inicia con. . . </h4>
        </div>
        <div class="row"> <hr/> </div>
        <p>{!! $data->padecimiento !!}</p>
      </div>

  </div
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
