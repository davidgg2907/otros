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
															   <label for="nombre" class="col-sm-3 control-label"> Nombre </label>
															 </td>
															 <td>
															   {{{ $data->nombre }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="descripcion" class="col-sm-3 control-label"> Descripcion </label>
															 </td>
															 <td>
															   {{{ $data->descripcion }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="caducidad" class="col-sm-3 control-label"> Caducidad </label>
															 </td>
															 <td>
															   {{{ $data->caducidad }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="costo" class="col-sm-3 control-label"> Costo </label>
															 </td>
															 <td>
															   {{{ $data->costo }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="precio" class="col-sm-3 control-label"> Precio </label>
															 </td>
															 <td>
															   {{{ $data->precio }}}
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
