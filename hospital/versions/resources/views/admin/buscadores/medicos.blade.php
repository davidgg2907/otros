<div class="modal fade" id="modalMedico" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel"> Buscar Medico
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </h5>

            </div>
            <div class="modal-body">
              <div class="row">
                <!-- Nombre Start -->
        				<div class="col-md-12">
        				 <div class="form-group">
        					<label for="nombre" class="control-label"> Nombre </label>
        						<input type="text" class="form-control" id="txtMedNombre" name="txtMedNombre">
        						<div class="label label-danger">{{ $errors->first("nombre") }}</div>
        				 </div>
        				</div>
        				<!-- Nombre End -->

        				<!-- Especialidad Start -->
        				<div class="col-md-4">
        				 <div class="form-group">
        					<label for="especialidad" class="control-label"> Especialidad </label>
        						<input type="text" class="form-control" id="txtMedEspecialidad" name="txtMedEspecialidad">
        						<div class="label label-danger">{{ $errors->first("especialidad") }}</div>
        				 </div>
        				</div>
        				<!-- Especialidad End -->

        				<!-- Cedula Start -->
        				<div class="col-md-4">
        				 <div class="form-group">
        					<label for="cedula" class="control-label"> Cedula </label>
        						<input type="text" class="form-control" id="txtMedCedula" name="txtMedCedula">
        						<div class="label label-danger">{{ $errors->first("cedula") }}</div>
        				 </div>
        				</div>
        				<!-- Cedula End -->

        				<!-- Celular Start -->
        				<div class="col-md-4">
        				 <div class="form-group">
        					<label for="celular" class="control-label"> Celular </label>
        						<input type="text" class="form-control" id="txtMedTelefono" name="txtMedTelefono">
        						<div class="label label-danger">{{ $errors->first("celular") }}</div>
        				 </div>
        				</div>
        				<!-- Celular End -->
              </div>
              <div class="row">
                <table class="table display">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Especialidad</th>
                      <th>Cedula</th>
                      <th>Telefono</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="itemsMedicos">

                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button class="btn btn-default waves-effect waves-light" type="button" onclick="btnTraeMedicos()">
                  <span class="btn-label"><i class="fa fa-search fa-lg"></i></span>Buscar
                </button>

                <button  class="btn btn-danger" title="Cerrar Ventana" data-dismiss="modal" >
                  <span class="btn-label"><i class="fa fa-times fa-lg"></i></span>Cerrar
                </button>

              </div>
            </div>
        </div>
    </div>
</div>
