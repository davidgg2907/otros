$( document ).ready(function() {

    $("input[name='tipoVigencia']").click(tipo_vigencia);

    window.onload = comprobar_radio;

    function tipo_vigencia(){
        var opc = $(this).val();
        valida_radio(opc);
    }

    function comprobar_radio(){
        var opc = 0;
        $("input[name='tipoVigencia']").each(function (index) {
           if($(this).is(':checked')){
              opc = $(this).val();
           }
        });
        valida_radio(opc);
    }


    function valida_radio(opc){
        console.log(opc);
        switch( parseInt(opc) ){

            case 1:
            $("input[name='dias']").prop('disabled', false);
            break;
            
            case 2:
            $("input[name='dias']").val("");
            $("input[name='dias']").prop('disabled', true);
            break;

            case 3:
            $("input[name='dias']").val("");
            $("input[name='dias']").prop('disabled', true);
            break;

    	}

    }

});