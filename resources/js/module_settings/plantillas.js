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
        fila.find('.btn-danger').css('display', 'inherit');
        fila.find('#id_campo').attr('value', '');
        fila.attr("id", 'tr_' + newID);

    });
    /**
     * Evento para eliminar una fila de la tabla de nuevo formulario
     */
    $(document).on('click', '.tr_clone_remove', function() {
        var tr = $(this).closest('tr');
        tr.remove();
    });
    /**
     * Evento para guardar la nueva plantilla
     */
    $(document).on('click', '.savePlantilla', function(event) {
        event.preventDefault();
        let data = {};
        $('#altaCampo input, select').each(function() {

            let nombre = String(this.name);

            if (nombre == 'nombre') {
                data[nombre] = this.value;
            }

            if (nombre != '' && nombre != 'nombre') {

                let id = "input[name='" + nombre + "']";

                if (nombre.indexOf('campo_id') == 0) {
                    valor = this.value;
                } else {
                    if ($(id).is(':checked')) {
                        valor = 1;
                    } else {
                        valor = 0;
                    }
                }

                data[nombre] = valor;
            }

        });

        let _token = $("input[name=_token]").val();
        let url = currentURL + '/Plantillas';

        $.post(url, {
            dataForm: data,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.modal-backdrop ').css('display', 'none');
            $('#modal').modal('hide');
            $('.viewResult').html(data);
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });

    });
    /**
     * Evento para marcar los numeros a marcar
     */
    $(document).on("click", '.todos_num_marcar', function() {
        $(this)
            .closest("table")
            .find("tbody .num_marcar")
            .prop("checked", this.checked)
            .closest("tr")
            .toggleClass("selected", this.checked);
    });
    /**
     * Evento para marcar los campos a mostrar
     */
    $(document).on("click", '.todos_mostrar', function() {
        $(this)
            .closest("table")
            .find("tbody .mostrar")
            .prop("checked", this.checked)
            .closest("tr")
            .toggleClass("selected", this.checked);
    });
    /**
     * Evento para marcar los editables
     */
    $(document).on("click", '.todos_editable', function() {
        $(this)
            .closest("table")
            .find("tbody .editable")
            .prop("checked", this.checked)
            .closest("tr")
            .toggleClass("selected", this.checked);
    });

});