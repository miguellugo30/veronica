var bPreguntar = true;

window.onbeforeunload = preguntarAntesDeSalir;

function preguntarAntesDeSalir() {
    if (bPreguntar)
        return "¿Seguro que quieres salir?";
}

/*
$(window).bind('beforeunload', function(e) {
    e.preventDefault();
    var id_agente = $('#id_agente').val();
    return '>>>>>Before You Go<<<<<<<< \n Your custom message go here';
    console.log(id_agente);
    if (window.btn_clicked) {
        console.log('confirmo');
    } else {
        console.log('no confirmo');
    }
});
*/

$(function() {

    $(document).on("click", ".nav-link", function(e) {
        $('.nav-link').attr('data-toggle', 'tab');
        let id = $(this).attr('href');
        $(".tab-pane").removeClass('active');
        $(id).addClass('active');
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

                    stop();

                    $(".estado-agente").html("<i class='fa fa-circle text-danger'></i> " + obj['estado']);
                    $(".colgar-llamada").prop("disabled", false);

                    $.get(currentURL[0] + "/" + id_agente + "/edit", function(data, textStatus, jqXHR) {
                        $(".view-call").html(data);
                        $(".historico-llamadas").DataTable({
                            "searching": false,
                            "lengthChange": false,
                            "iDisplayLength": 5
                        });
                    });

                } else if (obj['status'] == 2) {

                    stop();

                    $(".estado-agente").html("<i class='fa fa-circle text-danger'></i> " + obj['estado']);
                    $("#modal-no-disponible").modal({ backdrop: 'static', keyboard: false });

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
        let id_calificacion = $("#calificacion option:selected").data('calificacionid');
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
                datosFormulario: datosFormulario,
                _token: _token
            }
        }).done(function(msg) {
            $(".view-call").html(msg);
            $(".view-call").html('<div class="col-12 text-center" style="padding-top: 19%;"><i class="fas fa-spinner fa-10x fa-spin text-info"></i></div>');
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
                $("#modal-no-disponible  .modal-body").html(msg)
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
});
