$(function() {

    currentURL = window.location.href;

    $(document).on('click', '#btn_bloque_ocultos', function(event) {
        $('#bloque_oculto').slideToggle();
        link.removeEventListener('click', clickHandler, false);
    });

    $(document).on('change', '.formularioView select', function(event) {

        event.preventDefault();
        idOpc = $(this).val();
        idCampo = $(this).data('id');

        let url = currentURL + '/formularios/' + idOpc;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $("#viewSubForm_" + idCampo).html(result);
            }
        });

    });

});
