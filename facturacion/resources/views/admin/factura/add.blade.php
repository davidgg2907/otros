@extends('layouts.app')

@section('content')

<section>    
    <div class="row">
    <div class="col-sm-12">
  		<div class="card">
          <div class="card-header">
              <h4 class="card-title">Agregar factura</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <!-- Id Start -->
              <form action="{{ url('admin/factura/add') }}" enctype="multipart/form-data" class="dropzone" id="image-upload">
              {{ csrf_field() }}
                <div>
                  <h4>Seleccione o arrastre los archivos XML que desea cargar</h4>
                </div>
                <div class="fallback">
                  <input name="file" type="file" multiple />
                </div>
              </form>
            </div>
  				</div>
          <div class="card-footer">
            <div class="row">
            </div>
          </div>
    		</div>
    </div>

  </div>
</section>

@endsection

@section('scripts')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

 <script type="text/javascript">
   /* 
  Dropzone.options.myDropzone = { uploadMultiple: true };

  myDropzone.on("complete", function(file) {
    alert('archivos cargados exitosamente');
  });
  */

  Dropzone.options.uploadForm = { // The camelized version of the ID of the form element

    // The configuration we've talked about above
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFiles: 100,

    // The setting up of the dropzone
    init: function() {
      var myDropzone = this;

      // First change the button to actually tell Dropzone to process the queue.
      this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
        // Make sure that the form isn't actually being sent.
        e.preventDefault();
        e.stopPropagation();
        myDropzone.processQueue();
      });

      // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
      // of the sending event because uploadMultiple is set to true.
      this.on("sendingmultiple", function() {
        alert("ENVIANDO ARCHIVOS POR FAVOR ESPERE");
      });
      this.on("successmultiple", function(files, response) {
        // Gets triggered when the files have successfully been sent.
        // Redirect user or notify of success.
        alert("DOCUMENTOS CARGADOS EXITOSAMENTE");
      });
      this.on("errormultiple", function(files, response) {
        // Gets triggered when there was an error sending the files.
        // Maybe show form again, and notify user of error
        alert("SE HA PRODUCIDO UN ERROR INESPERADO, NO SE PUEDE CARGAR UNO O MAS DOCUMENTOS");
      });
    }

   }
</script>

@endsection