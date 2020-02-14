$(function() {

    var currentURL = window.location.href;

    /**
     * Evento para mostrar el formulario de crear una nueva plantilla
     */
    $(document).on("click", ".newPrefijoMarcacion", function(e) {
        event.preventDefault();
        $('#tituloModal').html('Alta de Prefijo Marcacion');
        $('#action').removeClass('deletePrefijoMarcacion');
        $('#action').addClass('savePrefijoMarcacion');

        let url = currentURL + "/PrefijosMarcacion/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });

    /**
     * Evento para guardar el nuevo Prefijo de Marcacion
     */
    $(document).on('click', '.savePrefijoMarcacion', function(event) {
        event.preventDefault();

        //let dataForm = $("#altaprefijo").serializeArray();
        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let prefijo = $("#prefijo").val();
        let prefijoNuevo = $("#prefijoNuevo").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/PrefijosMarcacion';

        $.post(url, {
            nombre: nombre,
            descripcion: descripcion,
            prefijo: prefijo,
            prefijoNuevo: prefijoNuevo,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.modal-backdrop ').css('display', 'none');
            $('#modal').modal('hide');
            $('.viewResult').html(data);

            $('.viewResult #tablePrefijosMarcacion').DataTable({
                "lengthChange": true,
                "order": [
                    [3, "asc"]
                ]
            });
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
     * Evento para seleccionar un Prefijo
     */
    $(document).on('click', '#tablePrefijosMarcacion tbody tr', function(event) {

        event.preventDefault();
        let id = $(this).data("id");
        $(".editPrefijoMarcacion").slideDown();
        $(".deletePrefijoMarcacion").slideDown();

        $("#idSeleccionado").val(id);

        $("#tablePrefijosMarcacion tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para visualizar la configuración del Agente
     */
    $(document).on('click', '.editPrefijoMarcacion', function(event) {

        event.preventDefault();
        var id = $("#idSeleccionado").val();
        var url = currentURL + '/PrefijosMarcacion/' + id + '/edit';

        $('#tituloModal').html('Editar Prefijos');
        $('#action').addClass('updatePrefijoMarcacion');
        $('#action').removeClass('savePrefijoMarcacion');

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
     * Evento para guardar los cambios del Agente
     */
    $(document).on('click', '.updatePrefijoMarcacion', function(event) {
        event.preventDefault();

        var id = $("#idSeleccionado").val();
        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let prefijo = $("#prefijo").val();
        let prefijoNuevo = $("#prefijoNuevo").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/PrefijosMarcacion/' + id;

        $.post(url, {
                id: id,
                nombre: nombre,
                descripcion: descripcion,
                prefijo: prefijo,
                prefijoNuevo: prefijoNuevo,
                _method: _method,
                _token: _token
            }, function(data, textStatus, xhr) {
                $('.viewResult').html(data);
                $('.viewResult #tablePrefijosMarcacion').DataTable({
                    "lengthChange": true,
                    "order": [
                        [2, "asc"]
                    ]
                });
            }).done(function() {
                $('.modal-backdrop ').css('display', 'none');
                $('#modal').modal('hide');
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )
            })
            .fail(function(data) {
                printErrorMsg(data.responseJSON.errors);
            });

    });
    /**
     * Evento para eliminar un Prefijo
     *
     */
    $(document).on('click', '.deletePrefijoMarcacion', function(event) {
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
                let url = currentURL + '/PrefijosMarcacion/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tablePrefijosMarcacion').DataTable({
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
