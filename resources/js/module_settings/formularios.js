$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario editar formularios
     */
    $(document).on('click', '#tableFormulario tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".editFormulario").slideDown();
        $(".deleteFormulario").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableFormulario tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });

     /**
     * Evento para eliminar el distribuidores
     *
     */
    $(document).on('click', '.deleteFormulario', function(event) {
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
                let url = currentURL + '/formularios/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableFormulario').DataTable({
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

