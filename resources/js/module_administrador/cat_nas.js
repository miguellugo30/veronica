$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newNas", function(e) {

        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/cat_nas/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveNas', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let ip_nas = $("#ip_nas").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/cat_nas';

        $.post(url, {
            nombre: nombre,
            ip_nas: ip_nas,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);
            $('.viewIndex #tableNas').DataTable({
                "lengthChange": true,
                "order": [
                    [5, "asc"]
                ]
            });
        });
    });
    /**
     * Evento para mostrar el formulario editar modulo
     */
    $(document).on('dblclick', '#tableNas tbody tr', function(event) {
        event.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/cat_nas/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

        });
    });
    /**
     * Evento para cancelar la creacion/edicion del modulo
     */
    $(document).on("click", ".cancelNas", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateNas', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let ip_nas = $("#ip_nas").val();
        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/cat_nas/' + id;

        $.ajax({
            url: url,
            type: 'PUT',
            data: {
                nombre: nombre,
                ip_nas: ip_nas,
                _token: _token
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex #tableNas').DataTable({
                    "lengthChange": true,
                    "order": [
                        [5, "asc"]
                    ]
                });
            }
        });
    });
    /**
     * Evento para eliminar el modulo
     */
    $(document).on('click', '.deleteNas', function(event) {
        event.preventDefault();

        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/cat_nas/' + id;

        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                _token: _token
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex #tableNas').DataTable({
                    "lengthChange": true,
                    "order": [
                        [5, "asc"]
                    ]
                });
            }
        });
    });
});