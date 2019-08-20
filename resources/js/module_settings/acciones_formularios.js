$(function() {
    /**
     * Evento para clonar una fila de la tabla de opciones
     */
    $(document).on('click', '.add_opc', function() {
        var clickID = $(".tableOpc tbody tr.clonar:last").attr('id').replace('tr_opciones_', '');
        // Genero el nuevo numero id
        newID = parseInt(clickID) + 1;

        fila = $(".tableOpc tbody tr:eq()").clone().appendTo(".tableOpc"); //Clonamos la fila

        fila.find('#nombre_opcion').attr("name", 'campo_' + newID + '[]'); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre
        fila.find('#form_opcion').attr("name", 'campo_' + newID + '[]'); //Buscamos el campo con id tipo_campo y le agregamos un nuevo nombre

        fila.attr("id", 'tr_opciones_' + newID);

    });

    /**
     * Evento para clonar una fila de la tabla de nuevo canal
     */
    $(document).on('click', '#add', function() {
        var clickID = $(".tableNewForm tbody tr.clonar:last").attr('id').replace('tr_', '');
        $('#form_opc .form-control-sm').val('');
        // Genero el nuevo numero id
        var newID = parseInt(clickID) + 1;

        fila = $(".tableNewForm tbody tr:eq()").clone().appendTo(".tableNewForm"); //Clonamos la fila

        fila.find('.opciones').attr('name', 'campo_' + newID + '[]'); //Buscamos el campo con id editable y le agregamos un nuevo nombre
        fila.find('#opciones_1').attr({ id: 'opciones_' + newID, value: '' }); //Buscamos el campo con id editable y le agregamos un nuevo nombre
        fila.find('#obligatorio_hidden_1').attr({ id: 'obligatorio_hidden_' + newID }); //Buscamos el campo con id editable y le agregamos un nuevo nombre
        fila.find('#editable_hidden_1').attr({ id: 'editable_hidden_' + newID }); //Buscamos el campo con id editable y le agregamos un nuevo nombre
        fila.find('.btn-info').attr('id', 'view_' + newID);
        fila.find('.view').css('display', 'none')
        fila.attr("id", 'tr_' + newID);

    });

    $(document).on('click', '.micheckbox', function() {
        let id = $(this).attr('id');
        let idTR = $(this).attr('name').replace('campo_', '').replace('[]', '');
        var name = id + "_hidden_" + idTR;

        if ($(this).prop('checked')) {
            $("#" + name).prop("disabled", true);
        } else {
            $("#" + name).prop("disabled", false);
        }
    });
    /**
     * Evento para eliminar una fila de la tabla de nuevo formulario
     */
    $(document).on('click', '.tr_clone_remove_opcion', function() {
        var tr = $(this).closest('tr');
        tr.remove();
    });
    /**
     * Evento para eliminar una fila de la tabla de nuevo formulario
     */
    $(document).on('click', '.tr_clone_remove', function() {
        var tr = $(this).closest('tr');
        tr.remove();
    });
    /**
     * Evento para eliminar una fila de la tabla de nuevo formulario
     */
    $(document).on('click', '.tr_edit_remove', function() {
        let id = $(this).data('id-campo');
        let tr = $(this).closest('tr');
        tr.remove();
        let registros = $("#registros_borrados").val();

        if (registros == '') {
            registros = [id];
            $("#registros_borrados").val(registros);
        } else {
            registros = registros + "," + id;
            $("#registros_borrados").val(registros);
        }

    });
    /**
     * Evento para mostrar un modal para capturas los parámetros para
     * los campos de Opciones y Folios
     */
    $(document).on("change", "#tipo_campo", function(e) {
        let tipo = $(this).val();
        $('#action_opc').addClass('saveOpciones');
        idTR = $(this).attr('name').replace('campo_', '').replace('[]', '');

        if (tipo == 'asignador_folios') {

            $('#tituloModalOpciones').html('Parametros para los folios');
            $("#opcionesForm").slideUp();
            $("#folioForm").slideDown();

            $("#nombre_opcion").prop("disabled", true);
            $("#form_id").prop("disabled", true);

            $("#prefijo").prop("disabled", false);
            $("#folio").prop("disabled", false);

        } else if (tipo == 'select') {

            $('#tituloModalOpciones').html('Agregar opciones');
            $("#folioForm").slideUp();
            $("#opcionesForm").slideDown();

            $("#nombre_opcion").prop("disabled", false);
            $("#form_id").prop("disabled", false);

            $("#prefijo").prop("disabled", true);
            $("#folio").prop("disabled", true);

        }
        $("#modal_opciones_campo").modal({ backdrop: 'static', keyboard: false });
    });
    /**
     * Evento para guardar las opciones de los campos, Folio y Opciones
     */
    $(document).on('click', '.saveOpciones', function(event) {
        event.preventDefault();
        let dataOpciones = $("#form_opc").serialize();

        $('input[id="opciones_' + idTR + '"]').val(dataOpciones);

        $("#modal_opciones_campo").modal('hide');
        $("#view_" + idTR).slideDown();
        /**
         * Limpiamos todos los input del formulario
         * de Opciones
         */
        $('#form_opc .form-control-sm').val('');
        /**
         * Eliminamos las opciones adicionales
         * dentro de la tabla de opciones
         */
        for (let i = newID; i > 1; i--) {
            $("#tr_opciones_" + i).remove();
        }

    });
    /**
     * Evento para cerrar el modal de las opciones de los campos, Folio y Opciones
     */
    $(document).on('click', '#close_options', function(event) {
        event.preventDefault();

        $("#modal_opciones_campo").modal('hide');
        /**
         * Limpiamos todos los input del formulario
         * de Opciones
         */
        $('#form_opc .form-control-sm').val('');

        var nColumnas = $(".tableOpc tbody tr").length;
        /**
         * Eliminamos las opciones adicionales
         * dentro de la tabla de opciones
         */
        for (let i = nColumnas; i > 1; i--) {
            $("#tr_opciones_" + i).remove();
        }

    });
    /**
     * Evento para ver las opciones de los campos, Folio y Opciones
     */
    $(document).on('click', '.view', function(event) {
        event.preventDefault();

        idTR = $(this).attr('id').replace('view_', '');
        $('#action_opc').addClass('saveOpciones');

        let opciones = $("#opciones_" + idTR).val();
        let tipo_campo = $('#tr_' + idTR + ' #tipo_campo').val();

        if (tipo_campo == 'asignador_folios') {

            $('#tituloModalOpciones').html('Parametros para los folios');
            $("#modal_opciones_campo").modal('show', { backdrop: 'static', keyboard: false });
            $("#opcionesForm").slideUp();
            $("#folioForm").slideDown();

            $("#nombre_opcion").prop("disabled", true);
            $("#form_opcion").prop("disabled", true);

            $("#prefijo").prop("disabled", false);
            $("#folio").prop("disabled", false);

            opciones = opciones.split('&');
            for (let i = 0; i < opciones.length; i++) {
                let data = opciones[i];
                data = data.split('=');
                $("#" + data[0]).val(data[1]);
            }

        } else if (tipo_campo == 'select') {

            $('#tituloModalOpciones').html('Agregar opciones');
            $("#modal_opciones_campo").modal('show', { backdrop: 'static', keyboard: false });
            $("#folioForm").slideUp();
            $("#opcionesForm").slideDown();

            $("#nombre_opcion").prop("disabled", false);
            $("#form_opcion").prop("disabled", false);

            $("#prefijo").prop("disabled", true);
            $("#folio").prop("disabled", true);

            opciones = opciones.split('&');

            let j = 0;
            for (let i = 0; i < (opciones.length / 2); i++) {

                newID = i + 1;
                dataOpc = opciones[j].split('=');
                dataSel = opciones[j + 1].split('=');

                if (i < 1) {
                    $('#tr_opciones_1 #nombre_opcion').val(decodeURI(dataOpc[1]));
                    $('#tr_opciones_1 #form_opcion').val(decodeURI(dataSel[1]));
                } else {
                    fila = $(".tableOpc tbody tr:eq()").clone().appendTo(".tableOpc"); //Clonamos la fila
                    fila.find('#nombre_opcion').attr('name', 'campo_' + newID + '[]');
                    fila.find('#nombre_opcion').val(decodeURI(dataOpc[1])); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre
                    fila.find('#form_opcion').attr('name', 'campo_' + newID + '[]');
                    fila.find('#form_opcion').val(decodeURI(dataSel[1])); //Buscamos el campo con id tipo_campo y le agregamos un nuevo nombre
                    fila.attr("id", 'tr_opciones_' + newID);
                }

                j = j + 2;
            }
        }
    });
});
