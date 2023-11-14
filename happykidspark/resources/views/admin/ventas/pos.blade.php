@extends('layouts.pos ')

@section('content')

<section>
  <form class="needs-validation" novalidate action="<?php echo url('/'); ?>/admin/ventas/pos" id="formPosSystem" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" class="form-control" value="{{ $caja_id }}" id="txtCajaId" name="caja_id" />

    <input type="hidden" class="form-control" value="0" id="venta_pause_id" name="venta_pause_id" />
    <input type="hidden" class="form-control" value="" id="metodo_pago" name="metodo_pago" />
    <input type="hidden" class="form-control" value="" id="autorizacion" name="autorizacion" />
    <input type="hidden" class="form-control" value="" id="efectivo" name="efectivo" />
    <input type="hidden" class="form-control" value="" id="cambio" name="cambio" />
    <input type="hidden" class="form-control" value="1" id="status_vta" name="status_vta"/>
    <input type="hidden" class="form-control" value="0" id="reserva_id" name="reserva_id"/>

    <div class="row" style="margin-top:10px;">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-1">
              @if(Auth::user()->perfil == 0)
                <a href="{{{ url('/') }}}" class="btn btn-dark   mb-75 waves-effect">
                  <i class="fa-sharp fa-solid fa-home fa-2x"></i>
                </a>
              @endif
            </div>

            <div class="col-md-6">
              <h5> <i class="fa fa-pause"></i> Tickets Pausados</h5>
              @foreach(\App\admin\Ventas::where('status',3)->where('caja_id',$caja_id)->get() as $pause)
                <a href="javscript:void(0)" onclick="traeVentaPausada({{ $pause->id }})" class="btn btn-icon btn-icon round btn-warning waves-effect waves-float waves-light">
                  T-{{ $pause->id }}
                </a>
              @endforeach
            </div>


            <div class="col-md-5" style="text-align:right;">

              <a href="javscript:void(0)" onclick="verReservas()" class="btn btn-success mb-75 waves-effect" title="Ver Reservaciones">
                <i class="fa-solid fa-birthday-cake fa-2x"></i>
              </a>

              <a href="javscript:void(0)" onclick="pausarVenta()" class="btn btn-warning mb-75 waves-effect" title="Colocar en Espera">
                <i class="fa-solid fa-pause-circle fa-2x"></i>
              </a>
              <a href="javscript:void(0)" onclick="movimientos()" class="btn btn-primary mb-75 waves-effect" title="Flujo de Efectivo">
                <i class="fa-solid fa-sack-dollar fa-2x"></i>
              </a>
              <a href="javascript:void(0)" onclick="verVentas()" class="btn btn-info mb-75 waves-effect" title="Ver/Buscar Ventas">
                <i class="fa-solid fa-shopping-cart fa-2x"></i>
              </a>
              <a href="javascript:void(0)" onclick="cerrarCaja()" class="btn btn-danger mb-75 waves-effect" title="Cerrar Caja">
                <i class="fa-solid fa-window-close fa-2x"></i>
              </a>

              <a href="javascript:void(0)" onclick="traeContactos()" class="btn btn-outline-primary mb-75 waves-effect" title="Abrir Chat" id="iconChats">
                <i class="fa-solid fa-comment fa-2x"></i> 3
              </a>

              @if(Auth::user()->perfil != 0)
                <a href="javascript:void(0)" onclick="cerrarSesion()" class="btn btn-dark mb-75 waves-effect" title="Salir del Sistema">
                  <i class="fa-solid fa-sign-out-alt fa-2x"></i>
                </a>
              @endif

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">

      <div class="col-xl-7 col-md-7 col-12" style="height:900px; overflow-y:scroll; border-bottom:1px solid;">

        <div class="row" style="margin-top:10px;">
          <div class="card">
            <div class="card-body">
              <div class="row">

                <div class="col-md-12">
        					<div class="mb-1">
        					 <div class="form-group">
                     <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon-search1">
                          <i class="fa fa-product-hunt fa-lg"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="BUSCAR PRODUCTO O CATEGORIA" name="product_search" id="product_search" value="">
                        <span class="input-group-text" id="basic-addon-search1">
                          &nbsp;&nbsp;
                        </span>
                      </div>
        						<div class="label label-danger">{{ $errors->first("cliente_id") }}</div>
        					 </div>
        					</div>
        				</div>

              </div>
            </div>
          </div>
        </div>
        <div class="row" id="results">

          @foreach($productos as $prods)

          <?php
            if($prods->imagen != "") {
              if(file_exists('uploads/' . $prods->imagen)) {
                $imagen = asset('uploads/' . $prods->imagen);
              } else {
                $imagen = asset('images/slider/04.jpg');
              }

            } else {
              $imagen = asset('images/slider/04.jpg');
            }

          ?>
            <div class="col-xl-3 col-md-3 col-6" title="{{ $prods->nombre }} no-separate" style="box-sizing:none !important; padding-left:40px;"
                @if($prods->tipo == 1)
                  onclick="agregaLinea({{ $prods->id }},'{{ $prods->nombre }}','{{ $prods->precio }}','{{ $prods->tipo }}','{{ $imagen }}')"
                @else
                  @if($prods->tipo == 2 && $sales_timers == 1)
                    onclick="agregaLinea({{ $prods->id }},'{{ $prods->nombre }}','{{ $prods->precio }}','{{ $prods->tipo }}','{{ $imagen }}')"
                  @endif
                @endif
                >
              <div class="card">
                <img class="card-img-top" src="{{ $imagen }}" alt="Card image cap" style="height:150px">
                <div class="card-body" style="height:auto;">
                  <h6 style="height:100px;">
                    {{ $prods->nombre }} </br>
                    <small> <i class="fa fa-sitemap"></i> {{ $prods->categoria->nombre }}</small><br/>
                    @if($prods->tipo == 1)
                      <span class="badge badge-info w-100" style="margin-top:10px;"> $ {{ number_format($prods->precio,0,".",",") }} CLP </span>
                    @else
                      @if($prods->tipo == 2 && $sales_timers == 0)
                        <span class="badge badge-danger w-100" style="margin-top:10px;">AGOTADO<span>
                      @endif

                    @endif
                  </h6>
                </div>
              </div>
            </div>

          @endforeach
        </div>
      </div>

      <div class="col-xl-5 col-md-5 col-12">

        <div class="card">
      		<div class="card-body">
            <div class="row">
              <div class="col-md-12">
      					<div class="mb-1">
      					 <div class="form-group">
                   <div class="input-group mb-2">
                      <span class="input-group-text" id="basic-addon-search1">
                        <i class="fa fa-id-card fa-lg"></i>
                      </span>
                      <input type="text" class="form-control" placeholder="PUBLICO EN GENERAO / BUSCAR CLIENTE" name="cliente_search" id="cliente_search" value="">
                      <span class="input-group-append" id="button-addon2">
                        <button class="btn btn-secondary waves-effect" type="button" onclick="searchCustom();">
                          <i class="fa fa-search fa-lg"></i>
                        </button>
                      </span>
                      <span class="input-group-append" id="button-addon2">
                        <button class="btn btn-primary waves-effect" type="button" onclick="neewCustomForm();">
                          <i class="fa fa-plus fa-lg"></i>
                        </button>
                      </span>
                      <input type="hidden" class="form-control" name="cliente_id" id="cliente_id" value="1">
                    </div>
      						<div class="label label-danger">{{ $errors->first("cliente_id") }}</div>
      					 </div>
      					</div>
      				</div>
            </div>
          </div>
      	</div>


        <div class="card">
      		<div class="card-body">
            <div class="row" style="height:400px; overflow-y:scroll">

              <div id="items"></div>
            </div>
          </div>
      	</div>

        <div class="card">
      		<div class="card-body">
            <div class="row">
              <table class="table table-bordered">
      					<tfoter>
      						<tr>
      							<td style="text-align:right" colspan="3"><h4>Subtotal</h4></td>
      							<td colspan="2">
      								<input type="hidden" class="form-control" id="subtotal" name="subtotal">
      								<span id="lblSubtotal"> $ 0.0</span>
      							</td>
      						</tr>
      						<tr>
      							<td style="text-align:right" colspan="3"><h4>Total</h4></td>
      							<td colspan="2">
      								<input type="hidden" class="form-control" id="total" name="total">
      								<span id="lblTotal"> $ 0.0</span>
      							</td>
      						</tr>
      					</tfoter>
      				</table>
            </div>
      		</div>
          <div class="card-footer">
      			<div class="row">

              <div class="col-md-6" style="padding:1px">
                <button class="btn w-100 btn-primary btn-lg btn-block" type="button" id="btnPagoEfectivo"/> <i class="fa fa-dollar fa-lg"></i> EFECTIVO</button>
              </div>
              <div class="col-md-6" style="padding:1px">
                <button class="btn w-100 btn-info btn-lg btn-block" type="button" id="btnPagoTarjeta"/> <i class="fa fa-credit-card fa-lg"></i> TARJETA</button>
              </div>
              <div class="col-md-6" style="padding:1px">
                <button class="btn w-100 btn-secondary btn-lg btn-block" type="button" id="btnPagoTransferencia"/> <i class="fa fa-bank fa-lg"></i> TRANSFERENCIA</button>
              </div>
              <div class="col-md-6" style="padding:1px">
                <button class="btn w-100 btn-danger btn-lg btn-block" type="button" id="btnCancellSale"/> <i class="fa fa-times-circle fa-lg"></i> CANCELAR</button>
              </div>

              <div class="col-md-12" style="padding:1px">

              </div>
      			</div>
      		</div>
      	</div>
      </div>

    </div>
  </form>
