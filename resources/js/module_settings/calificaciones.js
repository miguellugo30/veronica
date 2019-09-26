$(function() {

    var currentURL = window.location.href;
    /**
     * Evento que muestra elemento calificaciones || esta funcion muestra con slide los botones de Eliminar y Editar
     */
    $(document).on('click', '#tableCalificaciones tbody tr', function(event) {
         
        /* Para que nunca tome los refresh, preventivo*/
       /* event.preventDefault(); 
        let id = $(this).data("id");
        $(".editCalificaciones").slideDown();
        $(".deleteCalificaciones").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableCalificaciones tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
        */
        
        event.preventDefault();
        let id = $(this).data("id");
        $(".dropleft").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableFormulario tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');

        
    });
        

    /**
     * Evento para mostrar el formulario de crear un nueva calificacion
     */
    $(document).on("click", ".newCalificaciones", function(e) {
        e.preventDefault();

        $('#tituloModal').html('Nuevo Grupo Calificaciones');
                
        let url = currentURL + '/calificaciones/create';

        $('#action').removeClass('updateCalificaciones');
        $('#action').addClass('saveCalificaciones');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);
            }
        });
    });  
     
    /**
    * Evento para obtener el valor del tipo de Formulario LD
    */
    $(document).on('change', '#tipo_marcacion', function(event) {

        let pos = $(this).data('pos');
        let id_Tipo_Marcacion = $(this).val();
        
        alert(pos + '+'+id_Tipo_Marcacion);

        
    });
   
    /**
     * Evento para guardar Nuevas Calificaciones
     */
    $(document).on('click', '.saveCalificaciones', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let dataForm = $("#formDataCalificaciones").serializeArray();

        let _token = $("input[name=_token]").val();
        let url = currentURL + '/calificaciones';

        $.post(url, {
            dataForm: dataForm,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
        });

    });
    
    
     /**
     * Evento para eliminar la Calificacion
     
     *
     */
    $(document).on('click', '.deleteCalificaciones', function(event) {
        event.preventDefault();
        /**Modal de Alerta Swal.fire**/
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
                let url = currentURL + '/calificaciones/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableCalificaciones').DataTable({
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
    * Evento para visualizar un registro
    */
    $(document).on('click', '.editCalificaciones', function(event) {
        event.preventDefault();
        var id = $("#idSeleccionado").val();
        $('#tituloModal').html('Detalles de Calificaciones');
        var url = currentURL + '/calificaciones/' + id + '/edit';
        $('#action').addClass('updateCalificaciones');
        $('#action').removeClass('saveCalificaciones');
        $.ajax({
            url: url,
            type: 'GET',
            success: function success(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);
            }
        });
    });

        
    
});
