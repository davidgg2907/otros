$( document ).ready(function() {

    $(".tipo_usuario input[name='tipo_usuario']").click(tipo_usuario);

    window.onload = comprobar_radio;
    
    function tipo_usuario(){
        var opc = $(this).val();
        valida_radio(opc);
    }

    function comprobar_radio(){
        var opc = 0;
        $(".tipo_usuario input[name='tipo_usuario']").each(function (index) {
           if($(this).is(':checked')){
              opc = $(this).val();
           }
        });
        valida_radio(opc);
    }

    function valida_radio(opc){
        switch( parseInt(opc) ){
            case 1:
                requiredOp.opTarjeta        = false,
                requiredOp.opComercio       = true,
                requiredOp.opCaja           = true;
                $("#tarjetaIdOpc").hide();
                $("#comercioIdOpc").show();
                $("#cajaIdOpc").show();
                break;
            case 2:
                requiredOp.opTarjeta        = false,
                requiredOp.opComercio       = true,
                requiredOp.opCaja           = false;
                $("#tarjetaIdOpc").hide();
                $("#comercioIdOpc").show();
                $("#cajaIdOpc").hide();
                break;
            case 3:
                requiredOp.opTarjeta        = true,
                requiredOp.opComercio       = false,
                requiredOp.opCaja           = false;
                $("#tarjetaIdOpc").show();
                $("#comercioIdOpc").hide();
                $("#cajaIdOpc").hide();
                break;
            case 4:
                requiredOp.opTarjeta        = false,
                requiredOp.opComercio       = false,
                requiredOp.opCaja           = false;
                $("#tarjetaIdOpc").hide();
                $("#comercioIdOpc").hide();
                $("#cajaIdOpc").hide();
                break;
            case 5:
                requiredOp.opTarjeta        = false,
                requiredOp.opComercio       = false,
                requiredOp.opCaja           = false;
                $("#tarjetaIdOpc").hide();
                $("#comercioIdOpc").hide();
                $("#cajaIdOpc").hide();
                break;
        }
    }
});