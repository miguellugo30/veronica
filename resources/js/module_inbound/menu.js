$(function() {

    let timerListAgente = '';
    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".sub-menu", function(e) {

        stop(timerListAgente);
        e.preventDefault();
        let id = $(this).data("id");
        if (id == 16) {
            url = currentURL + '/campanas';
            table = ' #tableFormulario';
        } else if (id == 32) {
            url = currentURL + '/Condiciones_Tiempo';
            table = ' #tableCondicionesTiempo';
        } else if (id == 31) {
            url = currentURL + '/Desvios';
            table = ' #tableDesvios';
        } else if (id == 34) {
            url = currentURL + '/Buzon_Voz';
            table = ' #tableBuzonVoz';
        } else if (id == 30) {
            url = currentURL + '/Did_Enrutamiento';
            table = ' #tableDidEnrutamiento';
        } else if (id == 6) {
            url = currentURL + '/Ivr';
            table = ' #tableivr';
        } else if (id == 39) {
            url = currentURL + '/Metricas_ACD';
            table = ' #tableACD';
        } else if (id == 40) {
            url = currentURL + '/Desglose_llamadas';
            table = ' #tableDesgloseLlamadas';
        } else if (id == 26) {

            url = currentURL + '/real_time/';

            $.get(url, function(data, textStatus, jqXHR) {
                $(".viewResult").html(data);
                $('.viewResult listadoAgentes').DataTable({
                    "lengthChange": true
                });
                //start(url);
                url = currentURL + '/real_time/0';
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
