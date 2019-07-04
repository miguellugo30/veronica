$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newTroncal", function(e) {

        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/troncales/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveTroncal', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let ip_media = $("#ip_media").val();
        let ip_host = $("#ip_host").val();
        let Cat_Distribuidor_id = $("#distribuidores").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/troncales';

        $.post(url, {
            nombre: nombre,
            ip_media: ip_media,
            ip_host: ip_host,
            Cat_Distribuidor_id: Cat_Distribuidor_id,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewIndex #tableTroncales').DataTable({
                "lengthChange": true
            });
        });
    });
    /**
     * Evento para mostrar el formulario editar modulo
     */
    $(document).on('dblclick', '#tableTroncales tbody tr', function(event) {
        event.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/troncales/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

        });
    });
    /**
     * Evento para cancelar la creacion/edicion del modulo
     */
    $(document).on("click", ".cancelTroncal", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateTrocal', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let ip_media = $("#ip_media").val();
        let ip_host = $("#ip_host").val();
        let Cat_Distribuidor_id = $("#distribuidores").val();
        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/troncales/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                nombre: nombre,
                ip_media: ip_media,
                ip_host : ip_host,
                Cat_Distribuidor_id: Cat_Distribuidor_id,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex #tableTroncales').DataTable({
                    "lengthChange": true
                });
            }
        });
    });
    /**
     * Evento para eliminar el modulo
     */
    $(document).on('click', '.deleteTroncal', function(event) {
        event.preventDefault();

        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let _method = "DELETE";
        let url = currentURL + '/troncales/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex #tableTroncales').DataTable({
                    "lengthChange": true
                });
            }
        });
    });
    /**
     * Evento que autocompleta el valor del input Troncal Sansay
     * en base a lo que se escriba en el input nombre
     */
    $(document).on('keyup', '#nombre', function(event) {
        let nombre_troncal = $(this).val();
        let nombre = nombre_troncal.replace(" ", "_");
        $("#troncal_sansay").val("BUS > " + nombre + " > DID")
    });
});
