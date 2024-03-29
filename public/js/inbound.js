/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/module_inbound/CondicionesTiempo.js":
/*!**********************************************************!*\
  !*** ./resources/js/module_inbound/CondicionesTiempo.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para seleccionar grupo
   */

  $(document).on('click', '#tablecondiciontiempo tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".deletecondiciontiempo").slideDown();
    $(".editcondiciontiempo").slideDown();
    $("#idSeleccionado").val(id);
    $("#tablecondiciontiempo tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  ;
  /**
   * Evento para mostrar el formulario de crear un nuevo Agente
   */

  $(document).on("click", ".newcondiciontiempo", function (e) {
    event.preventDefault();
    $('#tituloModal').html('Conciciones De Tiempo');
    $('#action').removeClass('updateCondicion');
    $('#action').addClass('saveCondicion');
    var url = currentURL + "inbound/Condiciones_Tiempo/create";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal({
        backdrop: 'static',
        keyboard: false
      });
      $("#modal-body").html(data); //$(".fecha_inicio").datepicker({ dateFormat: "dd-mm-yy" });
      //$(".fecha_final").datepicker({ dateFormat: "dd-mm-yy" });

      $(".hora_inicio").wickedpicker({
        twentyFour: true,
        title: ''
      });
      $(".hora_fin").wickedpicker({
        twentyFour: true,
        title: ''
      });
    });
  });
  /**
   * Evento para guardar la nueva campana
   */

  $(document).on('click', '.saveCondicion', function (event) {
    event.preventDefault();
    var dataForm = $("#formDataCondicionTiempo").serializeArray();
    var data = {};
    $(dataForm).each(function (index, obj) {
      data[obj.name] = obj.value;
    });

    var _token = $("input[name=_token]").val();

    var url = currentURL + 'inbound/Condiciones_Tiempo';
    $.ajax({
      url: url,
      type: "post",
      data: {
        dataForm: data,
        _token: _token
      }
    }).done(function (data) {
      $('#modal').modal('hide');
      $('.modal-backdrop ').css('display', 'none');
      $('.viewResult').html(data);
      $('.viewResult #tableCondicionTiempo').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para agregar una condición de tiempo adicional
   */

  $(document).on('click', '#add', function (event) {
    var clickID = $(".tableNewForm tbody tr.clonar:last").attr('id').replace('tr_', ''); // Genero el nuevo numero id

    var newID = parseInt(clickID) + 1;
    var IDInput = ['id_campo', 'nombre_campo', 'hora_inicio', 'min_inicio', 'hora_fin', 'min_fin', 'dia_semana_inicio', 'dia_semana_fin', 'fecha_inicio', 'fecha_final', 'destino_verdadero', 'destino_falso', 'opciones_si_coincide', 'opciones_no_coincide'];
    fila = $(".tableNewForm tbody tr:eq()").clone().appendTo(".tableNewForm"); //Clonamos la fila

    for (var i = 0; i < IDInput.length; i++) {
      fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
    }

    fila.find('.opcionesSi').attr('id', "opcionesSiCoincide_" + newID);
    fila.find('.opcionesNo').attr('id', "opcionesNoCoincide_" + newID);
    fila.find('.form-control').attr('value', ''); //fila.find('#id_campo').attr('value', '');

    fila.find('.btn-danger').css('display', 'initial');
    fila.attr("id", 'tr_' + newID);
  });
  /**
   * Evento para eliminar una fila de la tabla de nueva condicion de tiempo
   */

  $(document).on('click', '.tr_clone_remove', function () {
    var tr = $(this).closest('tr');
    tr.remove();
  });
  /**
   * Evento para eliminar una fila de la tabla de nueva condicion de tiempo
   */

  $(document).on('click', '.tr_edit_remove', function () {
    var tr = $(this).closest('tr');
    var id = $(this).data('id');
    var _method = "DELETE";

    var _token = $("input[name=_token]").val();

    var url = currentURL + 'inbound/Condiciones_Tiempo/' + id + '&CDT';
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        tr.remove();
      }
    });
  });
  /**
   * Evento para mostrar el grupo ha editar
   */

  $(document).on('click', '#tableCondicionTiempo tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".deleteCondicion").slideDown();
    $(".editCondicion").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableCondicionTiempo tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para eliminar el grupo de condicion de tiempo
   */

  $(document).on('click', '.deleteCondicion', function (event) {
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
    }).then(function (result) {
      if (result.value) {
        var id = $("#idSeleccionado").val();
        var _method = "DELETE";

        var _token = $("input[name=_token]").val();

        var url = currentURL + 'inbound/Condiciones_Tiempo/' + id + "&GRP";
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableFormulario').DataTable({
              "lengthChange": false
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Evento para editar la configuración de grupo de condicion de tiempo
   */

  $(document).on('click', '.editCondicion', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    $('#tituloModal').html('Condiciones de Tiempo');
    var url = currentURL + 'inbound/Condiciones_Tiempo/' + id + '/edit';
    $('#action').addClass('updateCondicion');
    $('#action').removeClass('saveCondicion');
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(result) {
        $('#modal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $("#modal-body").html(result);
        $(".hora_inicio").wickedpicker({
          twentyFour: true,
          title: ''
        });
        $(".hora_fin").wickedpicker({
          twentyFour: true,
          title: ''
        });
      }
    });
  });
  /**
   * Evento para guardar la nueva campana
   */

  $(document).on('click', '.updateCondicion', function (event) {
    event.preventDefault();
    var dataForm = $("#formDataCondicionTiempo").serializeArray();
    var data = {};
    $(dataForm).each(function (index, obj) {
      data[obj.name] = obj.value;
    });
    var _method = "PUT";

    var _token = $("input[name=_token]").val();

    var id = 0;
    var url = currentURL + 'inbound/Condiciones_Tiempo/' + id;
    $.ajax({
      url: url,
      type: "post",
      data: {
        dataForm: data,
        _method: _method,
        _token: _token
      }
    }).done(function (data) {
      $('#modal').modal('hide');
      $('.modal-backdrop ').css('display', 'none');
      $('.viewResult').html(data);
      $('.viewResult #tableCondicionTiempo').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido actualizado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Accion para mostrar las opciones en base al destino seleccionado
   */

  $(document).on('change', '.destinoOpccion', function (event) {
    var accion = $(this).data('accion');
    var nombre = $(this).attr('name');
    var opccion = $(this).val();

    var _token = $("input[name=_token]").val();

    nombre = nombre.replace('destino_verdadero_', '');
    nombre = nombre.replace('destino_falso_', '');
    var id = 0 + '&' + opccion + '&' + nombre + '&' + accion;
    var url = currentURL + 'inbound/Condiciones_Tiempo/' + id;
    $.ajax({
      url: url,
      type: "GET",
      data: {
        _token: _token
      }
    }).done(function (data) {
      if (accion == 'no_coincide') {
        $('#opcionesNoCoincide_' + nombre).html(data);
      } else {
        $('#opcionesSiCoincide_' + nombre).html(data);
      }
    });
  });
  $(document).on('change', 'input[type=number]', function (e) {
    var val = $(this).val(); // Always 2 digits

    if (val.length >= 2) val = val.slice(0, 2); // 0 on the left (doesn't work on FF)

    if (val.length === 1) val = '0' + val; // Avoiding letters on FF

    if (!val) val = '00';
  });
  /**
   * Funcion para mostrar los errores de los formularios
   */

  function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $(".form-control").removeClass('is-invalid');
    $(".print-error-msg").find("ul").append('<li>Es un campo obligatorio</li>');

    for (var clave in msg) {
      var data = clave.split('.');
      $("[name='" + data[1] + "']").addClass('is-invalid');
    }
  }
});

/***/ }),

/***/ "./resources/js/module_inbound/Did_Enrutamiento.js":
/*!*********************************************************!*\
  !*** ./resources/js/module_inbound/Did_Enrutamiento.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para seleccionar un Enrutamiento
   */

  $(document).on('click', '#tabledidenrutamientos tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id"); //$(".deletedidenrutamiento").slideDown();

    $(".editdidenrutamiento").slideDown();
    $("#idSeleccionado").val(id);
    $("#tabledidenrutamientos tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para Configurar el enrutamiento
   */

  $(document).on('click', '.editdidenrutamiento', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    var url = currentURL + 'inbound/Did_Enrutamiento/' + id + '/edit';
    $('#tituloModal').html('Editar Enrutamiento');
    $('#action').addClass('updatedidenrutamiento');
    $('#action').removeClass('savedidenrutamiento');
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(result) {
        $('#modal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $("#modal-body").html(result);
      }
    });
  });
  /**
   * Evento para actualizar el enrutamiento
   */

  $(document).on('click', '.updatedidenrutamiento', function (event) {
    event.preventDefault();
    var dataForm = $("#formDataEnrutamiento").serializeArray();
    var data = {};
    $(dataForm).each(function (index, obj) {
      data[obj.name] = obj.value;
    });
    var _method = "PUT";
    var id = $("#idSeleccionado").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + 'inbound/Did_Enrutamiento/' + id;
    $.ajax({
      url: url,
      type: "post",
      data: {
        dataForm: data,
        _method: _method,
        _token: _token
      }
    }).done(function (data) {
      $('#modal').modal('hide');
      $('.modal-backdrop ').css('display', 'none');
      $('.viewResult').html(data);
      $('.viewResult #tableCondicionTiempo').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido actualizado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Accion para mostrar las opciones en base al destino seleccionado
   */

  $(document).on('change', '.destino', function (event) {
    var nombre = $(this).attr('name');
    var opccion = $(this).val();

    var _token = $("input[name=_token]").val();

    nombre = nombre.replace('destino_', '');
    var id = 0 + '&' + opccion + '&' + nombre;
    var url = currentURL + 'inbound/Did_Enrutamiento/' + id;
    $.ajax({
      url: url,
      type: "GET",
      data: {
        _token: _token
      }
    }).done(function (data) {
      $('#opcionesDestino_' + nombre).html(data);
    });
  });
  /**
   * Evento para agregar una condición de tiempo adicional
   */

  $(document).on('click', '#addRuta', function (event) {
    var clickID = $("#condicion tbody tr.clonar:last").attr('id').replace('tr_', ''); // Genero el nuevo numero id

    var newID = parseInt(clickID) + 1;
    var IDInput = ['id_campo', 'descripcion_campo', 'destino'];
    fila = $("#condicion tbody tr:eq()").clone().appendTo("#condicion"); //Clonamos la fila

    for (var i = 0; i < IDInput.length; i++) {
      fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
    }

    fila.find('.opcionesDestino').attr('id', "opcionesDestino_" + newID);
    fila.find('.form-control').attr('value', '');
    fila.find('.btn-danger').css('display', 'initial');
    fila.attr("id", 'tr_' + newID);
  });
  /**
   * Evento para eliminar una fila de la tabla de nueva condicion de tiempo
   */

  $(document).on('click', '.tr_remove', function () {
    var tr = $(this).closest('tr');
    tr.remove();
  });
  /**
   * Evento para eliminar una fila de la tabla de nueva condicion de tiempo
   */

  $(document).on('click', '.tr_edit_remove', function () {
    var tr = $(this).closest('tr');
    var id = $(this).data('id');
    var _method = "DELETE";

    var _token = $("input[name=_token]").val();

    var url = currentURL + 'inbound/Did_Enrutamiento/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        tr.remove();
      }
    });
  });
  /**
   * Funcion para mostrar los errores de los formularios
   */

  function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $(".form-control").removeClass('is-invalid');

    for (var clave in msg) {
      var data = clave.split('.');
      $("[name='" + data[1] + "']").addClass('is-invalid');

      if (msg.hasOwnProperty(clave)) {
        var valor = msg[clave][0].split('.');
        var value = valor[1].replace(' ', '_');

        if (value.indexOf('_') > -1) {
          var v = value.split('_');
          $(".print-error-msg").find("ul").append('<li>' + v[0] + ' es un campo obligatorio</li>');
        } else {
          $(".print-error-msg").find("ul").append('<li>' + valor[1] + '</li>');
        }
      }
    }
  }
});
;

