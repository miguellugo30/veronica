/*
var validNavigation = false;

window.onbeforeunload = function() {
    if (!validNavigation) {

        var id_agente = $('#id_agente').val();
        let _token = $("input[name=_token]").val();
        let id_evento = $('#id_evento').val();
        let cierre = 1;

        $.ajax({
            type: 'POST',
            async: false,
            url: 'logout/agentes',
            data: {
                id_agente: id_agente,
                id_evento: id_evento,
                cierre: cierre,
                _token: _token
            },
            success: function(data) {}
        });

    }
}
*/
function my_onkeydown_handler(event) {
    switch (event.keyCode) {
        case 116: // 'F5'
            event.preventDefault();
            event.keyCode = 0;
            window.status = "F5 disabled";
            break;
    }
}
document.addEventListener("keydown", my_onkeydown_handler);

$(function() {

    $(document).on("click", ".nav-link", function(e) {
        $('.nav-link').attr('data-toggle', 'tab');
        //let id = $(this).attr('href');
        //$(".tab-pane").removeClass('active');
        //$(id).addClass('active');
    });

    $(document).on("click", ".close", function(e) {
        $('.nav-link').attr('data-toggle', 'control-sidebar');
    });

});

document.addEventListener('DOMContentLoaded', function() {
    /*
    var initialLocaleCode = 'es';
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['list'],
        timeZone: 'UTC',
        defaultView: 'listDay',
        titleFormat: { year: 'numeric', month: 'short', day: 'numeric' },
        views: {
            listDay: { buttonText: 'Dia' },
            listWeek: { buttonText: 'Semana' },
            listMonth: { buttonText: 'Mex' }
        },
        locale: initialLocaleCode,
        header: {
            left: 'title',
            center: '',
            right: 'listDay,listWeek,listMonth'
        },
        events: 'https://fullcalendar.io/demo-events.json'
    });

    calendar.render();
    */
    var id_agente = $('#id_agente').val();
    var timer = null;
    let currentURL = window.location.href.split('?');

    function start() { //use a one-off timer
        timer = setInterval(function() {
            $.ajax({
                method: "GET",
                url: currentURL[0] + "/" + id_agente, // Podrías separar las funciones de PHP en un fichero a parte
                data: {}
            }).done(function(msg) {
                var obj = $.parseJSON(msg);

                if (obj['status'] == 1) {

                    if (obj['monitoreo'] == 0) {
                        stop();
                    }

                    $(".estado-agente").html("<i class='fa fa-circle text-danger'></i> " + obj['estado']);
                    $(".colgar-llamada").prop("disabled", false);

                    $.get(currentURL[0] + "/" + id_agente + "/edit", function(data, textStatus, jqXHR) {
                        $(".viewResult").html(data);
                        $(".historico-llamadas").DataTable({
                            "searching": false,
                            "lengthChange": false,
                            "iDisplayLength": 5,
                            "responsive": true,
                            language: {
                                url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
                            }
                        });
                    });

                } else if (obj['status'] == 2) {

                    if (obj['monitoreo'] == 0) {
                        stop();
                    }

                    $(".estado-agente").html("<i class='fa fa-circle text-danger'></i> " + obj['estado']);
                    $("#modal-no-disponible").modal({ backdrop: 'static', keyboard: false });

                } else if (obj['status'] == 0) {

                    if (obj['monitoreo'] == 1) {
                        $(".viewResult").html('<div class="col-12 text-center" style="padding-top: 19%;"><i class="fas fa-spinner fa-10x fa-spin text-info"></i></div>');
                        $(".colgar-llamada").prop("disabled", true);
                    }
                }
            });
        }, 3000);
    };

    function stop() {
        clearInterval(timer);
    };

    start();

    $(document).on("click", ".calificar-llamada", function(e) {
        stop();

        let id_agente = $('#id_agente').val();
        let canal = $("#canal").val();
        let canal_entrante = $("#canal_entrante").val();
        let id_calificacion = $("#calificacionLlamada option:selected").data('calificacionid');
        let uniqueid = $("#uniqueid").val();
        let _token = $("input[name=_token]").val();
        let datosFormulario = $(".formularioView").serializeArray();

        $.ajax({
            method: "POST",
            url: currentURL[0], // Podrías separar las funciones de PHP en un fichero a parte
            data: {
                canal: canal,
                uniqueid: uniqueid,
                id_calificacion: id_calificacion,
                id_agente: id_agente,
                canal_entrante: canal_entrante,

                datosFormulario: datosFormulario,
                _token: _token
            }
        }).done(function(msg) {
            $(".viewResult").html(msg);
            $(".viewResult").html('<div class="col-12 text-center" style="padding-top: 19%;"><i class="fas fa-spinner fa-10x fa-spin text-info"></i></div>');
            $(".estado-agente").html("<i class='fa fa-circle text-success'></i> Disponible");
            $(".colgar-llamada").prop("disabled", true);
            start();
        });
    });

    $(document).on("change", "#no_disponible", function(e) {

        let no_disponible = $(this).val();
        let id_agente = $('#id_agente').val();
        let no_disponible_text = $('select[name="no_disponible"] option:selected').text();
        let _token = $("input[name=_token]").val();

        $('#title-no-disponible').html(no_disponible_text);

        if (no_disponible != '0') {
            $.ajax({
                method: "POST",
                url: currentURL[0] + "/no_disponible", // Podrías separar las funciones de PHP en un fichero a parte
                data: {
                    no_disponible: no_disponible,
                    no_disponible_text: no_disponible_text,
                    id_agente: id_agente,
                    _token: _token
                }
            }).done(function(msg) {
                $("#modal-no-disponible .modal-body").html(msg)
                $("#modal-no-disponible").modal({ backdrop: 'static', keyboard: false });
            });
        }
    });

    $(document).on("click", "#agente-disponible", function(e) {

        let agente = $('#agente_evento').val();
        let evento = $('#id_no_disponible').val();
        let _token = $("input[name=_token]").val();

        if (no_disponible != '') {
            $.ajax({
                method: "POST",
                url: currentURL[0] + "/agente_disponible", // Podrías separar las funciones de PHP en un fichero a parte
                data: {
                    agente: agente,
                    evento: evento,
                    _token: _token
                }
            }).done(function(msg) {
                $(".estado-agente").html("<i class='fa fa-circle text-success'></i> Disponible");
                $('#no_disponible option[value="0"]').attr("selected", true);
                $("#modal-no-disponible").modal('hide');
                $("#modal-no-disponible .modal-body").html('')
                start();
            });
        }
    });
    /**
     * Evento para transferir llamadas
     */
    $(document).on('click', '#realizar-transferir-llamada', function(event) {

        let idAgente = $("#id_agente").val();
        let canal = $("#canal_entrante").val();
        let destino_transferencia = $("#destino_transferencia").val();
        let opciones_transferencia = $("#opciones").val();
        let id_empresa = $("#id_empresa").val();
        let uniqueid = $("#uniqueid").val();
        let _token = $("input[name=_token]").val();
        let transferirPantalla = null;

        if ($('#tranferir-pantalla').is(':checked')) {
            transferirPantalla = 1;
        } else {
            transferirPantalla = 0;
        }
        if (canal == null) {

            Swal.fire(
                'Error!',
                'No se puede transferir, sin tener una llamada activa.',
                'error'
            )

        } else {

            let url = currentURL[0].replace('agentes/') + '/transferir-llamada';

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    idAgente: idAgente,
                    canal: canal,
                    destino_transferencia: destino_transferencia,
                    opciones_transferencia: opciones_transferencia,
                    id_empresa: id_empresa,
                    uniqueid: uniqueid,
                    transferirPantalla: transferirPantalla,
                    _token: _token
                },
                success: function(result) {
                    console.log(result);
                    $("#modal-transferencia").modal('hide');
                }
            });

        }

    });
    /**
     * Evento para transferir llamadas
     */
    $(document).on('click', '#realizar-conferencia-llamada', function(event) {

        let idAgente = $("#id_agente").val();
        let canal = $("#canal").val();
        let canal_entrante = $("#canal_entrante").val();
        let destino_conferencia = $("#destino_conferencia").val();
        let opciones_conferencia = $("#opciones_conf").val();
        let id_empresa = $("#id_empresa").val();
        let uniqueid = $("#uniqueid").val();
        let _token = $("input[name=_token]").val();

        if (canal_entrante == null) {

            Swal.fire(
                'Error!',
                'No se puede transferir, sin tener una llamada activa.',
                'error'
            )

        } else {

            let url = currentURL[0].replace('agentes/') + '/conferencia-llamada';

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    idAgente: idAgente,
                    canal: canal,
                    canal_entrante: canal_entrante,
                    destino_conferencia: destino_conferencia,
                    opciones_conferencia: opciones_conferencia,
                    id_empresa: id_empresa,
                    uniqueid: uniqueid,
                    _token: _token
                },
                success: function(result) {
                    console.log(result);
                    $("#modal-transferencia").modal('hide');
                }
            });

        }

    });
});
