$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar las campanas
     */
    $(document).on('click', '#tableCampanas tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".editCampana").slideDown();
        $(".deleteCampana").slideDown();


        $("#idSeleccionado").val(id);

        $("#tableCampanas tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para eliminar Campana
     *
     */
    $(document).on('click', '.deleteCampana', function(event) {
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
                let url = currentURL + '/campanas/' + id;
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableCampanas').DataTable({
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
     * Evento para mostrar el formulario para crear la nueva campana
     */
    $(document).on("click", ".newCampana", function(e) {
        e.preventDefault();

        $('#tituloModal').html('Nueva Campaña');
        let url = currentURL + '/campanas/create';

        $('#action').removeClass('updateCampana');
        $('#action').addClass('saveCampana');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $('#modal').modal('show');
                $("#modal-body").html(result);
            }
        });
    });


});
