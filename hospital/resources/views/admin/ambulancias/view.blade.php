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
															   <label for="fecha" class="col-sm-3 control-label"> Fecha </label>
															 </td>
															 <td>
															   {{{ $data->fecha }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="servicio" class="col-sm-3 control-label"> Servicio </label>
															 </td>
															 <td>
															   {{{ $data->servicio }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="unidad" class="col-sm-3 control-label"> Unidad </label>
															 </td>
															 <td>
															   {{{ $data->unidad }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="chofer" class="col-sm-3 control-label"> Chofer </label>
															 </td>
															 <td>
															   {{{ $data->chofer }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="enfermera" class="col-sm-3 control-label"> Enfermera </label>
															 </td>
															 <td>
															   {{{ $data->enfermera }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="medico" class="col-sm-3 control-label"> Medico </label>
															 </td>
															 <td>
															   {{{ $data->medico }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="paciente" class="col-sm-3 control-label"> Paciente </label>
															 </td>
															 <td>
															   {{{ $data->paciente }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="acompanante" class="col-sm-3 control-label"> Acompanante </label>
															 </td>
															 <td>
															   {{{ $data->acompanante }}}
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
															   <label for="origen" class="col-sm-3 control-label"> Origen </label>
															 </td>
															 <td>
															   {{{ $data->origen }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="destino" class="col-sm-3 control-label"> Destino </label>
															 </td>
															 <td>
															   {{{ $data->destino }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="comentario" class="col-sm-3 control-label"> Comentario </label>
															 </td>
															 <td>
															   {{{ $data->comentario }}}
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
