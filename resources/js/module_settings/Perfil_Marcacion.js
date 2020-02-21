$(function() {

    var currentURL = window.location.href;

    /**
     * Evento para mostrar el formulario de crear una nueva plantilla
     */
    $(document).on("click", ".newPerfilMarcacion", function(e) {
        e.preventDefault();
        $('#tituloModal').html('Alta de Perfil Marcacion');
        $('#action').removeClass('deletePerfilMarcacion');
        $('#action').addClass('savePerfilMarcacion');

        let url = currentURL + "/Perfil_Marcacion/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });

    /**
     * Evento para guardar el nuevo Prefijo de Marcacion
     */
    $(document).on('click', '.savePerfilMarcacion', function(event) {
        event.preventDefault();

        //let dataForm = $("#altaprefijo").serializeArray();
        let prefijo = $("#prefijo").val();
        let perfil = $("#perfil").val();
        let canal = $("#canal").val();
        let did = $("#did").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/Perfil_Marcacion';

        $.post(url, {
            prefijo: prefijo,
            perfil: perfil,
            canal: canal,
            did: did,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.modal-backdrop ').css('display', 'none');
            $('#modal').modal('hide');
            $('.viewResult').html(data);

            $('.viewResult #tablePerfilMarcacion').DataTable({
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
    $(document).on('click', '#tablePerfilMarcacion tbody tr', function(event) {

        event.preventDefault();
        let prefijo = $(this).data("prefijo");
        let perfil = $(this).data("perfil");
        let canal = $(this).data("canal");
        let did = $(this).data("did");
        $(".editPerfilMarcacion").slideDown();
        $(".deletePerfilMarcacion").slideDown();

        $("#idSeleccionado").val(prefijo);
        $("#idSeleccionado2").val(perfil);
        $("#idSeleccionado3").val(canal);
        $("#idSeleccionado4").val(did);

        $("#tablePerfilMarcacion tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para visualizar la configuración del Agente
     */
    $(document).on('click', '.editPerfilMarcacion', function(event) {

        event.preventDefault();
        var id = $("#idSeleccionado4").val();
        var prefijo = $("#idSeleccionado").val();
        var perfil = $("#idSeleccionado2").val();
        var canal = $("#idSeleccionado3").val();
        var did = $("#idSeleccionado4").val();
        var url = currentURL + '/Perfil_Marcacion/' + id + '/edit';

        $('#tituloModal').html('Editar Perfil');
        $('#action').addClass('updatePerfilMarcacion');
        $('#action').removeClass('savePerfilMarcacion');

        $.ajax({
            url: url,
            data: {
                prefijo: prefijo,
                perfil: perfil,
                canal: canal,
                did: did
            },
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
    $(document).on('click', '.updatePerfilMarcacion', function(event) {
        event.preventDefault();

        var id = $("#idSeleccionado4").val();
        let prefijo = $("#idSeleccionado").val();
        let perfil = $("#idSeleccionado2").val();
        let canal = $("#idSeleccionado3").val();
        let did = $("#idSeleccionado4").val();
        let prefijo2 = $("#prefijo").val();
        let perfil2 = $("#perfil").val();
        let canal2 = $("#canal").val();
        let did2 = $("#did").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/Perfil_Marcacion/' + id;

        $.post(url, {
                id: id,
                prefijo: prefijo,
                perfil: perfil,
                canal: canal,
                did: did,
                prefijo2: prefijo2,
                perfil2: perfil2,
                canal2: canal2,
                did2: did2,
                _method: _method,
                _token: _token
            }, function(data, textStatus, xhr) {
                $('.viewResult').html(data);
                $('.viewResult #tablePerfilMarcacion').DataTable({
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
    $(document).on('click', '.deletePerfilMarcacion', function(event) {
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
                let id = $("#idSeleccionado4").val();
                let prefijo = $("#idSeleccionado").val();
                let perfil = $("#idSeleccionado2").val();
                let canal = $("#idSeleccionado3").val();
                let did = $("#idSeleccionado4").val();
                let _method = "DELETE";
                let _token = $("input[name=_token]").val();
                let url = currentURL + '/Perfil_Marcacion/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        id: id,
                        prefijo: prefijo,
                        perfil: perfil,
                        canal: canal,
                        did: did,
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tablePerfilMarcacion').DataTable({
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