$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".sub-menu", function(e) {

        e.preventDefault();
        let id = $(this).data("id");

        if (id == 36) {
            url = currentURL + '/Inbound';
            table = ' #tableInbound';
        } else if (id == 37) {
            url = currentURL + '/Outbound';
            table = ' #tableOutbound';
        } else if (id == 38) {
            url = currentURL + '/Manuales';
            table = ' #tableManuales';
        }
        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewResult").html(data);
            $('.viewResult' + table).DataTable({
                "lengthChange": true
            });
        });
    });
});