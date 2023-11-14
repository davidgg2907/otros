@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/traspasos/add') }}" class="btn btn-relief-info ">
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
          <h4 class="card-title">Listado de traspasos</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table text-center">
              <thead>
                <tr>
      						<th>Envia</th>
      						<th>Autoriza</th>
      						<th>Origen</th>
      						<th>Destino</th>
                  <th>Productos</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td> {{{ $value->envia->name }}} </td>
										<td> {{{ $value->autoriza->name }}} </td>
                    <td> {{{ $value->origen->nombre }}} </td>
                    <td> {{{ $value->destino->nombre }}} </td>
                    <td> {{{ $value->productos }}} </td>
                    <td>
						           <a href="<?php echo url("/"); ?>/admin/traspasos/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
						            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
						           </a>
						           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/traspasos/baja/<?php echo $value->id; ?>" data-title="Eliminar traspasos" style="border:0px; background:none">
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
