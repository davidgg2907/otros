@extends('layouts.pos')

@section('content')

<section id="extended" style="padding:30px;">

  <div class="row" style="margin-top:10px;">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            @if(Auth::user()->perfil == 0)
              <a href="{{{ url('/') }}}" class="btn btn-dark   mb-75 waves-effect" title="Volver a Panel Administrativoi">
                <i class="fa-sharp fa-solid fa-home fa-2x"></i>
              </a>
            @endif

          </div>
          <div class="col-md-6" style="text-align:right">

            <a href="{{ url('admin/cronometro') }}" class="btn btn-primary   mb-75 waves-effect" title="Vista de pantalla">
              <i class="fa-solid fa-display fa-2x"></i>
            </a>

            <a href="javascript:void(0);" onclick="traeTemporizadores();" class="btn btn-info   mb-75 waves-effect" title="Refrescar / Recargar Cronometros">
              <i class="fa-solid fa-arrows-rotate fa-2x"></i>
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
    <div class="card">
      <div class="card-body">
        <div class="row">
          <table class="table">
            <thead>
              <tr>
                <th style="padding:20px;"><h1>CLIENTE</h1></th>
                <th style="padding:20px;"><h1>INICIO</h1></th>
                <th style="padding:20px;"><h1>TERMINA</h1></th>
                <th style="padding:20px;"><h1>RESTAN</h1></th>
                <th style="padding:20px;"></th>
              </tr>
            </thead>
            <tbody id="itemTempos">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="modal fade text-start" id="modalLocker" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="row" id="timerCounters">

          <div class="col-md-12">
            <div class="mb-1">
             <div class="form-group">
              <label for="locker_no" class="control-label"> Especifique el No locker donde se almacenaran las pertenencias </label>
              <div class="input-group mb-2">
                <span class="input-group-text" id="basic-addon1"> <i class="fa fa-archive fa-lg" aria-hidden="true"></i> </span>
                <input type="text" class="form-control" id="locker_no">
              </div>
            </div>
            </div>
          </div>
          <!-- Telefono End -->


          <div class="col-md-12">
            <button class="btn w-100 btn-success btn-lg btn-block" type="button" onclick="asignaLocker()">INICIAR CRONOMETRO </button>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>



@endsection


@section('scripts')

<script>


var modalLocker     = new bootstrap.Modal(document.getElementById('modalLocker'), { backdrop: 'static',keyboard: false });
var active_id       = 0;

$('#locker_no').on('keydown',function(e){
  if(e.which == 13) {
    asignaLocker();
  }
});

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

function iniciarJuego(id) {

    Swal.fire({
      title: 'Iniciar Cronometro',
      text: "ATENCION, Se iniciara el ctronometro para esta persona, ¿ Desea continuar ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si Iniciar',
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-outline-danger ms-1'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {
        active_id = id;
        modalLocker.show();

      }
    });

  }

function asignaLocker() {

  if($('#locker_no').val() == "") {

    Swal.fire({
      title: ' ¡ ATENCION !',
      text: "Debe especificar el numero de locker",
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    return false;

  }

  $.ajax({
    url: "{{ url('admin/temporizador/start') }}/" + active_id + '?locker=' + $('#locker_no').val(),
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function(json) {
      if(json['error'] == 0) {
        traeTemporizadores();
        modalLocker.hide();
        $('#locker_no').val("");
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

function traeTemporizadores() {
    $.ajax({
  		url: "{{ url('admin/temporizador/runing') }}",
  		dataType: 'json',
  		contentType: "application/json; charset=utf-8",
  		success: function(json) {
  			if(json['error'] == 0) {
  				$('#itemTempos').html(json['html']);
          setTimeout(traeTemporizadores, 60000)
  			}
  		}

  	});
  }

setTimeout(traeTemporizadores, 3000);

function cerrarJuego(id) {

    Swal.fire({
      title: 'Finalizar Cronometro',
      text: "ATENCION, el cronometro sera eliminado de la lista, ¿ Desea continuar ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si Finalizar',
      customClass: {
        confirmButton: 'btn btn-danger',
        cancelButton: 'btn btn-outline-danger ms-1'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {

        $.ajax({
          url: "{{ url('admin/temporizador/end') }}/" + id,
          dataType: 'json',
          contentType: "application/json; charset=utf-8",
          success: function(json) {
            if(json['error'] == 0) {
              traeTemporizadores();
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
    });

  }

function pausarJuego(id) {

    Swal.fire({
      title: 'Pausar Tiempo',
      text: "ATENCION, el cronometro se detendra, debera realizar la recarga del mismo de forma manual para reiniciarlo, ¿ Desea continuar ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si Pausar',
      customClass: {
        confirmButton: 'btn btn-danger',
        cancelButton: 'btn btn-outline-danger ms-1'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {

        $.ajax({
          url: "{{ url('admin/temporizador/pause') }}/" + id,
          dataType: 'json',
          contentType: "application/json; charset=utf-8",
          success: function(json) {
            if(json['error'] == 0) {
              traeTemporizadores();
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
    });

  }

function reiniciarJuego(id) {

      Swal.fire({
        title: 'Reiniciar Tiempo',
        text: "ATENCION, se reactivara el juego con el tiempo restante, ¿ Desea continuar ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si Pausar',
        customClass: {
          confirmButton: 'btn btn-danger',
          cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false
      }).then(function (result) {
        if (result.value) {

          $.ajax({
            url: "{{ url('admin/temporizador/restart') }}/" + id,
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            success: function(json) {
              if(json['error'] == 0) {
                traeTemporizadores();
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
      });

    }

function cancelarJuego(id) {

    Swal.fire({
      title: 'Cancelar Tiempo',
      text: "ATENCION, el cronometro sera eliminado de la lista de forma permanente, ¿ Desea continuar ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si Finalizar',
      customClass: {
        confirmButton: 'btn btn-danger',
        cancelButton: 'btn btn-outline-danger ms-1'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {

        $.ajax({
          url: "{{ url('admin/temporizador/cancel') }}/" + id,
          dataType: 'json',
          contentType: "application/json; charset=utf-8",
          success: function(json) {
            if(json['error'] == 0) {
              traeTemporizadores();
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
    });

  }


</script>
@endsection
