$(function() {
    var currentURL = window.location.href;
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
    /**
     * Evento para mostrar el formulario de crear un nuevo modulo
     */
    $(document).on("click", ".newEmpresa", function(e) {

        e.preventDefault();
        $(".showEmpresas").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/wizard/empresa';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewWizarEmpresa").html(data);
        });
    });
    /**
     * Evento para avanzar al siguiente paso
     */
    $(document).on('click', '.nextStep', function(event) {

        let nextStep = $(this).data('step');
        let _token = $("input[name=_token]").val();
        let dataForm = $("#formWizardEmpresa").serializeArray();
        let url = currentURL + '/wizard/empresa/' + nextStep;

        //console.log(dataForm);

        if (validarForm(dataForm)) {

            if (nextStep == 'end') {

                Swal.fire({
                    title: '!!!Este es el último paso!!!',
                    text: "Deseas guardar toda la información capturada?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Guardar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {

                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                dataForm: dataForm,
                                _token: _token,
                            },
                            success: function(result) {
                                $(".viewResult").html(result);
                            }
                        });

                    }
                });

            } else {

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        dataForm: dataForm,
                        _token: _token,
                    },
                    success: function(result) {
                        $(".viewWizarEmpresa").html(result);
                    }
                });
            }

        } else {
            toastr.error('Hay campos incompletos, favor de validar la información.');
        }
    });
    /**
     * Evento para retroceder al paso anterior
     */
    $(document).on('click', '.prevStep', function(event) {

        let prevStep = $(this).data('step');
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/wizard/empresa/' + prevStep;

        $.ajax({
            url: url,
            type: "POST",
            data: {
                _token: _token,
            },
            success: function(result) {
                $(".viewWizarEmpresa").html(result);
            }
        });
    });
    /**
     * Evento para seleccionar los modulos
     */
    $(document).on('click', '.modulosEmpresa', function() {
        var id = $(this).val();

        if ($(this).prop('checked')) {
            if (id == 1) {
                $("#modulo_3").prop("checked", true);
                $("#modulo_4").prop("checked", true);
                $("#modulo_5").prop("checked", true);
                $("#modulo_6").prop("checked", true);
                $("#modulo_9").prop("checked", true);
                $("#modulo_11").prop("checked", true);
                $("#modulo_17").prop("checked", true);
            } else if (id == 2) {
                $("#modulo_3").prop("checked", true);
                $("#modulo_4").prop("checked", true);
                $("#modulo_6").prop("checked", true);
                $("#modulo_9").prop("checked", true);
                $("#modulo_17").prop("checked", true);
            }
        } else {
            if (id == 1) {
                $("#modulo_3").prop("checked", false);
                $("#modulo_4").prop("checked", false);
                $("#modulo_5").prop("checked", false);
                $("#modulo_6").prop("checked", false);
                $("#modulo_9").prop("checked", false);
                $("#modulo_11").prop("checked", false);
                $("#modulo_17").prop("checked", false);
            } else if (id == 2) {
                $("#modulo_3").prop("checked", false);
                $("#modulo_4").prop("checked", false);
                $("#modulo_6").prop("checked", false);
                $("#modulo_9").prop("checked", false);
                $("#modulo_17").prop("checked", false);
            }
        }
    });

    function validarForm(data) {

        let bandera = 0;

        if (data.length == 0) {
            bandera = 1;
        } else {
            data.forEach(function(currentValue, indice, array) {

                //console.log(currentValue.name + " " + currentValue.value);
                if (currentValue.value === null || currentValue.value === '') {
                    $('#' + currentValue.name).addClass('is-invalid');
                    //console.log('sin valores');
                    bandera = 1;
                }

            });
        }

        if (bandera) {
            return false;
        } else {
            return true;
        }

    }

    /**
     * Evento para clonar una fila de la tabla de nuevo canal
     */
    $(document).on('click', '#addCanalWizard', function() {
        var clickID = $(".tableNewCanal tbody tr:last").attr('id').replace('tr_', '');
        // Genero el nuevo numero id
        var newID = parseInt(clickID) + 1;

        fila = $(".tableNewCanal tbody tr:eq()").clone().appendTo(".tableNewCanal"); //Clonamos la fila
        //fila.find('select.tipo_canal').attr("data-pos", newID); //Buscamos el selecto con clase tipo_canal y le agregamos un nuevo atributo a pos
        fila.find('select.tipo_canal').attr({ 'data-pos': newID, name: 'tipo_canal_' + newID }); //Buscamos el selecto con clase tipo_canal y le agregamos un nuevo atributo a pos
        fila.find('.protocolo').attr({ id: 'protocolo_' + newID, name: 'protocolo_' + newID }); //Buscamos el input con clase protocolo y le agregamos un nuevo ID
        fila.find('.protocolo').val(""); //Buscamos el input con clase protocolo y le asignamos un valor vacio
        fila.find('.Troncales_id_canal').attr({ id: 'Troncales_id_canal_' + newID, name: 'Troncales_id_canal_' + newID }); //Buscamos el input con clase Troncales_id_canal y le agregamos un nuevo ID
        fila.find('.Troncales_id').attr({ id: 'Troncales_id_' + newID, name: 'Troncales_id_' + newID }); //Buscamos el input con clase Troncales_id_canal y le agregamos un nuevo ID
        fila.find('.nombre_troncal').attr({ id: 'nombre_troncal_' + newID, name: 'nombre_troncal_' + newID }); //Buscamos el input con clase Troncales_id_canal y le agregamos un nuevo ID
        fila.find('.nombre_troncal').val(""); //Buscamos el input con clase protocolo y le asignamos un valor vacio
        fila.find('.prefijo').attr({ id: 'prefijo_' + newID, name: 'prefijo_' + newID }); //Buscamos el input con clase Troncales_id_canal y le agregamos un nuevo ID
        fila.find('.prefijo').val(""); //Buscamos el input con clase protocolo y le asignamos un valor vacio
        fila.find('.btn-danger').css('display', '');

        fila.attr("id", 'tr_' + newID);
    });
    /**
     * Evento para obtener el txt del select de canales
     */
    $(document).on('change', '.Troncales_id_canal', function () {

        var id = $(this).attr('id').replace('Troncales_id_canal_', '');
        var nombre = $('#Troncales_id_canal_'+id+' option:selected').text();

        $("#nombre_troncal_"+id).val(nombre);

    })
    /**
     * Evento para eliminar una fila de la tabla de nuevo canal
     */
    $(document).on('click', '.deleteCanalWizard', function() {
        var tr = $(this).closest('tr')
        tr.remove();
    });
    /**
     * Validar los DIDs nuevos que tenga 10 digitos
     */
    $(document).on('blur', '#did', function () {
        var dids = $(this).val();

        if ( dids.split('\n').length == 0 ) {
            toastr.error('Debe ingresar por lo menos un Did.');
        }

        var data = dids.split('\n');

        for (let i = 0; i < data.length; i++) {
            if (data[i].length < 10) {
                toastr.error('Un Did no tiene 10 digitos.');
            }
            if (data[i].length > 10) {
                toastr.error('Un Did tiene mas de 10 digitos.');
            }
        }
    });
    /**
     * Evento para mostrar el formulario editar empresa
     */
    $(document).on('dblclick', '#tableEmpresas tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");
        let url = currentURL + '/empresas/' + id;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                $(".viewResult").html(result);
            }
        });
    });
    /**
     * Evento para cancelar la creacion/edicion del modulo
     */
    $(document).on("click", ".cancelEmpresa", function(e) {
        $(".newEmpresa").slideDown();
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para editar el modulo
     */
    $(document).on('click', '.updateEmpresa', function(event) {
        event.preventDefault();

        let dataForm = $("#formDataEmpresa").serializeArray();
        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let _method = "PUT";
        let url = currentURL + '/empresas/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                dataForm: dataForm,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                let url = currentURL + "/empresas/" + id + "/edit";

                $.get(url, function(data, textStatus, jqXHR) {
                    $(".viewCreate").html(data);
                    let dato = id + ".dataGeneral";
                    let url = currentURL + '/empresas/' + dato;

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(result) {
                            $('#formDataEmpresa').html(result);
                        }
                    });
                });
            }
        });
    });
    /**
     * Evento para obtener la opcion ha mostrar de el menu
     */
    $(document).on('click', '.menuEmpresa > li', function(event) {

        $('.menuEmpresa > li').removeClass('active');
        $(this).addClass('active');

        let id = $("#id").val();
        let opcion = $(this).data("opcion");
        let _token = $("input[name=_token]").val();
        let dato = id + "." + opcion;

        $("#accionActualizar").removeClass('updateExtension updateCanal updateEmpresa updateDid updatePrefijos updatePerfil');

        if (opcion == 'dataGeneral') {
            $('.updateEmpresa').slideUp();
            url = currentURL + '/empresas/' + dato;
        } else if (opcion == 'dataExtensiones') {
            url = currentURL + '/extensiones/' + id;
            $("#accionActualizar").addClass('updateExtension');
            $('#accionActualizar').slideDown();
        } else if (opcion == 'dataCanales') {
            url = currentURL + '/canales/' + id;
            $("#accionActualizar").addClass('updateCanal');
            $('#accionActualizar').slideDown();
        } else if (opcion == 'dataDids') {
            url = currentURL + '/did/' + id;
            $("#accionActualizar").addClass('updateDid');
            $('#accionActualizar').slideDown();
        } else if (opcion == 'dataPerfiles') {
            url = currentURL + '/perfil_marcacion/' + id;
            $("#accionActualizar").addClass('updatePerfil');
            //$('#accionActualizar').slideDown();
        } else if (opcion == 'dataPrefijos') {
            url = currentURL + '/prefijos_marcacion/' + id;
            $("#accionActualizar").addClass('updatePrefijos');
            //$('#accionActualizar').slideDown();
        } else {
            url = currentURL + '/empresas/' + dato;
            $("#accionActualizar").addClass('updateEmpresa');
            $('#accionActualizar').slideDown();
        }

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                _token: _token
            },
            success: function(result) {
                $('#formDataEmpresa').html(result);
                $('#TableCatExts').DataTable({
                    "lengthChange": true
                });
            }
        });
    });
    /**
     * Evento para eliminar una categoria
     */
    $(document).on('click', '.deleteEmpresa', function(event) {
        event.preventDefault();

        let id = $("#id").val();
        let _token = $("input[name=_token]").val();
        let _method = "DELETE";
        let url = currentURL + '/empresas/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('#tableEmpresas').DataTable({
                    "lengthChange": true
                });
            }
        });
    });

    /**
     * Evento para abrir una sesion para entrar a la cuenta del cliente seleccionado
     */
    $(document).on('click', '.linkEmpresa', function() {

        let id_empresa = $(this).attr("data-id_empresa");
        let dominio = $("#dominio_empresa").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/empresas/generar_sesion/' + id_empresa;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: _token,
                id_empresa: id_empresa
            },
            success: function(result) {

                var tab = window.open(dominio + '/soporte/' + result, '_blank');
                if (tab) {
                    tab.focus(); //ir a la pestaña
                } else {
                    alert('Pestañas bloqueadas, activa las ventanas emergentes (Popups) ');
                    return false;
                }
            }
        });
    });

});
