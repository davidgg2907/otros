@extends('layouts.app')

@section('content')

<section>
  <form class="needs-validation" novalidate action="<?php echo url('/'); ?>/admin/importar" id="formValidation" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="row">

      <div class="col-sm-10">
        <div class="card">
            <div class="card-header"> <h4 class="card-title">Importar Archivo</h4> </div>
            <div class="card-body">
              <div class="row">
                <div class="row">

                  <!-- Nombre Start -->
                  <div class="col-md-4">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="nombre" class="control-label mb-1"> Archivo de Plataforma  </label>
                      <select class="form-control" name="plataforma" id="plataforma" required>
                        <option value="ML"> MERCADO LIBRE </option>
                        <option value="AMZ"> AMAZON </option>
                      </select>
                     </div>
                    </div>
                  </div>

                  <div class="col-md-8">
                    <div class="mb-1">
                     <div class="form-group">
                      <label for="nombre" class="control-label mb-1"> Seleccione la Tienda a afectar </label>
                      <select class="form-control" name="tienda_id" id="tienda_id" required>
                        <option value=""> [ SELECCIONE ] </option>
                        <?php foreach(\App\admin\Tiendas::where('status',1)->get() as $value) { ?>
                          <option value="{{ $value->id }}"> {{ $value->nombre }} </option>
                        <?php } ?>
                      </select>
                     </div>
                    </div>
                  </div>
                  <!-- Nombre End -->

                </div>
              </div>
            </div>
          </div>


        <div class="card">
      			<div class="card-header"> <h4 class="card-title">Importar Archivo</h4> </div>
      			<div class="card-body">
      				<div class="row">
                <div class="row">



                  <!-- Nombre Start -->
        					<div class="col-md-12">
        						<div class="mb-1">
        						 <div class="form-group">
        							<label for="nombre" class="control-label mb-1"> Seleccione el archivo de lotes a cargar </label>
        							<input type="file" class="form-control" id="lotes_file" name="lotes_file" required>
        						 </div>
        						</div>
        					</div>
        					<!-- Nombre End -->
                </div>
      				</div>
      			</div>
      		</div>

      </div>

      <div class="col-xl-2 col-md-4 col-12">
        <div class="card">
          <div class="card-body">
            <button type="submit" class="btn btn-relief-success w-100 mb-75 waves-effect"><i class="fa fa-download fa-lg"></i> Importar </button>
          </div>
        </div>
      </div>

    </div>
  </form>

</section>

@endsection



@section('scripts')

<script>

var bootstrapForm = $('.needs-validation'),
	jqForm = $('#jquery-val-form'),
	picker = $('.picker'),
	select = $('.select2');

// select2
select.each(function () {
	var $this = $(this);
	$this.wrap('<div class="position-relative"></div>');
	$this
		.select2({
			placeholder: 'Select value',
			dropdownParent: $this.parent()
		})
		.change(function () {
			$(this).valid();
		});
});

// Picker
if (picker.length) {
	picker.flatpickr({
		allowInput: true,
		onReady: function (selectedDates, dateStr, instance) {
			if (instance.isMobile) {
				$(instance.mobileInput).attr('step', null);
			}
		}
	});
}

// Bootstrap Validation
// --------------------------------------------------------------------
if (bootstrapForm.length) {
	Array.prototype.filter.call(bootstrapForm, function (form) {
		form.addEventListener('submit', function (event) {
			if (form.checkValidity() === false) {
				form.classList.add('invalid');
			} else {
				procesando();
				form.submit();
			}

			form.classList.add('was-validated');
			event.preventDefault();

		});
	});
}

</script>

@endsection
