@extends('layouts.app')

@section('content')

<section id="extended">

  <div class="row">
    <form if="frmFilter" method="GET" action="">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Filtrar Resultados</h4>
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                  <li>
                      <a data-action="collapse" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                          <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                      </a>
                  </li>
              </ul>
            </div>
          </div>
          <div class="card-content collapse show">
            <div class="card-body table-responsive">
              <div class="row">
                <div class="row">

                  <!-- Proveedor_id Start -->
                  <div class="col-md-4">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="proveedor_id" class="control-label"> Cajero </label>
                      <select class="form-control select2" id="tienda_id" name="tienda_id">
                        <option value="">[ SELECCIONE ]</option>
                        <?php foreach(\App\admin\Users::where('perfil',1)->get() as $provs) { ?>
                          <option value="{{ $provs->id }}">{{ $provs->name }}</option>
                        <?php } ?>
                      </select>
                        <div class="label label-danger">{{ $errors->first("proveedor_id") }}</div>
                     </div>
                    </div>
                  </div>
                  <!-- Proveedor_id End -->

                  <!-- Fecha Start -->
                  <div class="col-md-4">
                    <div class="mb-1">
                      <div class="form-group">
                       <label for="cliente_id" class="control-label"> F. Apertura </label>
                       <div class="input-group mb-2">
                         <span class="input-group-text" style="background: #E8E8E8;">Desde</span>
                         <input type="text" class="form-control flatpickr-basic flatpickr-input" id="inicio_desde" name="inicio_desde">
                         <span class="input-group-text" style="background: #E8E8E8;">Hasta</span>
                         <input type="text" class="form-control flatpickr-basic flatpickr-input" id="inicio_hasta" name="inicio_hasta">
                       </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mb-1">
                      <div class="form-group">
                       <label for="cliente_id" class="control-label"> F. Cierre </label>
                       <div class="input-group mb-2">
                         <span class="input-group-text" style="background: #E8E8E8;">Desde</span>
                         <input type="text" class="form-control flatpickr-basic flatpickr-input" id="termino_desde" name="termino_desde">
                         <span class="input-group-text" style="background: #E8E8E8;">Hasta</span>
                         <input type="text" class="form-control flatpickr-basic flatpickr-input" id="termino_hasta" name="termino_hasta">
                       </div>
                      </div>
                    </div>
                  </div>


                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-md-12" style="text-align:right">
                  <a href="{{ url('/admin/cajas') }}" class="btn btn-warning ">
                    <i class="fa fa-eraser fa-lg"></i> Limpiar</a>
                  <button type="submit" class="btn btn-success"> <i class="fa fa-search fa-lg"></i> Filtrar  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Listado de cajas</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <div class="row" style="margin-bottom:20px;">
              <div class="col-md-2">
                <i class="fas fa-lock-open text-primary fa-lg" aria-hidden="true"></i> Caja Abierta
              </div>
              <div class="col-md-2">
                <i class="fa fa-lock text-success fa-lg" aria-hidden="true"></i> Caja Cerrada
                <div class="col-md-8"> &nbsp; </div>
              </div>
            </div>

            <table class="table">
              <thead>
                <tr>
                  <th>Cajero</th>
      						<th>F. Inicio</th>
      						<th>F. Termino</th>
      						<th>Saldo Inicial</th>
      						<th>Saldo Final</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" class="@if($value->cuadrado == 0 && $value->comentarios == "") table-danger @endif">
                    <td class="text-left">
                      @if($value->status == 1)
                        <i class="fas fa-lock-open text-primary fa-lg" title="Caja Abierta y en operaciones" aria-hidden="true"></i>
                      @else
                        <i class="fa fa-lock text-success fa-lg" title="Caja Cerrada" aria-hidden="true"></i>
                      @endif

                      {{{ $value->cajero->name }}}
                    </td>
                    <td class="text-center"> {{{ date('d/m/Y g:i:s',strtotime($value->inicia)) }}} </td>
                    <td class="text-center"> {{{ date('d/m/Y g:i:s',strtotime($value->termina)) }}} </td>
                    <td class="text-center"> $ {{{ number_format($value->monto_inicial,0,".",",") }}} </td>
                    <td class="text-center"> $ {{{ number_format($value->monto_final,0,".",",") }}} </td>
                    <td class="text-center">
                     @if($value->cuadrado == 0)
                       <a href="javascript:void(0)" onclick="comentarios({{ $value->id }})" title="Edit" data-toggle="tooltip">
                        <i class="fa fa-comments fa-lg text-dark m-r-10"></i>
                       </a>
                     @endif
  					          <a href="{{ url('admin/cajas/view/' . $value->id) }}" title="Edit" data-toggle="tooltip">
  					           <i class="fa fa-file-pdf fa-lg text-info m-r-10"></i>
  					          </a>
                      <a href="{{ url('admin/cajas/printer/' . $value->id) }}" target="_blank" title="Reporte" data-toggle="tooltip">
  					           <i class="fa fa-receipt fa-lg m-r-10"></i>
  					          </a>
                    </td>
                  </tr>
                <?php }  ?>
              </tbody>

            </table>
          </div>
        </div>
        <div class="card-footer">
          {{ $data->links('vendor.pagination.default') }}
        </div>
      </div>
    </div>
  </div>
