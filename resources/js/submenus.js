$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para crear una nueva sub categoria
     */
    $(document).on("click", ".newSubCat", function(e) {

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
    $(document).on("click", ".cancelSubMenu", function(e) {
        $(".viewIndex").slideDown();
        $(".viewSubCat").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para guardar el nuevo sub menu
     */
    $(document).on('click', '.saveSubMenu', function(event) {
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
    /**
     * Evento para mostrar el formulario de edicion de sub menu
     */
    $(document).on('dblclick', '#tableSubMenus tbody tr', function(e) {
        e.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewSubCat").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/submenus/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
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