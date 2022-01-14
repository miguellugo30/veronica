$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".sub-menu-recording", function(e) {

        e.preventDefault();
        let id = $(this).data("id");

        if (id == 'sub-36') {
            url = currentURL + 'recording/Inbound';
            table = ' #tableInbound';
        } else if (id == 'sub-37') {
            url = currentURL + 'recording/Outbound';
            table = ' #tableOutbound';
        } else if (id == 'sub-38') {
            url = currentURL + 'recording/Manuales';
            table = ' #tableManuales';
        } else if (id == 'cat-27') {
            url = currentURL + 'recording/Almacenamiento';
            table = ' #tableAlmacenamiento';
        }
        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewResult").html(data);
            $('.viewResult' + table).DataTable({
                "lengthChange": true
            });
        });
    });
});
