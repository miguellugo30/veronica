$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo distribuidores
     */
    $(document).on("click", ".nuevoDistribuidor", function(e) {
        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/distribuidor/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
    });
    
    /**
     * Evento para guardar el nuevo distribuidores
     */
    $(document).on('click', '.saveDistribuidor', function(event) {
        event.preventDefault();
        let formData = new FormData(document.getElementById("altadistribuidores"));
        let servicio = $("#servicio").val();
        let distribuidor = $("#distribuidor").val();
        let numero_soporte = $("#numero_soporte").val();
        let img_header = $("#img_header").val();
        let img_pie = $("#img_pie").val();
        let _token = $("input[name=_token]").val();

        formData.append("servicio",servicio);
        formData.append("distribuidor",distribuidor);
        formData.append("numero_soporte",numero_soporte);
        formData.append("img_header",img_header);
        formData.append("img_pie",img_pie);
        formData.append("_token",_token);
        
        let url = currentURL + '/distribuidor';

        $.ajax({
            url: url,
            type: "post",
            dataType:"html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(data){
            $('.viewResult').html(data);
        });
    });
    /**
     * Evento para mostrar el formulario editar distribuidores
     */
    $(document).on('dblclick', '#tableDistribuidores tbody tr', function(event) {
        event.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/distribuidor/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

        });
    });
    /**
     * Evento para cancelar la creacion/edicion del distribuidores
     */
    $(document).on("click", ".cancelDistribuidor", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para editar el distribuidores
     */
    $(document).on('click', '.updateDistribuidor', function(event) {
        event.preventDefault();
        let formData = new FormData(document.getElementById("editardistribuidores"));
        let servicio = $("#servicio").val();
        let distribuidor = $("#distribuidor").val();
        let numero_soporte = $("#numero_soporte").val();
        let img_header = $("#img_header").val();
        let img_pie = $("#img_pie").val();
        let id_distribuidor = $("#id_distribuidor").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/distribuidor/' + id_distribuidor;

        formData.append("servicio",servicio);
        formData.append("distribuidor",distribuidor);
        formData.append("numero_soporte",numero_soporte);
        formData.append("img_header",img_header);
        formData.append("img_pie",img_pie);
        formData.append("_token",_token);
        formData.append("_method","PUT");
        
       $.ajax({
            url: url,
            type: "POST",
            dataType:"html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(data){
            $('.viewResult').html(data);
        });
    });
    /**
     * Evento para eliminar el distribuidores
     * 
     */
    $(document).on('click', '.deleteDistribuidor', function(event) {
        event.preventDefault();

        let id_distribuidor = $("#id_distribuidor").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/distribuidor/' + id_distribuidor;

        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                _token: _token
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewIndex #tableDistribuidores').DataTable({
                    "lengthChange": true,
                    "order": [
                        [2, "asc"]
                    ]
                });
            }
        });
    });
});