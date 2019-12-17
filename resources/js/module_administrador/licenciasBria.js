$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newLicencia", function(e) {
        e.preventDefault();

        $('#tituloModal').html('Nueva Licencia');
        let url = currentURL + '/licencias_bria/create';

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $('#modal').modal('show');
                $("#modal-body").html(result);
            }
        });
        /*
        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
        */
    });
    /**
     * Evento para cancelar la creacion/edicion de una licencia
     */
    $(document).on("click", ".cancelLicencia", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveLicencia', function(event) {
        event.preventDefault();

        let licencia = $("#licencia").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/licencias_bria';

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                licencia: licencia,
                _token: _token
            },
            beforeSend: function() {
                // Handle the beforeSend event
                $("#cargando").fadeIn();
            },
            complete: function(result) {
                $("#cargando").fadeOut();
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewIndex #licencias_bria').DataTable({
                    "lengthChange": true
                });
            }
        }).done(function(data) {
            $('.modal-backdrop ').css('display', 'none');
            $('#modal').modal('hide');
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });
    });
    /**
     * Funcion para mostrar los errores de los formularios
     */
    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $(".form-control").removeClass('is-invalid');
        for (var clave in msg) {
            $("#" + clave).addClass('is-invalid');
            if (msg.hasOwnProperty(clave)) {
                $(".print-error-msg").find("ul").append('<li>' + msg[clave][0] + '</li>');
            }
        }
    }
});