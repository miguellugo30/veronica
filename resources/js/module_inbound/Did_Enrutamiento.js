$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para seleccionar un Enrutamiento
     */
    $(document).on('click', '#tabledidenrutamientos tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        //$(".deletedidenrutamiento").slideDown();
        $(".editdidenrutamiento").slideDown();
        $("#idSeleccionado").val(id);

        $("#tabledidenrutamientos tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });;
    /**
     * Evento para Configurar el enrutamiento
     */
    $(document).on('click', '.editdidenrutamiento', function(event) {

        event.preventDefault();
        var id = $("#idSeleccionado").val();
        var url = currentURL + '/Did_Enrutamiento/' + id + '/edit';

        $('#tituloModal').html('Editar Enrutamiento');
        $('#action').addClass('updatedidenrutamiento');
        $('#action').removeClass('savedidenrutamiento');

        $.ajax({
            url: url,
            type: 'GET',
            success: function success(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);
                $("#condicion tbody").sortable();
            }
        });
    });
    /**
     * Evento para actualizar el enrutamiento
     */
    $(document).on('click', '.updatedidenrutamiento', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let dataForm = $("#formDataEnrutamiento").serializeArray();
        let _method = "PUT";
        var id = $("#idSeleccionado").val();
        let _token = $("input[name=_token]").val();

        let url = currentURL + '/Did_Enrutamiento/' + id;

        $.ajax({
                url: url,
                type: "post",
                data: {
                    dataForm: dataForm,
                    _method: _method,
                    _token: _token
                },
            })
            .done(function(data) {
                $('.viewResult').html(data);
                $('.viewResult #tableCondicionTiempo').DataTable({
                    "lengthChange": false
                });
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido actualizado.',
                    'success'
                )
            });
    });

    /**
     * Accion para mostrar las opciones en base al destino seleccionado
     */
    $(document).on('change', '.destino', function(event) {
        let nombre = $(this).attr('name');
        let opccion = $(this).val();
        let _token = $("input[name=_token]").val();

        nombre = nombre.replace('destino_', '');

        let id = 0 + '&' + opccion + '&' + nombre;
        let url = currentURL + '/Did_Enrutamiento/' + id;

        $.ajax({
                url: url,
                type: "GET",
                data: {
                    _token: _token
                },
            })
            .done(function(data) {

                $('#opcionesDestino_' + nombre).html(data);

            });
    });
    /**
     * Evento para agregar una condición de tiempo adicional
     */
    $(document).on('click', '#addRuta', function(event) {

        var clickID = $("#condicion tbody tr.clonar:last").attr('id').replace('tr_', '');
        // Genero el nuevo numero id
        var newID = parseInt(clickID) + 1;

        let IDInput = ['id_campo', 'descripcion_campo', 'destino'];

        fila = $("#condicion tbody tr:eq()").clone().appendTo("#condicion"); //Clonamos la fila

        for (let i = 0; i < IDInput.length; i++) {
            fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
        }

        fila.find('.opcionesDestino').attr('id', "opcionesDestino_" + newID);

        fila.find('.form-control').attr('value', '');
        fila.find('.btn-danger').css('display', 'initial');
        fila.attr("id", 'tr_' + newID);
    });
    /**
     * Evento para eliminar una fila de la tabla de nueva condicion de tiempo
     */
    $(document).on('click', '.tr_remove', function() {
        let tr = $(this).closest('tr');
        tr.remove();
    });
    /**
     * Evento para eliminar una fila de la tabla de nueva condicion de tiempo
     */
    $(document).on('click', '.tr_edit_remove', function() {
        let tr = $(this).closest('tr');
        let id = $(this).data('id');
        let _method = "DELETE";
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/Did_Enrutamiento/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: _token,
                _method: _method
            },
            success: function(result) {
                tr.remove();
            }
        });
    });
});;
