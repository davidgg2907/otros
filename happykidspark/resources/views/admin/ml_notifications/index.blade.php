@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/ml_notifications/add') }}" class="btn btn-relief-info ">
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
          <h4 class="card-title">Listado de ml_notifications</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table text-center">
              <thead>
                <tr>
                  <?php $sortSym=isset($_GET["order"]) && $_GET["order"]=="asc" ? "up" : "down"; ?><th>Ml_id</th>
						<th>Resource</th>
						<th>User_id</th>
						<th>Application_id</th>
						<th>Attempts</th>
						<th>Sent</th>
						<th>Received</th>
						<th>Status</th>
						
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    
																            <td>
																            {{{ $value->ml_id }}}
																            </td>
                
																            <td>
																            {{{ $value->resource }}}
																            </td>
                
																            <td>
																            {{{ $value->user_id }}}
																            </td>
                
																            <td>
																            {{{ $value->application_id }}}
																            </td>
                
																            <td>
																            {{{ $value->attempts }}}
																            </td>
                
																            <td>
																            {{{ $value->sent }}}
																            </td>
                
																            <td>
																            {{{ $value->received }}}
																            </td>
                
																            <td>
																            {{{ $value->status }}}
																            </td>
                 <td>
												           <a href="<?php echo url("/"); ?>/admin/ml_notifications/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
												            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
												           </a>
												           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/ml_notifications/baja/<?php echo $value->id; ?>" data-title="Eliminar ml_notifications" style="border:0px; background:none">
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
