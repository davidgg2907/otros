@extends('layouts.app')

@section('content')

<section>
  <form class="needs-validation" novalidate action="<?php echo url('/'); ?>/admin/roles/edit" id="formValidation" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="row">

      <div class="col-xl-10 col-md-10 col-12">
        <div class="row">
          @include('admin.roles.form')
          <input type="hidden" class="form-control" name="id" value="{{ $data->id}}" />
        </div>
      </div>

      <div class="col-xl-2 col-md-4 col-12">
        <div class="card">
          <div class="card-body">
            <a href="{{{ $config['cancelar'] }}}" class="btn btn-danger w-100 mb-75 waves-effect"><i class="fa-sharp fa-solid fa-rotate-left"></i></i>Atras</a>
            <button type="reset" class="btn btn-relief-warning w-100 mb-75 waves-effect"><i class="fa-solid fa-eraser"></i> Limpiar </button>
            <button type="submit" class="btn btn-relief-success w-100 mb-75 waves-effect"><i class="fa fa-check fa-lg"></i> Guardar </button>
          </div>
        </div>
      </div>

    </div>
  </form>

</section>

@endsection
