$(function() {
    /**
     * Evento para el menu categorias y mostrar las sub categorias
     */
    $(".menu-categorias li a").click(function(e) {
        e.preventDefault();
        $(".viewResult").html('');
        $(".menu-categorias li").removeClass("active");
        $(this).addClass("active");

        url = $(this).attr('href');

        $.get(url, function(data, textStatus, jqXHR) {
            $(".sub-categorias").html(data);
        });

    });

    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(".sub-categorias").on("click", ".subCat a", function(e) {

        e.preventDefault();
        id = $(this).data("id");

        if (id == 6) {
            $.get('administrador/usuarios', function(data, textStatus, jqXHR) {
                $(".viewResult").html(data);
                $('.viewResult #tableUsuarios').DataTable({
                    "lengthChange": false
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

        $.get('administrador/usuarios/create', function(data, textStatus, jqXHR) {
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

                var name = $("#name").val();
                var email = $("#email").val();
                var pass_1 = $("#pass_1").val();
                var pass_2 = $("#pass_2").val();
                var cliente = $("#cliente").val();
                var rol = $("#rol").val();
                var _token = $("input[name=_token]").val();

                $.post("administrador/usuarios", {
                    name: name,
                    email: email,
                    password: pass_1,
                    id_cliente: cliente,
                    rol: rol,
                    _token: _token
                }, function(data, textStatus, xhr) {
                    $('.viewIndex').html(data);
                    $('.viewCreate').slideUp();
                    $('.viewIndex').slideDown();
                    $('.viewCreate').html("");
                });


            });

        });
    });

});