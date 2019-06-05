$(function() {

    let currentURL = window.location.href;

    /**
     * Evento para ver el formulario de nuevo usuario
     */
    $(".viewResult").on("click", "#tableMenus tbody tr", function(e) {
        let id = $(this).data("id");

        $(".viewIndex").removeClass('col-md-12');
        $(".viewIndex").addClass('col-md-6');

        let url = currentURL + '/menus/' + id;
        $.get(url, function(data, textStatus, jqXHR) {

            $(".viewSubCat").html(data);
            $('.viewResult #tableSubMenus').DataTable({
                "lengthChange": true,
                "order": [
                    [2, "asc"]
                ]
            });
        });
    });

    /**
     * Evento para crear una nueva categoria
     */
    $(".viewResult").on("click", ".newCat", function(e) {
        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewSubCat").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/menus/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

            /**
             * Evento para cancelar el alta de nuevo usuario
             */
            $(".viewCreate").on("click", ".cancelMenu", function(e) {
                $(".viewIndex").slideDown();
                $(".viewSubCat").slideDown();
                $(".viewCreate").slideUp();
            });

        });

        /**
         * Evento para guardar el nuevo usuario
         */
        $('.viewCreate').on('click', '.saveMenu', function(event) {
            event.preventDefault();

            let nombre = $("#nombre").val();
            let descripcion = $("#descripcion").val();
            let tipo = $("#tipo").val();
            let _token = $("input[name=_token]").val();
            let url = currentURL + '/menus';

            $.post(url, {
                nombre: nombre,
                descripcion: descripcion,
                tipo: tipo,
                _token: _token
            }, function(data, textStatus, xhr) {
                $('.viewResult').html(data);
                $('.viewCreate').slideUp();
                $('.viewIndex').slideDown();
                $('.viewResult #tableMenus').DataTable({
                    "lengthChange": true,
                    "order": [
                        [2, "asc"]
                    ]
                });
            });

        });
    });

    /**
     * Evento para editar un usuario
     */
    $(".viewResult").on('dblclick', '#tableMenus tbody tr', function(e) {
        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewSubCat").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/menus/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {

            $(".viewCreate").html(data);

            /**
             * Evento para cancelar la edicion del menu
             */
            $(".viewCreate").on("click", ".cancelMenu", function(e) {
                $(".viewIndex").slideDown();
                $(".viewSubCat").slideDown();
                $(".viewCreate").slideUp();
            });

            /**
             * Evento para editar el menu
             */
            $('.viewCreate').on('click', '.editMenu', function(event) {
                event.preventDefault();

                let nombre = $("#nombre").val();
                let id = $("#id_categoria").val();
                let descripcion = $("#descripcion").val();
                let tipo = $("#tipo").val();
                let _token = $("input[name=_token]").val();
                let _method = $("input[name=_method]").val();
                let url = currentURL + '/menus/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        nombre: nombre,
                        descripcion: descripcion,
                        tipo: tipo,
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewCreate').slideUp();
                        $('.viewIndex').slideDown();
                        $('.viewResult #tableMenus').DataTable({
                            "lengthChange": true,
                            "order": [
                                [2, "asc"]
                            ]
                        });
                    }
                });
            });

            /**
             * Evento para eliminar el  usuario
             */
            $('.viewCreate').on('click', '.deleteMenu', function(event) {
                event.preventDefault();

                let id = $("#id_categoria").val();
                let _token = $("input[name=_token]").val();
                let url = currentURL + '/menus/' + id;

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
                        $('.viewResult #tableMenus').DataTable({
                            "lengthChange": true,
                            "order": [
                                [2, "asc"]
                            ]
                        });
                    }
                });
            });

        });

    });

    /**
     * Evento para editar un usuario
     */
    $('.viewResult').on('click', '.orderignCat', function(e) {
        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewSubCat").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + "/menus/ordering";

        $.get(url, function(data, textStatus, jqXHR) {

            $(".viewCreate").html(data);

            $("#sortable").sortable();

            /**
             * Evento para cancelar la edicion del menu
             */
            $(".viewCreate").on("click", ".cancelMenu", function(e) {
                $(".viewIndex").slideDown();
                $(".viewSubCat").slideDown();
                $(".viewCreate").slideUp();
            });

            /**
             * Evento para editar el menu
             */
            $('.viewCreate').on('click', '.saveOrderMenu', function(event) {
                event.preventDefault();

                var ordenElementos = $("#sortable").sortable("toArray").toString();
                let _token = $("input[name=_token]").val();
                let url = currentURL + "/menus/updateOrdering";

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        ordenElementos: ordenElementos,
                        _token: _token
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewCreate').slideUp();
                        $('.viewIndex').slideDown();
                        $('.viewResult #tableMenus').DataTable({
                            "lengthChange": true,
                            "order": [
                                [2, "asc"]
                            ]
                        });
                    }
                });
            });

        });

    });
});