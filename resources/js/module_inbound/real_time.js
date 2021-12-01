$(function() {
    let currentURL = window.location.href;
    /**
     * Evento para mostrar la pantalla del agente seleccionado
     */
    $(document).on("click", ".iniciar_monitoreo", function(e) {
        event.preventDefault();
        let idAgente = $(this).data('id');
        let url = currentURL + "inbound/real_time/agente/" + idAgente;
        let tab = window.open(url, '_blank');

        if (tab) {
            tab.focus(); //ir a la pestaña
        } else {
            alert('Pestañas bloqueadas, activa las ventanas emergentes (Popups) ');
            return false;
        }
    });
    $(document).on("click", ".detener_monitoreo", function(e) {
        event.preventDefault();
        let idAgente = $(this).data('id');
        let url = currentURL + "inbound/real_time/detener/" + idAgente;

        $.get(url, function(data, textStatus, jqXHR) {
            console.log(data);
        });
    });

});
