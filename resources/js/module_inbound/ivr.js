$(function() {
    var currentURL = window.location.href;
    /**
    * Evento para mostrar el formulario de crear un nuevo ivr
    */
    $(document).on("click", ".newIvr", function(e) {
        event.preventDefault();
        $('#tituloModal').html('Agregar Ivr');
        $('#action').removeClass('deleteIvr');
        $('#action').addClass('saveIvr');

        let url = currentURL + "/Ivr/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
    * Evento para guardar el nuevo agente
    */
    $(document).on('click', '.saveIvr', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let mensaje_bienvenida_id = $("#mensaje_bienvenida_id").val();
        let tiempo_espera = $("#tiempo_espera").val();
        let mensaje_tiepo_espera_id = $("#mensaje_tiepo_espera_id").val();
        let mensaje_opcion_invalida_id = $("#mensaje_opcion_invalida_id").val();
        let repeticiones = $("#repeticiones").val();
        let Empresas_id = $("#Empresas_id").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/Ivr';

        $.post(url, {
            nombre: nombre,
            mensaje_bienvenida_id: mensaje_bienvenida_id,
            tiempo_espera: tiempo_espera,
            mensaje_tiepo_espera_id: mensaje_tiepo_espera_id,
            mensaje_opcion_invalida_id: mensaje_opcion_invalida_id,
            repeticiones: repeticiones,
            Empresas_id: Empresas_id,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);

            $('.viewResult #tableivr').DataTable({
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
    * Evento para eliminar un IVR
    *
    */
    $(document).on('click', '.deleteIvr', function(event) {
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
                let url = currentURL + '/Ivr/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableivr').DataTable({
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
     * Evento para seleccionar un IVR
     */
    $(document).on('click', '#tableivr tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".deleteIvr").slideDown();
        $(".editIvr").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableivr tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });;
    /**
     * Evento para visualizar la configuración del IVR y editarlo
     */
    $(document).on('click', '.editIvr', function(event) {

        event.preventDefault();
        var id = $("#idSeleccionado").val();
        var url = currentURL + '/Ivr/' + id + '/edit';

        $('#tituloModal').html('Editar Ivr');
        $('#action').addClass('updateIvr');
        $('#action').removeClass('saveIvr');

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
     * Evento para guardar los cambios del IVR
     */
    $(document).on('click', '.updateIvr', function(event) {
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
    let url = currentURL + '/Ivr/' + id;
    
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
        
        $('.viewResult #tableivr').DataTable({
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