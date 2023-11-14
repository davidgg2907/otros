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

	  <div class="row" id="portada">

		@if($type == 'general')
			<div class="col-md-12">
				<div class="col-md-3 col-sm-3 col-xl-12"></diV>
				<div class="col-md-6 col-sm-12 col-xl-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title" style="text-align:center">ESTUDIO DE CALIDAD DE VIDA LABORAL</h4>
							<div class="col-md-12">
								<p>
								Este estudio tiene como objetivo analizar cómo influye sobre la calidad de vida laboral fenómenos como el estrés laboral. Para ello, hemos elaborado un conjunto de escalas que, si son contestadas con sinceridad, nos permitirán comprender mejor esos procesos y su influencia sobre el trabajo.
								</p>

								<p>
								El cuestionario que usted rellene no será enseñado bajo ninguna razón o circunstancia a personas empleadas en su organización. Sólo tendrán acceso a su contenido los miembros del equipo de investigación. Todos los datos que refleje en él serán tratados confidencialmente. Su anonimato será mantenido en todo momento y los datos sólo se analizaran de forma agrupada.
								</p>

								<p>
								Es importante que responda a todas las cuestiones, pues las omisiones invalidan el conjunto de la escala a la que está respondiendo. Responda rodeando con un círculo la alternativa adecuada o escribiendo las respuestas en los espacios que preceden a las cuestiones, según proceda. Compruebe al final que ha contestado a todas las preguntas.
								</p>


								<p>
								Esperamos que comprenda la importancia de este estudio para el colectivo profesional del que forma parte y para futuras intervenciones que pueden mejorar su calidad de vida y la de sus compañeros de profesión. Por ello, le solicitamos su colaboración. Solo le llevará alrededor de 30 minutos contestarlo.
								</p>

								<p> Muchas gracias por el tiempo que va a dedicar a responder a este cuestionario.</p>

								<p>
									En esta parte del cuestionario debe reflejar algunos datos personales. Con estos datos NO SE PRETENDE IDENTIFICARLE. Su objetivo es poder agrupar sus respuestas con la de otros profesionales de características similares a las suyas para ver si estas variables (por ejemplo: sexo, edad, antigüedad, tipo de servicio, etc. ) influyen sobre los niveles de estrés percibido.
								</p>										
							</div>
						</div>
						<div class="card-footer">
							<div class="row">
									<button type="button" class="btn btn-relief-success btn-lg btn-block" onclick="startQuiz()">
										INICIAR EVALUACION <i class="fa fa-play fa-lg"></i>
									</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xl-12"></diV>

			</div>
		@else
			<div class="col-md-12">
				<div class="col-md-3 col-sm-3 col-xl-12"></diV>
				<div class="col-md-6 col-sm-12 col-xl-12">
					<div class="card">
						<div class="card-body">
							<h3 class="card-title" style="text-align:center">MIS FACTORES PERSONALES DE RESILIENCIA</h3>
							<div class="col-md-12">
																		
							</div>
						</div>
						<div class="card-footer">
							<div class="row">
									<button type="button" class="btn btn-relief-success btn-lg btn-block" onclick="startQuiz()">
										INICIAR EVALUACION <i class="fa fa-play fa-lg"></i>
									</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xl-12"></diV>

			</div>
		@endif

	  </div>

      <div class="row" id="quiz">
		
		<div class="row" id="inicio" style="display:none">

			<div class="col-md-2 col-sm-2 col-xl-12"></diV>
			<div class="col-md-8 col-sm-12 col-xl-12">
				<div class="card">
					<div class="card-header"><h4 class="card-title">ESPECIFIQUE SU NUMERO DE CURP</h4></div>
					<div class="card-body">
							<!-- Curp Start -->
							<div class="col-md-12">
							<div class="mb-1">
							<div class="form-group">
									<input type="text" class="form-control" id="curp" name="curp" required maxlength="18">
									<div class="label label-danger">{{ $errors->first("curp") }}</div>
							</div>
							</div>
						</div>
						<!-- Curp End -->
					</div>
					<div class="card-footer">
						<div class="row">
								<button type="button" class="btn btn-relief-info btn-lg btn-block" onclick="validaCurp()">
									CONTINUAR EVALUACION <i class="fa fa-play fa-lg"></i>
								</button>
						</div>
					</div>
				</div>
			</div>
				<div class="col-md-2 col-sm-2 col-xl-12"></diV>

		</div>

		<div class="row" style="display:none" id="datos_generales">

			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
							<h4 class="card-title">Datos Generales</h4>
					</div>
					<div class="card-body">

				<div class="row" id="alert-new" style="display:none">

					<div class="alert alert-danger" role="alert">
						<h4 class="alert-heading">ATENCION</h4>
						<div class="alert-body">
							USTED NO SE ENCUENTRA REGISTRADO EN NUESTRO SISTEMA, POR FAVOR CAPTURA LA SIGUIENTE INFORMACION PARA CONTINUAR CON SU EVALUACION.
						</div>
					</div>

				</div>

				<div class="row">

					<input type="hidden" class="form-control" id="paciente_id" name="paciente_id" required>
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
							<!-- Telefono Start -->
							<div class="col-md-4">
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
							<div class="col-md-4">
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

					<div class="col-md-4">
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

					<div class="col-md-4">
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

					<div class="col-md-4">
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

					<div class="col-md-4">
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
					<div class="col-md-8 col-sm-12 col-xl-8 mb-1">
						<button type="button" class="btn btn-relief-danger" onclick="cancelaInicio();">
							<i class="fa fa-times fa-lg"></i> Cancelar
						</button>
					</div>
					<div class="col-md-4 col-sm-12 col-xl-4 mb-1" style="text-align:right">
						<button type="button" class="btn btn-relief-primary" onclick="iniciaQuiz()">
							Continuar <i class="fa fa-arrow-right fa-lg"></i>
						</button>
					</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		@if($type == 'general')

		<?php $total_cats = 0;?>

		@foreach($quiz as $key => $questions)
			<div class="col-md-12" id="cat_item_{{ $total_cats }}" style="display:none">

			<div class="card">
					<div class="card-header">
							<h4 class="card-title">{{ $total_cats + 1 }} de {{ count($quiz) }}: {{ str_replace('_',' ',$key) }} </h4>
					</div>
					<div class="card-body">
						<?php foreach($questions['preguntas'] as $qid => $questions) { ?>
							<div class="row mb-10">
									<div class="col-md-8 col-sm-12 col-xl-8 mb-1">{{ $questions['nombre'] }}</div>
									<div class="col-md-4 col-sm-12 col-xl-4 mb-1">
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
									</div>            			
							</div>
							<div class="row"><div class="col-md-12"><hr/></div></div>
							<?php } ?>
					</div>
					<div class="card-footer">
				<div class="row">
					<div class="col-md-6">
						<button type="button" class="btn btn-relief-warning" onclick="lastCat({{ $total_cats }})">
						<i class="fa fa-arrow-left fa-lg"></i> Atras
						</button>
					</div>
					<div class="col-md-6" style="text-align:right">

						@if($total_cats == (count($quiz) - 1))
						<button type="submit" class="btn btn-relief-success" onclick="nextCat({{ $total_cats }})">
							Finalizar <i class="fa fa-check-circle fa-lg"></i>
						</button>
						@else
						<button type="button" class="btn btn-relief-primary" onclick="nextCat({{ $total_cats }})">
							Continuar <i class="fa fa-arrow-right fa-lg"></i>
						</button>
						@endif
					</div>
						</div>
					</div>
				</div>

			</div>
			<?php $total_cats++;?>
		@endforeach

		@else

		<?php $total_cats = 0;?>
		@foreach($resilencia as $key => $questions)
			<div class="col-md-12" id="cat_item_{{ $total_cats }}" style="display:none">

			<div class="card">
				<div class="card-header">
					<h4 class="card-title">{{ $total_cats + 1 }} de {{ count($resilencia) }}: {{ str_replace('_',' ',$key) }} </h4>
				</div>
				<div class="card-body">
				<?php foreach($questions as $question) { ?>
				<div class="row mb-10">
								<div class="col-md-8 col-sm-12 col-xl-8 mb-1">{{ $question['pregunta'] }}</div>
								<div class="col-md-4 col-sm-12 col-xl-4 mb-1">
									<div class="form-group">
							<input type="hidden" class="form-control" name="$question[{{ $qid }}][answer_id]"  value="{{ $questions['answer_id'] }}"/>
							<input type="hidden" class="form-control" name="$question[{{ $qid }}][answer_type]"  value="{{ $questions['tipo'] }}"/>
							<select class="form-control" name="questions[{{ $qid }}][answer_value] }}]" required>
								<option value="">[ SELECCIONE ]</option>
							<option value="1">SI</option>
							<option value="0">NO</option>
							</select>
							</div>
								</div>            			
						</div>
						<div class="row"><div class="col-md-12"><hr/></div></div>    	
				<?php } ?>
				</div>
				<div class="card-footer">
				<div class="row">
					<div class="col-md-6">
						<button type="button" class="btn btn-relief-warning" onclick="lastCat({{ $total_cats }})">
							<i class="fa fa-arrow-left fa-lg"></i> Atras
						</button>
					</div>
					<div class="col-md-6" style="text-align:right">

						@if($total_cats == (count($resilencia) - 1))
						<button type="submit" class="btn btn-relief-success">
							Finalizar <i class="fa fa-check-circle fa-lg"></i>
						</button>
						@else
						<button type="button" class="btn btn-relief-primary" onclick="nextCat({{ $total_cats }})">
							Continuar <i class="fa fa-arrow-right fa-lg"></i>
						</button>
						@endif
					</div>
				</div>
				</div>
			</div>

			</div>
			<?php $total_cats++;?>
		@endforeach

		@endif

      </div>

    </form>

  </div>
