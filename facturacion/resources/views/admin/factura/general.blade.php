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
                  @if(count($data))
                    <a target="_blank" href="{{ url('admin/factura/rptexcel/?' . $query) }}" class="btn btn-relief-success mb-75 waves-effect">  <i class="fa fa-file-excel fa-lg"></i> Excel</a>
                    <a target="_blank" href="{{ url('admin/factura/rptpdf/?' . $query) }}" class="btn btn-relief-danger mb-75 waves-effect"> <i class="fa fa-file-pdf fa-lg"></i> PDF</a>                                  
                  @endif
                  </div>
                <div class="col-md-6" style="text-align:right">
                  @if(count($data))
                    <a href="{{ url('admin/factura/descargas') }}" class="btn btn-relief-warning mb-75 waves-effect"><i class="fa-solid fa-eraser"></i> Limpiar </a>
                  @endif    
                    <button type="submit" class="btn btn-relief-primary mb-75 waves-effect"><i class="fa fa-line-chart fa-lg"></i> Generar </button>
                </div>
            
            </div>
            </div>
      		</div>
      </div>

      <div class="col-sm-12">
        @if(count($data))
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Resultados</h4>
              </div>
              <div class="card-body">
                <div class="row table-responsive"> 
                    <table class="table" id="example">
                      <thead>
                          <tr>
                          <th>Fecha Factura</th>
                          <th>Factura</th>    
                          <th>Proveedor</th>
                          <th>Concepto</th>
                          <th> Subtotal </th>
                          <th>Descuento</th>
                          <th>ISH u otros impuestos locales </th>
                          <th>IVA </th>
                          <th>Total </th> 
                          </tr>
                      </thead>
                      <tbody>                                              
                          @foreach($data as $value)
                          <tr>
                            <td>{{ $value->fechaTimbrado }}</td>
                            <td>{{ substr($value->UUID,strlen($value->UUID) - 5, strlen($value->UUID)) }}</td>
                            <td>{{ $value->emisor }} </td>
                            <td>{{ $value->Descripcion }} </td>
                            <td>{{ number_format($value->ValorUnitario,2,".",",") }}</td>
                            <td>{{ number_format($value->Descuento,2,".",",") }}</td>
                            <td>{{ number_format($value->iva,2,".",",") }}</td>
                            <td>{{ number_format($value->ieps,2,".",",") }}</td>
                            <td>{{ number_format($value->Importe,2,".",",") }}</td> 
                          </tr>
                          @endforeach                      
                      </tbody>
                    </table>
                </div>
              </div>            
            </div>
          </div>
        @endif
      </div>

    </div>
  </form>

</section>

@endsection
