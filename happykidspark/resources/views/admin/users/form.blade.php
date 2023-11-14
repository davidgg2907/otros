<div class="col-md-3">
	<div class="card">
		<div class="card-header">
      <h4 class="card-title"> <i class="fa fa-user-circle"></i> FOTOGRAFIA</h4>
    </div>
		<div class="card-body">
			<div class="row">
				<!-- Photo Start -->
				<div class="col-md-12">
					<div class="align-self-center halfway-fab text-center" id="imgPreview">
							<?php if($data->photo) { ?>
								<img onclick="$('#profile_image').trigger('click')" src="{{ asset('uploads/usuarios/' . $data->photo) }}" class="rounded-circle img-border gradient-summer" height="200" alt="Card image">
							<?php } else { ?>
								<img onclick="$('#profile_image').trigger('click')" src="{{ asset('/') }}images/portrait/small/avatar-s-4.jpg" class="rounded-circle img-border gradient-summer " height="200" alt="Card image">
							<?php } ?>
					</div>
					<input type="file" name="photo" class="images_select" id="profile_image" style="display:none" data-indice="0" />
				</div>
				<!-- Photo End -->
			</div>
		</div>
	</div>
</div>

<div class="col-md-9">
	<div class="card">
		<div class="card-header">
      <h4 class="card-title"> <i class="fa fa-key"></i> CREDENCIALES DE ACCESOS</h4>
    </div>
		<div class="card-body">
			<div class="row">

				<!-- Name Start -->
				<div class="col-md-12">
					<div class="mb-1">
					 <div class="form-group">
						<label for="name" class="control-label"> Nombre Completo </label>
							<input type="text" class="form-control" id="name" name="name" maxlength="150" minlength="3"  required="required" pattern="[A-Za-zñÑ ]{3,}"
							value="{{{ isset($data->name ) ? $data->name  : old('name') }}}">
							<div class="invalid-tooltip">Corrija la siguiente informacion para continuar</div>
					 </div>
				 	</div>
				</div>
				<!-- Name End -->


				<!-- Perfil Start -->
				<div class="col-md-6">
					<div class="mb-1">
					 <div class="form-group">
						<label for="perfil" class="control-label"> Perfil </label>
						<select class="form-control" id="perfil" name="perfil" required="required">
							<option value="">[ SELECCIONE ]</option>
							<?php foreach(\App\admin\Users::PERFILES as $key => $value) { ?>
								<option value="{{ $key }}" <?php if($data->perfil == $key) { echo 'selected'; }?>>{{ $value }}</option>
							<?php } ?>
						</select>
						<div class="invalid-tooltip">Corrija la siguiente informacion para continuar</div>
					 </div>
					</div>
				</div>
				<!-- Perfil End -->


				<!-- Rol_id Start -->
				<div class="col-md-6">
					<div class="mb-1">
					 <div class="form-group">
						<label for="rol_id" class="control-label"> Permisos y Accesos </label>
						<select class="form-control" id="rol_id" name="rol_id" required="required">
							<option value="">[ SELECCIONE ]</option>
							<?php foreach(\App\admin\Roles::where('status',1)->get() as $value) { ?>
								<option value="{{ $value->id }}" <?php if($data->rol_id == $value->id) { echo 'selected'; } ?>>{{ $value->name }}</option>
							<?php } ?>
						</select>
						<div class="invalid-tooltip">Corrija la siguiente informacion para continuar</div>
					 </div>
					</div>
				</div>
				<!-- Rol_id End -->

				<!-- Email Start -->
				<div class="col-md-6">
					<div class="mb-1">
					 <div class="form-group">
						<label for="email" class="control-label"> Email </label>
							<input type="text" class="form-control" id="email" name="email" maxlength="150" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
							value="{{{ isset($data->email ) ? $data->email  : old('email') }}}">
							<div class="invalid-tooltip">Corrija la siguiente informacion para continuar</div>
					 </div>
					</div>
				</div>
				<!-- Email End -->

				<!-- Password Start -->
				<div class="col-md-3">
					<div class="mb-1">
					 <div class="form-group">
						<label for="password" class="control-label"> Password </label>
							<input type="text" class="form-control" id="password" name="password"  <?php if(!$data->id) { ?> required="required"  <?php } ?>>
							<div class="invalid-tooltip">Corrija la siguiente informacion para continuar</div>
					 </div>
					</div>
				</div>
				<!-- Password End -->

				<!-- Password Start -->
				<div class="col-md-3">
					<div class="mb-1">
					 <div class="form-group">
						<label for="password" class="control-label"> Confirmar Passsword </label>
							<input type="text" class="form-control" id="password_confirmation" name="password_confirmation" <?php if(!$data->id) { ?> required="required" <?php } ?>>
							<div class="invalid-tooltip">Corrija la siguiente informacion para continuar</div>
					 </div>
					</div>
				</div>
				<!-- Password End -->

				<!-- Rol_id Start -->
				<?php $cats = array(); foreach(explode(',',$data->categoria_id) as $cat) { $cats[] = $cat; }; ?>
				<div class="col-md-12" id="cajeroCategorias" @if($data->perfil == 0) style="display:block" @else style="display:none" @endif>
					<div class="mb-1">
					 <div class="form-group">
						<label for="rol_id" class="control-label"> Seleccione las categorias que puede vender el cajero</label>
						<select class="form-control select2" multiple id="categoria_id" name="categoria_id[]">
							<?php foreach(\App\admin\Categorias::where('status',1)->get() as $value) { ?>
								<option value="{{ $value->id }}" @if(in_array($value->id,$cats)) selected @endif>{{ $value->nombre }}</option>
							<?php } ?>
						</select>
						<label for="rol_id" class="control-label text-danger"> Dejar vacio este campo en el perfil de cajero, permitira ver todas las categorias </label>
						<div class="invalid-tooltip">Corrija la siguiente informacion para continuar</div>
					 </div>
					</div>
				</div>
				<!-- Rol_id End -->

			</div>

		</div>
	</div>
</div>

<input type="hidden" class="form-control" id="status" name="status" value="1">


@section('scripts')

<style> input { text-transform: none; } </style>


<script>

	$('#perfil').on('change',function(){

		if($(this).val() == 1) {
			$('#cajeroCategorias').fadeIn('fast');
		} else {
			$('#cajeroCategorias').fadeOut('fast');
		}

	});


	$('#categoria_id').on('change',function(){

		if($(this).val() == 0) {
			$('#categoria_id').val("");
			$('#categoria_id').val("0");
		}
		$('.select2').select2();

	});


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

		$('.select2').select2();

		console.log("SELECCIONADOS");
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
