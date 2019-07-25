$(function() {

    let currentURL = window.location.href;


    /**
     * Evento para ver el formulario de nuevo usuario
     */
    $(document).on("click", ".newUser", function(e) {
        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/usuarios/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo usuario
     */
    $(document).on("click", '.saveClient', function(event) {
        event.preventDefault();

        let name = $("#name").val();
        let email = $("#email").val();
        let pass_1 = $("#pass_1").val();
        let cliente = $("#cliente").val();
        let rol = $("#rol").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/usuarios';
        let arr = $('[name="cats[]"]:checked').map(function() {
            return this.value;
        }).get();

        $.post(url, {
            name: name,
            email: email,
            password: pass_1,
            id_cliente: cliente,
            rol: rol,
            arr: arr,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewCreate').slideUp();
            $('.viewIndex').slideDown();
            $('.viewResult #tableUsuarios').DataTable({
                "lengthChange": true
            });
        });

    });
    /**
     * Evento para cancelar el alta de nuevo usuario
     */
    $(document).on("click", ".cancelClient", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });

    /**
     * Evento para editar un usuario
     */
    $(document).on('dblclick', '#tableUsuarios tbody tr', function(event) {
        event.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/usuarios/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
    });
    /**
     * Evento para editar el usuario
     */
    $(document).on('click', '.updateClient', function(event) {
        event.preventDefault();

        let name = $("#name").val();
        let id_user = $("#id_user").val();
        let email = $("#email").val();
        let pass_1 = $("#pass_1").val();
        let cliente = $("#cliente").val();
        let rol = $("#rol").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/usuarios/' + id_user;
        let arr = $('[name="cats[]"]:checked').map(function() {
            return this.value;
        }).get();

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                name: name,
                email: email,
                password: pass_1,
                id_cliente: cliente,
                rol: rol,
                arr: arr,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex').slideDown();
                $('.viewResult #tableUsuarios').DataTable({
                    "lengthChange": true
                });
            }
        });
    });
    /**
     * Evento para eliminar el  usuario
     */
    $(document).on('click', '.deleteClient', function(event) {
        event.preventDefault();

        let id_user = $("#id_user").val();
        let _token = $("input[name=_token]").val();
        let _method = "DELETE";
        let url = currentURL + '/usuarios/' + id_user;

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
                $('.viewIndex').slideDown();
                $('.viewResult #tableUsuarios').DataTable({
                    "lengthChange": true
                });
            }
        });
    });
});