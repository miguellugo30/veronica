$(function() {

    let currentURL = window.location.href.split('?');

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
                console.log(result);
                // $(".viewFormularioCalificacion").html(result);
            }
        });

    });

    $(document).on('click', '.realizar-transferir-llamada', function(event) {

        let idAgente = $("#id_agente").val();
        let canal = $("#canal").val();
        let destino_transferencia = $("#destino_transferencia").val();
        let opciones_transferencia = $("#opciones_transferencia").val();
        let id_empresa = $("#id_empresa").val();
        let _token = $("input[name=_token]").val();

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

    });

});
