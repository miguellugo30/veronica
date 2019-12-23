$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para seleccionar agentes
     */
    $(document).on('click', '#tableAgentes tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".deleteAgente").slideDown();
        $(".editAgente").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableAgentes tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });;
    /**
     * Evento para eliminar el Agente
     *
     */
    $(document).on('click', '.deleteAgente', function(event) {
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
                let url = currentURL + '/Agentes/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableAgentes').DataTable({
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
     * Evento para mostrar el formulario de crear un nuevo Agente
     */
    $(document).on("click", ".newAgente", function(e) {
        event.preventDefault();
        $('#tituloModal').html('Alta de Agente');
        $('#action').removeClass('deleteAgente');
        $('#action').addClass('saveAgente');

        let url = currentURL + "/Agentes/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para visualizar la configuración del Agente
     */
    $(document).on('click', '.editAgente', function(event) {

        event.preventDefault();
        var id = $("#idSeleccionado").val();
        var url = currentURL + '/Agentes/' + id + '/edit';

        $('#tituloModal').html('Editar Agente');
        $('#action').addClass('updateAgente');
        $('#action').removeClass('saveAgente');

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
    $(document).on('click', '.updateAgente', function(event) {
        event.preventDefault();

        let id = $("#id").val();
        let grupo = $("#grupo").val();
        let tipo_licencia = $("#tipo_licencia").val();
        let nivel = $("#nivel").val();
        let nombre = $("#nombre").val();
        let usuario = $("#usuario").val();
        let contrasena = $("#contrasena").val();
        let extension = $("#extension").val();
        let canal = $("#canal").val();
        let mix_monitor = $("input[name='mix_monitor']:checked").val();
        let calificar_llamada = $("input[name='calificar_llamada']:checked").val();
        let envio_sms = $("input[name='envio_sms']:checked").val();
        let editar_datos = $("input[name='editar_datos']:checked").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/Agentes/' + id;

        $.post(url, {
                grupo: grupo,
                tipo_licencia: tipo_licencia,
                nivel: nivel,
                nombre: nombre,
                usuario: usuario,
                contrasena: contrasena,
                extension: extension,
                Canales_id: canal,
                canal: canal,
                mix_monitor: mix_monitor,
                calificar_llamada: calificar_llamada,
                envio_sms: envio_sms,
                editar_datos: editar_datos,
                _method: _method,
                _token: _token
            }, function(data, textStatus, xhr) {
                $('.viewResult').html(data);
                $('.viewResult #tableAgentes').DataTable({
                    "lengthChange": true,
                    "order": [
                        [2, "asc"]
                    ]
                });
            }).done(function() {
                $('.modal-backdrop ').css('display', 'none');
                $('#modal').modal('hide');
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )
            })
            .fail(function(data) {
                printErrorMsg(data.responseJSON.errors);
            });

    });
    /**
     * Evento para guardar el nuevo agente
     */
    $(document).on('click', '.saveAgente', function(event) {
        event.preventDefault();

        let grupo = $("#grupo").val();
        let tipo_licencia = $("#tipo_licencia").val();
        let nivel = $("#nivel").val();
        let nombre = $("#nombre").val();
        let usuario = $("#usuario").val();
        let contrasena = $("#contrasena").val();
        let extension = $("#extension").val();
        let canal = $("#canal").val();
        let mix_monitor = $("input[name='mix_monitor']:checked").val();
        let calificar_llamada = $("input[name='calificar_llamada']:checked").val();
        let envio_sms = $("input[name='envio_sms']:checked").val();
        let editar_datos = $("input[name='editar_datos']:checked").val();
        let Cat_Estado_Agente_id = $("#Cat_Estado_Agente_id").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/Agentes';

        $.post(url, {
                grupo: grupo,
                tipo_licencia: tipo_licencia,
                nivel: nivel,
                nombre: nombre,
                usuario: usuario,
                contrasena: contrasena,
                extension: extension,
                Canales_id: canal,
                canal: canal,
                mix_monitor: mix_monitor,
                calificar_llamada: calificar_llamada,
                envio_sms: envio_sms,
                editar_datos: editar_datos,
                Cat_Estado_Agente_id: Cat_Estado_Agente_id,
                _token: _token
            }, function(data, textStatus, xhr) {

                $('.viewResult').html(data);
                $('.viewResult #tableAgentes').DataTable({
                    "lengthChange": true,
                    "order": [
                        [2, "asc"]
                    ]
                });
            }).done(function() {
                $('.modal-backdrop ').css('display', 'none');
                $('#modal').modal('hide');
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )
            })
            .fail(function(data) {
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