</section>

@endsection


@section('scripts')

<script>

var items           = 0;
var active_item     = 0;
var paymentMethod   = 0;
var selectTimer     = new bootstrap.Modal(document.getElementById('selectTimer'), { backdrop: 'static',keyboard: false });
var modalCaja       = new bootstrap.Modal(document.getElementById('modalCaja'), { backdrop: 'static',keyboard: false });
var modalVentas     = new bootstrap.Modal(document.getElementById('modalVentas'), { backdrop: 'static',keyboard: true });
var modalPrinter    = new bootstrap.Modal(document.getElementById('modalPrinter'), { backdrop: 'static',keyboard: true });
var modalMovs       = new bootstrap.Modal(document.getElementById('modalMovs'), { backdrop: 'static',keyboard: true });
var neewCustom      = new bootstrap.Modal(document.getElementById('neewCustom'), { backdrop: 'static',keyboard: true });
var metodoPago      = new bootstrap.Modal(document.getElementById('metodoPago'), { backdrop: 'static',keyboard: true });
var validaCodigo    = new bootstrap.Modal(document.getElementById('validaCodigo'), { backdrop: 'static',keyboard: true });
var modalReservas   = new bootstrap.Modal(document.getElementById('modalReservas'), { backdrop: 'static',keyboard: true });
var modalListMovs   = new bootstrap.Modal(document.getElementById('modalListMovs'), { backdrop: 'static',keyboard: true });
var ingresantes     = 0;
var ingRegistrados  = 0;
var temporizadores  = 0;
var cancela_vta_id  = 0;
var movCaja         = 0;
var banda_id        = 0;
var banda_rgb       = 0;
var banda_next      = 0;
var banda_serie     = "";
var banda_usadas    = 0;
var banda_unidades  = 0;
var banda_folioact  = 0;

