@extends('layouts.app')

@section('content')

<section class="app-user-view">
    <!-- User Card & Plan Starts -->
    <div class="row">
        <!-- User Card starts-->
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card user-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                            <div class="user-avatar-section">
                                <div class="d-flex justify-content-start">
                                  <?php if($producto->imagen) { ?>
                                    <img class="img-fluid rounded" src="{{ asset('uploads/usuarios/' . $producto->imagen) }}" height="104" width="104" alt="User avatar" />
                                  <?php } else { ?>
                                    <img class="img-fluid rounded" src="{{ asset('/') }}/images/avatars/7.png" height="104" width="104" alt="User avatar" />
                                  <?php } ?>

                                    <div class="d-flex flex-column ml-1">
                                        <div class="user-info mb-1" style="margin-left:20px;">
                                            <h4 class="mb-0">{{ $producto->nombre }}</h4>
                                            <span class="card-text">{{ $producto->categoria->nombre }}</span><br/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                          <div class="user-info-wrapper">
                            <div class="d-flex flex-wrap">
                              <div class="col-md-8" style="text-align:right">
                                <div class="user-info-title">
                                    <span class="card-text user-info-title font-weight-bold mb-0">Precio: </span>
                                </div>
                              </div>
                              <div class="col-md-4" style="text-align:right">
                                <p class="card-text mb-0"> &nbsp;&nbsp; $ {{ number_format($producto->precio,2,".",",") }} </p>
                              </div>
                            </div>
                            <div class="d-flex flex-wrap">
                              <div class="col-md-8" style="text-align:right">
                                <div class="user-info-title">
                                    <span class="card-text user-info-title font-weight-bold mb-0">Tipo: </span>
                                </div>
                              </div>
                              <div class="col-md-4" style="text-align:right">
                                <p class="card-text mb-0"> &nbsp;&nbsp; {{ \App\admin\Productos::TIPOS[$producto->tipo] }} </p>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /User Card Ends-->
    </div>
    <!-- User Card & Plan Ends -->

    <!-- User Timeline & Permissions Starts -->
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Movimientos del Producto</h4>
          </div>
          <div class="card-content">
            <div class="card-body">
              <div class="row table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Tipo</th>
                      <th>Inv. Inicial</th>
                      <th>Cant.</th>
                      <th>Inv. Final</th>
                      <th>Log</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $value) { ?>
                      <tr @if($value->status == 0) class="text-danger" @endif >
                        <td> {{{ $value->fecha }}} </td>
                        <td> {{{ $value->movimiento }}} </td>
                        <td> {{{ (int)$value->anterior }}} </td>
                        <td> {{{ (int)$value->cantidad }}} </td>
                        <td> {{{ (int)$value->posterior }}} </td>
                        <td> {!! $value->descripcion !!} </td>
                      </tr>
                    <?php }  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</section>

@endsection
