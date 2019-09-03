$(function() {

    var currentURL = window.location.href;
    /**
     * Evento que muestra elemento calificaciones
     */
    $(document).on('click', '#tableCalificaciones tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".editCalificaciones").slideDown();
        $(".deleteCalificaciones").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableCalificaciones tbody tr").removeClass('table-primary');
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
    * Evento para obtener el valor del tipo de Formulario
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
 
        
    
});
