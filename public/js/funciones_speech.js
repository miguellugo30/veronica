$(function() {

    currentURL = window.location.href.replace('agentes/');

    url = currentURL.split('?');
    currentURL = url[0].replace('agentes/', '');

    $(document).on('click', '.opcion', function(event) {

        event.preventDefault();
        idOpcion = $(this).data('id');
        idSpeech = $(this).data('speech-id');

        let url = currentURL + '/speech/' + idOpcion;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $("#opcion_seleccionada_" + idSpeech).slideDown();
                $("#opcion_seleccionada_" + idSpeech).html(result);
            }
        });
    });
});