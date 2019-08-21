$(function() {

    idFormPr = $("#idForm").val();
    currentURL = window.location.href;

    $(document).on('click', '#btn_bloque_ocultos', function(event) {
        $('#bloque_oculto').slideToggle();
        link.removeEventListener('click', clickHandler, false);
    });

    console.log(idFormPr);

    $(document).on('change', '#' + idFormPr + ' select', function(event) {

        link.removeEventListener('click', clickHandler, false);

        event.preventDefault();
        idOpc = $(this).val();
        idCampo = $(this).data('id');

        console.log(idOpc);
        console.log(idCampo);

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
