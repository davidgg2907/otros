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
															<tr>
															 <td>
															   <label for="cita_id" class="col-sm-3 control-label"> Cita_id </label>
															 </td>
															 <td>
															   {{{ $data->cita_id }}}
															 </td>
															</tr>

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

											

										    <!-- Doctor_id Start -->
											<tr>
											 <td>
											  <label class="control-label col-md-3"> Doctor_id </label>
											 </td>
											 <td>
										     {{{ $data->nombre }}}
											 </td>
											</tr>
										    <!-- Doctor_id End -->

											

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
															   <label for="signos_id" class="col-sm-3 control-label"> Signos_id </label>
															 </td>
															 <td>
															   {{{ $data->signos_id }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="razon_visita" class="col-sm-3 control-label"> Razon_visita </label>
															 </td>
															 <td>
															   {{{ $data->razon_visita }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="diagnostico" class="col-sm-3 control-label"> Diagnostico </label>
															 </td>
															 <td>
															   {{{ $data->diagnostico }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="recomendaciones" class="col-sm-3 control-label"> Recomendaciones </label>
															 </td>
															 <td>
															   {{{ $data->recomendaciones }}}
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
