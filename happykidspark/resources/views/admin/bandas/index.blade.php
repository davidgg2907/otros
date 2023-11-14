@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/bandas/add') }}" class="btn btn-relief-info ">
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
          <h4 class="card-title">Listado de bandas</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Color</th>
      						<th>Inicia</th>
      						<th>Termina</th>
                  <th>Totales</th>
      						<th>Usadas</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" @if(($value->unidades - $value->usadas) <= 10) class="table-danger" @endif>
                    <td> {{{ $value->color }}} </td>
                    <td> {{{ $value->serie }}}{{{ $value->inicia }}} </td>
                    <td> {{{ $value->serie }}}{{{ $value->termina }}}</td>
                    <td> {{{ $value->unidades }}} </td>
                    <td> {{{ $value->usadas }}} </td>
                    <td class=" text-center">
                      <a href="<?php echo url("/"); ?>/admin/bandas/view/<?php echo $value->id; ?>" title="Ver Asignaciones" data-toggle="tooltip">
                        <i class="fa fa-clock fa-lg text-info m-r-10"></i>
                      </a>
						          <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/bandas/baja/<?php echo $value->id; ?>" data-title="Eliminar bandas" style="border:0px; background:none">
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
