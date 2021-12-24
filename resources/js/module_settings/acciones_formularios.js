$(function() {
    /**
     * Evento para agregar una nueva fila para campos nuevos en el formulario
     */
    $(document).on('click', '#add-input-form', function() {
        var clickID = $(".tableNewForm tbody tr.clonar:last").attr('id').replace('tr_', '');
        $('#form_opc .form-control-sm').val('');
        // Genero el nuevo numero id
        var newID = parseInt(clickID) + 1;
        let IDInput = ['id_campo', 'nombre_campo', 'tipo_campo', 'tamano', 'obligatorio', 'obligatorio_hidden', 'editable', 'editable_hidden', 'opciones', 'view'];

        fila = $(".tableNewForm tbody tr:eq()").clone().appendTo(".tableNewForm"); //Clonamos la fila
        for (let i = 0; i < IDInput.length; i++) {
            fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
        }
        fila.find('.btn-info').css('display', 'none');
        fila.find('.btn-danger').css('display', 'block');
        fila.find('#id_campo').attr('value', '');
        fila.attr("id", 'tr_' + newID);

    });
    /**
     * Accion para habilitar o deshabilitar los chechbox
     * de Requerido y Editable
     */
    $(document).on('click', '.micheckbox', function() {
        let id = $(this).attr('id');
        let idTR = $(this).attr('name').replace(id + "_", '');
        var name = id + "_hidden_" + idTR;

        if ($(this).prop('checked')) {
            $("input[name=" + name + "]").prop("disabled", true);
        } else {
            $("input[name=" + name + "]").prop("disabled", false);
        }
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
        let idForm = $("#id_formulario").val();
        let tr = $(this).closest('tr');
        tr.remove();

        let _method = "DELETE";
        let _token = $("input[name=_token]").val();
        let url = currentURL + 'settings/campos/' + id + '&' + idForm;

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
    });

});
