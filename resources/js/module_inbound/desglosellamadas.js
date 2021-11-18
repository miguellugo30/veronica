$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo ivr
     */
    $(document).on("click", ".generardesglose", function(e) {
        /**
         * Esto contrae el body
         */
        $('.body-filtro').slideUp();
        $('.nuevo-reporte').slideDown();
        $('#body-reporte').slideDown();
        e.preventDefault();
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
        let url = currentURL + "inbound/Desglose_llamadas";

        let dateinicio = fechainicio + " " + hora_inicio + ":" + minuto_inicio + ":00";
        let datefin = fechafin + " " + hora_fin + ":" + minuto_fin + ":59";
        /**
         * Con esto mandamos las variables
         */
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                dateinicio: dateinicio,
                datefin: datefin,
                _token: _token
            },
            success: function(result) {
                $('.viewreportedesglose').html(result);
            }
        });
    });
    /**
     * Evento para mostrar el formulario de crear un nuevo ivr
     */
    $(document).on("click", ".nuevo-reporte", function(e) {
        /**
         * Esto contrae el body
         */
        $('.viewreportedesglose').html('');
        $('.body-filtro').slideDown();
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
        let url = currentURL + "inbound/Desglose_llamadas/descargar/" + dateinicio + "/" + datefin;
        $('#iFrameDescarga').attr('src', url)

    });
});
