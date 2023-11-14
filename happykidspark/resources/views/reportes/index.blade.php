@extends('layouts.app')

@section('content')



<section id="extended">

  <div class="row">

    <div class="col-md-6">
      <a href="{{ url('admin/reportes/movimientos') }}">
        <div class="card">
          <div class="card-content">
            <div class="card-body table-responsive">
              <div class="row text-center">
                <i class="fa fa-exchange  fa-5x"></i>
                <h3>Entradas / Salidas</h3>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

  <?php if(Auth::user()->perfil == 0) { ?>

    <div class="col-md-6">
      <a href="{{ url('admin/reportes/rendimiento') }}">
        <div class="card">
          <div class="card-content">
            <div class="card-body table-responsive">
              <div class="row text-center">
                <i class="fa fa-chart-line  fa-5x"></i>
                <h3>Utilidad</h3>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

  <?php } ?>

  <div class="col-md-6">
    <a href="{{ url('admin/reportes/ventas') }}">
      <div class="card">
        <div class="card-content">
          <div class="card-body table-responsive">
            <div class="row text-center">
              <i class="fa fa-chart-line  fa-5x"></i>
              <h3>Ventas</h3>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <?php if(Auth::user()->perfil == 0) { ?>

    <div class="col-md-6">
      <a href="{{ url('admin/reportes/operaciones') }}">
        <div class="card">
          <div class="card-content">
            <div class="card-body table-responsive">
              <div class="row text-center">
                <i class="fa fa-chart-line  fa-5x"></i>
                <h3>Operaciones</h3>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

  <?php } ?>


  <!--<div class="col-md-4">
    <a href="{{ url('admin/reportes/inversion') }}">
      <div class="card">
        <div class="card-content">
          <div class="card-body table-responsive">
            <div class="row text-center">
              <i class="fa fa-chart-line  fa-5x"></i>
              <h3>Inversion</h3>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>


  <div class="col-md-4">
    <a href="{{ url('admin/reportes/mercadolibre') }}">
      <div class="card">
        <div class="card-content">
          <div class="card-body table-responsive">
            <div class="row text-center">
              <i class="fa fa-chart-line  fa-5x"></i>
              <h3>Mercado Libre</h3>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>-->



</section>




@endsection
