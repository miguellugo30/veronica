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
    var url = currentURL + "/Condiciones_Tiempo/create";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal({
        backdrop: 'static',
        keyboard: false
      });
      $("#modal-body").html(data);
      $(".fecha_inicio").datepicker();
      $(".fecha_final").datepicker();
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
    $('#modal').modal('hide');
    var dataForm = $("#formDataCondicionTiempo").serializeArray();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/Condiciones_Tiempo';
    $.ajax({
      url: url,
      type: "post",
      data: {
        dataForm: dataForm,
        _token: _token
      }
    }).done(function (data) {
      $('.viewResult').html(data);
      $('.viewResult #tableCondicionTiempo').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    });
  });
  /**
   * Evento para agregar una condición de tiempo adicional
   */

  $(document).on('click', '#add', function (event) {
    $(".fecha_inicio").datepicker("destroy");
    $(".fecha_final").datepicker("destroy");
    var clickID = $(".tableNewForm tbody tr.clonar:last").attr('id').replace('tr_', ''); // Genero el nuevo numero id

    var newID = parseInt(clickID) + 1;
    var IDInput = ['id_campo', 'nombre_campo', 'hora_inicio', 'min_inicio', 'hora_fin', 'min_fin', 'dia_semana_inicio', 'dia_semana_fin', 'fecha_inicio', 'fecha_final', 'destino_verdadero', 'destino_falso', 'opciones_si_coincide', 'opciones_no_coincide'];
    fila = $(".tableNewForm tbody tr:eq()").clone().appendTo(".tableNewForm"); //Clonamos la fila

    for (var i = 0; i < IDInput.length; i++) {
      fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
    }

    fila.find('.opcionesSi').attr('id', "opcionesSiCoincide_" + newID);
    fila.find('.opcionesNo').attr('id', "opcionesNoCoincide_" + newID);
    $(".fecha_inicio").datepicker({
      dateFormat: "dd-mm-yy",
      beforeShow: function beforeShow() {
        name = $(this).attr('name');
        dateIni = $('input[name="fecha_inicio_1"]').val();
      },
      onSelect: function onSelect(date) {
        $('input[name="fecha_inicio_1"]').val(dateIni);
        $('input[name="' + name + '"]').val(date);
      }
    });
    dateIni = '';
    $(".fecha_final").datepicker({
      beforeShow: function beforeShow() {
        name = $(this).attr('name');
        nameIni = name.replace('fecha_final', 'fecha_inicio');
        dateIni = $('input[name="' + nameIni + '"]').val();
        dateFin = $('input[name="fecha_final_1"]').val();
      },
      minDate: new Date(dateIni),
      dateFormat: "dd-mm-yy",
      onSelect: function onSelect(date) {
        $('input[name="fecha_final_1"]').val(dateFin);
        $('input[name="' + name + '"]').val(date);
      }
    });
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

    var url = currentURL + '/Condiciones_Tiempo/' + id + '&CDT';
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

        var url = currentURL + '/Condiciones_Tiempo/' + id + "&GRP";
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
    var url = currentURL + '/Condiciones_Tiempo/' + id + '/edit';
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
        $(".fecha_inicio").datepicker();
        $(".fecha_final").datepicker();
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
    $('#modal').modal('hide');
    var dataForm = $("#formDataCondicionTiempo").serializeArray();
    var _method = "PUT";

    var _token = $("input[name=_token]").val();

    var id = 0;
    var url = currentURL + '/Condiciones_Tiempo/' + id;
    $.ajax({
      url: url,
      type: "post",
      data: {
        dataForm: dataForm,
        _method: _method,
        _token: _token
      }
    }).done(function (data) {
      $('.viewResult').html(data);
      $('.viewResult #tableCondicionTiempo').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido actualizado.', 'success');
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
    var url = currentURL + '/Condiciones_Tiempo/' + id;
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
    var url = currentURL + '/Did_Enrutamiento/' + id + '/edit';
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
    $('#modal').modal('hide');
    var dataForm = $("#formDataEnrutamiento").serializeArray();
    var _method = "PUT";
    var id = $("#idSeleccionado").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/Did_Enrutamiento/' + id;
    $.ajax({
      url: url,
      type: "post",
      data: {
        dataForm: dataForm,
        _method: _method,
        _token: _token
      }
    }).done(function (data) {
      $('.viewResult').html(data);
      $('.viewResult #tableCondicionTiempo').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido actualizado.', 'success');
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
    var url = currentURL + '/Did_Enrutamiento/' + id;
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

    var url = currentURL + '/Did_Enrutamiento/' + id;
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
});
;

/***/ }),

/***/ "./resources/js/module_inbound/Metricas_ACD.js":
/*!*****************************************************!*\
  !*** ./resources/js/module_inbound/Metricas_ACD.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {



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
    var url = currentURL + "/Buzon_Voz/create";
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
    $('#modal').modal('hide');
    var nombre = $("#nombre").val();
    var tiempo_maximo = $("#tiempo_maximo").val();
    var terminacion = $("#terminacion").val();
    var Audios_Empresa_id = $("#Audios_Empresa_id").val();
    var correos = $("#correos").val();
    var Empresas_id = $("#Empresas_id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/Buzon_Voz';
    $.post(url, {
      nombre: nombre,
      tiempo_maximo: tiempo_maximo,
      terminacion: terminacion,
      Audios_Empresa_id: Audios_Empresa_id,
      correos: correos,
      Empresas_id: Empresas_id,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #tableBuzonVoz').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
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

        var url = currentURL + '/Buzon_Voz/' + id;
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
    var url = currentURL + '/Buzon_Voz/' + id + '/edit';
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
    $('#modal').modal('hide');
    var id = $("#id").val();
    var nombre = $("#nombre").val();
    var tiempo_maximo = $("#tiempo_maximo").val();
    var terminacion = $("#terminacion").val();
    var Audios_Empresa_id = $("#Audios_Empresa_id").val();
    var correos = $("#correos").val();
    var Empresas_id = $("#Empresas_id").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/Buzon_Voz/' + id;
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
      $('.viewResult').html(data);
      $('.viewResult #tableBuzonVoz').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    });
  });
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

        var url = currentURL + '/campanas/' + id;
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
    var url = currentURL + '/campanas/create';
    agentesParticipantes = new Array();
    $('#action').removeClass('updateCampana');
    $('#action').addClass('saveCampana');
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(result) {
        $('#modal').modal('show');
        $("#modal-body").html(result);
      }
    });
  });
  /**
   * Evento para guardar la nueva campana
   */

  $(document).on('click', '.saveCampana', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
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

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/campanas';
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
        _token: _token
      }
    }).done(function (data) {
      $('.viewResult').html(data);
      $('.viewResult #tableCampanas').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
      agentesParticipantes.length = 0;
    });
  });
  /**
   * Evento para visualizar la configuración de la campana
   */

  $(document).on('click', '.editCampana', function (event) {
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
    $('#modal').modal('hide');
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

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/campanas/' + id;
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
      _token: _token,
      _method: _method
    }, "_token", _token), function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #tableCampanas').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido editado.', 'success');
    });
  });
  /**
   * Evento para agregar agentes a la campana
   */

  $(document).on('click', '.agentesNoSeleccionados tr', function (event) {
    var fila = $(this);
    var idAgente = $(this).data('id');
    var modoLogueo = $('#mlogeo').val();
    var bandera = true;

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/campanas/validar_modo_logueo';

    if (modoLogueo == "") {
      Swal.fire('!Tenemos un problema!', 'Tienes que elegir primero la modalidad de logueo a usar en esta campaña.', 'warning');
    } else {
      $.ajax({
        url: url,
        type: 'POST',
        data: {
          _token: _token,
          idAgente: idAgente
        },
        success: function success(result) {
          for (var i = 0; i < result.length; i++) {
            if (modoLogueo === result[i]['modalidad_logue']) {
              bandera = true;
            } else {
              bandera = false;
              break;
            }
          }

          if (bandera) {
            fila.clone().appendTo(".agentesSeleccionados"); //Clonamos la fila

            agentesParticipantes.push(idAgente);
            $("#agentes_participantes").val(JSON.stringify(agentesParticipantes));
            fila.remove();
          } else {
            Swal.fire('!Tenemos un problema!', 'No se puede agregar el agente seleccionado, ya que esta campaña tiene diferente modalidad de logueo a las cuales ya esta agregado el agente.', 'warning');
          }
        }
      });
    }
  });
  /**
   * Evento para quitar agentes a la campana
   */

  $(document).on('click', '.agentesSeleccionados tr', function (event) {
    $(this).clone().appendTo(".agentesNoSeleccionados"); //Clonamos la fila

    var index = agentesParticipantes.indexOf($(this).data('id'));

    if (index > -1) {
      agentesParticipantes.splice(index, 1);
    }

    $("#agentes_participantes").val(JSON.stringify(agentesParticipantes));
    $(this).remove();
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

        var url = currentURL + '/campanas/eliminar-participantes';
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            camapana_id: camapana_id
          },
          success: function success(result) {
            $("#tableAgentesParticipantes tbody tr").each(function () {
              $(this).clone().appendTo(".agentesNoSeleccionados");
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
   * Evento para capturar el nombre de la campana y mostrar en la etiqueta
   */

  $(document).on('keyup', '#nombre', function (event) {
    var valor = $('#nombre').val();
    $(".nombreCampana").text(valor);
  });
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
    //alert ('generar');

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
    var numero_origen = $("#numero_origen").val();
    var numero_destino = $("#numero_destino").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + "/Desglose_llamadas/";
    dateinicio = fechainicio + " " + hora_inicio + ":" + minuto_inicio + ":00";
    datefin = fechafin + " " + hora_fin + ":" + minuto_fin + ":59";
    /**
     * Con esto mandamos las variables
     */

    $.post(url, {
      dateinicio: dateinicio,
      datefin: datefin,
      numero_origen: numero_origen,
      numero_destino: numero_destino,
      //Empresas_id: Empresas_id,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewreportedesglose').html(data);
    });
  });
  /**
   * Evento para mostrar el formulario de crear un nuevo ivr
   */

  $(document).on("click", ".nuevo-reporte", function (e) {
    //alert ('generar');

    /**
     * Esto contrae el body
     */
    $('.body-filtro').slideDown();
    $('.nuevo-reporte').slideUp();
    $('#body-reporte').slideUp();
    e.preventDefault();
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

        var url = currentURL + '/Desvios/' + id;
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
    var url = currentURL + "/Desvios/create";
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
    $('#modal').modal('hide');
    var nombre = $("#nombre").val();
    var Canales_id = $("#Canales_id").val();
    var dial = $("#dial").val();
    var ringeo = $("#ringeo").val();
    var Empresas_id = $("#Empresas_id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/Desvios';
    $.post(url, {
      nombre: nombre,
      Canales_id: Canales_id,
      dial: dial,
      ringeo: ringeo,
      Empresas_id: Empresas_id,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #tableDesvios').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
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

        var url = currentURL + '/Desvios/' + id;
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
    var url = currentURL + '/Desvios/' + id + '/edit';
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
    $('#modal').modal('hide');
    var id = $("#id").val();
    var nombre = $("#nombre").val();
    var Canales_id = $("#Canales_id").val();
    var dial = $("#dial").val();
    var ringeo = $("#ringeo").val();
    var Empresas_id = $("#Empresas_id").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/Desvios/' + id;
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
      $('.viewResult #tableDesvios').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    });
  });
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
    var url = currentURL + "/Ivr/create";
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
    $('#modal').modal('hide');
    var dataForm = $("#formCreateIvr").serializeArray();
    var Empresas_id = $("#Empresas_id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/Ivr';
    $.post(url, {
      Empresas_id: Empresas_id,
      dataForm: dataForm,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #tableivr').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
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
    var url = currentURL + '/Did_Enrutamiento/' + id;
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
    $("#tabledidenrutamientos tbody tr").removeClass('table-primary');
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

        var url = currentURL + '/Ivr/' + id;
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
    var url = currentURL + '/Ivr/' + id + '/edit';
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

    var url = currentURL + '/Ivr_Opciones/' + id;
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
    $('#modal').modal('hide');
    var Empresas_id = $("#Empresas_id").val();
    var dataForm = $("#formCreateIvr").serializeArray();
    var id = $("#idSeleccionado").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/Ivr/' + id;
    $.post(url, {
      Empresas_id: Empresas_id,
      dataForm: dataForm,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #tableivr').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    });
  });
});

/***/ }),

/***/ "./resources/js/module_inbound/menu.js":
/*!*********************************************!*\
  !*** ./resources/js/module_inbound/menu.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para el menu de sub categorias y mostrar la vista
   */

  $(document).on("click", ".sub-menu", function (e) {
    e.preventDefault();
    var id = $(this).data("id");

    if (id == 16) {
      url = currentURL + '/campanas';
      table = ' #tableFormulario';
    } else if (id == 32) {
      url = currentURL + '/Condiciones_Tiempo';
      table = ' #tableCondicionesTiempo';
    } else if (id == 31) {
      url = currentURL + '/Desvios';
      table = ' #tableDesvios';
    } else if (id == 34) {
      url = currentURL + '/Buzon_Voz';
      table = ' #tableBuzonVoz';
    } else if (id == 30) {
      url = currentURL + '/Did_Enrutamiento';
      table = ' #tableDidEnrutamiento';
    } else if (id == 6) {
      url = currentURL + '/Ivr';
      table = ' #tableivr';
    } else if (id == 39) {
      url = currentURL + '/Metricas_ACD';
      table = ' #tableACD';
    } else if (id == 40) {
      url = currentURL + '/Desglose_llamadas';
      table = ' #tableDesgloseLlamadas';
    }

    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewResult").html(data);
      $('.viewResult' + table).DataTable({
        "lengthChange": true
      });
    });
  });
});

