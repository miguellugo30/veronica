$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para seleccionar un Buzon de Voz
     */
    $(document).on('click', '#tableBuzonVoz tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".deleteBuzonVoz").slideDown();
        $(".editBuzonVoz").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableDesvios tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });;
    /**
     * Evento para mostrar el formulario de crear un nuevo Buzon de voz
     */
    $(document).on("click", ".newBuzonVoz", function(e) {
        event.preventDefault();
        $('#tituloModal').html('Agregar Buzon De Voz');
        $('#action').removeClass('deleteBuzonVoz');
        $('#action').addClass('saveBuzonVoz');

        let url = currentURL + "inbound/Buzon_Voz/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo agente
     */
    $(document).on('click', '.saveBuzonVoz', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let tiempo_maximo = $("#tiempo_maximo").val();
        let terminacion = $("#terminacion").val();
        let Audios_Empresa_id = $("#Audios_Empresa_id").val();
        let correos = $("#correos").val();
        let Empresas_id = $("#Empresas_id").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + 'inbound/Buzon_Voz';

        $.post(url, {
            nombre: nombre,
            tiempo_maximo: tiempo_maximo,
            terminacion: terminacion,
            Audios_Empresa_id: Audios_Empresa_id,
            correos: correos,
            Empresas_id: Empresas_id,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('#modal').modal('hide');
            $('.modal-backdrop ').css('display', 'none');
            $('.viewResult').html(data);

            $('.viewResult #tableBuzonVoz').DataTable({
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
        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });

    });
    /**
     * Evento para eliminar un buzon
     *
     */
    $(document).on('click', '.deleteBuzonVoz', function(event) {
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
                let url = currentURL + 'inbound/Buzon_Voz/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableBuzonVoz').DataTable({
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
     * Evento para visualizar la configuración del Buzon de Voz y editarlo
     */
    $(document).on('click', '.editBuzonVoz', function(event) {

        event.preventDefault();
        var id = $("#idSeleccionado").val();
        var url = currentURL + 'inbound/Buzon_Voz/' + id + '/edit';

        $('#tituloModal').html('Editar Buzon De Voz');
        $('#action').addClass('updateBuzonVoz');
        $('#action').removeClass('saveBuzonVoz');

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
     * Evento para guardar los cambios del Desvio
     */
    $(document).on('click', '.updateBuzonVoz', function(event) {
        event.preventDefault();
        let id = $("#id").val();
        let nombre = $("#nombre").val();
        let tiempo_maximo = $("#tiempo_maximo").val();
        let terminacion = $("#terminacion").val();
        let Audios_Empresa_id = $("#Audios_Empresa_id").val();
        let correos = $("#correos").val();
        let Empresas_id = $("#Empresas_id").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + 'inbound/Buzon_Voz/' + id;

        $.post(url, {
            nombre: nombre,
            tiempo_maximo: tiempo_maximo,
            terminacion: terminacion,
            Audios_Empresa_id: Audios_Empresa_id,
            correos: correos,
            Empresas_id: Empresas_id,
            _method: _method,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.modal-backdrop ').css('display', 'none');
            $('#modal').modal('hide');
            $('.viewResult').html(data);

            $('.viewResult #tableBuzonVoz').DataTable({
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
        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });
    });
    /**
     * Funcion para mostrar los errores de los formularios
     */
    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $(".form-control").removeClass('is-invalid');
        for (var clave in msg) {
            $("#" + clave).addClass('is-invalid');
            if (msg.hasOwnProperty(clave)) {
                $(".print-error-msg").find("ul").append('<li>' + msg[clave][0] + '</li>');
            }
        }
    }
});