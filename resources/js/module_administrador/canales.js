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

        let Cat_Distribuidor_id = $("#distribuidores_canal").val();
        let Empresas_id = $("#Empresas_id_canal").val();
        let Troncales_id = $("#Troncales_id_canal").val();
        /**
         * Valores para armar el canal
         */
        let canal_troncal = $("#canal_troncal").val();
        let canal_prefijo = $("#canal_prefijo").val();
        let canal_empresa = $("#canal_empresa").val();
        let canal_tipo = $("#canal_tipo").val();

        let canal = "SIP/" + canal_troncal + "/" + canal_prefijo + canal_empresa + canal_tipo;

        let _token = $("input[name=_token]").val();
        let url = currentURL + '/canales';

        $.post(url, {
            Empresas_id: Empresas_id,
            Troncales_id: Troncales_id,
            Cat_Distribuidor_id: Cat_Distribuidor_id,
            canal: canal,
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
     * Evento que obtiene el distribuidor y
     */
    $(document).on('change', '#distribuidores_canal', function(event) {
        let prefijo = $("#distribuidores_canal option:selected").data('prefijo');
        $("#canal_prefijo").val(prefijo);
        let id_empresa = $(this).val();
        let url = currentURL + '/canales/' + id_empresa;

        $.get(url, function(data, textStatus, xhr) {
            $(".resultDistribuidor").html(data);
        });
    });
    /**
     * Evento para obtener el nombre de la troncal
     */
    $(document).on('change', '#Troncales_id_canal', function(event) {
        let prefijo = $("#Troncales_id_canal option:selected").text();
        $("#canal_troncal").val(prefijo);
    });
    /**
     * Evento para poder el id de la empresa
     */
    $(document).on('change', '#Empresas_id_canal', function(event) {
        let id_Empresa = $("#Empresas_id_canal option:selected").val();
        $("#canal_empresa").val(zfill(id_Empresa, 3));
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
