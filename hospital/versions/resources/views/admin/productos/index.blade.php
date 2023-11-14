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
        <?php if(Auth::user()->permisos->addRecord == 1) { ?>
          <a href="{{ url('/admin/servicios/add') }}" class="btn btn-info ">
            <i class="fa fa-plus fa-2x"></i><br/>Nuevo</a>
        <?php } ?>
      </div>

      <div class="pull-right">
        <a href="{{ url('/admin/servicios/excel?' . $query) }}" class="btn btn-success" title="Exportar a Excel">
          <i class="fa fa-copy fa-2x"></i><br/>E. Excel
        </a>

        <a href="{{ url('/admin/servicios/pdf?' . $query) }}" class="btn btn-danger" title="Exportar a PDF">
          <i class="fa fa-copy fa-2x"></i><br/>E. PDF
        </a>
      </div>

      <div class="clear"></div>

    </div>

  </div>
  <!-- Terminan botones de Accion -->

  <div class="col-sm-12" id="frmListado">
    <form method="get" enctype="multipart/form-data">
      <div class="panel panel-default">
        <div class="panel-heading">
          Filtrar Listado
          <div class="panel-action">
            <a id="itemPanel" href="#" data-perform="panel-collapse"><i class="ti-plus"></i></a>
          </div>
        </div>
        <div class="panel-wrapper collapse">
            <div class="panel-body">
              <div class="row">

                <!-- Nombre Start -->
        				<div class="col-md-12">
        				 <div class="form-group">
        					<label for="nombre" class="control-label"> Descripcion </label>
        						<input type="text" class="form-control" id="nombre" name="nombre"
        						value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
        				 </div>
        				</div>
        				<!-- Nombre End -->

              </div>
            </div>
            <div class="panel-footer">
              <div class="row text-right">
                <button class="btn btn-default waves-effect waves-light" type="submit">
                  <span class="btn-label"><i class="fa fa-search"></i></span>Buscar
                </button>
              </div>
            </div>
        </div>
      </div>
    </form>
  </div>

  <!-- Inicia listado de registros -->
  <div class="col-sm-12" id="frmListado">

    <div class="panel panel-default">
      <div class="panel-heading">Listado de Registros</div>
      <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="table-responsive">

              <table class="table display" id="table-content">
                <thead>
                  <tr>
        						<th>Tipo</th>
                    <th>Descripcion</th>
        						<th>Precio</th>
        						<th>I.V.A.</th>
        						<th>P. Neto</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value ->id; ?>" >
                    <td> {{{ $value->scope == 1 ? "HOSPITALIZACION" : "URGENCIAS" }}} </td>
                    <td> {{{ $value->descripcion }}} </td>
                    <td>$ {{{ number_format($value->precio,2,".",",") }}} </td>
                    <td>$ {{{ number_format($value->valor_iva,2,".",",") }}} </td>
                    <td>$ {{{ number_format($value->precio_neto,2,".",",") }}} </td>
                    <td>
                      <?php if(Auth::user()->permisos->editRecord == 1) { ?>
  						           <a href="<?php echo url("/"); ?>/admin/servicios/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
  						            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
  						           </a>
                       <?php } ?>

                      <?php if(Auth::user()->permisos->deleteRecord == 1) { ?>
  						           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/servicios/baja/<?php echo $value->id; ?>" data-title="Eliminar productos" style="border:0px; background:none">
  						           <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
  						           </button>
                       <?php } ?>
            				</td>
                  </tr>
                <?php }  ?>
                </tbody>
              </table>

            </div>
          </div>
          <div class="panel-footer"> {{ $data->links('vendor.pagination.default') }} </div>
      </div>
    </div>

  </div>
  <!-- Termina listado de registros -->

</div>



@endsection
