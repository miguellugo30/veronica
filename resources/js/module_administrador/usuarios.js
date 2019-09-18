$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para ver el formulario de nuevo usuario
     */
    $(document).on("click", ".newUser", function(e) {
        e.preventDefault();
        $('#tituloModal').html('Nuevo Usuario');
        $('#action').removeClass('updateClient');
        $('#action').addClass('saveClient');

        let url = currentURL + '/usuarios/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal({ show: true, keyboard: false });
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo usuario
     */
    $(document).on("click", '.saveClient', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let name = $("#name").val();
        let email = $("#email").val();
        let pass_1 = $("#pass_1").val();
        let cliente = $("#cliente").val();
        let rol = $("#rol").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/usuarios';
        let arr = $('[name="permisos[]"]:checked').map(function() {
            return this.value;
        }).get();

        $.post(url, {
            name: name,
            email: email,
            password: pass_1,
            id_cliente: cliente,
            rol: rol,
            arr: arr,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewResult #tableUsuarios').DataTable({
                "lengthChange": true
            });
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        });

    });
    /**
     * Evento para editar un usuario
     */
    $(document).on('click', '#tableUsuarios tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");
        $(".editUser").slideDown();
        $(".deleteUser").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableUsuarios tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para mostrar el formulario de edicion de un canal
     */
    $(document).on("click", ".editUser", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Editar Usuarios');
        $('#action').removeClass('saveClient');
        $('#action').addClass('updateClient');

        let id = $("#idSeleccionado").val();

        let url = currentURL + "/usuarios/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para editar el usuario
     */
    $(document).on('click', '.updateClient', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let name = $("#name").val();
        let id_user = $("#id_user").val();
        let email = $("#email").val();
        let pass_1 = $("#pass_1").val();
        let cliente = $("#cliente").val();
        let rol = $("#rol").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/usuarios/' + id_user;
        let arr = $('[name="permisos[]"]:checked').map(function() {
            return this.value;
        }).get();

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                name: name,
                email: email,
                password: pass_1,
                id_cliente: cliente,
                rol: rol,
                arr: arr,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewResult #tableUsuarios').DataTable({
                    "lengthChange": true
                });
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )
            }
        });
    });
    /**
     * Evento para eliminar el  usuario
     */
    $(document).on('click', '.deleteUser', function(event) {
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
                let _token = $("input[name=_token]").val();
                let _method = "DELETE";
                let url = currentURL + '/usuarios/' + id;

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
                        $('.viewIndex').slideDown();
                        $('.viewResult #tableUsuarios').DataTable({
                            "lengthChange": true
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
     * Accion para setear el rol en base a la empresa
     * Y mostrar los modulos contratados por la empresa
     */
    $(document).on('change', '#cliente', function(event) {

        let id = $(this).val();

        let url = currentURL + "/usuarios/" + id;

        $.get(url, function(data, textStatus, jqXHR) {
            $(".modulosEmpresa").html(data);
        });

        if (id == 30) {
            $("#rol").val(1);
        } else {
            $("#rol").val(2);
        }
    });

    $(document).on('click', '.modulo', function() {
        var id = $(this).data("value");
        if ($(this).prop('checked')) {
            $("#sub_cat_" + id).slideDown();
        } else {
            $("#sub_cat_" + id).slideUp();
        }
    });

    /**
     * Evento para marcar / desmarcar todos los checkbox
     */
    $(document).on('click', '.marcarDesmarcar', function() {
        //event.preventDefault();
        var id = $(this).data("value");
        if ($("#sub_cat_" + id + " .mark").prop("checked") == true) {
            //alert("CHECKBOX ESTA ACTIVO");
            $("#sub_cat_" + id + " .mark").prop("checked", true);
        } else {
            //alert("CHECKBOX ESTA INACTIVO");
            $("#sub_cat_" + id + " .mark").prop("checked", false);
        }
    });

});
