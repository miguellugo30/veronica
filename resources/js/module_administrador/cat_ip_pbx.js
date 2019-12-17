$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newPbx", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Nuevo PBX');
        $('#action').removeClass('updatePbx');
        $('#action').addClass('savePbx');


        let url = currentURL + '/cat_ip_pbx/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para mostrar el formulario de edicion de un canal
     */
    $(document).on("click", ".editPbx", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Editar PBX');
        $('#action').removeClass('savePbx');
        $('#action').addClass('updatePbx');

        let id = $("#idSeleccionado").val();

        let url = currentURL + "/cat_ip_pbx/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.savePbx', function(event) {
        event.preventDefault();

        let media_server = $("#media_server").val();
        let ip_pbx = $("#ip_pbx").val();
        let Cat_Base_Datos_id = $("#basedatos").val();
        let arr = $('[name="nas[]"]:checked').map(function() {
            return this.value;
        }).get();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/cat_ip_pbx';

        $.post(url, {
                media_server: media_server,
                Cat_Base_Datos_id: Cat_Base_Datos_id,
                ip_pbx: ip_pbx,
                arr: arr,
                _token: _token
            }, function(data, textStatus, xhr) {

                $('.viewResult').html(data);
                $('.viewIndex #tablePbx').DataTable({
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
    $(document).on('click', '#tablePbx tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".editPbx").slideDown();
        $(".deletePbx").slideDown();

        $("#idSeleccionado").val(id);

        $("#tablePbx tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updatePbx', function(event) {
        event.preventDefault();

        let media_server = $("#media_server").val();
        let ip_pbx = $("#ip_pbx").val();
        let Cat_Base_Datos_id = $("#basedatos").val();
        let arr = $('[name="nas[]"]:checked').map(function() {
            return this.value;
        }).get();
        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/cat_ip_pbx/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                media_server: media_server,
                ip_pbx: ip_pbx,
                Cat_Base_Datos_id: Cat_Base_Datos_id,
                arr: arr,
                id: id,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewIndex #tablePbx').DataTable({
                    "lengthChange": true
                });
            }
        }).done(function(data) {
            $('.modal-backdrop ').css('display', 'none');
            $('#modal').modal('hide');
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
     * Evento para eliminar el modulo
     */
    $(document).on('click', '.deletePbx', function(event) {
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
                let url = currentURL + '/cat_ip_pbx/' + id;

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
                        $('.viewIndex #tablePbx').DataTable({
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
