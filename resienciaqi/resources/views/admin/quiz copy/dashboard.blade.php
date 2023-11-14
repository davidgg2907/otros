@extends('layouts.quiz')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body table-responsive">
          <div class="row">

            <div class="col-md-12" style="text-align:right">
              <a href="{{ url('/admin/users/add') }}" class="btn btn-relief-info ">
                <i class="fa fa-plus fa-lg"></i> Nuevo Usuarios</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<section id="extended">
  <div class="row">
    <form action="<?php echo url('/'); ?>/admin/pacientes/quiz" id="formQuiz" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="text" name="paciente_id" class="form-control" value="{{ $paciente->id }}" />
      <input type="text" name="delegacion_id" class="form-control" value="{{ $paciente->delegacion_id }}" />
      <input type="text" name="area_id" class="form-control" value="{{ $paciente->area_id }}" />
      <input type="text" name="tipo" id="tipo_quiz" class="form-control" value="{{ $quiz->id }}" />

    </form>

  </div>
</section>




@endsection
