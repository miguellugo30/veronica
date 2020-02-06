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
    /**
     * Evento para agregar una nueva fila para campos nuevos en el formulario
     */
    $(document).on('click', '#addCampo', function() {

        let clickID = $("#tablaCampos tbody tr.clonar:last").attr('id').replace('tr_', '');
        // Genero el nuevo numero id
        let newID = parseInt(clickID) + 1;
        let IDInput = ['campo_id', 'num_marcar', 'mostrar', 'editable'];

        fila = $("#tablaCampos tbody tr:eq()").clone().appendTo("#tablaCampos"); //Clonamos la fila
        for (let i = 0; i < IDInput.length; i++) {
            fila.find('.' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
            fila.find('.' + IDInput[i]).attr('id', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
        }
        fila.find('.btn-info').css('display', 'none');
        fila.find('#id_campo').attr('value', '');
        fila.attr("id", 'tr_' + newID);

    });

});