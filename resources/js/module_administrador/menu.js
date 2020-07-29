$(function() {
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".sub-menu", function(e) {
        e.preventDefault();

        let currentURL = window.location.href;
        let id = $(this).attr('id');

        if (id == 'sub-1') {
            url = currentURL + '/distribuidor';
            table = ' #tableDistribuidores';
        } else if (id == 'sub-2') {
            url = currentURL + '/empresas';
            table = ' #tableEmpresas';
        } else if (id == 'sub-3') {
            url = currentURL + '/modulos';
            table = ' #tableModulos';
        } else if (id == 'sub-4') {
            url = currentURL + '/menus';
            table = '#tableMenus';
        } else if (id == 'sub-5') {
            url = currentURL + '/usuarios';
            table = ' #tableUsuarios';
        } else if (id == 'sub-7') {
            url = currentURL + '/did';
            table = ' #tableDid';
        } else if (id == 'sub-8') {
            url = currentURL + '/troncales';
            table = ' #tableTroncales';
        } else if (id == 'sub-9') {
            url = currentURL + '/cat_empresa';
            table = ' #tableEdoEmp';
        } else if (id == 'sub-10') {
            url = currentURL + '/cat_ip_pbx';
            table = ' #tablePbx';
        } else if (id == 'sub-11') {
            url = currentURL + '/cat_nas';
            table = ' #tableNas';
        } else if (id == 'sub-12') {
            url = currentURL + '/cat_agente';
            table = ' #tableEdoAge';
        } else if (id == 'sub-13') {
            url = currentURL + '/cat_cliente';
            table = ' #tableEdoCli';
        } else if (id == 'sub-14') {
            url = currentURL + '/canales';
            table = ' #tableCanales';
        } else if (id == 'sub-15') {
            url = currentURL + '/basedatos';
            table = ' #tableBaseDatos';
        } else if (id == 'sub-16') {
            url = currentURL + '/cat_tipo_canales';
            table = ' #tableTiposCanal';
        } else if (id == 'sub-17') {
            url = currentURL + '/licencias_bria';
            table = ' #licencias_bria';
        } else if (id == 'sub-18') {
            url = currentURL + '/logs';
            table = '#tableLogs';
        } else if (id == 'sub-34') {
            url = currentURL + '/cat_campos_plantillas';
            table = ' #tableCamPla';
        }
        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewResult").html(data);
            if (id != 4 || id != 20) {
                /*$('.viewResult' + table).DataTable({
                    "lengthChange": true
                });*/
            }
        });

    });
});
