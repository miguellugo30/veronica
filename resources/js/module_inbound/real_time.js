$(function() {
    let currentURL = window.location.href;
    /**
     * Evento para mostrar la pantalla del agente seleccionado
     */
    $(document).on("click", ".iniciar_monitoreo", function(e) {
        event.preventDefault();
        let idAgente = parseint($(this).data('id'));
        let url = currentURL + "/real_time/agente/" + idAgente;
        let tab = window.open(url, '_blank');

        $('.iniciar_monitoreo').prop('disabled', true);

        if (tab) {
            tab.focus(); //ir a la pestaña
        } else {
            alert('Pestañas bloqueadas, activa las ventanas emergentes (Popups) ');
            return false;
        }
    });

});