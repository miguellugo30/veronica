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

        let opcion = $(this).val();
        let url = currentURL[0].replace('agentes/') + '/aplicaciones-ms/' + opcion;

        if (opcion == 'Agentes') {
            $('.opcion-transferir-extension').slideDown();
        } else {
            $('.opcion-transferir-extension').slideUp();
        }

        if (opcion == 'Numero_Saliente') {

            $('.input-telefono-transferir').slideDown();
            $('#opciones_transferencia').slideUp();

        } else {

            $('.input-telefono-transferir').slideUp();
            $('#opciones_transferencia').slideDown();

            $.ajax({
                    url: url,
                    data: {
                        opcion: opcion
                    },
                    type: "GET",
                })
                .done(function(data) {
                    $('#opciones_transferencia').html(data);
                });
        }
    });
    /**
     * Evento para mostrar el modal para la conferencia de llamada
     */
    $(document).on("click", ".conferencia-llamada", function(e) {
        $("#modal-conferencia").modal({ backdrop: 'static', keyboard: false });
    });
    /**
     * Evento para mostrar las opciones del destino selecionado
     */
    $(document).on('change', '#destino_conferencia', function(event) {

        let opcion = $(this).val();
        let url = currentURL[0].replace('agentes/') + '/aplicaciones-ms/' + opcion;

        if (opcion == 'Numero_Saliente') {

            $('.input-telefono-conferencia').slideDown();
            $('#opciones_conferencia').slideUp();

        } else {

            $('.input-telefono-conferencia').slideUp();
            $('#opciones_conferencia').slideDown();

            $.ajax({
                    url: url,
                    data: {
                        opcion: opcion
                    },
                    type: "GET",
                })
                .done(function(data) {
                    $('#opciones_conferencia').html(data);
                });
        }
    });

    /**
     * Mostrar formulario vinculado a la calificacion seleccionada
     */
     $(document).on('change', '#calificacionLlamada', function(event) {

        let id = $(this).val();
        console.log(id);
        let url = currentURL[0].replace('agentes/')  + '/formularios/' + id;
        console.log(url)

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $(".viewFormularioCalificacion").html(result);
            }
        });
    });
});
