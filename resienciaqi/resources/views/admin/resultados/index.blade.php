@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/resultados/add') }}" class="btn btn-relief-info ">
                <i class="fa fa-plus fa-lg"></i> Crear Nuevo</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<section id="extended">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Listado de resultados</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <?php $sortSym=isset($_GET["order"]) && $_GET["order"]=="asc" ? "up" : "down"; ?><th>Tipo</th>
                  <th>Paciente</th>
                  <th>Delegacion</th>
                  <th>Area</th>
                  <th class="table-center">Fecha</th>						
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                  <td> {{{ $value->tipo }}} </td>
                  <td class="text-left"> {{{ $value->paciente->nombre != "" ? $value->paciente->nombre : "NO ESPECIFICADO" }}} </td>
                  <td class="text-left"> {{{ $value->delegacion->nombre }}} </td>
                  <td class="text-left"> {{{ $value->area->nombre }}} </td>
                  <td class="table-center"> {{{ $value->fecha }}} </td>
                  <td class="table-center">
                    <a href="<?php echo url("/"); ?>/admin/resultados/view/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
                    <i class="fa fa-chart-line fa-lg text-info m-r-10"></i>
                    </a>
                    <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/resultados/baja/<?php echo $value->id; ?>" data-title="Eliminar resultados" style="border:0px; background:none">
                    <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
                    </button>
            			</td>
                  </tr>
                <?php }  ?>
              </tbody>

            </table>
          </div>
        </div>
        <div class="card-footer">
          {{ $data->links('vendor.pagination.default') }}
        </div>
      </div>
    </div>
  </div>
</section>




@endsection
