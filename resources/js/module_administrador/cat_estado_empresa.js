$(function() {
    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newEdoEmp", function(e) {

        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/cat_empresa/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
    $(document).on('click', '.saveEdoEmp', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/cat_empresa';

        $.post(url, {
            nombre: nombre,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);
            $('.viewIndex #tableEdoEmp').DataTable({
                "lengthChange": true,
                "order": [
                    [5, "asc"]
                ]
            });
        });
    });
    /**
     * Evento para mostrar el formulario editar modulo
     */
    $(document).on('dblclick', '#tableEdoEmp tbody tr', function(event) {
        event.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/cat_empresa/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

        });
    });
    /**
     * Evento para cancelar la creacion/edicion del modulo
     */
    $(document).on("click", ".cancelEdoEmp", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateEdoEmp', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/cat_empresa/' + id;

        $.ajax({
            url: url,
            type: 'PUT',
            data: {
                nombre: nombre,
                _token: _token
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex #tableEdoEmp').DataTable({
                    "lengthChange": true,
                    "order": [
                        [5, "asc"]
                    ]
                });
            }
        });
    });
    /**
     * Evento para eliminar el modulo
     */
    $(document).on('click', '.deleteEdoEmp', function(event) {
        event.preventDefault();

        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/cat_empresa/' + id;

        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                _token: _token
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex #tableEdoEmp').DataTable({
                    "lengthChange": true,
                    "order": [
                        [5, "asc"]
                    ]
                });
            }
        });
    });
});