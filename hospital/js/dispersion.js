$( document ).ready(function() {


    $('#nuevomovimiento').click(nuevomovimiento);
    $('#cancelarnuevomovimiento').click(cancelarnuevomovimiento);

    function nuevomovimiento(){$("#shownuevomovimiento").show();}
    function cancelarnuevomovimiento(){$("#shownuevomovimiento").hide();}


});