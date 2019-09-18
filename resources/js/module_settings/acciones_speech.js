$(function() {

    /**
     * Evento para mostrar el boton de añadir y borrar cuando el tipo de speech sea dinamico
     */
    $(document).on('change', '.tipo', function(event) {
        event.preventDefault();

        let tipo = $('.tipo').val();
        if (tipo == 'dinamico') {
            $('.agrega').removeAttr("hidden");
            $('.remove').removeAttr("hidden");

        } else if (tipo == 'estatico') {
            $('.agrega').attr("hidden", "hidden");
            $('.remove').attr("hidden", "hidden");
            /**
             * Eliminamos las opciones adicionales dentro de la tabla de opciones
             */
            var nColumnas = $(".tableNewSpeech tbody tr").length;

            for (let i = nColumnas; i > 1; i--) {
                $(".tableNewSpeech tbody tr#tr_" + i).remove();
            }

        } else if (tipo == '') {
            $('.agrega').attr("hidden", "hidden");
            $('.remove').attr("hidden", "hidden");
            /**
             * Eliminamos las opciones adicionales dentro de la tabla de opciones
             */
            var nColumnas = $(".tableNewSpeech tbody tr").length;

            for (let i = nColumnas; i > 1; i--) {
                $(".tableNewSpeech tbody tr#tr_" + i).remove();
            }
        }

    });

    /**
     * Evento para agregar una nueva fila para campos nuevos en el formulario
     */
    $(document).on('click', '#add_s', function() {
        var clickID = $(".tableNewSpeech tbody tr.clonar:last").attr('id').replace('tr_', '');
        $('#form_opc .form-control-sm').val('');
        // Genero el nuevo numero id
        var newID = parseInt(clickID) + 1;
        //let IDInput = ['id_campo', 'nombre_speech', 'tipo_campo', 'tamano', 'obligatorio', 'obligatorio_hidden', 'editable', 'editable_hidden', 'opciones', 'view'];
        let IDInput = ['nombre', 'descripcion', 'tipo'];
        fila = $(".tableNewSpeech tbody tr:eq()").clone().appendTo(".tableNewSpeech"); //Clonamos la fila
        for (let i = 0; i < IDInput.length; i++) {
            fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
        }
        fila.find('.btn-info').css('display', 'none');
        fila.find('#id_campo').attr('value', '')
        fila.attr("id", 'tr_' + newID);

    });

    /**
     * Evento para eliminar una fila de la tabla de nuevo Speech
     */
    $(document).on('click', '.tr_clone_remove', function() {
        var tr = $(this).closest('tr');
        tr.remove();
    });

});
