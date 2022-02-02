$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".sub-menu-outbound", function(e) {

        e.preventDefault();
        let id = $(this).data("id");

        if (id == 'sub-34') {
            url = currentURL + 'outbound/campanas';
            table = ' #grabacionesVoicemail';
        }

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewResult").html(data);
            $('.viewResult' + table).DataTable({
                "lengthChange": true
            });
        });
    });
});
