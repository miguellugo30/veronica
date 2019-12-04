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

        let url = currentURL + "/Audios/create";

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
        $('#modal').modal('hide');

        let formData = new FormData(document.getElementById("altaaudio"));
        let nombre = $("#name").val();
        let descripcion = $("#descripcion").val();
        let labelFile = $("#labelFile").text();
        let file = $("#file").val();
        let _token = $("input[name=_token]").val();

        formData.append("nombre", nombre);
        formData.append("descripcion", descripcion);
        formData.append("ruta", labelFile);
        formData.append("File", File);
        formData.append("_token", _token);

        let url = currentURL + '/Audios';

        $.ajax({
                url: url,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(data) {
                $('.viewResult').html(data);
                $('.viewResult #tableAudios').DataTable({
                    "lengthChange": false
                });
            });
        Swal.fire(
            'Correcto!',
            'El registro ha sido guardado.',
            'success'
        )
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
                let url = currentURL + '/Audios/' + id;

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
        let url = currentURL + '/Audios/' + id;
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id,
                _token: _token
            },
            success: function(result) {

                var src = currentURL.replace(/\/settings/g, '') + result;
                var audio = new Audio();
                var playPromise;

                audio.src = src;
                playPromise = audio.play();

                if (playPromise) {
                    playPromise.then(() => {
                        // Audio Loading Successful
                        // Audio playback takes time
                        setTimeout(() => {
                            // Follow up operation
                            console.log("done.");
                        }, audio.duration * 1000); // audio.duration is the length of the audio in seconds.


                    }).catch((e) => {
                        // Audio loading failure
                    });
                }
            }
        });

    });
});