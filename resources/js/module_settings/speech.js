$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para seleccionar Speech
     */
    $(document).on('click', '#tableSpeech tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".deleteSpeech").slideDown();
        $(".editSpeech").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableSpeech tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });;
    /**
     * Evento para eliminar el Agente
     *
     */
    $(document).on('click', '.deleteSpeech', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Estas seguro?',
            text: "Deseas eliminar el registro seleccionado!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                let id = $("#idSeleccionado").val();
                let _method = "DELETE";
                let _token = $("input[name=_token]").val();
                let url = currentURL + '/speech/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableSpeech').DataTable({
                            "lengthChange": false
                        });
                        Swal.fire(
                            'Eliminado!',
                            'El registro ha sido eliminado.',
                            'success'
                        )
                    }
                });
            }
        });
    });
    /**
     * Evento para mostrar el formulario de crear un nuevo Agente
     */
    $(document).on("click", ".newSpeech", function(e) {
        event.preventDefault();
        $('#tituloModal').html('Alta de Speech');
        $('#action').removeClass('deleteSpeech');
        $('#action').addClass('saveSpeech');

        let url = currentURL + "/speech/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para visualizar la configuración del Speech
     */
    $(document).on('click', '.editSpeech', function(event) {

        event.preventDefault();
        var id = $("#idSeleccionado").val();
        var url = currentURL + '/speech/' + id + '/edit';

        $('#tituloModal').html('Editar Speech');
        $('#action').addClass('updateSpeech');
        $('#action').removeClass('saveSpeech');

        $.ajax({
            url: url,
            type: 'GET',
            success: function success(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);
            }
        });
    });
    /**
     * Evento para guardar los cambios del Speech
     */
    $(document).on('click', '.updateSpeech', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');
        let id = $("#id").val();

        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let tipo = $("#tipo").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/speech/' + id;

        $.post(url, {
            nombre: nombre,
            descripcion: descripcion,
            tipo: tipo,
            _method: _method,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);

            $('.viewResult #tableSpeech').DataTable({
                "lengthChange": true,
                "order": [
                    [2, "asc"]
                ]
            });
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        });

    });
    /**
     * Evento para guardar el nuevo agente
     */
    $(document).on('click', '.saveSpeech', function(event) {
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let tipo = $("#tipo").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/speech';

        $.post(url, {
            nombre: nombre,
            descripcion: descripcion,
            tipo: tipo,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);

            $('.viewResult #tableSpeech').DataTable({
                "lengthChange": true,
                "order": [
                    [2, "asc"]
                ]
            });
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        });
    });

});
