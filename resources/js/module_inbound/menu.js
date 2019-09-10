$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".sub-menu", function(e) {

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
        }
        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewResult").html(data);
            $('.viewResult' + table).DataTable({
                "lengthChange": true
            });
        });
    });
});