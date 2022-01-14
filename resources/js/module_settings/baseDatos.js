$(function() {

    let currentURL = window.location.href;

    /**
     * Evento para mostrar el formulario de crear un nueva base de datos
     */
    $(document).on("click", ".newBaseDatos", function(e) {
        e.preventDefault();

        $('#tituloModal').html('Nueva base de datos');

        let url = currentURL + 'settings/Base-Datos/create';

        $('#action').removeClass('updateBaseDatos');
        $('#action').addClass('saveBaseDatos');

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
     * Evento para mostrar el formulario de crear un nueva base de datos
     */
    $(document).on("change", "#plantilla", function(e) {

        let id = $(this).val();
        let url = currentURL + 'settings/Plantillas/' + id;
        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $(".detailPlantilla").html(result);
            }
        });
    });
    /**
     * Evento para guardar el nuevo distribuidores
     */
    $(document).on('click', '.saveBaseDatos', function(event) {

        event.preventDefault();

        let formData = new FormData(document.getElementById("NewBaseDatosForm"));

        let nombre = $("#nombre").val();
        let plantilla = $("#plantilla").val();
        let _token = $("input[name=_token]").val();

        formData.append("nombre", nombre);
        formData.append("plantilla", plantilla);
        formData.append("_token", _token);


        let url = currentURL + 'settings/Base-Datos';

        $.ajax({
                url: url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    // setting a timeout
                    $(".div-cargando").css('display', 'block');
                }
            })
            .done(function(data) {
                $('.modal-backdrop ').css('display', 'none');
                $('#modal').modal('hide');
                $('.viewResult').html(data);

                $('.viewResult #tableBaseDatos').DataTable({
                    "lengthChange": false,
                    "ordering": false
                });
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )

            }).fail(function(data) {

                if (data.status == 403) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display', 'block');
                    $(".print-error-msg").find("ul").append('<li>' + data.responseJSON.message + '</li>');
                } else {
                    printErrorMsg(data.responseJSON.errors);
                }

            });
    });
    /**
     * Evento para seleccionar una base de datos
     */
    $(document).on('click', '#tableBaseDatos tbody tr', function(event) {

        event.preventDefault();
        let id = $(this).data("id");
        $(".dropleft").slideDown();
        $(".editBaseDatos").slideDown();
        $(".deleteBaseDatos").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableBaseDatos tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para editar una base de datos
     */
    $(document).on('click', '.editBaseDatos', function(event) {

        event.preventDefault();

        var id = $("#idSeleccionado").val();

        $('#tituloModal').html('Editar Base de datos');

        var url = currentURL + 'settings/Base-Datos/' + id + '/edit';
        $('#action').addClass('updateBaseDatos');
        $('#action').removeClass('saveBaseDatos');
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
     * Evento para ver una base de datos
     */
    $(document).on('click', '.viewBaseDatos', function(event) {

        event.preventDefault();

        var id = $("#idSeleccionado").val();

        $('#tituloModalRegistros').html('Visualizar Base de datos');

        var url = currentURL + 'settings/Base-Datos/' + id;
        $('#action').addClass('updateBaseDatos');
        $('#action').removeClass('saveBaseDatos');
        $.ajax({
            url: url,
            type: 'GET',
            success: function success(result) {
                $('#modalRegistros').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body-registros").html(result);
                $('#registroBaseDatos').DataTable({
                    "lengthChange": true,
                    "ordering": false
                });
            }
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.updateBaseDatos', function(event) {
        event.preventDefault();

        $(".print-error-msg").css('display', 'none');

        let formData = new FormData(document.getElementById("NewBaseDatosForm"));

        let id = $("#idSeleccionado").val();
        let accion = $("#accion").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";

        formData.append("accion", accion);
        formData.append("_token", _token);
        formData.append("_method", _method);

        let url = currentURL + 'settings/Base-Datos/' + id;

        $.ajax({
                url: url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    // setting a timeout
                    $(".div-cargando").css('display', 'block');
                }
            })
            .done(function(data) {
                $('.modal-backdrop ').css('display', 'none');
                $('#modal').modal('hide');
                $('.viewResult').html(data);

                $('.viewResult #tableBaseDatos').DataTable({
                    "lengthChange": false,
                    "ordering": false
                });
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )

            }).fail(function(data) {

                $(".div-cargando").css('display', 'none');

                if (data.status == 403) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display', 'block');
                    $(".print-error-msg").find("ul").append('<li>' + data.responseJSON.message + '</li>');
                } else {
                    printErrorMsg(data.responseJSON.errors);
                }

            });

    });
        /**
     * Evento para eliminar una Base de Datos
     */
         $(document).on('click', '.deleteBaseDatos', function(event) {
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
                    let url = currentURL + 'settings/Base-Datos/' + id;

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: _token,
                            _method: _method
                        },
                        success: function(result) {

                            $('.modal-backdrop ').css('display', 'none');
                            $('#modal').modal('hide');
                            $('.viewResult').html(result);

                            $('.viewResult #tableBaseDatos').DataTable({
                                "lengthChange": false,
                                "ordering": false
                            });
                            Swal.fire(
                                'Eliminado!',
                                'El registro ha sido eliminado.',
                                'success'
                            );

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
