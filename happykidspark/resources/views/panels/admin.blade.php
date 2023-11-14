@extends('layouts.app')

@section('content')

<?php
  $meses = array(

    '1'  => 'Enero',
    '2'  => 'Febrero',
    '3'  => 'Marzo',
    '4'  => 'Abril',
    '5'  => 'Mayo',
    '6'  => 'Junio',
    '7'  => 'Julio',
    '8'  => 'Agosto',
    '9'  => 'Septiembre',
    '10' => 'Octubre',
    '11' => 'Noviembre',
    '12' => 'Diciembre',
  );

  $comprado   = array();
  $vendido    = array();
  $cancelado  = array();

  $grafica = array();
  foreach($meses as $mes => $value) {
    if((int)date('m') >= $mes) {
      $imp_vendido    = \App\admin\Ventas::whereYear('fecha',date('Y'))->whereMonth('fecha',$mes)->where('status',1)->sum('totald');
      $imp_cancelado  = \App\admin\Ventas::whereYear('fecha',date('Y'))->whereMonth('fecha',$mes)->where('status',0)->sum('totald');
      $imp_compras    = \App\admin\Compras::whereYear('fecha_compra',date('Y'))->whereMonth('fecha_compra',$mes)->where('status',1)->sum('total');

      $grafica['vendido'][$mes]   = $imp_vendido;
      $grafica['cancelado'][$mes] = $imp_cancelado;
      $grafica['comprado'][$mes]  = $imp_compras;

    }

  }

  $cajeros = "";
  $valores = '';
?>



