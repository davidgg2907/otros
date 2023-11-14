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
          <a href="{{ url('/admin/roles/add') }}" class="btn btn-info">
            <i class="fa fa-plus fa-2x"></i><br/>Nuevo
          </a>
        <?php } ?>
      </div>

      <div class="clear"></div>

    </div>

  </div>
  <!-- Terminan botones de Accion -->

  <!-- Aqui Inicia la  busquea -->
  <div class="col-sm-12" style="display:none" id="frmFiltro">

    <form method="GET" action="" class="">

      <div class="panel">
          <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-heading">
              Buscar un Registro
            </div>
            <div class="panel-body">
              <div class="col-md-2">
                <div class="form-group">
                    <label for="participante_id" class="control-label"> Buscar por: </label>
                    <select name="searchBy" class="form-control selectpicker">
                     <option value="roles.id" <?php echo $searchBy=="roles.id"?'selected="selected"':""; ?>>Id</option><option value="roles.name" <?php echo $searchBy=="roles.name"?'selected="selected"':""; ?>>Name</option><option value="roles.description" <?php echo $searchBy=="roles.description"?'selected="selected"':""; ?>>Description</option><option value="roles.created_at" <?php echo $searchBy=="roles.created_at"?'selected="selected"':""; ?>>Created_at</option><option value="roles.updated_at" <?php echo $searchBy=="roles.updated_at"?'selected="selected"':""; ?>>Updated_at</option><option value="roles.status" <?php echo $searchBy=="roles.status"?'selected="selected"':""; ?>>Status</option>
                    </select>
                 </div>
              </div>

              <div class="col-md-8">
                <div class="form-group">
                    <label for="participante_id" class="control-label"> Informacion a Buscar: </label>
                    <input type="text" name="searchValue" id="searchValue" class="form-control" value="<?php echo $searchValue; ?>">
                 </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                    <label for="participante_id" class="control-label"> Resultados por Pagina: </label>
                    <select name="per_page" class="form-control selectpicker" onchange="this.form.submit()">
                      <option value="20" <?php echo $per_page=="25"?'selected="selected"':""; ?>>25 Registros</option>
                      <option value="50" <?php echo $per_page=="50"?'selected="selected"':""; ?>>50 Registros</option>
                      <option value="100" <?php echo $per_page=="100"?'selected="selected"':""; ?>>100 Registros</option>
                    </select>
                 </div>

              </div>
            </div>
            <div class="panel-footer">

              <div class="row">

                <div class="pull-left">
                  <button class="btn btn-primary btn-rounded">
                    <span class="btn-label"><i class="fa fa-search fa-lg"></i></span> Filtrar Listado
                  </button>
                </div>

                <div class="pull-right">
                  <a href="{{ url('/admin/roles') }}" class="btn btn-danger btn-rounded">
                    <span class="btn-label"><i class="fa fa-times fa-lg"></i></span> Cancelar
                  </a>
                </div>


              </div>

            </div>

          </div>
        </div>

    </form>

  </div>
  <!-- Aqui termina la  busquea -->

  <!-- Inicia listado de registros -->
  <div class="col-sm-12" id="frmListado">

    <div class="panel panel-default">
      <div class="panel-heading">Listado de Registros
          <div class="panel-action">
              <div class="dropdown"> <a class="dropdown-toggle" id="examplePanelDropdown" data-toggle="dropdown" href="#" aria-expanded="false" role="button">Opciones <span class="caret"></span></a>
                <ul class="dropdown-menu bullet dropdown-menu-right" aria-labelledby="examplePanelDropdown" role="menu">
                  <li role="presentation"><a href="{{ url('/admin/roles/add') }}" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Nuevo Registro</a></li>
                  <li class="divider" role="presentation"></li>

                  <li role="presentation"><a onclick="$('.buttons-copy').trigger('click');" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Copiar Lista</a></li>
                  <li role="presentation"><a onclick="$('.buttons-print').trigger('click');" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Imprimir Lista</a></li>
                  <li class="divider" role="presentation"></li>

                  <li role="presentation"><a onclick="$('.buttons-excel').trigger('click');" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i> Exportar Excel</a></li>
                  <li role="presentation"><a onclick="$('.buttons-pdf').trigger('click');" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i> Exportar PDF</a></li>
                  <li class="divider" role="presentation"></li>
                </ul>
              </div>
          </div>
      </div>
      <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="table-responsive" id="table-content">

              <table class="table display" >
                <thead>
                  <tr>
                    <?php $sortSym=isset($_GET["order"]) && $_GET["order"]=="asc" ? "up" : "down"; ?>
                    <th>Nombre</th>
                    <th>F. Creacion</th>
                    <th>Ultima Actualizacion</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >

                    <th>
                    {{{ $value->name }}}
                    </th>
                    <th>
                    {{{ $value->created_at }}}
                    </th>

                    <th>
                    {{{ $value->updated_at }}}
                    </th>

                    <th>
                      <?php if(Auth::user()->permisos->editRecord == 1) { ?>
                        <a href="<?php echo url("/"); ?>/admin/roles/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
                         <i class="fa fa-edit fa-lg text-info m-r-10"></i>
                        </a>
                      <?php } ?>

                      <?php if(Auth::user()->permisos->deleteRecord == 1) { ?>
                        <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/roles/baja/<?php echo $value->id; ?>" data-title="Eliminar proyectos" style="border:0px; background:none">
                          <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
                        </button>
                      <?php } ?>
                    </th>
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