/***/ }),

/***/ "./resources/js/module_inbound/Metricas_ACD.js":
/*!*****************************************************!*\
  !*** ./resources/js/module_inbound/Metricas_ACD.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para deshabilitar reporte con base si se eligio
   * general o una campana en especifico.
   */

  $(document).on("change", "#campana", function (e) {
    if ($(this).val() == 0) {
      $("#tendencia").prop('disabled', true);
      $("#calificaciones").prop('disabled', true);
    } else {
      $("#tendencia").prop('disabled', false);
      $("#calificaciones").prop('disabled', false);
    }
  });
  /**
   * Evento para mostrar el input para el tiempo de evaluación
   * en tendencia
   */

  $(document).on("change", "input[name=nivel-servicio]", function (e) {
    if (this.checked) {
      $("#div-tiempo-evaluacion").slideDown();
    } else {
      $("#div-tiempo-evaluacion").slideUp();
    }
  });
  /**
   * Evento para el menu de sub categorias y mostrar la vista
   */

  $(document).on("click", ".generarReporteACD", function (e) {
    var url = currentURL + 'inbound/Metricas_ACD';
    var fecha_inicio = $("#fecha-inicio").val();
    var hora_inicio = $("#hora_inicio").val();
    var min_inicio = $("#min_inicio").val();
    var fecha_fin = $("#fecha-fin").val();
    var hora_fin = $("#hora_fin").val();
    var min_fin = $("#min_fin").val();
    dateInicio = fecha_inicio + " " + hora_inicio + ":" + min_inicio + ":00";
    dateFin = fecha_fin + " " + hora_fin + ":" + min_fin + ":00";
    var campana = $("#campana").val();
    var tiempoEvaluacion = $("#tiempo-evalucaion").val();

    var _token = $("input[name=_token]").val();

    var data = {};
    $('input[type=checkbox]').each(function () {
      if (this.checked) {
        data[this.id] = 1;
      } else {
        data[this.id] = 0;
      }
    });

    if (data['nivel-servicio'] == 1 && tiempoEvaluacion == '') {
      Swal.fire('Error!', 'Tienes que ingresar un tiempo de evaluación.', 'error');
    } else {
      /**
       * Esto contrae el body
       */
      $('.filtro-reporte').slideUp();
      $('.nuevo-reporte').slideDown();
      $('#viewReporte').slideDown();
      e.preventDefault();
      $.ajax({
        url: url,
        type: "post",
        data: {
          dateInicio: dateInicio,
          dateFin: dateFin,
          campana: campana,
          data: data,
          tiempoEvaluacion: tiempoEvaluacion,
          _token: _token
        }
      }).done(function (data) {
        $('.viewReporte').html(data);
      });
    }
  });
  /**
   * Evento para mostrar el formulario de crear un nuevo reporte
   */

  $(document).on("click", ".nuevo-reporte", function (e) {
    /**
     * Esto contrae el body
     */
    $('.viewReporte').html('');
    $('.filtro-reporte').slideDown();
    $('.nuevo-reporte').slideUp();
    $('#viewReporte').slideUp();
    e.preventDefault();
  });
  /**
   * Evento para poder descargar el reporte
   */

  $(document).on("click", ".descargar-reporte", function (e) {
    /**
     * Con esto traemos las variables
     */
    var fechainicio = $("#fechainicio").val();
    var fechafin = $("#fechafin").val();
    var hora_inicio = $("#hora_inicio").val();
    var minuto_inicio = $("#min_inicio").val();
    var hora_fin = $("#hora_fin").val();
    var minuto_fin = $("#min_fin").val();
    dateinicio = fechainicio + " " + hora_inicio + ":" + minuto_inicio + ":00";
    datefin = fechafin + " " + hora_fin + ":" + minuto_fin + ":59";
    var url = currentURL + "inbound/Metricas_ACD/descargar/" + dateinicio + "/" + datefin;
    $('#iFrameDescarga').attr('src', url);
  });
});

