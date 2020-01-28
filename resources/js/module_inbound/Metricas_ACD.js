$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".generarReporteACD", function(e) {
        /**
         * Esto contrae el body
         */
        $('.filtro-reporte').slideUp();
        $('.nuevo-reporte').slideDown();
        $('#body-reporte').slideDown();
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
    /**
     * Evento para mostrar el formulario de crear un nuevo reporte
     */
    $(document).on("click", ".nuevo-reporte", function(e) {
        /**
         * Esto contrae el body
         */
        $('.viewReporteACD').html('');
        $('.filtro-reporte').slideDown();
        $('.nuevo-reporte').slideUp();
        $('#body-reporte').slideUp();
        e.preventDefault();
    });
    /**
     * Evento para poder descargar el reporte
     */
    $(document).on("click", ".descargar-reporte", function(e) {
        /**
         * Con esto traemos las variables
         */
        let fechainicio = $("#fechainicio").val();
        let fechafin = $("#fechafin").val();
        let hora_inicio = $("#hora_inicio").val();
        let minuto_inicio = $("#min_inicio").val();
        let hora_fin = $("#hora_fin").val();
        let minuto_fin = $("#min_fin").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";

        dateinicio = fechainicio + " " + hora_inicio + ":" + minuto_inicio + ":00";
        datefin = fechafin + " " + hora_fin + ":" + minuto_fin + ":59";
        let url = currentURL + "/Metricas_ACD/descargar/" + dateinicio + "/" + datefin;
        $('#iFrameDescarga').attr('src', url)

    });
});