@extends('layouts.app')

@section('content')

<section class="app-user-view">


  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body table-responsive">
            <div class="row">

              <div class="col-md-12" style="text-align:right">
                <a class="btn btn-relief-info " href="{{ url('admin/cajas/printer/' . $data->id) }}" target="_blank" title="Reporte" data-toggle="tooltip">
                  <i class="fa fa-print fa-lg"></i> Imprimir Reporte</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- User Card & Plan Starts -->
    <div class="row">
        <!-- User Card starts-->
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card user-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                            <div class="user-avatar-section">
                                <div class="d-flex justify-content-start">
                                  <?php if($data->cajero->photo) { ?>
                                    <img class="img-fluid rounded" src="{{ asset('uploads/usuarios/' . $data->cajero->photo) }}" height="104" width="104" alt="User avatar" />
                                  <?php } else { ?>
                                    <img class="img-fluid rounded" src="{{ asset('/') }}/images/avatars/7.png" height="104" width="104" alt="User avatar" />
                                  <?php } ?>

                                    <div class="d-flex flex-column ml-1">
                                        <div class="user-info mb-1" style="margin-left:20px;">
                                            <h4 class="mb-0">{{ $data->cajero->name }}</h4>
                                            <span class="card-text">{{ $data->cajero->email }}</span><br/>
                                            <span class="card-text">{{ \App\admin\Users::PERFILES[$data->cajero->perfil]}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                            <div class="user-info-wrapper">

                              <div class="d-flex flex-wrap">
                                <div class="col-md-6">
                                  <div class="user-info-title">
                                      <span class="card-text user-info-title font-weight-bold mb-0">Saldo Inicial: </span>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <p class="card-text mb-0"> &nbsp;&nbsp; {{ number_format($data->monto_inicial,0,".",",") }} </p>
                                </div>
                              </div>
                              <div class="d-flex flex-wrap my-50">
                                <div class="col-md-6">
                                  <div class="user-info-title">
                                      <span class="card-text user-info-title font-weight-bold mb-0">Saldo Final: </span>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <p class="card-text mb-0"> &nbsp;&nbsp; {{ number_format($data->monto_final,0,".",",") }} </p>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /User Card Ends-->
    </div>
    <!-- User Card & Plan Ends -->

    <div class="row">
      <div class="col-md-3 col-xl-3">
        <div class="card bg-primary text-white">
          <div class="card-body">
            <h4 class="card-title text-white">Ventas Realizadas</h4>
            <p class="card-text" style="font-size:20px;">
              {{ \App\admin\Ventas::where('status','!=',0)->where('caja_id',$data->id)->count() }}
              / $
              {{ number_format(\App\admin\Ventas::where('status','!=',0)->where('caja_id',$data->id)->sum('totald'),0,".",",") }}  </p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-xl-3">
        <div class="card bg-danger text-white">
          <div class="card-body">
            <h4 class="card-title text-white">Ventas Canceladas</h4>
            <p class="card-text" style="font-size:20px;">
              {{ \App\admin\Ventas::where('status',0)->where('caja_id',$data->id)->count() }}
              / $
              {{ number_format(\App\admin\Ventas::where('status',0)->where('caja_id',$data->id)->sum('totald'),0,".",",") }} </p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-xl-3">
        <div class="card bg-info text-white">
          <div class="card-body">
            <h4 class="card-title text-white">Efectivo Retirado</h4>
            <p class="card-text" style="font-size:20px;">
              {{ \App\admin\Efectivo::where('tipo','I')->where('caja_id',$data->id)->count() }}
              / $
              {{ number_format(\App\admin\Efectivo::where('tipo','E')->where('caja_id',$data->id)->sum('importe'),0,".",",") }}</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-xl-3">
        <div class="card bg-warning text-white">
          <div class="card-body">
            <h4 class="card-title text-white">Efectivo Ingresado</h4>
            <p class="card-text" style="font-size:20px;">
              {{ \App\admin\Efectivo::where('tipo','E')->where('caja_id',$data->id)->count() }}
              / $
              {{ number_format(\App\admin\Efectivo::where('tipo','E')->where('caja_id',$data->id)->sum('importe'),0,".",",") }} </p>
          </div>
        </div>
      </div>



    </div>

    <div class="row">
      <div class="col-md-3 col-xl-3">
        <div class="card shadow-none bg-transparent border-primary">
          <div class="card-body">
            <h4 class="card-title">EFECTIVO</h4>
            <p class="card-text" style="font-size:20px;">
              $ {{ number_format(\App\admin\Ventas::where('status','!=',0)->where('metodo_pago','Efectivo')->where('caja_id',$data->id)->sum('totald'),0,".",",") }}  </p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-xl-3">
        <div class="card shadow-none bg-transparent border-success">
          <div class="card-body">
            <h4 class="card-title">TARJETA DE CREDITO</h4>
            <p class="card-text" style="font-size:20px;"> $ {{ number_format(\App\admin\Ventas::where('status',1)->where('metodo_pago','Tarjeta Credito')->where('caja_id',$data->id)->sum('totald'),0,".",",") }} </p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-xl-3">
        <div class="card shadow-none bg-transparent border-warning">
          <div class="card-body">
            <h4 class="card-title">TARJETA DE DEBITO</h4>
            <p class="card-text" style="font-size:20px;"> $ {{ number_format(\App\admin\Ventas::where('status',1)->where('metodo_pago','Tarjeta Debito')->where('caja_id',$data->id)->sum('totald'),0,".",",") }}</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-xl-3">
        <div class="card shadow-none bg-transparent border-danger">
          <div class="card-body">
            <h4 class="card-title">TRANSFERENCIA</h4>
            <p class="card-text" style="font-size:20px;"> $ {{ number_format(\App\admin\Ventas::where('status',1)->where('metodo_pago','Transferencia')->where('caja_id',$data->id)->sum('totald'),0,".",",") }}</p>
          </div>
        </div>
      </div>

    </div>

    <!-- User Timeline & Permissions Starts -->
    <div class="row">

      <div class="col-sm-7">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Ventas Realizadas</h4>
          </div>
          <div class="card-content">
            <div class="card-body">
              <div class="row table-responsive">
                <table class="table text-left">
                  <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Total</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach(\App\admin\Ventas::where('caja_id',$data->id)->get() as $value) { ?>
                      <tr
                      @if($value->status == 0)
                       class="table-danger"
                      @elseif($value->status == 3)
                        class="table-warning"
                      @endif
                       >
                        <td> {{{ $value->cliente->nombre != "" ? $value->cliente->nombre : "Publico en General" }}} </td>
                        <td> {{{ $value->fecha }}} </td>
                        <td> {{{ $value->hora }}} </td>
                        <td> $ {{{ number_format($value->totald,0,".",",") }}} </td>
                        <td>
                          <a href="{{ url('admin/ventas/view/' . $value->id) }}" title="Ver venta" data-toggle="tooltip" target="_blank">
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
      </div>

      <div class="col-sm-5">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Movimientos de Efectivo</h4>
          </div>
          <div class="card-content">
            <div class="card-body">
              <div class="row table-responsive">
                <table class="table text-left">
                  <thead>
                    <tr>
                      <th>Movimiento</th>
                      <th>Importe</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach(\App\admin\Efectivo::where('caja_id',$data->id)->get() as $value) { ?>
                      <tr>
                        <td> {{{ $value->tipo == "E" ? "Egreso" : "Ingreso"  }}} </td>
                        <td> {{{ $value->importe }}} </td>
                      </tr>
                      <tr>
                        <td colspan="2"> <b>Motivo;</b> <br/> {{{ $value->concepto }}} </td>
                      </tr>
                    <?php }  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

</section>

@endsection

@section('scripts')

<script>

$( document ).ready(function() {

  $('#comentarios').summernote({
      height: 200, // set editor height
      minHeight: null, // set minimum height of editor
      maxHeight: null, // set maximum height of editor
      focus: false // set focus to editable area after initializing summernote
  });

});

</script>
@endsection
