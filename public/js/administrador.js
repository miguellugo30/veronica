$(document).ready(function() {

    /**
     * Evento para el menu categorias o mostrar las sub categorias
     */
    $(".menu-categorias li a").click(function(e) {
        e.preventDefault();
        $(".menu-categorias li").removeClass("active");
        $(this).addClass("active");

        url = $(this).attr('href');

        $.get(url, function(data, textStatus, jqXHR) {
            $(".sub-categorias").html(data);
        });

    });

});