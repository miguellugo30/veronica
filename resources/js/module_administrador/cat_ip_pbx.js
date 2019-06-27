$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newPbx", function(e) {

        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/cat_ip_pbx/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.savePbx', function(event) {
        event.preventDefault();

        let media_server = $("#media_server").val();
        let ip_pbx = $("#ip_pbx").val();
        let arr = $('[name="nas[]"]:checked').map(function() {
            return this.value;
        }).get();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/cat_ip_pbx';

        $.post(url, {
            media_server: media_server,
            ip_pbx: ip_pbx,
            arr: arr,
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
        let url = currentURL + "/cat_ip_pbx/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

        });
    });
    /**
     * Evento para cancelar la creacion/edicion del modulo
     */
    $(document).on("click", ".cancelPbx", function(e) {
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
        let url = currentURL + '/cat_ip_pbx/' + id;

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
        let url = currentURL + '/cat_ip_pbx/' + id;

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