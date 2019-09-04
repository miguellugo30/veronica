$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para seleccionar un desvio
     */
    $(document).on('click', '#tableDesvios tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".deleteDesvio").slideDown();
        $(".editDesvio").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableDesvios tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });;
    /**
     * Evento para eliminar un desvio
     *
     */
    $(document).on('click', '.deleteDesvio', function(event) {
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
                let url = currentURL + '/Desvios/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableDesvios').DataTable({
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
    * Evento para mostrar el formulario de crear un nuevo desvio
    */
    $(document).on("click", ".newDesvio", function(e) {
        event.preventDefault();
        $('#tituloModal').html('Agregar Desvio');
        $('#action').removeClass('deleteDesvio');
        $('#action').addClass('saveDesvio');

        let url = currentURL + "/Desvios/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
    * Evento para guardar el nuevo agente
    */
    $(document).on('click', '.saveDesvio', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let Canales_id = $("#Canales_id").val();
        let dial = $("#dial").val();
        let ringeo = $("#ringeo").val();
        let Empresas_id = $("#Empresas_id").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/Desvios';

        $.post(url, {
            nombre: nombre,
            Canales_id: Canales_id,
            dial: dial,
            ringeo: ringeo,
            Empresas_id: Empresas_id,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);

            $('.viewResult #tableDesvios').DataTable({
                "lengthChange": true,
                "order": [
                    [2, "asc"]
                ]
            });
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        });
    });
    /**
    * Evento para eliminar un desvio
    *
    */
    $(document).on('click', '.deleteDesvio', function(event) {
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
                let url = currentURL + '/Desvios/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableDesvios').DataTable({
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
     * Evento para visualizar la configuración del Desvio y editarlo
     */
    $(document).on('click', '.editDesvio', function(event) {

        event.preventDefault();
        var id = $("#idSeleccionado").val();
        var url = currentURL + '/Desvios/' + id + '/edit';

        $('#tituloModal').html('Editar Desvio');
        $('#action').addClass('updateDesvio');
        $('#action').removeClass('saveDesvio');

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
     * Evento para guardar los cambios del Desvio
     */
     $(document).on('click', '.updateDesvio', function(event) {
         event.preventDefault();
         $('#modal').modal('hide');
        let id = $("#id").val();

        let nombre = $("#nombre").val();
        let Canales_id = $("#Canales_id").val();
        let dial = $("#dial").val();
        let ringeo = $("#ringeo").val();
        let Empresas_id = $("#Empresas_id").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/Desvios/' + id;
        
        $.post(url, {
            nombre: nombre,
            Canales_id: Canales_id,
            dial: dial,
            ringeo: ringeo,
            Empresas_id: Empresas_id,
            _method: _method,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            
            $('.viewResult #tableDesvios').DataTable({
                "lengthChange": true,
                "order": [
                    [2, "asc"]
                ]
            });
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
                )
            });
            
        });

});