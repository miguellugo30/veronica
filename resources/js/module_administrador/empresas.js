$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newEmpresa", function(e) {

        e.preventDefault();
        $(".showEmpresas").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/wizard/empresa';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewWizarEmpresa").html(data);
        });
    });
    /**
     * Evento para avanzar al siguiente paso
     */
    $(document).on('click', '.nextStep', function(event) {

        let nextStep = $(this).data('step');
        let _token = $("input[name=_token]").val();
        let dataForm = $("#formWizardEmpresa").serializeArray();
        let url = currentURL + '/wizard/empresa/' + nextStep;

        console.log(dataForm);

        $.ajax({
            url: url,
            type: "POST",
            data: {
                dataForm: dataForm,
                _token: _token,
            },
            success: function(result) {
                $(".viewWizarEmpresa").html(result);
            }
        });
    });
    /**
     * Evento para retroceder al paso anterior
     */
    $(document).on('click', '.prevStep', function(event) {

        let prevStep = $(this).data('step');
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/wizard/empresa/' + prevStep;

        $.ajax({
            url: url,
            type: "POST",
            data: {
                _token: _token,
            },
            success: function(result) {
                $(".viewWizarEmpresa").html(result);
            }
        });
    });
    /**
     * Evento para seleccionar los modulos
     */
    $(document).on('click', '.modulosEmpresa', function() {
        var id = $(this).val();

        if ($(this).prop('checked')) {
            if (id == 1) {
                $("#modulo_3").prop("checked", true);
                $("#modulo_4").prop("checked", true);
                $("#modulo_5").prop("checked", true);
                $("#modulo_6").prop("checked", true);
                $("#modulo_9").prop("checked", true);
                $("#modulo_11").prop("checked", true);
                $("#modulo_17").prop("checked", true);
            } else if (id == 2) {
                $("#modulo_3").prop("checked", true);
                $("#modulo_4").prop("checked", true);
                $("#modulo_6").prop("checked", true);
                $("#modulo_9").prop("checked", true);
                $("#modulo_17").prop("checked", true);
            }
        } else {
            if (id == 1) {
                $("#modulo_3").prop("checked", false);
                $("#modulo_4").prop("checked", false);
                $("#modulo_5").prop("checked", false);
                $("#modulo_6").prop("checked", false);
                $("#modulo_9").prop("checked", false);
                $("#modulo_11").prop("checked", false);
                $("#modulo_17").prop("checked", false);
            } else if (id == 2) {
                $("#modulo_3").prop("checked", false);
                $("#modulo_4").prop("checked", false);
                $("#modulo_6").prop("checked", false);
                $("#modulo_9").prop("checked", false);
                $("#modulo_17").prop("checked", false);
            }
        }
    });
    /**
     * Evento para clonar una fila de la tabla de nuevo canal
     */
    $(document).on('click', '#addCanalWizard', function() {
        var clickID = $(".tableNewCanal tbody tr:last").attr('id').replace('tr_', '');
        // Genero el nuevo numero id
        var newID = parseInt(clickID) + 1;

        fila = $(".tableNewCanal tbody tr:eq()").clone().appendTo(".tableNewCanal"); //Clonamos la fila
        //fila.find('select.tipo_canal').attr("data-pos", newID); //Buscamos el selecto con clase tipo_canal y le agregamos un nuevo atributo a pos
        fila.find('select.tipo_canal').attr({ 'data-pos': newID, name: 'tipo_canal_' + newID }); //Buscamos el selecto con clase tipo_canal y le agregamos un nuevo atributo a pos
        fila.find('.protocolo').attr({ id: 'protocolo_' + newID, name: 'protocolo_' + newID }); //Buscamos el input con clase protocolo y le agregamos un nuevo ID
        fila.find('.protocolo').val(""); //Buscamos el input con clase protocolo y le asignamos un valor vacio
        fila.find('.Troncales_id_canal').attr({ id: 'Troncales_id_canal_' + newID, name: 'Troncales_id_canal_' + newID }); //Buscamos el input con clase Troncales_id_canal y le agregamos un nuevo ID
        fila.find('.Troncales_id').attr({ id: 'Troncales_id_' + newID, name: 'Troncales_id_' + newID }); //Buscamos el input con clase Troncales_id_canal y le agregamos un nuevo ID
        fila.find('.prefijo').attr({ id: 'prefijo_' + newID, name: 'prefijo_' + newID }); //Buscamos el input con clase Troncales_id_canal y le agregamos un nuevo ID
        fila.find('.prefijo').val(""); //Buscamos el input con clase protocolo y le asignamos un valor vacio
        fila.find('.btn-danger').css('display', '');

        fila.attr("id", 'tr_' + newID);
    });
    /**
     * Evento para eliminars una fila de la tabla de nuevo canal
     */
    $(document).on('click', '.deleteCanalWizard', function() {
        console.log('deleteCanalWizard')
        var tr = $(this).closest('tr')
        tr.remove();
    });


















    /**
     * Declaramos las opciones para la creacion de una nueva cuenta
     */
    let opciones = ['dataEmpresa', 'dataInfra', 'dataModulo', 'dataPosiciones', 'dataAlmacenamiento', 'dataCanales', 'dataExtensiones', 'dataDids'];
    /**
     * Evento para guardar la nueva empresa
     */
    $(document).on('click', '#siguiente', function(event) {
        event.preventDefault();

        $('#anterior').slideDown();
        $('.cancelEmpresa').slideUp();
        /**
         * Recuperamos la accion a relizar y la opcion a relaizar
         */
        let accion = $(this).attr("data-accion");
        let opcion = $(this).attr("data-opcion-siguiente");
        /**
         * Se setea a crear si viene de un accion de actualizar
         */
        if (regresos > 1) {
            $(this).attr("data-accion", "actualizar");
            regresos--;
        } else {
            $(this).attr("data-accion", "crear");
            regresos = 0;
        }
        /**
         * Si aun es menor al tamaño del arreglo seguimos
         * incrementando.
         */
        if (opcionSiguiente < opciones.length) {
            opcionAnterior = opcionAnterior + 1;
            opcionSiguiente = opcionSiguiente + 1;
        }
        /**
         * Cuando lleguemos al final del arreglo ponermos
         * el boton con la leyenda de finalizar
         */
        if (opcionSiguiente == 7) {
            $('#siguiente').html('Finalizar');
        }
        /**
         * Seteamos el valor de la siguiente opcion y anterior
         */
        $('#anterior').attr('data-opcion-anterior', opciones[opcionAnterior]);
        $('#siguiente').attr('data-opcion-siguiente', opciones[opcionSiguiente]);

        /**
         * Dependiendo de la accion a realizar, se define
         * la URL y metodo que se usara
         */
        if (accion.indexOf("actualizar") > -1) {
            let id = $("#id_empresa").val(); //Recuperamos el id de la empresa ha editar
            url = currentURL + '/empresas/' + id; //Definimos la url de edicion
            method = "POST";
            _method = "PUT";
        } else {
            url = currentURL + '/empresas'; //Definimos la URL para crear
            method = "POST";
            _method = "POST";
        }

        /**
         * Recuperamos la informacion del formulario
         */
        let dataForm = $("#formDataEmpresa").serializeArray();
        let _token = $("input[name=_token]").val();
        /**
         * Enviamos la informacion
         */
        $.ajax({
            url: url,
            type: method,
            data: {
                _token: _token,
                _method: _method,
                dataForm: dataForm,
                accion: accion
            },
            success: function(result) {
                if (opcion == 'dataDids') {
                    $('.viewResult').html(result);
                } else {
                    $('#formDataEmpresa').html(result);
                    $("#formDataEmpresa .saveExtension").slideUp();
                    $("#formDataEmpresa .saveDid").slideUp();
                    $("#formDataEmpresa .saveCanal").slideUp();
                }
            }
        });
    });
    /**
     * Evento para regresar a la opcion anterior
     */
    $(document).on('click', '#anterior', function(event) {
        event.preventDefault();
        /**
         * Recuperamos la accion a relizar y la opcion a relaizar
         */
        let accion = $(this).attr("data-accion");
        let opcion = $(this).attr("data-opcion-anterior");

        $('#siguiente').attr("data-accion", "actualizar");
        /**
         * Seteamos el valor de la siguiente opcion y anterior
         */
        if (opcionSiguiente == 7) {
            $('#siguiente').html('Siguiente');
        }
        if (opcionAnterior == 0) {
            $('#anterior').slideUp();
        }
        if (opcionSiguiente > 0) {
            regresos++;
            opcionAnterior = opcionAnterior - 1;
            opcionSiguiente = opcionSiguiente - 1;
        }

        $('#anterior').attr('data-opcion-anterior', opciones[opcionAnterior]);
        $('#siguiente').attr('data-opcion-siguiente', opciones[opcionSiguiente]);

        let id = $("#id_empresa").val();
        let _token = $("input[name=_token]").val();
        let dato = id + "." + opcion;

        if (opcion == 'dataExtensiones') {
            url = currentURL + '/extensiones/' + id;
        } else if (opcion == 'dataCanales') {
            url = currentURL + '/canales/' + id;
        } else if (opcion == 'dataDids') {
            url = currentURL + '/did/' + id;
        } else {
            url = currentURL + '/empresas/' + dato;
        }

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                _token: _token,
                accion: accion
            },
            success: function(result) {
                $('#formDataEmpresa').html(result);
            }
        });

    });
    /**
     * Evento para mostrar el formulario editar empresa
     */
    $(document).on('dblclick', '#tableEmpresas tbody tr', function(event) {
        event.preventDefault();

        $(".newEmpresa").slideUp();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/empresas/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
            let dato = id + ".dataGeneral";
            let url = currentURL + '/empresas/' + dato;

            $.ajax({
                url: url,
                type: 'GET',
                success: function(result) {
                    $('#formDataEmpresa').html(result);
                }
            });
        });
    });
    /**
     * Evento para cancelar la creacion/edicion del modulo
     */
    $(document).on("click", ".cancelEmpresa", function(e) {
        $(".newEmpresa").slideDown();
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateEmpresa', function(event) {
        event.preventDefault();

        let dataForm = $("#formDataEmpresa").serializeArray();
        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/empresas/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                dataForm: dataForm,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                let url = currentURL + "/empresas/" + id + "/edit";

                $.get(url, function(data, textStatus, jqXHR) {
                    $(".viewCreate").html(data);
                    let dato = id + ".dataGeneral";
                    let url = currentURL + '/empresas/' + dato;

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(result) {
                            $('#formDataEmpresa').html(result);
                        }
                    });
                });
            }
        });
    });
    /**
     * Evento para obtener la opcion ha mostrar de el menu
     */
    $(document).on('click', '.menuEmpresa > li', function(event) {

        $('.menuEmpresa > li').removeClass('active');
        $(this).addClass('active');

        let id = $("#id").val();
        let opcion = $(this).data("opcion");
        let _token = $("input[name=_token]").val();
        let dato = id + "." + opcion;

        $("#accionActualizar").removeClass('updateExtension updateCanal updateEmpresa updateDid updatePrefijos updatePerfil');

        if (opcion == 'dataGeneral') {
            $('.updateEmpresa').slideUp();
            url = currentURL + '/empresas/' + dato;
        } else if (opcion == 'dataExtensiones') {
            url = currentURL + '/extensiones/' + id;
            $("#accionActualizar").addClass('updateExtension');
            $('#accionActualizar').slideDown();
        } else if (opcion == 'dataCanales') {
            url = currentURL + '/canales/' + id;
            $("#accionActualizar").addClass('updateCanal');
            $('#accionActualizar').slideDown();
        } else if (opcion == 'dataDids') {
            url = currentURL + '/did/' + id;
            $("#accionActualizar").addClass('updateDid');
            $('#accionActualizar').slideDown();
        } else if (opcion == 'dataPerfiles') {
            url = currentURL + '/perfil_marcacion/' + id;
            $("#accionActualizar").addClass('updatePerfil');
            //$('#accionActualizar').slideDown();
        } else if (opcion == 'dataPrefijos') {
            url = currentURL + '/prefijos_marcacion/' + id;
            $("#accionActualizar").addClass('updatePrefijos');
            //$('#accionActualizar').slideDown();
        } else {
            url = currentURL + '/empresas/' + dato;
            $("#accionActualizar").addClass('updateEmpresa');
            $('#accionActualizar').slideDown();
        }

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                _token: _token
            },
            success: function(result) {
                $('#formDataEmpresa').html(result);
                $('#TableCatExts').DataTable({
                    "lengthChange": true
                });
            }
        });
    });
    /**
     * Evento para eliminar una categoria
     */
    $(document).on('click', '.deleteEmpresa', function(event) {
        event.preventDefault();

        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let _method = "DELETE";
        let url = currentURL + '/empresas/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('#tableEmpresas').DataTable({
                    "lengthChange": true
                });
            }
        });
    });

    /**
     * Evento para abrir una sesion para entrar a la cuenta del cliente seleccionado
     */
    $(document).on('click', '.linkEmpresa', function() {

        let id_empresa = $(this).attr("data-id_empresa");
        let dominio = $("#dominio_empresa").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/empresas/generar_sesion/' + id_empresa;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: _token,
                id_empresa: id_empresa
            },
            success: function(result) {

                var tab = window.open(dominio + '/soporte/' + result, '_blank');
                if (tab) {
                    tab.focus(); //ir a la pestaña
                } else {
                    alert('Pestañas bloqueadas, activa las ventanas emergentes (Popups) ');
                    return false;
                }
            }
        });
    });

});