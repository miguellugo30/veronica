$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".generarReporteLlamadasAgentes", function(e) {

        let url = currentURL + 'inbound/ReporteLlamadasAgentes';
        let fecha_inicio = $("#fecha-inicio").val();
        let hora_inicio = $("#hora_inicio").val();
        let min_inicio = $("#min_inicio").val();

        let fecha_fin = $("#fecha-fin").val();
        let hora_fin = $("#hora_fin").val();
        let min_fin = $("#min_fin").val();

        dateInicio = fecha_inicio + " " + hora_inicio + ":" + min_inicio + ":00";
        dateFin = fecha_fin + " " + hora_fin + ":" + min_fin + ":00";

        let agente = $("#agente").val();
        let grupo = $("#grupo").val();
        let campana = $("#campana").val();
        let _token = $("input[name=_token]").val();

        if (agente == 0) {
            agente = 'NULL';
        }
        if (grupo == 0) {
            grupo = 'NULL';
        }
        if (campana == 0) {
            campana = 'NULL';
        }

        /**
         * Esto contrae el body
         */
        $('.filtro-reporte').slideUp();
        $('.nuevo-reporte').slideDown();
        $('#viewReporte').slideDown();
        e.preventDefault();

        $.ajax({
                url: url,
                type: "post",
                data: {
                    dateInicio: dateInicio,
                    dateFin: dateFin,
                    agente: agente,
                    grupo: grupo,
                    campana: campana,
                    _token: _token
                }
            })
            .done(function(data) {
                $('.viewReporte').html(data);
            });
    });
    /**
     * Evento para deshabilitar grupo o agentes, dependiendo
     * que opcion eligan
     */
    $(document).on('change', '.agente-grupo', function(event) {

        if (this.name == 'agente' && this.value != 0) {
            $("#grupo").prop('disabled', true);
            $("#agente").prop('disabled', false);
        } else if (this.name == 'grupo' && this.value != 0) {
            $("#grupo").prop('disabled', false);
            $("#agente").prop('disabled', true);
        } else if (this.name == 'agente' && this.value == 0) {
            $("#grupo").prop('disabled', false);
        } else if (this.name == 'grupo' && this.value == 0) {
            $("#agente").prop('disabled', false);
        }

    });
    /**
     * Evento para mostrar el formulario de crear un nuevo reporte
     */
    $(document).on("click", ".nuevo-reporte", function(e) {
        /**
         * Esto contrae el body
         */
        $('.viewReporte').html('');
        $('.filtro-reporte').slideDown();
        $('.nuevo-reporte').slideUp();
        $('#viewReporte').slideUp();
        e.preventDefault();
    });
});