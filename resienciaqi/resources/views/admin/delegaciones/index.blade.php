@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/delegaciones/add') }}" class="btn btn-relief-info ">
                <i class="fa fa-plus fa-lg"></i> Crear Nuevo</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<section id="extended">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-content table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Nombre</th>
      						<th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td> {{{ $value->nombre }}} </td>
                    <td class="text-center">

                    <button type="button" onclick="abreModal('{{ $value->seo }}')" data-toggle="tooltip" data-title="Copiar/Enviar Evaluacion" title="Copiar/Enviar Evaluacion" style="border:0px; background:none">
						             <i class="fa fa-list fa-lg text-info m-r-10"></i>
						        </button>

                       <a href="javascript:void(0)" title="Edit" data-toggle="tooltip" onclick="seleccionaResultados({{ $value->id }} );">
						             <i class="fa fa-pie-chart fa-lg text-success m-r-10"></i>
						           </a>
						           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/delegaciones/baja/<?php echo $value->id; ?>" data-title="Eliminar delegaciones" style="border:0px; background:none">
						             <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
						           </button>
            				</td>
                  </tr>
                <?php }  ?>
              </tbody>

            </table>
        </div>
        <div class="card-footer">
          {{ $data->links('vendor.pagination.default') }}
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ELIJE LINK START-->
<div class="modal fade text-start" id="modalTquiz" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="ingresoEgresoHead">Evaluaciones</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
              <p>Seleccione la evaluacion a enviar, el link sera copiado a su portapapeles para poder compartir</p>
              <hr/>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <div class="input-group form-password-toggle mb-2">
                <input class="form-control" value="" id="general-input" readonly />
                <div class="input-group-append" onclick="copiaLink('general')" >
                  <span class="input-group-text cursor-pointer"><li class="fa fa-copy fa-2x"></li></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <div class="input-group form-password-toggle mb-2">
                <input class="form-control" value="" id="resilencia-input" readonly/>
                <div class="input-group-append" onclick="copiaLink('resilencia')" >
                  <span class="input-group-text cursor-pointer"><li class="fa fa-copy fa-2x"></li></span>
                </div>
              </div>
            </div>
          </div>
          <!--<div class="col-md-12">
            <hr/>
            <p>¿ Desee crear un panel de seguiento ? <small> Opcional </small></p>
          </div>-->

        </div>
      </div>
      <div class="modal-footer text-right">
        <button type="button" class="btn btn-danger waves-effect waves-float waves-light" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- ELIJE LINK END-->

<!-- ELIJE GRAFICA START-->
<div class="modal fade text-start" id="modalTypeResult" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="ingresoEgresoHead">Seleccione los resultados que desea visualizar</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">          
          <div class="col-md-6">
            <div class="form-group" style="text-align:center; margin-bottom:10px;">
              <a href="javascript:void(0)" onclick="abrelink('general');" class="text-info">
                <i class="fa fa-pie-chart fa-7x"></i><br/><br/>
                <h5 class="text-info">ESTUDIO DE CALIDAD DE VIDA LABORAL</h5>
              </a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group" style="text-align:center">
              <a href="javascript:void(0)" onclick="abrelink('resilencia');" class="text-success">
                <i class="fa fa-bar-chart fa-7x"></i><br/><br/>    
                <h5 class="text-success">FACTORES PERSONALES DE RESILIENCIA</h5>
              </a>
            </div>
          </div>          
        </div>
      </div>
      <div class="modal-footer text-right">
        <button type="button" class="btn btn-danger waves-effect waves-float waves-light" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- ELIJE GRAFICA END-->


    @endsection


@section('scripts')
<script>

  var seo_selected = "";
  var id_delegacion = 0; 
  function seleccionaResultados(id) {

    id_delegacion = id;

    var mtr = new bootstrap.Modal(document.getElementById('modalTypeResult'), { backdrop: 'static',keyboard: true });
    
    mtr.show();

  }

  function abrelink(tipo) {

    if(tipo == "general") {

      window.location.href = "{{ url('admin/delegaciones/dashgeneral') }}/" + id_delegacion;

    } else {
      window.location.href = "{{ url('admin/delegaciones/dashresilencia') }}/" + id_delegacion;
    }

  }

  function abreModal(seo) {

    seo_selected = seo;
    var modalTquiz = new bootstrap.Modal(document.getElementById('modalTquiz'), { backdrop: 'static',keyboard: true })

    var general_quiz = "{{ url('quiz/') }}/" + seo_selected + "/general" ;
    var resilencia_quiz = "{{ url('quiz/') }}/" + seo_selected + "/resilencia" ;

    $('#general-input').val(general_quiz);
    $('#resilencia-input').val(resilencia_quiz);

    modalTquiz.show();

  }

  function copiaLink(quiz) {

    var text_quiz = "{{ url('quiz/') }}/" + seo_selected + "/" + quiz;

    navigator.clipboard.writeText(text_quiz)
  .then(() => {
    console.log('Texto copiado al portapapeles')
  })
  .catch(err => {
    console.error('Error al copiar al portapapeles:', err)
  })


    alert("Texto copiado a portapapeles");

  }

</script>

@endsection
