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
        <form action="<?php echo url('/'); ?>/admin/users/perfil" id="formValidation" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}

          <div class="col-sm-12">

            <div class="white-box">

                <div class="pull-left">
                  <a href="{{{ $config['cancelar'] }}}" class="btn btn-danger">
                    <i class="fa fa-times fa-2x"></i><br/>Cancelar
                  </a>
                </div>
                <div class="pull-right">
                  <button type="submit" class="btn btn-success">
                    <i class="fa fa-save fa-2x"></i><br/>Guardar
                  </button>
                </div>

                <div class="clear"></div>

            </div>

          </div>

          <div class="col-md-4 col-xs-12">
            <div class="white-box">
              <div class="user-btm-box">

                <hr>
                <!-- .row -->
                <div class="row text-center m-t-10">
                  <div class="col-md-6"><strong>Nombre Actual</strong>
                      <p>{{{ $data->name }}} </p>
                  </div>
                    <div class="col-md-6"><strong>Correo</strong>
                        <p>{{{ $data->email }}}</p>
                    </div>
                </div>
                <!-- /.row -->
                <hr>

                <!-- .row -->
                <div class="row text-center m-t-12">
                  <div class="col-md-12"><strong>Rol Asignado</strong>
                      <p>{{{ $data->rol }}}</p>
                  </div>
                </div>
                <!-- /.row -->
                <hr>

              </div>
            </div>
          </div>

          <div class="col-md-8">
          	<div class="panel panel-default">
          		<div class="panel-heading">Actualizacion de Datos </div>
          		<div class="panel-wrapper collapse in" aria-expanded="true">
          			<div class="panel-body">

          				<!-- Name Start -->
          				<div class="col-md-12">
          				 <div class="form-group">
          					<label for="name" class="control-label"> Nombre de Usuario </label>
          						<input type="text" class="form-control" id="name" name="name"
          						value="{{{ isset($data->name ) ? $data->name  : old('name') }}}">
          						<div class="label label-danger">{{ $errors->first("name") }}</div>
          				 </div>
          				</div>
          				<!-- Name End -->

          				<!-- Password Start -->
          				<div class="col-md-6">
          				 <div class="form-group">
          					<label for="password" class="control-label"> Password </label>
          						<input type="text" class="form-control" id="password" name="password">
          						<div class="label label-danger">{{ $errors->first("password") }}</div>
          				 </div>
          				</div>
          				<!-- Password End -->

          				<!-- Password Start -->
          				<div class="col-md-6">
          				 <div class="form-group">
          					<label for="password" class="control-label"> Confirmar Pago </label>
          						<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repita contraseña">
          				 </div>
          				</div>
          				<!-- Password End -->

          			</div>

          		</div>
          	</div>
          </div>

          <input type="hidden" class="form-control" id="status" name="status" value="1">

        </form>
    </div>
@endsection
