$(function() {

    var currentURL = window.location.href;

    /**
     * Evento para mostrar el formulario de edicion de sub menu
     */
    $(document).on('click', '#tableSubMenus tbody tr', function(e) {
        e.preventDefault();

        $("#tableMenus tbody tr").removeClass('table-primary'); //Quitamos la clase de seleccion
        $("#tableSubMenus tbody tr").removeClass('table-primary'); //Quitamos la clase de seleccion
        $(this).addClass('table-primary') //Agregamos la clase de seleccion al tr

        let id = $(this).data("id");
        $("#idSeleccionado").val(id); //Asignamos el valor del id, del elemento seleccionado
        $("#tipoSeleccionado").val(2); //Asignamos el valor del id, del elemento seleccionado

    });
    /**
     * Evento para editar un sub menu
     */
    $(document).on('click', '.editSubMenu', function(event) {
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
    $(document).on('click', '.deleteSubMenu', function(event) {
        event.preventDefault();
        let id = $("#id_subCate").val();
        let id_categoria = $("#id_categoria").val();
        let _token = $("input[name=_token]").val();
        let _method = "DELETE";
        let url = currentURL + '/submenus/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                id_categoria: id_categoria,
                _token: _token,
                _method: _method
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
    /**
     * Evento para order las sub categorias
     */
    $(document).on('click', '.orderignSubCat', function(e) {
        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewSubCat").slideUp();
        $(".viewCreate").slideDown();

        let id_categoria = $("#id_categoria").val();
        let url = currentURL + "/submenus/ordering/" + id_categoria;

        $.get(url, id_categoria, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
            $("#sortable").sortable();
        });
    });
    /**
     * Evento para editar el menu
     */
    $(document).on('click', '.saveOrdeSubrMenu', function(event) {
        event.preventDefault();

        let ordenElementos = $("#sortable").sortable("toArray").toString();
        let _token = $("input[name=_token]").val();
        let id_categoria = $("#id_categoria").val();
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