/***/ }),

/***/ "./resources/js/module_inbound/buzon_voz.js":
/*!**************************************************!*\
  !*** ./resources/js/module_inbound/buzon_voz.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para seleccionar un Buzon de Voz
   */

  $(document).on('click', '#tableBuzonVoz tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".deleteBuzonVoz").slideDown();
    $(".editBuzonVoz").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableDesvios tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  ;
  /**
   * Evento para mostrar el formulario de crear un nuevo Buzon de voz
   */

  $(document).on("click", ".newBuzonVoz", function (e) {
    event.preventDefault();
    $('#tituloModal').html('Agregar Buzon De Voz');
    $('#action').removeClass('deleteBuzonVoz');
    $('#action').addClass('saveBuzonVoz');
    var url = currentURL + "inbound/Buzon_Voz/create";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo agente
   */

  $(document).on('click', '.saveBuzonVoz', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var tiempo_maximo = $("#tiempo_maximo").val();
    var terminacion = $("#terminacion").val();
    var Audios_Empresa_id = $("#Audios_Empresa_id").val();
    var correos = $("#correos").val();
    var Empresas_id = $("#Empresas_id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + 'inbound/Buzon_Voz';
    $.post(url, {
      nombre: nombre,
      tiempo_maximo: tiempo_maximo,
      terminacion: terminacion,
      Audios_Empresa_id: Audios_Empresa_id,
      correos: correos,
      Empresas_id: Empresas_id,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('#modal').modal('hide');
      $('.modal-backdrop ').css('display', 'none');
      $('.viewResult').html(data);
      $('.viewResult #tableBuzonVoz').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar un buzon
   *
   */

  $(document).on('click', '.deleteBuzonVoz', function (event) {
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
    }).then(function (result) {
      if (result.value) {
        var id = $("#idSeleccionado").val();
        var _method = "DELETE";

        var _token = $("input[name=_token]").val();

        var url = currentURL + 'inbound/Buzon_Voz/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableBuzonVoz').DataTable({
              "lengthChange": false
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Evento para visualizar la configuración del Buzon de Voz y editarlo
   */

  $(document).on('click', '.editBuzonVoz', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    var url = currentURL + 'inbound/Buzon_Voz/' + id + '/edit';
    $('#tituloModal').html('Editar Buzon De Voz');
    $('#action').addClass('updateBuzonVoz');
    $('#action').removeClass('saveBuzonVoz');
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(result) {
        $('#modal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $("#modal-body").html(result);
      }
    });
  });
  /**
   * Evento para guardar los cambios del Desvio
   */

  $(document).on('click', '.updateBuzonVoz', function (event) {
    event.preventDefault();
    var id = $("#id").val();
    var nombre = $("#nombre").val();
    var tiempo_maximo = $("#tiempo_maximo").val();
    var terminacion = $("#terminacion").val();
    var Audios_Empresa_id = $("#Audios_Empresa_id").val();
    var correos = $("#correos").val();
    var Empresas_id = $("#Empresas_id").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + 'inbound/Buzon_Voz/' + id;
    $.post(url, {
      nombre: nombre,
      tiempo_maximo: tiempo_maximo,
      terminacion: terminacion,
      Audios_Empresa_id: Audios_Empresa_id,
      correos: correos,
      Empresas_id: Empresas_id,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      $('.viewResult').html(data);
      $('.viewResult #tableBuzonVoz').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Funcion para mostrar los errores de los formularios
   */

  function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $(".form-control").removeClass('is-invalid');

    for (var clave in msg) {
      $("#" + clave).addClass('is-invalid');

      if (msg.hasOwnProperty(clave)) {
        $(".print-error-msg").find("ul").append('<li>' + msg[clave][0] + '</li>');
      }
    }
  }
});

/***/ }),

/***/ "./resources/js/module_inbound/campanas.js":
/*!*************************************************!*\
  !*** ./resources/js/module_inbound/campanas.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar las campanas
   */

  $(document).on('click', '#tableCampanas tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
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

  $(document).on('click', '.deleteCampana', function (event) {
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
    }).then(function (result) {
      if (result.value) {
        var id = $("#idSeleccionado").val();
        var _method = "DELETE";

        var _token = $("input[name=_token]").val();

        var url = currentURL + 'inbound/campanas/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableCampanas').DataTable({
              "lengthChange": false
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Evento para mostrar el formulario para crear la nueva campana
   */

  $(document).on("click", ".newCampana", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Nueva Campaña');
    var url = currentURL + 'inbound/campanas/create';
    agentesParticipantes = new Array();
    $('#action').removeClass('updateCampana');
    $('#action').addClass('saveCampana');
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(result) {
        $('#modal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $("#modal-body").html(result);
      }
    });
  });
  /**
   * Evento para guardar la nueva campana
   */

  $(document).on('click', '.saveCampana', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var agentesParticipantes = $("#agentes_participantes").val();
    var mlogeo = $("#mlogeo").val();
    var strategy = $("#strategy").val();
    var wrapuptime = $("#wrapuptime").val();
    var msginical = $("#msginical").val();
    var periodic_announce = $("#periodic_announce").val();
    var periodic_announce_frequency = $("#periodic_announce_frequency").val(); //let musicclass = $("#musicclass").val();

    var script = $("#script").val();
    var alertstll = $("#alertstll").val();
    var alertstdll = $("#alertstdll").val();
    var libta = $("#libta").val();
    var cal_lib = $("#cal_lib").val();
    var cal_camp = $("#cal_camp").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + 'inbound/campanas';
    $.ajax({
      url: url,
      type: "post",
      data: {
        nombre: nombre,
        agentesParticipantes: agentesParticipantes,
        mlogeo: mlogeo,
        strategy: strategy,
        wrapuptime: wrapuptime,
        msginical: msginical,
        periodic_announce: periodic_announce,
        periodic_announce_frequency: periodic_announce_frequency,
        //musicclass: musicclass,
        script: script,
        alertstll: alertstll,
        alertstdll: alertstdll,
        libta: libta,
        cal_lib: cal_lib,
        cal_camp: cal_camp,
        _token: _token
      }
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      $('.viewResult').html(data);
      $('.viewResult #tableCampanas').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
      agentesParticipantes.length = 0;
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para visualizar la configuración de la campana
   */

  $(document).on('click', '.editCampana', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    $('#tituloModal').html('Detalles de Campana');
    var url = currentURL + 'inbound/campanas/' + id + '/edit';
    $('#action').addClass('updaCampanas');
    $('#action').removeClass('saveCampana');
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(result) {
        $('#modal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $("#modal-body").html(result);
        agentesParticipantes = JSON.parse($("#agentes_participantes").val());
      }
    });
  });
  /**
   * Evento para guardar los cambios de la campana
   */

  $(document).on('click', '.updaCampanas', function (event) {
    event.preventDefault();
    var id = $("#id").val();
    var nombre = $("#nombre").val();
    var agentesParticipantes = $("#agentes_participantes").val();
    var mlogeo = $("#mlogeo").val();
    var strategy = $("#strategy").val();
    var wrapuptime = $("#wrapuptime").val();
    var msginical = $("#msginical").val();
    var periodic_announce = $("#periodic_announce").val();
    var periodic_announce_frequency = $("#periodic_announce_frequency").val(); //let musicclass = $("#musicclass").val();

    var script = $("#script").val();
    var alertstll = $("#alertstll").val();
    var alertstdll = $("#alertstdll").val();
    var libta = $("#libta").val();
    var cal_lib = $("#cal_lib").val();
    var cal_camp = $("#cal_camp").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + 'inbound/campanas/' + id;
    $.post(url, _defineProperty({
      nombre: nombre,
      agentesParticipantes: agentesParticipantes,
      mlogeo: mlogeo,
      strategy: strategy,
      wrapuptime: wrapuptime,
      msginical: msginical,
      periodic_announce: periodic_announce,
      periodic_announce_frequency: periodic_announce_frequency,
      //musicclass: musicclass,
      script: script,
      alertstll: alertstll,
      alertstdll: alertstdll,
      libta: libta,
      cal_lib: cal_lib,
      cal_camp: cal_camp,
      _token: _token,
      _method: _method
    }, "_token", _token), function (data, textStatus, xhr) {
      $('#modal').modal('hide');
      $('.modal-backdrop ').css('display', 'none');
      $('.viewResult').html(data);
      $('.viewResult #tableCampanas').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido editado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para agregar agentes a la campana
   */

  $(document).on('click', '.agentesNoSeleccionados', function (event) {
    var modoLogueo = $('#mlogeo').val();

    if (modoLogueo == "") {
      Swal.fire('!Tenemos un problema!', 'Tienes que elegir primero la modalidad de logueo a usar en esta campaña.', 'warning');
    } else {
      var _token = $("input[name=_token]").val();

      var url = currentURL + 'inbound/campanas/validar_modo_logueo';
      var agentesSeleccionados = [];
      var agentesDiferentes = [];
      var agentesValidos = [];
      $("input[name='agentes_no']:checked").each(function () {
        agentesSeleccionados.push(parseInt(this.value));
      });

      if (agentesSeleccionados.length == 0) {
        Swal.fire('!Tenemos un problema!', 'Tienes que elegir por lo menos un agente que participara en esta campaña.', 'warning');
      } else {
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            idAgente: agentesSeleccionados
          },
          success: function success(result) {
            for (var i = 0; i < agentesSeleccionados.length; i++) {
              for (var j = 0; j < result.length; j++) {
                if (agentesSeleccionados[i] === parseInt(result[j]['Agentes_id'])) {
                  if (modoLogueo === result[j]['modalidad_logue']) {
                    agentesValidos.push(agentesSeleccionados[i]);
                  } else {
                    agentesDiferentes.push(agentesSeleccionados[i]);
                  }
                }
              }
            }

            if (agentesDiferentes.length > 0) {
              for (var _i = 0; _i < agentesDiferentes.length; _i++) {
                $("#tr_" + agentesDiferentes[_i]).css('background-color', '#ffc0c0');
              }

              Swal.fire('!Tenemos un problema!', 'No se puede agregar los agentes marcados en rojo, ya que esta campaña tiene diferente modalidad de logueo a las cuales ya estan agregados los agentes.', 'warning');
            }

            if (agentesValidos.length > 0) {
              $('#todos_no_selec').prop('checked', false);

              for (var _i2 = 0; _i2 < agentesValidos.length; _i2++) {
                var fila = $("#tr_" + agentesValidos[_i2]);
                fila.attr("background-color", '');
                fila.clone().appendTo(".agenteSelec"); //Clonamos la fila

                $(".agenteSelec #tr_" + agentesValidos[_i2]).css('background-color', '');
                $(".agenteSelec #tr_" + agentesValidos[_i2] + " input[name='agentes_no']").prop('checked', false);
                agentesParticipantes.push(agentesValidos[_i2]);
                $("#agentes_participantes").val(JSON.stringify(agentesParticipantes));
                fila.remove();
              }
            }
          }
        });
      }
    }
  });
  /**
   * Evento para quitar agentes a la campana
   */

  $(document).on('click', '.agentesSeleccionados', function (event) {
    $('#todos_selec').prop('checked', false);
    $(".agenteSelec input[name='agentes_no']:checked").each(function () {
      var fila = $(".agenteSelec #tr_" + this.value);
      var index = agentesParticipantes.indexOf(parseInt(this.value));

      if (index > -1) {
        agentesParticipantes.splice(index, 1);
      }

      fila.clone().appendTo(".agentesNoSelec"); //Clonamos la fila

      fila.remove();
    });
    $(".agentesNoSelec input[name='agentes_no']").prop('checked', false);
    $("#agentes_participantes").val(JSON.stringify(agentesParticipantes));
  });
  $(document).on('change', '.mlogueoEditar', function (event) {
    event.preventDefault();
    var mLogueoInicial = $("#mlogueoInicial").val();
    Swal.fire({
      title: 'Estas seguro?',
      text: "Al cambiar la modalidad de logueo, se quitaran los agentes participantes, para evitar problemas con la modalidad de logueo en otras campañas en las que participen los agentes",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, quitar de campaña!',
      cancelButtonText: 'Cancelar'
    }).then(function (result) {
      if (result.value) {
        var camapana_id = $("#id").val();

        var _token = $("input[name=_token]").val();

        var url = currentURL + 'inbound/campanas/eliminar-participantes';
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            camapana_id: camapana_id
          },
          success: function success(result) {
            $(".agenteSelec tr").each(function () {
              $(this).clone().appendTo(".agentesNoSelec");
              var index = agentesParticipantes.indexOf($(this).data('id'));

              if (index > -1) {
                agentesParticipantes.splice(index, 1);
              }

              $("#agentes_participantes").val(JSON.stringify(agentesParticipantes));
              $(this).remove();
            });
          }
        });
      } else {
        $('#mlogeo').val(mLogueoInicial);
      }
    });
  });
  /**
   * Seleccionar todos los no seleccionados
   */

  $(document).on('change', '#todos_no_selec', function (event) {
    $(".agentesNoSelec input[name='agentes_no']").prop('checked', $(this).prop("checked"));
  });
  /**
   * Seleccionar todos los seleccionados
   */

  $(document).on('change', '#todos_selec', function (event) {
    $(".agenteSelec input[name='agentes_no']").prop('checked', $(this).prop("checked"));
  });
  /**
   * Evento para capturar el nombre de la campana y mostrar en la etiqueta
   */

  $(document).on('keyup', '#nombre', function (event) {
    var valor = $('#nombre').val();
    $(".nombreCampana").text(valor);
  });
  /**
   * Funcion para mostrar los errores de los formularios
   */

  function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $(".form-control").removeClass('is-invalid');

    for (var clave in msg) {
      $("#" + clave).addClass('is-invalid');

      if (msg.hasOwnProperty(clave)) {
        $(".print-error-msg").find("ul").append('<li>' + msg[clave][0] + '</li>');
      }
    }
  }
});

/***/ }),

/***/ "./resources/js/module_inbound/desglosellamadas.js":
/*!*********************************************************!*\
  !*** ./resources/js/module_inbound/desglosellamadas.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo ivr
   */

  $(document).on("click", ".generardesglose", function (e) {
    /**
     * Esto contrae el body
     */
    $('.body-filtro').slideUp();
    $('.nuevo-reporte').slideDown();
    $('#body-reporte').slideDown();
    e.preventDefault();
    /**
     * Con esto traemos las variables
     */

    var fechainicio = $("#fechainicio").val();
    var fechafin = $("#fechafin").val();
    var hora_inicio = $("#hora_inicio").val();
    var minuto_inicio = $("#min_inicio").val();
    var hora_fin = $("#hora_fin").val();
    var minuto_fin = $("#min_fin").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + "inbound/Desglose_llamadas";
    var dateinicio = fechainicio + " " + hora_inicio + ":" + minuto_inicio + ":00";
    var datefin = fechafin + " " + hora_fin + ":" + minuto_fin + ":59";
    /**
     * Con esto mandamos las variables
     */

    $.ajax({
      url: url,
      type: 'POST',
      data: {
        dateinicio: dateinicio,
        datefin: datefin,
        _token: _token
      },
      success: function success(result) {
        $('.viewreportedesglose').html(result);
      }
    });
  });
  /**
   * Evento para mostrar el formulario de crear un nuevo ivr
   */

  $(document).on("click", ".nuevo-reporte", function (e) {
    /**
     * Esto contrae el body
     */
    $('.viewreportedesglose').html('');
    $('.body-filtro').slideDown();
    $('.nuevo-reporte').slideUp();
    $('#body-reporte').slideUp();
    e.preventDefault();
  });
  /**
   * Evento para poder descargar el reporte
   */

  $(document).on("click", ".descargar-reporte", function (e) {
    /**
     * Con esto traemos las variables
     */
    var fechainicio = $("#fechainicio").val();
    var fechafin = $("#fechafin").val();
    var hora_inicio = $("#hora_inicio").val();
    var minuto_inicio = $("#min_inicio").val();
    var hora_fin = $("#hora_fin").val();
    var minuto_fin = $("#min_fin").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    dateinicio = fechainicio + " " + hora_inicio + ":" + minuto_inicio + ":00";
    datefin = fechafin + " " + hora_fin + ":" + minuto_fin + ":59";
    var url = currentURL + "inbound/Desglose_llamadas/descargar/" + dateinicio + "/" + datefin;
    $('#iFrameDescarga').attr('src', url);
  });
});

/***/ }),

/***/ "./resources/js/module_inbound/desvios.js":
/*!************************************************!*\
  !*** ./resources/js/module_inbound/desvios.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para seleccionar un desvio
   */

  $(document).on('click', '#tableDesvios tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".deleteDesvio").slideDown();
    $(".editDesvio").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableDesvios tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  ;
  /**
   * Evento para eliminar un desvio
   *
   */

  $(document).on('click', '.deleteDesvio', function (event) {
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
    }).then(function (result) {
      if (result.value) {
        var id = $("#idSeleccionado").val();
        var _method = "DELETE";

        var _token = $("input[name=_token]").val();

        var url = currentURL + 'inbound/Desvios/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableDesvios').DataTable({
              "lengthChange": false
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Evento para mostrar el formulario de crear un nuevo desvio
   */

  $(document).on("click", ".newDesvio", function (e) {
    event.preventDefault();
    $('#tituloModal').html('Agregar Desvio');
    $('#action').removeClass('deleteDesvio');
    $('#action').addClass('saveDesvio');
    var url = currentURL + "inbound/Desvios/create";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo agente
   */

  $(document).on('click', '.saveDesvio', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var Canales_id = $("#Canales_id").val();
    var dial = $("#dial").val();
    var ringeo = $("#ringeo").val();
    var Empresas_id = $("#Empresas_id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + 'inbound/Desvios';
    $.post(url, {
      nombre: nombre,
      Canales_id: Canales_id,
      dial: dial,
      ringeo: ringeo,
      Empresas_id: Empresas_id,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('#modal').modal('hide');
      $('.modal-backdrop ').css('display', 'none');
      $('.viewResult').html(data);
      $('.viewResult #tableDesvios').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar un desvio
   *
   */

  $(document).on('click', '.deleteDesvio', function (event) {
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
    }).then(function (result) {
      if (result.value) {
        var id = $("#idSeleccionado").val();
        var _method = "DELETE";

        var _token = $("input[name=_token]").val();

        var url = currentURL + 'inbound/Desvios/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableDesvios').DataTable({
              "lengthChange": false
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Evento para visualizar la configuración del Desvio y editarlo
   */

  $(document).on('click', '.editDesvio', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    var url = currentURL + 'inbound/Desvios/' + id + '/edit';
    $('#tituloModal').html('Editar Desvio');
    $('#action').addClass('updateDesvio');
    $('#action').removeClass('saveDesvio');
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(result) {
        $('#modal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $("#modal-body").html(result);
      }
    });
  });
  /**
   * Evento para guardar los cambios del Desvio
   */

  $(document).on('click', '.updateDesvio', function (event) {
    event.preventDefault();
    var id = $("#id").val();
    var nombre = $("#nombre").val();
    var Canales_id = $("#Canales_id").val();
    var dial = $("#dial").val();
    var ringeo = $("#ringeo").val();
    var Empresas_id = $("#Empresas_id").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + 'inbound/Desvios/' + id;
    $.post(url, {
      nombre: nombre,
      Canales_id: Canales_id,
      dial: dial,
      ringeo: ringeo,
      Empresas_id: Empresas_id,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('#modal').modal('hide');
      $('.modal-backdrop ').css('display', 'none');
      $('.viewResult #tableDesvios').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Funcion para mostrar los errores de los formularios
   */

  function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $(".form-control").removeClass('is-invalid');

    for (var clave in msg) {
      $("#" + clave).addClass('is-invalid');

      if (msg.hasOwnProperty(clave)) {
        $(".print-error-msg").find("ul").append('<li>' + msg[clave][0] + '</li>');
      }
    }
  }
});

/***/ }),

/***/ "./resources/js/module_inbound/ivr.js":
/*!********************************************!*\
  !*** ./resources/js/module_inbound/ivr.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo ivr
   */

  $(document).on("click", ".newIvr", function (e) {
    event.preventDefault();
    $('#tituloModal').html('Nuevo IVR');
    $('#action').removeClass('updateIvr');
    $('#action').addClass('saveIvr');
    var url = currentURL + "inbound/Ivr/create";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal({
        backdrop: 'static',
        keyboard: false
      });
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo agente
   */

  $(document).on('click', '.saveIvr', function (event) {
    event.preventDefault();
    var dataForm = $("#formCreateIvr").serializeArray();
    var data = {};
    $(dataForm).each(function (index, obj) {
      data[obj.name] = obj.value;
    });
    var Empresas_id = $("#Empresas_id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + 'inbound/Ivr';
    $.post(url, {
      Empresas_id: Empresas_id,
      dataForm: data,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      $('.viewResult').html(data);
      $('.viewResult #tableivr').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para agregar una condición de tiempo adicional
   */

  $(document).on('click', '#addOpcion', function (event) {
    var clickID = $(".tableOpciones tbody tr:last").attr('id').replace('tr_', '');
    var newID = parseInt(clickID) + 1; // Genero el nuevo numero id

    fila = $(".tableOpciones tbody tr:eq()").clone().appendTo(".tableOpciones"); //Clonamos la fila

    var IDInput = ['tipo', 'digito', 'destino', 'opcion_id'];

    for (var i = 0; i < IDInput.length; i++) {
      fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
    }

    fila.find('.opcionesDestino').attr('id', "opcionesDestino_" + newID);
    fila.find('.form-control').attr('value', '');
    fila.find('.btn-danger').css('display', 'initial');
    fila.attr("id", 'tr_' + newID);
  });
  /**
   * Accion para mostrar las opciones en base al destino seleccionado
   */

  $(document).on('change', '.destinoOpccionIvr', function (event) {
    var nombre = $(this).attr('name');
    var opccion = $(this).val();

    var _token = $("input[name=_token]").val();

    nombre = nombre.replace('destino_', '');
    var id = 0 + '&' + opccion + '&' + nombre;
    var url = currentURL + 'inbound/Did_Enrutamiento/' + id;
    $.ajax({
      url: url,
      type: "GET",
      data: {
        _token: _token
      }
    }).done(function (data) {
      $('#opcionesDestino_' + nombre).html(data);
    });
  });
  /**
   * Evento para seleccionar un Enrutamiento
   */

  $(document).on('click', '#tableivr tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".deleteIvr").slideDown();
    $(".editIvr").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableivr tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para eliminar el grupo de condicion de tiempo
   */

  $(document).on('click', '.deleteIvr', function (event) {
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
    }).then(function (result) {
      if (result.value) {
        var id = $("#idSeleccionado").val();
        var _method = "DELETE";

        var _token = $("input[name=_token]").val();

        var url = currentURL + 'inbound/Ivr/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableivr').DataTable({
              "lengthChange": false
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Evento para editar la configuración de grupo de condicion de tiempo
   */

  $(document).on('click', '.editIvr', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    $('#tituloModal').html('Edicion IVR');
    var url = currentURL + 'inbound/Ivr/' + id + '/edit';
    $('#action').addClass('updateIvr');
    $('#action').removeClass('saveIvr');
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(result) {
        $('#modal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $("#modal-body").html(result);
      }
    });
  });
  /**
   * Evento para eliminar una fila de la tabla de nueva condicion de tiempo
   */

  $(document).on('click', '.tr_remove_opcion_ivr', function () {
    var tr = $(this).closest('tr');
    var id = $(this).data('id');
    var _method = "DELETE";

    var _token = $("input[name=_token]").val();

    var url = currentURL + 'inbound/Ivr_Opciones/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        tr.remove();
      }
    });
  });
  /**
   * Evento para guardar el nuevo agente
   */

  $(document).on('click', '.updateIvr', function (event) {
    event.preventDefault();
    var Empresas_id = $("#Empresas_id").val();
    var dataForm = $("#formCreateIvr").serializeArray();
    var data = {};
    $(dataForm).each(function (index, obj) {
      data[obj.name] = obj.value;
    });
    var id = $("#idSeleccionado").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + 'inbound/Ivr/' + id;
    $.post(url, {
      Empresas_id: Empresas_id,
      dataForm: data,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      $('.viewResult').html(data);
      $('.viewResult #tableivr').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Funcion para mostrar los errores de los formularios
   */

  function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $(".form-control").removeClass('is-invalid');
    $(".print-error-msg").find("ul").append('<li>Es un campo obligatorio</li>');

    for (var clave in msg) {
      var data = clave.split('.');
      $("[name='" + data[1] + "']").addClass('is-invalid');
    }
  }
});

/***/ }),

/***/ "./resources/js/module_inbound/menu.js":
/*!*********************************************!*\
  !*** ./resources/js/module_inbound/menu.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var timerListAgente = '';
  var currentURL = window.location.href;
  /**
   * Evento para el menu de sub categorias y mostrar la vista
   */

  $(document).on("click", ".sub-menu-inbound", function (e) {
    e.preventDefault();
    stop(timerListAgente);
    var id = $(this).attr('id');

    if (id == 'sub-16') {
      url = currentURL + 'inbound/campanas';
      table = '#tableFormulario';
    } else if (id == 'sub-32') {
      url = currentURL + 'inbound/Condiciones_Tiempo';
      table = '#tableCondicionesTiempo';
    } else if (id == 'sub-31') {
      url = currentURL + 'inbound/Desvios';
      table = '#tableDesvios';
    } else if (id == 'sub-34') {
      url = currentURL + 'inbound/Buzon_Voz';
      table = '#tableBuzonVoz';
    } else if (id == 'sub-30') {
      url = currentURL + 'inbound/Did_Enrutamiento';
      table = '#tableDidEnrutamiento';
    } else if (id == 'sub-6') {
      url = currentURL + 'inbound/Ivr';
      table = '#tableivr';
    } else if (id == 'sub-39') {
      url = currentURL + 'inbound/Metricas_ACD';
      table = '#tableACD';
    } else if (id == 'sub-40') {
      url = currentURL + 'inbound/Desglose_llamadas';
      table = '#tableDesgloseLlamadas';
    } else if (id == 'sub-42') {
      url = currentURL + 'inbound/ReporteCalificaciones';
      table = '#tableDesgloseLlamadas';
    } else if (id == 'sub-43') {
      url = currentURL + 'inbound/ReporteLlamadasAgentes';
      table = '#tableDesgloseLlamadas';
    } else if (id == 'sub-44') {
      url = currentURL + 'inbound/ReporteProductividadAgentes';
      table = '#tableDesgloseLlamadas';
    } else if (id == 'sub-45') {
      url = currentURL + 'inbound/ReporteTiempoInactivo';
      table = '#tableReporteTiempoInactivo';
    } else if (id == 'sub-26') {
      url = currentURL + 'inbound/real_time/';
      $.get(url, function (data, textStatus, jqXHR) {
        $(".viewResult").html(data);
        $('.viewResult listadoAgentes').DataTable({
          "lengthChange": true
        }); //start(url);

        url = currentURL + 'inbound/real_time/0';
        $.get(url, function (data, textStatus, jqXHR) {
          $(".viewIndex").html(data);
          $('.viewIndex listadoAgentes').DataTable({
            "lengthChange": true
          });
        });
        start(url);
      });
    }

    if (id != 26) {
      stop(timerListAgente);
      $.get(url, function (data, textStatus, jqXHR) {
        $(".viewResult").html(data);
        $('.viewResult' + table).DataTable({
          "lengthChange": true
        });
      });
    }
  });

  function stop(timer) {
    clearInterval(timer);
  }

  ;

  function start(url) {
    //use a one-off timer

    /**
     * Función para actualizar el listado de agentes
     * para poder obtener el estado de los agentes
     */
    timerListAgente = setInterval(function () {
      $.get(url, function (data, textStatus, jqXHR) {
        $(".viewIndex").html(data);
        $('.viewIndex listadoAgentes').DataTable({
          "lengthChange": true
        });
      });
    }, 3000);
  }
});

/***/ }),

/***/ "./resources/js/module_inbound/real_time.js":
/*!**************************************************!*\
  !*** ./resources/js/module_inbound/real_time.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar la pantalla del agente seleccionado
   */

  $(document).on("click", ".iniciar_monitoreo", function (e) {
    event.preventDefault();
    var idAgente = $(this).data('id');
    var url = currentURL + "inbound/real_time/agente/" + idAgente;
    var tab = window.open(url, '_blank');

    if (tab) {
      tab.focus(); //ir a la pestaña
    } else {
      alert('Pestañas bloqueadas, activa las ventanas emergentes (Popups) ');
      return false;
    }
  });
  $(document).on("click", ".detener_monitoreo", function (e) {
    event.preventDefault();
    var idAgente = $(this).data('id');
    var url = currentURL + "inbound/real_time/detener/" + idAgente;
    $.get(url, function (data, textStatus, jqXHR) {
      console.log(data);
    });
  });
});

/***/ }),

/***/ "./resources/js/module_inbound/reporteCalificaciones.js":
/*!**************************************************************!*\
  !*** ./resources/js/module_inbound/reporteCalificaciones.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para el menu de sub categorias y mostrar la vista
   */

  $(document).on("click", ".generarReporteCalificaciones", function (e) {
    var url = currentURL + 'inbound/ReporteCalificaciones';
    var fecha_inicio = $("#fecha-inicio").val();
    var hora_inicio = $("#hora_inicio").val();
    var min_inicio = $("#min_inicio").val();
    var fecha_fin = $("#fecha-fin").val();
    var hora_fin = $("#hora_fin").val();
    var min_fin = $("#min_fin").val();
    dateInicio = fecha_inicio + " " + hora_inicio + ":" + min_inicio + ":00";
    dateFin = fecha_fin + " " + hora_fin + ":" + min_fin + ":00";
    var campana = $("#campana").val();

    var _token = $("input[name=_token]").val();
    /**
     * Esto contrae el body
     */


    $('.filtro-reporte').slideUp();
    $('.nuevo-reporte').slideDown();
    $('#viewReporte').slideDown();
    e.preventDefault();
    $.ajax({
      url: url,
      type: "post",
      data: {
        dateInicio: dateInicio,
        dateFin: dateFin,
        campana: campana,
        _token: _token
      }
    }).done(function (data) {
      $('.viewReporte').html(data);
    });
  });
  /**
   * Evento para mostrar el formulario de crear un nuevo reporte
   */

  $(document).on("click", ".nuevo-reporte", function (e) {
    /**
     * Esto contrae el body
     */
    $('.viewReporte').html('');
    $('.filtro-reporte').slideDown();
    $('.nuevo-reporte').slideUp();
    $('#viewReporte').slideUp();
    e.preventDefault();
  });
});

/***/ }),

/***/ "./resources/js/module_inbound/reporteTiempoInactivo.js":
/*!**************************************************************!*\
  !*** ./resources/js/module_inbound/reporteTiempoInactivo.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para el menu de sub categorias y mostrar la vista
   */

  $(document).on("click", ".generarReporteTiempoInactivo", function (e) {
    var url = currentURL + 'inbound/ReporteTiempoInactivo';
    var fecha_inicio = $("#fecha-inicio").val();
    var hora_inicio = $("#hora_inicio").val();
    var min_inicio = $("#min_inicio").val();
    var fecha_fin = $("#fecha-fin").val();
    var hora_fin = $("#hora_fin").val();
    var min_fin = $("#min_fin").val();
    dateInicio = fecha_inicio + " " + hora_inicio + ":" + min_inicio + ":00";
    dateFin = fecha_fin + " " + hora_fin + ":" + min_fin + ":00";
    var agente = $("#agente").val();
    var grupo = $("#grupo").val();

    var _token = $("input[name=_token]").val();

    var arr = {};
    $('input[type=checkbox]').each(function () {
      if (this.checked) {
        arr[this.id] = 1;
      } else {
        arr[this.id] = 0;
      }
    });

    if (agente == 0) {
      agente = 'NULL';
    }

    if (grupo == 0) {
      grupo = 'NULL';
    }
    /**
     * Esto contrae el body
     */


    $('.filtro-reporte').slideUp();
    $('.nuevo-reporte').slideDown();
    $('#viewReporte').slideDown();
    e.preventDefault();
    $.ajax({
      url: url,
      type: "post",
      data: {
        dateInicio: dateInicio,
        dateFin: dateFin,
        agente: agente,
        grupo: grupo,
        _token: _token
      }
    }).done(function (data) {
      $('.viewReporte').html(data);

      for (var id in arr) {
        if (arr[id] == 0) {
          $("." + id).css('display', 'none');
        }
      }
    });
  });
  /**
   * Evento para deshabilitar grupo o agentes, dependiendo
   * que opcion eligan
   */

  $(document).on('change', '.agente-grupo', function (event) {
    if (this.name == 'agente' && this.value != 0) {
      $("#grupo").prop('disabled', true);
      $("#agente").prop('disabled', false);
    } else if (this.name == 'grupo' && this.value != 0) {
      $("#grupo").prop('disabled', false);
      $("#agente").prop('disabled', true);
    } else if (this.name == 'agente' && this.value == 0) {
      $("#grupo").prop('disabled', false);
    } else if (this.name == 'grupo' && this.value == 0) {
      $("#agente").prop('disabled', false);
    }
  });
  /**
   * Evento para deshabilitar todos los checkbox de tiempos
   */

  $(document).on('change', '#tiempos', function (event) {
    if ($(this).is(':checked')) {
      // Hacer algo si el checkbox ha sido seleccionado
      $(".checkbox-tiempos").prop("checked", true);
    } else {
      // Hacer algo si el checkbox ha sido deseleccionado
      $(".checkbox-tiempos").prop("checked", false);
    }
  });
  /**
   * Evento para mostrar el formulario de crear un nuevo reporte
   */

  $(document).on("click", ".nuevo-reporte", function (e) {
    /**
     * Esto contrae el body
     */
    $('.viewReporte').html('');
    $('.filtro-reporte').slideDown();
    $('.nuevo-reporte').slideUp();
    $('#viewReporte').slideUp();
    e.preventDefault();
  });
});

/***/ }),

/***/ "./resources/js/module_inbound/reporte_llamadas_agentes.js":
/*!*****************************************************************!*\
  !*** ./resources/js/module_inbound/reporte_llamadas_agentes.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para el menu de sub categorias y mostrar la vista
   */

  $(document).on("click", ".generarReporteLlamadasAgentes", function (e) {
    var url = currentURL + 'inbound/ReporteLlamadasAgentes';
    var fecha_inicio = $("#fecha-inicio").val();
    var hora_inicio = $("#hora_inicio").val();
    var min_inicio = $("#min_inicio").val();
    var fecha_fin = $("#fecha-fin").val();
    var hora_fin = $("#hora_fin").val();
    var min_fin = $("#min_fin").val();
    dateInicio = fecha_inicio + " " + hora_inicio + ":" + min_inicio + ":00";
    dateFin = fecha_fin + " " + hora_fin + ":" + min_fin + ":00";
    var agente = $("#agente").val();
    var grupo = $("#grupo").val();
    var campana = $("#campana").val();

    var _token = $("input[name=_token]").val();

    if (agente == 0) {
      agente = 'NULL';
    }

    if (grupo == 0) {
      grupo = 'NULL';
    }

    if (campana == 0) {
      campana = 'NULL';
    }
    /**
     * Esto contrae el body
     */


    $('.filtro-reporte').slideUp();
    $('.nuevo-reporte').slideDown();
    $('#viewReporte').slideDown();
    e.preventDefault();
    $.ajax({
      url: url,
      type: "post",
      data: {
        dateInicio: dateInicio,
        dateFin: dateFin,
        agente: agente,
        grupo: grupo,
        campana: campana,
        _token: _token
      }
    }).done(function (data) {
      $('.viewReporte').html(data);
    });
  });
  /**
   * Evento para deshabilitar grupo o agentes, dependiendo
   * que opcion eligan
   */

  $(document).on('change', '.agente-grupo', function (event) {
    if (this.name == 'agente' && this.value != 0) {
      $("#grupo").prop('disabled', true);
      $("#agente").prop('disabled', false);
    } else if (this.name == 'grupo' && this.value != 0) {
      $("#grupo").prop('disabled', false);
      $("#agente").prop('disabled', true);
    } else if (this.name == 'agente' && this.value == 0) {
      $("#grupo").prop('disabled', false);
    } else if (this.name == 'grupo' && this.value == 0) {
      $("#agente").prop('disabled', false);
    }
  });
  /**
   * Evento para mostrar el formulario de crear un nuevo reporte
   */

  $(document).on("click", ".nuevo-reporte", function (e) {
    /**
     * Esto contrae el body
     */
    $('.viewReporte').html('');
    $('.filtro-reporte').slideDown();
    $('.nuevo-reporte').slideUp();
    $('#viewReporte').slideUp();
    e.preventDefault();
  });
});

/***/ }),

