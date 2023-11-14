<?php $__env->startSection('content'); ?>

<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title"><?php echo e($config['titulo']); ?></h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
     <?php echo $__env->make('layouts.breadcrumbs',[ 'breadcrumbs' => $config['breadcrumbs'] ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
  <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-sm-12">
      <div class="white-box">
          <div class="pull-right">
          	<a href="<?php echo e($config['cancelar']); ?>" class="btn btn-default ">
              <li class="fa fa-times fa-2x"></li>&nbsp;<br>Cancelar
            </a>
          </div>
          <div class="clear"></div>
      </div>
    </div>
</div>


<div class="row">
  <div class="col-md-4 col-xs-12">
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
                  <div class="col-md-6 b-r"><strong>Nombre</strong>
                      <p><?php echo e($data->nombre); ?></p>
                  </div>
                  <div class="col-md-6"><strong>Sexo</strong>
                      <p><?php echo e($data->sexo); ?></p>
                  </div>
              </div>
              <!-- /.row -->
              <hr>
              <!-- .row -->
              <div class="row text-center m-t-10">
                  <div class="col-md-6 b-r"><strong>Telefono</strong>
                      <p><?php echo e($data->telefono); ?></p>
                  </div>
                  <div class="col-md-6"><strong>Celular</strong>
                      <p><?php echo e($data->celular); ?></p>
                  </div>
              </div>
              <!-- /.row -->
              <hr>
              <!-- .row -->
              <div class="row text-center m-t-10">
                  <div class="col-md-12"><strong>Domicilio</strong>
                      <p><?php echo e($data->domicilio); ?></p>
                  </div>
              </div>
              <hr>
              <!-- /.row -->
          </div>
      </div>
  </div>
  <div class="col-md-8 col-xs-12">
      <div class="white-box">
        <div class="row">
          <div class="col-md-3 col-xs-6 b-r"> <strong>T. de Sangre</strong>
              <br>
              <p class="text-muted"><?php echo e($data->tsangre); ?></p>
          </div>
          <div class="col-md-3 col-xs-6 b-r"> <strong>F. Nacimiento</strong>
              <br>
              <p class="text-muted"><?php echo e($data->nacimiento); ?></p>
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
                  <a href="#home" data-toggle="tab" title="Informacion General">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Generales</span>
                  </a>
              </li>
              <li class="tab">
                  <a href="#clinica" data-toggle="tab" title="Valoracion Clinica">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">E. Clinica</span>
                  </a>
              </li>
              <li class="tab">
                  <a href="#biography" data-toggle="tab" title="Recetas y Medicamentos">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Recetas</span>
                  </a>
              </li>
              <!--<li class="tab">
                  <a href="#update" data-toggle="tab" title="Historial de Hospitalizaciones">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Hospitalizaciones</span>
                  </a>
              </li>-->

              <li class="tab">
                  <a href="#laboratorio" data-toggle="tab" title="Labotatoriales">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Laboratorio</span>
                  </a>
              </li>

              <li class="tab">
                  <a href="#notasmedicas" data-toggle="tab" title="Notas Medicas">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Notas M.</span>
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
                <p><?php echo $data->hereditarias != "" ? $data->hereditarias : "NINGUNA"; ?></p>
              </div>

              <div class="row"> <hr> </div>

              <div class="row">
                <h3>Antecedentes Patologicos</h3>
                <p><?php echo $data->alergias != "" ? $data->alergias : "NINGUNA"; ?></p>
              </div>

              <div class="row"> <hr> </div>

              <div class="row">
                <h3>Padecimiento Actual</h3>
                <p><?php echo $data->cirugias != "" ? $data->cirugias : "NINGUNA"; ?></p>
              </div>

              <div class="row"> <hr> </div>

              <div class="row">
                <h3>Exploracion Fisica</h3>
                <p><?php echo $data->vicios != "" ? $data->vicios : "NINGUNA"; ?></p>
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
              		<div class="panel-heading"> <?php echo e($consultas->doctor->nombre); ?> <?php echo e(date('d/m/Y',strtotime($consultas->fecha))); ?></div>
              		<div class="panel-wrapper collapse in" aria-expanded="true">
              			<div class="panel-body">

                      <h4 style="margin-bottom:10px;">Signos Vitales:</h4>
                      <p><br/>
                        <table style="font-size: 10px; width:100%">
                          <tbody>
                            <tr>
                              <td style="width:3%">F.C.</td>
                              <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($data->fc); ?></td>
                              <td style="width:3%">F.R.</td>
                              <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($data->fr); ?></td>
                              <td style="width:2%">T.</td>
                              <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($data->temperatura); ?></td>
                              <td style="width:5%">Peso</td>
                              <td style="border-bottom:1px solid #999999; text-align:center"><?php echo e($data->peso); ?> Kg.</td>
                            <tr style="">
                            </tr>
                              <td style="width:5%;padding-top:10px;">Talla</td>
                              <td style="border-bottom:1px solid #999999; text-align:center;padding-top:10px;"><?php echo e($data->talla); ?> C.m</td>
                              <td style="width:3%;padding-top:10px;">T/A</td>
                              <td style="border-bottom:1px solid #999999; text-align:center;padding-top:10px;"> <?php echo e($data->ta1); ?>/ <?php echo e($data->ta2); ?> </td>
                              <td style="width:5%;padding-top:10px;">Sat O <sup>2</sup></td>
                              <td style="border-bottom:1px solid #999999; text-align:center;padding-top:10px;"><?php echo e($data->sato2); ?> %</td>
                            </tr>
                          </tbody>
                        </table>
                      </p>

                      <p><br/><hr/></p>

                      <h4>Seguimiento Clinico:</h4>
                      <p><?php echo $consulta->razon_visita; ?></p>
                      <p><hr/></p>
                      <h4>Diagnostico Clinico:</h4>
                      <p><?php echo $consulta->diagnostico; ?></p>
              			</div>
                    <div class="panel-footer">
                      <div class="row text-right">
                        <a target="_blank" href="<?php echo e(url('admin/consultas/ficha/' . $consultas->id)); ?>" class="btn btn-primary"> <li class="fa fa-print fa-lg"></li> Impirimir Ficha</a>
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
              		<div class="panel-heading"> <?php echo e($recetas->doctor->nombre); ?> <?php echo e(date('d/m/Y',strtotime($recetas->fecha))); ?></div>
              		<div class="panel-wrapper collapse in" aria-expanded="true">
              			<div class="panel-body">
                        <p><?php echo $recetas->medicamentos; ?></p>
              			</div>
                    <div class="panel-footer">
                      <div class="row text-right">
                        <a target="_blank" href="<?php echo e(url('admin/recetas/print/' . $recetas->id)); ?>" class="btn btn-primary"> <li class="fa fa-print fa-lg"></li> Impirimir Receta</a>
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
              		<div class="panel-heading"> <?php echo e($ingresos->doctor->nombre); ?>, F.Ingreso: <?php echo e(date('d/m/Y',strtotime($ingresos->fecha))); ?></div>
              		<div class="panel-wrapper collapse in" aria-expanded="true">
              			<div class="panel-body">
                      <h4>Motivo de Ingreso:</h4>
                      <p><?php echo $ingresos->motivo; ?></p>

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
                              <td style="width:50%"> <?php echo e($value->descripcion); ?> </td>
                              <td class="text-center"> <?php echo e($value->cantidad); ?> </td>
                              <td class="text-center"> $ <?php echo e(number_format($value->precio,2,".",",")); ?> </td>
                              <td class="text-center">
                                $ <?php echo e(number_format($value->importe,2,".",",")); ?>

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

        <!-- .tabs 4 -->
        <div class="tab-pane" id="laboratorio">
            <div class="white-box">
              <div class="row">
                <h3>Estudios de Laboratorio y Gabinete</h3>
              </div>
            </div>

            <?php foreach($data->misAnalisis as $laboratorio) { ?>
              <div class="white-box">
                <div class="row">
                  <div class="col-md-12">
                    <h5> <?php echo e($laboratorio->fecha); ?></h5>
                    <p><?php echo e($laboratorio->nombre); ?></p>
                    <p></p>
                    <p>Pre Diagnostico:</p>
                    <p><?php echo $laboratorio->diagnostico; ?></p>
                  </div>

                  <div class="col-md-6"></div>
                  <?php if($laboratorio->archivo) { ?><div class="col-md-3"><?php } else { ?> <div class="col-md-6 text-right"><?php } ?>
                    <a target="_blank" href="<?php echo e(url('admin/pacientes/laboratorio/ficha/' . $laboratorio->id)); ?>" class="btn btn-info"> <li class="fa fa-download fa-lg"></li> Descargar Ficha</a>
                  </div>
                  <?php if($laboratorio->archivo) { ?>
                    <div class="col-md-3">
                      <a target="_blank" href="<?php echo e(asset('uploads/Laboratorio/' . $laboratorio->archivo)); ?>" class="btn btn-primary"> <li class="fa fa-download fa-lg"></li> Descargar Archivo</a>
                    </div>
                  <?php } ?>
                </div>
              </div>
            <?php } ?>
          </div>
        <!-- /.tabs 4 -->

        <!-- .tabs 5 -->
        <div class="tab-pane" id="notasmedicas">
            <div class="white-box">
              <div class="row">
                <h3>Mis Notas Medica</h3>
              </div>
            </div>

            <?php foreach($data->misNotas as $nota) { ?>
              <div class="white-box">
                <div class="row">
                  <div class="col-md-12">
                    <h5> <?php echo e($nota->fecha); ?> - <?php echo e($nota->hora); ?></h5>
                    <p>
                      <strong>
                      <?php
                        if($nota->tipo == 1) { echo 'Analisis Clinico'; }
                        elseif($nota->tipo == 2) { echo 'Estudio Clinico'; }
                        elseif($nota->tipo == 3) { echo 'Medicamentos'; }
                      ?>
                      </strong>
                    </p>
                    <p></p>
                    <p><?php echo $nota->nota_medica; ?></p>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        <!-- /.tabs 5 -->
      </div>


  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>