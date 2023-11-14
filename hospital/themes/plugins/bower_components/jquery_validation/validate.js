(function($){
    $('.naturalOnly').on('keypress', function () {
        this.value = this.value.replace(/[^0-9]/g,'');
    });

    $('.numbersOnly').on('keypress', function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    $('.monedaOnly').on('keypress', function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    $('.onlyLetters').on('keypress', function () {//solo  letras
        this.value = this.value.replace(/[^a-zA-Z]/g,'');
    });

    $('.onlyLetters_space').on('keypress', function () {//solo  letras
        this.value = this.value.replace(/[^a-zA-Z ]/g,'');
    });

    $('.onlyLetters_space_dot').on('keypress', function () {//solo  letras
        this.value = this.value.replace(/[^a-zA-Z .]/g,'');
    });

    $('.names').on('keypress', function () {//solo  letras
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚüÜñÑ ]/g,'');
    });

    $('.alphanumeric').on('keypress', function () {//solo numeros letras
        this.value = this.value.replace(/[^a-zA-Z0-9]+$/g,'');
    });

    $('.alphanumeric_chars').on('keypress', function () {//solo numeros letras
        this.value = this.value.replace(/[^a-zA-Z0-9 .-_#]+$/g,'');
    });

    $('.chars').on('keypress', function () {//solo numeros letras
        this.value = this.value.replace(/[^a-zA-Z0-9 ]+$/g,'');
    });

    $('.emailOnly').on('keypress', function () {//solo correo
        $('div.error-keyup-7').remove();
        var inputVal = $(this).val();
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if(!emailReg.test(inputVal)) {
            $(this).after('<div class="alert alert-danger error-keyup-7">Formato invalido de Correo Electronico.</div>');
        }
    });

})(jQuery);


(function(a){
  a.basicModal=function(b){
    defaults={
      title:"",
      message:"Your Message Goes Here!",
      closeButton:true,
      scrollable:false
    };
    var b=a.extend({},defaults,b);
    var c=(b.scrollable===true)?'':"";
    html='<div class="modal fade" id="myModal">';
    html+='<div class="modal-dialog modal-lg">';
    html+='<div class="modal-content">';
    html+='<div class="modal-header">';
    html+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
    if(b.title.length>0){
    html+='<h4 class="modal-title">'+b.title+"</h4>"}
    html+="</div>";
    html+='<div  style="overflow-y:none" class="modal-body">';
    html+=b.message;html+="</div>";
    html+='<div class="modal-footer">';
    if(b.closeButton===true){
    html+='<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>'}
    html+="</div>";html+="</div>";
    html+="</div>";html+="</div>";
    a("body").prepend(html);
    a("#myModal").modal().on("hidden.bs.modal",function(){
      a(this).remove()
    })
  }
})(jQuery);
