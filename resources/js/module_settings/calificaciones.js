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
        

    /**
     * Evento para mostrar el formulario de crear un nueva calificacion
     */
    $(document).on("click", ".newCalificaciones", function(e) {
        e.preventDefault();

        $('#tituloModal').html('Nueva Calificacion');
        let url = currentURL + '/calificaciones/create';

        $('#action').removeClass('updateCalificaciones');
        $('#action').addClass('saveCalificaciones');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);
            }
        });
    });

   
    
});
