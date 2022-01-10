$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar las campanas
     */
    $(document).on('click', '#tableCampanas tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".editCampana").slideDown();
        $(".deleteCampana").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableCampanas tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para eliminar Campana
     *
     */
    $(document).on('click', '.deleteCampana', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Estas seguro?',
            text: "Deseas eliminar el registro seleccionado!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                let id = $("#idSeleccionado").val();
                let _method = "DELETE";
                let _token = $("input[name=_token]").val();
                let url = currentURL + 'inbound/campanas/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableCampanas').DataTable({
                            "lengthChange": false
                        });
                        Swal.fire(
                            'Eliminado!',
                            'El registro ha sido eliminado.',
                            'success'
                        )
                    }
                });
            }
        });
    });
    /**
     * Evento para mostrar el formulario para crear la nueva campana
     */
    $(document).on("click", ".newCampana", function(e) {
        e.preventDefault();

        $('#tituloModal').html('Nueva Campaña');
        let url = currentURL + 'inbound/campanas/create';
        agentesParticipantes = new Array();

        $('#action').removeClass('updateCampana');
        $('#action').addClass('saveCampana');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);
            }
        });
    });
    /**
     * Evento para guardar la nueva campana
     */
    $(document).on('click', '.saveCampana', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let agentesParticipantes = $("#agentes_participantes").val();
        let mlogeo = $("#mlogeo").val();
        let strategy = $("#strategy").val();
        let wrapuptime = $("#wrapuptime").val();
        let msginical = $("#msginical").val();
        let periodic_announce = $("#periodic_announce").val();
        let periodic_announce_frequency = $("#periodic_announce_frequency").val();
        //let musicclass = $("#musicclass").val();
        let script = $("#script").val();
        let alertstll = $("#alertstll").val();
        let alertstdll = $("#alertstdll").val();
        let libta = $("#libta").val();
        let cal_lib = $("#cal_lib").val();
        let cal_camp = $("#cal_camp").val();
        let _token = $("input[name=_token]").val();

        let url = currentURL + 'inbound/campanas';

        $.ajax({
                url: url,
                type: "post",
                data: {
                    nombre: nombre,
                    agentesParticipantes: agentesParticipantes,
                    mlogeo: mlogeo,
                    strategy: strategy,
                    wrapuptime: wrapuptime,
                    msginical: msginical,
                    periodic_announce: periodic_announce,
                    periodic_announce_frequency: periodic_announce_frequency,
                    //musicclass: musicclass,
                    script: script,
                    alertstll: alertstll,
                    alertstdll: alertstdll,
                    libta: libta,
                    cal_lib: cal_lib,
                    cal_camp: cal_camp,
                    _token: _token
                },
            })
            .done(function(data) {
                $('.modal-backdrop ').css('display', 'none');
                $('#modal').modal('hide');

                $('.viewResult').html(data);
                $('.viewResult #tableCampanas').DataTable({
                    "lengthChange": false
                });
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )
                agentesParticipantes.length = 0;
            }).fail(function(data) {
                printErrorMsg(data.responseJSON.errors);
            });
    });
    /**
     * Evento para visualizar la configuración de la campana
     */
    $(document).on('click', '.editCampana', function(event) {
        event.preventDefault();
        var id = $("#idSeleccionado").val();
        $('#tituloModal').html('Detalles de Campana');
        var url = currentURL + 'inbound/campanas/' + id + '/edit';

        $('#action').addClass('updaCampanas');
        $('#action').removeClass('saveCampana');

        $.ajax({
            url: url,
            type: 'GET',
            success: function success(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);
                agentesParticipantes = JSON.parse($("#agentes_participantes").val());
            }
        });
    });
    /**
     * Evento para guardar los cambios de la campana
     */
    $(document).on('click', '.updaCampanas', function(event) {
        event.preventDefault();

        let id = $("#id").val();
        let nombre = $("#nombre").val();
        let agentesParticipantes = $("#agentes_participantes").val();
        let mlogeo = $("#mlogeo").val();
        let strategy = $("#strategy").val();
        let wrapuptime = $("#wrapuptime").val();
        let msginical = $("#msginical").val();
        let periodic_announce = $("#periodic_announce").val();
        let periodic_announce_frequency = $("#periodic_announce_frequency").val();
        //let musicclass = $("#musicclass").val();
        let script = $("#script").val();
        let alertstll = $("#alertstll").val();
        let alertstdll = $("#alertstdll").val();
        let libta = $("#libta").val();
        let cal_lib = $("#cal_lib").val();
        let cal_camp = $("#cal_camp").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + 'inbound/campanas/' + id;

        $.post(url, {
            nombre: nombre,
            agentesParticipantes: agentesParticipantes,
            mlogeo: mlogeo,
            strategy: strategy,
            wrapuptime: wrapuptime,
            msginical: msginical,
            periodic_announce: periodic_announce,
            periodic_announce_frequency: periodic_announce_frequency,
            //musicclass: musicclass,
            script: script,
            alertstll: alertstll,
            alertstdll: alertstdll,
            libta: libta,
            cal_lib: cal_lib,
            cal_camp: cal_camp,
            _token: _token,
            _method: _method,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('#modal').modal('hide');
            $('.modal-backdrop ').css('display', 'none');
            $('.viewResult').html(data);
            $('.viewResult #tableCampanas').DataTable({
                "lengthChange": false
            });
            Swal.fire(
                'Correcto!',
                'El registro ha sido editado.',
                'success'
            )
        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });
    });
    /**
     * Evento para agregar agentes a la campana
     */
    $(document).on('click', '.agentesNoSeleccionados', function(event) {

        let modoLogueo = $('#mlogeo').val();

        if (modoLogueo == "") {

            Swal.fire(
                '!Tenemos un problema!',
                'Tienes que elegir primero la modalidad de logueo a usar en esta campaña.',
                'warning'
            )

        } else {

            let _token = $("input[name=_token]").val();
            let url = currentURL + 'inbound/campanas/validar_modo_logueo';
            let agentesSeleccionados = [];
            let agentesDiferentes = [];
            let agentesValidos = [];

            $("input[name='agentes_no']:checked").each(function() {
                agentesSeleccionados.push(parseInt(this.value));
            });

            if (agentesSeleccionados.length == 0) {
                Swal.fire(
                    '!Tenemos un problema!',
                    'Tienes que elegir por lo menos un agente que participara en esta campaña.',
                    'warning'
                )
            } else {

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        idAgente: agentesSeleccionados
                    },
                    success: function success(result) {

                        for (let i = 0; i < agentesSeleccionados.length; i++) {

                            for (let j = 0; j < result.length; j++) {

                                if (agentesSeleccionados[i] === parseInt(result[j]['Agentes_id'])) {

                                    if (modoLogueo === result[j]['modalidad_logue']) {
                                        agentesValidos.push(agentesSeleccionados[i]);
                                    } else {
                                        agentesDiferentes.push(agentesSeleccionados[i]);
                                    }
                                }
                            }
                        }

                        if (agentesDiferentes.length > 0) {

                            for (let i = 0; i < agentesDiferentes.length; i++) {
                                $("#tr_" + agentesDiferentes[i]).css('background-color', '#ffc0c0');
                            }

                            Swal.fire(
                                '!Tenemos un problema!',
                                'No se puede agregar los agentes marcados en rojo, ya que esta campaña tiene diferente modalidad de logueo a las cuales ya estan agregados los agentes.',
                                'warning'
                            )
                        }

                        if (agentesValidos.length > 0) {

                            $('#todos_no_selec').prop('checked', false);

                            for (let i = 0; i < agentesValidos.length; i++) {

                                let fila = $("#tr_" + agentesValidos[i]);

                                fila.attr("background-color", '');
                                fila.clone().appendTo(".agenteSelec"); //Clonamos la fila

                                $(".agenteSelec #tr_" + agentesValidos[i]).css('background-color', '');
                                $(".agenteSelec #tr_" + agentesValidos[i] + " input[name='agentes_no']").prop('checked', false);

                                agentesParticipantes.push(agentesValidos[i]);
                                $("#agentes_participantes").val(JSON.stringify(agentesParticipantes));
                                fila.remove();
                            }
                        }
                    }
                });
            }
        }
    });
    /**
     * Evento para quitar agentes a la campana
     */
    $(document).on('click', '.agentesSeleccionados', function(event) {

        $('#todos_selec').prop('checked', false);

        $(".agenteSelec input[name='agentes_no']:checked").each(function() {

            let fila = $(".agenteSelec #tr_" + this.value);

            let index = agentesParticipantes.indexOf(parseInt(this.value));

            if (index > -1) {
                agentesParticipantes.splice(index, 1);
            }

            fila.clone().appendTo(".agentesNoSelec"); //Clonamos la fila
            fila.remove();
        });

        $(".agentesNoSelec input[name='agentes_no']").prop('checked', false);
        $("#agentes_participantes").val(JSON.stringify(agentesParticipantes));

    });

    $(document).on('change', '.mlogueoEditar', function(event) {

        event.preventDefault();
        let mLogueoInicial = $("#mlogueoInicial").val();

        Swal.fire({
            title: 'Estas seguro?',
            text: "Al cambiar la modalidad de logueo, se quitaran los agentes participantes, para evitar problemas con la modalidad de logueo en otras campañas en las que participen los agentes",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, quitar de campaña!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {

                let camapana_id = $("#id").val();
                let _token = $("input[name=_token]").val();
                let url = currentURL + 'inbound/campanas/eliminar-participantes';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        camapana_id: camapana_id
                    },
                    success: function(result) {
                        $(".agenteSelec tr").each(function() {
                            $(this).clone().appendTo(".agentesNoSelec");
                            let index = agentesParticipantes.indexOf($(this).data('id'));

                            if (index > -1) {
                                agentesParticipantes.splice(index, 1);
                            }
                            $("#agentes_participantes").val(JSON.stringify(agentesParticipantes));
                            $(this).remove();
                        });
                    }
                });

            } else {
                $('#mlogeo').val(mLogueoInicial);
            }
        });
    });
    /**
     * Seleccionar todos los no seleccionados
     */
    $(document).on('change', '#todos_no_selec', function(event) {
        $(".agentesNoSelec input[name='agentes_no']").prop('checked', $(this).prop("checked"));
    });
    /**
     * Seleccionar todos los seleccionados
     */
    $(document).on('change', '#todos_selec', function(event) {
        $(".agenteSelec input[name='agentes_no']").prop('checked', $(this).prop("checked"));
    });
    /**
     * Evento para capturar el nombre de la campana y mostrar en la etiqueta
     */
    $(document).on('keyup', '#nombre', function(event) {
        let valor = $('#nombre').val();
        $(".nombreCampana").text(valor);
    });
    /**
     * Funcion para mostrar los errores de los formularios
     */
    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $(".form-control").removeClass('is-invalid');
        for (var clave in msg) {
            $("#" + clave).addClass('is-invalid');
            if (msg.hasOwnProperty(clave)) {
                $(".print-error-msg").find("ul").append('<li>' + msg[clave][0] + '</li>');
            }
        }
    }
});
