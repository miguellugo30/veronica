$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo canal
     */
    $(document).on("click", ".newTipoCanal", function(e) {

        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/cat_tipo_canales/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveTipoCanales', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let prefijo = $("#prefijo").val();
        let distribuidor = $("#distribuidor").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/cat_tipo_canales';

        $.post(url, {
            nombre: nombre,
            prefijo: prefijo,
            Cat_Distribuidor_id: distribuidor,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewIndex #tableTiposCanal').DataTable({
                "lengthChange": true
            });
        });
    });
    /**
     * Evento para mostrar el formulario editar modulo
     */
    $(document).on('dblclick', '#tableTiposCanal tbody tr', function(event) {
        event.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/cat_tipo_canales/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

        });
    });
    /**
     * Evento para cancelar la creacion/edicion del modulo
     */
    $(document).on("click", ".cancelTipoCanal", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateTipoCanal', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let prefijo = $("#prefijo").val();
        let distribuidor = $("#distribuidor").val();
        let id = $("#id").val();

        let _token = $("input[name=_token]").val();
        let _method = 'PUT';
        let url = currentURL + '/cat_tipo_canales/'+ id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                nombre: nombre,
                prefijo: prefijo,
                Cat_Distribuidor_id: distribuidor,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex #tableTiposCanal').DataTable({
                    "lengthChange": true
                });
            }
        });
    });
    /**
     * Evento para eliminar el modulo
     */
    $(document).on('click', '.deleteTipoCanal', function(event) {
        event.preventDefault();

        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let _method = "DELETE";
        let url = currentURL + '/cat_tipo_canales/' + id;

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
                $('.viewIndex #tableTiposCanal').DataTable({
                    "lengthChange": true
                });
            }
        });
    });

});