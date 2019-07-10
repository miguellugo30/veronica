$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newEmpresa", function(e) {

        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/empresas/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
    });
    /**
     * Evento para guardar la nueva empresa
     */
    $(document).on('click', '.saveEmpresa', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let contacto_cliente = $("#contacto_cliente").val();
        let direccion = $("#direccion").val();
        let ciudad = $("#ciudad").val();
        let estado = $("#estado").val();
        let pais = $("#pais").val();
        let telefono = $("#telefono").val();
        let movil = $("#movil").val();
        let correo = $("#correo").val();
        let action = $("#action").val();
        let Cat_Distribuidor_id = $("#distribuidores_empresa").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/empresas';

        $.post(url, {
            nombre: nombre,
            contacto_cliente: contacto_cliente,
            direccion: direccion,
            ciudad: ciudad,
            estado: estado,
            pais: pais,
            telefono: telefono,
            movil: movil,
            correo: correo,
            Cat_Distribuidor_id: Cat_Distribuidor_id,
            action: action,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewIndex #tableEmpresas').DataTable({
                "lengthChange": true
            });
        });
    });
    /**
     * Evento para guardar la informacion de infraestructura
     */
    $(document).on('click', '.saveEmpresaInfra', function(event) {
        event.preventDefault();

        let dominio = $("#dominio").val();
        let id_empresa = $("#id_empresa").val();
        let Cat_Distribuidor_id = $("#Cat_Distribuidor_id").val();
        let action = $("#action").val();
        let base_datos_empresa = $("#base_datos_empresa").val();
        let media_server_empresas = $("#media_server_empresas").val();

        let _token = $("input[name=_token]").val();
        let url = currentURL + '/empresas';

        $.post(url, {
            dominio: dominio,
            id_empresa: id_empresa,
            Cat_Distribuidor_id: Cat_Distribuidor_id,
            action: action,
            base_datos_empresa: base_datos_empresa,
            media_server_empresas: media_server_empresas,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewIndex #tableEmpresas').DataTable({
                "lengthChange": true
            });
        });

    });
    /**
     * Evento para guardar la informacion de modulos
     */
    $(document).on('click', '.saveEmpresaModulos', function(event) {
        event.preventDefault();

        let id_empresa = $("#id_empresa").val();
        let action = $("#action").val();
        let _token = $("input[name=_token]").val();
        let arr = $('[name="modulos[]"]:checked').map(function() {
            return this.value;
        }).get();
        let url = currentURL + '/empresas';
        $.post(url, {
            id_empresa: id_empresa,
            arr: arr,
            action: action,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewIndex #tableEmpresas').DataTable({
                "lengthChange": true
            });
        });

    });
    /**
     * Evento para mostrar el formulario editar modulo
     */
    $(document).on('dblclick', '#tableEmpresas tbody tr', function(event) {
        event.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/empresas/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

        });
    });
    /**
     * Evento para cancelar la creacion/edicion del modulo
     */
    $(document).on("click", ".cancelEmpresa", function(e) {
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
        console.log(dataForm);

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
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex #tableEmpresas').DataTable({
                    "lengthChange": true
                });
            }
        });
    });
    /**
     * Evento para eliminar el modulo
     */
    $(document).on('click', '.deleteCanal', function(event) {
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
                $('.viewCreate').slideUp();
                $('.viewIndex #tableEmpresas').DataTable({
                    "lengthChange": true
                });
            }
        });
    });
    /**
     * Evento que obtiene el distribuidor y
     */
    $(document).on('change', '#distribuidores_empresa', function(event) {
        let dist = $(this).val()
        if (dist == 11) {
            dominio = ".nimbuscca.mx";
        } else {
            dominio = ".nimbuscc.mx";
        }
        $('#basic-addon2').html(dominio);
    });

    $(document).on('keyup', '#nombre', function(event) {
        let nombre_dominio = $(this).val();
        $("#dominio").val(nombre_dominio.replace(" ", "_"));
    });

    $(document).on('click', '.modulosEmpresa', function(event) {

        let id = $(this).val();
        if ($(this).is(':checked')) {

            if (id == 1) {
                $('#agentes_entrada').removeAttr('disabled');
            } else if (id == 2) {
                $('#agentes_salida').removeAttr('disabled');
            } else if (id == 7) {
                $('#licencias_ivr_inteligente').removeAttr('disabled');
            } else if (id == 8) {
                $('#canal_generador_encuestas').removeAttr('disabled');
            } else if (id == 10) {
                $('#canal_mensajes_voz').removeAttr('disabled');
            }

        } else {
            if (id == 1) {
                $('#agentes_entrada').attr('disabled', true);
            } else if (id == 2) {
                $('#agentes_salida').attr('disabled', true);
            } else if (id == 7) {
                $('#licencias_ivr_inteligente').attr('disabled', true);
            } else if (id == 8) {
                $('#canal_generador_encuestas').attr('disabled', true);
            } else if (id == 10) {
                $('#canal_mensajes_voz').attr('disabled', true);
            }

        }
    });

});