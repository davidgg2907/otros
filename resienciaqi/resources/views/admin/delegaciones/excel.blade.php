<table style="width:100%">
  <tr>
    <td colspan="2">SINDROME DE QUEMARSE EN EL TRABAJO <hr/> </td>
  </tr> 
  @foreach($resultados['quemarse'] as $keys => $rst)
    <tr>
      <td colspan="2"> {{ $keys }}  <hr/> </td>
    </tr>

    <tr>
      <td colspan="2"> 

      <table style="width:100%">
      <thead>
        <tr>
            <td>Participante</td>
            <td>Resultado</td>
          </tr> 
        </thead>  
      <tbody>
        @foreach($rst['detalle'] as $values)
          <tr>
            <td>{{ $values['participante'] }}</td>
            <td>{{ round($values['promedio'],2) }}</td>
          </tr>
        @endforeach
      </tbody>

        </table>

      </td>
    </tr>

    <tr>
      <td> ALTO: {{ $rst['alto'] }} </td>
      <td> BAJO:  {{ $rst['bajo'] }} </td>  
    </tr>
    
    <tr>
      <td colspan="2"><br/> <hr/> </td>
    </tr>

  @endforeach

</table>


<table style="width:100%">
  <tr>
    <td colspan="3">RIESGOS PSICOSOCIALES <hr/> </td>
  </tr> 
  @foreach($resultados['riesgos'] as $keys => $rst)
    <tr>
      <td colspan="3"> {{ $keys }}  <hr/> </td>
    </tr>

    <tr>
      <td colspan="3"> 
        <table style="width:100%">
          <thead>
            <tr>
                <td>Participante</td>
                <td>Resultado</td>
              </tr> 
            </thead>  
          <tbody>
            @foreach($rst['detalle'] as $values)
              <tr>
                <td>{{ $values['participante'] }}</td>
                <td>{{ round($values['promedio'],2) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </td>
    </tr>

    <tr>
      <td> ALTO: {{ $rst['alto'] }} </td>
      <td> MEDIO: {{ $rst['medio'] }} </td>
      <td> BAJO:  {{ $rst['bajo'] }} </td>  
    </tr>
    
    <tr>
      <td colspan="2"><br/> <hr/> </td>
    </tr>

  @endforeach

</table>


<table style="width:100%">
  <tr>
    <td colspan="3">CONSECUENCIAS PSICOSOCIALES <hr/> </td>
  </tr> 
  @foreach($resultados['riesgos'] as $keys => $rst)
    <tr>
      <td colspan="3"> {{ $keys }}  <hr/> </td>
    </tr>

    <tr>
      <td colspan="3"> 
        <table style="width:100%">
          <thead>
            <tr>
                <td>Participante</td>
                <td>Resultado</td>
              </tr> 
            </thead>  
          <tbody>
            @foreach($rst['consecuencias'] as $values)
              <tr>
                <td>{{ $values['participante'] }}</td>
                <td>{{ round($values['promedio'],2) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </td>
    </tr>

    <tr>
      <td> ALTO: {{ $rst['alto'] }} </td>
      <td> MEDIO: {{ $rst['medio'] }} </td>
      <td> BAJO:  {{ $rst['bajo'] }} </td>  
    </tr>
    
    <tr>
      <td colspan="2"><br/> <hr/> </td>
    </tr>

  @endforeach

</table>