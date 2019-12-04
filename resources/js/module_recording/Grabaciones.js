$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el boton de eliminar seleccionando una grabacion
     */
    $(document).on('click', '#tableGrabaciones tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".deleteGrabacion").slideDown();
        $(".downloadGrabacion").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableGrabaciones tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para descargar la Grabacion
     */
    $(document).on("click", ".downloadGrabacion", function(event) {
        event.preventDefault();
        let id = $("#idSeleccionado").val();
        //window.location.href = 'http://10.255.242.136/audios/temp2/Inbound_24/2019-11-05/11536501001-8466.wav';
        $("#idSeleccionado").attr('href', 'http://10.255.242.136/audios/temp2/Inbound_24/2019-11-05/11536501001-8466.wav');
        $("#idSeleccionado").attr('download', '');
        $("#idSeleccionado").attr('target', '_blank');
        /*
        $('#tituloModal').html('Nuevo Audio');
        $('#action').removeClass('deleteAudio');
        $('#action').addClass('saveAudio');

        let url = currentURL + "/Audios/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
        */
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
     *
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
});