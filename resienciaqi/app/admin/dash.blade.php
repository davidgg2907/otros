@extends('layouts.app')

@section('content')



<section>
  <form class="needs-validation" novalidate action="<?php echo url('/'); ?>/admin/areas/add" id="formValidation" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body table-responsive">
              <div class="row">

                <div class="col-md-12" style="text-align:right">
                  <a href="{{{ $config['cancelar'] }}}" class="btn btn-danger mb-75 waves-effect"><i class="fa-sharp fa-solid fa-rotate-left"></i></i>Atras</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">

    <div class="col-sm-4">
  		<div class="card">
        <div class="card-header">
            <h4 class="card-title">Generos</h4>
        </div>
        <div class="card-body">
          <div id="chartSex"></div>
				</div>
  		</div>
    </div>

    <div class="col-sm-4">
  		<div class="card">
        <div class="card-header">
            <h4 class="card-title">Contrato Laboral</h4>
        </div>
        <div class="card-body">
          <div id="charCttos"></div>
				</div>
  		</div>
    </div>

    <div class="col-sm-4">
  		<div class="card">
        <div class="card-header">
            <h4 class="card-title">Nivel de Estudios</h4>
        </div>
        <div class="card-body">
          <div id="chartEducacion"></div>
				</div>
  		</div>
    </div>

    <div class="col-sm-4">
  		<div class="card">
        <div class="card-header">
            <h4 class="card-title">Estado Civil</h4>
        </div>
        <div class="card-body">
          <div id="chartEdoCivil"></div>
				</div>
  		</div>
    </div>

    <div class="col-sm-4">
  		<div class="card">
        <div class="card-header">
            <h4 class="card-title">Bebedores</h4>
        </div>
        <div class="card-body">
          <div id="chartBebedores"></div>
				</div>
  		</div>
    </div>

    <div class="col-sm-4">
  		<div class="card">
        <div class="card-header">
            <h4 class="card-title">Fumadores</h4>
        </div>
        <div class="card-body">
          <div id="chartFumadores"></div>
				</div>
  		</div>
    </div>

    <div class="col-sm-4">
  		<div class="card">
        <div class="card-header">
            <h4 class="card-title">Consumo de Cigarros,Pipas,Puros</h4>
        </div>
        <div class="card-body">
          <div id="chartTiposTabaco"></div>
				</div>
  		</div>
    </div>

    <div class="col-sm-4">
  		<div class="card">
        <div class="card-header">
            <h4 class="card-title">Cambio de Habitos Alcoholismo</h4>
        </div>
        <div class="card-body">
          <div id="chartHabitosAlcolismo"></div>
				</div>
  		</div>
    </div>

  </div>


  </form>

</section>

@endsection

@section('scripts')
<?php
  $generos = \App\admin\Pacientes::countSexos(0,$data->id);
  $cttos = \App\admin\Pacientes::countCttos(0,$data->id);
  $edo_civil = \App\admin\Pacientes::countEdoCivil(0,$data->id);
  $educacion = \App\admin\Pacientes::countEducacion(0,$data->id);


    $bebedores = \App\admin\Resultados::bebedores(0,$data->id);
    $fumadores = \App\admin\Resultados::fumadores(0,$data->id);


?>
<!-- morris CSS -->
<link href="{{ asset('generator/plugins/bower_components/morrisjs/morris.css') }} " rel="stylesheet">
<!--Morris JavaScript -->
<script src="{{ asset('generator/plugins/bower_components/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('generator/plugins/bower_components/morrisjs/morris.js') }}"></script>

<script>

//GRAFICA DE GENERO
Morris.Donut({
  element: 'chartSex',
  data: [{
      label: "Masculino",
      value: {{ (int)$generos['masculino']}},

  }, {
      label: "Femenino",
      value: {{ (int)$generos['femenino']}},
  }],
  resize: true,
  colors:['#3536aa', '#DB298D']
});

