@extends('layouts.app')

@section('content')

<?php
$searchValue = isset($_GET['searchValue'])?$_GET['searchValue']:'';
$searchBy = isset($_GET['searchBy'])?$_GET['searchBy']:'';
$order_by = isset($_GET['order_by'])?$_GET['order_by']:'';
$order = isset($_GET['order'])?$_GET['order']:'';
$redirect = url('/').'/admin/documentos?'.urlencode($_SERVER["QUERY_STRING"]);
?>


<!-- Page Content -->

<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">{{{ $config['titulo'] }}}</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    @include('layouts.breadcrumbs',[ 'breadcrumbs' => $config['breadcrumbs'] ])
  </div>
</div>


<div class="row">

  <!-- Inicia botones de Accion -->
  <div class="col-sm-12">

    <div class="white-box">

      <div class="pull-left">
        <a href="{{ url('/admin/pacientes/add') }}" class="btn btn-info ">
          <i class="fa fa-plus fa-2x"></i><br/>Nuevo</a>

          <button class="btn btn-default" data-toggle="modal" title="Imprimir Listado" data-target="#modalSearch">
            <i class="fa fa-search fa-2x"></i><br/>Buscar
          </button>
      </div>

      <div class="pull-right">
        <a href="{{ url('/admin/pacientes/excel' . $query) }}" class="btn btn-success" title="Exportar a Excel">
          <i class="fa fa-copy fa-2x"></i><br/>E. Excel
        </a>

        <a href="{{ url('/admin/pacientes/pdf' . $query) }}" class="btn btn-danger" title="Exportar a PDF">
          <i class="fa fa-copy fa-2x"></i><br/>E. PDF
        </a>
      </div>

      <div class="clear"></div>

    </div>

  </div>
  <!-- Terminan botones de Accion -->

  <!-- Inicia listado de registros -->
  <div class="col-sm-12" id="frmListado">

    <div class="panel panel-default">
      <div class="panel-heading">
        Filtrar Listado
        <div class="panel-action">
          <a id="itemPanel" href="#" data-perform="panel-collapse"><i class="ti-plus"></i></a>
        </div>
      </div>
      <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="table-responsive">
              <div class="row">

              </div>
            </div>
          </div>
          <div class="panel-footer"> {{ $data->links('vendor.pagination.default') }} </div>
      </div>
    </div>

  </div>
  <!-- Termina listado de registros -->


  <!-- Inicia listado de registros -->
  <div class="col-sm-12" id="frmListado">

    <div class="row el-element-overlay">
      <?php foreach($data as $value) { ?>
        <!-- .usercard -->
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="white-box">
                <div class="el-card-item">
                    <div class="el-card-avatar el-overlay-1">
                      <?php if($value->fotografia) { ?>
                        <img src="{{{ asset('uploads/pacientes/' . $value->fotografia) }}}">
                      <?php } else { ?>
                        <img src="{{{ asset('uploads/paciente.jpeg') }}}" alt="user">
                      <?php } ?>
                        <div class="el-overlay">
                            <ul class="el-info">
                                <li>
                                  <a class="btn default btn-outline image-popup-vertical-fit" href="{{ url('admin/pacientes/view/' . $value->id) }}">
                                    <i class="icon-magnifier"></i>
                                  </a>
                                </li>
                                <li>
                                  <a class="btn default btn-outline" href="{{ url('admin/pacientes/edit/' . $value->id) }}">
                                    <i class="icon-pencil"></i>
                                  </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="el-card-content">
                        <h3 class="box-title">{{{ $value->nombre }}}</h3> <small>Cel: {{ $value->celular}}</small>
                        <br> <small>Edad: N Años</small> </div>
                </div>
            </div>
        </div>
        <!-- /.usercard-->
      <?php }  ?>
    </div>


  </div>
  <!-- Termina listado de registros -->

</div>



@endsection
