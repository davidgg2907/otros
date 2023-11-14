@extends('layouts.app')

@section('content')

<section>
  <form class="needs-validation" novalidate action="" id="formValidation" method="get" enctype="multipart/form-data">
    <div class="row">

      <div class="col-sm-12">
    		<div class="card">
            <div class="card-header">
                <h4 class="card-title">Agregar factura</h4>
            </div>
            <div class="card-body">
              <div class="row"> 

                <div class="col-md-6">
                  <div class="mb-1">
                    <div class="form-group">
                    <label for="id" class="control-label"> Proveedor/Emisor </label>
                    <select class="form-control" name="emisor" id="emisor">
                      <option value="">[ SELECCIONE ] </option>
                      @foreach(\App\admin\Factura::select('emisor')->groupBy('emisor')->get() as $value)
                        <option value="{{ $value->emisor }}"> {{ $value->emisor }} </option>
                      @endforeach
                    </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-1">
                    <div class="form-group">
                    <label for="id" class="control-label"> Receptor </label>
                    <select class="form-control" name="receptor" id="receptor">
                      <option value="">[ SELECCIONE ] </option>
                      @foreach(\App\admin\Factura::select('receptor')->groupBy('receptor')->get() as $value)
                        <option value="{{ $value->receptor }}"> {{ $value->receptor }} </option>
                      @endforeach
                    </select>
                    <div class="label label-danger">{{ $errors->first("id") }}</div>
                    </div>
                  </div>
                </div>


                <div class="col-md-4">
                  <div class="mb-1">
                    <div class="form-group">
                    <label for="id" class="control-label"> Uso de CFDI </label>
                    <select class="form-control" name="usoCFDI" id="usoCFDI">
                      <option value="">[ SELECCIONE ] </option>
                      @foreach(\App\admin\Factura::select('usoCFDI')->groupBy('usoCFDI')->get() as $value)
                        <option value="{{ $value->usoCFDI }}"> {{ $value->usoCFDI }} </option>
                      @endforeach
                    </select>
                    <div class="label label-danger">{{ $errors->first("id") }}</div>
                    </div>
                  </div>
                </div>
              
                <div class="col-md-4">
                  <div class="mb-1">
                    <div class="form-group">
                    <label for="id" class="control-label"> Fecha Emision </label>
                    <input type="text" class="form-control datetime" name="fecha" id="fecha" />
                    <div class="label label-danger">{{ $errors->first("id") }}</div>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="mb-1">
                    <div class="form-group">
                    <label for="id" class="control-label"> UUID </label>
                    <input type="text" class="form-control" name="uuid" id="uuid" />
                    <div class="label label-danger">{{ $errors->first("id") }}</div>
                    </div>
                  </div>
                </div>

                <input type="hidden" class="form-control" name="sending" id="sending" value="1" />
              
              </div>
    				</div>
            <div class="card-footer">
              <div class="row">
                
                <div class="col-md-6" style="text-align:left">
                  <a href="{{ url('admin/factura/descargas') }}" class="btn btn-relief-warning mb-75 waves-effect"><i class="fa-solid fa-eraser"></i> Limpiar </a>                
                </div>
                <div class="col-md-6" style="text-align:right">
                <button type="submit" class="btn btn-relief-primary mb-75 waves-effect"><i class="fa fa-line-chart fa-lg"></i> Generar </button>
                </div>
            
            </div>
            </div>
      		</div>
      </div>

      <div class="col-sm-12">
    		<div class="card">
            <div class="card-header">
                <h4 class="card-title">Resultados</h4>
            </div>
            <div class="card-body">
              <div class="row"> 
                  <table class="table">
                    <thead>
                        <tr>
                            <th class="py-1">Folio</th>
                            <th class="py-1">ClaveProdServ</th>
                            <th class="py-1">NoIdentificacion</th>
                            <th class="py-1">ClaveUnidad</th>
                            <th class="py-1">Unidad </th>
                            <th class="py-1">Descripcion </th>
                            <th class="py-1">ValorUnitario </th>
                            <th class="py-1">Importe </th>
                            <th class="py-1">Descuento </th> 
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach($data as $value) { ?>
                        <tr>
                            <td class="py-1">{{{ substr($value->UUID,strlen($value->UUID) - 5, strlen($value->UUID)) }}} </td>
                            <td class="py-1">{{ $value->ClaveProdServ }}</td>
                            <td class="py-1">{{ $value->NoIdentificacion }}</thtd>
                            <td class="py-1">{{ $value->ClaveUnidad }}</td>
                            <td class="py-1">{{ $value->Unidad }}</td>
                            <td class="py-1">{{ $value->Descripcion }}</td>
                            <td class="py-1">{{ $value->ValorUnitario }}</td>
                            <td class="py-1">$ {{ number_format($value->Importe,2,".",",") }}</td>
                            <td class="py-1">$ {{ number_format($value->Descuento,2,".",",") }}</td> 
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
              </div>
    				</div>            
            </div>
      		</div>
      </div>

      <div class="col-sm-12">
    		<div class="card">
            <div class="card-header">
                <h4 class="card-title">Impuestos</h4>
            </div>
            <div class="card-body">
              <div class="row"> 
              <table class="table">
                      <thead>
                          <tr>
                              <th class="py-1">Folio</th>
                              <th class="py-1">Tipo</th>
                              <th class="py-1">Base</th>
                              <th class="py-1">Impuesto </th>
                              <th class="py-1">Tasa Cuota </th>
                              <th class="py-1">Importe </th> 
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach($impuestos as $value) { ?>
                          <tr>
                              <td class="py-1">{{{ substr($value->UUID,strlen($value->UUID) - 5, strlen($value->UUID)) }}} </td>
                              <td class="py-1">{{ $value->tipo }}</td>
                              <td class="py-1">{{ $value->base }}</thtd>
                              <td class="py-1">{{ $value->impuesto }}</td>
                              <td class="py-1">$ {{ number_format($value->tasacuota,2,".",",") }}</td>
                              <td class="py-1">$ {{ number_format($value->importe,2,".",",") }}</td>                               
                          </tr>
                        <?php } ?>
                      </tbody>
                  </table>
              </div>
    				</div>            
            </div>
      		</div>
      </div>

    </div>
  </form>

</section>

@endsection
