$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo ivr
     */
    $(document).on("click", ".generardesglose", function(e) {
        //alert ('generar');
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
        let numero_origen = $("#numero_origen").val();
        let numero_destino = $("#numero_destino").val();
        let _token = $("input[name=_token]").val();

        let url = currentURL + "/Desglose_llamadas/";
        dateinicio=fechainicio + " " + hora_inicio + ":" + minuto_inicio + ":00" ;
        datefin=fechafin + " " + hora_fin + ":" + minuto_fin + ":59" ;
        /**
         * Con esto mandamos las variables
         */
        $.post(url, {
            dateinicio: dateinicio,
            datefin: datefin,
            
            numero_origen: numero_origen,
            numero_destino: numero_destino,
            //Empresas_id: Empresas_id,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.viewreportedesglose').html(data);

            
        });
        
    });
    /**
     * Evento para mostrar el formulario de crear un nuevo ivr
     */
    $(document).on("click", ".nuevo-reporte", function(e) {
        //alert ('generar');
        /**
         * Esto contrae el body
         */
        $('.body-filtro').slideDown();
        $('.nuevo-reporte').slideUp();
        $('#body-reporte').slideUp();
        e.preventDefault();
    });

});