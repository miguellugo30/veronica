$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para crear una nueva categoria
     */
    $(document).on("click", ".newMenu", function(e) {
        e.preventDefault();
        $('#tituloModal').html('Nuevo Menu / Sub Menu');
        $('#action').removeClass('updateMenu');
        $('#action').removeClass('saveOrderMenu');
        $('#action').addClass('saveMenu');

        let url = currentURL + '/menus/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para saber que tipo de menu se dara de alta
     */
    $(document).on("change", "#tipo_id", function(e) {
        let tipo = $(this).val();
        if (tipo == 2) {
            $(".selectModulo").slideUp();
            $(".selectMenu").slideDown();
        } else {
            $(".selectMenu").slideUp();
            $(".selectModulo").slideDown();
        }
    });
    /**
     * Evento para guardar la nueva categoria
     */
    $(document).on('click', '.saveMenu', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let tipo_id = $("#tipo_id").val();
        let modulo_id = $("#modulo_id").val();
        let menu_id = $("#menu_id").val();
        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let nivel_id = $("#nivel_id").val();
        let _token = $("input[name=_token]").val();
        /**
         * Si tipo_id es igual uno se manda la informacion para crear un menu
         * Si no se manda la informacion para crear un sub menu
         */
        if (tipo_id == 1) {
            url = currentURL + '/menus';
            $.post(url, {
                nombre: nombre,
                descripcion: descripcion,
                tipo: nivel_id,
                modulos_id: modulo_id,
                _token: _token
            }, function(data, textStatus, xhr) {
                $('.viewResult').html(data);
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )
            });
        } else {
            url = currentURL + '/submenus';
            $.post(url, {
                nombre: nombre,
                descripcion: descripcion,
                tipo: nivel_id,
                id_categoria: menu_id,
                _token: _token
            }, function(data, textStatus, xhr) {
                $('.viewResult').html(data);
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )
            });
        }


    });
    /**
     * Evento para editar una categoria o sub categoria
     */
    $(document).on("click", ".editMenu", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Editar Menu / Sub Menu');
        $('#action').removeClass('saveMenu');
        $('#action').removeClass('saveOrderMenu');
        $('#action').addClass('updateMenu');

        let id = $("#idSeleccionado").val();
        let tipo = $("#tipoSeleccionado").val();
        if (tipo == 1) {
            url = currentURL + "/menus/" + id + "/edit";
        } else {
            url = currentURL + "/submenus/" + id + "/edit";
        }

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para editar el menu
     */
    $(document).on('click', '.updateMenu', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let tipo = $("#tipoSeleccionado").val();

        if (tipo == 1) {

            let nombre = $("#nombre").val();
            let id = $("#id_categoria").val();
            let descripcion = $("#descripcion").val();
            let tipo = $("#tipo").val();
            let _token = $("input[name=_token]").val();
            let _method = $("input[name=_method]").val();
            url = currentURL + "/menus/" + id;
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
                    Swal.fire(
                        'Correcto!',
                        'El registro ha sido guardado.',
                        'success'
                    )
                }
            });

        } else {

            let nombre = $("#nombre").val();
            let id = $("#id_subCate").val();
            let descripcion = $("#descripcion").val();
            let tipo = $("#tipo").val();
            let _token = $("input[name=_token]").val();
            let _method = $("input[name=_method]").val();
            url = currentURL + "/submenus/" + id;

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
                    Swal.fire(
                        'Correcto!',
                        'El registro ha sido guardado.',
                        'success'
                    )
                }
            });

        }
    });
    /**
     * Evento para eliminar una categoria
     */
    $(document).on('click', '.deleteMenu', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Estas seguro?',
            text: "Deseas eliminar el registro seleccionado!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                let tipo = $("#tipoSeleccionado").val();
                let id = $("#idSeleccionado").val();
                let _token = $("input[name=_token]").val();
                let _method = "DELETE";

                if (tipo == 1) {
                    url = currentURL + '/menus/' + id;
                } else {
                    url = currentURL + '/submenus/' + id;
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method,
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        Swal.fire(
                            'Eliminado!',
                            'El registro ha sido eliminado.',
                            'success'
                        )
                    }
                });
            }
        });
    });
    /**
     * Evento para order las categorias
     */
    $(document).on('click', '.orderignCat', function(e) {
        e.preventDefault();
        $('#tituloModal').html('Ordenar Menu / Sub Menu');
        $('#action').removeClass('saveMenu');
        $('#action').removeClass('updateMenu');
        $('#action').addClass('saveOrderMenu');

        let orden = $("#ordenSeleccionado").val();
        let id = $("#idSeleccionado").val();

        if (orden == 0) {
            url = currentURL + "/menus/ordering";
        } else {
            url = currentURL + "/submenus/ordering/" + id;
        }


        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
            $("#sortable").sortable();
        });
    });
    /**
     * Evento para editar el menu
     */
    $(document).on('click', '.saveOrderMenu', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        var ordenElementos = $("#sortable").sortable("toArray").toString();
        let _token = $("input[name=_token]").val();
        let orden = $("#ordenSeleccionado").val();
        let id = $("#idSeleccionado").val();

        if (orden == 0) {
            url = currentURL + "/menus/updateOrdering";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    ordenElementos: ordenElementos,
                    _token: _token
                },
                success: function(result) {
                    $('.viewResult').html(result);
                    Swal.fire(
                        'Muy bien!',
                        'Ha sido ordenado el menu.',
                        'success'
                    )
                }
            });
        } else {
            url = currentURL + "/submenus/updateOrdering";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    ordenElementos: ordenElementos,
                    id_categoria: id,
                    _token: _token
                },
                success: function(result) {
                    $('.viewResult').html(result);
                    Swal.fire(
                        'Muy bien!',
                        'Ha sido ordenado el sub menu.',
                        'success'
                    )
                }
            });
        }

    });
});
