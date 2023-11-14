@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">

              @if(Auth::user()->perfil == 0)
                <a href="javascript:void(0)" onclick="generaCodigoCancelacion();" class="btn btn-relief-warning ">
                  <i class="fa fa-lock fa-lg"></i> Codigo de Cancelacion</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


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
                    <div class="col-md-7">
                      <div class="mb-1">
                       <div class="form-group">
                        <label for="proveedor_id" class="control-label"> Cliente </label>
                        <select class="form-control select2" id="cliente_id" name="cliente_id">
                          <option value="">[ SELECCIONE ]</option>
                          <?php foreach(\App\admin\Clientes::where('status',1)->get() as $provs) { ?>
                            <option value="{{ $provs->id }}">{{ $provs->nombre }}</option>
                          <?php } ?>
                        </select>
                          <div class="label label-danger">{{ $errors->first("proveedor_id") }}</div>
                       </div>
                      </div>
                    </div>
                    <!-- Proveedor_id End -->

                    <!-- Fecha Start -->
                    <div class="col-md-5">
                      <div class="mb-1">
                        <div class="form-group">
                         <label for="cliente_id" class="control-label"> Rango de Fechas </label>
                         <div class="input-group mb-2">
                           <span class="input-group-text" style="background: #E8E8E8;">Desde</span>
                           <input type="text" class="form-control flatpickr-basic flatpickr-input" id="fecha_desde" name="fecha_desde">
                           <span class="input-group-text" style="background: #E8E8E8;">Hasta</span>
                           <input type="text" class="form-control flatpickr-basic flatpickr-input" id="fecha_hasta" name="fecha_hasta">
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
                    <a href="{{ url('/admin/ventas') }}" class="btn btn-warning ">
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
          <h4 class="card-title">Listado de ventas</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
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
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" @if($value->status == 0) class="table-danger" @endif>
                    <td> {{{ $value->cliente->nombre != "" ? $value->cliente->nombre : "Publico en General" }}} </td>
                    <td> {{{ $value->user->name }}} </td>
                    <td> {{{ $value->fecha }}} </td>
                    <td> {{{ $value->hora }}} </td>
                    <td> $ {{{ number_format($value->subtotal,0,".",",") }}} </td>
                    <td> $ {{{ number_format($value->totald,0,".",",") }}} </td>
                    <td class="text-center">
						           <a href="<?php echo url("/"); ?>/admin/ventas/view/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
						             <i class="fa fa-receipt fa-lg text-info m-r-10"></i>
						           </a>
                       @if($value->status == 1)
  						           <button type="button" data-toggle="tooltip" onclick="cancelaVenta({{ $value->id }})" data-title="Cancelar ventas" style="border:0px; background:none">
  						             <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
  						           </button>
                       @endif
            				</td>
                  </tr>
                  @if($value->status == 0)
                    <tr class="table-danger">
                      <td class="text-center" colspan="2"> Codigo de Cancelacion: <b> {{ $value->cancelcode->codigo }} </b> </td>
                      <td class="text-center" colspan="2"> Creado por: <b> {{ $value->cancelcode->creador->name }} </b> </td>
                      <td class="text-center" colspan="2">Ejecutado por: <b>{{ $value->cancelcode->ejecutor->name }} </b> </td>
                      <td></td>
                    </tr>
                  @endif

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


@endsection


@section('scripts')

<script>

var validaCodigo    = new bootstrap.Modal(document.getElementById('validaCodigo'), { backdrop: 'static',keyboard: true });

  function generaCodigoCancelacion() {

    Swal.fire({
      title: 'Codigo de Cancelacion',
      text: "Se generara un codigo de cancelacion de venta ¿ Desea continuar ?",
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

        $.ajax({
      		url: "<?php echo url('admin/codigos/add/'); ?>/",
      		dataType: 'json',
      		contentType: "application/json; charset=utf-8",
      		success: function(json) {

      			if(json['error'] == 0) {
              Swal.fire({
                title: json['code'],
                text: "Codigo Generado, Su codigo expira en 15 Minutos y solo puede ser usado una unica vez",
                icon: 'success',
                customClass: {
                  confirmButton: 'btn btn-info'
                },
                buttonsStyling: false
              });
      			}

      		}

      	});

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
                validaCodigo.hide();
                $('#txtCodeVerification').val('');
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

</script>
@endsection
