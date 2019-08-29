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
        }
        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewResult").html(data);
            $('.viewResult' + table).DataTable({
                "lengthChange": true
            });
        });
    });
});