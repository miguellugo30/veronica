$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para deshabilitar reporte con base si se eligio
     * general o una campana en especifico.
     */
    $(document).on("change", "#campana", function(e) {

        if ($(this).val() == 0) {
            $("#tendencia").prop('disabled', true);
            $("#calificaciones").prop('disabled', true);
        } else {
            $("#tendencia").prop('disabled', false);
            $("#calificaciones").prop('disabled', false);
        }

    });
    /**
     * Evento para mostrar el input para el tiempo de evaluación
     * en tendencia
     */
    $(document).on("change", "input[name=nivel-servicio]", function(e) {

        if (this.checked) {
            $("#div-tiempo-evaluacion").slideDown();
        } else {
            $("#div-tiempo-evaluacion").slideUp();
        }
    });
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".generarReporteACD", function(e) {

        let url = currentURL + 'inbound/Metricas_ACD';
        let fecha_inicio = $("#fecha-inicio").val();
        let hora_inicio = $("#hora_inicio").val();
        let min_inicio = $("#min_inicio").val();

        let fecha_fin = $("#fecha-fin").val();
        let hora_fin = $("#hora_fin").val();
        let min_fin = $("#min_fin").val();

        dateInicio = fecha_inicio + " " + hora_inicio + ":" + min_inicio + ":00";
        dateFin = fecha_fin + " " + hora_fin + ":" + min_fin + ":00";

        let campana = $("#campana").val();
        let tiempoEvaluacion = $("#tiempo-evalucaion").val();
        let _token = $("input[name=_token]").val();
        let data = {};

        $('input[type=checkbox]').each(function() {

            if (this.checked) {
                data[this.id] = 1;
            } else {
                data[this.id] = 0;
            }

        });

        if (data['nivel-servicio'] == 1 && tiempoEvaluacion == '') {
            Swal.fire(
                'Error!',
                'Tienes que ingresar un tiempo de evaluación.',
                'error'
            )
        } else {
            /**
             * Esto contrae el body
             */
            $('.filtro-reporte').slideUp();
            $('.nuevo-reporte').slideDown();
            $('#viewReporte').slideDown();
            e.preventDefault();

            $.ajax({
                    url: url,
                    type: "post",
                    data: {
                        dateInicio: dateInicio,
                        dateFin: dateFin,
                        campana: campana,
                        data: data,
                        tiempoEvaluacion: tiempoEvaluacion,
                        _token: _token
                    }
                })
                .done(function(data) {
                    $('.viewReporte').html(data);
                });
        }

    });
    /**
     * Evento para mostrar el formulario de crear un nuevo reporte
     */
    $(document).on("click", ".nuevo-reporte", function(e) {
        /**
         * Esto contrae el body
         */
        $('.viewReporte').html('');
        $('.filtro-reporte').slideDown();
        $('.nuevo-reporte').slideUp();
        $('#viewReporte').slideUp();
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

        dateinicio = fechainicio + " " + hora_inicio + ":" + minuto_inicio + ":00";
        datefin = fechafin + " " + hora_fin + ":" + minuto_fin + ":59";
        let url = currentURL + "inbound/Metricas_ACD/descargar/" + dateinicio + "/" + datefin;
        $('#iFrameDescarga').attr('src', url)

    });
});