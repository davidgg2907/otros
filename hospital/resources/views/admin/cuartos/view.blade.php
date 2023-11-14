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
															   <label for="numero" class="col-sm-3 control-label"> Numero </label>
															 </td>
															 <td>
															   {{{ $data->numero }}}
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
															   <label for="amenidades" class="col-sm-3 control-label"> Amenidades </label>
															 </td>
															 <td>
															   {{{ $data->amenidades }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="equipo" class="col-sm-3 control-label"> Equipo </label>
															 </td>
															 <td>
															   {{{ $data->equipo }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="costo_dia" class="col-sm-3 control-label"> Costo_dia </label>
															 </td>
															 <td>
															   {{{ $data->costo_dia }}}
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
