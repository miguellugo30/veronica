$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo dids
     */
    $(document).on("click", ".newDid", function(e) {
        e.preventDefault();
        $("#accionActualizar").slideUp();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();
        let id_Empresa = $("#id_empresa").val();

        let url = currentURL + '/did/create/' + id_Empresa;

        $.get(url, function(data, textStatus, jqXHR) {
            $('#formDataEmpresa').html(data);
        });
    });
    /**
     * Evento para guardar el nuevo did
     */
    $(document).on('click', '.saveDid', function(event) {
        event.preventDefault();

        let dataForm = $("#formDataEmpresa").serializeArray();
        let id = $("#id_empresa").val();
        let _token = $("input[name=_token]").val();

        let url = currentURL + '/did';

        $.post(url, {
            dataForm: dataForm,
            _token: _token
        }, function(data, textStatus, xhr) {

            let url = currentURL + "/did/" + id;

            $.get(url, function(data, textStatus, jqXHR) {
                $('#formDataEmpresa').html(data);
                $('#TableCatExts').DataTable({
                    "lengthChange": true
                });
            });

        });
    });

    /**
     * Evento para mostrar el formulario editar distribuidores
     */
    /*$(document).on('dblclick', '#tableDid tbody tr', function(event) {
        event.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/did/" + id + "/edit";
        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

        });
    });
    */
    /**
     * Evento para cancelar la creacion/edicion del distribuidores
     */
    $(document).on("click", ".cancelDid", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para habilitar la edicion de la extension seleccionado
     */
    $(document).on('click', '.editar_did', function(event) {
        let id = $(this).val();
        /**
         * Habilitamos los inputs para editar
         */
        if ($(this).prop('checked')) {
            $(".did_edi_" + id).prop("disabled", false);
        } else {
            $(".did_edi_" + id).prop("disabled", "disabled");
        }
    });
    /**
     * Evento para editar el distribuidores
     */
    $(document).on('click', '.updateDid', function(event) {
        event.preventDefault();
        // Datos obtenidos del formulario
        let dataForm = $("#formDataEmpresa").serializeArray();
        let id = $("#id_empresa").val();
        let _token = $("input[name=_token]").val();
        let _method = 'PUT';

        let url = currentURL + '/did/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                dataForm: dataForm,
                _token: _token,
                _method: _method
            },
            success: function(result) {

                url = currentURL + '/did/' + id;
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        _token: _token
                    },
                    success: function(result) {
                        $('#formDataEmpresa').html(result);
                        $('#TableCatExts').DataTable({
                            "lengthChange": true
                        });
                    }
                });

            }
        });
    });
    /**
     * Evento para eliminar el did
     */
    $(document).on('click', '.deleteDid', function(event) {
        event.preventDefault();

        let id_did = $("#id_did").val();
        let _token = $("input[name=_token]").val();
        let _method = 'DELETE';
        let url = currentURL + '/did/' + id_did;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewIndex #tableDid').DataTable({
                    "lengthChange": true,
                    "order": [
                        [2, "asc"]
                    ]
                });
            }
        });
    });
    /**
     * Evento que obtiene el distribuidor y los canales
     */
    $(document).on('change', '#id_empresa', function(event) {
        let id_empresa = $(this).val();
        let Cat_Distribuidor_id = $("#id_empresa option:selected").data('cat_distribuidor_id');

        let url = currentURL + '/did/' + id_empresa;

        $.get(url, function(data, textStatus, xhr) {
            $(".resultEmpresa").html(data);
            if (Cat_Distribuidor_id == 11) {
                $(".resultEmpresa #gatewayhabilitado").attr('checked', true);
            } else {
                $(".resultEmpresa #gatewaydeshabilitado").attr('checked', true);
            }
        });
    });
});