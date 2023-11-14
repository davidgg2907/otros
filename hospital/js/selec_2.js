$( document ).ready(function() {
    function formatRepo (repo) {
      if (repo.loading) return repo.text;
       markup = "<option value='" + repo.id + "'>" + repo.text + "</option>";
      return markup;
    }
    function formatRepoSelection (repo) {
      return repo.propietario;
    }
    $(".select_2").select2({
        placeholder: "Ingrese el número de tarjeta o nombre del propietario",
        ajax: {
            url: ruta,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    consulta: $.trim(params.term)
                };
            },
            processResults: function (data) {
                // console.log(data)
                return {
                    results: data
                };
            },
            cache: true
        },
        language: {
            errorLoading: function () {
                return 'La consulta falló';
            },
            inputTooLong: function (args) {
                var remainingChars = args.input.length - args.maximum;

                var message = 'Por favor, elimine ' + remainingChars + ' car';

                if (remainingChars == 1) {
                    message += 'ácter';
                } else {
                    message += 'acteres';
                }

                return message;
            },
            inputTooShort: function (args) {
                var remainingChars = args.minimum - args.input.length;

                var message = 'Por favor, ingrese ' + remainingChars + ' car';

                if (remainingChars == 1) {
                  message += 'ácter';
                } else {
                  message += 'acteres';
                }

                return message;
            },
            loadingMore: function () {
                return 'Cargando más resultados…';
            },
            maximumSelected: function (args) {
                var message = 'Sólo puede seleccionar ' + args.maximum + ' elemento';

                if (args.maximum != 1) {
                  message += 's';
                }

                return message;
            },
            noResults: function () {
                return 'No se encontraron resultados';
            },
            searching: function () {
                return 'Buscando…';
            }
        },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 5,
        maximumInputLength: 18,
        templateResult: formatRepo
    });
});