</section>




@endsection
	

@section('scripts')

<style> input { text-transform: none; } </style>


<script>

  var total_cats = {{ (int)$total_cats }};

function startQuiz() {
	$('#inicio').fadeIn();
	$('#portada').fadeOut();
}

function validaCurp() {

	var curp = $('#curp').val();

	//validamos el tamaño de la curp
	if(curp == "" ) {

		Swal.fire({
		title: ' ¡ ATENCION !',
		text: "Debe de especificar su CURP para continuar",
		icon: 'warning',
		customClass: {
			confirmButton: 'btn btn-danger'
		},
		buttonsStyling: false
		});

		return false;
	}

	//validamos el tamaño de la curp
	if(curp.length <18) {

		Swal.fire({
		title: ' ¡ ATENCION !',
		text: "El CURP especificado debe de tener un minimo de 18 caracteres",
		icon: 'warning',
		customClass: {
			confirmButton: 'btn btn-danger'
		},
		buttonsStyling: false
		});

		return false;
	}

	//verificamos si el curp del paciente ha sido registrado
	$.ajax({
		url: "{{ url('admin/pacientes/curp') }}/" + curp,
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
		success: function(json) {

			if(json['error'] == 0) {

		$('#area_id').val(json['data'].area_id);
		$('#nombre').val(json['data'].nombre);
		$('#telefono').val(json['data'].telefono);
		$('#celular').val(json['data'].celular);
		$('#genero_id').val(json['data'].genero_id);
		$('#educacion_id').val(json['data'].educacion_id);
		$('#edo_civil_id').val(json['data'].edo_civil_id);
		$('#ocupacion_id').val(json['data'].ocupacion_id);
		$('#paciente_id').val(json['paciente_id']);

		$('#datos_generales').fadeIn();
		$('#inicio').fadeOut();

		$('#alert-new').fadeOut();

	} else {

		$('#alert-new').fadeIn();
		$('#datos_generales').fadeIn();
		$('#inicio').fadeOut();

	}

		}
	});



}

  function cancelaInicio() {

    $('#area_id').val("");
    $('#nombre').val("");
    $('#telefono').val("");
    $('#celular').val("");
    $('#genero_id').val("");
    $('#educacion_id').val("");
    $('#edo_civil_id').val("");
    $('#ocupacion_id').val("");
    $('#paciente_id').val("");

    $('#datos_generales').fadeOut();
    $('#inicio').fadeIn();

    $('#alert-new').fadeOut();

  }


  function iniciaQuiz() {

    $('#datos_generales').fadeOut();

    $('#cat_item_0').fadeIn();

  }

  function nextCat(actual) {

    //Validamos si estamos en la penultima linea

    $('#cat_item_' + actual).fadeOut();

    $('#cat_item_' + (actual + 1)).fadeIn();


  }

	$(document).on('change', '.images_select', function () {

		var indice = $(this).attr('data-indice');

		readURL(this,indice);

	});


  function lastCat(actual) {
    //Validamos si estamos en la penultima linea
    $('#cat_item_' + actual).fadeOut();

    $('#cat_item_' + (actual - 1)).fadeIn();

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

  //
</script>

@endsection
