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
        $('#modal').modal('hide');

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
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )
            }
        });
        /*
        $.post(url, {
            licencia: licencia,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewIndex #licencias_bria').DataTable({
                "lengthChange": true
            });
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        });
        */
    });
});