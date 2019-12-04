$(function() {
    /**
     * Evento para obtener el Agente
     */
    $(document).on('change', '.campana', function(event) {
        event.preventDefault();
        $("#agente").empty();
        $("#agente").append('<option>Selecciona un Agente</option>');
        $("#extension").empty();
        $("#extension").append('<option>Selecciona una Extension</option>');
        $("#extension").attr('disabled', 'disabled');
        $("#calificacion").empty();
        $("#calificacion").append('<option>Selecciona una Calificacion</option>');
        $("#calificacion").attr('disabled', 'disabled');
        $("#subcalificacion").empty();
        $("#subcalificacion").append('<option>Selecciona una Subcalificacion</option>');
        $("#subcalificacion").attr('disabled', 'disabled');
        var campana_id = $("#campana").val();
        let url = currentURL + "/Inbound/store/" + campana_id;
        let _token = $("input[name=_token]").val();
        $("#agente").removeAttr('disabled');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: url,
            data: {
                campana_id: campana_id,
                _token: _token,
            },
            success: function(res) {

                var respuesta = JSON.stringify(res);
                alert(respuesta);
                console.log(respuesta);
                $.each(respuest, function(key, value) {
                    //console.log(key + ' : ' + value);
                    $("#agente").append('<option value="' + key + '">' + value + '</option>');
                });
            }

        });
    });
    /*$.ajax({
        type: "POST",
        url: url,
        campana_id: campana_id,
        data: {
            _token: _token,
        },
        success: function(res) {
            //if (res != '') {
            $("#agente").empty();
            //$("#agente").append('<option>Selecciona un Agente</option>');
            //$("#agente").append('<option>Selecciona un Agente</option>');
            $("#agente").append('@foreach ($nombres as $nombre)<option value="{{$nombre->id}}">{{$nombre->nombre}}</option>@endforeach');
            /*$.each(res, function(key, value) {
                $("#agente").append('<option value="' + value + '">' + value + '</option>');

            });*/
    //}

    /**
     * Evento para obtener la Extension
     */
    $(document).on('change', '.agente', function(event) {
        event.preventDefault();
        $("#extension").empty();
        $("#extension").append('<option>Selecciona una Extension</option>');
        $("#extension").removeAttr('disabled');
        $("#calificacion").empty();
        $("#calificacion").append('<option>Selecciona una Calificacion</option>');
        $("#calificacion").attr('disabled', 'disabled');

        var agente_id = $("#agente").val();
        var url = currentURL + '/Inbound/getExtensiones/' + agente_id;

        if (agente_id != '') {
            $.ajax({
                type: "GET",
                url: url,
                agente_id: agente_id,
                success: function(res) {
                    if (res != '') {
                        $("#extension").empty();
                        $("#extension").append('<option>Selecciona una Extension</option>');
                        $.each(res, function(key, value) {
                            $("#extension").append('<option value="' + value + '">' + value + '</option>');
                        });
                    }
                }

            });
        }

    });
    /**
     * Evento para obtener las calificaciones
     */
    $(document).on('change', '.extension', function(event) {
        event.preventDefault();
        $("#calificacion").empty();
        $("#calificacion").append('<option>Selecciona una Calificacion</option>');
        $("#calificacion").removeAttr('disabled');
        var campana_id = $("#campana").val();
        var url = currentURL + '/Inbound/getCalificaciones/' + campana_id;
        if (campana_id != '') {
            $.ajax({
                type: "GET",
                url: url,
                campana_id: campana_id,
                success: function(res) {
                    if (res != '') {
                        $("#calificacion").empty();
                        $("#calificacion").append('<option>Selecciona una Calificacion</option>');
                        $.each(res, function(key, value) {
                            $("#calificacion").append('<option value="' + value + '">' + value + '</option>');
                        });
                    }
                }
            });
        }

    });
    /**
     * Evento para obtener las sub_calificaciones
     */
    $(document).on('change', '.calificacion', function(event) {
        event.preventDefault();
        $("#subcalificacion").removeAttr('disabled');

    });


    /**
     * Evento para mostrar los resultados en el DataTable
     */
    $(document).on('click', '.filtrar', function(event) {
        event.preventDefault();
        var campana_id = $("#campana").val();
        var fechaI = $("#fechaIni").val();
        var fechaF = $("#fechaFin").val();
        var hrI = $("#hrIni").val();
        var hrF = $("#hrFin").val();
        var fechaIni = (fechaI + " " + hrI + ":00");
        var fechaFin = (fechaF + " " + hrF + ":59");
        var url = currentURL + '/Inbound/store/' + campana_id;
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                fechaIni: fechaIni,
                fechaFin: fechaFin,
                _token: _token,
            },
            success: function(result) {
                $('.resultado').html(result);
                let tabla = $('.resultado #tableInbound').DataTable({
                    'columnDefs': [{ "orderable": false, "targets": [0], className: 'select-checkbox' }],
                    select: { style: 'os', selector: 'td:first-child' },
                    'order': [
                        [6, 'desc'],
                        [7, 'desc']
                    ],
                    //dom: 'Bfrtip',
                    dom: 'lBfrtip',
                    buttons: [
                        { extend: 'excel', className: 'btn-secondary btn-sm', text: '<i class="fa fa-file-excel-o"></i> Exportar a Excel' }
                    ]
                });
                // Añade los botones de Eliminar,Descargar y Exportar a Excel
                //tabla.buttons().container().appendTo($('#botones'));
                tabla.buttons().container().prepend(' <button type="button" class="btn-secondary btn-sm downloadGrabacion"  data-widget="remove"><i class="fas fa fa-download"></i> Descargar Grabaciones</button> ');
                tabla.buttons().container().prepend(' <button type="button" class="btn-secondary btn-sm deleteGrabacion"  data-widget="remove"><i class="fas fa-trash-alt"></i> Eliminar Grabaciones</button> ');
                tabla.buttons().container().appendTo($('#botones'));

                // Agrega un input text a cada celda de pie de pagina
                $('#tableInbound tfoot th').each(function() {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="Buscar ' + title + '" />');
                });

                // Aplica la busqueda
                tabla.columns().every(function() {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });

            }
        });
    });

    $(document).on("click", ".grabacion", function() {
        var nom_audio = (this.id);
        //let _token = $("input[name=_token]").val();
        var url = currentURL + '/Inbound/getGrabacion/' + nom_audio;
        alert(url);
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                nom_audio: nom_audio,
                //_token: _token
            }
        });
    });

    $(document).on("click", ".checkall", function() {
        /**
         * Evento para Marcar/Desmarcar todos los checkbox de la columna 0
         */
        $('#tableInbound').DataTable()
            .column(0)
            .nodes()
            .to$()
            .find('input[type=checkbox]')
            .attr('checked', this.checked);

        /**
         * Otra forma de hacerlo pero solo funciona con la pagina actual del DataTable
         */

        /*let tabla = $('.resultado #tableInbound').DataTable();

        if (this.checked) {
            for (i = 1; i <= tabla.rows().count(); i++) {
                $(".numcheck_" + i).attr('checked', 'checked');
            }
        } else {
            for (i = 1; i <= tabla.rows().count(); i++) {
                $(".numcheck_" + i).removeAttr('checked');
            }
        }*/

    });

    /**
     * Evento para seleccionar solo una columna del DataTable
     */
    /*$(document).on('click', '#tableInbound tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $("#idSeleccionado").val(id);

        $("#tableInbound tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');

    });*/
    /**
     * Evento para deshabilitar las extensiones si seleccionan un Agente
     */
    $(document).on('change', '#agente', function(event) {
        event.preventDefault();
        //$("#extension").attr('disabled', 'disabled');

    });
    /**
     * Evento para deshabilitar los agentes si seleccionan una extension
     */
    $(document).on('change', '#extension', function(event) {
        event.preventDefault();
        //$("#agente").attr('disabled', 'disabled');
    });
    /**
     * Evento para deshabilitar las subcalificaciones si seleccionan una Calificacion
     */
    $(document).on('change', '#calificacion', function(event) {
        event.preventDefault();

    });
    /**
     * Evento para deshabilitar las calificaciones si seleccionan una subCalificacion
     */
    $(document).on('change', '#subcalificacion', function(event) {
        event.preventDefault();

    });

    /**
     * Evento para mostrar el calendario en los input type Fecha Inicio
     */
    $(document).on('click', '#fechaIni', function(event) {
        //$("#fechaIni").datepicker({ dateFormat: 'yy-mm-dd' });

    });
    /**
     * Evento para mostrar el calendario en los input type Fecha Fin
     */
    $(document).on('click', '#fechaFin', function(event) {
        //$("#fechaFin").datepicker({ dateFormat: 'yy-mm-dd' });

    });
});
