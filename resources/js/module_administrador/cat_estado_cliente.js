$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newEdoCli", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Nuevo Estado Cliente');
        $('#action').removeClass('updateEdoCli');
        $('#action').removeClass('saveOrderEdoCli');
        $('#action').addClass('saveEdoCli');

        let url = currentURL + '/cat_cliente/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para mostrar el formulario de edicion de un canal
     */
    $(document).on("click", ".editEdoCli", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Editar Tipo Canal');
        $('#action').removeClass('saveEdoCli');
        $('#action').removeClass('saveOrderEdoCli');
        $('#action').addClass('updateEdoCli');

        let id = $("#idSeleccionado").val();

        let url = currentURL + "/cat_cliente/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveEdoCli', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let marcar = $('input:radio[name=marcar]:checked').val();
        let mostrar_agente = $('input:radio[name=mostrar_agente]:checked').val();
        let parametrizar = $('input:radio[name=parametrizar]:checked').val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/cat_cliente';

        $.post(url, {
            nombre: nombre,
            descripcion: descripcion,
            marcar: marcar,
            mostrar_agente: mostrar_agente,
            parametrizar: parametrizar,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);
            $('.viewIndex #tableEdoCli').DataTable({
                "lengthChange": true,
                "order": [
                    [5, "asc"]
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
    $(document).on('click', '#tableEdoCli tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");
        $(".editEdoCli").slideDown();
        $(".deleteEdoCli").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableEdoCli tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateEdoCli', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let marcar = $('input:radio[name=marcar]:checked').val();
        let mostrar_agente = $('input:radio[name=mostrar_agente]:checked').val();
        let parametrizar = $('input:radio[name=parametrizar]:checked').val();
        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/cat_cliente/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                nombre: nombre,
                descripcion: descripcion,
                marcar: marcar,
                mostrar_agente: mostrar_agente,
                parametrizar: parametrizar,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex #tableEdoCli').DataTable({
                    "lengthChange": true,
                    "order": [
                        [5, "asc"]
                    ]
                });
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido actualizado.',
                    'success'
                )
            }
        });
    });
    /**
     * Evento para eliminar el modulo
     */
    $(document).on('click', '.deleteEdoCli', function(event) {
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
                let url = currentURL + '/cat_cliente/' + id;

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
                        $('.viewIndex #tableEdoCli').DataTable({
                            "lengthChange": true,
                            "order": [
                                [5, "asc"]
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
    $(document).on('click', '.orderignEdoCli', function(e) {
        e.preventDefault();
        $('#tituloModal').html('Ordenar Estados');
        $('#action').removeClass('saveEdoCli');
        $('#action').removeClass('updateEdoCli');
        $('#action').addClass('saveOrderEdoCli');

        let url = currentURL + "/cat_cliente/ordering";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
            $("#sortable").sortable();
        });
    });
    /**
     * Evento para editar el menu
     */
    $(document).on('click', '.saveOrderEdoCli', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        var ordenElementos = $("#sortable").sortable("toArray").toString();
        let _token = $("input[name=_token]").val();
        let url = currentURL + "/cat_cliente/updateOrdering";

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                ordenElementos: ordenElementos,
                _token: _token
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewIndex #tableEdoCli').DataTable({
                    "lengthChange": true,
                    "order": [
                        [5, "asc"]
                    ]
                });
                Swal.fire(
                    'Muy bien!',
                    'Los modulos han sido ordenados.',
                    'success'
                )
            }
        });
    });
});