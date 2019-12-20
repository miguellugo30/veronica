$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nueva calificacion
     */
    $(document).on("click", ".newCalificaciones", function(e) {
        e.preventDefault();

        $('#tituloModal').html('Nuevas Calificaciones');

        let url = currentURL + '/calificaciones/create';

        $('#action').removeClass('updateCalificaciones');
        $('#action').addClass('saveCalificaciones');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);
            }
        });
    });
    /**
     * Evento para clonar finas de la tabla
     */
    $(document).on('click', '#addCalificaciones', function(event) {

        var clickID = $(".tableNewForm tbody tr.clonar:last").attr('id').replace('tr_', '');
        // Genero el nuevo numero id
        var newID = parseInt(clickID) + 1;

        let IDInput = ['nombre_calificacion', 'formulario_calificacion', 'id_calificacion']; //ID de los inputs dentro de la fila

        fila = $(".tableNewForm tbody tr:eq()").clone().appendTo(".tableNewForm"); //Clonamos la fila

        for (let i = 0; i < IDInput.length; i++) {
            fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
        }
        fila.find('.btn-danger').css('display', 'initial');
        fila.find('#id_calificacion').val('');
        fila.attr("id", 'tr_' + newID);
    });
    /**
     * Evento para guardar Nuevas Calificaciones
     */
    $(document).on('click', '.saveCalificaciones', function(event) {
        event.preventDefault();

        let dataForm = $("#formDataCalificaciones").serializeArray();
        var data = {};
        $(dataForm).each(function(index, obj) {
            data[obj.name] = obj.value;
        });
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/calificaciones';

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
     * Evento que muestra elemento calificaciones || esta funcion muestra con slide los botones de Eliminar y Editar
     */
    $(document).on('click', '#tableCalificaciones tbody tr', function(event) {

        event.preventDefault();
        let id = $(this).data("id");
        $(".dropleft").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableCalificaciones tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para visualizar un registro
     */
    $(document).on('click', '.editCalificaciones', function(event) {
        event.preventDefault();

        var id = $("#idSeleccionado").val();

        $('#tituloModal').html('Edicion de Calificaciones');

        var url = currentURL + '/calificaciones/' + id + '/edit';

        $('#action').removeClass('saveCalificaciones');
        $('#action').addClass('updateCalificaciones');

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
     * Evento para guardar Nuevas Calificaciones
     */
    $(document).on('click', '.updateCalificaciones', function(event) {
        event.preventDefault();

        let dataForm = $("#formDataCalificaciones").serializeArray();
        var data = {};
        $(dataForm).each(function(index, obj) {
            data[obj.name] = obj.value;
        });
        var id = $("#idSeleccionado").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/calificaciones/' + id;

        $.post(url, {
            dataForm: data,
            _token: _token,
            _method: _method,
        }, function(data, textStatus, xhr) {
            $('.modal-backdrop ').css('display', 'none');
            $('#modal').modal('hide');
            $('.viewResult').html(data);
            $('.viewResult #tableCalificaciones').DataTable({
                "lengthChange": false
            });
            Swal.fire(
                'Actualizado!',
                'El registro ha sido actualiazdo.',
                'success'
            )
        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });

    });
    /**
     * Evento para eliminar el Grupo
     */
    $(document).on('click', '.deleteCalificaciones', function(event) {
        event.preventDefault();
        /**Modal de Alerta Swal.fire**/
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
                let url = currentURL + '/calificaciones/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableCalificaciones').DataTable({
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
     * Evento para eliminar el Grupo
     */
    $(document).on('click', '.tr_clone_remove-calificacion', function(event) {

        let id = $(this).data("id-eliminar");
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/calificaciones/eliminarCalificacion/' + id;
        let tr = $(this).closest('tr');

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                _token: _token
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
    });
    /**
     * Evento para duplicar el grupo de calificaciones
     */
    $(document).on('click', '.cloneCalificaciones', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Nombre del nuevo grupo de calificaciones',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Duplicar',
            showLoaderOnConfirm: true,
            preConfirm: (nombreForm) => {

                let id = $("#idSeleccionado").val();
                let url = currentURL + '/calificaciones/duplicar/' + id;
                let _token = $("input[name=_token]").val();

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        id: id,
                        nombreForm: nombreForm,
                        _token: _token,
                    },
                    success: function success(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableCalificaciones').DataTable({
                            "lengthChange": false
                        });
                        Swal.fire(
                            'Duplicado!',
                            'El registro ha sido duplicado.',
                            'success'
                        )
                    }
                });
            }
        });
    });
    /**
     * Visualizar el grupo de calificaciones
     */
    $(document).on('click', '.viewCalificaciones', function(event) {

        let id = $("#idSeleccionado").val();
        let url = currentURL + '/calificaciones/' + id;

        $('#tituloModal').html('Visualizar Calificaciones');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);
            }
        });
    });
    /**
     * Mostrar formulario vinculado a la calificacion seleccionada
     */
    $(document).on('change', '#calificacion', function(event) {

        let id = $(this).val();
        console.log(id);
        let url = currentURL + '/formularios/' + id;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $(".viewFormularioCalificacion").html(result);
            }
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