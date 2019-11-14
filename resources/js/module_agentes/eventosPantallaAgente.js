$(function() {

    $(document).on("click", ".colgar-llamada", function(e) {

        let canal = $("#canal").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            method: "POST",
            url: "/agentes/colgar", // Podrías separar las funciones de PHP en un fichero a parte
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
            url: "/agentes/historial-llamadas", // Podrías separar las funciones de PHP en un fichero a parte
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
            url: "/agentes/llamadas-abandonadas", // Podrías separar las funciones de PHP en un fichero a parte
            data: {
                id_agente: id_agente,
                _token: _token
            }
        }).done(function(msg) {
            $('.result-llamadas-abandonadas').html(msg);
        });
    });

});