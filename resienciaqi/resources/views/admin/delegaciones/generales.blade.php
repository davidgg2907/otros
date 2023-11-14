@extends('layouts.app')

@section('content')

<section id="basic-tabs-components">
  
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

  <hr/>
  <h2>QUEMARSE EN EL TRABAJO</h2>
  <hr/>
                
  @foreach(\App\admin\Grupos::where('status',1)->where('escala',1)->get() as $grupos)

    <div class="row match-height">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title">{{ str_replace('_',' ', $grupos->nombre) }}</h4>
          </div>
          <div class="card-body table-responsive">
          
            <div class="row">
                 <div class="col-md-9">
                  <h5>DETALLE</h5>
                  <div id="grfDetalle_{{ strtolower($grupos->nombre) }}"></div>
                </div>
                <div class="col-md-3">
                <h5>PREVALENCIA</h5>
                  <div id="grfPrevalencia_{{ strtolower($grupos->nombre) }}"></div>
                </div> 
            </div>
            <div class="row">
              <div class="col-md-9"></div>
              <div class="col-md-3" style="text-align: right">
                <a javaScript="void(0)" onclick="verValores('{{ strtolower($grupos->nombre) }}')" class="btn btn-default" id="btnTableView_{{ strtolower($grupos->nombre) }}"> 
                  <i class="fa fa-eye fa-lg"></i> Ver tabla de resultados
                </a>
              </div>
              <div class="col-md-12" style="margin-top:20px; display:none" id="TableView_{{ strtolower($grupos->nombre) }}">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Participante</th>
                      <th>Resultado</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($resultados['tables'][$grupos->nombre] as $values )
                    <tr>
                      <td><a target="_blank" href="{{ url('admin/resultados/view/' . $values['resultado_id']) }}"> {{ $values['participante'] }} - {{ $values['paciente'] }} </a></td>
                      <td>{{ round($values['promedio'],2) }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>              
            </div>
          </div>                    
        </div>
      </div>
    </div>

  @endforeach

  <hr/>
  <h2>RIESGOS PSICOSOCIALES</h2>
  <hr/>
  @foreach(\App\admin\Grupos::where('status',1)->where('escala',2)->get() as $grupos)

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">{{ str_replace('_',' ', $grupos->nombre) }}</h4>
          </div>
          <div class="card-body table-responsive">
            <div class="row">
                 <div class="col-md-9">
                  <h5>DETALLE</h5>
                  <div id="grfDetalle_{{ strtolower($grupos->nombre) }}"></div>
                </div>
                <div class="col-md-3">
                <h5>PREVALENCIA</h5>
                  <div id="grfPrevalencia_{{ strtolower($grupos->nombre) }}"></div>
                </div> 
            </div>
            <div class="row">
              <div class="col-md-9"></div>
              <div class="col-md-3" style="text-align: right">
                <a javaScript="void(0)" onclick="verValores('{{ strtolower($grupos->nombre) }}')" class="btn btn-default" id="btnTableView_{{ strtolower($grupos->nombre) }}"> 
                  <i class="fa fa-eye fa-lg"></i> Ver tabla de resultados
                </a>
              </div>
              <div class="col-md-12" style="margin-top:20px; display:none" id="TableView_{{ strtolower($grupos->nombre) }}">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Participante</th>
                      <th>Resultado</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($resultados['tables'][$grupos->nombre] as $values )
                    <tr>
                      <td><a target="_blank" href="{{ url('admin/resultados/view/' . $values['resultado_id']) }}"> {{ $values['participante'] }} - {{ $values['paciente'] }} </a></td>
                      <td>{{ round($values['promedio'],2) }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>              
            </div>
          </div>

          
        </div>
      </div>
    </div>

  @endforeach

  <hr/>
  <h2>CONSECUENCIAS PSICOSOCIALES</h2>
  <hr/>
  @foreach(\App\admin\Grupos::where('status',1)->where('escala',3)->get() as $grupos)

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">{{ str_replace('_',' ', $grupos->nombre) }}</h4>
          </div>
          <div class="card-body table-responsive">
            <div class="row">
                 <div class="col-md-9">
                  <h5>DETALLE</h5>
                  <div id="grfDetalle_{{ strtolower($grupos->nombre) }}"></div>
                </div>
                <div class="col-md-3">
                <h5>PREVALENCIA</h5>
                  <div id="grfPrevalencia_{{ strtolower($grupos->nombre) }}"></div>
                </div> 
            </div>
            <div class="row">
              <div class="col-md-9"></div>
              <div class="col-md-3" style="text-align: right">
                <a javaScript="void(0)" onclick="verValores('{{ strtolower($grupos->nombre) }}')" class="btn btn-default" id="btnTableView_{{ strtolower($grupos->nombre) }}"> 
                  <i class="fa fa-eye fa-lg"></i> Ver tabla de resultados
                </a>
              </div>
              <div class="col-md-12" style="margin-top:20px; display:none" id="TableView_{{ strtolower($grupos->nombre) }}">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Participante</th>
                      <th>Resultado</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($resultados['tables'][$grupos->nombre] as $values )
                    <tr>
                      <td><a target="_blank" href="{{ url('admin/resultados/view/' . $values['resultado_id']) }}"> {{ $values['participante'] }} - {{ $values['paciente'] }} </a></td>
                      <td>{{ round($values['promedio'],2) }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>              
            </div>
          </div>                    
        </div>
      </div>
    </div>

  @endforeach

  <hr/>
  <h2>CONCEPTOS GENERALES</h2>
  <hr/>
  <div class="row">
    <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title">Generos</h4>
          </div>
          <div class="card-body">
            <div id="chartSex"></div>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title">Contrato Laboral</h4>
          </div>
          <div class="card-body">
            <div id="charCttos"></div>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title">Nivel de Estudios</h4>
          </div>
          <div class="card-body">
            <div id="chartEducacion"></div>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title">Estado Civil</h4>
          </div>
          <div class="card-body">
            <div id="chartEdoCivil"></div>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title">Bebedores</h4>
          </div>
          <div class="card-body">
            <div id="chartBebedores"></div>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title">Fumadores</h4>
          </div>
          <div class="card-body">
            <div id="chartFumadores"></div>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title">Consumo de Cigarros,Pipas,Puros</h4>
          </div>
          <div class="card-body">
            <div id="chartTiposTabaco"></div>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
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
  </div>

</section>

@endsection

@section('scripts')
<?php
  $generos = \App\admin\Pacientes::countSexos($data->id,0);
  $cttos = \App\admin\Pacientes::countCttos($data->id,0);
  $edo_civil = \App\admin\Pacientes::countEdoCivil($data->id,0);
  $educacion = \App\admin\Pacientes::countEducacion($data->id,0);


    $bebedores = \App\admin\Resultados::bebedores($data->id,0);
    $fumadores = \App\admin\Resultados::fumadores($data->id,0);


?>
<!-- morris CSS -->
<link href="{{ asset('generator/plugins/bower_components/morrisjs/morris.css') }} " rel="stylesheet">
<!--Morris JavaScript -->
<script src="{{ asset('generator/plugins/bower_components/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('generator/plugins/bower_components/morrisjs/morris.js') }}"></script>


<script>

  function verValores(elemento) {

    var evento = "ocultaValores('" + elemento +"')";
    $('#btnTableView_' + elemento).attr('onclick',evento);
    $('#btnTableView_' + elemento).html('<i class="fa fa-times fa-lg"></i> Ocultar tabla de resultados');    
    $('#TableView_' + elemento).fadeIn();
  }

  function ocultaValores(elemento) {
     
    var evento = "verValores('" + elemento +"')";
    $('#btnTableView_' + elemento).attr('onclick',evento);
    $('#btnTableView_' + elemento).html('<i class="fa fa-eye fa-lg"></i> Ver tabla de resultados');
    $('#TableView_' + elemento).fadeOut();

  }

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

  @foreach($resultados['quemarse'] as $keys => $rst)

    Morris.Donut({
      element: 'grfPrevalencia_{{ strtolower($keys) }}',
      data: [{
              label: "{{ $rst['altolabel'] }}"    ,
            value: {{ $rst['alto'] }},

        }, {
            label: "{{ $rst['bajolabel'] }}",
            value: {{ $rst['bajo'] }},
        }],
        resize: true,        
        colors:["{{ $rst['altobg'] }}" ,"{{ $rst['bajobg'] }}"],
        formatter: function (value) { return (value) + '%'; }

    });

    Morris.Bar({
      element: 'grfDetalle_{{ strtolower($keys) }}',      
      data: [
        @foreach($rst['detalle'] as $detalle)
          { y: "{{ $detalle['participante'] }}", a: {{ round($detalle['promedio'],2) }} },
        @endforeach
      ],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Series A'],    
      xLabelAngle: 35,
      padding: 50,
      ymax: 4, // set this value according to your liking
      barRatio: 0.4,

      @if($keys == 'ILUSION_POR_EL_TRABAJO')

        barColors: function(row, series, type) {
        if(series.key == 'a')
        {
          if(row.y >= 2) {
            return "green"
          } else {
            return "red"
          }          
        }
        else
        {
          return "#9bc1c5";
        }
        
      @else 
      
        barColors: function(row, series, type) {
        if(series.key == 'a')
        {
          if(row.y < 2) {
            return "green"
          } else {
            return "red"
          }              
        }
        else
        {
          return "#9bc1c5";
        }
      @endif
      
    },
      resize: true      
    });     

  @endforeach

  @foreach($resultados['riesgos'] as $keys => $rst)

    Morris.Donut({
      element: 'grfPrevalencia_{{ strtolower($keys) }}',
      data: [{
            label: "{{ $rst['altolabel'] }}",
          value: {{ $rst['alto'] }},

      }, {
          label: "{{ $rst['mediolabel'] }}",
          value: {{ $rst['medio'] }},
      }, {
          label: "{{ $rst['bajolabel'] }}",
          value: {{ $rst['bajo'] }},
      }],
      resize: true,
      colors:["{{ $rst['altobg'] }}","{{ $rst['mediobg'] }}", "{{ $rst['bajobg'] }}"],
      formatter: function (value) { return (value) + '%'; }
    });
  
    Morris.Bar({
      element: 'grfDetalle_{{ strtolower($keys) }}',      
      data: [
        @foreach($rst['detalle'] as $detalle)
          { y: "{{ $detalle['participante'] }}", a: {{ round($detalle['promedio'],2) }} },
        @endforeach
      ],
      xkey: 'y',
      ymax: 4, // set this value according to your liking
      ykeys: ['a'],
      labels: ['Series A'],    
      xLabelAngle: 35,
      padding: 50,
      barRatio: 0.4,
      barColors: function(row, series, type) {
      @if(in_array($keys,array('AUTONOMIA','APOYO_SOCIAL','FEEDBACK','RECURSOS')))

        
        if(series.key == 'a')
        {
          if(row.y >= 2) {
            return "green"
          } else if(row.y >= 1.6 && row.y < 1.9) {
            return "yellow"
          } else {
            return "red"
          }          
        }
        else
        {
          return "#9bc1c5";
        }
        
      @else 
      
        if(series.key == 'a')
        {
          if(row.y >= 2) {
            return "red"
          } else if(row.y >= 1.6 && row.y <= 1.9) {
            return "yellow"
          } else {
            return "green"
          }          
        }
        else
        {
          return "#9bc1c5";
        }
      @endif
      
    },
      resize: true      
    });     
  @endforeach  


  @foreach($resultados['consecuencias'] as $keys => $rst)

    Morris.Donut({
      element: 'grfPrevalencia_{{ strtolower($keys) }}',
      data: [{
            label: "{{ $rst['altolabel'] }}",
          value: {{ $rst['alto'] }},

      }, {
          label: "{{ $rst['mediolabel'] }}",
          value: {{ $rst['medio'] }},
      }, {
          label: "{{ $rst['bajolabel'] }}",
          value: {{ $rst['bajo'] }},
      }],
      resize: true,
      colors:["{{ $rst['altobg'] }}","{{ $rst['mediobg'] }}", "{{ $rst['bajobg'] }}"],
      formatter: function (value) { return (value) + '%'; }
    });

    Morris.Bar({
      element: 'grfDetalle_{{ strtolower($keys) }}',      
      data: [
        @foreach($rst['detalle'] as $detalle)
          { y: "{{ $detalle['participante'] }}", a: {{ round($detalle['promedio'],2) }} },
        @endforeach
      ],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Series A'],    
      xLabelAngle: 35,
      padding: 50,
      barRatio: 0.4,
      ymax: 4, // set this value according to your liking
      barColors: function(row, series, type) {
        @if(in_array($keys,array('SATISFACCION_LABORAL','ABSENTISMO')))

        if(series.key == 'a')
        {
          if(row.y >= 2) {
            return "green"
          } else if(row.y >= 1.6 && row.y < 1.9) {
            return "yellow"
          } else {
            return "red"
          }          
        }
        else
        {
          return "#9bc1c5";
        }
        
      @else 
      
        if(series.key == 'a')
        {
          if(row.y >= 2) {
            return "red"
          } else if(row.y >= 1.6 && row.y <= 1.9) {
            return "yellow"
          } else {
            return "green"
          }          
        }
        else
        {
          return "#9bc1c5";
        }
      @endif
      },
      resize: true      
    });     
  @endforeach  

  

</script>
@endsection
