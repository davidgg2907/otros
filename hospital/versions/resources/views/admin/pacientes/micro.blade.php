<div class="row">
  <div class="col-md-3 col-xs-12">
      <div class="white-box">
          <div class="user-bg" style="height: auto !important">
            <?php if($data->fotografia) { ?>
              <img width="100%" alt="user" src="<?php echo asset('uploads/pacientes/' . $data->fotografia)?>">
            <?php } else { ?>
              <img width="100%" alt="user" src="<?php echo asset('uploads/paciente.jpeg')?>">
            <?php } ?>
          </div>
          <div class="user-btm-box">
              <!-- .row -->
              <div class="row text-center m-t-10">
                  <div class="col-md-12 b-r"><strong>Nombre</strong>
                      <p>{{ $data->nombre }}</p>
                  </div>
              </div>
              <!-- /.row -->
              <hr>
              <!-- .row -->
              <div class="row text-center m-t-10">
                  <div class="col-md-12"><strong>Sexo</strong>
                      <p>{{ $data->sexo }}</p>
                  </div>
              </div>
              <!-- /.row -->
              <hr>
              <!-- .row -->
              <div class="row text-center m-t-10">
                  <div class="col-md-12 b-r"><strong>Telefono</strong>
                      <p>{{ $data->telefono }}</p>
                  </div>
              </div>
              <!-- /.row -->
              <hr>
              <!-- .row -->
              <!-- .row -->
              <div class="row text-center m-t-10">
                  <div class="col-md-12"><strong>Celular</strong>
                      <p>{{ $data->celular }}</p>
                  </div>
              </div>
              <!-- /.row -->
              <hr>
              <!-- .row -->
              <div class="row text-center m-t-10">
                  <div class="col-md-12"><strong>Domicilio</strong>
                      <p>{{ $data->domicilio }}</p>
                  </div>
              </div>
              <hr>
              <!-- /.row -->
          </div>
      </div>
  </div>
  <div class="col-md-9 col-xs-12">
      <div class="white-box">
        <div class="row">
          <div class="col-md-3 col-xs-6 b-r"> <strong>T. de Sangre</strong>
              <br>
              <p class="text-muted">{{ $data->tsangre }}</p>
          </div>
          <div class="col-md-3 col-xs-6 b-r"> <strong>F. Nacimiento</strong>
              <br>
              <p class="text-muted">{{ $data->nacimiento }}</p>
          </div>
          <div class="col-md-3 col-xs-6 b-r"> <strong>U. Consulta</strong>
              <br>
              <p class="text-muted">
                <?php
                  $consulta = $data->ultimaConsulta($data->id);
                  if(count($consulta)) {
                    echo $consulta->fecha;
                  } else {
                    echo 'NINGUNA';
                  }
                ?>
              </p>
          </div>
          <div class="col-md-3 col-xs-6"> <strong>U. Hospitalizacion</strong>
              <br>
              <p class="text-muted">
                <?php
                  $ingreso = $data->ultimaHospitalizacion($data->id);
                  if(count($ingreso)) {
                    echo $ingreso->fecha;
                  } else {
                    echo 'NINGUNA';
                  }
                ?>
              </p>
          </div>
        </div>
          <hr>

      </div>

      <div class="white-box">
        <div class="row">
          <!-- .tabs -->
          <ul class="nav nav-tabs tabs customtab">
              <li class="active tab">
                  <a href="#home" data-toggle="tab">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Generales</span>
                  </a>
              </li>
              <li class="tab">
                  <a href="#clinica" data-toggle="tab">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">E. Clinica</span>
                  </a>
              </li>
              <li class="tab">
                  <a href="#biography" data-toggle="tab">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Recetas</span>
                  </a>
              </li>
              <li class="tab">
                  <a href="#update" data-toggle="tab">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Hospitalizaciones</span>
                  </a>
              </li>

              <li class="tab">
                  <a href="#laboratorio" data-toggle="tab">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Laboratorio</span>
                  </a>
              </li>

          </ul>
          <!-- /.tabs -->
        </div>
      </div>

      <div class="tab-content">
          <!-- .tabs 1 -->
          <div class="tab-pane active" id="home">

            <div class="white-box">
              <div class="row">
                <h3>Antecedentes Hereditarios</h3>
                <p>{!! $data->hereditarias != "" ? $data->hereditarias : "NINGUNA" !!}</p>
              </div>

              <div class="row"> <hr> </div>

              <div class="row">
                <h3>Antecedentes Patologicos</h3>
                <p>{!! $data->alergias != "" ? $data->alergias : "NINGUNA" !!}</p>
              </div>

              <div class="row"> <hr> </div>

              <div class="row">
                <h3>Padecimiento Actual</h3>
                <p>{!! $data->cirugias != "" ? $data->cirugias : "NINGUNA" !!}</p>
              </div>

              <div class="row"> <hr> </div>

              <div class="row">
                <h3>Exploracion Fisica</h3>
                <p>{!! $data->vicios != "" ? $data->vicios : "NINGUNA" !!}</p>
              </div>
            </div>

          </div>
          <!-- /.tabs1 -->

          <!-- .tabs 3 -->
          <div class="tab-pane" id="clinica">

            <div class="white-box">
              <div class="row">
                <h3>Valoracion Clinica</h3>
              </div>
            </div>

            <?php foreach($data->misConsultas as $consultas) { ?>
              <div class="col-md-12">
              	<div class="panel panel-default">
              		<div class="panel-heading"> {{ $consultas->doctor->nombre }} {{ date('d/m/Y',strtotime($consultas->fecha)) }}</div>
              		<div class="panel-wrapper collapse in" aria-expanded="true">
              			<div class="panel-body">
                      <h4>Motivo de Visita:</h4>
                      <p>{!! $consulta->razon_visita !!}</p>
                      <p><hr/></p>
                      <h4>Diagnostico:</h4>
                      <p>{!! $consulta->diagnostico !!}</p>
              			</div>
                    <div class="panel-footer">
                      <div class="row text-right">
                        <a target="_blank" href="{{ url('admin/consultas/ficha/' . $consultas->id) }}" class="btn btn-primary"> <li class="fa fa-print fa-lg"></li> Impirimir Ficha</a>
                      </div>
                    </div>
              		</div>
              	</div>
              </div>
            <?php } ?>
          </div>
          <!-- /.tabs 3 -->

          <!-- .tabs 2 -->
          <div class="tab-pane" id="biography">
            <div class="white-box">
              <div class="row">
                <h3>Recetas y Medicamentos</h3>
              </div>
            </div>

            <?php foreach($data->misRecetas as $recetas) { ?>

              <div class="col-md-12">
              	<div class="panel panel-default">
              		<div class="panel-heading"> {{ $recetas->doctor->nombre }} {{ date('d/m/Y',strtotime($recetas->fecha)) }}</div>
              		<div class="panel-wrapper collapse in" aria-expanded="true">
              			<div class="panel-body">
                        <p>{!! $recetas->medicamentos !!}</p>
              			</div>
                    <div class="panel-footer">
                      <div class="row text-right">
                        <a target="_blank" href="{{ url('admin/recetas/print/' . $recetas->id) }}" class="btn btn-primary"> <li class="fa fa-print fa-lg"></li> Impirimir Receta</a>
                      </div>
                    </div>
              		</div>
              	</div>
              </div>

            <?php } ?>
          </div>
          <!-- /.tabs2 -->

          <!-- .tabs 3 -->
          <div class="tab-pane" id="update">
            <div class="white-box">
              <div class="row">
                <h3>Hospitalizaciones</h3>
              </div>
            </div>

            <?php foreach($data->misHospitalizaciones as $ingresos) { ?>

              <div class="col-md-12">
              	<div class="panel panel-default">
              		<div class="panel-heading"> {{ $ingresos->doctor->nombre }}, F.Ingreso: {{ date('d/m/Y',strtotime($ingresos->fecha)) }}</div>
              		<div class="panel-wrapper collapse in" aria-expanded="true">
              			<div class="panel-body">
                      <h4>Motivo de Ingreso:</h4>
                      <p>{!! $ingresos->motivo !!}</p>

                      <p><hr/></p>

                      <h4>Servicios Adjuntos</h4>

                      <table class="table">
                        <thead>
                          <tr>
                            <th>Concepto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Importe</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($ingresos->getServicios($ingresos->id) as $value) { ?>
                            <tr id="items_<?php echo $items; ?>">
                              <td style="width:50%"> {{ $value->descripcion }} </td>
                              <td class="text-center"> {{ $value->cantidad }} </td>
                              <td class="text-center"> $ {{ number_format($value->precio,2,".",",") }} </td>
                              <td class="text-center">
                                $ {{ number_format($value->importe,2,".",",") }}
                              </td>
                            </tr>
                            <?php $items++; ?>
                          <?php } ?>
                        </tbody>
                      </table>

              			</div>
                    <div class="panel-footer">
                      <div class="row text-right">
                        <!--<button class="btn btn-primary"> <li class="fa fa-print fa-lg"></li> Impirimir Ficha</button> -->
                      </div>
                    </div>
              		</div>
              	</div>
              </div>
            <?php } ?>
          </div>
          <!-- /.tabs 3 -->

          <!-- .tabs 3 -->
          <div class="tab-pane" id="laboratorio">
            <div class="white-box">
              <div class="row">
                <h3>Laboratoriales</h3>
              </div>
            </div>

            <?php foreach($data->misAnalisis as $laboratorio) { ?>
              <div class="white-box">
                <div class="row">
                  <div class="col-md-12">
                    <h5> {{ $laboratorio->fecha }}</h5>
                    <p>{{ $laboratorio->nombre }}</p>
                    <p></p>
                    <p>Pre Diagnostico:</p>
                    <p>{!! $laboratorio->diagnostico !!}</p>
                  </div>

                  <?php if($laboratorio->archivo) { ?>
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                      <a href="{{ asset('uploads/Laboratorio/' . $laboratorio->archivo)}}" class="btn btn-primary"> <li class="fa fa-download fa-lg"></li> Descargar Archivo</a>
                    </div>
                  <?php } ?>
                </div>
              </div>
            <?php } ?>
          </div>
          <!-- /.tabs 3 -->

      </div>


  </div>
</div>
