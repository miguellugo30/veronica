$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newExtension", function(e) {

        e.preventDefault();
        $(".updateEmpresa").slideUp();
        $(".updateExtension").slideUp();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();
        let id_Empresa = $("#id_empresa").val();

        let url = currentURL + '/extensiones/create/' + id_Empresa;

        $.get(url, function(data, textStatus, jqXHR) {
            $("#formDataEmpresa").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveExtension', function(event) {
        event.preventDefault();

        let dataForm = $("#formDataEmpresa").serializeArray();
        let id = $("#id_empresa").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/extensiones';

        $.post(url, {
            dataForm: dataForm,
            _token: _token
        }, function(data, textStatus, xhr) {

            let url = currentURL + "/extensiones/" + id;

            $.get(url, function(data, textStatus, jqXHR) {
                $('#formDataEmpresa').html(data);
                $('#TableCatExts').DataTable({
                    "lengthChange": true
                });
            });
        });
    });
    /**
     * Evento para habilitar la edicion de la extension seleccionado
     */
    $(document).on('click', '.editar_extension', function(event) {
        let id = $(this).val();
        /**
         * Habilitamos los inputs para editar
         */
        if ($(this).prop('checked')) {
            $("#canal_extension_" + id).prop("disabled", false);
            $("#licencia_extension_" + id).prop("disabled", false);
            $("#extension_" + id).prop("disabled", false);
            $("#delete_" + id).slideDown();
        } else {
            $("#canal_extension_" + id).prop("disabled", "disabled");
            $("#licencia_extension_" + id).prop("disabled", "disabled");
            $("#extension_" + id).prop("disabled", "disabled");
            $("#delete_" + id).slideUp();
        }
    });
    /**
     * Evento para eliminar el modulo
     */
    $(document).on('click', '.deleteExtension', function(event) {
        event.preventDefault();
        let id = $(this).attr('id').replace('delete_', '');
        let idEmpresa = $("#id_empresa").val();
        let _token = $("input[name=_token]").val();
        let _method = "DELETE";
        let url = currentURL + '/extensiones/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: _token,
                _method: _method
            },
            success: function(result) {
                let url = currentURL + "/extensiones/" + idEmpresa;

                $.get(url, function(data, textStatus, jqXHR) {
                    $('#formDataEmpresa').html(data);
                    $('#TableCatExts').DataTable({
                        "lengthChange": true
                    });
                });
            }
        });
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateExtension', function(event) {
        event.preventDefault();

        let dataForm = $("#formDataEmpresa").serializeArray();
        let _token = $("input[name=_token]").val();
        let id = $("#id_empresa").val();
        let _method = "PUT";
        let url = currentURL + '/extensiones/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                dataForm: dataForm,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                //$('#formDataEmpresa').html(result);
                let url = currentURL + "/extensiones/" + id;

                $.get(url, function(data, textStatus, jqXHR) {
                    $('#formDataEmpresa').html(data);
                    $('#TableCatExts').DataTable({
                        "lengthChange": true
                    });
                });
            }
        });
    });
});