$(function() {

    let currentURL = window.location.href;

    /**
     * Evento para ver las sub categorias de la categoria seleccionada
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

            /**
             * Evento para crear una nueva sub categoria
             */
            $(".viewSubCat").on("click", ".newSubCat", function(e) {

                e.preventDefault();
                $(".viewIndex").slideUp();
                $(".viewSubCat").slideUp();
                $(".viewCreate").slideDown();

                let url = currentURL + '/submenus/create';

                $.get(url, function(data, textStatus, jqXHR) {
                    $(".viewCreate").html(data);

                });
            });

            /**
             * Evento para cancelar el alta de nuevo sub menu
             */
            $(".viewCreate").on("click", ".cancelSubMenu", function(e) {
                $(".viewIndex").slideDown();
                $(".viewSubCat").slideDown();
                $(".viewCreate").slideUp();
                $(".viewCreate").html('');
            });

            /**
             * Evento para guardar el nuevo sub menu
             */
            $('.viewCreate').on('click', '.saveSubMenu', function(event) {
                event.preventDefault();

                let id_categoria = $("#id_categoria").val();
                let nombre = $("#nombre").val();
                let descripcion = $("#descripcion").val();
                let tipo = $("#tipo").val();
                let _token = $("input[name=_token]").val();
                let url = currentURL + '/submenus';

                $.post(url, {
                    nombre: nombre,
                    descripcion: descripcion,
                    tipo: tipo,
                    id_categoria: id_categoria,
                    _token: _token
                }, function(data, textStatus, xhr) {

                    $('.viewSubCat').html(data);
                    $('.viewCreate').slideUp();
                    $(".viewCreate").html('');

                    $(".viewSubCat").slideDown();
                    $('.viewIndex').slideDown();

                    $('.viewSubCat #tableSubMenus').DataTable({
                        "lengthChange": true,
                        "order": [
                            [2, "asc"]
                        ]
                    });
                });
            });
        });
    });

    $(".viewResult").on('dblclick', '#tableSubMenus tbody tr', function(e) {
        e.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewSubCat").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/submenus/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
        /**
         * Evento para editar un sub menu
         */
        $('.viewCreate').on('click', '.editSubMenu', function(event) {
            event.preventDefault();

            let id_subCategoria = $("#id_subCate").val();
            let id_categoria = $("#id_categoria").val();
            let nombre = $("#nombre").val();
            let descripcion = $("#descripcion").val();
            let tipo = $("#tipo").val();
            let _method = $("input[name=_method]").val();
            let _token = $("input[name=_token]").val();
            let url = currentURL + '/submenus/' + id_subCategoria;

            $.post(url, {
                nombre: nombre,
                descripcion: descripcion,
                tipo: tipo,
                id_categoria: id_categoria,
                id_subCategoria: id_subCategoria,
                _token: _token,
                _method: _method
            }, function(data, textStatus, xhr) {

                $('.viewSubCat').html(data);
                $('.viewCreate').slideUp();
                $(".viewCreate").html('');

                $(".viewSubCat").slideDown();
                $('.viewIndex').slideDown();

                $('.viewSubCat #tableSubMenus').DataTable({
                    "lengthChange": true,
                    "order": [
                        [2, "asc"]
                    ]
                });
            });
        });

        /**
         * Evento para eliminar una categoria
         */
        $('.viewCreate').on('click', '.deleteSubMenu', function(event) {
            event.preventDefault();
            let id = $("#id_subCate").val();
            let id_categoria = $("#id_categoria").val();
            let _token = $("input[name=_token]").val();
            let url = currentURL + '/submenus/' + id;

            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    id_categoria: id_categoria,
                    _token: _token
                },
                success: function(data) {
                    $('.viewSubCat').html(data);
                    $('.viewCreate').slideUp();
                    $(".viewCreate").html('');

                    $(".viewSubCat").slideDown();
                    $('.viewIndex').slideDown();

                    $('.viewSubCat #tableSubMenus').DataTable({
                        "lengthChange": true,
                        "order": [
                            [2, "asc"]
                        ]
                    });
                }
            });
        });
    });

    /**
     * Evento para order las sub categorias
     */
    $('.viewResult').on('click', '.orderignSubCat', function(e) {
        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewSubCat").slideUp();
        $(".viewCreate").slideDown();

        let id_categoria = $("#id_categoria").val();
        let url = currentURL + "/submenus/ordering/" + id_categoria;

        $.get(url, id_categoria, function(data, textStatus, jqXHR) {

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
            $('.viewCreate').on('click', '.saveOrdeSubrMenu', function(event) {
                event.preventDefault();

                var ordenElementos = $("#sortable").sortable("toArray").toString();
                let _token = $("input[name=_token]").val();
                let url = currentURL + "/submenus/updateOrdering";

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        ordenElementos: ordenElementos,
                        id_categoria: id_categoria,
                        _token: _token
                    },
                    success: function(result) {
                        $('.viewSubCat').html(result);
                        $('.viewCreate').slideUp();
                        $(".viewCreate").html('');

                        $(".viewSubCat").slideDown();
                        $('.viewIndex').slideDown();

                        $('.viewSubCat #tableSubMenus').DataTable({
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
             * Evento para cancelar el alta de la categoria
             */
            $(".viewCreate").on("click", ".cancelMenu", function(e) {
                $(".viewIndex").slideDown();
                $(".viewSubCat").slideDown();
                $(".viewCreate").slideUp();
            });

        });

        /**
         * Evento para guardar la nueva categoria
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
     * Evento para editar una categoria
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
             * Evento para eliminar una categoria
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
     * Evento para order las categorias
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
});;