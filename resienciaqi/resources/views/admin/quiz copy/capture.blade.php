@extends('layouts.quiz')

@section('content')

<div class="row">

</div>


<section id="extended">
  <div class="row">
    <form class="needs-validation" novalidate action="<?php echo url('/'); ?>/quiz/save" id="formQuiz" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" name="delegacion_id" class="form-control" value="{{ $delegacion->id }}" />
      <input type="hidden" name="tipo" id="tipo_quiz" class="form-control" value="{{ $type }}" />


      <div class="row" style="margin-left:20%; margin-right:20%">
        <div class="col-md-12">
        	<div class="card">
        		<div class="card-header">
        				<h4 class="card-title">Datos Generales</h4>
        		</div>
        		<div class="card-body">
        			<div class="row">

        				<!-- Area_id Start -->
        				<div class="col-md-12">
        					<div class="mb-1">
        					 <div class="form-group">
        						<label for="area_id" class="control-label"> Area o departamento al que pertenece</label>
        						<select class="form-control" id="area_id" name="area_id" required>
        							<option value="">[ Seleccione ]</option>
        							@foreach ($areas as $value)
        								<option value="{{ $value->id }}" > {{ $value->nombre}} </option>
        							@endforeach
        						</select>
        							<div class="label label-danger">{{ $errors->first("area_id") }}</div>
        					 </div>
        					</div>
        				</div>
        				<!-- Area_id End -->

        				<!-- Nombre Start -->
        				<div class="col-md-12">
        					<div class="mb-1">
        					 <div class="form-group">
        						<label for="nombre" class="control-label"> Nombre </label>
        							<input type="text" class="form-control" id="nombre" name="nombre" required
        							value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
        							<div class="label label-danger">{{ $errors->first("nombre") }}</div>
        					 </div>
        					</div>
        				</div>
        				<!-- Nombre End -->

        				<!-- Curp Start -->
        				<div class="col-md-6">
        					<div class="mb-1">
        					 <div class="form-group">
        						<label for="curp" class="control-label"> Curp </label>
        							<input type="text" class="form-control" id="curp" name="curp" required
        							value="{{{ isset($data->curp ) ? $data->curp  : old('curp') }}}">
        							<div class="label label-danger">{{ $errors->first("curp") }}</div>
        					 </div>
        					</div>
        				</div>
        				<!-- Curp End -->

        				<!-- Telefono Start -->
        				<div class="col-md-3">
        					<div class="mb-1">
        					 <div class="form-group">
        						<label for="telefono" class="control-label"> Telefono </label>
        							<input type="text" class="form-control" id="telefono" name="telefono" required
        							value="{{{ isset($data->telefono ) ? $data->telefono  : old('telefono') }}}">
        							<div class="label label-danger">{{ $errors->first("telefono") }}</div>
        					 </div>
        					</div>
        				</div>
        				<!-- Telefono End -->

                <!-- Celular Start -->
        				<div class="col-md-3">
        					<div class="mb-1">
        					 <div class="form-group">
        						<label for="celular" class="control-label"> Celular </label>
        							<input type="text" class="form-control" id="celular" name="celular" required
        							value="{{{ isset($data->celular ) ? $data->celular  : old('celular') }}}">
        							<div class="label label-danger">{{ $errors->first("celular") }}</div>
        					 </div>
        					</div>
        				</div>
        				<!-- Celular End -->

                <div class="col-md-6">
        					<div class="mb-1">
        					 <div class="form-group">
        						<label for="telefono" class="control-label"> Genero </label>
                    <select class="form-control" id="genero_id" name="genero_id" required>
                      <option value="">[ SELECCIONE ]</option>
                      @foreach(\App\admin\Pacientes::GENERO as $key => $value)
							<option value="{{ $key }}"> {{ $value }} </option>
						@endforeach
                    </select>
                    <div class="label label-danger">{{ $errors->first("telefono") }}</div>
        					 </div>
        					</div>
        				</div>


                <div class="col-md-6">
        					<div class="mb-1">
        					 <div class="form-group">
        						<label for="telefono" class="control-label"> Educacion </label>
                    <select class="form-control" id="educacion_id" name="educacion_id" required>
						@foreach(\App\admin\Pacientes::ESTATUS as $key => $value)
							<option value="{{ $key }}"> {{ $value }} </option>
						@endforeach
                    </select>
                    <div class="label label-danger">{{ $errors->first("telefono") }}</div>
        					 </div>
        					</div>
        				</div>


                <div class="col-md-6">
        					<div class="mb-1">
        					 <div class="form-group">
        						<label for="telefono" class="control-label"> Estado Civil </label>
                    <select class="form-control" id="edo_civil_id" name="edo_civil_id" required>
                      <option value="">[ SELECCIONE ]</option>
                      @foreach(\App\admin\Pacientes::EDOCIVIL as $key => $value)
							<option value="{{ $key }}"> {{ $value }} </option>
						@endforeach
                    </select>
                    <div class="label label-danger">{{ $errors->first("telefono") }}</div>
        					 </div>
        					</div>
        				</div>

                <div class="col-md-6">
        					<div class="mb-1">
        					 <div class="form-group">
        						<label for="telefono" class="control-label"> Tipo de Contrato </label>
                    <select class="form-control" id="edo_civil_id" name="edo_civil_id" required>
                      <option value="">[ SELECCIONE ]</option>
                      @foreach(\App\admin\Pacientes::CONTRATO as $key => $value)
							<option value="{{ $key }}"> {{ $value }} </option>
						@endforeach
                    </select>
                    <div class="label label-danger">{{ $errors->first("telefono") }}</div>
        					 </div>
        					</div>
        				</div>

        			</div>
        		</div>
        		<div class="card-footer">
        			<div class="row">
        			</div>
        		</div>
        	</div>
        </div>

        <div class="col-md-12">

          <div class="card">
        		<div class="card-header">
        				<h4 class="card-title">Evaluacion Clinica</h4>
        		</div>
        		<div class="card-body">

              @if($type == 'general')
          			<div class="row" id="general-test">
                  <table class="table">
                    <tbody>
                      <?php foreach($quiz['preguntas'] as $qid => $questions) { ?>
                        <tr>
                          <td style="width:70%">{{ $questions['nombre'] }}</td>
                          <td style="width:30%">
                            <div class="form-group">
                              <input type="hidden" class="form-control" name="questions[{{ $qid }}][answer_id]"  value="{{ $questions['answer_id'] }}"/>
                              <input type="hidden" class="form-control" name="questions[{{ $qid }}][answer_type]"  value="{{ $questions['tipo'] }}"/>
                              <?php if($questions['tipo'] == 'S') { ?>
                                <select class="form-control" name="questions[{{ $qid }}][answer_value] }}]" required>
                                  <option value="">[ SELECCIONE ]</option>
                                  <?php foreach($questions['answers'] as $answers) { ?>
                                    <option value="{{ $answers['id'] }}">{{ $answers['title'] }}</option>
                                  <?php } ?>
                                </select>
                              <?php } else { ?>
                                <input type="text" class="form-control" name="questions[{{ $qid }}][answer_value]" required/>
                              <?php } ?>
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
          			</div>
              @else
                <div class="row" id="resilencia-test">
                  <?php print_r($resilencia); ?>
                <table class="table">
                  <tbody>
                    <?php foreach($resilencia as $questions) { ?>
                      <tr>
                        <td style="width:70%">{{ $questions }}</td>
                        <td style="width:30%">
                          <div class="form-group">
                            <input type="hidden" name="questions[{{ $questions->id }}][answer_id]" value="0" >
                            <input type="hidden" name="questions[{{ $questions->id }}][answer_type]" value="O" >
                            <select class="form-control" name="questions[{{ $questions->id }}][answer_value]" required>
                              <option value="">[ SELECCIONE ]</option>
                              <option value="1">SI</option>
                              <option value="0">NO</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              @endif
        		</div>
        		<div class="card-footer">
        			<div class="row">
        			</div>
        		</div>
        	</div>

        </div>

        <div class="col-sm-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body table-responsive">
                <div class="row">

                  <div class="col-md-12" style="text-align:right">

                    <button type="submit" class="btn btn-relief-info ">
                      <i class="fa fa-save fa-lg"></i> Enviar Evaluacion
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>


    </form>

  </div>
</section>




@endsection


@section('scripts')

<style> input { text-transform: none; } </style>


<script>



	function readURL(input,indice) {
	  if (input.files && input.files[0]) {
			$('#imgPreview' + indice).html('');
		  var reader = new FileReader();
	    reader.onload = function(e) {
				alert(e.target.result);
		   $('#imgPreview').html('<img src="' + e.target.result + '" class="rounded-circle img-border gradient-summer" height="200">');
	    }
	    reader.readAsDataURL(input.files[0]);
	  } else {
	    $('#imgPreview').attr('src', '<img src="{{ asset('/') }}/img/portrait/avatars/avatar-08.png" class="rounded-circle img-border gradient-summer " height="200" alt="Card image">');
	  }
	}

	$(document).on('change', '.images_select', function () {

		var indice = $(this).attr('data-indice');

		readURL(this,indice);

	});


	$(document).ready(function () {
	  'use strict'; // Fetch all the forms we want to apply custom Bootstrap validation styles to

	  var forms = document.getElementsByClassName('needs-validation'); // Loop over them and prevent submission

	  var validation = Array.prototype.filter.call(forms, function (form) {
	    form.addEventListener('submit', function (event) {

				if (form.checkValidity() === false) {
	        event.preventDefault();
	        event.stopPropagation();
	      }else {

					procesando();

				}

	      form.classList.add('was-validated');
	    }, false);
	  });
	});

	<?php if($data->id) { ?>
		$('#perfil').trigger('change');
	<?php } ?>
</script>

@endsection
