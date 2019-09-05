$(function() {
    /**
     * Evento para mostrar el formulario de crear un nuevo ivr
     */
    $(document).on("click", ".newIvr", function(e) {
        event.preventDefault();
        $('#tituloModal').html('Nuevo IVR');
        $('#action').removeClass('deleteIvr');
        $('#action').addClass('saveIvr');

        let url = currentURL + "/Ivr/create";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo agente
     */
    $(document).on('click', '.saveIvr', function(event) {
        event.preventDefault();
        $('#modal').modal('hide');

        let nombre = $("#nombre").val();
        let mensaje_bienvenida_id = $("#mensaje_bienvenida_id").val();
        let tiempo_espera = $("#tiempo_espera").val();
        let mensaje_tiepo_espera_id = $("#mensaje_tiepo_espera_id").val();
        let mensaje_opcion_invalida_id = $("#mensaje_opcion_invalida_id").val();
        let repeticiones = $("#repeticiones").val();
        let Empresas_id = $("#Empresas_id").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/Ivr';

        $.post(url, {
            nombre: nombre,
            mensaje_bienvenida_id: mensaje_bienvenida_id,
            tiempo_espera: tiempo_espera,
            mensaje_tiepo_espera_id: mensaje_tiepo_espera_id,
            mensaje_opcion_invalida_id: mensaje_opcion_invalida_id,
            repeticiones: repeticiones,
            Empresas_id: Empresas_id,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);

            $('.viewResult #tableivr').DataTable({
                "lengthChange": true,
                "order": [
                    [2, "asc"]
                ]
            });
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        });
    });
    /**
     * Evento para agregar una condición de tiempo adicional
     */
    $(document).on('click', '#addOpcion', function(event) {

        console.log($(".tableOpciones tbody tr.clonar:last").attr('id'));

        var clickID = $(".tableOpciones tbody tr.clonar:last").attr('id').replace('tr_', '');
        // Genero el nuevo numero id
        var newID = parseInt(clickID) + 1;

        let IDInput = ['tipo', 'repeticiones', 'destino'];

        fila = $(".tableOpciones tbody tr:eq()").clone().appendTo(".tableOpciones"); //Clonamos la fila

        for (let i = 0; i < IDInput.length; i++) {
            fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
        }

        fila.find('.form-control').attr('value', '');
        fila.find('.btn-danger').css('display', 'initial');
        fila.attr("id", 'tr_' + newID);
    });

});