/***/ }),

/***/ 2:
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/module_inbound/menu.js ./resources/js/module_inbound/campanas.js ./resources/js/module_inbound/CondicionesTiempo.js ./resources/js/module_inbound/desvios.js ./resources/js/module_inbound/buzon_voz.js ./resources/js/module_inbound/Did_Enrutamiento.js ./resources/js/module_inbound/ivr.js ./resources/js/module_inbound/Metricas_ACD.js ./resources/js/module_inbound/desglosellamadas.js ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_inbound\menu.js */"./resources/js/module_inbound/menu.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_inbound\campanas.js */"./resources/js/module_inbound/campanas.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_inbound\CondicionesTiempo.js */"./resources/js/module_inbound/CondicionesTiempo.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_inbound\desvios.js */"./resources/js/module_inbound/desvios.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_inbound\buzon_voz.js */"./resources/js/module_inbound/buzon_voz.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_inbound\Did_Enrutamiento.js */"./resources/js/module_inbound/Did_Enrutamiento.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_inbound\ivr.js */"./resources/js/module_inbound/ivr.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_inbound\Metricas_ACD.js */"./resources/js/module_inbound/Metricas_ACD.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_inbound\desglosellamadas.js */"./resources/js/module_inbound/desglosellamadas.js");


/***/ })

/******/ });