$(function() {
    let currentURL = window.location.href;
    /**
     * Evento para mostrar la pantalla del agente seleccionado
     */
    $(document).on("click", ".fa-desktop", function(e) {
        event.preventDefault();
        let idAgente = $(this).data('id');

        let url = currentURL + "/real_time/agente/" + idAgente;
        console.log(idAgente);
        var tab = window.open(url, '_blank');
        if (tab) {
            tab.focus(); //ir a la pestaña
        } else {
            alert('Pestañas bloqueadas, activa las ventanas emergentes (Popups) ');
            return false;
        }
    });

});
