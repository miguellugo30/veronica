$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".menu", function(e) {
        e.preventDefault();

        let currentURL = window.location.href;
        currentURL = currentURL + '/'
        let id = $(this).attr('id');
        $(".viewResult ").html('');

        if (id == 'sub-1') {
            url = currentURL + 'inbound';
            table = ' #tableDistribuidores';
        } else if (id == 'sub-2') {
            url = currentURL + 'outbound';
            table = ' #tableEmpresas';
        } else if (id == 'sub-4') {
            url = currentURL + 'recording';
            table = ' #tableTiposCanal';
        } else if (id == 'sub-17') {
            url = currentURL + 'settings';
            table = ' #licencias_bria';
        }

        $.get(url, function(data, textStatus, jqXHR) {
            $(".view-sub-menu").html(data);
            //$(".menu_principal").html(data);
        });
    });
});
