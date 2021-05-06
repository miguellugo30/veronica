$(function() {
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".menu-administrador", function(e) {
        e.preventDefault();

        let currentURL = window.location.href;
        let id = $(this).attr('id');
        $(".viewResult ").html('');

       url = currentURL + '/sub-menus/' + id
       $.get(url, function(data, textStatus, jqXHR) {
        $(".view-sub-menu").html(data);
       });

    });
});
