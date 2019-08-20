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
                let url = currentURL + '/formularios/' + id;

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
        let url = currentURL + '/formularios/create';

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
        $('#modal').modal('hide');

        let dataForm = $("#formDataFormulario").serializeArray();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/formularios';

        $.post(url, {
            dataForm: dataForm,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
        });

    });
    /**
     * Evento para visualizar detalles del Formulario
     */
    $(document).on('click', '.viewFormulario', function(event) {
        event.preventDefault();
        let id = $("#idSeleccionado").val();
        $('#tituloModal').html('Detalles de Formulario');
        let url = currentURL + '/formularios/' + id;

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
        var url = currentURL + '/formularios/' + id + '/edit';
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
        $('#modal').modal('hide');
        let id = $("#idSeleccionado").val();
        let dataForm = $("#formDataFormulario").serializeArray();

        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/formularios/' + id;

        $.post(url, {
            dataForm: dataForm,
            _method: _method,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
        });

    });
});
