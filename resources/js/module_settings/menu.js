$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".sub-menu", function(e) {

        e.preventDefault();
        let id = $(this).data("id");

        if (id == 'sub-21') {
            url = currentURL + '/formularios';
            table = ' #tableFormulario';
        } else if (id == 'sub-22') {
            url = currentURL + '/speech';
            table = ' #tableSpeech';
        } else if (id == 'sub-23') {
            url = currentURL + '/calificaciones';
            table = ' #tableCalificaciones';
        } else if (id == 'cat-17') {
            url = currentURL + '/Audios';
            table = ' #tableAudios';
        } else if (id == 'sub-28') {
            url = currentURL + '/Agentes';
            table = ' #tableAgentes';
        } else if (id == 'sub-29') {
            url = currentURL + '/Grupos';
            table = ' #tableGrupos';
        } else if (id == 'sub-35') {
            url = currentURL + '/EventosAgentes';
            table = ' #tableEventosAgentes';
        } else if (id == 'cat-28') {
            url = currentURL + '/Plantillas';
            table = ' #tablePlantillas';
        } else if (id == 'cat-30') {
            url = currentURL + '/PrefijosMarcacion';
            table = ' #tablePrefijosMarcacion';
        } else if (id == 'cat-31') {
            url = currentURL + '/Perfil_Marcacion';
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