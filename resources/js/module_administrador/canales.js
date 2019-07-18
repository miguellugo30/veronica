$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newCanal", function(e) {

        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/canales/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveCanal', function(event) {
        event.preventDefault();

        let protocolo = "SIP/";
        let prefijos = "";
        let Cat_Canales_Tipo_id;
        let id_distribuidor = $("#distribuidores_canal").val();
        
        $("input[type=checkbox]:checked").each(function(){
            indice = $(this).val();
            distribuidor = $("#canal_prefijo"+indice).val();
            empresa = $("#canal_empresa"+indice).val();
            tipo = $("#canal_tipo"+indice).val();

            prefijo = distribuidor+empresa+tipo;
            prefijos=prefijos +prefijo+","+indice+";";
        });

        prefijos = prefijos.substring(0,prefijos.length -1);
        let Empresas_id = $("#Empresas_id_canal").val();
        let Troncales_id = $("#Troncales_id_canal").val();
        let Cat_Distribuidor_id = $("#distribuidores_canal").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/canales';

        $.post(url, {
            protocolo : protocolo,
            prefijos : prefijos,
            Empresas_id: Empresas_id,
            Troncales_id: Troncales_id,
            Cat_Distribuidor_id: Cat_Distribuidor_id,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewIndex #tableCanales').DataTable({
                "lengthChange": true
            });
        });
    });
    /**
     * Evento para mostrar el formulario editar modulo
     */
    $(document).on('dblclick', '#tableCanales tbody tr', function(event) {
        event.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/canales/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

        });
    });
    /**
     * Evento para cancelar la creacion/edicion del modulo
     */
    $(document).on("click", ".cancelCanal", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateCanal', function(event) {
        event.preventDefault();

        let Cat_Distribuidor_id = $("#distribuidores_canal").val();
        let Empresas_id = $("#Empresas_id_canal").val();
        let Troncales_id = $("#Troncales_id_canal").val();
        let id = $("#id").val();
        /**
         * Valores para armar el canal
         */
        let canal_troncal = $("#canal_troncal").val();
        let canal_prefijo = $("#canal_prefijo").val();
        let canal_empresa = $("#canal_empresa").val();
        let canal_tipo = $("#canal_tipo").val();

        let canal = "SIP/" + canal_troncal + "/" + canal_prefijo + canal_empresa + canal_tipo;

        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/canales/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                Empresas_id: Empresas_id,
                Troncales_id: Troncales_id,
                Cat_Distribuidor_id: Cat_Distribuidor_id,
                canal: canal,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex #tableCanales').DataTable({
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
        let url = currentURL + '/canales/' + id;

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
                $('.viewIndex #tableCanales').DataTable({
                    "lengthChange": true
                });
            }
        });
    });

    /**
     * Evento que obtiene el distribuidor al momento de editar
     */
    $(document).on('change', '#distribuidores_canal_editar', function(event) {
        let prefijo = $("#distribuidores_canal_editar option:selected").data('prefijo');
        let id_empresa = $(this).val();
        let url = currentURL + '/canales/' + id_empresa;

        let id_distribuidor = $("#distribuidores_canal_editar").val();

        $.get(url, function(data, textStatus, xhr) {
            $(".resultDistribuidor").html(data);
            $("#canal_prefijo").val(prefijo);
        });
    });
    /**
     * Evento que obtiene el distribuidor y
     */
    $(document).on('change', '#distribuidores_canal', function(event) {
        //Al cambiar de distribuidor se limpiara el campo de la troncal y el id de la empresa
        $('#canal_troncal').val('');
        $('#canal_empresa').val('');
        //Obtener el valor del prefijo seleccionado y settearlo para el armado de canal en "canal_prefijo"
        let prefijo = $("#distribuidores_canal option:selected").data('prefijo');

        let id_empresa = $(this).val();
        let url = currentURL + '/canales/' + id_empresa;

        let id_distribuidor = $("#distribuidores_canal").val();

        $.get(url, function(data, textStatus, xhr) {
            $(".resultDistribuidor").html(data);
            if(id_distribuidor == 2){
                $('.canal1').show();
                $('.canal2').show();
                $('.canal3').show();
                $("#canal_prefijo1").val(prefijo);
                $("#canal_prefijo2").val(prefijo);
                $("#canal_prefijo3").val(prefijo);
            }else if(id_distribuidor == 1){
                $('.canal4').show();
                $('.canal5').show();
                $('.canal6').show();
                $('.canal7').show();
                $("#canal_prefijo4").val(prefijo);
                $("#canal_prefijo5").val(prefijo);
                $("#canal_prefijo6").val(prefijo);
                $("#canal_prefijo7").val(prefijo);
            }
        });
    });
    /**
     * Evento para obtener el nombre de la troncal
     */
    $(document).on('change', '#Troncales_id_canal', function(event) {
        let id_distribuidor = $("#distribuidores_canal").val();
        let prefijo = $("#Troncales_id_canal option:selected").text();

        if(id_distribuidor == 2){
            $("#canal_troncal1").val(prefijo);
            $("#canal_troncal2").val(prefijo);
            $("#canal_troncal3").val(prefijo);
        }else if(id_distribuidor == 1){
            $("#canal_troncal4").val(prefijo);
            $("#canal_troncal5").val(prefijo);
            $("#canal_troncal6").val(prefijo);
            $("#canal_troncal7").val(prefijo);
        }
    });

    /**
     * Evento para obtener el nombre de la troncal al editar
     */
    $(document).on('change', '#Troncales_id_canal', function(event) {
        let id_distribuidor = $("#distribuidores_canal").val();
        let prefijo = $("#Troncales_id_canal option:selected").text();
            $("#canal_troncal").val(prefijo);
    });

    /**
     * Evento para asignar el id de la empresa al editar
     */
    $(document).on('change', '#Empresas_id_canal', function(event) {
        let id_distribuidor = $("#distribuidores_canal").val();
        let id_Empresa = $("#Empresas_id_canal option:selected").val();
            $("#canal_empresa").val(zfill(id_Empresa, 3));
    });

    /**
     * Evento para asignar el tipo de canal al editar
     */
    $(document).on('change', '#Tipo_canal', function(event) {
        let id_distribuidor = $("#distribuidores_canal").val();
        let id_Empresa = $("#Empresas_id_canal option:selected").val();
            $("#canal_empresa").val(zfill(id_Empresa, 3));
    });

    /**
     * Evento para asignar el id de la empresa
     */
    $(document).on('change', '#Empresas_id_canal', function(event) {
        let id_distribuidor = $("#distribuidores_canal").val();
        let id_Empresa = $("#Empresas_id_canal option:selected").val();

        if(id_distribuidor == 2){
            $("#canal_empresa1").val(zfill(id_Empresa, 3));
            $("#canal_empresa2").val(zfill(id_Empresa, 3));
            $("#canal_empresa3").val(zfill(id_Empresa, 3));
        }else if(id_distribuidor == 1){
            $("#canal_empresa4").val(zfill(id_Empresa, 3));
            $("#canal_empresa5").val(zfill(id_Empresa, 3));
            $("#canal_empresa6").val(zfill(id_Empresa, 3));
            $("#canal_empresa7").val(zfill(id_Empresa, 3));
        }
    });
    /**
     * Funcion para formatear el id de la empresa a 3 digitos
     * @param {id_empresa} number
     * @param {tamanio} width
     */
    function zfill(number, width) {
        var numberOutput = Math.abs(number); /* Valor absoluto del número */
        var length = number.toString().length; /* Largo del número */
        var zero = "0"; /* String de cero */

        if (width <= length) {
            if (number < 0) {
                return ("-" + numberOutput.toString());
            } else {
                return numberOutput.toString();
            }
        } else {
            if (number < 0) {
                return ("-" + (zero.repeat(width - length)) + numberOutput.toString());
            } else {
                return ((zero.repeat(width - length)) + numberOutput.toString());
            }
        }
    }
});
