@extends('layouts.app')

@section('content')

<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">{{{ $config['titulo'] }}}</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
     @include('layouts.breadcrumbs',[ 'breadcrumbs' => $config['breadcrumbs'] ])
  </div>
  <!-- /.col-lg-12 -->
</div>

<div class="row">
  <div class="col-sm-12">
      <div class="white-box">
          <div class="pull-right">
          	<a href="{{{ $config['cancelar'] }}}" class="btn btn-default ">
              <li class="fa fa-times fa-2x"></li>&nbsp;<br>Cancelar
            </a>
          </div>
          <div class="clear"></div>
      </div>
    </div>
</div>

<div class="row">
  <div class="row">
      <div class="col-md-4 col-xs-12">
          <div class="white-box">
              <div class="user-bg">
                <?php if($data->fotografia) { ?>
                  <img width="100%" alt="user" src="<?php echo asset('uploads/enfermeras/' . $data->fotografia)?>">
                <?php } else { ?>
                  <img width="100%" alt="user" src="<?php echo asset('uploads/medico.png')?>">
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
                    <div class="col-md-6"><strong>Telefono</strong>
                        <p>{{ $data->celular}}</p>
                    </div>
                      <div class="col-md-6"><strong>Cedula</strong>
                          <p>{{ $data->cedula}}</p>
                      </div>
                  </div>
                  <!-- /.row -->
                  <hr>
                  <!-- .row -->
                  <div class="row text-center m-t-10">
                      <div class="col-md-12"><strong>Direccion</strong>
                          <p>{{ $data->domicilio}}</p>
                      </div>
                  </div>
                  <hr>
                  <!-- /.row -->
              </div>
          </div>
      </div>
      <div class="col-md-8 col-xs-12">
          <div class="white-box">
              <!-- .tabs -->
              <ul class="nav nav-tabs tabs customtab">
                  <li class="active tab">
                      <a href="#home" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Mis Consultorios</span> </a>
                  </li>
                  <li class="tab">
                      <a href="#biography" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Mis Rondas</span> </a>
                  </li>
                  <li class="tab">
                      <a href="#update" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Mis Citas</span> </a>
                  </li>
              </ul>
              <!-- /.tabs -->
              <div class="tab-content">
                  <!-- .tabs 1 -->
                  <div class="tab-pane active" id="home">
                    <table class="table display ">
                      <thead>
                        <tr>
                          <th>Consultorio</th>
                          <th>Dia</th>
                          <th>Horario</th>
                        </tr>
                      </thead>
                      <?php foreach($consultorios as $value) { ?>
                        <tr>
                          <td>{{ $value->numero . ' ' . $value->descripcion }}</td>
                          <td>{{ $value->dia_laboral }}</td>
                          <td>De {{ $value->hora_inicio }} A {{ $value->hora_fin }}</td>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
                  <!-- /.tabs1 -->
                  <!-- .tabs 2 -->
                  <div class="tab-pane" id="biography">
                    <div class="row">
                      <table class="table display ">
                        <thead>
                          <tr>
                            <th>Habitacion</th>
                            <th>Paciente</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Notas</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                  <!-- /.tabs2 -->
                  <!-- .tabs 3 -->
                  <div class="tab-pane" id="update">
                    <table class="table display ">
                      <thead>
                        <tr>
                          <th>Paciente</th>
                          <th>Fecha</th>
                          <th>Hora</th>
                          <th>Consultorio</th>
                          <th>Notas</th>
                        </tr>
                      </thead>
                      <?php foreach($citas as $cita) { ?>
                        <tr>
                          <td>{{ $cita->paciente }}</td>
                          <td>{{ $cita->fecha }}</td>
                          <td>{{ $cita->hora }}</td>
                          <td>{{ $cita->numero }} {{ $cita->consultorio }}</td>
                          <td>{{ $cita->comentarios }}</td>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
                  <!-- /.tabs 3 -->
              </div>
          </div>
      </div>
  </div>
</div>

@endsection
