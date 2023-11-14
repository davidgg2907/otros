@extends('layouts.app')

@section('content')
<?php
use Carbon\Carbon;
$cDate = Carbon::parse($data->fecha_ingreso);

$days = Carbon::parse(Carbon::now())->diffInDays(date('Y-m-d H:i:s',strtotime($data->fecha_ingreso)));

?>
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
  <form action="<?php echo url('admin/urgencias/servicios/'); ?>" id="formValidation" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-12">
      <div class="white-box">

          <div class="pull-left">
            <a href="{{{ $config['cancelar'] }}}" class="btn btn-danger">
              <i class="fa fa-times fa-2x"></i><br/>Cancelar
            </a>
          </div>
          <div class="pull-right">

            <?php if(Auth::user()->permisos->editRecord == 1) { ?>
              <?php if($data->status == 1) { ?>
                <button type="submit" class="btn btn-success">
                  <i class="fa fa-check fa-2x"></i><br/>Guardar
                </button>
              <?php } ?>
            <?php } ?>

            <?php if($data->total > 0) { ?>
              <?php if($data->status == 1) { ?>
                <button type="button" class="btn btn-info" id="btnAbonar">
                  <i class="fa fa-credit-card fa-2x"></i><br/>Abonar
                </button>
              <?php } ?>
            <?php } ?>
          </div>

          <div class="clear"></div>

      </div>
    </div>

    <input type="hidden" class="form-control" name="urgencia_id" value="{{ $data->id }}" />

    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">Datos de Ingreso</div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">

              <div class="row text-center m-t-10">
                <div class="col-md-6"><strong>Paciente</strong>
                    <p>{{ $data->paciente }}</p>
                </div>

                <div class="col-md-6"><strong>Medico</strong>
                    <p>{{ $data->medico->nombre }}</p>
                </div>

              </div>
              <!-- /.row -->
              <hr>

              <div class="row text-center m-t-10">
                <div class="col-md-4"><strong>Edad</strong>
                    <p>{{ $data->edade }}</p>
                </div>

                <div class="col-md-4"><strong>Peso</strong>
                    <p>{{ $data->peso }} Kg.</p>
                </div>

                <div class="col-md-4"><strong>Talla</strong>
                    <p>{{ $data->tall }} Mts.</p>
                </div>

              </div>
              <!-- /.row -->
              <hr>
            </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">Datos de Ingreso</div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">

              <div class="row">
                <div class="col-md-8 text-right"><h3> SUBTOTAL </h3></small></div>
                <div class="col-md-4" id="lblSubtotal">{{ $data->subtotal != "" ? number_format($data->subtotal,2,'.',',') : 0.0 }}</div>
                <input type="hidden" name="subtotal" id="subtotal" value="{{ $data->subtotal != "" ? $data->subtotal : old('subtotal') }}" />
              </div>

              <div class="row">
                <div class="col-md-12"> <br/></div>
              </div>

              <div class="row">
                <div class="col-md-8 text-right"><h3> I.V.A. </h3></div>
                <div class="col-md-4" id="lblIva">{{ $data->iva != "" ? number_format($data->iva,2,'.',',') : 0.0 }}</div>
                <input type="hidden" name="iva" id="iva" value="{{ $data->iva != "" ? $data->iva : old('iva') }}" />
              </div>

              <div class="row">
                <div class="col-md-12"> <br/> </div>
              </div>

              <div class="row">
                <div class="col-md-8 text-right"><h3> TOTAL </h3></div>
                <div class="col-md-4" id="lblTotal">{{ $data->total != "" ? number_format($data->total,2,'.',',') : 0.0 }}</div>
                <input type="hidden" name="total" id="total" value="{{ $data->total != "" ? $data->total : old('total') }}" />
              </div>

              <hr>

            </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <div class="pull-left">
            <h5 class="text-success">Saldo Pagado: {{ number_format($data->pagado,2,".",",") }}</h5>
          </div>
          <div class="pull-right">
            <h5 class="text-info">Saldo Pendiente:
              <span id="lblPendiente">
                <?php

                  if($data->pendiente > 0) {
                    echo number_format($data->pendiente,2,".",",");
                  } else {
                    echo number_format($data->total,2,".",",");
                  }
                ?>
              </span>
            </h5>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Agregar/Quitar Servicio</div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
         					<label for="listaprecios" class="control-label"> Filtrar servicios por fecha </label>

                  <div class="input-group m-t-10">
         						<span class="input-group-addon"> Desde </span>
         						<input type="text" class="form-control dates" id="fecha_desde"/>
         						<span class="input-group-addon"> Hasta</span>
         						<input type="text" class="form-control dates" id="fecha_hasta"/>
                    <span class="input-group-btn">
                      <button onclick="filtrarServicios()" type="button" class="btn waves-effect waves-light btn-info"><i class="fa fa-calendar"></i> Filtrar</button>
                    </span>

         					</div>
         					<div class="label label-danger">{{ $errors->first("num_cereales") }}</div>
         				 </div>
                </div>
              </div>

              <div class="row">
                <div class="table-responsive">
                  <table class="table table-striped color-table inverse-table">
                    <thead>
                      <tr>
                        <th></th>
                        <th>F. Servicio</th>
                        <th>Concepto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Importe</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $items = 0; ?>
                      <tr>
                        <td></td>
                        <td></td>
                        <td style="width:50%">


                          <select name="" id="concepto_id" class="form-control select2" >
                            <option value="">[ - SELECCIONE - ]</option>
                            <option value="0">[ - CAPTURA MANUAL - ]</option>
                            <?php foreach($productos as $value) { ?>
                              <option value="<?php echo $value->id; ?>"> <?php echo $value->descripcion; ?></option>
                            <?php } ?>
                          </select>
                          <div class="input-group" id="capturaManual" style="display:none">
                            <input type="text" name="" id="concepto" class="form-control" value=""/>
                            <span class="input-group-addon">I.V.A.</span>
                            <select id="excento" class="form-control" >
                              <option value="1">SI</option>
                              <option value="0">NO</option>
                            </select>
                            <span class="input-group-btn">
                              <button onclick="cierraManual()" type="button" class="btn waves-effect waves-light btn-danger"><i class="fa fa-times-circle fa-lg"></i></button>
                            </span>
                					</div>
                        </td>
                        <td style="width:10%">
                          <input type="text" name="" id="cantidad" class="form-control" value=""/>
                        </td>
                        <td style="width:10%">
                          <input type="text" name="" id="precio" class="form-control" value=""/>
                        </td>
                        <td style="width:10%">
                          <input type="text" name="" id="importe" class="form-control" value="" readonly/>
                          <input type="hidden" name="" id="iva_importe" class="form-control" value=""/>
                        </td>
                        <td style="width:10%">
                          <?php if(Auth::user()->permisos->editRecord == 1) { ?>
                            <button class="btn btn-primary btn-circle" id="btnAddItem" onclick="agregaServicio()" type="button">
                              <li class="fa fa-plus fa-lg"></li>
                            </button>
                          <?php } ?>
                        </td>
                      </tr>
                      <?php $items = 0; ?>
                      <?php foreach($servicios as $value) { ?>
                        <tr id="items_<?php echo $items; ?>" class="filtrados fecha_{{ date('d-m-Y',strtotime($value->fecha_servicio)) }}">
                          <td>
                            <?php if($value->status == 1) { ?>

                              <?php if(Auth::user()->permisos->editRecord == 1) { ?>
                                <input type="checkbox" onclick="validaChecks()" class="checkeds" data-importe="{{ round($value->importe,2) }}" value="{{ $value->id }}" id="servicio_id" />
                              <?php } ?>

                            <?php } ?>
                          </td>
                          <td>{{ date('d/m/Y',strtotime($value->fecha_servicio)) }}</td>
                          <td style="width:50%"> {{ $value->descripcion }} </td>
                          <td class="text-center">{{ $value->cantidad }}</td>
                          <td class="text-center">
                            $ {{ number_format($value->precio,2,".",",") }}<br/>
                            <?php if($value->iva != 0) { echo 'I.V.A. <span class="text-info">$ ' . round($value->iva,2) .'</span> '; } ?>
                          </td>
                          <td class="text-center">
                            $ {{ number_format($value->importe,2,".",",") }}
                            <input type="hidden" class="form-control montos" name="abonos[<?php echo $items?>][montos]" value="{{ $value->importe }}" readonly/>
                            <input type="hidden"  class="form-control ivas" value="{{ $value->iva }}"/>
                          </td>
                          <td>
                            <?php if($value->descripcion != $empresa->hospedaje) { ?>

                              <?php if($value->status == 1) { ?>

                                <?php if(Auth::user()->permisos->deleteRecord == 1) { ?>
                                  <button type="button" class="btn btn-danger btn-circle" title="Eliminar Servicio" onclick="eliminaServicio({{ $items }},1)">
                                    <li class="fa fa-trash-o fa-lg"></li>
                                  </button>
                                <?php } ?>

                              <?php } else {  ?>
                                <span class="btn btn-success bn-lg btn-rounded">PAGADO</span>
                              <?php } ?>

                            <?php } ?>
                          </td>
                        </tr>
                        <?php $items++; ?>
                      <?php } ?>
                      <tr id="items">
                        <td colspan="7"></td>
                      </tr>


                    </tbody>
                  </table>
                </div>

              </div>

            </div>
        </div>
      </div>
    </div>

  </form>
