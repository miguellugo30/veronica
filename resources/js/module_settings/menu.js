$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".sub-menu li", function(e) {

        e.preventDefault();
        let id = $(this).data("id");

        if (id == 21) {
            url = currentURL + '/formularios';
            table = ' #tableFormulario';
        }

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewResult").html(data);
            $('.viewResult' + table).DataTable({
                "lengthChange": true
            });
        });
    });
});