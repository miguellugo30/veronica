$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo distribuidores
     */
    $(document).on("click", ".newDistribuidor", function(e) {
        event.preventDefault();
        $('#tituloModal').html('Nuevo Distribuidor');
        $('#action').removeClass('updateDistribuidor');
        $('#action').addClass('saveDistribuidor');

        let url = currentURL + "/distribuidor/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo distribuidores
     */
    $(document).on('click', '.saveDistribuidor', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let formData = new FormData(document.getElementById("altadistribuidores"));
        let servicio = $("#servicio").val();
        let distribuidor = $("#distribuidor").val();
        let numero_soporte = $("#numero_soporte").val();
        let prefijo = $("#prefijo").val();
        let img_header = $("#img_header").val();
        let img_pie = $("#img_pie").val();
        let _token = $("input[name=_token]").val();
        formData.append("servicio", servicio);
        formData.append("distribuidor", distribuidor);
        formData.append("numero_soporte", numero_soporte);
        formData.append("prefijo", prefijo);
        formData.append("img_header", img_header);
        formData.append("img_pie", img_pie);
        formData.append("_token", _token);

        let url = currentURL + '/distribuidor';

        $.ajax({
                url: url,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(data) {
                $('.viewResult').html(data);
                $('.viewResult #tableDistribuidores').DataTable({
                    "lengthChange": false
                });
            });
        Swal.fire(
            'Correcto!',
            'El registro ha sido guardado.',
            'success'
        )
    });
    /**
     * Evento para mostrar el formulario editar distribuidores
     */
    $(document).on('click', '#tableDistribuidores tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".editDistribuidor").slideDown();
        $(".deleteDistribuidor").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableDistribuidores tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para mostrar el formulario de edicion de un canal
     */
    $(document).on("click", ".editDistribuidor", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Editar Distribuidor');
        $('#action').removeClass('saveDistribuidor');
        $('#action').addClass('updateDistribuidor');

        let id = $("#idSeleccionado").val();

        let url = currentURL + "/distribuidor/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para editar el distribuidores
     */
    $(document).on('click', '.updateDistribuidor', function(event) {

        event.preventDefault();
        $('#modal').modal('hide');
        let formData = new FormData(document.getElementById("editardistribuidores"));
        let servicio = $("#servicio").val();
        let distribuidor = $("#distribuidor").val();
        let numero_soporte = $("#numero_soporte").val();
        let prefijo = $("#prefijo").val();
        let img_header = $("#img_header").val();
        let img_pie = $("#img_pie").val();
        let id_distribuidor = $("#id_distribuidor").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/distribuidor/' + id_distribuidor;

        formData.append("servicio", servicio);
        formData.append("distribuidor", distribuidor);
        formData.append("numero_soporte", numero_soporte);
        formData.append("prefijo", prefijo);
        formData.append("img_header", img_header);
        formData.append("img_pie", img_pie);
        formData.append("_token", _token);
        formData.append("_method", "PUT");

        $.ajax({
                url: url,
                type: "POST",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(data) {
                $('.viewResult').html(data);
                $('.viewResult #tableDistribuidores').DataTable({
                    "lengthChange": false
                });
            });
        Swal.fire(
            'Correcto!',
            'El registro ha sido guardado.',
            'success'
        )
    });
    /**
     * Evento para eliminar el distribuidores
     *
     */
    $(document).on('click', '.deleteDistribuidor', function(event) {
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
                let url = currentURL + '/distribuidor/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableDistribuidores').DataTable({
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

    //Actualiza la imagen header seleccionada en el input file
    $(document).on('change', '#file_input_header', function(e) {
        var TmpPath_header = URL.createObjectURL(e.target.files[0]);
        $('#image_input_header').attr('src', TmpPath_header);
    });
    //Actualiza la imagen pie seleccionada en el input file
    $(document).on('change', '#file_input_pie', function(e) {
        var TmpPath_pie = URL.createObjectURL(e.target.files[0]);
        $('#image_input_pie').attr('src', TmpPath_pie);
    });

});