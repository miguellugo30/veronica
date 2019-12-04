$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".generarReporteACD", function(e) {

        e.preventDefault();

        let url = currentURL + '/Metricas_ACD';
        let fecha_inicio = $("#fecha-inicio").val();
        let hora_inicio = $("#hora_inicio").val();
        let min_inicio = $("#min_inicio").val();

        let fecha_fin = $("#fecha-fin").val();
        let hora_fin = $("#hora_fin").val();
        let min_fin = $("#min_fin").val();

        dateInicio = fecha_inicio + " " + hora_inicio + ":" + min_inicio + ":00";
        dateFin = fecha_fin + " " + hora_fin + ":" + min_fin + ":00";

        let _token = $("input[name=_token]").val();

        $.ajax({
                url: url,
                type: "post",
                data: {
                    dateInicio: dateInicio,
                    dateFin: dateFin,
                    _token: _token
                }
            })
            .done(function(data) {
                $('.viewReporteACD').html(data);
            });
    });
});