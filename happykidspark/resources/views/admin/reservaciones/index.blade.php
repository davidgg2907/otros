@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/reservaciones/add') }}" class="btn btn-relief-info ">
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
          <h4 class="card-title">Listado de reservaciones</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table text-left">
              <thead>
                <tr>
                  <th>Registrado Por</th>
						      <th>Cliente</th>
      						<th>Tutor</th>
                  <th>Codigos</th>
      						<th>F. Registro</th>
      						<th>F. Evento</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td> {{{ $value->user->name }}} </td>
                    <td> {{{ $value->cliente->nombre }}} </td>
                    <td> {{{ $value->tutor }}} </td>
                    <td> {{{ $value->cantidad }}} </td>
                    <td> {{{ $value->fecha_registro }}} </td>
                    <td> {{{ $value->fecha_reserva }}} </td>
                    <td class="text-center">
                      <?php if($value->status == 1) { ?>
  					            <a href="<?php echo url("/"); ?>/admin/reservaciones/edit/<?php echo $value->id; ?>" title="Editar Regisros" data-toggle="tooltip">
  					             <i class="fa fa-edit fa-lg text-info m-r-10"></i>
  					            </a>
                      <?php } ?>
                      <a target="_blank" href="<?php echo url("/"); ?>/admin/reservaciones/view/<?php echo $value->id; ?>" title="Imprimir Codigos QR" data-toggle="tooltip">
					             <i class="fa fa-qrcode fa-lg m-r-10"></i>
					            </a>
					            <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/reservaciones/baja/<?php echo $value->id; ?>" data-title="Eliminar reservaciones" style="border:0px; background:none">
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