<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">

  <div class="row">

      <div class="col-12 col-md-3 col-xl-3 col-sd-12">
        <div class="card @if($boxs->status == 1) bg-primary @else bg-success @endif text-white">
          <div class="card-body">
            <h4 class="card-title text-white">
              <i class="fa fa-dollar" aria-hidden="true"></i>
              Venta del dia <small>HOY</small>
            </h4>
            <p class="card-text" style="font-size:30px;">
              $ {{ number_format(\App\admin\Ventas::where('status',1)->where('fecha',date('Y-m-d'))->sum('totald'),0,",",".") }}
            </p>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-3 col-xl-3 col-sd-12">
          <div class="card">
              <div class="card-header">
                  <div>
                      <h2 class="font-weight-bolder mb-0">$ {{ number_format(\App\admin\Ventas::whereMonth('fecha',date('m'))->whereYear('fecha',date('Y'))->where('status',1)->sum('totald'),0,",",".") }}</h2>
                      <p class="card-text">Ventas {{ date('F')}}</p>
                  </div>
                  <div class="avatar bg-light-success p-50 m-0">
                      <div class="avatar-content">
                        <i data-feather='dollar-sign' class="font-medium-5"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-12 col-md-3 col-xl-3 col-sd-12">
          <div class="card">
              <div class="card-header">
                  <div>
                      <h2 class="font-weight-bolder mb-0">$ {{ number_format(\App\admin\Ventas::whereMonth('fecha',date('m'))->whereYear('fecha',date('Y'))->where('status',0)->sum('totald'),0,",",".") }}</h2>
                      <p class="card-text">Vtas Canceladas {{ date('F')}}</p>
                  </div>
                  <div class="avatar bg-light-danger p-50 m-0">
                      <div class="avatar-content">
                          <i data-feather='x' class="font-medium-5"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-12 col-md-3 col-xl-3 col-sd-12">
          <div class="card">
              <div class="card-header">
                  <div>
                      <h2 class="font-weight-bolder mb-0">$ {{ number_format(\App\admin\Ventas::whereMonth('fecha',date('m'))->whereYear('fecha',date('Y'))->where('status','!=',3)->sum('totald'),0,",",".") }}</h2>
                      <p class="card-text">Vtas Pausadas {{ date('F')}}</p>
                  </div>
                  <div class="avatar bg-light-success p-50 m-0">
                      <div class="avatar-content">
                        <i data-feather='pause' class="font-medium-5"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

    <!-- Area Chart ends -->
  </div>

  <div class="row">

    <h3>Cajas del activas <small>Hoy</small></h3>

    <div class="col-md-4 col-xl-4">
      <div class="card">
        <div class="card-body">
            <div id="donut-chart"></div>
        </div>
      </div>
    </div>

    <div class="col-md-8 col-xl-8">
      <div class="card">
        <div class="card-body table-responsive" style="height:360px;">
          <table class="table">
             <thead>
               <tr>
                 <th>Cajero</th>
                 <th>Efectivo</th>
                 <th>Transferencia</th>
                 <th>Tarjeta T/D</th>
                 <th>Vendido</th>
               </tr>
             </thead>
             <tbody>
               @foreach(\App\admin\Cajas::whereBetween('inicia',[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')])->where('status',1)->get() as $boxs)
                <?php
                  $venta = \App\admin\Ventas::where('status',1)->where('caja_id',$boxs->id)->sum('totald');
                  $cajeros .= '\'' . $boxs->cajero->name . '\',';
                  $valores .= round($venta,0) . ',';
                ?>
                 <tr>
                   <td>{{ $boxs->cajero->name }}</td>
                   <td>$ {{ number_format(\App\admin\Ventas::where('status','!=',0)->where('metodo_pago','Efectivo')->where('caja_id',$boxs->id)->sum('totald'),0,".",",") }}</td>
                   <td>$ {{ number_format(\App\admin\Ventas::where('status','!=',0)->where('metodo_pago','Transferencia')->where('caja_id',$boxs->id)->sum('totald'),0,".",",") }}</td>
                   <td>$ {{ number_format(\App\admin\Ventas::where('status','!=',0)->where('metodo_pago','LIKE','Tarjeta%')->where('caja_id',$boxs->id)->sum('totald'),0,".",",") }}</td>
                   <td>$ {{ number_format($venta,0,".",",") }}</td>
                 </tr>
               @endforeach
             </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Ultimas Ventas Generadas</h4>
        </div>
        <div class="card-content">
          <table class="table">
              <thead>
                <tr>
                  <th>Cliente</th>
      						<th>Operador</th>
      						<th>Fecha</th>
      						<th>Hora</th>
      						<th>Subtotal</th>
      						<th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach(\App\admin\Ventas::limit(10)->orderBy('fecha','DESC')->get() as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" @if($value->status == 0) class="table-danger" @endif>
                    <td> {{{ $value->cliente->nombre != "" ? $value->cliente->nombre : "PUBLICO EN GENERAL" }}} </td>
                    <td> {{{ $value->user->name }}} </td>
                    <td> {{{ $value->fecha }}} </td>
                    <td> {{{ $value->hora }}} </td>
                    <td> $ {{{ number_format($value->subtotal,0,".",",") }}} </td>
                    <td> $ {{{ number_format($value->totald,0,".",",") }}} </td>
                    <td class="text-center">
					           <a href="<?php echo url("/"); ?>/admin/ventas/view/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
					             <i class="fa fa-receipt fa-lg text-info m-r-10"></i>
					           </a>
            				</td>
                  </tr>
                <?php }  ?>
              </tbody>
            </table>
        </div>

      </div>
    </div>
  </div>


</section>
<!-- Dashboard Ecommerce ends -->

@endsection


@section('scripts')

<link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/charts/apexcharts.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">


<script src="{{ asset('/') }}vendors/js/charts/apexcharts.min.js"></script>
<script src="{{ asset('/') }}vendors/js/pickers/flatpickr/flatpickr.min.js"></script>


<script>

isRtl = $('html').attr('data-textdirection') === 'rtl',

chartColors = {
  column: {
    series1: '#826af9',
    series2: '#d2b0ff',
    bg: '#f8d3ff'
  },
  donut: {
    series1: '#ffe700',
  },
  area: {
    series1: '#6610f2',
    series2: '#ea5455',
    series3: '#28c76f',
  }
};
// Area Chart
// --------------------------------------------------------------------
var areaChartEl = document.querySelector('#line-area-chart'),
  areaChartConfig = {
    chart: {
      height: 400,
      type: 'area',
      parentHeightOffset: 0,
      toolbar: {
        show: false
      }
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      show: false,
      curve: 'straight'
    },
    legend: {
      show: true,
      position: 'top',
      horizontalAlign: 'start'
    },
    grid: {
      xaxis: {
        lines: {
          show: true
        }
      }
    },
    colors: [chartColors.area.series1, chartColors.area.series2, chartColors.area.series3],
    series: [
      {
        name: 'Compras Realizadas',
        data: [@foreach($grafica['comprado'] as $mes => $values)  {{ $values }}, @endforeach]
      },
      {
        name: 'Ventas Realizadas',
        data: [@foreach($grafica['vendido'] as $mes => $values)  {{ $values }}, @endforeach]
      },
      {
        name: 'Ventas Canceladas',
        data: [@foreach($grafica['cancelado'] as $mes => $values)  {{ $values }}, @endforeach]
      }
    ],
    xaxis: {
      categories: [
        @foreach($meses as $mes => $labels)
          @if((int)date('m') >= $mes)
            '{{ $labels }}',
          @endif
        @endforeach
      ]
    },
    fill: {
      opacity: 1,
      type: 'solid'
    },
    tooltip: {
      shared: false
    },
    yaxis: {
      opposite: isRtl
    }
  };
if (typeof areaChartEl !== undefined && areaChartEl !== null) {
  var areaChart = new ApexCharts(areaChartEl, areaChartConfig);
  areaChart.render();
}


// Donut Chart
// --------------------------------------------------------------------
var donutChartEl = document.querySelector('#donut-chart'),
  donutChartConfig = {
    chart: {
      height: 350,
      type: 'donut'
    },
    legend: {
      show: true,
      position: 'bottom'
    },
    labels: [{!! $cajeros !!}],
    series: [{{ $valores }}],
    dataLabels: {
      enabled: true,
      formatter: function (val, opt) {
        return parseInt(val) + '%';
      }
    }
  };
if (typeof donutChartEl !== undefined && donutChartEl !== null) {
  var donutChart = new ApexCharts(donutChartEl, donutChartConfig);
  donutChart.render();
}

</script>

@endsection
