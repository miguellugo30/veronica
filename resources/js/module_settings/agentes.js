$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario editar agentes
     */
    $(document).on('click', '#tableAgentes tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".deleteAgente").slideDown();
        $(".editAgente").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableAgentes tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });;
    /**
     * Evento para eliminar el Agente
     *
     */
    $(document).on('click', '.deleteAgente', function(event) {
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
                let url = currentURL + '/Agentes/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableAgentes').DataTable({
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
    * Evento para mostrar el formulario de crear un nuevo Agente
    */
    $(document).on("click", ".newAgente", function(e) {
        event.preventDefault();
        $('#tituloModal').html('Alta de Agente');
        $('#action').removeClass('deleteAgente');
        $('#action').addClass('saveAgente');

        let url = currentURL + "/Agentes/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
    * Evento para visualizar la configuración del Agente
    */
   $(document).on('click', '.editAgente', function(event) {
        event.preventDefault();
        var id = $("#idSeleccionado").val();
        $('#tituloModal').html('Editar Agente');
        var url = currentURL + '/Agentes/' + id + '/edit';
        $('#action').addClass('updateAgente');
        $('#action').removeClass('saveAgente');
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
     * Evento para guardar los cambios del Agente
     */
    $(document).on('click', '.updateAgente', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');
        let id = $("#idSeleccionado").val();
        let dataForm = $("#formDataAgente").serializeArray();

        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/Agentes/' + id;

        $.post(url, {
            dataForm: dataForm,
            _method: _method,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
        });

    });
    /**
     * Evento para guardar el nuevo agente
     */
    $(document).on('click', '.saveAgente', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let dataForm = $("#altaagente").serializeArray();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/Agentes';

        $.post(url, {
            dataForm: dataForm,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
        });

    });


});
