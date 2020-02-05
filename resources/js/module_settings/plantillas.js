$(function() {

    var currentURL = window.location.href;

    /**
     * Evento para mostrar el formulario de crear una nueva plantilla
     */
    $(document).on("click", ".newPlantillas", function(e) {
        event.preventDefault();
        $('#tituloModal').html('Alta de Plantilla');
        $('#action').removeClass('deletePlantilla');
        $('#action').addClass('savePlantilla');

        let url = currentURL + "/Plantillas/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
});