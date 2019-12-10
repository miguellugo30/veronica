$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newDataBase", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Nuevo Base de Datos');
        $('#action').removeClass('updateBaseDatos');
        $('#action').addClass('saveBaseDatos');

        let url = currentURL + '/basedatos/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para mostrar el formulario de edicion de un canal
     */
    $(document).on("click", ".editDataBase", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Editar Base de Datos');
        $('#action').removeClass('saveBaseDatos');
        $('#action').addClass('updateBaseDatos');

        let id = $("#idSeleccionado").val();

        let url = currentURL + "/basedatos/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveBaseDatos', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let ubicacion = $("#ubicacion").val();
        let ip = $("#ip").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/basedatos';

        $.post(url, {
                nombre: nombre,
                ubicacion: ubicacion,
                ip: ip,
                _token: _token
            }, function(data, textStatus, xhr) {
                $('.viewResult').html(data);
                $('.viewIndex #tableBaseDatos').DataTable({
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
     * Evento para mostrar el formulario editar modulo
     */
    $(document).on('click', '#tableBaseDatos tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");
        $(".editDataBase").slideDown();
        $(".deleteDataBase").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableBaseDatos tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateBaseDatos', function(event) {
        event.preventDefault();
        let nombre = $("#nombre").val();
        let ubicacion = $("#ubicacion").val();
        let ip = $("#ip").val();
        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/basedatos/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                nombre: nombre,
                ubicacion: ubicacion,
                ip: ip,
                _token: _token,
                _method: _method
            },
            success: function(data) {

                $('.modal-backdrop ').css('display', 'none');
                $('#modal').modal('hide');
                $('.viewResult').html(data);
                $('.viewCreate').slideUp();
                $('.viewIndex #tableBaseDatos').DataTable({
                    "lengthChange": true
                });
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido actualizado.',
                    'success'
                )
            },
            error: function(data) {
                printErrorMsg(data.responseJSON.errors);
            }
        });
    });
    /**
     * Evento para eliminar el modulo
     */
    $(document).on('click', '.deleteDataBase', function(event) {
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
                let url = currentURL + '/basedatos/' + id;

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
                        $('.viewIndex #tableBaseDatos').DataTable({
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