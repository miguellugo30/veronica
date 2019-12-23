$(function() {
    /**
     * Evento para mostrar los resultados en el DataTable
     */
    $(document).on('click', '.filtrar', function(event) {
        event.preventDefault();
        /**
         * Esto contrae el body
         */
        $('.body-filtro').slideUp();
        $('.nuevo-reporte').slideDown();
        $('#body-reporte').slideDown();

        var fechaI = $("#fechaIni").val();
        var fechaF = $("#fechaFin").val();
        var hrI = $("#hrIni").val();
        var hrF = $("#hrFin").val();
        var url = currentURL + '/grabaciones_voicemial';
        let _token = $("input[name=_token]").val();
        var fechaIni = (fechaI + " " + hrI + ":00");
        var fechaFin = (fechaF + " " + hrF + ":59");

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                fechaIni: fechaIni,
                fechaFin: fechaFin,
                _token: _token,
            },
            success: function(result) {
                $("#rangoFiltro").html(fechaIni + " -- " + fechaFin)
                $('.viewreportedesglose').html(result);
            }
        });
    });
    /**
     * Evento para mostrar el formulario de crear un nuevo ivr
     */
    $(document).on("click", ".nuevo-reporte", function(e) {
        /**
         * Esto contrae el body
         */
        $('.viewreportedesglose').html('');
        $('.body-filtro').slideDown();
        $('.nuevo-reporte').slideUp();
        $('#body-reporte').slideUp();
        $('.viewreportedesglose').html('');
        e.preventDefault();
    });
    /**
     * Evento para poder descargar el reporte
     */
    $(document).on("click", ".descargar-reporte", function(e) {
        /**
         * Con esto traemos las variables
         */
        var fechaI = $("#fechaIni").val();
        var fechaF = $("#fechaFin").val();
        var hrI = $("#hrIni").val();
        var hrF = $("#hrFin").val();
        var fechaIni = (fechaI + " " + hrI + ":00");
        var fechaFin = (fechaF + " " + hrF + ":59");

        let url = currentURL + "/grabaciones_voicemial/descargar/" + fechaIni + "/" + fechaFin;
        $('#iFrameDescarga').attr('src', url)
    });
    /**
     * Evento para descargar y escuchar la grabacion
     */
    $(document).on('click', '.escuchar-grabacion', function(event) {
        event.preventDefault();

        let grab = $(this).attr('id');
        let url = currentURL + '/grabaciones_voicemial/escuchar';
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                grab: grab,
                _token: _token,
            },
            success: function(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);
            }
        });
    });
    /**
     * Evento para marcar los checbox
     */
    $(document).on("click", '.checkall', function() {
        $(this)
            .closest("table")
            .find("tbody :checkbox")
            .prop("checked", this.checked)
            .closest("tr")
            .toggleClass("selected", this.checked);
    });
    /**
     * Limitar el numero de checkbox
     */
    $(document).on('change', 'input[name="numcheck"]', function(evt) {
        if ($('input[name="numcheck"]:checked').length > 10) {
            $(this).prop('checked', false)
            Swal.fire({
                title: 'Advertencia!',
                icon: 'warning',
                html: 'Solo se pueden seleccionar hasta <b>10 grabaciones</b> para descargar.',
                showCloseButton: true
            })
        }
    });
    /**
     * Evento para descargar las grabaciones en zip
     */
    $(document).on('click', '.descargar-grabaciones', function(event) {
        event.preventDefault();

        let valoresCheck = [];
        $("input[name='numcheck']:checked").each(function() {
            valoresCheck.push(this.value);
        });

        let _token = $("input[name=_token]").val();
        let url = currentURL + '/grabaciones_voicemial/descargar';

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                valoresCheck: valoresCheck,
                _token: _token,
            },
            success: function(result) {
                $('#iFrameDescarga').attr('src', result)
            }
        });
    });
    /**
     * Evento para enviar la grabación
     */
    $(document).on('click', '.enviar-grabacion', function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Ingrese los correos a los cuales se enviara la grabación.',
            text: 'separar con ; si se desea enviar a mas de un correo.',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Enviar',
            showLoaderOnConfirm: false
        }).then((result) => {
            let correos = result.value;
            let _token = $("input[name=_token]").val();
            let idGrabacion = $(this).attr('id');
            let url = currentURL + '/grabaciones_voicemial/' + idGrabacion;

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    correos: correos,
                    _token: _token,
                },
                success: function(data) {
                    if (data['error']) {
                        Swal.fire(
                            'Enviado!',
                            'Se ha enviado la grabación.',
                            'success'
                        )
                    } else {
                        Swal.fire(
                            'Error!',
                            data['mensaje'],
                            'error'
                        )
                    }
                }
            });
        });
    });
    /**
     * Evento para eliminar las grabaciones
     */
    $(document).on('click', '.eliminar-grabaciones', function(event) {
        event.preventDefault();

        Swal.fire({
            title: '¿Estas seguro?',
            text: "¿Deseas eliminar la(s) grabación(es) seleccionada(s)?. Esta acción la(s) eliminara físicamente y no podrá(n) ser recuperada(s).",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                let valoresCheck = [];
                $("input[name='numcheck']:checked").each(function() {
                    valoresCheck.push(this.value);
                });

                let _token = $("input[name=_token]").val();
                let _method = "DELETE";
                let url = currentURL + '/grabaciones_voicemial/0';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        valoresCheck: valoresCheck,
                        _method: _method,
                        _token: _token,
                    },
                    success: function(result) {

                        var fechaI = $("#fechaIni").val();
                        var fechaF = $("#fechaFin").val();
                        var hrI = $("#hrIni").val();
                        var hrF = $("#hrFin").val();
                        var url = currentURL + '/grabaciones_voicemial';
                        let _token = $("input[name=_token]").val();
                        var fechaIni = (fechaI + " " + hrI + ":00");
                        var fechaFin = (fechaF + " " + hrF + ":59");

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                fechaIni: fechaIni,
                                fechaFin: fechaFin,
                                _token: _token,
                            },
                            success: function(result) {
                                $("#rangoFiltro").html(fechaIni + " -- " + fechaFin)
                                $('.viewreportedesglose').html(result);
                            }
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
});