$(function() {
    /**
     * Evento para el menu categorias y mostrar las sub categorias
     */
    $(".menu-categorias li a").click(function(e) {
        e.preventDefault();
        $(".viewResult").html('');
        $(".menu-categorias li").removeClass("active");
        $(this).addClass("active");

        url = $(this).attr('href');

        $.get(url, function(data, textStatus, jqXHR) {
            $(".sub-categorias").html(data);
        });

    });

    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(".sub-categorias").on("click", ".subCat a", function(e) {

        e.preventDefault();
        id = $(this).data("id");

        if (id == 6) {
            $.get('administrador/usuarios', function(data, textStatus, jqXHR) {
                $(".viewResult").html(data);
                $('.viewResult #tableUsuarios').DataTable({
                    "lengthChange": false
                });
            });
        }
    });


});