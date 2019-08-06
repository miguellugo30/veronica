$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".sub-menu li", function(e) {

        e.preventDefault();
        let id = $(this).data("id");

        if (id == 6) {
            url = currentURL + '/usuarios';
            table = ' #tableUsuarios';
        } else if (id == 4) {
            url = currentURL + '/menus';
            table = '';
        } else if (id == 3) {
            url = currentURL + '/modulos';
            table = ' #tableModulos';
        } else if (id == 1) {
            url = currentURL + '/distribuidor';
            table = ' #tableDistribuidores';
        } else if (id == 8) {
            url = currentURL + '/did';
            table = ' #tableDid';
        } else if (id == 10) {
            url = currentURL + '/cat_empresa';
            table = ' #tableEdoEmp';
        } else if (id == 11) {
            url = currentURL + '/cat_ip_pbx';
            table = ' #tablePbx';
        } else if (id == 12) {
            url = currentURL + '/cat_nas';
            table = ' #tableNas';
        } else if (id == 13) {
            url = currentURL + '/cat_agente';
            table = ' #tableEdoAge';
        } else if (id == 14) {
            url = currentURL + '/cat_cliente';
            table = ' #tableEdoCli';
        } else if (id == 9) {
            url = currentURL + '/troncales';
            table = ' #tableTroncales';
        } else if (id == 15) {
            url = currentURL + '/canales';
            table = ' #tableCanales';
        } else if (id == 2) {
            url = currentURL + '/empresas';
            table = ' #tableEmpresas';
        } else if (id == 16) {
            url = currentURL + '/basedatos';
            table = ' #tableBaseDatos';
        } else if (id == 17) {
            url = currentURL + '/cat_tipo_canales';
            table = ' #tableTiposCanal';
        } else if (id == 19) {
            url = currentURL + '/licencias_bria';
            table = ' #licencias_bria';
        } else if (id == 20) {
            url = currentURL + '/logs';
            table = ' #tableLogs';
        } else if (id == 21) {
            url = currentURL + '/formularios';
            table = ' #tableFormularios';
        }

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewResult").html(data);
            if (id != 4) {
                $('.viewResult' + table).DataTable({
                    "lengthChange": true
                });
            }
        });
    });
});