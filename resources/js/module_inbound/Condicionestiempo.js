$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para seleccionar grupo
     */
    $(document).on('click', '#tablecondiciontiempo tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".deletecondiciontiempo").slideDown();
        $(".editcondiciontiempo").slideDown();
        $("#idSeleccionado").val(id);

        $("#tablecondiciontiempo tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });;
    /**
    * Evento para mostrar el formulario de crear un nuevo Agente
    */
    $(document).on("click", ".newcondiciontiempo", function(e) {
        event.preventDefault();
        $('#tituloModal').html('Alta Grupo Concicion De Tiempo');
        $('#action').removeClass('deletecondiciontiempo');
        $('#action').addClass('savecondiciontiempo');

        let url = currentURL + "/Condiciones_Tiempo/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });


});