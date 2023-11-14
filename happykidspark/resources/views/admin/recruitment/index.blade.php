@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/recruitment/add') }}" class="btn btn-relief-info ">
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
          <h4 class="card-title">Listado de recruitment</h4>
        </div>
        <div class="card-content">
          <div class="card-body table-responsive">
            <table class="table text-center">
              <thead>
                <tr>
                  <?php $sortSym=isset($_GET["order"]) && $_GET["order"]=="asc" ? "up" : "down"; ?><th>Nombre</th>
						<th>Edad</th>
						<th>Edo_civil</th>
						<th>Escolaridad</th>
						<th>Experiencia</th>
						<th>Habilidades</th>
						<th>Fortalezas</th>
						<th>Debilidades</th>
						<th>Telefono</th>
						<th>Correo</th>
						<th>Cv</th>
						
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value) { ?>
                  <tr id="hide<?php $value->id; ?>" >
                    
																            <td>
																            {{{ $value->nombre }}}
																            </td>
                
																            <td>
																            {{{ $value->edad }}}
																            </td>
                
																            <td>
																            {{{ $value->edo_civil }}}
																            </td>
                
																            <td>
																            {{{ $value->escolaridad }}}
																            </td>
                
																            <td>
																            {{{ $value->experiencia }}}
																            </td>
                
																            <td>
																            {{{ $value->habilidades }}}
																            </td>
                
																            <td>
																            {{{ $value->fortalezas }}}
																            </td>
                
																            <td>
																            {{{ $value->debilidades }}}
																            </td>
                
																            <td>
																            {{{ $value->telefono }}}
																            </td>
                
																            <td>
																            {{{ $value->correo }}}
																            </td>
                
																            <td>
																            	<?php if(!empty($value->cv)){ echo '<img src="'.$value->cv.'" style="width:50px;">'; }?>
																            </td>
                         <td>
												           <a href="<?php echo url("/"); ?>/admin/recruitment/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
												            <i class="fa fa-edit fa-lg text-info m-r-10"></i>
												           </a>
												           <button type="button" data-toggle="tooltip" class="delete" data-url="<?php echo url("/"); ?>/admin/recruitment/baja/<?php echo $value->id; ?>" data-title="Eliminar recruitment" style="border:0px; background:none">
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