</div>

<div class="modal fade" id="modalAbono" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel"> Abonar a Cuenta
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </h5>

            </div>
            <div class="modal-body">
              <div class="row">
                  <!-- Medico_id Start -->
          				<div class="col-md-12">

                    <div class="input-group m-t-10">
          						<span class="input-group-addon"> <li class="fa fa-lg fa-credit-card"></li> </span>
          						<input readonly type="text" class="form-control" name="txtAbono" id="txtAbono" value="<?php echo $data->pendiente - $data->pagado; ?>"/>
                      <span class="input-group-addon"> MXN </span>
                    </div>

          				</div>
          				<!-- Medico_id End -->

              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button class="btn btn-success waves-effect waves-light" type="button" onclick="abonar();">
                  <span class="btn-label"><i class="fa fa-credit-card fa-lg"></i></span>Abonar
                </button>

                <button  class="btn btn-danger" title="Cerrar Ventana" data-dismiss="modal" >
                  <span class="btn-label"><i class="fa fa-times fa-lg"></i></span>Cerrar
                </button>

              </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.3/moment.min.js"></script>
<script>

  var elegidos = 0;

  var ids = "";

  var item = <?php echo (int)$items; ?>;

  var importe_abono = 0;

  $('#btnAbonar').on('click',function(){

    if(elegidos != 0) {

      $('#modalAbono').modal({

        backdrop: 'static',

        keyboard: true,

        focus: true

      });

    } else {

      	swal({ title: "¡¡ ATENCION !!", text: "No ha seleccionado los servicios que desea liquidar", type: "error"});
    }

  });

  $('#cantidad').on('change',function(){

    calculaMonto();

  });

  $('#precio').on('change',function(){

    calculaMonto();

  });

  $('#excento').on('change',function(){

    calculaMonto();

  });

  $('#concepto').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);

    if(keycode == '13'){
      $('#cantidad').focus();
      //agregaServicio();
      return false;

    }

  });

  $('#concepto_id').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);

    if(keycode == '13'){
      $('#cantidad').focus();
      //agregaServicio();
      return false;

    }

  });

  $('#cantidad').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);

    if(keycode == '13'){
      $('#precio').focus();
      //agregaServicio();
      return false;

    }

  });

  $('#precio').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);

    if(keycode == '13'){
      $('#btnAddItem').focus();
      return false;

    }

  });

  $('#excento').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);

    if(keycode == '13'){
      $('#btnAddItem').focus();
      return false;

    }

  });

  $('#importe').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);

    if(keycode == '13'){
      return false;

    }

  });

  $('#concepto_id').on('change',function(){

    if( $(this).val() == 0) {

      $('#s2id_concepto_id').fadeOut();
      $('#capturaManual').fadeIn();

    } else {

      if($(this).val() != "") {

        $('#concepto').val($('#concepto_id option:selected').text());

        $.ajax({
      			url: "<?php echo url('admin/servicios/ajax'); ?>/" + $(this).val(),
      			dataType: 'json',
      			contentType: "application/json; charset=utf-8",
      			success: function(json) {

      				if(json['error'] == 0) {

                var precio = parseFloat( json['data'].precio);
                var iva = parseFloat( json['data'].valor_iva);
                var excento = parseFloat( json['data'].iva);
                var neto = parseFloat( json['data'].precio_neto);

                if(isNaN(precio)) {  precio = 0; }

                if(isNaN(iva)) {  iva = 0; }

                if(isNaN(neto)) {  neto = 0; }

                $('#excento').val(excento);
                $('#cantidad').val(1);
                $('#precio').val(precio.toFixed(2));
                $('#iva_importe').val(iva.toFixed(2));
                $('#importe').val(neto.toFixed(2));

                $('#cantidad').focus();

      				} else {

      					swal({ title: "¡¡ ERROR !!", text: json['msg'], type: "error"});

      				}

      			}
      		});
      }

    }

  });

  function abonar() {

    var saldo_actual = parseFloat(<?php echo $data->pendiente != 0 ? $data->pendiente : $data->total; ?>);

    var pagado = parseFloat(<?php echo $data->pagado; ?>);

    var abono = parseFloat($('#txtAbono').val());

    if(isNaN(saldo_actual)) { saldo_actual = 0; }

    if(isNaN(pagado)) { pagado = 0; }

    if(isNaN(abono)) { abono = 0; }

    var pagar = pagado + abono;

    var pendiente = saldo_actual - abono;

    var url = "{{ url('admin/urgencias/abonar/' . $data->id)}}";

    url += '/?pendiente=' + pendiente + '&pagado=' + pagar + '&abono=' + abono + '&servicios=' + ids;

    location = url;

  }

  function calculaMonto() {

      var cantidad = parseInt($('#cantidad').val());

      var precio = parseFloat($('#precio').val());

      var excento = parseFloat($('#excento').val());

      var iva = 0;

      var subtotal = 0;

      var importe = 0;

      if(isNaN(cantidad)) { cantidad = 0; }

      if(isNaN(precio)) { precio = 0; }

      var subtotal = precio * cantidad;

      if(excento == 1) {
        iva = subtotal * <?php echo ($empresa->impuesto / 100); ?>;
        importe = subtotal + iva;
      } else {
        importe = subtotal;
      }

      $('#importe').val(importe.toFixed(2));
      $('#iva_importe').val(iva.toFixed(2));

  }

  function calculaTotales() {

    var subtotal        = 0;

    var iva             = 0;

    var total           = 0;

    var pendiente       = 0;

    var saldo_actual = parseFloat(<?php echo $data->pendiente != 0 ? $data->pendiente : $data->total; ?>);

    var pagado = parseFloat(<?php echo $data->pagado; ?>);

    $.each($('.montos'),function(){

      var monto = parseFloat($(this).val());

      if(isNaN(monto)) { monto = 0; }

      subtotal = subtotal + monto;

    });

    $.each($('.ivas'),function(){

      var ivas = parseFloat($(this).val());

      if(isNaN(ivas)) { ivas = 0; }

      iva = iva + ivas;

    });

    total = subtotal;

    subtotal = subtotal -  iva  ;

    pendiente = total - pagado;

    $('#subtotal').val(subtotal.toFixed(2));
    $('#iva').val(iva.toFixed(2));
    $('#total').val(total.toFixed(2));

    $('#lblSubtotal').html(subtotal.toFixed(2));
    $('#lblIva').html(iva.toFixed(2));
    $('#lblTotal').html(total.toFixed(2));


    $('#lblPendiente').html(pendiente.toFixed(2));
  }

  function agregaServicio() {

    var html = '';

    var concepto_id   = $('#concepto_id').val();
    var concepto      = $('#concepto').val();
    var cantidad      = $('#cantidad').val();
    var precio        = $('#precio').val();
    var importe       = $('#importe').val();
    var excento       = $('#excento').val();
    var iva           = $('#iva_importe').val();

    if(!concepto) {
      swal({ title: "¡¡ ERROR !!", text: "Debe especificar el concepto de servicio o insumo a asignar", type: "error"});
      return false;
    }

    if(!cantidad) {
      swal({ title: "¡¡ ERROR !!", text: "Debe especificar la cantidad de servicio o insumo suministrado al paciente", type: "error"});
      return false;
    }

    if(!precio) {
      swal({ title: "¡¡ ERROR !!", text: "Debe especificar el monto o precio del servicio o insumo", type: "error"});
      return false;
    }

     html += '<tr id="items_' + item + '">';
               html += '<td></td>';
               html += '<td>' + "{{ date('d/m/Y') }}" + '</td>';
               html += '<td>';
                 html += concepto;
                 html += '<input type="hidden" name="servicios[' + item + '][concepto]" id="" class="form-control" value="' + concepto +'"/>';
                 html += '<input type="hidden" name="servicios[' + item + '][concepto_id]" id="" class="form-control" value="' + concepto_id +'"/>';
               html += '</td>';
               html += '<td class="text-center">';
                 html += cantidad;
                 html += '<input type="hidden" name="servicios[' + item + '][cantidad]" id="" class="form-control" value="' + cantidad +'"/>';
               html += '</td>';
               html += '<td class="text-center">';
                 html += precio;
                 html += '<input type="hidden" name="servicios[' + item + '][precio]" id="" class="form-control" value="' + precio +'"/>';
               html += '</td>';
               html += '<td class="text-center">';
                 html += importe;
                 html += '<input type="hidden" name="servicios[' + item + '][importe]" id="" class="form-control montos" value="' + importe +'"/>';
                 html += '<input type="hidden" name="servicios[' + item + '][iva]" id="" class="form-control ivas" value="' + iva +'"/>';
               html += '</td>';
               html += '<td>';
                 html += '<button type="button" class="btn btn-danger btn-circle" title="Eliminar Servicio" onclick="eliminaServicio(' + item + ',0)">';
                   html += '<li class="fa fa-trash-o fa-lg"></li>';
                 html += '</button>';
               html += '</td>';
             html += '</tr>';

    $('#items').before(html);

    $('#concepto_id').val('');
    $('#concepto').val('');
    $('#cantidad').val('');
    $('#precio').val('');
    $('#importe').val('');
    $('#iva_importe').val('');

    calculaTotales();
    item++;
    $('#concepto_id').focus();

  }

  function eliminaServicio(valor, tipo) {

    if(tipo == 1) {
      //Eliminacion y baja de servicio guardado en BD
      $.ajax({
    			url: "<?php echo url('admin/urgencias/servicios/baja'); ?>/" + valor,
    			dataType: 'json',
    			contentType: "application/json; charset=utf-8",
    			success: function(json) {

    				if(json['error'] == 0) {

    					swal({ title: "¡¡ EXITO !!", text: "Servicio dado de baja exitosamente", type: "success"});


    				} else {

    					swal({ title: "¡¡ ERROR !!", text: json['msg'], type: "error"});

    				}

    			}
    		});
      $('#items_' + valor).remove();

    } else {

      //Eliminmacion sencilla de linea agregada sin guardar
      swal({ title: "¡¡ EXITO !!", text: "Servicio dado de baja exitosamente", type: "success"});
      $('#items_' + valor).remove();

    }

    calculaTotales();

  }

  function validaChecks() {

    elegidos          = 0;

    ids               = "";

    importe_abono     = 0;

    $.each($('.checkeds'),function(){

      if($(this).is(':checked')) {

        var monto = parseFloat($(this).data('importe'));

        ids += $(this).val() + ',';

        if(isNaN(monto)) { monto = 0;}

        importe_abono += monto;

        elegidos++;

      }

    });

    $('#txtAbono').val(importe_abono.toFixed(2));

  }

  function filtrarServicios() {

    var desde = $('#fecha_desde').val();

    var hasta = $('#fecha_hasta').val();

    if(!desde && !hasta) {
      alert('Debe especificar al menos una fecha para consultar');
      return false;
    }


    $.ajax({
        url: "<?php echo url('admin/urgencias/fechas'); ?>/?desde=" + desde + "&hasta=" + hasta,
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        success: function(json) {

          if(json['error'] == 0) {



          } else {

            swal({ title: "¡¡ ERROR !!", text: json['msg'], type: "error"});

          }

        }
      });

    //
    $('.filtrados').hide();
    //
    $('.fecha_' + desde).show();
    $('.fecha_' + hasta).show();

  }

  function cierraManual() {

    $('#s2id_concepto_id').fadeIn();
    $('#capturaManual').fadeOut();
    $('#concepto_id').val("");


  }
</script>

@endsection
