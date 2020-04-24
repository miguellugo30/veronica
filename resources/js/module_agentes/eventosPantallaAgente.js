$(function() {

    let currentURL = window.location.href.split('?');
    /**
     * Evento para colgar la llamada
     */
    $(document).on("click", ".colgar-llamada", function(e) {

        let canal = $("#canal").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            method: "POST",
            url: currentURL[0] + "/colgar", // Podrías separar las funciones de PHP en un fichero a parte
            data: {
                canal: canal,
                _token: _token
            }
        }).done(function(msg) {});
    });
    /**
     * Evento para mostrar el historial de llamadas
     */
    $(document).on("click", "#view-historial-llamadas", function(e) {

        let id_agente = $("#id_agente").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            method: "POST",
            url: currentURL[0] + "/historial-llamadas", // Podrías separar las funciones de PHP en un fichero a parte
            data: {
                id_agente: id_agente,
                _token: _token
            }
        }).done(function(msg) {
            $('.result-historial-llamada').html(msg);
        });
    });
    /**
     * Evento para mostrar el historial de lladamas perdidas
     */
    $(document).on("click", "#view-llamadas-perdidas", function(e) {

        let id_agente = $("#id_agente").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            method: "POST",
            url: currentURL[0] + "/llamadas-abandonadas", // Podrías separar las funciones de PHP en un fichero a parte
            data: {
                id_agente: id_agente,
                _token: _token
            }
        }).done(function(msg) {
            $('.result-llamadas-abandonadas').html(msg);
        });
    });
    /**
     * Evento para el logueo de extension
     */
    $(document).on('click', '.logeo-extension', function(event) {

        let idAgente = $("#id_agente").val();
        let canal = $("#canal").val();
        let extension = $("#extension").val();
        let id_empresa = $("#id_empresa").val();
        let _token = $("input[name=_token]").val();

        let url = currentURL[0].replace('agentes/') + '/logeo-extension';

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                idAgente: idAgente,
                canal: canal,
                extension: extension,
                id_empresa: id_empresa,
                _token: _token
            },
            success: function(result) {

                var obj = $.parseJSON(result);

                if (obj['error'] == 1) {
                    $(".estado-agente").html("<i class='fa fa-circle text-success'></i> Disponible");
                } else {
                    Swal.fire(
                        'Error!',
                        'No se ha podido generar el logueo de extension.',
                        'error'
                    )
                }
            }

        });
    });
    /**
     * Evento para mostrar el modal para la trasferencia de llamada
     */
    $(document).on("click", ".transferir-llamada", function(e) {
        $("#modal-transferencia").modal({ backdrop: 'static', keyboard: false });
    });
    /**
     * Evento para mostrar las opciones del destino selecionado
     */
    $(document).on('change', '#destino_transferencia', function(event) {

        let opccion = $(this).val();
        let id_empresa = $("#id_empresa").val();
        let id = 0 + '&' + opccion + '&1&' + id_empresa;
        let url = currentURL[0].replace('agentes/') + '/opciones_transferencia/' + id;

        if (opccion == 'Cat_Extensiones') {
            $('.opcion-transferir-extension').slideDown();
        } else {
            $('.opcion-transferir-extension').slideUp();
        }

        if (opccion == 'Numero_Saliente') {

            $('.input-telefono-transferir').slideDown();
            $('#opciones_transferencia').slideUp();

        } else {

            $('.input-telefono-transferir').slideUp();
            $('#opciones_transferencia').slideDown();

            $.ajax({
                    url: url,
                    type: "GET",
                })
                .done(function(data) {
                    $('#opciones_transferencia').html(data);
                });
        }
    });

    $(document).on('click', '#realizar-transferir-llamada', function(event) {

        let idAgente = $("#id_agente").val();
        let canal = $("#canal").val();
        let destino_transferencia = $("#destino_transferencia").val();
        let opciones_transferencia = $("#opciones").val();
        let id_empresa = $("#id_empresa").val();
        let _token = $("input[name=_token]").val();

        console.log(idAgente + " " + canal + " " + destino_transferencia + " " + opciones_transferencia + " " + id_empresa + " " + _token);

        if (canal == null) {

            Swal.fire(
                'Error!',
                'No se puede transferir, sin tener una llamada activa.',
                'error'
            )

        } else {

            let url = currentURL[0].replace('agentes/') + '/transferir-llamada';

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    idAgente: idAgente,
                    canal: canal,
                    destino_transferencia: destino_transferencia,
                    opciones_transferencia: opciones_transferencia,
                    extension: extension,
                    id_empresa: id_empresa,
                    _token: _token
                },
                success: function(result) {
                    console.log(result);
                }
            });
        }

    });
});