</section>


<div class="modal fade text-start" id="modalCierre" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ingresoEgresoHead">Comentarios de cierre</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="row">

              <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Caja descuadrada,</h4>
                    <div class="alert-body">
                        Los montos de efectivo no cuadran con el importe de cierre ingresado, diferencia de : <span id="lblDiferencia"></span>
                    </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="mb-1">
                 <div class="form-group">
                  <label for="user_id" class="control-label"> Saldo de Apertura </label>
                    <input type="text" class="form-control" id="monto_inicial" name="monto_inicial" readonly>
                    <div class="label label-danger">{{ $errors->first("user_id") }}</div>
                 </div>
                </div>
              </div>

              <div class="col-md-4"></div>


              <div class="col-md-4">
                <div class="mb-1">
                 <div class="form-group">
                  <label for="user_id" class="control-label"> Saldo al Cierre </label>
                    <input type="text" class="form-control" id="monto_final" name="monto_final" readonly>
                    <div class="label label-danger">{{ $errors->first("user_id") }}</div>
                 </div>
                </div>
              </div>

              <div class="col-md-12"><hr/></div>

              <div class="col-md-4">
                <div class="mb-1">
                 <div class="form-group">
                  <label for="user_id" class="control-label"> Pagos en Efectivo </label>
                    <input type="text" class="form-control" id="efectivo" name="efectivo"  readonly>
                    <div class="label label-danger">{{ $errors->first("user_id") }}</div>
                 </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="mb-1">
                 <div class="form-group">
                  <label for="user_id" class="control-label"> Pagos con Tarjeta C/D </label>
                    <input type="text" class="form-control" id="tarjetas" name="tarjetas" readonly>
                    <div class="label label-danger">{{ $errors->first("user_id") }}</div>
                 </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="mb-1">
                 <div class="form-group">
                  <label for="user_id" class="control-label"> Pagos con Transferencia </label>
                    <input type="text" class="form-control" id="transfer" name="transfer" readonly>
                    <div class="label label-danger">{{ $errors->first("user_id") }}</div>
                 </div>
                </div>
              </div>

              <div class="col-md-12"><hr/></div>

              <div class="col-md-12">
                <div class="mb-1">
                 <div class="form-group">
                  <label for="user_id" class="control-label"> Comentarios </label>
                    <textarea class="form-control" name="comentarios" id="comentarios"></textarea>
                    <div class="label label-danger">{{ $errors->first("user_id") }}</div>
                 </div>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer text-right">
            <button type="button" id="btnSubmit" class="btn btn-success waves-effect waves-float waves-light" data-dismiss="modal">Aprobar</button>
            <button type="button" class="btn btn-danger waves-effect waves-float waves-light" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('scripts')
<script>
  var modalCierre = new bootstrap.Modal(document.getElementById('modalCierre'), { backdrop: 'static',keyboard: false });
  var valor_id = 0;
  $('#btnSubmit').on('click',function(){
      if($('#comentarios').val() == "") {
        Swal.fire({
          title: ' ¡ ATENCION !',
          text: "Debe de especificar un comentario para confirmar el cierre",
          icon: 'warning',
          customClass: {
            confirmButton: 'btn btn-danger'
          },
          buttonsStyling: false
        });
        return false;
      }

      location = "{{ url('admin/cajas/arqueo/') }}/?id=" + valor_id + "&comentarios=" + $('#comentarios').val();
  });

  function comentarios(id) {

    $.ajax({
      url: "<?php echo url('admin/cajas/info'); ?>/" + id,
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
      success: function(json) {
        valor_id = id;
        var monto_inicial = parseFloat(json['data'].monto_inicial);
        var monto_final = parseFloat(json['data'].monto_final);

        var efectivo = parseFloat(json['efectivo']);
        var tarjetas = parseFloat(json['tarjetas']);
        var transfer = parseFloat(json['transferencia']);

        if(isNaN(monto_inicial)) { monto_inicial = 0; }
        if(isNaN(monto_final)) { monto_final = 0; }

        if(isNaN(efectivo)) { efectivo = 0; }
        if(isNaN(tarjetas)) { tarjetas = 0; }
        if(isNaN(transfer)) { transfer = 0; }

        $('#monto_inicial').val(monto_inicial.toFixed(0));
        $('#monto_final').val(monto_final.toFixed(0));

        if(json['data'].comentarios != null) {
          $('#comentarios').html(json['data'].comentarios);
          $('#comentarios').attr('readonly','readonly');
          $('#btnSubmit').fadeOut('fast');
        } else {
          $('#comentarios').removeAttr('readonly');
          $('#btnSubmit').fadeIn('fast');
        }
        $('#lblDiferencia').html('$ ' + json['diferencia'] + ' CPL');

        $('#efectivo').val(efectivo.toFixed(0));
        $('#tarjetas').val(tarjetas.toFixed(0));
        $('#transfer').val(transfer.toFixed(0));
        modalCierre.show();

      }

    });

  }

</script>
@endsection
