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
  <form action="<?php echo url('/'); ?>/admin/==table==/add" id="formValidation" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

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

    <div class="col-md-12">
      <div class="panel panel-info">
        <div class="panel-heading">{{{ $config['titulo'] }}}</div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
          <div class="panel-body">
            {{ csrf_field() }}
              <table class='table table-bordered' style='width:70%;' align='center'>

										    <!-- Paciente_id Start -->
											<tr>
											 <td>
											  <label class="control-label col-md-3"> Paciente_id </label>
											 </td>
											 <td>
										     {{{ $data->nombre }}}
											 </td>
											</tr>
										    <!-- Paciente_id End -->

											

										    <!-- Consultorio_id Start -->
											<tr>
											 <td>
											  <label class="control-label col-md-3"> Consultorio_id </label>
											 </td>
											 <td>
										     {{{ $data->id }}}
											 </td>
											</tr>
										    <!-- Consultorio_id End -->

											

										    <!-- Medico_id Start -->
											<tr>
											 <td>
											  <label class="control-label col-md-3"> Medico_id </label>
											 </td>
											 <td>
										     {{{ $data->nombre }}}
											 </td>
											</tr>
										    <!-- Medico_id End -->

											

										    <!-- Enfermera_id Start -->
											<tr>
											 <td>
											  <label class="control-label col-md-3"> Enfermera_id </label>
											 </td>
											 <td>
										     {{{ $data->nombre }}}
											 </td>
											</tr>
										    <!-- Enfermera_id End -->

											
															<tr>
															 <td>
															   <label for="fecha" class="col-sm-3 control-label"> Fecha </label>
															 </td>
															 <td>
															   {{{ $data->fecha }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="hora" class="col-sm-3 control-label"> Hora </label>
															 </td>
															 <td>
															   {{{ $data->hora }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="comentarios" class="col-sm-3 control-label"> Comentarios </label>
															 </td>
															 <td>
															   {{{ $data->comentarios }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="status" class="col-sm-3 control-label"> Status </label>
															 </td>
															 <td>
															   {{{ $data->status }}}
															 </td>
															</tr></table>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection
