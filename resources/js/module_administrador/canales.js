$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newCanal", function(e) {

        e.preventDefault();
        $(".updateEmpresa").slideUp();
        $("#accionActualizar").slideUp();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();
        let id_Empresa = $("#id_empresa").val();

        let url = currentURL + '/canales/create/' + id_Empresa;

        $.get(url, function(data, textStatus, jqXHR) {
            $("#formDataEmpresa").html(data);
        });
    });


    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveCanal', function(event) {
        event.preventDefault();

        let dataForm = $("#formDataEmpresa").serializeArray();
        let id = $("#Empresa_id").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/canales';

        $.post(url, {
            dataForm: dataForm,
            _token: _token
        }, function(data, textStatus, xhr) {

            let url = currentURL + "/canales/" + id;

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    _token: _token
                },
                success: function(result) {
                    $('#formDataEmpresa').html(result);
                    $('#TableCatExts').DataTable({
                        "lengthChange": true
                    });
                }
            });
        });
    });
    /**
     * Evento para cancelar la creacion/edicion del modulo
     */
    $(document).on("click", ".cancelCanal", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateCanal', function(event) {
        event.preventDefault();
        let dataForm = $("#formDataEmpresa").serializeArray();
        let _token = $("input[name=_token]").val();
        let id = $("#id_empresa").val();
        let _method = "PUT";
        let url = currentURL + '/canales/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                dataForm: dataForm,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                //$('#formDataEmpresa').html(result);
                let url = currentURL + "/canales/" + id;

                $.get(url, function(data, textStatus, jqXHR) {
                    $('#formDataEmpresa').html(data);
                    $('#TableCatExts').DataTable({
                        "lengthChange": true
                    });
                });
            }
        });
    });
    /**
     * Evento para eliminar el modulo
     */
    $(document).on('click', '.deleteCanal', function(event) {
        event.preventDefault();
        let id = $(this).attr('id').replace('delete_', '');
        let _token = $("input[name=_token]").val();
        let _method = "DELETE";
        let url = currentURL + '/canales/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: _token,
                _method: _method
            },
            success: function(result) {
                let id = $("#id_empresa").val();
                let url = currentURL + "/canales/" + id;

                $.get(url, function(data, textStatus, jqXHR) {
                    $('#formDataEmpresa').html(data);
                    $('#TableCatExts').DataTable({
                        "lengthChange": true
                    });
                });
            }
        });
    });
    /**
     * Evento para clonar una fila de la tabla de nuevo canal
     */
    $(document).on('click', '#add', function() {
        var clickID = $(".tableNewCanal tbody tr:last").attr('id').replace('tr_', '');
        // Genero el nuevo numero id
        var newID = parseInt(clickID) + 1;

        fila = $(".tableNewCanal tbody tr:eq()").clone().appendTo(".tableNewCanal"); //Clonamos la fila
        //fila.find('select.tipo_canal').attr("data-pos", newID); //Buscamos el selecto con clase tipo_canal y le agregamos un nuevo atributo a pos
        fila.find('select.tipo_canal').attr({ 'data-pos': newID, name: 'tipo_canal_' + newID }); //Buscamos el selecto con clase tipo_canal y le agregamos un nuevo atributo a pos
        fila.find('.protocolo').attr({ id: 'protocolo_' + newID, name: 'protocolo_' + newID }); //Buscamos el input con clase protocolo y le agregamos un nuevo ID
        fila.find('.protocolo').val(""); //Buscamos el input con clase protocolo y le asignamos un valor vacio
        fila.find('.Troncales_id_canal').attr({ id: 'Troncales_id_canal_' + newID, name: 'Troncales_id_canal_' + newID }); //Buscamos el input con clase Troncales_id_canal y le agregamos un nuevo ID
        fila.find('.Troncales_id').attr({ id: 'Troncales_id_' + newID, name: 'Troncales_id_' + newID }); //Buscamos el input con clase Troncales_id_canal y le agregamos un nuevo ID
        fila.find('.prefijo').attr({ id: 'prefijo_' + newID, name: 'prefijo_' + newID }); //Buscamos el input con clase Troncales_id_canal y le agregamos un nuevo ID
        fila.find('.prefijo').val(""); //Buscamos el input con clase protocolo y le asignamos un valor vacio

        fila.attr("id", 'tr_' + newID);
    });
    /**
     * Evento para eliminars una fila de la tabla de nuevo canal
     */
    $(document).on('click', '.tr_clone_remove', function() {
        var tr = $(this).closest('tr')
        tr.remove();
    });
    /**
     * Evento para obtener el valor del tipo de canal
     */
    $(document).on('change', '.tipo_canal', function(event) {

        let pos = $(this).data('pos');
        let id_Tipo_Canal = $(this).val();
        let prefijo = $("#tipo_canal_"+pos+" option:selected").data('pre_tipo');

        if (id_Tipo_Canal == 12 || id_Tipo_Canal == 11) {
            $("#protocolo_" + pos).val("LOCAL/");
            $("#Troncales_id_canal_" + pos).prop('disabled', 'disabled');
            $("#Troncales_id_" + pos).prop('disabled', false);
        } else {
            $("#protocolo_" + pos).val("SIP/");
            $("#Troncales_id_canal_" + pos).prop('disabled', false);
            $("#Troncales_id_" + pos).prop('disabled', 'disabled');
        }

        $("#prefijo_"+pos).val(prefijo);

    });
    /**
     * Evento para habilitar la edicion del canal seleccionado
     */
    $(document).on('click', '.editar_canal', function(event) {
        let id = $(this).val();
        /**
         * Habilitamos los inputs para editar
         */
        if ($(this).prop('checked')) {
            $("#tipo_Canal_" + id).prop("disabled", false);
            $("#Troncales_id_canal_" + id).prop("disabled", false);
            $("#protocolo_" + id).prop({ "disabled": false, 'readonly': true });
            $("#prefijo_" + id).prop("disabled", false);
            $("#prefijo_completo_" + id).prop("disabled", false);
            $("#delete_" + id).slideDown();
        } else {
            $("#tipo_Canal_" + id).prop("disabled", true);
            $("#Troncales_id_canal_" + id).prop("disabled", true);
            $("#protocolo_" + id).prop("disabled", true);
            $("#prefijo_" + id).prop("disabled", true);
            $("#prefijo_completo_" + id).prop("disabled", true);
            $("#delete_" + id).slideUp();
        }
    });
    /**
     * Funcion para formatear el id de la empresa a 3 digitos
     * @param {id_empresa} number
     * @param {tamanio} width
     */
    function zfill(number, width) {
        var numberOutput = Math.abs(number); /* Valor absoluto del número */
        var length = number.toString().length; /* Largo del número */
        var zero = "0"; /* String de cero */

        if (width <= length) {
            if (number < 0) {
                return ("-" + numberOutput.toString());
            } else {
                return numberOutput.toString();
            }
        } else {
            if (number < 0) {
                return ("-" + (zero.repeat(width - length)) + numberOutput.toString());
            } else {
                return ((zero.repeat(width - length)) + numberOutput.toString());
            }
        }
    }
});
