$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo dids
     */
    $(document).on("click", ".nuevoDid", function(e) {
        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/did/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo did
     */
    $(document).on('click', '.saveDid', function(event) {
        event.preventDefault();

        let prefijo = $("#prefijo").val();
        let did = $("#did").val();
        let numero_real = $("#numero_real").val();
        let referencia = $("#referencia").val();
        let gateway = $('input:radio[name=gateway]:checked').val();
        let fakedid = $('input:radio[name=fakedid]:checked').val();
        let Canales_id = $("#Canal_id").val();
        let Empresas_id = $("#id_empresa").val();
        let _token = $("input[name=_token]").val();

        let url = currentURL + '/did';

        $.post(url, {
            prefijo: prefijo,
            dids: did,
            numero_real: numero_real,
            referencia: referencia,
            gateway: gateway,
            fakedid: fakedid,
            Canales_id: Canales_id,
            Empresas_id: Empresas_id,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewCreate').slideUp();
            $('.viewIndex').slideDown();
            $('.viewResult #tableDid').DataTable({
                "lengthChange": true
            });
        });

    });

    /**
     * Evento para mostrar el formulario editar distribuidores
     */
    $(document).on('dblclick', '#tableDid tbody tr', function(event) {
        event.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/did/" + id + "/edit";
        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

        });
    });
    /**
     * Evento para cancelar la creacion/edicion del distribuidores
     */
    $(document).on("click", ".cancelDid", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para editar el distribuidores
     */
    $(document).on('click', '.updateDid', function(event) {
        event.preventDefault();
        // Datos obtenidos del formulario
        let id = $("#id").val();
        let prefijo = $("#prefijo").val();
        let dids = $("#did").val();
        let did = dids.replace("\n", ";");
        let numero_real = $("#numero_real").val();
        let referencia = $("#referencia").val();
        let gateway = $('input:radio[name=gateway]:checked').val();
        let fakedid = $('input:radio[name=fakedid]:checked').val();
        let Canales_id = $("#Canal_id").val();
        let Empresas_id = $("#id_empresa").val();

        let _token = $("input[name=_token]").val();
        let _method = 'PUT';

        let url = currentURL + '/did/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                prefijo: prefijo,
                did: did,
                numero_real: numero_real,
                referencia: referencia,
                gateway: gateway,
                fakedid: fakedid,
                Canales_id: Canales_id,
                Empresas_id: Empresas_id,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex').slideDown();
                $('.viewResult #tableDid').DataTable({
                    "lengthChange": true,
                    "order": [
                        [2, "asc"]
                    ]
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