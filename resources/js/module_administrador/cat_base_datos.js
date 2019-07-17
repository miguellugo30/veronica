$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newDataBase", function(e) {

        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/basedatos/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveBaseDatos', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let ubicacion = $("#ubicacion").val();
        let ip = $("#ip").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/basedatos';

        $.post(url, {
            nombre: nombre,
            ubicacion: ubicacion,
            ip: ip,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewIndex #tableBaseDatos').DataTable({
                "lengthChange": true
            });
        });
    });
    /**
     * Evento para mostrar el formulario editar modulo
     */
    $(document).on('dblclick', '#tableBaseDatos tbody tr', function(event) {
        event.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/basedatos/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

        });
    });
    /**
     * Evento para cancelar la creacion/edicion del modulo
     */
    $(document).on("click", ".cancelBaseDatos", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateBaseDatos', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let ubicacion = $("#ubicacion").val();
        let ip = $("#ip").val();
        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/basedatos/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                nombre: nombre,
                ubicacion: ubicacion,
                ip: ip,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex #tableBaseDatos').DataTable({
                    "lengthChange": true
                });
            }
        });
    });
    /**
     * Evento para eliminar el modulo
     */
    $(document).on('click', '.deleteBaseDatos', function(event) {
        event.preventDefault();

        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let _method = "DELETE";
        let url = currentURL + '/basedatos/' + id;

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
                $('.viewIndex #tableBaseDatos').DataTable({
                    "lengthChange": true
                });
            }
        });
    });

});