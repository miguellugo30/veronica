$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newEdoAge", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Nuevo Estado Agente');
        $('#action').removeClass('updateEdoAge');
        $('#action').addClass('saveEdoAge');

        let url = currentURL + '/cat_agente/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para mostrar el formulario de edicion de un canal
     */
    $(document).on("click", ".editEdoAge", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Editar Tipo Canal');
        $('#action').removeClass('saveEdoAge');
        $('#action').addClass('updateEdoAge');

        let id = $("#idSeleccionado").val();

        let url = currentURL + "/cat_agente/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveEdoAge', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let _token = $("input[name=_token]").val();
        let recibir_llamada = $('input:radio[name=recibir_llamada]:checked').val()
        let url = currentURL + '/cat_agente';

        $.post(url, {
                nombre: nombre,
                descripcion: descripcion,
                recibir_llamada: recibir_llamada,
                _token: _token
            }, function(data, textStatus, xhr) {

                $('.viewResult').html(data);
                $('.viewIndex #tableEdoAge').DataTable({
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
    $(document).on('click', '#tableEdoAge tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");
        $(".editEdoAge").slideDown();
        $(".deleteEdoAge").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableEdoAge tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateEdoAge', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let recibir_llamada = $('input:radio[name=recibir_llamada]:checked').val();
        let url = currentURL + '/cat_agente/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                nombre: nombre,
                descripcion: descripcion,
                recibir_llamada: recibir_llamada,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewIndex #tableEdoAge').DataTable({
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
    $(document).on('click', '.deleteEdoAge', function(event) {
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
                let url = currentURL + '/cat_agente/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewIndex #tableEdoAge').DataTable({
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
