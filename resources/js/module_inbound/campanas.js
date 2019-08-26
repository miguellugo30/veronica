$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar las campanas
     */
    $(document).on('click', '#tableCampanas tbody tr', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        $(".editCampana").slideDown();
        $(".deleteCampana").slideDown();


        $("#idSeleccionado").val(id);

        $("#tableCampanas tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para eliminar Campana
     *
     */
    $(document).on('click', '.deleteCampana', function(event) {
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
                let url = currentURL + '/campanas/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewResult #tableCampanas').DataTable({
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
     * Evento para mostrar el formulario para crear la nueva campana
     */
    $(document).on("click", ".newCampana", function(e) {
        e.preventDefault();

        $('#tituloModal').html('Nueva Campaña');
        let url = currentURL + '/campanas/create';

        $('#action').removeClass('updateCampana');
        $('#action').addClass('saveCampana');

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
     * Evento para guardar la nueva campana
     *
     */
    $(document).on('click', '.saveCampana', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let mlogeo = $("#mlogeo").val();
        let strategy = $("#strategy").val();
        let wrapuptime = $("#wrapuptime").val();
        let msginical = $("#msginical").val();
        let periodic_announce = $("#periodic_announce").val();
        let periodic_announce_frequency = $("#periodic_announce_frequency").val();
        let musicclass = $("#musicclass").val();
        let script = $("#script").val();
        let alertstll = $("#alertstll").val();
        let alertstdll = $("#alertstdll").val();
        let libta = $("#libta").val();
        let cal_lib = $("#cal_lib").val();
        let _token = $("input[name=_token]").val();

        let url = currentURL + '/campanas';

        $.ajax({
                url: url,
                type: "post",
                data: {
                    nombre: nombre,
                    mlogeo: mlogeo,
                    strategy: strategy,
                    wrapuptime: wrapuptime,
                    msginical: msginical,
                    periodic_announce: periodic_announce,
                    periodic_announce_frequency: periodic_announce_frequency,
                    musicclass: musicclass,
                    script: script,
                    alertstll: alertstll,
                    alertstdll: alertstdll,
                    libta: libta,
                    cal_lib: cal_lib,
                    _token: _token
                },
            })
            .done(function(data) {
                $('.viewResult').html(data);
                $('.viewResult #tableCampanas').DataTable({
                    "lengthChange": false
                });
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido guardado.',
                    'success'
                )
            });
    });
    /**
     * Evento para visualizar la configuración de la campana
     */
    $(document).on('click', '.editCampana', function(event) {
        event.preventDefault();
        var id = $("#idSeleccionado").val();
        $('#tituloModal').html('Detalles de Campana');
        var url = currentURL + '/campanas/' + id + '/edit';
        $('#action').addClass('updaCampanas');
        $('#action').removeClass('saveCampana');
        $.ajax({
            url: url,
            type: 'GET',
            success: function success(result) {
                $('#modal').modal({ backdrop: 'static', keyboard: false });
                $("#modal-body").html(result);
            }
        });
    });
    /**
     * Evento para guardar los cambios de la campana
     */
    $(document).on('click', '.updaCampanas', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');
        let id = $("#id").val();
        let nombre = $("#nombre").val();
        let mlogeo = $("#mlogeo").val();
        let strategy = $("#strategy").val();
        let wrapuptime = $("#wrapuptime").val();
        let msginical = $("#msginical").val();
        let periodic_announce = $("#periodic_announce").val();
        let periodic_announce_frequency = $("#periodic_announce_frequency").val();
        let musicclass = $("#musicclass").val();
        let script = $("#script").val();
        let alertstll = $("#alertstll").val();
        let alertstdll = $("#alertstdll").val();
        let libta = $("#libta").val();
        let cal_lib = $("#cal_lib").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/campanas/' + id;

        $.post(url, {
            nombre: nombre,
            mlogeo: mlogeo,
            strategy: strategy,
            wrapuptime: wrapuptime,
            msginical: msginical,
            periodic_announce: periodic_announce,
            periodic_announce_frequency: periodic_announce_frequency,
            musicclass: musicclass,
            script: script,
            alertstll: alertstll,
            alertstdll: alertstdll,
            libta: libta,
            cal_lib: cal_lib,
            _token: _token,
            _method: _method,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('.viewResult').html(data);
            $('.viewResult #tableCampanas').DataTable({
                "lengthChange": false
            });
            Swal.fire(
                'Correcto!',
                'El registro ha sido editado.',
                'success'
            )
        });

    });
});
