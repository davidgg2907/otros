
  function buscaPaciente() {

    $('#modalPaciente').modal({

      backdrop: 'static',

      keyboard: true,

      focus: true

    });

  }

  function btnTraePacientes() {

    var url = "{{ url('admin/pacientes/search') }}/";

    url += "?nombre=" + $('#txtPacNombre').val();

    url += "&celular=" + $('#txtPacCelular').val();

    url += "&telefono=" + $('#txtPacTelefono').val();

    url += "&tsangre=";


    $.ajax({
      url: url,
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
      success: function(json) {

        if(json['error'] == 0) {

          $('#itemsPacientes').html(json['html']);

        } else {

          swal({ title: "ERROR!!", text: json['msg'], type: "error"});

        }

      }

    });

  }


  function seleccionaPaciente(id,label) {

    $('#paciente_nombre').val(label);
    $('#paciente_id').val(id);

      $('#modalPaciente').modal('toggle');
  }
