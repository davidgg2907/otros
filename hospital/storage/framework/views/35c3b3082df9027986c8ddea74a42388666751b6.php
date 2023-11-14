function buscarMedicos() {

  $('#modalMedico').modal({

    backdrop: 'static',

    keyboard: true,

    focus: true

  });

}

function btnTraeMedicos() {

  var url = "<?php echo e(url('admin/medicos/search')); ?>/";

  url += "?nombre=" + $('#txtMedNombre').val();

  url += "&especialidad=" + $('#txtMedEspecialidad').val();

  url += "&cedula=" + $('#txtMedCedula').val();

  url += "&celular=" + $('#txtMedTelefono').val();


  $.ajax({
    url: url,
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function(json) {

      if(json['error'] == 0) {

        $('#itemsMedicos').html(json['html']);

      } else {

        swal({ title: "ERROR!!", text: json['msg'], type: "error"});

      }

    }

  });

}

function seleccionaMedico(id,label) {

  $('#medico_nombre').val(label);
  $('#medico_id').val(id);

  $('#medico_id').trigger('change');
  $('#doctor_id').trigger('change');

  $('#modalMedico').modal('toggle');

}

$('#txtMedNombre').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);

    if(keycode == '13'){
      btnTraeMedicos();
      return false;
    }

});


$('#txtMedEspecialidad').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);

    if(keycode == '13'){
      btnTraeMedicos();
      return false;
    }

});


$('#txtMedCedula').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);

    if(keycode == '13'){
      btnTraeMedicos();
      return false;
    }

});

$('#txtMedTelefono').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);

    if(keycode == '13'){
      btnTraeMedicos();
      return false;
    }

});
