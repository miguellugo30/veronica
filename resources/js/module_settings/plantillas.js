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

        let url = currentURL + "settings/Plantillas/create";

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
        let url = currentURL + 'settings/Plantillas';

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
    /**
     * Evento para seleccionar una plantilla
     */
    $(document).on('click', '#tablePlantillas tbody tr', function(event) {

        event.preventDefault();
        let id = $(this).data("id");
        $(".editPlantillas").slideDown();
        $(".deletePlantilla").slideDown();

        $("#idSeleccionado").val(id);

        $("#tablePlantillas tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para editar una plantilla
     */
    $(document).on('click', '.editPlantillas', function(event) {

        event.preventDefault();

        var id = $("#idSeleccionado").val();

        $('#tituloModal').html('Editar Plantilla');

        var url = currentURL + 'settings/Plantillas/' + id + '/edit';
        $('#action').addClass('updatePlantilla');
        $('#action').removeClass('savePlantilla');
        $.ajax({
            url: url,
            type: 'GET',
            success: function success(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);
            }
        });
    });
    /**
     * Evento para actualizar una plantilla
     */
    $(document).on('click', '.updatePlantilla', function(event) {

        let data = {};
        var id = $("#idSeleccionado").val();
        $('#altaCampo input, select').each(function() {

            let nombre = String(this.name);

            if (nombre != 'tablePlantillas_length') {

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
            }
        });

        let _method = 'PUT';
        let _token = $("input[name=_token]").val();
        let url = currentURL + 'settings/Plantillas/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: _token,
                _method: _method,
                data: data
            },
            success: function(result) {
                $('.modal-backdrop ').css('display', 'none');
                $('#modal').modal('hide');
                $('.viewResult').html(result);
                $('.viewResult #tablePlantillas').DataTable({
                    "lengthChange": false
                });
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido editado.',
                    'success'
                )
            }
        });
    });
    /**
     * Evento para eliminar una platilla
     *
     */
    $(document).on('click', '.deletePlantilla', function(event) {
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
                let id = $("#idSeleccionado").val();
                let _method = "DELETE";
                let _token = $("input[name=_token]").val();
                let url = currentURL + 'settings/Plantillas/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tablePlantillas').DataTable({
                            "lengthChange": false
                        });
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
});
