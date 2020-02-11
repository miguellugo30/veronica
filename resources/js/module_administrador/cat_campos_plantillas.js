$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newCamPla", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Nuevo Campo Plantilla');
        $('#action').removeClass('updateCamPla');
        $('#action').addClass('saveCamPla');

        let url = currentURL + '/cat_campos_plantillas/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para mostrar el formulario de edicion de un canal
     */
    $(document).on("click", ".editCamPla", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Editar Campo Plantilla');
        $('#action').removeClass('saveCamPla');
        $('#action').addClass('updateCamPla');

        let id = $("#idSeleccionado").val();

        let url = currentURL + "/cat_campos_plantillas/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
            $("#empresaAdd option").prop('selected', true);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveCamPla', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let empresa = $("#empresaAdd").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/cat_campos_plantillas';

        $.post(url, {
                nombre: nombre,
                empresa: empresa,
                _token: _token
            }, function(data, textStatus, xhr) {

                $('.viewResult').html(data);
                $('.viewIndex #tableCamPla').DataTable({
                    "lengthChange": true
                });
            }).done(function() {
                $('.modal-backdrop ').css('display', 'none');
                $('#modal').modal('hide');
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )
            })
            .fail(function(data) {
                printErrorMsg(data.responseJSON.errors);
            });
    });
    /**
     * Evento para seleccionar un solo campo plantilla y deseleccionar los demas
     */
    $(document).on('click', '#tableCamPla tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");
        $(".editCamPla").slideDown();
        $(".deleteCamPla").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableCamPla tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para cancelar la creacion/edicion del modulo
     */
    $(document).on("click", ".cancelCamPla", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateCamPla', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let empresa = $("#empresaAdd").val();
        let id = $("#id").val();
        let _method = "PUT";
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/cat_campos_plantillas/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                nombre: nombre,
                empresa: empresa,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex #tableCamPla').DataTable({
                    "lengthChange": true
                });
            }
        }).done(function(data) {
            $('.modal-backdrop ').css('display', 'none');
            $('#modal').modal('hide');
            Swal.fire(
                'Correcto!',
                'El registro ha sido actualizado.',
                'success'
            )
        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });
    });
    /**
     * Evento para eliminar el modulo
     */
    $(document).on('click', '.deleteCamPla', function(event) {
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
                let _token = $("input[name=_token]").val();
                let _method = "DELETE";
                let url = currentURL + '/cat_campos_plantillas/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewCreate').slideUp();
                        $('.viewIndex #tableCamPla').DataTable({
                            "lengthChange": true
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
     * Evento para mostrar las empresas de un campo plantilla
     * Nota: popover es un componente de bootstrap
     */
    $(document).on("click", ".pop", function(event) {
        $('[data-toggle="popover"]').popover({ container: 'body', animation: true, html: true, placement: "right", trigger: 'focus' });
    });
    /**
     * Evento para quitar empresas
     */
    $(document).on("click", '.btnLeft', function(event) {
        let selectedItem = $("#empresaAdd option:selected");
        $("#empresa").append(selectedItem);
        $("#empresaAdd option").prop('selected', true);
        $("#empresa option").prop('selected', true);
    });
    /**
     * Evento para agregar empresas
     */
    $(document).on("click", '.btnRight', function(event) {
        let selectedItem = $("#empresa option:selected");
        $("#empresaAdd").append(selectedItem);
        $("#empresaAdd option").prop('selected', true);
    });

    /**
     * Funcion para mostrar los errores de los formularios
     */
    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $(".form-control").removeClass('is-invalid');
        for (var clave in msg) {
            $("#" + clave).addClass('is-invalid');
            if (msg.hasOwnProperty(clave)) {
                $(".print-error-msg").find("ul").append('<li>' + msg[clave][0] + '</li>');
            }
        }
    }
});