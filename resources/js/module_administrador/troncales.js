$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newTroncal", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Nueva Troncal');
        $('#action').removeClass('updateTrocal');
        $('#action').addClass('saveTroncal');

        let url = currentURL + '/troncales/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveTroncal', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let ip_host = $("#ip_host").val();
        let Cat_IP_PBX_id = $("#ip_media").val();
        let Cat_Distribuidor_id = $("#distribuidores").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/troncales';

        $.post(url, {
            nombre: nombre,
            descripcion: descripcion,
            Cat_IP_PBX_id: Cat_IP_PBX_id,
            ip_host: ip_host,
            Cat_Distribuidor_id: Cat_Distribuidor_id,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewIndex #tableTroncales').DataTable({
                "lengthChange": true
            });
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        });
    });
    /**
     * Evento para mostrar el formulario editar modulo
     */
    $(document).on('click', '#tableTroncales tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");
        $(".editTroncal").slideDown();
        $(".deleteTroncal").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableTroncales tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para mostrar el formulario de edicion de un canal
     */
    $(document).on("click", ".editTroncal", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Editar Troncal');
        $('#action').removeClass('saveTroncal');
        $('#action').addClass('updateTrocal');

        let id = $("#idSeleccionado").val();

        let url = currentURL + "/troncales/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateTrocal', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let ip_host = $("#ip_host").val();
        let Cat_IP_PBX_id = $("#ip_media").val();
        let Cat_Distribuidor_id = $("#distribuidores").val();
        let _token = $("input[name=_token]").val();
        let id = $("#id").val();
        let _method = "PUT";
        let url = currentURL + '/troncales/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                nombre: nombre,
                descripcion: descripcion,
                ip_host: ip_host,
                Cat_IP_PBX_id: Cat_IP_PBX_id,
                Cat_Distribuidor_id: Cat_Distribuidor_id,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex #tableTroncales').DataTable({
                    "lengthChange": true
                });
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )
            }
        });
    });
    /**
     * Evento para eliminar el modulo
     */
    $(document).on('click', '.deleteTroncal', function(event) {
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
                let url = currentURL + '/troncales/' + id;

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
                        $('.viewIndex #tableTroncales').DataTable({
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
     * Evento que autocompleta el valor del input Troncal Sansay
     * en base a lo que se escriba en el input nombre
     */
    $(document).on('keyup', '#nombre', function(event) {
        let nombre_troncal = $(this).val();
        let nombre = nombre_troncal.replace(" ", "_");
        $("#troncal_sansay").val("BUS > " + nombre + " > DID")
    });

    /**
     * Evento para invocar a la ventana modal para visualizar la configuracion
     */
    $(document).on('click', '.show-modal', function(event) {
        let id = $(this).val();
        //alert(id);
        let url = currentURL + '/troncales/' + 1;

        $.get(url, function(data, textStatus, xhr) {
            $("#configuracionmodal").html(data);
            $("#configuracionmodal").modal("show");
        });
    });
});