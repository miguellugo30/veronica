$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo distribuidores
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

        let Empresas_id = $("#id_empresa").val();
        let tipo = $("#tipo").val();
        let prefijo = $("#prefijo").val();
        let did = $("#did").val();
        let descripcion = $("#descripcion").val();
        let Troncales_id = $("#Troncales_id").val();
        let gateway = $('input:radio[name=gateway]:checked').val();
        let fakedid = $('input:radio[name=fakedid]:checked').val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/did';

        $.post(url, {
            Empresas_id: Empresas_id,
            tipo: tipo,
            prefijo: prefijo,
            did: did,
            descripcion: descripcion,
            Troncales_id: Troncales_id,
            gateway: gateway,
            fakedid: fakedid,
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
        // formdata es para down de IL
        let Empresas_id = $("#id_empresa").val();
        let id_did = $("#id_did").val();
        let tipo = $("#tipo").val();
        let prefijo = $("#prefijo").val();
        let did = $("#did").val();
        let descripcion = $("#descripcion").val();
        let Troncales_id = $("#Troncales_id").val();
        let gateway = $('input:radio[name=gateway]:checked').val();
        let fakedid = $('input:radio[name=fakedid]:checked').val();
        let _token = $("input[name=_token]").val();
        let _method = 'PUT';
        let url = currentURL + '/did/' + id_did;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                Empresas_id: Empresas_id,
                id_did: id_did,
                tipo: tipo,
                prefijo: prefijo,
                did: did,
                descripcion: descripcion,
                Troncales_id: Troncales_id,
                gateway: gateway,
                fakedid: fakedid,
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
     * Evento para mostrar las troncales en base a la empresa seleccionada
     */
    $(document).on('change', '#id_empresa', function(event) {
        event.preventDefault();
        let id_empresa = $(this).val();
        let url = currentURL + '/troncales/' + id_empresa;

        $.get(url, function(data, textStatus, xhr) {
            $(".showTroncales").html(data);
        });
    });
});