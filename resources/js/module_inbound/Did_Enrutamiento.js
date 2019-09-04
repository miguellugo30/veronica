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
            }
        });
    });


});;
