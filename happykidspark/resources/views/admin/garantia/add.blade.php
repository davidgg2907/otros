@extends('layouts.app')

@section('content')

<section>
  <form class="needs-validation" novalidate action="<?php echo url('/'); ?>/admin/garantia/add" id="formValidation" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">


    <div class="col-sm-12">
      <div class="row">
        @include('admin.garantia.form')
      </div>
    </div>
    

  </div>


  </form>

</section>

@endsection
