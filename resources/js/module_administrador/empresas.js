$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newEmpresa", function(e) {

        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();
        /**
         * Seteamos el valor inicioa para la opcion siguiente y anterior
         */
        opcionSiguiente = 0;
        opcionAnterior = -1;
        regresos = 0;

        let url = currentURL + '/empresas/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
            let dato = 0 + ".dataEmpresa";
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
                $('#formDataEmpresa').html(result);
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

        let url = currentURL + '/empresas/' + dato;

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
                /*
                $('#formDataEmpresa').html(result);
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
                                });*/
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

        if (opcion == 'dataGeneral') {
            $('.updateEmpresa').slideUp();
        } else {
            $('.updateEmpresa').slideDown();
        }

        let url = currentURL + '/empresas/' + dato;

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
     * Evento para habilitar la edicion del canal seleccionado
     */
    $(document).on('click', '.editar_canal', function(event) {
        let id = $(this).val();
        /**
         * Habilitamos los inputs para editar
         */
        if ($(this).prop('checked')) {
            $("#tipo_Canal_" + id).prop("disabled", false);
            $("#troncal_" + id).prop("disabled", false);
            $("#prefijo_" + id).prop("disabled", false);
            $("#prefijo_completo_" + id).prop("disabled", false);
            $("#delete_" + id).slideDown();
        } else {
            $("#tipo_Canal_" + id).prop("disabled", true);
            $("#troncal_" + id).prop("disabled", true);
            $("#prefijo_" + id).prop("disabled", true);
            $("#prefijo_completo_" + id).prop("disabled", true);
            $("#delete_" + id).slideUp();
        }
    });
    /**
     * Evento para habilitar la edicion de la extension seleccionado
     */
    $(document).on('click', '.editar_extension', function(event) {
        let id = $(this).val();
        /**
         * Habilitamos los inputs para editar
         */
        if ($(this).prop('checked')) {
            $("#canal_extension_" + id).prop("disabled", false);
            $("#extension_" + id).prop("disabled", false);
            $("#extension_id_" + id).prop("disabled", false);
        } else {
            $("#canal_extension_" + id).prop("disabled", false);
            $("#extension_" + id).prop("disabled", false);
            $("#extension_id_" + id).prop("disabled", false);
        }
    });
});