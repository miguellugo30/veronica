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
     * Evento para mostrar el boton de añadir y borrar cuando el tipo de speech sea dinamico en el apartado de editar
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
            var nColumnas = $(".tableEditSpeech tbody tr").length;

            for (let i = nColumnas; i > 1; i--) {
                $(".tableEditSpeech tbody tr#tr_" + i).remove();
            }

        } else if (tipo == '') {
            $('.agrega').attr("hidden", "hidden");
            $('.remove').attr("hidden", "hidden");
            /**
             * Eliminamos las opciones adicionales dentro de la tabla de opciones
             */
            var nColumnas = $(".tableEditSpeech tbody tr").length;

            for (let i = nColumnas; i > 1; i--) {
                $(".tableEditSpeech tbody tr#tr_" + i).remove();
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
        //let IDInput = ['nombreSpeech', 'descripcion', 'prioridad'];
        let IDInput = ['nombreSpeech', 'descripcionSpeech'];
        fila = $(".tableNewSpeech tbody tr:eq()").clone().appendTo(".tableNewSpeech"); //Clonamos la fila
        for (let i = 0; i < IDInput.length; i++) {
            fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
            fila.find('#' + IDInput[i]).attr('id', IDInput[i] + "_" + newID); //Cambiamos el id de los campos de la fila a clonar
        }
        fila.find('.btn-info').css('display', 'none');
        fila.find('#id_campo').attr('value', '');
        fila.attr("id", 'tr_' + newID);

    });

    /**
     * Evento para agregar una nueva fila para campos nuevos en el formulario editar speech
     */
    $(document).on('click', '#add_os', function() {
        var clickID = $(".tableEditSpeech tbody tr.clonar:last").attr('id').replace('tr_', '');
        $('#form_opc .form-control-sm').val('');
        // Genero el nuevo numero id
        var newID = parseInt(clickID) + 1;
        let IDInput = ['nombreSpeech', 'descripcion'];
        fila = $(".tableEditSpeech tbody tr:eq()").clone().appendTo(".tableEditSpeech"); //Clonamos la fila
        for (let i = 0; i < IDInput.length; i++) {
            fila.find('.' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
            fila.find('.' + IDInput[i]).attr('id', IDInput[i] + "_" + newID); //Cambiamos el id de los campos de la fila a clonar
        }
        fila.find('.btn-info').css('display', 'none');
        fila.find('#id_campo').attr('value', '');
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