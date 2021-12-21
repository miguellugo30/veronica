$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".sub-menu-settings", function(e) {

        e.preventDefault();
        let id = $(this).attr('id');

        if (id == 'sub-sub-21') {
            url = currentURL + 'settings/formularios';
            table = ' #tableFormulario';
        } else if (id == 'sub-sub-22') {
            url = currentURL + 'settings/speech';
            table = ' #tableSpeech';
        } else if (id == 'sub-sub-23') {
            url = currentURL + 'settings/calificaciones';
            table = ' #tableCalificaciones';
        } else if (id == 'sub-17') {
            url = currentURL + 'settings/Audios';
            table = ' #tableAudios';
        } else if (id == 'sub-sub-28') {
            url = currentURL + 'settings/Agentes';
            table = ' #tableAgentes';
        } else if (id == 'sub-sub-29') {
            url = currentURL + 'settings/Grupos';
            table = ' #tableGrupos';
        } else if (id == 'sub-sub-35') {
            url = currentURL + 'settings/EventosAgentes';
            table = ' #tableEventosAgentes';
        } else if (id == 'sub-28') {
            url = currentURL + 'settings/Plantillas';
            table = ' #tablePlantillas';
        } else if (id == 'sub-30') {
            url = currentURL + 'settings/PrefijosMarcacion';
            table = ' #tablePrefijosMarcacion';
        } else if (id == 'sub-29') {
            url = currentURL + 'settings/Base-Datos';
            table = ' #tableBaseDatos';
        } else if (id == 'sub-31') {
            url = currentURL + 'settings/Perfil_Marcacion';
            table = ' #tablePerfilMarcacion';
        }

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewResult").html(data);
            $('.viewResult' + table).DataTable({
                "lengthChange": true
            });
        });
    });
});
