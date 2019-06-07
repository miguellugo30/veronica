$(function() {

    let currentURL = window.location.href;

    /**
     * Evento para el menu categorias y mostrar las sub categorias
     */
    $(".menu-categorias li a").click(function(e) {
        e.preventDefault();
        $(".viewResult").html('');

        let url = $(this).attr('href');

        $.get(url, function(data, textStatus, jqXHR) {
            $(".sub-categorias").html(data);
        });
    });

    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(".sub-categorias").on("click", ".subCat a", function(e) {

        e.preventDefault();
        let id = $(this).data("id");

        if (id == 6) {
            let url = currentURL + '/usuarios';
            $.get(url, function(data, textStatus, jqXHR) {
                $(".viewResult").html(data);
                $('.viewResult #tableUsuarios').DataTable({
                    "lengthChange": true
                });
            });
        } else if (id == 4) {
            let url = currentURL + '/menus';
            $.get(url, function(data, textStatus, jqXHR) {
                $(".viewResult").html(data);
                $('.viewResult #tableMenus').DataTable({
                    "lengthChange": true,
                    "order": [
                        [2, "asc"]
                    ]
                });
            });
        } else if (id == 3) {
            let url = currentURL + '/modulos';
            $.get(url, function(data, textStatus, jqXHR) {
                $(".viewResult").html(data);
                $('.viewResult #tableModulos').DataTable({
                    "lengthChange": true,
                    "order": [
                        [2, "asc"]
                    ]
                });
            });
        }
    });

    /**
     * Evento para ver el formulario de nuevo usuario
     */
    $(".viewResult").on("click", ".newUser", function(e) {
        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/usuarios/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

            /**
             * Evento para cancelar el alta de nuevo usuario
             */
            $(".viewCreate").on("click", ".cancelClient", function(e) {
                $(".viewIndex").slideDown();
                $(".viewCreate").slideUp();
            });

            /**
             * Evento para guardar el nuevo usuario
             */
            $('.viewCreate').on('click', '.saveClient', function(event) {
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
        });
    });

    /**
     * Evento para editar un usuario
     */
    $(".viewResult").on('dblclick', '#tableUsuarios tbody tr', function(event) {
        event.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/usuarios/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

            /**
             * Evento para cancelar la edicion del usuario
             */
            $(".viewCreate").on("click", ".cancelClient", function(e) {
                $(".viewIndex").slideDown();
                $(".viewCreate").slideUp();
                $(".viewCreate").html('');
            });

            /**
             * Evento para editar el usuario
             */
            $('.viewCreate').on('click', '.saveClient', function(event) {
                event.preventDefault();

                let name = $("#name").val();
                let id_user = $("#id_user").val();
                let email = $("#email").val();
                let pass_1 = $("#pass_1").val();
                let cliente = $("#cliente").val();
                let rol = $("#rol").val();
                let _token = $("input[name=_token]").val();
                let url = currentURL + '/usuarios/' + id_user;
                let arr = $('[name="cats[]"]:checked').map(function() {
                    return this.value;
                }).get();

                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: {
                        name: name,
                        email: email,
                        password: pass_1,
                        id_cliente: cliente,
                        rol: rol,
                        arr: arr,
                        _token: _token
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
            $('.viewCreate').on('click', '.deleteClient', function(event) {
                event.preventDefault();

                let id_user = $("#id_user").val();
                let _token = $("input[name=_token]").val();
                let url = currentURL + '/usuarios/' + id_user;

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: _token
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
    });
});