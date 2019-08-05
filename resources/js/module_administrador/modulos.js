$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newModule", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Nuevo Modulo');
        $('#action').removeClass('saveOrderModulo');
        $('#action').removeClass('updateModulo');
        $('#action').addClass('saveModulo');

        let url = currentURL + '/modulos/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveModulo', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/modulos';

        $.post(url, {
            nombre: nombre,
            descripcion: descripcion,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);

            $('.viewResult #tableModulos').DataTable({
                "lengthChange": true,
                "order": [
                    [2, "asc"]
                ]
            });
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        });
    });
    /**
     * Evento para mostrar el formulario editar modulo
     */
    $(document).on('click', '#tableModulos tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");
        $(".editModule").slideDown();
        $(".deleteModule").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableModulos tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para mostrar el formulario de edicion de un canal
     */
    $(document).on("click", ".editModule", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Editar Modulo');
        $('#action').removeClass('saveModulo');
        $('#action').removeClass('saveOrderModulo');
        $('#action').addClass('updateModulo');

        let id = $("#idSeleccionado").val();

        let url = currentURL + "/modulos/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateModulo', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombreEdit").val();
        let descripcion = $("#descripcionEdit").val();
        let id_modulo = $("#id_modulo").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/modulos/' + id_modulo;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                nombre: nombre,
                descripcion: descripcion,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewResult #tableModulos').DataTable({
                    "lengthChange": true,
                    "order": [
                        [2, "asc"]
                    ]
                });
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )
            }
        });
    });
    /**
     * Evento para eliminar el modulo
     */
    $(document).on('click', '.deleteModule', function(event) {
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
                let id = $("#idSeleccionado").val();
                let _token = $("input[name=_token]").val();
                let _method = "DELETE";
                let url = currentURL + '/modulos/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method,
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableModulos').DataTable({
                            "lengthChange": true,
                            "order": [
                                [2, "asc"]
                            ]
                        });
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
    $(document).on('click', '.orderignModule', function(e) {
        e.preventDefault();
        $('#tituloModal').html('Ordenar Modulo');
        $('#action').removeClass('saveModulo');
        $('#action').removeClass('updateModulo');
        $('#action').addClass('saveOrderModulo');

        let url = currentURL + "/modulos/ordering";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
            $("#sortable").sortable();
        });
    });
    /**
     * Evento para editar el menu
     */
    $(document).on('click', '.saveOrderModulo', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let ordenElementos = $("#sortable").sortable("toArray").toString();
        let _token = $("input[name=_token]").val();
        let url = currentURL + "/modulos/updateOrdering";

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
                    'Los modulos han sido ordenados.',
                    'success'
                )
            }
        });
    });
});