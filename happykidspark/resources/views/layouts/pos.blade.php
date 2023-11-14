<!DOCTYPE html>
<html class="loading @if(Auth::user()->darktheme == 1) dark-layout  @endif " lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ str_replace('_',' ',env('TITULO_APP')) }} :: PANEL DE CONTROL</title>
    <link rel="apple-touch-icon" href="{{ asset('/') }}images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/plugins/extensions/ext-component-toastr.css">


    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/themes/semi-dark-layout.css">
    <link href="{{ asset('js/dropify/dist/css/dropify.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}vendors/css/pickers/flatpickr/flatpickr.min.css">


    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/plugins/forms/pickers/form-pickadate.css">



    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/plugins/extensions/ext-component-toastr.css">
    <!-- END: Page CSS-->


</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Content-->
    @yield('content')
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <div class="modal fade text-start" id="modalLoader" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            <div class="demo-inline-spacing">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden"></span>
                </div>
                <h3>PROCESANDO INFORMACION...</h3>
              </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade text-start" id="selectTimer" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ingresoEgresoHead">Registro cronometros</h4>
            <button type="button" class="btn-close" id="btnTimerClose" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="row" id="timerCounters">

              <!-- Nombre Start -->
    					<div class="col-md-6" id="">
    						<div class="mb-1">
    						 <div class="form-group">
    						  <label for="nombre" class="control-label"> Cuantos usuarios ingresaran</label>
                  <div class="input-group mb-2">
              	    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-users fa-lg" aria-hidden="true"></i> </span>
              	    <input type="text" class="form-control" id="txtTimersGenerator" name="nombre" required="" maxlength="100" value="">
                  </div>
    						   <div class="label label-danger">{{ $errors->first("nombre") }}</div>
    					   </div>
    						</div>
    					</div>

              <!-- Telefono Start -->
              <div class="col-md-6">
                <div class="mb-1">
                 <div class="form-group">
                  <label for="telefono" class="control-label"> Telefono </label>
                  <div class="input-group mb-2">
                    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-mobile fa-lg" aria-hidden="true"></i> </span>
                    <input type="text" class="form-control" id="cronometro_telefono">
                  </div>
                </div>
                </div>
              </div>
              <!-- Telefono End -->

              <!-- Nombre Start -->
              <div class="col-md-6">
                <div class="mb-1">
                 <div class="form-group">
                  <label for="nombre" class="control-label"> Seleccione el tiempo de juego</label>
                  <div class="input-group mb-2">
                    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-clock fa-lg" aria-hidden="true"></i> </span>
                    <select class="form-control" id="cronometro_tiempo_id">
                      <option value="">[ Seleccione ]</option>
                      @foreach(\App\admin\Tiempos::where('status',1)->get() as $times)
                        <option value="{{ $times->id }}">
                          {{ $times->minutos }} Minutes $ {{ number_format($times->costo,0,",",".") }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                 </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-1">
                 <div class="form-group">
                  <label for="nombre" class="control-label"> Seleccione el color y serie de bandas a usar</label>
                  <div class="input-group mb-2">
                    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-ring fa-lg" aria-hidden="true"></i> </span>
                    <select class="form-control" id="bandas_id">
                      <option value="">[ Seleccione ]</option>
                      @foreach($bandas as $bandas)
                        <option value="{{ $bandas->id }}">
                          {{ $bandas->color }} ({{ ($bandas->unidades - $bandas->usadas) }} Unit.)
                        </option>
                      @endforeach
                    </select>
                  </div>
                 </div>
                </div>
              </div>


              <!-- Nombre End -->

    					<!-- Nombre End -->

              <div class="col-md-12">
                <button class="btn w-100 btn-success btn-lg btn-block" type="button" id="btnRegistaTemporizador" onclick="registraIngresantes()" disabled>REGISTRAR </button>
              </div>

            </div>

            <div class="row" id="timersGenerator" style="display:none">

                <!-- Nombre Start -->
      					<div class="col-md-9">
      						<div class="mb-1">
      						 <div class="form-group">
      						  <label for="nombre" class="control-label"> Nombre</label>
                    <div class="input-group mb-2">
                	    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-child fa-lg" aria-hidden="true"></i> </span>
                      <input type="text" class="form-control" id="cronometro_nombre">
                    </div>
      					   </div>
      						</div>
      					</div>
      					<!-- Nombre End -->

                <!-- Telefono Start -->
      					<div class="col-md-3">
      						<div class="mb-1">
      						 <div class="form-group">
      							<label for="banda" class="control-label"> Codigo de Banda </label>
                    <div class="input-group mb-2">
                	    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-barcode fa-lg" aria-hidden="true"></i> </span>
                      <input type="text" class="form-control" id="cronometro_banda">
                    </div>
      						 </div>
      						</div>
      					</div>
      					<!-- Telefono End -->

                <div class="col-md-12">
                  
                </div>

                <div class="col-md-12">
                  <button class="btn w-100 btn-success btn-lg btn-block" type="button" onclick="aplicaCronometro()">ASIGNAR BANDA</button>
                </div>

              </div>

          </div>
        </div>
      </div>
    </div>

    <div class="modal fade text-start" id="modalCaja" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ingresoEgresoHead">Registro de Caja</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" id="btnCajaClose" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">

              <div class="col-md-12" id="contentAperturaCaja">
                <label class="label-control">Especifique el monto con el que inicia en caja</label>
                <div class="input-group mb-2">
                   <span class="input-group-text" id="basic-addon-search1">$ </span>
                   <input type="text" class="form-control" placeholder="MONTO INICIAL DE CAJA" id="txtInicialCajaCaptura">
                   <span class="input-group-text" id="basic-addon-search1"> CPL</span>

                 </div>
              </div>

              <div class="col-md-12" style="display:none" id="contentCierreCaja">
                <label class="label-control">Cuente y especifique el monto con el cual cierra la caja</label>
                <div class="input-group mb-2">
                   <span class="input-group-text" id="basic-addon-search1">$ </span>
                   <input type="text" class="form-control" placeholder="MONTO DE CIERRE" id="txtFinalCajaCaptura">
                   <span class="input-group-text" id="basic-addon-search1"> CPL</span>
                 </div>
              </div>

              @if($forza_cierre == 1)
                <div class="col-md-12 text-danger" style="margin-bottom:20px;">
                  La caja inicio el: {{ $forza_date }}, no se puede realizar ninguna operacion hasta que realice el cierre de esta caja
                </div>
              @endif
              <div class="col-md-12">
                <button class="btn w-100 btn-success btn-lg btn-block" id="btnCajaMovimientos" type="button" onclick="aplicaMovCaja()">ABRIR CAJA</button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade text-start" id="modalMovs" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="ingresoEgresoHead">Movimientos de Efectivo</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">

                  <div class="col-md-12">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="inicia" class="control-label"> Codigo de Autorizacion </label>
                      <div class="input-group mb-2">
                	       <span class="input-group-text" id="basic-addon1"> <i class="fa fa-lock" aria-hidden="true"></i> </span>
                         <input type="text" class="form-control" id="txtCodigoAutorizacionEfectivo">
                      </div>
                     </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="inicia" class="control-label"> Seleccione el tipo de movimiento </label>
                      <div class="input-group mb-2">
                	       <span class="input-group-text" id="basic-addon1"> <i class="fa fa-cash-register" aria-hidden="true"></i> </span>

                         <select class="form-control" id="tipo_movimiento">
                           <option value="">[ Seleccione ]</option>
                           <option value="E">Egreso</option>
                           <option value="I">Ingreso</option>
                         </select>
                      </div>
                     </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="inicia" class="control-label"> Importe de Movimiento </label>
                      <div class="input-group mb-2">
                	       <span class="input-group-text" id="basic-addon1"> $ </span>
                         <input type="text" class="form-control" id="monto_movimiento">
                         <span class="input-group-text" id="basic-addon1"> CPL </span>
                      </div>
                      <div class="label label-danger">{{ $errors->first("inicia") }}</div>
                     </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="inicia" class="control-label"> Concepto del movimiento </label>
                      <div class="input-group mb-2">
                	       <span class="input-group-text" id="basic-addon1"> <i class="fa fa-user-circle fa-lg"></i> </span>
                         <input type="text" class="form-control" id="concepto_movimiento">
                         <span class="input-group-text" id="basic-addon1"> <i class="fa fa-question-circle fa-lg"></i> </span>
                      </div>
                     </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <button type="button" onclick="guardaMovimiento()" class="btn btn-relief-success w-100 mb-75 waves-effect"><i class="fa fa-check fa-lg"></i> Aplicar </button>
                  </div>

                  <div class="col-md-4">
                    <button type="button" onclick="listarMovimiento()" class="btn btn-relief-info w-100 mb-75 waves-effect"><i class="fa fa-list fa-lg"></i> Movimientos </button>
                  </div>

                  <div class="col-md-4">
                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-relief-danger w-100 mb-75 waves-effect"><i class="fa fa-times-circle fa-lg"></i> Cancelar </button>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

    <div class="modal fade text-start" id="modalListMovs" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="ingresoEgresoHead">Movimientos de Efectivo</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <table class="table text-center">
                    <thead>
                      <tr>
                        <th>Tipo</th>
            						<th>Importe</th>
            						<th>Concepto</th>
                      </tr>
                    </thead>
                    <tbody id="itemsMovs">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

    <div class="modal fade text-start" id="modalVentas" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ingresoEgresoHead">Ventas generadas</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
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
                <tbody id="vtasHtmlContent">

                </tbody>

              </table>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <button type="button" class="btn btn-warning waves-effect waves-float waves-light" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade text-start" id="modalPrinter" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ingresoEgresoHead">Imprimir Ticket</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            @if(Session::has('qrcodes'))
              <div class="row" style="margin-bottom:30px;">
                <div class="col-md-2">
                    <button class="btn btn-secondary " type="button" onclick="reimprime({{ Session::get('ticket_id') }});"> <i class="fa fa-receipt fa-lg"></i> Imprimir Ticket</button>
                </div>
                <div class="col-md-2">
                  <button class="btn btn-primary " type="button" onclick="reimprimeQr({{ Session::get('ticket_id') }});"> <i class="fa fa-qrcode fa-lg"></i> Imprimir QR Code</button>
                </div>
                <div class="col-md-8"></div>
              </div>
            @endif

            <div class="row">
              <iframe src="" style="border:0px; width:100%; height:500px" id="iframePrinter"></iframe>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <button type="button" class="btn btn-warning waves-effect waves-float waves-light" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade text-start" id="neewCustom" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ingresoEgresoHead">Registrar Nuevo Cliente</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row" id="frmCustoms">
              @include('admin.clientes.form')
            </div>

            <div class="row" id="listCustom">
              <table class="table">
                <thead>
                  <tr>
                    <th>Nombre</th>
        						<th>Direccion</th>
        						<th>Telefono</th>
        						<th>Celular</th>
  						      <th></th>
                  </tr>
                </thead>
                <tbody id="customList">

                </tbody>

              </table>
            </div>

            <div class="row">
              <div class="col-md-6">
              </div>
              <div class="col-md-6" style="text-align:right">
                <button type="button" class="btn btn-warning waves-effect waves-float waves-light" data-bs-dismiss="modal">Cerrar</button>
                <button id="btnSaveCustom" type="button" class="btn btn-success waves-effect waves-float waves-light" onclick="guardarSeleccionar();" >Guardar y seleccionar</button>
              </div>
            </div>
          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>

    <div class="modal fade text-start" id="metodoPago" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ingresoEgresoHead">Procesar Venta</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="row" id="paymentEfectivo">

              <div class="col-md-12">
    						<div class="mb-1">
    						 <div class="form-group">
    							<label for="banda" class="control-label"> Monto a Pagar </label>
                  <div class="input-group mb-2">
              	    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-dollar fa-lg" aria-hidden="true"></i> </span>
                    <input type="text" class="form-control" id="txtPaymentSubtotal" readonly>
                    <span class="input-group-text" id="basic-addon1"> CPL </span>
                  </div>
    						 </div>
    						</div>
    					</div>

              <div class="col-md-12">
    						<div class="mb-1">
    						 <div class="form-group">
    							<label for="banda" class="control-label"> Cantidad Recibida </label>
                  <div class="input-group mb-2">
              	    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-dollar fa-lg" aria-hidden="true"></i> </span>
                    <input type="text" class="form-control" id="txtPaymentEfectivo">
                    <span class="input-group-text" id="basic-addon1"> CPL </span>
                  </div>
    						 </div>
    						</div>
    					</div>

              <div class="col-md-12">
    						<div class="mb-1">
    						 <div class="form-group">
    							<label for="banda" class="control-label"> Importe a devolver </label>
                  <div class="input-group mb-2">
                    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-dollar fa-lg" aria-hidden="true"></i> </span>
                    <input type="text" class="form-control" id="txtPamentCambio" readonly>
                    <span class="input-group-text" id="basic-addon1"> CPL </span>
                  </div>
    						 </div>
    						</div>
    					</div>
            </div>

            <div class="row" id="paymentAutorizacion">

              <div class="col-md-12" id="cmbTipoTarjeta">
    						<div class="mb-1">
    						 <div class="form-group">
    						  <label for="nombre" class="control-label"> Tipo de Tarjeta  </label>
                  <div class="input-group mb-2">
              	    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-credit-card fa-lg" aria-hidden="true"></i> </span>
                    <select class="form-control" id="cmbPaylmentTdc">
                      <option value="">[ Seleccione ]</option>
                      <option value="Credito">TARJETA DE CREDITO</option>
                      <option value="Debito">TARJETA DE DEBITO</option>
                    </select>
                  </div>
    					   </div>
    						</div>
    					</div>

              <div class="col-md-12">
    						<div class="mb-1">
    						 <div class="form-group">
    							<label for="banda" class="control-label"> Numero de Autorizacion de la operacion </label>
                  <div class="input-group mb-2">
              	    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-lock fa-lg" aria-hidden="true"></i> </span>
                    <input type="text" class="form-control" id="txtPaymentAutorizacion">
                  </div>
    						 </div>
    						</div>
    					</div>

            </div>

            <div class="row">
              <div class="col-md-6">
                <button type="button" class="btn w-100 btn-warning waves-effect waves-float waves-light" data-bs-dismiss="modal">Cerrar</button>
              </div>
              <div class="col-md-6" style="text-align:right">
                <button id="btnProcesarVenta" type="button" class="btn w-100 btn-success waves-effect waves-float waves-light" onclick="procesaVenta();" >Procesar Orden</button>
              </div>
            </div>
          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>

    <div class="modal fade text-start" id="validaCodigo" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="ingresoEgresoHead">Codigo de Cancelacion</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="btnCajaClose" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">

                  <div class="col-md-12">
                    <label class="label-control">Tecle el codigo de cancelacion <br/></label>
                    <div class="input-group mb-2">
                       <span class="input-group-text" id="basic-addon-search1"> <i class="fa fa-lock fa-lg"></i> </span>
                       <input type="text" class="form-control" placeholder="CODIGO DE CANCELACION" id="txtCodeVerification">
                     </div>
                  </div>

                  <div class="col-md-12">
                    <button class="btn w-100 btn-success btn-lg btn-block" type="button" onclick="verificaCodigoCancelacion()">ABRIR CAJA</button>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

    <div class="modal fade text-start" id="modalReservas" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ingresoEgresoHead">Reservas Del Dia</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <table class="table">
                <thead>
                  <tr>
                    <th>Cliente</th>
        						<th>Fecha</th>
        						<th>Tutor</th>
        						<th>No Telefono</th>
        						<th>No Ocupantes</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach(\App\admin\Reservaciones::where('status',1)->where('fecha_reserva',date('Y-m-d'))->get() as $reserva)
                    <tr>
                      <th>{{ $reserva->cliente->nombre }}</th>
                      <th>{{ $reserva->fecha_reserva }}</th>
                      <th>{{ $reserva->tutor }}</th>
                      <th>{{ $reserva->telefono }}</th>
                      <th>{{ $reserva->cantidad }} / {{ $reserva->tiempo->minutos}} Minutos</th>
                      <th>
                        <a href="javascript:void(0)" onclick="seleccionarReserva({{ $reserva->id }})" title="Seleccionar reserva" data-toggle="tooltip">
 						             <i class="fa fa-check-circle fa-lg text-success m-r-10" aria-hidden="true"></i>
 						            </a>
                      </th>
                    </tr>
                  @endforeach
                </tbody>

              </table>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <button type="button" class="btn btn-warning waves-effect waves-float waves-light" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade text-start" id="modalChat" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ingresoEgresoHead">Mensajeria Instantanea</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeTempos()"></button>
          </div>
          <div class="modal-body" style="padding:0px">
            @include('admin.chat.index')
          </div>
        </div>
      </div>
    </div>
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('/') }}vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS
      <script src="{{ asset('/') }}vendors/js/charts/apexcharts.min.js"></script>
      <script src="{{ asset('/') }}vendors/js/extensions/toastr.min.js"></script>
    -->
    <script src="{{ asset('js//dropify/dist/js/dropify.js') }}"></script>
    <script src="{{ asset('/') }}vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ asset('/') }}vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="{{ asset('/') }}vendors/js/extensions/polyfill.min.js"></script>

    <script src="{{ asset('/') }}vendors/js/extensions/toastr.min.js"></script>

    <!-- END: Page Vendor JS-->


    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script src="{{ asset('/') }}vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ asset('/') }}vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{ asset('/') }}vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{ asset('/') }}vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{ asset('/') }}vendors/js/pickers/flatpickr/flatpickr.min.js"></script>



    <!-- BEGIN: Theme JS-->

    <script src="{{ asset('/') }}js/scripts/forms/pickers/form-pickers.js"></script>


    <script src="{{ asset('/') }}js/core/app-menu.js"></script>
    <script src="{{ asset('/') }}js/core/app.js"></script>
    <!-- END: Theme JS-->

    <script src="{{ asset('/') }}vendors/js/forms/cleave/cleave.min.js"></script>
    <script src="{{ asset('/') }}vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>


    <!--Fontawesome js -->
    <script src="https://kit.fontawesome.com/992bac1782.js" crossorigin="anonymous"></script>

    <!-- BEGIN: Page JS
    <script src="{{ asset('/') }}js/scripts/pages/dashboard-ecommerce.js"></script>
    END: Page JS-->
    <style>
      .input-group-text{ background: #DFDFDF; }
      .card-header { border-bottom:1px solid #E8E2E2; margin-bottom:20px; }
      .sepate-line { border-right: 1px solid #ebe9f1; border-bottom: 1px solid #ebe9f1; padding-top:5px; min-height: 90px }
      .sepate-right { border-bottom: 1px solid #ebe9f1;padding-top:5px; min-height: 90px}
    </style>
    <script>

    let tempocontacts;
    let tempoChatActive;
    let newMessages;

    $('.dropify').dropify();

        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })

        function procesando() {

          var myModal = new bootstrap.Modal(document.getElementById('modalLoader'), { backdrop: 'static',keyboard: false })

          myModal.show();

        }

        <?php if(Session::has('message')) { ?>
          <?php if(Session::has('exito')) { ?>

            Swal.fire({
              title: ' EXITO !',
              text: "{{ Session::get('message') }}",
              icon: 'success',
              customClass: {
                confirmButton: 'btn btn-success'
              },
              buttonsStyling: false
            });

          <?php } else if(Session::has('fracaso')) { ?>

            Swal.fire({
              title: ' ¡ ATENCION !',
              text: "{{ Session::get('message') }}",
              icon: 'warning',
              customClass: {
                confirmButton: 'btn btn-danger'
              },
              buttonsStyling: false
            });


          <?php } ?>

        <?php } ?>

        $('.select2').select2();

        var active_reader = 0;
        var modalChat = new bootstrap.Modal(document.getElementById('modalChat'), { backdrop: 'static',keyboard: true })

        $('#txtMessage').on('keydown',function(e){
          if(e.which == 13) {
            $('#btnSendMessage').trigger('click');
          }
        });

        $('#btnSendMessage').on('click',function(){


          $.ajax({
            url: "<?php echo url('admin/chat/add/'); ?>/?usr_envia_id=" + active_reader + "&mensaje=" + $('#txtMessage').val(),
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            success: function(json) {

              if(json['error'] == 0) {
                openChat(active_reader);
                $('#txtMessage').val("");
              }

            }

          });

        });

        function openChat(recibe) {
          active_reader = recibe;
          $.ajax({
        		url: "<?php echo url('admin/chat/ajax/'); ?>/" + recibe,
        		dataType: 'json',
        		contentType: "application/json; charset=utf-8",
        		success: function(json) {

        			if(json['error'] == 0) {
                $('#chatContent').html(json['html']);
                $('#smsContent').fadeIn('fast');
                $('#contentCountChats').remove();
                var objDiv = document.getElementById("chatContent");
                objDiv.scrollTop = objDiv.scrollHeight;
                tempoChatActive = setTimeout(continuaChat, 30000);
        			}

        		}

        	});

        }

        function continuaChat() {

          console.log("Continuamos monitoreando el chat del usuario.....");
          $.ajax({
        		url: "<?php echo url('admin/chat/ajax/'); ?>/" + active_reader,
        		dataType: 'json',
        		contentType: "application/json; charset=utf-8",
        		success: function(json) {

        			if(json['error'] == 0) {
                $('#chatContent').html(json['html']);
                $('#smsContent').fadeIn('fast');
                $('#contentCountChats').remove();
                var objDiv = document.getElementById("chatContent");
                objDiv.scrollTop = objDiv.scrollHeight;
                tempoChatActive = setTimeout(continuaChat, 30000);
              }

        		}

        	});
        }

        function traeContactos() {

          $.ajax({
        		url: "<?php echo url('admin/chat/contacts/'); ?>/",
        		dataType: 'json',
        		contentType: "application/json; charset=utf-8",
        		success: function(json) {

        			if(json['error'] == 0) {
                $('#contactContent').html(json['html']);
                tempocontacts = setTimeout(contactosNewMsms, 30000);
                modalChat.show();
        			}

        		}

        	});
        }

        function contactosNewMsms() {
          $.ajax({
        		url: "<?php echo url('admin/chat/contacts/'); ?>/",
        		dataType: 'json',
        		contentType: "application/json; charset=utf-8",
        		success: function(json) {

        			if(json['error'] == 0) {
                $('#contactContent').html(json['html']);
                console.log("Validando si hay mensajes nuevos por usuario");
                tempocontacts = setTimeout(contactosNewMsms, 30000);
            	}

        		}

        	});
        }

        function existenMensajes() {

          $.ajax({
        		url: "<?php echo url('admin/chat/mensajes/'); ?>/",
        		dataType: 'json',
        		contentType: "application/json; charset=utf-8",
        		success: function(json) {
              console.log("Monitreando si hay mensajes");
              var chats = parseFloat(json['chats']);
              if(isNaN(chats)) {
                chats = 0;
                $('#iconChats').removeClass('btn-outline-primary');
                $('#iconChats').addClass('btn-outline-secondary');
                $('#iconChats').html('<i class="fa-solid fa-comment fa-2x"></i>');
              } else {
                $('#iconChats').removeClass('btn-outline-secondary');
                $('#iconChats').addClass('btn-outline-primary');
                $('#iconChats').html('<i class="fa-solid fa-comment fa-2x"></i> ' + chats);
              }
              newMessages = setTimeout(existenMensajes, 30000);

        		}

        	});
        }

        // A $( document ).ready() block.
        $( document ).ready(function() {
          existenMensajes();
        });

        function closeTempos() {
          console.log("Cerramos temporizadores");
          clearTimeout(tempocontacts);
          clearTimeout(tempoChatActive);
          console.log("Temporizadores finalizados");
        }
    </script>

    @yield('scripts')

</body>
<!-- END: Body-->

</html>
