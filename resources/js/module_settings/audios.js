$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el boton de eliminar seleccionando un audio
     */
    $(document).on('click', '#tableAudios tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".deleteAudio").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableAudios tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para mostrar el formulario de crear un nuevo Audio
     */
    $(document).on("click", ".newAudio", function(e) {
        event.preventDefault();
        $('#tituloModal').html('Nuevo Audio');
        $('#action').removeClass('deleteAudio');
        $('#action').addClass('saveAudio');
        $("#action").css('display', '');

        let url = currentURL + "settings/Audios/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    //Ingresa el nombre del archivo seleccionado en el campo del browser
    $(document).on('change', '#file', function(e) {
        $('#labelFile').html(e.target.files[0]['name']);
    });
    /**
     * Evento para guardar el nuevo audio
     */
    $(document).on('click', '.saveAudio', function(event) {
        event.preventDefault();

        let formData = new FormData(document.getElementById("altaaudio"));
        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let labelFile = $("#labelFile").text();
        let file = $("#file").val();
        let _token = $("input[name=_token]").val();

        formData.append("nombre", nombre);
        formData.append("descripcion", descripcion);
        formData.append("ruta", labelFile);
        formData.append("File", file);
        formData.append("_token", _token);

        let url = currentURL + 'settings/Audios';

        $.ajax({
                url: url,
                type: "post",
                //dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(data) {
                $('#modal').modal('hide');
                $('.modal-backdrop ').css('display', 'none');
                $('.viewResult').html(data);
                $('.viewResult #tableAudios').DataTable({
                    "lengthChange": false
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
     * Evento para eliminar el Audio
     */
    $(document).on('click', '.deleteAudio', function(event) {
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
                let url = currentURL + 'settings/Audios/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableAudios').DataTable({
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
     * Evento para reproducir un audio
     */
    $(document).on('click', '.reproducir-audio', function(event) {
        let id = $(this).data("id-audio");
        let url = currentURL + 'settings/Audios/' + id;
        let _token = $("input[name=_token]").val();
        $("#tituloModal").html('Reproducir Grabación');

        $("#action").css('display', 'none');

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id,
                _token: _token
            },
            success: function(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);
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