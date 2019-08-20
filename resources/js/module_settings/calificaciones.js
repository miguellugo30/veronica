$(function() {

    var currentURL = window.location.href;
    /**
     * Evento que muestra elemento calificaciones
     */
    $(document).on('click', '#tableCalificaciones tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".editCalificaciones").slideDown();
        $(".deleteCalificaciones").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableCalificaciones tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });

   
    
});
