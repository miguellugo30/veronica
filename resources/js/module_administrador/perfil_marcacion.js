$(function() {

    var currentURL = window.location.href;

    /**
     * Evento para mostrar el formulario de crear una nueva plantilla
     */
    $(document).on("click", ".newPerfilMarcacion", function(e) {
        e.preventDefault();
        $("#accionActualizar").slideUp();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();
        let id_empresa = $("#id_empresa").val();
        let url = currentURL + '/perfil_marcacion/create/' + id_empresa;

        $.get(url, function(data, textStatus, jqXHR) {
            $('#formDataEmpresa').html(data);
        });
    });

    /**
     * Evento para guardar el nuevo Prefijo de Marcacion
     */
    $(document).on('click', '.savePerfilMarcacion', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let id = $("#id_empresa").val();
        let prefijo = $("#prefijo").val();
        let canal = $("#canal").val();
        let did = $("#did").val();
        let _token = $("input[name=_token]").val();

        let url = currentURL + '/perfil_marcacion';

        $.post(url, {
            id: id,
            nombre: nombre,
            descripcion: descripcion,
            prefijo: prefijo,
            canal: canal,
            did: did,
            _token: _token
        }, function(data, textStatus, xhr) {

            let url = currentURL + "/perfil_marcacion/" + id;

            $.get(url, function(data, textStatus, jqXHR) {
                $('#formDataEmpresa').html(data);
                $('#tablePerfilMarcacion').DataTable({
                    "lengthChange": true
                });
            });
        });
    });

    /**
     * Evento para habilitar la edicion del prefijo seleccionado
     */
    $(document).on('click', '.editar_perfil', function(event) {

        let id = $(this).val();
        /**
         * Habilitamos los inputs para editar
         */
        if ($(this).prop('checked')) {

            $("#nombre_" + id).prop("disabled", false);
            $("#descripcion_" + id).prop("disabled", false);
            $("#prefijo_" + id).prop("disabled", false);
            $("#canal_" + id).prop("disabled", false);
            $("#did_" + id).prop("disabled", false);
            $("#delete_" + id).slideDown();
            $("#accionActualizar").slideDown();
        } else {
            $("#nombre_" + id).prop("disabled", true);
            $("#descripcion_" + id).prop("disabled", true);
            $("#prefijo_" + id).prop("disabled", true);
            $("#canal_" + id).prop("disabled", true);
            $("#did_" + id).prop("disabled", true);
            $("#delete_" + id).slideUp();
            $("#accionActualizar").slideUp();
        }
    });

    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updatePerfil', function(event) {

        event.preventDefault();
        let dataForm = $("#formDataEmpresa").serializeArray();
        let _token = $("input[name=_token]").val();
        let id = $("#id_empresa").val();
        let _method = "PUT";
        let url = currentURL + '/perfil_marcacion/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                dataForm: dataForm,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                let url = currentURL + "/perfil_marcacion/" + id;

                $.get(url, function(data, textStatus, jqXHR) {
                    $('#formDataEmpresa').html(data);
                    $('#tablePerfilMarcacion').DataTable({
                        "lengthChange": true
                    });
                });
            }
        });
    });
    /**
     * Evento para eliminar el prefijo
     */
    $(document).on('click', '.deletePerfil', function(event) {
        event.preventDefault();
        let id = $(this).attr('id').replace('delete_', '');
        let _token = $("input[name=_token]").val();
        let _method = "DELETE";
        let url = currentURL + '/perfil_marcacion/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: _token,
                _method: _method
            },
            success: function(result) {
                let id = $("#id_empresa").val();
                let url = currentURL + "/perfil_marcacion/" + id;

                $.get(url, function(data, textStatus, jqXHR) {
                    $('#formDataEmpresa').html(data);
                    $('#tablePerfilMarcacion').DataTable({
                        "lengthChange": true
                    });
                });
            }
        });
    });
});