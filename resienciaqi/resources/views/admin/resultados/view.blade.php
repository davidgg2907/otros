@extends('layouts.app')

@section('content')

<section class="invoice-preview-wrapper">
    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-12 col-md-12 col-12">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-0">
                    <!-- Header starts -->
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                        <div>                        
                            <p class="card-text"> <strong>Paciente:</strong> {{ $data->paciente->nombre }} </p>
                            <p class="card-text"> <strong>Telefono:</strong> {{ $data->paciente->telefono }} </p>
                            <p class="card-text"> <strong>Celular:</strong> {{ $data->paciente->celular }} </p>
                            <p class="card-text"> <strong>CURP:</strong>  {{ $data->paciente->celular }} </p>
                            <p class="card-text"> <strong>F. Registro:</strong>  {{ $data->fecha }} </p>
                        </div>
                        <div class="mt-md-0 mt-2">                            
                            <div class="invoice-date-wrapper">
                                <p class="invoice-date-title">Delegacion: {{ $data->delegacion->nombre }}</p>
                                <p class="invoice-date">Area:  {{ $data->delegacion->nombre }}</p>
                            </div>
                            <div class="invoice-date-wrapper">
                                <p class="invoice-date-title">Educacion:  {{ \App\admin\Pacientes::EDOCIVIL[$data->paciente->edo_civil_id] }}</p>
                                <p class="invoice-date">Genero:  {{ \App\admin\Pacientes::EDOCIVIL[$data->paciente->genero_id] }}</p>
                                <p class="invoice-date">TIpo de Ctto:  {{ \App\admin\Pacientes::EDOCIVIL[$data->paciente->tipo_ocupacion] }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Header ends -->
                </div>

            </div>
        </div>
        <!-- /Invoice -->

        @if($data->tipo == "general")
            @foreach($data->resultadosGeneral($data->id) as $key => $results)
            <div class="col-xl-12 col-md-12 col-12">
                <div class="card invoice-preview-card">
                    <div class="card-header">
                        <h4 class="card-title">{{ str_replace('_',' ',$key) }}</h4>
                    </div>
                    <div class="card-body invoice-padding pb-0">
                        <div class="row">
                            <?php $i=1; ?>
                            @foreach($results as $rst)    
                            <div class="col-xl-6 col-md-6 col-6">                        
                                <p><b>{{ $i }}: {{ $rst['pregunta'] }}</b></p>
                                <p style="margin-left:20px">R: <i>{{ $rst['respuesta'] }} </i></p>
                                <?php $i++; ?>
                            </div>
                            @endforeach                        
                        </div>                                                                                
                    </div>

                </div>
            </div>        
            @endforeach            
        @else

            @foreach($data->resultadosResilencia($data->id) as $key => $results)
                <div class="col-xl-12 col-md-12 col-12">
                    <div class="card invoice-preview-card">
                        <div class="card-header">
                            <h4 class="card-title">{{ str_replace('_',' ',$key) }}</h4>
                        </div>
                        <div class="card-body invoice-padding pb-0">
                            <div class="row">
                                <?php $i=1; ?>
                                @foreach($results as $rst)    
                                <div class="col-xl-6 col-md-6 col-6">                        
                                    <p><b>{{ $i }}: {{ $rst['pregunta'] }}</b></p>
                                    <p style="margin-left:20px">R: <i>{{ $rst['respuesta'] == "1" ? "SI" : "NO" }} </i></p>
                                    <?php $i++; ?>
                                </div>
                                @endforeach                        
                            </div>                                                                                
                        </div>

                    </div>
                </div>        
                @endforeach
                
        @endif        
        
    </div>
</section>

@endsection
