$(function() {

    currentURL = window.location.href.replace('agentes/');


    url = currentURL.split('?');
    currentURL = url[0];

    $(document).on('click', '#btn_bloque_ocultos', function(event) {
        $('#bloque_oculto').slideToggle();
        link.removeEventListener('click', clickHandler, false);
    });

    $(document).on('change', '.formularioView select', function(event) {

        event.preventDefault();
        idOpc = $(this).val();
        idCampo = $(this).data('id');

        let url = currentURL + '/formularios/' + idOpc;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $("#viewSubForm_" + idCampo).html(result);
            }
        });

    });

    $(document).on('change', '#calificacion', function(event) {

        let id = $(this).val();

        let url = currentURL.replace('agentes/') + '/formularios/' + id;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $(".viewFormularioCalificacion").html(result);
            }
        });
    });

    $(document).on('click', '.logeo-extension', function(event) {

        let idAgente = $("#id_agente").val();
        let canal = $("#canal").val();
        let extension = $("#extension").val();
        let id_empresa = $("#id_empresa").val();
        let _token = $("input[name=_token]").val();

        let url = currentURL.replace('agentes/') + '/logeo-extension';

        console.log(idAgente + " " + canal + " " + extension + " " + id_empresa)

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

});