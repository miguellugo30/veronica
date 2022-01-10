$(function() {

    let timerListAgente = '';
    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".sub-menu-inbound", function(e) {

        e.preventDefault();
        stop(timerListAgente);

        let id = $(this).attr('id');

        if (id == 'sub-16') {
            url = currentURL + 'inbound/campanas';
            table = '#tableFormulario';
        } else if (id == 'sub-32') {
            url = currentURL + 'inbound/Condiciones_Tiempo';
            table = '#tableCondicionesTiempo';
        } else if (id == 'sub-31') {
            url = currentURL + 'inbound/Desvios';
            table = '#tableDesvios';
        } else if (id == 'sub-34') {
            url = currentURL + 'inbound/Buzon_Voz';
            table = '#tableBuzonVoz';
        } else if (id == 'sub-30') {
            url = currentURL + 'inbound/Did_Enrutamiento';
            table = '#tableDidEnrutamiento';
        } else if (id == 'sub-6') {
            url = currentURL + 'inbound/Ivr';
            table = '#tableivr';
        } else if (id == 'sub-39') {
            url = currentURL + 'inbound/Metricas_ACD';
            table = '#tableACD';
        } else if (id == 'sub-40') {
            url = currentURL + 'inbound/Desglose_llamadas';
            table = '#tableDesgloseLlamadas';
        } else if (id == 'sub-42') {
            url = currentURL + 'inbound/ReporteCalificaciones';
            table = '#tableDesgloseLlamadas';
        } else if (id == 'sub-43') {
            url = currentURL + 'inbound/ReporteLlamadasAgentes';
            table = '#tableDesgloseLlamadas';
        } else if (id == 'sub-44') {
            url = currentURL + 'inbound/ReporteProductividadAgentes';
            table = '#tableDesgloseLlamadas';
        } else if (id == 'sub-45') {
            url = currentURL + 'inbound/ReporteTiempoInactivo';
            table = '#tableReporteTiempoInactivo';
        } else if (id == 'sub-26') {

            url = currentURL + 'inbound/real_time/';

            $.get(url, function(data, textStatus, jqXHR) {
                $(".viewResult").html(data);
                $('.viewResult listadoAgentes').DataTable({
                    "lengthChange": true
                });
                //start(url);
                url = currentURL + 'inbound/real_time/0';
                $.get(url, function(data, textStatus, jqXHR) {
                    $(".viewIndex").html(data);
                    $('.viewIndex listadoAgentes').DataTable({
                        "lengthChange": true
                    });
                });

                start(url);
            });
        }

        if (id != 26) {

            stop(timerListAgente);
            $.get(url, function(data, textStatus, jqXHR) {
                $(".viewResult").html(data);
                $('.viewResult' + table).DataTable({
                    "lengthChange": true
                });
            });
        }

    });

    function stop(timer) {
        clearInterval(timer);
    };

    function start(url) { //use a one-off timer
        /**
         * Función para actualizar el listado de agentes
         * para poder obtener el estado de los agentes
         */
        timerListAgente = setInterval(function() {
            $.get(url, function(data, textStatus, jqXHR) {
                $(".viewIndex").html(data);
                $('.viewIndex listadoAgentes').DataTable({
                    "lengthChange": true
                });
            });
        }, 3000);
    }
});
