

<div class="modal fade" id="modalPaciente" tabindex="10" role="dialog" aria-labelledby="modalVistaDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVistaDocumentoLabel"> Buscar Paciente
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
        					<label for="txtPacNombre" class="control-label"> Nombre </label>
        						<input type="text" class="form-control" id="txtPacNombre" name="txtPacNombre">
        				 </div>
        				</div>
        				<!-- Nombre End -->

        				<!-- Celular Start -->
        				<div class="col-md-6">
        				 <div class="form-group">
        					<label for="txtPacCelular" class="control-label"> Celular </label>
        						<input type="text" class="form-control" id="txtPacCelular" name="txtPacCelular">
        				 </div>
        				</div>
        				<!-- Celular End -->

                <!-- Telefono Start -->
        				<div class="col-md-6">
        				 <div class="form-group">
        					<label for="txtPacTelefono" class="control-label"> Telefono </label>
        						<input type="text" class="form-control" id="txtPacTelefono" name="txtPacTelefono">
        				 </div>
        				</div>
        				<!-- Telefono End -->



              </div>
              <div class="row">
                <table class="table display">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Telefono</th>
                      <th>Celular</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="itemsPacientes">

                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button class="btn btn-default waves-effect waves-light" type="button" onclick="btnTraePacientes()">
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
