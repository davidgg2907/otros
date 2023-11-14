@extends('layouts.app')

@section('content')

<!-- User Card & Plan Starts -->
<div class="row">
  <!-- User Card starts-->
  <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card user-card">
          <div class="card-body">
              <div class="row">

                <div class="col-xl-12 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                    <div class="user-avatar-section">
                        <div class="d-flex justify-content-start">
                            <div class="d-flex flex-column ml-1">
                              <div class="user-info mb-1" style="margin-left:20px;">
                                <h4 class="mb-0">Informacion de las bandas</h4>
                              </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                </div>

                  <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                      <div class="user-avatar-section">
                          <div class="d-flex justify-content-start">
                              <div class="d-flex flex-column ml-1">
                                <div class="user-info mb-1" style="margin-left:20px;">
                                  <span class="card-text">F. Registro: &nbsp;&nbsp; {{ $data->fecha_inicio }}</span><br/>
                                  <span class="card-text">F. Termino: &nbsp;&nbsp; {{ $data->fecha_termino }}</span><br/>
                                  <span class="card-text">Usadas: &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; {{ $data->usadas }}  <i class="fa fa-ring fa-lg" style="color: {{ $data->rgb }}"></i></span><br/>
                                  <span class="card-text">En Stock: &nbsp;&nbsp;&nbsp;&nbsp; {{ $data->unidades - $data->usadas }} <i class="fa fa-ring fa-lg" style="color: {{ $data->rgb }}"></i> </span><br/>
                                </div>
                              </div>
                          </div>
                      </div>

                  </div>
                  <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                      <div class="user-info-wrapper">

                        <div class="d-flex flex-wrap">
                          <div class="col-md-6">
                            <div class="user-info-title">
                                <span class="card-text user-info-title font-weight-bold mb-0">&nbsp; </span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <p class="card-text mb-0"> &nbsp;&nbsp; </p>
                          </div>
                        </div>

                        <div class="d-flex flex-wrap">
                          <div class="col-md-6">
                            <div class="user-info-title">
                                <span class="card-text user-info-title font-weight-bold mb-0">Color: </span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <p class="card-text mb-0"> <i class="fa fa-ring fa-lg" style="color: {{ $data->rgb }}"></i> &nbsp;&nbsp; {{ $data->color }} </p>
                          </div>
                        </div>
                        <div class="d-flex flex-wrap my-50">
                          <div class="col-md-6">
                            <div class="user-info-title">
                                <span class="card-text user-info-title font-weight-bold mb-0">Serie Inicial: </span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <p class="card-text mb-0"> &nbsp;&nbsp; {{ $data->inicia }} </p>
                          </div>
                        </div>

                        <div class="d-flex flex-wrap my-50">
                          <div class="col-md-6">
                            <div class="user-info-title">
                                <span class="card-text user-info-title font-weight-bold mb-0">Serie Final: </span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <p class="card-text mb-0"> &nbsp;&nbsp; {{ $data->termina }} </p>
                          </div>
                        </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- /User Card Ends-->

  <div class="col-xl-12 col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Asignacion de Bandas</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="row table-responsive">
            <table class="table text-left">
              <thead>
                <tr>
                  <th>No Serie</th>
                  <th>Fecha</th>
                  <th>Juego</th>
                  <th>Nombre</th>
                </tr>
              </thead>
              @foreach(\App\admin\Temporizador::where('banda_id',$data->id)->get() as $tempos)
                <tr>
                  <td>
                     {{ $tempos->banda->serie }}{{ $tempos->barras }}
                  </td>
                  <td>{{ date('d/m/Y',strtotime($tempos->inicia)) }}</td>
                  <td>{{ $tempos->producto->nombre }}, {{ $tempos->tiempo->minutos }} Minutos</td>
                  <td>{{ $tempos->nombre }}</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
    </div>
</div>
<!-- User Card & Plan Ends -->

@endsection
