@extends('layouts.app')

@section('content')

<section id="basic-tabs-components">
  
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body table-responsive">
            <div class="row">

              <div class="col-md-12" style="text-align:right">
                <a href="{{{ $config['cancelar'] }}}" class="btn btn-danger mb-75 waves-effect"><i class="fa-sharp fa-solid fa-rotate-left"></i></i>Atras</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>

@endsection

@section('scripts')

<!-- morris CSS -->
<link href="{{ asset('generator/plugins/bower_components/morrisjs/morris.css') }} " rel="stylesheet">
<!--Morris JavaScript -->
<script src="{{ asset('generator/plugins/bower_components/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('generator/plugins/bower_components/morrisjs/morris.js') }}"></script>



@endsection
