$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo canal
     */
    $(document).on("click", ".newTipoCanal", function(e) {
        e.preventDefault();
        $('#tituloModal').html('Nuevo Tipo Canal');
        $('#action').removeClass('updateTipoCanal');
        $('#action').addClass('saveTipoCanales');

        let url = currentURL + '/cat_tipo_canales/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para mostrar el formulario de edicion de un canal
     */
    $(document).on("click", ".editTipoCanal", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Editar Tipo Canal');
        $('#action').removeClass('saveTipoCanales');
        $('#action').addClass('updateTipoCanal');

        let id = $("#idSeleccionado").val();

        let url = currentURL + "/cat_tipo_canales/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveTipoCanales', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let prefijo = $("#prefijo").val();
        let distribuidor = $("#distribuidor").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/cat_tipo_canales';

        $.post(url, {
            nombre: nombre,
            prefijo: prefijo,
            Cat_Distribuidor_id: distribuidor,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewIndex #tableTiposCanal').DataTable({
                "lengthChange": true
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
    $(document).on('click', '#tableTiposCanal tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");
        $(".editTipoCanal").slideDown();
        $(".deleteTipoCanal").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableTiposCanal tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');

    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateTipoCanal', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let prefijo = $("#prefijo").val();
        let distribuidor = $("#distribuidor").val();
        let id = $("#id").val();

        let _token = $("input[name=_token]").val();
        let _method = 'PUT';
        let url = currentURL + '/cat_tipo_canales/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                nombre: nombre,
                prefijo: prefijo,
                Cat_Distribuidor_id: distribuidor,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewIndex #tableTiposCanal').DataTable({
                    "lengthChange": true
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
    $(document).on('click', '.deleteTipoCanal', function(event) {
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
                let url = currentURL + '/cat_tipo_canales/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewIndex #tableTiposCanal').DataTable({
                            "lengthChange": true
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
});