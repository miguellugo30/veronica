$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newLicencia", function(e) {

        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/licencias_bria/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
    });
    /**
     * Evento para cancelar la creacion/edicion de una licencia
     */
    $(document).on("click", ".cancelLicencia", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveLicencia', function(event) {
        event.preventDefault();

        let licencia = $("#licencia").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/licencias_bria';

        $.post(url, {
            licencia: licencia,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewIndex #licencias_bria').DataTable({
                "lengthChange": true
            });
        });
    });
});