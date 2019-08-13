$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario editar formularios
     */
    $(document).on('click', '#tableFormulario tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        /*$(".editFormulario").slideDown();*/
        $(".dropleft").slideDown();


        $("#idSeleccionado").val(id);

        $("#tableFormulario tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });

    /**
     * Evento para eliminar el distribuidores
     *
     */
    $(document).on('click', '.deleteFormulario', function(event) {
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
                let url = currentURL + '/formularios/' + id;

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
     * Evento para mostrar el formulario de crear un nuevo formulario
     */
    $(document).on("click", ".newFormulario", function(e) {
        e.preventDefault();

        $('#tituloModal').html('Nuevo Formulario');
        let url = currentURL + '/formularios/create';

        $('#action').removeClass('updateFormulario');
        $('#action').addClass('saveFormulario');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $('#modal').modal('show');
                $("#modal-body").html(result);
            }
        });
    });

    /**
     * Evento para clonar una fila de la tabla de nuevo canal
     */
    $(document).on('click', '#add', function() {
        var clickID = $(".tableNewForm tbody tr:last").attr('id').replace('tr_', '');
        // Genero el nuevo numero id
        var newID = parseInt(clickID) + 1;

        fila = $(".tableNewForm tbody tr:eq()").clone().appendTo(".tableNewForm"); //Clonamos la fila
        fila.find('#nombre_campo').attr("name", 'nombre_campo_' + newID); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre
        fila.find('#tipo_campo').attr("name", 'tipo_campo_' + newID); //Buscamos el campo con id tipo_campo y le agregamos un nuevo nombre
        fila.find('#tamano').attr("name", 'tamano_' + newID); //Buscamos el campo con id tamano y le agregamos un nuevo nombre
        fila.find('#obligatorio').attr("name", 'obligatorio_' + newID); //Buscamos el campo con id obligatorio y le agregamos un nuevo nombre
        fila.find('#obligatorio_hidden').attr("name", 'obligatorio_' + newID + '_hidden'); //Buscamos el campo con id obligatorio y le agregamos un nuevo nombre
        fila.find('#editable').attr("name", 'editable_' + newID); //Buscamos el campo con id editable y le agregamos un nuevo nombre
        fila.find('#editable_hidden').attr("name", 'editable_' + newID + '_hidden'); //Buscamos el campo con id editable y le agregamos un nuevo nombre
        fila.attr("id", 'tr_' + newID);

    });

    $(document).on('click', '.micheckbox', function() {
        var name = $(this).attr('name');
        var name = name + "_hidden";
        if ($(this).prop('checked')) {

            $("input[name='" + name + "']").prop("disabled", true);
        } else {
            $("input[name='" + name + "']").prop("disabled", false);
        }
    });

    /**
     * Evento para eliminar una fila de la tabla de nuevo formulario
     */
    $(document).on('click', '.tr_clone_remove', function() {
        var tr = $(this).closest('tr')
        tr.remove();
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveFormulario', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let dataForm = $("#formDataFormulario").serializeArray();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/formularios';

        $.post(url, {
            dataForm: dataForm,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
        });
    });
    /** 
     * Evento para visualizar detalles del Formulario
     */
    $(document).on('click', '.viewFormulario', function(event) {
        event.preventDefault();
        let id = $("#idSeleccionado").val();
        $('#tituloModal').html('Detalles de Formulario');
        let url = currentURL + '/formularios/'+ id;

        $('#action').removeClass('updateFormulario');
        $('#action').addClass('saveFormulario');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $('#modal').modal('show');
                $("#modal-body").html(result);
            }
        });
    });
    $(document).on("change", "#tipo_campo", function(e) {
        let tipo = $(this).val();
        //console.log(tipo);
        if (tipo == 'asignador_folios')
        {
            $("#formulario > tbody").append('<tr class="folio"><td><input type="text" class="form-control form-control-sm" name="tamano_1" id="tamano"></td><td>more data</td></tr>');
        }else{
        $(".folio").remove();
        }

    });
/**
   * Evento para visualizar la configuracion de formulario
   */

  $(document).on('click', '.editFormulario', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    $('#tituloModal').html('Detalles de Formulario');
    var url = currentURL + '/formularios/' + id + '/edit';
    $('#action').addClass('updateFormulario');
    $('#action').removeClass('saveFormulario');
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(result) {
        $('#modal').modal('show');
        $("#modal-body").html(result);
      }
    });
});

});