$('#bandas_id').on('change',function(){

  var cantidad_requerida = parseInt($('#txtTimersGenerator').val());

  if(isNaN(cantidad_requerida)) { cantidad_requerida = 0; }

  $.ajax({
		url: "<?php echo url('admin/bandas/ajax/'); ?>/" + $(this).val(),
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {

			if(json['error'] == 0) {

        banda_id        = json['data'].id;
        banda_rgb       = json['data'].rgb;
        banda_next      = json['data'].actual;
        banda_serie     = json['data'].serie;
        banda_usadas    = json['data'].usadas;
        banda_unidades  = json['data'].unidades;

        var quedaran = cantidad_requerida + banda_usadas;

        if(quedaran < banda_unidades) {
          $('#btnRegistaTemporizador').removeAttr('disabled');
        } else {
          Swal.fire({
            title: ' ¡ ATENCION !',
            text: "La cantidad requerida es mayor a las bandas en inventario " + banda_unidades + ", solicite una actualizacion o seleccione otras bandas disponibles",
            icon: 'warning',
            customClass: {
              confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
          });
        }

			}

		}

	});

});

$('#cronometro_tiempo_id').on('change',function(){

  $.ajax({
		url: "<?php echo url('admin/tiempos/ajax/'); ?>/" + $(this).val(),
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {

			if(json['error'] == 0) {

        var costo = parseFloat(json['data'].costo);

        $('#lblPrecio_' + active_item).html('$ ' + costo.toFixed(0));
        $('#precio_' + active_item).val(costo.toFixed(0));

        calculaImporte(active_item);
			}

		}

	});

});

$('#btnCancellSale').on('click',function(){

  var subtotal = parseFloat($('#subtotal').val());

  if(isNaN(subtotal)) {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar minimo un producto para procesar la venta",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }


  if($('#venta_pause_id').val() != "0") {
    //Hay una venta pausada
    var pausa_id = $('#venta_pause_id').val();
    $('#venta_pause_id').val("0");
    $('#subtotal').val('0');
    $('#impuestos').val('0');
    $('#total').val('0');
    cancelaVenta(pausa_id);
  } else {

    Swal.fire({
      title: 'Cancelar Venta',
      text: "Se eliminaran todos los productos a venta, ¿ Desea continuar ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si',
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-outline-danger ms-1'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {
        $('.items_rows').remove();
        $('#subtotal').val('0');
        $('#impuestos').val('0');
        $('#total').val('0');
        $('#venta_pause_id').val('0');
        $('#reserva_id').val('0');
        $('#status_vta').val('1');

        $('#lblSubtotal').html('$ 0.0');
        $('#lblIva').html('$ 0.0');
        $('#lblTotal').html('$ 0.0');
        $('#btnSubmitVenta').attr('disabled','disabled');

        $('#btnPagoEfectivo').removeAttr('disabled');
        $('#btnPagoTarjeta').removeAttr('disabled');

        $('#timersGenerator').fadeOut('fast');
        $('#timerCounters').fadeIn('fast');

        items           = 0;
        active_item     = 0;
        paymentMethod   = 0;
        ingresantes     = 0;
        ingRegistrados  = 0;
        temporizadores  = 0;
        banda_id        = 0;
        banda_rgb       = 0;
        banda_next      = 0;

      }
    });

  }

});

$('#btnSubmitVenta').on('click',function(){

  if(items <=0) {

    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar al menos un producto para vender",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  $('#formPosSystem').submit();


});

$('#product_search').keyup(function() {

  // Retrieve the input field text and reset the count to zero
  var filter = $(this).val(),
    count = 0;

  // Loop through the comment list
  $('#results div').each(function() {


    // If the list item does not contain the text phrase fade it out
    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
      $(this).hide();  // MY CHANGE

      // Show the list item if the phrase matches and increase the count by 1
    } else {
      $(this).show(); // MY CHANGE
      count++;
    }

  });

});

$('#btnPagoEfectivo').on('click',function(){

  var subtotal = parseFloat($('#subtotal').val());

  if(isNaN(subtotal)) {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar minimo un producto para procesar la venta",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  $('#txtPaymentSubtotal').val(subtotal.toFixed(0));

  $('#paymentEfectivo').fadeIn('fast');
  $('#paymentAutorizacion').fadeOut('fast');
  paymentMethod = 'Efectivo';
  metodoPago.show();

});

$('#btnPagoTarjeta').on('click',function(){

  var subtotal = parseFloat($('#subtotal').val());

  if(isNaN(subtotal)) {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar minimo un producto para procesar la venta",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  $('#paymentEfectivo').fadeOut('fast');
  $('#paymentAutorizacion').fadeIn('fast');

  $('#cmbTipoTarjeta').fadeIn('fast');
  paymentMethod = 'Tarjeta ';
  metodoPago.show();
});

$('#btnPagoTransferencia').on('click',function(){

  var subtotal = parseFloat($('#subtotal').val());

  if(isNaN(subtotal)) {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar minimo un producto para procesar la venta",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  $('#paymentEfectivo').fadeOut('fast');
  $('#paymentAutorizacion').fadeIn('fast');
  $('#cmbTipoTarjeta').fadeOut('fast');
  paymentMethod = 'Transferencia';
  metodoPago.show();
});

$('#txtPaymentEfectivo').on('keydown',function(e){
  calculaCambio();
  if(e.which == 13) {
    procesaVenta();
  }

});

$('#txtPaymentEfectivo').on('keyup',function(e){
  calculaCambio();

});

$('#txtCodeVerification').on('keyup',function(e){
  if(e.which == 13) {
    verificaCodigoCancelacion();
  }
});

$('#txtCodeVerification').on('keydown',function(e){
  if(e.which == 13) {
    verificaCodigoCancelacion();
  }
});

$('#cronometro_nombre').on('keydown',function(e){
  if(e.which == 13) {
    aplicaCronometro();
  }
});

$('#cronometro_banda').on('keydown',function(e){
  if(e.which == 13) {
    aplicaCronometro();
  }
});


$('#cmbPaylmentTdc').on('change',function(){

  paymentMethod = 'Tarjeta ' + $(this).val()
});

$('#btnTimerClose').on('click',function(){

  Swal.fire({
    title: 'Cancelar',
    text: "Se cancelara el registro de este producto, ¿ Desea continuar ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si Cancelar',
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-outline-danger ms-1'
    },
    buttonsStyling: false
  }).then(function (result) {
    if (result.value) {
      selectTimer.hide();

      $('#timersGenerator').fadeOut('fast');
      $('#timerCounters').fadeIn('fast');

      ingresantes     = 0;
      ingRegistrados  = 0;
      temporizadores  = 0;
      banda_id        = 0;
      banda_rgb       = 0;
      banda_next      = 0;
      $('#item_vta_' + active_item).remove();
      items = items -1;
      calculaTotales()

    }
  });

});

$('#txtPaymentAutorizacion').on('keydown',function(e){
  if(e.which == 13) {
    procesaVenta();
  }
});

$('#txtInicialCajaCaptura').on('keydown',function(e){
  if(e.which == 13) {
    aplicaMovCaja();
  }
});

function verReservas() {
  modalReservas.show();
}

function calculaCambio() {

  var totalPagar    = parseFloat($('#txtPaymentSubtotal').val());
  var totalEfectivo = parseFloat($('#txtPaymentEfectivo').val());

  var cambio = totalEfectivo - totalPagar;

  $('#txtPamentCambio').val(cambio.toFixed(0));

  if(cambio >= 0) {
    $('#btnProcesarVenta').fadeIn('fast');
  } else {
    $('#btnProcesarVenta').fadeOut('fast');
  }

}

function seleccionarReserva(id) {

  $.ajax({
    url: "<?php echo url('admin/reservaciones/ajax/'); ?>/" + id,
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function(json) {

      if(json['error'] == 0) {

        var total = parseFloat(json['total']);

        //reseteamos todo
        $('.items_rows').remove();
        $('#subtotal').val('0');
        $('#impuestos').val('0');
        $('#total').val('0');

        $('#lblSubtotal').html('$ 0.0');
        $('#lblIva').html('$ 0.0');
        $('#lblTotal').html('$ 0.0');
        $('#btnSubmitVenta').attr('disabled','disabled');
        $('#reserva_id').val(id);
        $('#items').before(json['html']);
        temporizadores = json['temporizadores'];
        items          = json['items'];

        $('#btnPagoEfectivo').attr('disabled','disabled');
        $('#btnPagoTarjeta').attr('disabled','disabled');

        $('#subtotal').val(total.toFixed(0));
      	$('#impuestos').val("0");
      	$('#total').val(total.toFixed(0));

      	$('#lblSubtotal').html(total.toFixed(0));
      	$('#lblIva').html("0");
      	$('#lblTotal').html(total.toFixed(0));

        $('#cliente_id').val(json['data'].cliente_id);
        $('#cliente_search').val(json['cte_nombre']);

        modalReservas.hide();
      } else {
        Swal.fire({
          title: ' ¡ ATENCION !',
          text: json['msg'],
          icon: 'warning',
          customClass: {
            confirmButton: 'btn btn-danger'
          },
          buttonsStyling: false
        });
      }

    }

  });

}

function agregaLinea(id,descripcion,precio,tipo,imagen) {

  var precio_nego = parseFloat(precio);

  if(isNaN(precio_nego)) { precio_nego = 0; };

  var html = '<div class="row items_rows" id="item_vta_' + items + '">';
        html += '<div class="col-md-2 sepate-line">';
          html += '<img src="' + imagen +'" class="rounded" width="70" height="60" alt="Avatar">';
        html += '</div>';
        html += '<div class="col-md-8 sepate-line">';
          html += descripcion + ' <span class="badge badge-primary" id="lblPrecio_' + items + '">$ ' + precio_nego.toFixed(0) + '</span> <br/>';
          html += '<input type="hidden" class="form-control" name="vendido[' + items + '][producto_id]" value="' + id + '" />';
          html += '<input type="hidden" class="form-control" name="vendido[' + items + '][tipo]" value="' + tipo + '" />';
          html += '<input type="hidden" class="form-control importes" name="vendido[' + items + '][importe]" id="importe_' + items + '" value="' + precio_nego + '" />';
          html += '<input type="hidden" class="form-control" name="vendido[' + items + '][precio]" id="precio_' + items + '" value="' + precio_nego + '" />';
          html += '<small id="tempo_detail_' + items + '"></small><br/>';

          if(tipo == 1) {
            html += '<div class="input-group input-group-lg">';
                html += '<input type="number" min="1" class="touchspin form-control" name="vendido[' + items + '][cantidad]" id="cantidad_' + items + '" value="1" onchange="calculaImporte(' + items + ')">';
            html += '</div>';
          } else {
            html += '<input type="hidden" class="form-control" readonly name="vendido[' + items + '][cantidad]" id="cantidad_' + items + '" value="1" onchange="calculaImporte(' + items + ')">';
          }
        html += '</div>';
        html += '<div class="col-md-2 sepate-right">';
          html += '<button  onclick="removeItem(' + items + ');" style="background:none !important; border:0px !important; color: #ea5455 !important;" class="btn btn-danger waves-effect waves-float waves-light" type="button"/>';
           html += '<i class="fa fa-times-circle fa-2x "></i>';
          html += '</button>';
        html += '</div>';
      html += '</div>';

  $('#items').before(html);

  $('.touchspin').TouchSpin({
    buttondown_class: 'btn btn-primary',
    buttonup_class: 'btn btn-primary',
    buttondown_txt: feather.icons['minus'].toSvg(),
    buttonup_txt: feather.icons['plus'].toSvg()
  });

  calculaImporte(items);

  if(tipo == 2) {
    active_item = items;
    selectTimer.show();
  }

  items++;
  $('#btnSubmitVenta').removeAttr('disabled');
}

function removeItem(index) {

  Swal.fire({
    title: 'Cancelar producto',
    text: "Se eliminara el producto de esta venta, ¿ Desea continuar ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si',
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-outline-danger ms-1'
    },
    buttonsStyling: false
  }).then(function (result) {
    if (result.value) {
      $('#item_vta_' + index).remove();
      items = items -1;
      calculaTotales()
    }
  });

}

function cerrarSesion() {
  Swal.fire({
    title: 'Cerrar Sesion',
    text: "Esta a punto de salir del sistema, se cerrara la sesion, ¿ Desea continuar ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si',
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-outline-danger ms-1'
    },
    buttonsStyling: false
  }).then(function (result) {
    if (result.value) {
      location = "{{ url('logout') }}";
    }
  });
}

function calculaTotales() {

	var importes 		= 0;
	var subtotal 		= 0;
	var iva 				= 0;
	var total 			= 0;
	var porcentaje	= parseFloat({{ (int)\App\admin\Configuracion::getConfig()->iva }});
	var valor_iva 	= 0;
	var valor_div		= parseFloat( '1.' + {{ (int)\App\admin\Configuracion::getConfig()->iva }});

	if(isNaN(porcentaje)) {

		porcentaje = 0;
		valor_iva  = 0;

	} else {
		valor_iva  = porcentaje / 100;
	}

	$('.importes').each(function() {

		importes = parseFloat($(this).val());

		if(isNaN(importes)) { importes = 0; }
		subtotal = subtotal + importes

	});

	<?php if(\App\admin\Configuracion::getConfig()->aplicacion_iva == 1) { ?>
		iva = subtotal * valor_iva;
		total = subtotal + iva;
	<?php } else { ?>

		var valor_siniva = subtotal / valor_div;
		iva = subtotal - valor_siniva;
		total = subtotal;
		subtotal = valor_siniva;
	<?php } ?>

	$('#subtotal').val(subtotal.toFixed(0));
	$('#impuestos').val("0");
	$('#total').val(subtotal.toFixed(0));

	$('#lblSubtotal').html(subtotal.toFixed(0));
	$('#lblIva').html("0");
	$('#lblTotal').html(subtotal.toFixed(0));

}

function calculaImporte(index) {

	var cantidad = parseFloat($('#cantidad_' + index).val());
	var precio = parseFloat($('#precio_' + index).val());

	if(isNaN(cantidad)) { cantidad = 0; }
	if(isNaN(precio)) { precio = 0; }

	var importe = cantidad * precio;

	$('#importe_' + index).val(importe.toFixed(0));
	calculaTotales();

}

function aplicaCronometro() {

  if($('#cronometro_nombre').val() == "") {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar el nombre de la persona que ingresara al juego",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  if($('#cronometro_banda').val() == "") {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar el codigo de barras de la banda a utilizar en el juego",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }


  $.ajax({
    url: "<?php echo url('admin/bandas/existencias/'); ?>/" + banda_id + "?siguiente=" + $('#cronometro_banda').val(),
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function(json) {

      if(json['error'] == 0) {

        if(banda_folioact < (banda_next + ingresantes)) {

          banda_folioact = (banda_next + ingresantes);
          var html  = '<input type="hidden" class="form-control" name="vendido[' + active_item + '][temporizadores][' + temporizadores + '][tiempo_id]" value="' + $('#cronometro_tiempo_id').val() + '" />';
              html += '<input type="hidden" class="form-control" name="vendido[' + active_item + '][temporizadores][' + temporizadores + '][nombre]" value="' + $('#cronometro_nombre').val() + '" />';
              html += '<input type="hidden" class="form-control" name="vendido[' + active_item + '][temporizadores][' + temporizadores + '][telefono]" value="' + $('#cronometro_telefono').val() + '" />';
              html += '<input type="hidden" class="form-control" name="vendido[' + active_item + '][temporizadores][' + temporizadores + '][banda_id]" value="' + banda_id + '" />';
              html += '<input type="hidden" class="form-control" name="vendido[' + active_item + '][temporizadores][' + temporizadores + '][banda_cantidad]" value="1" />';
              html += '<input type="hidden" class="form-control" name="vendido[' + active_item + '][temporizadores][' + temporizadores + '][banda_consecutivo]" value="' +  $('#cronometro_banda').val()  + '" />';
          $('#active_item' + active_item).val($('#cronometro_tiempo_id').attr('data-precio'));

          var htmlName  = $('#cronometro_nombre').val() + ' ' + $('#cronometro_tiempo_id option:selected').text() + '<br/>';
          htmlName += '<i class="fa fa-ring fa-lg" style="color: ' + banda_rgb + '"></i>' + $('#cronometro_banda').val() + '<br/>';

          $('#tempo_detail_' + active_item).before(html + '<br/> ' + htmlName);

          $('#cantidad_' + active_item).val(ingresantes);


          $('#cronometro_nombre').val('');
          $('#cronometro_telefono').val('');
          $('#cronometro_banda').val('');

          temporizadores++;
          ingRegistrados++;

          calculaImporte(active_item);
          //$('#closeTimer').trigger('click');
          if(ingRegistrados >= ingresantes) {
            ingRegistrados=0;
            selectTimer.hide();
            $('#timerCounters').fadeIn('fast');
            $('#timersGenerator').fadeOut('fast');
            $('#txtTimersGenerator').val("");
          }




          banda_next = banda_next+1;
          //$('#cronometro_banda').val(banda_serie + '' + banda_next);

        } else {

          Swal.fire({
            title: ' ¡ ATENCION !',
            text: "El numero de serie de la banda ya ha sido usado en un juego previo asignado a esta venta, no se puede volver a usar",
            icon: 'warning',
            customClass: {
              confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
          });

        }

      } else {

        Swal.fire({
          title: ' ¡ ATENCION !',
          text: "El numero de serie de la banda ya ha sido usado",
          icon: 'warning',
          customClass: {
            confirmButton: 'btn btn-danger'
          },
          buttonsStyling: false
        });

      }

    }

  });

}

function procesaVenta() {

  if(items <=0) {

    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar al menos un producto para vender",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  $('#metodo_pago').val(paymentMethod);
  $('#tipo_tarjeta').val($('#cmbPaylmentTdc').val());
  $('#autorizacion').val($('#txtPaymentAutorizacion').val());
  $('#efectivo').val($('#txtPaymentEfectivo').val());
  $('#cambio').val($('#txtPamentCambio').val());

  $('#formPosSystem').submit();

}

function aplicaMovCaja() {

  if( movCaja == 1 && $('#txtInicialCajaCaptura').val() == "") {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar el monto inicial con el cual apertura la caja",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  if( movCaja == 2 && $('#txtFinalCajaCaptura').val() == "") {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar el monto final con el cual cierra la caja",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  $.ajax({
    url: "<?php echo url('admin/cajas/ajax/'); ?>/" + $('#txtCajaId').val() + "/?inicial=" + $('#txtInicialCajaCaptura').val() + "&final=" + $('#txtFinalCajaCaptura').val(),
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function(json) {

      if(json['error'] == 0) {
        if( movCaja == 1) {
          $('#txtCajaId').val(json['data'].id);
          modalCaja.hide();
        } else if ( movCaja == 2) {

          if(json['msg'] != "") {
            Swal.fire({
              title: ' ¡ ATENCION !',
              text: json['msg'],
              icon: 'warning',
              customClass: {
                confirmButton: 'btn btn-danger'
              },
              buttonsStyling: false
            });
          }
          //Abrimos el reporte de caja antes de recargar
          var win = window.open("{{ url('admin/cajas/printer/') }}/" + $('#txtCajaId').val(), '_blank');
          // Cambiar el foco al nuevo tab (punto opcional)
          win.focus()
          location.reload();
        }
        movCaja = 0;
      }

    }

  });

}

function verVentas() {
  $.ajax({
    url: "{{ url('admin/ventas/misventas') }}/" + $('#txtCajaId').val(),
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function(json) {
      if(json['error'] == 0) {
        modalVentas.show();
        $('#vtasHtmlContent').html(json['html']);
      }else {
        Swal.fire({
          title: ' ¡ ATENCION !',
          text: "No se encontraron ventas registradas en este momento",
          icon: 'warning',
          customClass: {
            confirmButton: 'btn btn-danger'
          },
          buttonsStyling: false
        });
      }
    }

  });
}

function reimprime(id) {
  modalVentas.hide();
  var urlPrinter = "{{ url('admin/ventas/voucher') }}/" + id;

  $('#iframePrinter').attr('src',urlPrinter);
  modalPrinter.show();
}

function reimprimeQr(id) {
  modalVentas.hide();
  var urlPrinter = "{{ url('admin/ventas/qrcode') }}/" + id;

  $('#iframePrinter').attr('src',urlPrinter);
  modalPrinter.show();
}

function cerrarCaja() {
  movCaja     = 2;

  @if($forza_cierre == 1)
  $('#btnCajaClose').fadeOut('fast');
  @else
  $('#btnCajaClose').fadeIn('fast');
  @endif
  $('#btnCajaMovimientos').removeClass('btn-success');
  $('#btnCajaMovimientos').addClass('btn-danger');
  $('#btnCajaMovimientos').html('CERRAR CAJA');
  $('#contentAperturaCaja').fadeOut('fast');
  $('#contentCierreCaja').fadeIn('fast');
  $('#txtMontoCajaCaptura').attr('readonly');
  modalCaja.show();
}

function movimientos() {

  modalMovs.show();
}

function neewCustomForm() {
  $('#btnSaveCustom').fadeIn('fast');
  $('#frmCustoms').fadeIn('fast');
  $('#listCustom').fadeOut('fast');
  neewCustom.show();
}

function guardaMovimiento() {

  if($('#monto_movimiento').val() == "") {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar el tipo de movimiento para continuar",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  if($('#monto_movimiento').val() == "") {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar el monto del movimiento para continuar",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  if($('#concepto_movimiento').val() == "") {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar concepto del movimiento para continuar",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  var parametros = '?caja_id={{ $caja_id }}';
      parametros += '&tipo=' + $('#tipo_movimiento').val();
      parametros += '&monto=' + $('#monto_movimiento').val();
      parametros += '&concepto=' + $('#concepto_movimiento').val();
      parametros += '&code_auth=' + $('#txtCodigoAutorizacionEfectivo').val();


  $.ajax({
		url: "{{ url('admin/efectivo/save') }}" + parametros,
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {
			if(json['error'] == 0) {
        Swal.fire({
          title: ' ¡ EXITO !',
          text: "El Movimiento se ha guardado exitosamente ",
          icon: 'success',
          customClass: {
            confirmButton: 'btn btn-danger'
          },
          buttonsStyling: false
        });

        $('#txtCodigoAutorizacionEfectivo').val("");
        $('#tipo_movimiento').val("");
        $('#monto_movimiento').val("");
        $('#concepto_movimiento').val("");

			} else {
        Swal.fire({
          title: ' ¡ ERROR !',
          text: json['msg'],
          icon: 'warning',
          customClass: {
            confirmButton: 'btn btn-danger'
          },
          buttonsStyling: false
        });
      }
		}

	});

}

function searchCustom() {

  if($('#cliente_search').val() == "") {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar un nombre, apellido o telefono del cliente a buscar",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }
  $('#listCustom').fadeIn('fast');
  $('#btnSaveCustom').fadeOut('fast');
  $('#frmCustoms').fadeOut('fast');
  $.ajax({
		url: "<?php echo url('admin/clientes/autocomplete'); ?>/?search=" + $('#cliente_search').val(),
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {

			if(json['error'] == 0) {
				$('#customList').html(json['html']);
        neewCustom.show();
			}

		}

	});

}

function guardarSeleccionar() {

  if($('#nombre').val() == "") {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar un nombre y apellido del cliente",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  if($('#celular').val() == "") {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar el numero de celular para continuar",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  var parametros = '?nombre=' + $('#nombre').val();;
      parametros += '&telefono=' + $('#telefono').val();
      parametros += '&celular=' + $('#celular').val();
      parametros += '&direccion=' + $('#direccion').val();

  $.ajax({
		url: "{{ url('admin/clientes/ajaxsave') }}" + parametros,
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {
			if(json['error'] == 0) {
        $('#cliente_search').val(json['data'].nombre);
        $('#cliente_id').val(json['data'].id);
        neewCustom.hide();

			}
		}

	});

  $('#nombre').val("");
  $('#telefono').val("");
  $('#celular').val("");
  $('#direccion').val("");


}

function selectCustom(id, nombre) {
  $('#cliente_search').val(nombre);
  $('#cliente_id').val(id);
  neewCustom.hide();
}

function pausarVenta() {

  if(items <=0) {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar al menos un producto para vender",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  Swal.fire({
    title: 'Pausar Venta',
    text: "La venta se procesara pendiente de pago, ¿ Desea continuar ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si',
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-outline-danger ms-1'
    },
    buttonsStyling: false
  }).then(function (result) {
    if (result.value) {
      $('#status_vta').val("3");
      $('#formPosSystem').submit();
    }
  });


}

function cancelaVenta(id) {

  Swal.fire({
    title: 'Cancelar Venta',
    text: "La venta sera cancelada de forma permanente, no se podra reactivar,  ¿ Desea continuar ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si',
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-outline-danger ms-1'
    },
    buttonsStyling: false
  }).then(function (result) {
    if (result.value) {
      cancela_vta_id = id;
      validaCodigo.show();
    }
  });


}

function verificaCodigoCancelacion() {
  $.ajax({
    url: "{{ url('admin/codigos/ajax/') }}/" + $('#txtCodeVerification').val(),
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function(json) {

      if(json['error'] == 0) {

        $.ajax({
          url: "{{ url('admin/ventas/bajAjax') }}/" + cancela_vta_id + '?code_id=' + json['code_id'],
          dataType: 'json',
          contentType: "application/json; charset=utf-8",
          success: function(json) {

            if(json['error'] == 0) {

              Swal.fire({
                title: ' ¡ EXITO !',
                text: "La venta ha sido cancelada exitosamente",
                icon: 'success',
                customClass: {
                  confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
              });
              location.reload();
              /*$('#btnPagoEfectivo').removeAttr('disabled');
              $('#btnPagoTarjeta').removeAttr('disabled');
              verVentas();
              validaCodigo.hide();
              $('#txtCodeVerification').val('');
              */

            } else {

              Swal.fire({
                title: ' ¡ ERROR !',
                text: json['msg'],
                icon: 'danger',
                customClass: {
                  confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
              });


            }

          }

        });

      } else {

        Swal.fire({
          title: ' ¡ ERROR !',
          text: json['msg'],
          icon: 'danger',
          customClass: {
            confirmButton: 'btn btn-danger'
          },
          buttonsStyling: false
        });


      }

    }

  });
}

function registraIngresantes() {

  var cantidad = parseInt($('#txtTimersGenerator').val());
  var telefono = parseInt($('#cronometro_telefono').val());

  if($('#txtTimersGenerator').val() == "") {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar la cantida de personas a utilizar el juego",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  if(isNaN(cantidad)) {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "El valor especificado en la cantidad no es correco, debe especificar un numero de personas",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  if(isNaN(telefono)) {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "El valor especificado en telefono no es correco, debe especificar un numero telefonico en digitos",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }


  if($('#cronometro_tiempo_id').val() == "") {
    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar al tiempo que se utilziara el juego",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;
  }

  var cantidad = parseInt($('#txtTimersGenerator').val());
  ingresantes     = cantidad;
  //$('#cronometro_banda').val(banda_serie + '' + banda_next);
  $('#timersGenerator').fadeIn('fast');
  $('#timerCounters').fadeOut('fast');


}

function traeVentaPausada(id) {

  Swal.fire({
    title: 'Continuar Venta',
    text: "La venta seleccionada est en pausa, ¿ Desea retomarla para finalizar ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si',
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-outline-danger ms-1'
    },
    buttonsStyling: false
  }).then(function (result) {
    if (result.value) {

      //reseteamos todo
      $('.items_rows').remove();
      $('#subtotal').val('0');
      $('#impuestos').val('0');
      $('#total').val('0');

      $('#lblSubtotal').html('$ 0.0');
      $('#lblIva').html('$ 0.0');
      $('#lblTotal').html('$ 0.0');
      $('#btnSubmitVenta').attr('disabled','disabled');

      //traemos la venta

      $.ajax({
    		url: "<?php echo url('admin/ventas/ajax/'); ?>/" +id,
    		dataType: 'json',
    		contentType: "application/json; charset=utf-8",
    		success: function(json) {

    			if(json['error'] == 0) {

            var subtotal = parseFloat(json['data'].subtotal);
            var total = parseFloat(json['data'].total);

            if(isNaN(subtotal)) { subtotal = 0; }
            if(isNaN(total)) { total = 0; }

            $('#venta_pause_id').val(json['data'].id);
            $('#items').before(json['html']);
            temporizadores = json['temporizadores'];
            items          = json['items'];

            $('#subtotal').val(subtotal.toFixed(0));
          	$('#impuestos').val("0");
          	$('#total').val(total.toFixed(0));

          	$('#lblSubtotal').html(subtotal.toFixed(0));
          	$('#lblIva').html("0");
          	$('#lblTotal').html(subtotal.toFixed(0));

            modalVentas.hide();
            $('.touchspin').TouchSpin({
              buttondown_class: 'btn btn-primary',
              buttonup_class: 'btn btn-primary',
              buttondown_txt: feather.icons['minus'].toSvg(),
              buttonup_txt: feather.icons['plus'].toSvg()
            });
    			}

    		}

    	});

    }
  });

}

function listarMovimiento() {

  $.ajax({
		url: "{{ url('admin/efectivo/ajax/' . $caja_id) }}/",
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {

			if(json['error'] == 0) {
        modalMovs.hide();
        $('#itemsMovs').html(json['html']);
        modalListMovs.show();

			}

		}

	});

}

@if($caja_id == 0)
  movCaja     = 1;
  $('#btnCajaClose').fadeOut('fast');
  modalCaja.show();
@else

@if($forza_cierre == 1)
  cerrarCaja();
@endif

@endif

@if(Session::has('ticket_id'))
  reimprime({{ Session::get('ticket_id') }});
@endif


</script>
@endsection
