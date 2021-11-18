$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo ivr
     */
    $(document).on("click", ".newIvr", function(e) {
        event.preventDefault();
        $('#tituloModal').html('Nuevo IVR');
        $('#action').removeClass('updateIvr');
        $('#action').addClass('saveIvr');

        let url = currentURL + "inbound/Ivr/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal({ backdrop: 'static', keyboard: false });
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo agente
     */
    $(document).on('click', '.saveIvr', function(event) {
        event.preventDefault();

        let dataForm = $("#formCreateIvr").serializeArray();
        var data = {};
        $(dataForm).each(function(index, obj) {
            data[obj.name] = obj.value;
        });
        let Empresas_id = $("#Empresas_id").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + 'inbound/Ivr';

        $.post(url, {
            Empresas_id: Empresas_id,
            dataForm: data,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.modal-backdrop ').css('display', 'none');
            $('#modal').modal('hide');
            $('.viewResult').html(data);

            $('.viewResult #tableivr').DataTable({
                "lengthChange": true,
                "order": [
                    [2, "asc"]
                ]
            });
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
     * Evento para agregar una condición de tiempo adicional
     */
    $(document).on('click', '#addOpcion', function(event) {

        var clickID = $(".tableOpciones tbody tr:last").attr('id').replace('tr_', '');
        var newID = parseInt(clickID) + 1; // Genero el nuevo numero id

        fila = $(".tableOpciones tbody tr:eq()").clone().appendTo(".tableOpciones"); //Clonamos la fila

        let IDInput = ['tipo', 'digito', 'destino', 'opcion_id'];

        for (let i = 0; i < IDInput.length; i++) {
            fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
        }
        fila.find('.opcionesDestino').attr('id', "opcionesDestino_" + newID);
        fila.find('.form-control').attr('value', '');
        fila.find('.btn-danger').css('display', 'initial');
        fila.attr("id", 'tr_' + newID);
    });
    /**
     * Accion para mostrar las opciones en base al destino seleccionado
     */
    $(document).on('change', '.destinoOpccionIvr', function(event) {
        let nombre = $(this).attr('name');
        let opccion = $(this).val();
        let _token = $("input[name=_token]").val();

        nombre = nombre.replace('destino_', '');

        let id = 0 + '&' + opccion + '&' + nombre;
        let url = currentURL + 'inbound/Did_Enrutamiento/' + id;

        $.ajax({
                url: url,
                type: "GET",
                data: {
                    _token: _token
                },
            })
            .done(function(data) {
                $('#opcionesDestino_' + nombre).html(data);
            });
    });
    /**
     * Evento para seleccionar un Enrutamiento
     */
    $(document).on('click', '#tableivr tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".deleteIvr").slideDown();
        $(".editIvr").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableivr tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para eliminar el grupo de condicion de tiempo
     */
    $(document).on('click', '.deleteIvr', function(event) {
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
                let url = currentURL + 'inbound/Ivr/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableivr').DataTable({
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
    /**
     * Evento para editar la configuración de grupo de condicion de tiempo
     */
    $(document).on('click', '.editIvr', function(event) {
        event.preventDefault();
        var id = $("#idSeleccionado").val();
        $('#tituloModal').html('Edicion IVR');
        var url = currentURL + 'inbound/Ivr/' + id + '/edit';
        $('#action').addClass('updateIvr');
        $('#action').removeClass('saveIvr');
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
     * Evento para eliminar una fila de la tabla de nueva condicion de tiempo
     */
    $(document).on('click', '.tr_remove_opcion_ivr', function() {
        let tr = $(this).closest('tr');
        let id = $(this).data('id');
        let _method = "DELETE";
        let _token = $("input[name=_token]").val();
        let url = currentURL + 'inbound/Ivr_Opciones/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: _token,
                _method: _method
            },
            success: function(result) {
                tr.remove();
            }
        });
    });
    /**
     * Evento para guardar el nuevo agente
     */
    $(document).on('click', '.updateIvr', function(event) {
        event.preventDefault();

        let Empresas_id = $("#Empresas_id").val();
        let dataForm = $("#formCreateIvr").serializeArray();
        var data = {};
        $(dataForm).each(function(index, obj) {
            data[obj.name] = obj.value;
        });
        let id = $("#idSeleccionado").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + 'inbound/Ivr/' + id;

        $.post(url, {

            Empresas_id: Empresas_id,
            dataForm: data,
            _method: _method,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.modal-backdrop ').css('display', 'none');
            $('#modal').modal('hide');
            $('.viewResult').html(data);

            $('.viewResult #tableivr').DataTable({
                "lengthChange": true,
                "order": [
                    [2, "asc"]
                ]
            });
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
     * Funcion para mostrar los errores de los formularios
     */
    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $(".form-control").removeClass('is-invalid');
        $(".print-error-msg").find("ul").append('<li>Es un campo obligatorio</li>');
        for (var clave in msg) {
            var data = clave.split('.');
            $("[name='" + data[1] + "']").addClass('is-invalid');
        }
    }
});