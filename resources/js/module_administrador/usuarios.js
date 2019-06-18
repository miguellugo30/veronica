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
            url = currentURL + '/usuarios';
            table = ' #tableUsuarios';
        } else if (id == 4) {
            url = currentURL + '/menus';
            table = ' #tableMenus';
        } else if (id == 3) {
            url = currentURL + '/modulos';
            table = ' #tableDistribuidores';
        } else if (id == 1) {
            url = currentURL + '/distribuidor';
            table = ' #tableDistribuidores';
        } else if (id == 8) {
            url = currentURL + '/did';
            table = ' #tableDid';
        } else if (id == 10) {
            url = currentURL + '/cat_empresa';
            table = ' #tableDid';
        } else if (id == 11) {
            url = currentURL + '/cat_ip_pbx';
            table = ' #tableDid';
        } else if (id == 12) {
            url = currentURL + '/cat_nas';
            table = ' #tableDid';
        } else if (id == 13) {
            url = currentURL + '/cat_agente';
            table = ' #tableEdoAge';
        } else if (id == 14) {
            url = currentURL + '/cat_cliente';
            table = ' #tableEdoCli';
        }

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewResult").html(data);
            $('.viewResult' + table).DataTable({
                "lengthChange": true
            });
        });

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
                let _method = "PUT";
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