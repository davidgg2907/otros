

<div class="col-md-12">
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

			</div>

		</div>
	</div>
</div>

<input type="hidden" class="form-control" id="status" name="status" value="1">


@section('scripts')

<style> input { text-transform: none; } </style>


<script>



	function readURL(input,indice) {
	  if (input.files && input.files[0]) {
			$('#imgPreview' + indice).html('');
		  var reader = new FileReader();
	    reader.onload = function(e) {
		   $('#imgPreview').html('<img src="' + e.target.result + '"  class="rounded-circle img-border gradient-summer" height="150" alt="Card image">');
	    }
	    reader.readAsDataURL(input.files[0]);
	  } else {
	    $('#imgPreview').attr('src', '<img src="{{ asset('/') }}/img/portrait/avatars/avatar-08.png" class="rounded-circle img-border gradient-summer " height="150" alt="Card image">');
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