/***/ "./resources/js/module_inbound/reporte_productividad_agentes.js":
/*!**********************************************************************!*\
  !*** ./resources/js/module_inbound/reporte_productividad_agentes.js ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para el menu de sub categorias y mostrar la vista
   */

  $(document).on("click", ".generarReporteProductividadAgentes", function (e) {
    var url = currentURL + 'inbound/ReporteProductividadAgentes';
    var fecha_inicio = $("#fecha-inicio").val();
    var hora_inicio = $("#hora_inicio").val();
    var min_inicio = $("#min_inicio").val();
    var fecha_fin = $("#fecha-fin").val();
    var hora_fin = $("#hora_fin").val();
    var min_fin = $("#min_fin").val();
    dateInicio = fecha_inicio + " " + hora_inicio + ":" + min_inicio + ":00";
    dateFin = fecha_fin + " " + hora_fin + ":" + min_fin + ":00";
    var agente = $("#agente").val();
    var grupo = $("#grupo").val();

    var _token = $("input[name=_token]").val();

    var arr = {};
    $('input[type=checkbox]').each(function () {
      if (this.checked) {
        arr[this.id] = 1;
      } else {
        arr[this.id] = 0;
      }
    });

    if (agente == 0) {
      agente = 'NULL';
    }

    if (grupo == 0) {
      grupo = 'NULL';
    }
    /**
     * Esto contrae el body
     */


    $('.filtro-reporte').slideUp();
    $('.nuevo-reporte').slideDown();
    $('#viewReporte').slideDown();
    e.preventDefault();
    $.ajax({
      url: url,
      type: "post",
      data: {
        dateInicio: dateInicio,
        dateFin: dateFin,
        agente: agente,
        grupo: grupo,
        _token: _token
      }
    }).done(function (data) {
      $('.viewReporte').html(data);

      for (var id in arr) {
        if (arr[id] == 0) {
          $("." + id).css('display', 'none');
        }
      }
    });
  });
  /**
   * Evento para deshabilitar grupo o agentes, dependiendo
   * que opcion eligan
   */

  $(document).on('change', '.agente-grupo', function (event) {
    if (this.name == 'agente' && this.value != 0) {
      $("#grupo").prop('disabled', true);
      $("#agente").prop('disabled', false);
    } else if (this.name == 'grupo' && this.value != 0) {
      $("#grupo").prop('disabled', false);
      $("#agente").prop('disabled', true);
    } else if (this.name == 'agente' && this.value == 0) {
      $("#grupo").prop('disabled', false);
    } else if (this.name == 'grupo' && this.value == 0) {
      $("#agente").prop('disabled', false);
    }
  });
  /**
   * Evento para deshabilitar todos los checkbox, de las llamadas
   */

  $(document).on('change', '#llamadas', function (event) {
    if ($(this).is(':checked')) {
      // Hacer algo si el checkbox ha sido seleccionado
      $(".checkbox-llamadas").prop("checked", true);
    } else {
      // Hacer algo si el checkbox ha sido deseleccionado
      $(".checkbox-llamadas").prop("checked", false);
    }
  });
  /**
   * Evento para deshabilitar todos los checkbox de tiempos
   */

  $(document).on('change', '#tiempos', function (event) {
    if ($(this).is(':checked')) {
      // Hacer algo si el checkbox ha sido seleccionado
      $(".checkbox-tiempos").prop("checked", true);
    } else {
      // Hacer algo si el checkbox ha sido deseleccionado
      $(".checkbox-tiempos").prop("checked", false);
    }
  });
  /**
   * Evento para mostrar el formulario de crear un nuevo reporte
   */

  $(document).on("click", ".nuevo-reporte", function (e) {
    /**
     * Esto contrae el body
     */
    $('.viewReporte').html('');
    $('.filtro-reporte').slideDown();
    $('.nuevo-reporte').slideUp();
    $('#viewReporte').slideUp();
    e.preventDefault();
  });
});

