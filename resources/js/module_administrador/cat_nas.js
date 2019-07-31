$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newNas", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Nueva NAS');
        $('#action').removeClass('updateNas');
        $('#action').addClass('saveNas');

        let url = currentURL + '/cat_nas/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveNas', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let ip_nas = $("#ip_nas").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/cat_nas';

        $.post(url, {
            nombre: nombre,
            ip_nas: ip_nas,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);
            $('.viewIndex #tableNas').DataTable({
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
    $(document).on('click', '#tableNas tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");
        $(".editNas").slideDown();
        $(".deleteNas").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableNas tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para mostrar el formulario de edicion de un canal
     */
    $(document).on("click", ".editNas", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Editar NAS');
        $('#action').removeClass('saveNas');
        $('#action').addClass('updateNas');

        let id = $("#idSeleccionado").val();

        let url = currentURL + "/cat_nas/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateNas', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let ip_nas = $("#ip_nas").val();
        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/cat_nas/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                nombre: nombre,
                ip_nas: ip_nas,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewIndex #tableNas').DataTable({
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
    $(document).on('click', '.deleteNas', function(event) {
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
                let url = currentURL + '/cat_nas/' + id;

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
                        $('.viewIndex #tableNas').DataTable({
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
});