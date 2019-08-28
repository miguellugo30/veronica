$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".sub-menu", function(e) {

        e.preventDefault();
        let id = $(this).data("id");

        if (id == 21) {
            url = currentURL + '/formularios';
            table = ' #tableFormulario';
        } else if (id == 23) {
            url = currentURL + '/calificaciones';
            table = ' #tableCalificaciones';
        } else if (id == 17) {
            url = currentURL + '/Audios';
            table = ' #tableAudios';
        } else if (id == 19) {
            url = currentURL + '/Agentes';
            table = ' #tableAgentes';
        }

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewResult").html(data);
            $('.viewResult' + table).DataTable({
                "lengthChange": true
            });
        });
    });
});