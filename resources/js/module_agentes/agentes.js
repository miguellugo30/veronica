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
    var initialLocaleCode = 'es';
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['list'],
        timeZone: 'UTC',
        defaultView: 'listDay',
        titleFormat: { year: 'numeric', month: 'short', day: 'numeric' },
        // customize the button names,
        // otherwise they'd all just say "list"
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

    var id_agente = $('#id_agente').val();
    var timer = null;

    function start() { //use a one-off timer
        timer = setInterval(function() {
            $.ajax({
                method: "GET",
                url: "agentes/" + id_agente, // Podrías separar las funciones de PHP en un fichero a parte
                data: {}
            }).done(function(msg) {

                var obj = $.parseJSON(msg);

                if (obj['status'] != 0) {

                    stop();

                    $(".estado-agente").html("<i class='fa fa-circle text-danger'></i> " + obj['estado']);

                    $.get("agentes/" + id_agente + "/edit", function(data, textStatus, jqXHR) {
                        $(".view-call").html(data);
                    });

                }
            });
        }, 3000);
    };

    function stop() {
        clearInterval(timer);
    };

    start();

    $(document).on("click", ".calificar-llamada", function(e) {

        let id_agente = $('#id_agente').val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            method: "POST",
            url: "/agentes", // Podrías separar las funciones de PHP en un fichero a parte
            data: {
                id_agente: id_agente,
                _token: _token
            }
        }).done(function(msg) {

            console.log(msg)
            $(".view-call").html('');
            $(".estado-agente").html("<i class='fa fa-circle text-success'></i> Disponible");
            start();

        });
    });
});