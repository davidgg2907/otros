@extends('layouts.app')

@section('content')

<div id="page-wrapper">
  <div class="container-fluid">

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
        <form action="<?php echo url('/'); ?>/admin/configuracion/edit" id="formValidation" method="post" enctype="multipart/form-data">

          <div class="col-sm-12">

            <div class="white-box">

                <div class="pull-right">
                  <button type="submit" class="btn btn-success">
                    <i class="fa fa-check fa-2x"></i><br/>Guardar
                  </button>
                </div>

                <div class="clear"></div>

            </div>

          </div>

          {{ csrf_field() }}

          @include('admin.configuracion.form')

        </form>
    </div>


  </div>
</div>

@endsection