/***/ }),

/***/ 2:
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/module_inbound/menu.js ./resources/js/module_inbound/campanas.js ./resources/js/module_inbound/CondicionesTiempo.js ./resources/js/module_inbound/desvios.js ./resources/js/module_inbound/buzon_voz.js ./resources/js/module_inbound/Did_Enrutamiento.js ./resources/js/module_inbound/ivr.js ./resources/js/module_inbound/Metricas_ACD.js ./resources/js/module_inbound/desglosellamadas.js ./resources/js/module_inbound/real_time.js ./resources/js/module_inbound/reporteCalificaciones.js ./resources/js/module_inbound/reporte_llamadas_agentes.js ./resources/js/module_inbound/reporte_productividad_agentes.js ./resources/js/module_inbound/reporteTiempoInactivo.js ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_inbound/menu.js */"./resources/js/module_inbound/menu.js");
__webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_inbound/campanas.js */"./resources/js/module_inbound/campanas.js");
__webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_inbound/CondicionesTiempo.js */"./resources/js/module_inbound/CondicionesTiempo.js");
__webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_inbound/desvios.js */"./resources/js/module_inbound/desvios.js");
__webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_inbound/buzon_voz.js */"./resources/js/module_inbound/buzon_voz.js");
__webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_inbound/Did_Enrutamiento.js */"./resources/js/module_inbound/Did_Enrutamiento.js");
__webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_inbound/ivr.js */"./resources/js/module_inbound/ivr.js");
__webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_inbound/Metricas_ACD.js */"./resources/js/module_inbound/Metricas_ACD.js");
__webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_inbound/desglosellamadas.js */"./resources/js/module_inbound/desglosellamadas.js");
__webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_inbound/real_time.js */"./resources/js/module_inbound/real_time.js");
__webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_inbound/reporteCalificaciones.js */"./resources/js/module_inbound/reporteCalificaciones.js");
__webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_inbound/reporte_llamadas_agentes.js */"./resources/js/module_inbound/reporte_llamadas_agentes.js");
__webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_inbound/reporte_productividad_agentes.js */"./resources/js/module_inbound/reporte_productividad_agentes.js");
module.exports = __webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_inbound/reporteTiempoInactivo.js */"./resources/js/module_inbound/reporteTiempoInactivo.js");


/***/ })

/******/ });