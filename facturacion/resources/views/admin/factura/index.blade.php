@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/factura/add') }}" class="btn btn-relief-info ">
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
          <h4 class="card-title">Listado de factura</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table text-left">
              <thead>
                <tr>
				  <th>Cargo</th>
				  <th>Emisor</th>
				  <th>Receptor</th>
				  <th>Folio</th>
          <th>SubTotal</th>
				  <th>Impuestos</th>
				  <th>Total</th>						
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    <td> {{{ $value->user->name }}} </td>
                    <td> {{{ $value->emisor }}} </td>
                    <td> {{{ $value->receptor }}} </td>
                    <td> {{{ substr($value->UUID,strlen($value->UUID) - 5, strlen($value->UUID)) }}} </td>
                    <td> $ {{{ number_format($value->subTotal,2,".",",") }}} </td>
                    <td> $ {{{ number_format($value->totalImpuestos(),2,".",",") }}} </td>          
                    <td> $ {{{ number_format($value->total,2,".",",") }}} </td>
                    <td style="width:10%"> 
                      <a href="<?php echo url("/"); ?>/admin/factura/view	/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
                        <i class="fa fa-file-pdf fa-lg text-info m-r-10"></i>
                      </a>
                      <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/factura/baja/<?php echo $value->id; ?>" data-title="Eliminar factura" style="border:0px; background:none">
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
