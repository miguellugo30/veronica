$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo Evento
     */
    $(document).on("click", ".newEventoAgente", function(e) {
        e.preventDefault();
        $('#tituloModal').html('Alta de Evento');
        $('#action').removeClass('deleteEventoAgente');
        $('#action').addClass('saveEventoAgente');

        let url = currentURL + "/EventosAgentes/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo Evento
     */
    $(document).on('click', '.saveEventoAgente', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let tiempo = $("#tiempo").val();
        //let fechaini = $("#fechaini").val();
        //let fechafin = $("#fechafin").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/EventosAgentes';

        $.post(url, {
            nombre: nombre,
            tiempo: tiempo,
            //fechaini: fechaini,
            //fechafin: fechafin,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);

            $('.viewResult #tableEventosAgentes').DataTable({
                "lengthChange": true,
                "order": [
                    [0, "asc"]
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
     * Evento para seleccionar un Evento
     */
    $(document).on('click', '#tableEventosAgentes tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".deleteEventoAgente").slideDown();
        $(".editEventoAgente").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableEventosAgentes tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });;

    /**
     * Evento para eliminar un Evento
     *
     */
    $(document).on('click', '.deleteEventoAgente', function(event) {
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
                let _method = "DELETE";
                let _token = $("input[name=_token]").val();
                let url = currentURL + '/EventosAgentes/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableEventosAgentes').DataTable({
                            "lengthChange": false
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
     * Evento para visualizar la configuración del Grupo
     */
    $(document).on('click', '.editEventoAgente', function(event) {
        event.preventDefault();
        var id = $("#idSeleccionado").val();
        $('#tituloModal').html('Editar Evento');
        var url = currentURL + '/EventosAgentes/' + id + '/edit';
        $('#action').addClass('updateEventoAgente');
        $('#action').removeClass('saveEventoAgente');
        $.ajax({
            url: url,
            type: 'GET',
            success: function success(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);
            }
        });
    });
    /**
     * Evento para guardar los cambios del Agente
     */
    $(document).on('click', '.updateEventoAgente', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');
        let id = $("#id").val();
        let nombre = $("#nombre").val();
        let tiempo = $("#tiempo").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/EventosAgentes/' + id;

        $.post(url, {
            nombre: nombre,
            tiempo: tiempo,
            _method: _method,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);

            $('.viewResult #tableEventosAgentes').DataTable({
                "lengthChange": true,
                "order": [
                    [1, "asc"]
                ]
            });
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        });

    });

});;
