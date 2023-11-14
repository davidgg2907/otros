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
															   <label for="id" class="col-sm-3 control-label"> Id </label>
															 </td>
															 <td>
															   {{{ $data->id }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="rol_id" class="col-sm-3 control-label"> Rol_id </label>
															 </td>
															 <td>
															   {{{ $data->rol_id }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="perfil" class="col-sm-3 control-label"> Perfil </label>
															 </td>
															 <td>
															   {{{ $data->perfil }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="visual" class="col-sm-3 control-label"> Visual </label>
															 </td>
															 <td>
															   {{{ $data->visual }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="ruleta" class="col-sm-3 control-label"> Ruleta </label>
															 </td>
															 <td>
															   {{{ $data->ruleta }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="photo" class="col-sm-3 control-label"> Photo </label>
															 </td>
															 <td>
															   {{{ $data->photo }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="name" class="col-sm-3 control-label"> Name </label>
															 </td>
															 <td>
															   {{{ $data->name }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="email" class="col-sm-3 control-label"> Email </label>
															 </td>
															 <td>
															   {{{ $data->email }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="password" class="col-sm-3 control-label"> Password </label>
															 </td>
															 <td>
															   {{{ $data->password }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="remember_token" class="col-sm-3 control-label"> Remember_token </label>
															 </td>
															 <td>
															   {{{ $data->remember_token }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="api_token" class="col-sm-3 control-label"> Api_token </label>
															 </td>
															 <td>
															   {{{ $data->api_token }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="created_at" class="col-sm-3 control-label"> Created_at </label>
															 </td>
															 <td>
															   {{{ $data->created_at }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="updated_at" class="col-sm-3 control-label"> Updated_at </label>
															 </td>
															 <td>
															   {{{ $data->updated_at }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="time_login" class="col-sm-3 control-label"> Time_login </label>
															 </td>
															 <td>
															   {{{ $data->time_login }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="time_logout" class="col-sm-3 control-label"> Time_logout </label>
															 </td>
															 <td>
															   {{{ $data->time_logout }}}
															 </td>
															</tr>
															<tr>
															 <td>
															   <label for="online" class="col-sm-3 control-label"> Online </label>
															 </td>
															 <td>
															   {{{ $data->online }}}
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
