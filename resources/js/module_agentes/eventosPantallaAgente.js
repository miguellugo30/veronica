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
});