$(function() {

    var currentURL = window.location.href;

    /**
     * Evento para seleccionar grupo
     */
    $(document).on('click', '#tablecondiciontiempo tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".deletecondiciontiempo").slideDown();
        $(".editcondiciontiempo").slideDown();
        $("#idSeleccionado").val(id);

        $("#tablecondiciontiempo tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });;
    /**
     * Evento para mostrar el formulario de crear un nuevo Agente
     */
    $(document).on("click", ".newcondiciontiempo", function(e) {
        event.preventDefault();
        $('#tituloModal').html('Conciciones De Tiempo');
        $('#action').removeClass('updateCondicion');
        $('#action').addClass('saveCondicion');

        let url = currentURL + "inbound/Condiciones_Tiempo/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal({ backdrop: 'static', keyboard: false });
            $("#modal-body").html(data);

            //$(".fecha_inicio").datepicker({ dateFormat: "dd-mm-yy" });
            //$(".fecha_final").datepicker({ dateFormat: "dd-mm-yy" });

            $(".hora_inicio").wickedpicker({ twentyFour: true, title: '', });
            $(".hora_fin").wickedpicker({ twentyFour: true, title: '', });

        });
    });
    /**
     * Evento para guardar la nueva campana
     */
    $(document).on('click', '.saveCondicion', function(event) {
        event.preventDefault();

        let dataForm = $("#formDataCondicionTiempo").serializeArray();
        var data = {};
        $(dataForm).each(function(index, obj) {
            data[obj.name] = obj.value;
        });
        let _token = $("input[name=_token]").val();

        let url = currentURL + 'inbound/Condiciones_Tiempo';

        $.ajax({
                url: url,
                type: "post",
                data: {
                    dataForm: data,
                    _token: _token
                },
            })
            .done(function(data) {
                $('#modal').modal('hide');
                $('.modal-backdrop ').css('display', 'none');
                $('.viewResult').html(data);
                $('.viewResult #tableCondicionTiempo').DataTable({
                    "lengthChange": false
                });
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )
            }).fail(function(data) {
                printErrorMsg(data.responseJSON.errors);
            });
    });
    /**
     * Evento para agregar una condición de tiempo adicional
     */
    $(document).on('click', '#add', function(event) {

        var clickID = $(".tableNewForm tbody tr.clonar:last").attr('id').replace('tr_', '');
        // Genero el nuevo numero id
        var newID = parseInt(clickID) + 1;

        let IDInput = ['id_campo', 'nombre_campo', 'hora_inicio', 'min_inicio', 'hora_fin', 'min_fin', 'dia_semana_inicio', 'dia_semana_fin', 'fecha_inicio', 'fecha_final', 'destino_verdadero', 'destino_falso', 'opciones_si_coincide', 'opciones_no_coincide'];

        fila = $(".tableNewForm tbody tr:eq()").clone().appendTo(".tableNewForm"); //Clonamos la fila

        for (let i = 0; i < IDInput.length; i++) {
            fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
        }

        fila.find('.opcionesSi').attr('id', "opcionesSiCoincide_" + newID);
        fila.find('.opcionesNo').attr('id', "opcionesNoCoincide_" + newID);

        fila.find('.form-control').attr('value', '');
        //fila.find('#id_campo').attr('value', '');
        fila.find('.btn-danger').css('display', 'initial');
        fila.attr("id", 'tr_' + newID);
    });
    /**
     * Evento para eliminar una fila de la tabla de nueva condicion de tiempo
     */
    $(document).on('click', '.tr_clone_remove', function() {
        let tr = $(this).closest('tr');
        tr.remove();
    });
    /**
     * Evento para eliminar una fila de la tabla de nueva condicion de tiempo
     */
    $(document).on('click', '.tr_edit_remove', function() {
        let tr = $(this).closest('tr');
        let id = $(this).data('id');
        let _method = "DELETE";
        let _token = $("input[name=_token]").val();
        let url = currentURL + 'inbound/Condiciones_Tiempo/' + id + '&CDT';

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: _token,
                _method: _method
            },
            success: function(result) {
                tr.remove();
            }
        });
    });
    /**
     * Evento para mostrar el grupo ha editar
     */
    $(document).on('click', '#tableCondicionTiempo tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".deleteCondicion").slideDown();
        $(".editCondicion").slideDown();
        $("#idSeleccionado").val(id);

        $("#tableCondicionTiempo tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para eliminar el grupo de condicion de tiempo
     */
    $(document).on('click', '.deleteCondicion', function(event) {
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
                let url = currentURL + 'inbound/Condiciones_Tiempo/' + id + "&GRP";

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableFormulario').DataTable({
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
     * Evento para editar la configuración de grupo de condicion de tiempo
     */
    $(document).on('click', '.editCondicion', function(event) {
        event.preventDefault();
        var id = $("#idSeleccionado").val();
        $('#tituloModal').html('Condiciones de Tiempo');
        var url = currentURL + 'inbound/Condiciones_Tiempo/' + id + '/edit';
        $('#action').addClass('updateCondicion');
        $('#action').removeClass('saveCondicion');
        $.ajax({
            url: url,
            type: 'GET',
            success: function success(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);

                $(".hora_inicio").wickedpicker({ twentyFour: true, title: '', });
                $(".hora_fin").wickedpicker({ twentyFour: true, title: '', });
            }
        });
    });
    /**
     * Evento para guardar la nueva campana
     */
    $(document).on('click', '.updateCondicion', function(event) {
        event.preventDefault();

        let dataForm = $("#formDataCondicionTiempo").serializeArray();
        var data = {};
        $(dataForm).each(function(index, obj) {
            data[obj.name] = obj.value;
        });
        let _method = "PUT";
        let _token = $("input[name=_token]").val();
        let id = 0;

        let url = currentURL + 'inbound/Condiciones_Tiempo/' + id;

        $.ajax({
                url: url,
                type: "post",
                data: {
                    dataForm: data,
                    _method: _method,
                    _token: _token
                },
            })
            .done(function(data) {
                $('#modal').modal('hide');
                $('.modal-backdrop ').css('display', 'none');
                $('.viewResult').html(data);
                $('.viewResult #tableCondicionTiempo').DataTable({
                    "lengthChange": false
                });
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido actualizado.',
                    'success'
                )
            }).fail(function(data) {
                printErrorMsg(data.responseJSON.errors);
            });
    });
    /**
     * Accion para mostrar las opciones en base al destino seleccionado
     */
    $(document).on('change', '.destinoOpccion', function(event) {
        let accion = $(this).data('accion');
        let nombre = $(this).attr('name');
        let opccion = $(this).val();
        let _token = $("input[name=_token]").val();

        nombre = nombre.replace('destino_verdadero_', '');
        nombre = nombre.replace('destino_falso_', '');

        let id = 0 + '&' + opccion + '&' + nombre + '&' + accion;
        let url = currentURL + 'inbound/Condiciones_Tiempo/' + id;

        $.ajax({
                url: url,
                type: "GET",
                data: {
                    _token: _token
                },
            })
            .done(function(data) {

                if (accion == 'no_coincide') {
                    $('#opcionesNoCoincide_' + nombre).html(data);
                } else {
                    $('#opcionesSiCoincide_' + nombre).html(data);
                }

            });
    });

    $(document).on('change', 'input[type=number]', function(e) {
        let val = $(this).val();
        // Always 2 digits
        if (val.length >= 2) val = val.slice(0, 2);
        // 0 on the left (doesn't work on FF)
        if (val.length === 1) val = '0' + val;
        // Avoiding letters on FF
        if (!val) val = '00';
    });
    /**
     * Funcion para mostrar los errores de los formularios
     */
    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $(".form-control").removeClass('is-invalid');
        $(".print-error-msg").find("ul").append('<li>Es un campo obligatorio</li>');
        for (var clave in msg) {
            var data = clave.split('.');
            $("[name='" + data[1] + "']").addClass('is-invalid');
        }
    }
});