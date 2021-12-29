$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario editar formularios
     */
    $(document).on('click', '#tableFormulario tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".dropleft").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableFormulario tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para eliminar el Formulario
     *
     */
    $(document).on('click', '.deleteFormulario', function(event) {
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
                let url = currentURL + 'settings/formularios/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableFormulario').DataTable({
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
     * Evento para mostrar el formulario de crear un nuevo formulario
     */
    $(document).on("click", ".newFormulario", function(e) {
        e.preventDefault();

        $('#tituloModal').html('Nuevo Formulario');
        let url = currentURL + 'settings/formularios/create';

        $('#action').removeClass('updateFormulario');
        $('#action').addClass('saveFormulario');

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
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveFormulario', function(event) {
        event.preventDefault();


        let dataForm = $("#formDataFormulario").serializeArray();
        var data = {};
        $(dataForm).each(function(index, obj) {
            data[obj.name] = obj.value;
        });

        let _token = $("input[name=_token]").val();
        let url = currentURL + 'settings/formularios';

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
     * Evento para visualizar detalles del Formulario
     */
    $(document).on('click', '.viewFormulario', function(event) {
        event.preventDefault();
        let id = $("#idSeleccionado").val();
        $('#tituloModal').html('Detalles de Formulario');
        let url = currentURL + 'settings/formularios/' + id;

        $('#action').removeClass('updateFormulario');
        $('#action').addClass('saveFormulario');

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
     * Evento para visualizar la configuración de formulario
     */
    $(document).on('click', '.editFormulario', function(event) {
        event.preventDefault();
        var id = $("#idSeleccionado").val();
        $('#tituloModal').html('Detalles de Formulario');
        var url = currentURL + 'settings/formularios/' + id + '/edit';
        $('#action').addClass('updateFormulario');
        $('#action').removeClass('saveFormulario');
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
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.updateFormulario', function(event) {
        event.preventDefault();

        let id = $("#idSeleccionado").val();
        let dataForm = $("#formDataFormulario").serializeArray();
        var data = {};
        $(dataForm).each(function(index, obj) {
            console.log( obj.name + " --- " +  obj.value );
            data[obj.name] = obj.value;
        });

        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + 'settings/formularios/' + id;

        $.post(url, {
            dataForm: data,
            _method: _method,
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
     * Evento para duplicar el Formulario
     *
     */
    $(document).on('click', '.cloneFormulario', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Nombre del nuevo formulario',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Duplicar',
            showLoaderOnConfirm: true,
            preConfirm: (nombreForm) => {
                console.log(nombreForm)
                let id = $("#idSeleccionado").val();
                let url = currentURL + 'settings/formularios/duplicar/' + id;
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
                        $('.viewResult #tableFormulario').DataTable({
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
