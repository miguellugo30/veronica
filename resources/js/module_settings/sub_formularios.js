$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar un modal para capturas los parámetros para
     * los campos de Opciones y Folios
     */
    $(document).on("change", ".subFormulario", function(e) {
        let tipo = $(this).val();

        $('#action_opc').addClass('saveOpciones');
        $('#action_opc').removeClass('updateOpciones');
        action = $(this).data('action');
        idTR = $(this).attr('name').replace('tipo_campo_', '');

        let url = currentURL + 'settings/subformularios/create';

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                if (tipo == 'asignador_folios') {
                    $('#modal_opciones_campo').modal({ backdrop: 'static', keyboard: false });
                    $("#modal_opciones_campo #modal-body").html(result);

                    $('#tituloModalOpciones').html('Parametros para los folios');
                    $("#modal_opciones_campo #modal-body #opcionesForm").slideUp();
                    $("#modal_opciones_campo #modal-body #folioForm").slideDown();

                    $("#nombre_opcion").prop("disabled", true);
                    $("#form_id").prop("disabled", true);

                    $("#prefijo").prop("disabled", false);
                    $("#folio").prop("disabled", false);

                } else if (tipo == 'select') {

                    $('#modal_opciones_campo').modal({ backdrop: 'static', keyboard: false });
                    $("#modal_opciones_campo #modal-body").html(result);

                    $('#tituloModalOpciones').html('Agregar opciones');
                    $("#folioForm").slideUp();
                    $("#opcionesForm").slideDown();

                    $("#nombre_opcion").prop("disabled", false);
                    $("#form_id").prop("disabled", false);

                    $("#prefijo").prop("disabled", true);
                    $("#folio").prop("disabled", true);

                }
            }
        });
    });
    /**
     * Evento para clonar una fila de la tabla de opciones
     */
    $(document).on('click', '.add_opc', function() {
        var clickID = $(".tableOpc tbody tr.clonar:last").attr('id').replace('tr_opciones_', '');
        // Genero el nuevo numero id
        newID = parseInt(clickID) + 1;

        fila = $(".tableOpc tbody tr:eq()").clone().appendTo(".tableOpc"); //Clonamos la fila
        fila.find('#id_opcion').attr({ name: 'id_opcion_' + newID, value: '' }); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre
        fila.find('#id_campos').attr('name', 'id_campos_' + newID); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre
        fila.find('#numero_opcion').attr("name", 'numero_opcion_' + newID); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre
        fila.find('#numero_opcion').html(newID); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre
        fila.find('#nombre_opcion').attr("name", 'nombre_opcion_' + newID); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre
        fila.find('#nombre_opcion').attr("value", ""); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre
        fila.find('#form_id').attr("name", 'form_id_' + newID); //Buscamos el campo con id tipo_campo y le agregamos un nuevo nombre
        fila.attr("id", 'tr_opciones_' + newID);
        fila.find('.btn-danger').css('display', 'block');

    });
    /**
     * Evento para eliminar una fila de la tabla de nuevo formulario
     */
    $(document).on('click', '.tr_clone_remove_opcion', function() {
        var tr = $(this).closest('tr');
        let id = $(this).data('opcion-id');

        if (id != '') {
            tr.remove();

            let _method = "DELETE";
            let _token = $("input[name=_token]").val();
            let url = currentURL + 'settings/subformularios/' + id;

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: _token,
                    _method: _method
                },
                success: function(result) {
                    console.log(result);
                }
            });
        } else {
            tr.remove();
        }
    });
    /**
     * Evento para guardar las opciones de los campos, Folio y Opciones
     */
    $(document).on('click', '.saveOpciones', function(event) {
        event.preventDefault();

        let dataOpciones = JSON.stringify($("#form_opc").serializeArray());

        $('input[name="opciones_' + idTR + '"]').val(dataOpciones);
        $('button[name="view_' + idTR + '"]').removeClass('edit_opciones');

        $("#modal_opciones_campo").modal('hide');
        $("button[name='view_" + idTR + "']").slideDown();
        /**
         * Limpiamos todos los input del formulario de Opciones
         */
        $('#form_opc .form-control-sm').val('');
        /**
         * Eliminamos las opciones adicionales dentro de la tabla de opciones
         */
        var nColumnas = $(".tableOpc tbody tr").length;

        for (let i = nColumnas; i > 1; i--) {
            $(".tableOpc tbody tr#tr_opciones_" + i).remove();
        }

    });
    /**
     * Evento para ver las opciones de los campos, Folio y Opciones
     */
    $(document).on('click', '.view', function(event) {
        event.preventDefault();

        idTR = $(this).attr('name').replace('view_', '');
        $('#action_opc').addClass('saveOpciones');
        $('#action_opc').removeClass('updateOpciones');

        let opciones = JSON.parse($("input[name=opciones_" + idTR + ']').val());
        let tipo_campo = $('#tr_' + idTR + ' .subFormulario').val();

        if (tipo_campo == 'asignador_folios') {

            $('#tituloModalOpciones').html('Parametros para los folios');
            $("#modal_opciones_campo").modal('show', { backdrop: 'static', keyboard: false });
            $("#opcionesForm").slideUp();
            $("#folioForm").slideDown();

            $("#nombre_opcion").prop("disabled", true);
            $("#form_opcion").prop("disabled", true);

            $("#prefijo").prop("disabled", false);
            $("#folio").prop("disabled", false);

            for (let i = 0; i < opciones.length; i++) {
                $("#" + opciones[i]['name']).val(opciones[i]['value']);
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

            let j = 0;
            for (let i = 0; i < (opciones.length / 2); i++) {

                newID = i + 1;

                if (i < 1) {
                    $('#tr_opciones_1 #nombre_opcion').val(opciones[j]['value']);
                    $('#tr_opciones_1 #form_id').val(opciones[j + 1]['value']);
                } else {
                    fila = $(".tableOpc tbody tr:eq()").clone().appendTo(".tableOpc"); //Clonamos la fila
                    fila.find('#nombre_opcion').attr('name', 'nombre_opcion_' + newID);
                    fila.find('#nombre_opcion').val(opciones[j]['value']); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre
                    fila.find('#form_id').attr('name', 'form_id_' + newID);
                    fila.find('#form_id').val(opciones[j + 1]['value']); //Buscamos el campo con id tipo_campo y le agregamos un nuevo nombre
                    fila.attr("id", 'tr_opciones_' + newID);
                }

                j = j + 2;
            }
        }
    });
    /**
     * Evento para ver las opciones de los campos, Folio y Opciones
     */
    $(document).on('click', '.edit_opciones', function(event) {
        event.preventDefault();

        idTR = $(this).attr('id').replace('view_', '');
        id = $(this).data('id-campo');
        let tipo_campo = $('#tr_' + idTR + ' #tipo_campo').val();

        $('#action_opc').addClass('updateOpciones');
        $('#action_opc').removeClass('saveOpciones');

        var url = currentURL + 'settings/subformularios/' + id + '/edit';

        $.ajax({
            url: url,
            type: 'GET',
            success: function success(result) {
                $('#modal_opciones_campo').modal({ backdrop: 'static', keyboard: false });
                $("#modal_opciones_campo #modal-body").html(result);
                if (tipo_campo == 'asignador_folios') {

                    $('#tituloModalOpciones').html('Parametros para los folios');
                    $("#modal_opciones_campo").modal('show', { backdrop: 'static', keyboard: false });
                    $("#opcionesForm").slideUp();
                    $("#folioForm").slideDown();

                    $("#nombre_opcion").prop("disabled", true);
                    $("#form_opcion").prop("disabled", true);

                    $("#prefijo").prop("disabled", false);
                    $("#folio").prop("disabled", false);

                } else if (tipo_campo == 'select') {

                    $('#tituloModalOpciones').html('Agregar opciones');
                    $("#modal_opciones_campo").modal('show', { backdrop: 'static', keyboard: false });
                    $("#folioForm").slideUp();
                    $("#opcionesForm").slideDown();

                    $("#nombre_opcion").prop("disabled", false);
                    $("#form_opcion").prop("disabled", false);

                    $("#prefijo").prop("disabled", true);
                    $("#folio").prop("disabled", true);

                }
            }
        });
    });
    /**
     * Evento para actualizar las opciones de los campos, Folio y Opciones
     */
    $(document).on('click', '.updateOpciones', function(event) {
        event.preventDefault();

        $("#modal_opciones_campo").modal('hide');

        let val = 0;
        let dataOpciones = JSON.stringify($("#form_opc").serializeArray());
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + 'settings/subformularios/' + val;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: _token,
                _method: _method,
                dataOpciones: dataOpciones
            },
            success: function success(result) {
                $("#modal_opciones_campo #modal-body").html(result);
            }
        });

    });
});
