@extends('layouts.pos')
<meta http-equiv="refresh" content="60">
@section('content')
<?php


$css = ""

?>

<style>
  body {
    background-image: url("{{ asset('images/fondo-verde.jpg') }}") !important;
    background-size: 100%;
  }
</style>
<section id="extended" style="padding:20px; background: #FFF;">
  <div class="row">
    <table class="table">
      <tbody>
        <tr>
          <td colspan="4"></td>
        </tr>
        <?php
          foreach(\App\admin\Temporizador::where('status',2)->orderBy('inicia','ASC')->get() as $tempos) {

            $date1 = new \DateTime(date('Y-m-d H:i:s'));
            $date2 = new \DateTime($tempos->termina);
            $diff = $date1->diff($date2);

            if($tempos->status == 1) {
              $bg_color = 'table-secondary';
              $inicia = "";
              $termina = "";
              $timer = ' ';
            } else {

              $inicia  = date('H:i:s',strtotime($tempos->inicia));
              $termina = date('H:i:s',strtotime($tempos->termina));

              if($tempos->termina > date('Y-m-d H:i:s')) {

                $timer = $diff->format('%I:%S');

                $minuto = $diff->format('%I');

                if($diff->i <= "0") {
                  $bg_color = 'table-danger';
                }else if($minuto > "5") {
                  $bg_color = 'border-bottom: 1px solid #3f8668; border-top: 1px solid #3f8668;';
                  $font_color = 'color: #3f8668;';
                } elseif($minuto < "5") {
                  $bg_color = 'border-bottom: 1px solid #d7a613; border-top: 1px solid #d7a613;';
                  $font_color = 'color: #d7a613;';
                }

              } else {
                $timer = 'TIEMPO AGOTADO';
                $bg_color = 'background: #b50000;border-bottom: 1px solid #b50000; border-top: 1px solid #b50000; ';
                $font_color = 'color: #FFF;';

              }

            }
        ?>

         @if($minuto <= "10")
            <tr>
              <td style="padding:10px; margin-top: 5px; {{ $bg_color }}"><h1 style=" text-align:right;font-size:50px; font-weight:bold; text-align:left; {{ $font_color }}"> {{ strtoupper($tempos->nombre) }}</h1></td>
              <td style="padding:10px; margin-top: 5px; {{ $bg_color }}"><h1 style=" text-align:right;font-size:50px; font-weight:bold; text-align:right; {{ $font_color }}">{{ $timer }}</h1></td>
            </tr>
            <tr>
              <td colspan="2" style="padding:1px;"></td>
            </tr>
          @endif

        <?php } ?>
      </tbody>
    </table>
  </div>
</section>

@endsection


@section('scripts')

<script>
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

        $.ajax({
          url: "{{ url('admin/temporizador/start') }}/" + id,
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


</script>
@endsection
