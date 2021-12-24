$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el boton de añadir y borrar cuando el tipo de speech sea dinamico
     */
    $(document).on('change', '.tipo', function(event) {
        event.preventDefault();

        let tipo = $('.tipo').val();
        if (tipo == 'dinamico') {
            $('.agrega').removeAttr("hidden");
            $('.remove').removeAttr("hidden");
            /**
             * Muestro el formulario según la opción
             */
            $('#tipo_dinamico').slideDown();
            $('#tipo_estatico').slideUp();
            /**
             * Deshabilitamos y habilitamos los input
             */
            $('#speech-inicial').prop("disabled", false);
            $('#opcion_speech').prop("disabled", false);
            $('#speech_id').prop("disabled", false);

            $('#descripcionSpeechEs').prop("disabled", true);


        } else if (tipo == 'estatico') {
            $('.agrega').attr("hidden", "hidden");
            $('.remove').attr("hidden", "hidden");
            /**
             * Muestro el formulario según la opción
             */
            $('#tipo_dinamico').slideUp();
            $('#tipo_estatico').slideDown();
            /**
             * Deshabilitamos y habilitamos los input
             */
            $('#speech-inicial').prop("disabled", true);
            $('#opcion_speech').prop("disabled", true);
            $('#speech_id').prop("disabled", true);

            $('#descripcionSpeechEs').prop("disabled", false);

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

        var clickID = $(".tableNewSpeechDinamico tbody tr.clonar:last").attr('id').replace('tr_', '');

        $('#form_opc .form-control-sm').val('');
        // Genero el nuevo numero id
        var newID = parseInt(clickID) + 1;

        let IDInput = ['opcion_speech', 'speech_id'];
        fila = $(".tableNewSpeechDinamico tbody tr#tr_" + clickID).clone().appendTo(".tableNewSpeechDinamico"); //Clonamos la fila
        for (let i = 0; i < IDInput.length; i++) {
            fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
            fila.find('#' + IDInput[i]).attr('id', IDInput[i] + "_" + newID); //Cambiamos el id de los campos de la fila a clonar
            fila.find('#' + IDInput[i] + '_' + parseInt(clickID)).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
            fila.find('#' + IDInput[i] + '_' + parseInt(clickID)).attr('id', IDInput[i] + "_" + newID); //Cambiamos el id de los campos de la fila a clonar
        }
        fila.find('.btn-danger').css('display', 'block');
        fila.find('#id_campo').attr('value', '');
        fila.attr("id", 'tr_' + newID);

    });
    /**
     * Evento para eliminar una fila de la tabla de nuevo Speech
     */
    $(document).on('click', '.tr_clone_remove', function() {
        let tr = $(this).closest('tr');
        tr.remove();
    });
    /**
     * Evento para eliminar una fila de la tabla de nuevo Speech
     */
    $(document).on('click', '.tr_clone_remove_edit', function() {

        event.preventDefault();
        Swal.fire({
            title: 'Estas seguro?',
            text: "Deseas eliminar el registro seleccionado!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {

                let _method = "DELETE";
                let _token = $("input[name=_token]").val();
                let tr = $(this).closest('tr');
                let id = $(this).data('id');
                let url = currentURL + 'settings/speech/eliminar-opcion/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {

                        tr.remove();
                        Swal.fire(
                            'Eliminado!',
                            'El registro ha sido eliminado.',
                            'success'
                        )
                    }
                });
            }
        });
    });

    $(document).on('click', '.opcionSpeech', function() {

        let id = $(this).data('id');
        let SpeechId = $(this).data('speech-id');

        $('#tituloModal').html('Vista de Speech');
        let url = currentURL + 'settings/speech/' + id;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {

                $("#opcion_seleccionada_"+SpeechId).html(result);
                $("#opcion_seleccionada_"+SpeechId).slideDown();

            }
        });

    });

});