//GRAFICA ESTADO CIVIL
Morris.Donut({
  element: 'chartEdoCivil',
  data: [{
      label: "Sin Pareja Estable",
      value: {{ (int)$edo_civil['solo']}},

  }, {
      label: "Con Pareja Estable",
      value: {{ (int)$edo_civil['pareja']}},
  }],
  resize: true,
  colors:['#99d683', '#13dafe', '#6164c1']
});


Morris.Donut({
  element: 'charCttos',
  data: [{
        label: "Tiempo Indefinido",
      value: {{ (int)$cttos['indefinido']}},

  }, {
      label: "Tiempo Definido o Fijo",
      value: {{ (int)$cttos['definido']}},
  }, {
      label: "A Prueba",
      value: {{ (int)$cttos['prueba']}},
  }, {
      label: "Por Horas",
      value: {{ (int)$cttos['horas']}},
  }, {
      label: "Capacitacion Inicial",
      value: {{ (int)$cttos['capacitacion']}},
  }],
  resize: true,
  colors:['#20a42f', '#2091a4', '#d07244', '#d0c796', '#b696d0']
});


Morris.Donut({
  element: 'chartEducacion',
  data: [{
        label: "Ninguno",
      value: {{ (int)$cttos['ninguno']}},

  }, {
      label: "Primaria",
      value: {{ (int)$educacion['primaria']}},
  }, {
      label: "Secundaria",
      value: {{ (int)$educacion['secundaria']}},
  }, {
      label: "Preparatoria",
      value: {{ (int)$educacion['preparatoria']}},
  }, {
      label: "Licenciatura",
      value: {{ (int)$educacion['licenciatura']}},
  }, {
      label: "Maestria",
      value: {{ (int)$educacion['maestria']}},
  }, {
      label: "Doctorado",
      value: {{ (int)$educacion['doctorado']}},
  }],
  resize: true,
  colors:['#ae0909', '#e16308', '#e1d308', '#089ae1', '#6cabe3', '#aadd6d', '#0baa1c']
});


Morris.Donut({
  element: 'chartBebedores',
  data: [{
        label: "Beben",
      value: {{ (int)$bebedores['bebedores']}},

  }, {
      label: "No Beben",
      value: {{ (int)$bebedores['nobebedores']}},
  }],
  resize: true,
  colors:['#ae0909', '#13dafe',]
});

Morris.Donut({
  element: 'chartFumadores',
  data: [{
        label: "Fumadores",
      value: {{ (int)$fumadores['fumadores']}},

  }, {
      label: "No Fumadores",
      value: {{ (int)$fumadores['nofumadores']}},
  }],
  resize: true,
  colors:['#ae0909', '#13dafe',]
});



//GRAFICA CONSUMO DE TABACO
Morris.Donut({
  element: 'chartTiposTabaco',
  data: [{
      label: "Cigarros",
      value: {{ (int)\App\admin\Resultados::promedioPreguntas($data->id,0,121) }},
  }, {
      label: "Pipa",
      value: {{ (int)\App\admin\Resultados::promedioPreguntas($data->id,0,122) }},
  }, {
      label: "Puros",
      value: {{ (int)\App\admin\Resultados::promedioPreguntas($data->id,0,123) }},
  }],
  resize: true,
  colors:['#20a42f', '#2091a4', '#d07244', '#d0c796', '#b696d0']

});



//GRAFICA CONSUMO DE TABACO
Morris.Donut({
  element: 'chartHabitosAlcolismo',
  data: [{
      label: "Menos De Lo Habitual",
      value: {{ (int)\App\admin\Resultados::promedioPreguntasRespuestas($data->id,0,127,558) }},
  }, {
      label: "Igual Que Siempre",
      value: {{ (int)\App\admin\Resultados::promedioPreguntasRespuestas($data->id,0,127,559) }},
  }, {
      label: "Más De Lo Habitual",
      value: {{ (int)\App\admin\Resultados::promedioPreguntasRespuestas($data->id,0,127,560) }},
  }],
  resize: true,
  colors:['#20a42f', '#2091a4', '#d07244', '#d0c796', '#b696d0']

});


</script>
@endsection
