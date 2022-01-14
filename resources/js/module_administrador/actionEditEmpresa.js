$(function() {

    var currentURL = window.location.href;

    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
     $(document).on("click", ".edit", function(e) {

        e.preventDefault();
        var modulo = $(this).attr('id');
        var empresa_id = $("#empresa_id").val();

        if (modulo == 'editEmpresa')
        {
            url = currentURL + '/empresas/' + empresa_id + "/edit";
            $('.modal-title').text('Editar Empresa');
            //$(".btn-primary").addClass('updateEmpresa');
            $(".updateSeccion").attr('data-seccion', 'empresa');
        }
        else if (modulo == 'editInfraestructura')
        {
            url = currentURL + '/infraestructura/' + empresa_id + "/edit";
            //$("#accionActualizar").addClass('updateExtension');
            $('.modal-title').text('Editar Infraestructura');
        }
        else if (modulo == 'editModulos')
        {
            url = currentURL + '/modulos/' + empresa_id + "/edit";
            //$("#accionActualizar").addClass('updateCanal');
            $('.modal-title').text('Editar Modulos');
            $(".updateSeccion").attr('data-seccion', 'modulos');
        }
        else if (modulo == 'editDid')
        {
            var did_id = $("#editSelectedDid").val();
            url = currentURL + '/did/' + did_id + "/edit";
            //$("#accionActualizar").addClass('updateDid');
            $('.modal-title').text('Editar Did');
            $(".updateSeccion").attr('data-seccion', 'did');
        }
        else if (modulo == 'editAlmacenamiento')
        {
            url = currentURL + '/almacenamiento/' + empresa_id + "/edit";
            //$("#accionActualizar").addClass('updatePerfil');
            $('.modal-title').text('Editar Almacenamiento');
            $(".updateSeccion").attr('data-seccion', 'almacenamiento');
        }
        else if (modulo == 'editCanales')
        {
            url = currentURL + '/canales/' + canal_id + "/edit";
            //$("#accionActualizar").addClass('updatePrefijos');
            $('.modal-title').text('Editar Canales');
            $(".updateSeccion").attr('data-seccion', 'canales');
        }
        else if( modulo == 'editExtensiones' )
        {
            var extension_id = $("#editSelectedExtension").val();
            url = currentURL + '/extensiones/' + extension_id + "/edit";
            //$("#accionActualizar").addClass('updateEmpresa');
            $('.modal-title').text('Editar Extensiones');
            $(".updateSeccion").attr('data-seccion', 'extensiones');
        }

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $('.modal-body').html(result);
                $('.modalEdit').modal('show');
            }
        });
    });

    /**
     * Evento para mostrar el formulario editar modulo
     */
     $(document).on('click', '.tableDids tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");
        console.log(id);
        $("#editSelectedDid").val(id);

        $(".tableDids tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para mostrar el formulario editar modulo
     */
     $(document).on('click', '.tableCanales tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");

        $("#editSelectedCanal").val(id);

        $(".tableCanales tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para mostrar el formulario editar modulo
     */
    $(document).on('click', '.tableExtensiones tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");

        $("#editSelectedExtension").val(id);

        $(".tableExtensiones tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });

    $(document).on('click', '.updateSeccion', function(event) {

        var modulo = $(this).data('seccion');
        let dataForm = $("#formUpdateSeccion").serializeArray();
        let _token = $('meta[name=csrf-token]').attr('content');

        $.ajax({
            url: url,
            type: "POST",
            data: {
                dataForm:dataForm,
                modulo:modulo,
                _token: _token,
            },
            success: function(result) {
                $(".viewResult").html(result);
            }
        });

    });


});
