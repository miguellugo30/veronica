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

        $(".tableCampanas tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para regresar
     */
    $(document).on('click', '.returnCampana', function(event) {
        event.preventDefault();
        url = currentURL + 'outbound/campanas';
        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewResult").html(data);
            $('.viewResult' + table).DataTable({
                "lengthChange": true
            });
        });
    });
    /**
     * Evento para iniciar campaña
     */
    $(document).on('click', '.startCampana', function(event) {
        event.preventDefault();

        let campana_id = $("#idSeleccionado").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + 'outbound/campanas/iniciar-campana';

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                campana_id:campana_id,
                _token: _token
            },
            success: function(result) {
                $(".viewResult").html(result);
            }
        });
    });
    /**
     * Evento para detener campaña
     */
    $(document).on('click', '.endCampana', function(event) {
        event.preventDefault();

        let campana_id = $("#idSeleccionado").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + 'outbound/campanas/detener-campana';

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                campana_id:campana_id,
                _token: _token
            },
            success: function(result) {
                $(".viewResult").html(result);
            }
        });
    });
    /**
     * Evento para mostrar las campanas
     */
    $(document).on('dblclick', '#tableCampanas tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        let url = currentURL + 'outbound/campanas/'+id;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $(".viewResult").html(result);
            }
        });

        $(".tableCampanas tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });

    /**
     * Evento para mostrar el formulario para crear la nueva campana
     */
    $(document).on("click", ".newCampanaOutbound", function(e) {
        e.preventDefault();

        $('#tituloModal').html('Nueva Campaña');
        let url = currentURL + 'outbound/campanas/create';
        agentesParticipantes = new Array();

        $('#action').removeClass('updateCampanaOutbound');
        $('#action').addClass('saveCampanaOutbound');

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
     * Seleccionar todos los no seleccionados
     */
    $(document).on('change', '#strategy', function(event) {

        if ( $(this).val() == 'predictivo' ) {
            $("#opcion_predictivo").slideDown();
        }else{
            $("#opcion_predictivo").slideUp();
        }

    });
    /**
     * Evento para guardar la nueva campana
     */
    $(document).on('click', '.saveCampanaOutbound', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let agentesParticipantes = $("#agentes_participantes").val();
        let mlogeo = $("#mlogeo").val();
        let strategy = $("#strategy").val();
        let wrapuptime = $("#wrapuptime").val();
        let no_intentos = $("#no_intentos").val();
        let script = $("#script").val();
        let bd = $("#bd").val();
        let calificacion = $("#calificacion").val();
        let dids = $("#dids").val();
        let llamadas_agente = $("#llamadas_agente").val();
        let msginical = $("#msginical").val();
        let _token = $("input[name=_token]").val();

        if (llamadas_agente == '') {
            llamadas_agente = 1;
        }

        let url = currentURL + 'outbound/campanas';

        $.ajax({
                url: url,
                type: "post",
                data: {
                    nombre: nombre,
                    agentesParticipantes: agentesParticipantes,
                    mlogeo: mlogeo,
                    strategy: strategy,
                    wrapuptime: wrapuptime,
                    no_intentos: no_intentos,
                    script: script,
                    bd: bd,
                    calificacion: calificacion,
                    dids: dids,
                    llamadas_agente: llamadas_agente,
                    msginical: msginical,
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
            let url = currentURL + 'outbound/campanas/validar_modo_logueo';
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
     * Evento para visualizar la configuración de la campana
     */
     $(document).on('click', '.editCampanaOutbound', function(event) {
        event.preventDefault();
        var id = $("#idSeleccionado").val();
        $('#tituloModal').html('Detalles de Campana');
        var url = currentURL + 'outbound/campanas/' + id + '/edit';

        $('#action').addClass('updateCampanaOutbound');
        $('#action').removeClass('saveCampanaOutbound');

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
     * Evento para guardar la nueva campana
     */
     $(document).on('click', '.updateCampanaOutbound', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let agentesParticipantes = $("#agentes_participantes").val();
        let mlogeo = $("#mlogeo").val();
        let strategy = $("#strategy").val();
        let wrapuptime = $("#wrapuptime").val();
        let no_intentos = $("#no_intentos").val();
        let script = $("#script").val();
        let bd = $("#bd").val();
        let calificacion = $("#calificacion").val();
        let dids = $("#dids").val();
        let llamadas_agente = $("#llamadas_agente").val();
        let msginical = $("#msginical").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let id = $("#idSeleccionado").val();

        if (llamadas_agente == '') {
            llamadas_agente = 1;
        }

        let url = currentURL + 'outbound/campanas/'+ id ;

        $.ajax({
                url: url,
                type: "post",
                data: {
                    nombre: nombre,
                    agentesParticipantes: agentesParticipantes,
                    mlogeo: mlogeo,
                    strategy: strategy,
                    wrapuptime: wrapuptime,
                    no_intentos: no_intentos,
                    script: script,
                    bd: bd,
                    calificacion: calificacion,
                    dids: dids,
                    llamadas_agente: llamadas_agente,
                    msginical: msginical,
                    _token: _token,
                    _method: _method
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
