$(function() {

    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".generarReporteDesglose", function(e) {

        let url = currentURL + '/Desglose_llamadas/';
        let fecha_inicio = $("#fecha-inicio").val();
        let fecha_fin = $("#fecha-fin").val();

        $.ajax({
                url: url,
                type: "post",
                data: {
                    fecha_inicio: fecha_inicio,
                    fecha_fin: fecha_fin,
                    _token: _token
                },

            })
            .done(function(data) {
                $('.viewResult').html(data);
                $('.viewResult #tableCondicionTiempo').DataTable({
                    "lengthChange": false
                });
                Swal.fire(
                    'Correcto!',
                    'El registro ha sido actualizado.',
                    'success'
                )
            });
    });
});