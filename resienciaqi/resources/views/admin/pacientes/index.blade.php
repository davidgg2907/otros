@extends('layouts.app')

@section('content')

<section id="extended">

  <div class="row">
    <form if="frmFilter" method="GET" action="">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Filtrar Resultados</h4>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li>
                        <a data-action="collapse" class="">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                            <polyline points="6 9 12 15 18 9"></polyline>
                          </svg>
                        </a>
                    </li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body table-responsive">
                <div class="row">

                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-12" style="text-align:right">
                    <a href="{{ url('/admin/compras') }}" class="btn btn-warning ">
                      <i class="fa fa-eraser fa-lg"></i> Limpiar</a>
                    <button type="submit" class="btn btn-success"> <i class="fa fa-search fa-lg"></i> Filtrar  </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-content table-responsive">
          <table class="table text-center">
            <thead>
              <tr>
                <th>Empresa</th>
    						<th>Area</th>
    						<th>Nombre</th>
    						<th>Curp</th>
    						<th>Telefono</th>
    						<th>Celular</th>
    						<th>Sexo</th>
    						<th>Edad</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data as $value) { ?>
                <tr id="hide<?php $value->id; ?>" >
                  <td> {{{ $value->delegacion->nombre }}} </td>
                  <td> {{{ $value->area->nombre }}} </td>
                  <td> {{{ $value->nombre }}} </td>
                  <td> {{{ $value->curp }}} </td>
                  <td> {{{ $value->telefono }}} </td>
                  <td> {{{ $value->celular }}} </td>
                  <td> {{{ $value->sexo }}} </td>
                  <td> {{{ $value->edad }}} </td>
                  <td>
				           <a href="<?php echo url("/"); ?>/admin/pacientes/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
				            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
				           </a>
				           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/pacientes/baja/<?php echo $value->id; ?>" data-title="Eliminar pacientes" style="border:0px; background:none">
				           <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
				           </button>
          				</td>
                </tr>
              <?php }  ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          {{ $data->links('vendor.pagination.default') }}
        </div>
      </div>
    </div>
  </div>
</section>




@endsection
