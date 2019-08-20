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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/module_settings/acciones_formularios.js":
/*!**************************************************************!*\
  !*** ./resources/js/module_settings/acciones_formularios.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  /**
   * Evento para clonar una fila de la tabla de opciones
   */
  $(document).on('click', '.add_opc', function () {
    var clickID = $(".tableOpc tbody tr.clonar:last").attr('id').replace('tr_opciones_', ''); // Genero el nuevo numero id

    newID = parseInt(clickID) + 1;
    fila = $(".tableOpc tbody tr:eq()").clone().appendTo(".tableOpc"); //Clonamos la fila

    fila.find('#nombre_opcion').attr("name", 'campo_' + newID + '[]'); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre

    fila.find('#form_opcion').attr("name", 'campo_' + newID + '[]'); //Buscamos el campo con id tipo_campo y le agregamos un nuevo nombre

    fila.attr("id", 'tr_opciones_' + newID);
  });
  /**
   * Evento para clonar una fila de la tabla de nuevo canal
   */

  $(document).on('click', '#add', function () {
    var clickID = $(".tableNewForm tbody tr.clonar:last").attr('id').replace('tr_', '');
    $('#form_opc .form-control-sm').val(''); // Genero el nuevo numero id

    var newID = parseInt(clickID) + 1;
    fila = $(".tableNewForm tbody tr:eq()").clone().appendTo(".tableNewForm"); //Clonamos la fila

    fila.find('.opciones').attr('name', 'campo_' + newID + '[]'); //Buscamos el campo con id editable y le agregamos un nuevo nombre

    fila.find('#opciones_1').attr({
      id: 'opciones_' + newID,
      value: ''
    }); //Buscamos el campo con id editable y le agregamos un nuevo nombre

    fila.find('#obligatorio_hidden_1').attr({
      id: 'obligatorio_hidden_' + newID
    }); //Buscamos el campo con id editable y le agregamos un nuevo nombre

    fila.find('#editable_hidden_1').attr({
      id: 'editable_hidden_' + newID
    }); //Buscamos el campo con id editable y le agregamos un nuevo nombre

    fila.find('.btn-info').attr('id', 'view_' + newID);
    fila.find('.view').css('display', 'none');
    fila.attr("id", 'tr_' + newID);
  });
  $(document).on('click', '.micheckbox', function () {
    var id = $(this).attr('id');
    var idTR = $(this).attr('name').replace('campo_', '').replace('[]', '');
    var name = id + "_hidden_" + idTR;

    if ($(this).prop('checked')) {
      $("#" + name).prop("disabled", true);
    } else {
      $("#" + name).prop("disabled", false);
    }
  });
  /**
   * Evento para eliminar una fila de la tabla de nuevo formulario
   */

  $(document).on('click', '.tr_clone_remove_opcion', function () {
    var tr = $(this).closest('tr');
    tr.remove();
  });
  /**
   * Evento para eliminar una fila de la tabla de nuevo formulario
   */

  $(document).on('click', '.tr_clone_remove', function () {
    var tr = $(this).closest('tr');
    tr.remove();
  });
  /**
   * Evento para eliminar una fila de la tabla de nuevo formulario
   */

  $(document).on('click', '.tr_edit_remove', function () {
    var id = $(this).data('id-campo');
    var tr = $(this).closest('tr');
    tr.remove();
    var registros = $("#registros_borrados").val();

    if (registros == '') {
      registros = [id];
      $("#registros_borrados").val(registros);
    } else {
      registros = registros + "," + id;
      $("#registros_borrados").val(registros);
    }
  });
  /**
   * Evento para mostrar un modal para capturas los parámetros para
   * los campos de Opciones y Folios
   */

  $(document).on("change", "#tipo_campo", function (e) {
    var tipo = $(this).val();
    $('#action_opc').addClass('saveOpciones');
    idTR = $(this).attr('name').replace('campo_', '').replace('[]', '');

    if (tipo == 'asignador_folios') {
      $('#tituloModalOpciones').html('Parametros para los folios');
      $("#opcionesForm").slideUp();
      $("#folioForm").slideDown();
      $("#nombre_opcion").prop("disabled", true);
      $("#form_id").prop("disabled", true);
      $("#prefijo").prop("disabled", false);
      $("#folio").prop("disabled", false);
    } else if (tipo == 'select') {
      $('#tituloModalOpciones').html('Agregar opciones');
      $("#folioForm").slideUp();
      $("#opcionesForm").slideDown();
      $("#nombre_opcion").prop("disabled", false);
      $("#form_id").prop("disabled", false);
      $("#prefijo").prop("disabled", true);
      $("#folio").prop("disabled", true);
    }

    $("#modal_opciones_campo").modal({
      backdrop: 'static',
      keyboard: false
    });
  });
  /**
   * Evento para guardar las opciones de los campos, Folio y Opciones
   */

  $(document).on('click', '.saveOpciones', function (event) {
    event.preventDefault();
    var dataOpciones = $("#form_opc").serialize();
    $('input[id="opciones_' + idTR + '"]').val(dataOpciones);
    $("#modal_opciones_campo").modal('hide');
    $("#view_" + idTR).slideDown();
    /**
     * Limpiamos todos los input del formulario
     * de Opciones
     */

    $('#form_opc .form-control-sm').val('');
    /**
     * Eliminamos las opciones adicionales
     * dentro de la tabla de opciones
     */

    for (var i = newID; i > 1; i--) {
      $("#tr_opciones_" + i).remove();
    }
  });
  /**
   * Evento para cerrar el modal de las opciones de los campos, Folio y Opciones
   */

  $(document).on('click', '#close_options', function (event) {
    event.preventDefault();
    $("#modal_opciones_campo").modal('hide');
    /**
     * Limpiamos todos los input del formulario
     * de Opciones
     */

    $('#form_opc .form-control-sm').val('');
    var nColumnas = $(".tableOpc tbody tr").length;
    /**
     * Eliminamos las opciones adicionales
     * dentro de la tabla de opciones
     */

    for (var i = nColumnas; i > 1; i--) {
      $("#tr_opciones_" + i).remove();
    }
  });
  /**
   * Evento para ver las opciones de los campos, Folio y Opciones
   */

  $(document).on('click', '.view', function (event) {
    event.preventDefault();
    idTR = $(this).attr('id').replace('view_', '');
    $('#action_opc').addClass('saveOpciones');
    var opciones = $("#opciones_" + idTR).val();
    var tipo_campo = $('#tr_' + idTR + ' #tipo_campo').val();

    if (tipo_campo == 'asignador_folios') {
      $('#tituloModalOpciones').html('Parametros para los folios');
      $("#modal_opciones_campo").modal('show', {
        backdrop: 'static',
        keyboard: false
      });
      $("#opcionesForm").slideUp();
      $("#folioForm").slideDown();
      $("#nombre_opcion").prop("disabled", true);
      $("#form_opcion").prop("disabled", true);
      $("#prefijo").prop("disabled", false);
      $("#folio").prop("disabled", false);
      opciones = opciones.split('&');

      for (var i = 0; i < opciones.length; i++) {
        var data = opciones[i];
        data = data.split('=');
        $("#" + data[0]).val(data[1]);
      }
    } else if (tipo_campo == 'select') {
      $('#tituloModalOpciones').html('Agregar opciones');
      $("#modal_opciones_campo").modal('show', {
        backdrop: 'static',
        keyboard: false
      });
      $("#folioForm").slideUp();
      $("#opcionesForm").slideDown();
      $("#nombre_opcion").prop("disabled", false);
      $("#form_opcion").prop("disabled", false);
      $("#prefijo").prop("disabled", true);
      $("#folio").prop("disabled", true);
      opciones = opciones.split('&');
      var j = 0;

      for (var _i = 0; _i < opciones.length / 2; _i++) {
        newID = _i + 1;
        dataOpc = opciones[j].split('=');
        dataSel = opciones[j + 1].split('=');

        if (_i < 1) {
          $('#tr_opciones_1 #nombre_opcion').val(decodeURI(dataOpc[1]));
          $('#tr_opciones_1 #form_opcion').val(decodeURI(dataSel[1]));
        } else {
          fila = $(".tableOpc tbody tr:eq()").clone().appendTo(".tableOpc"); //Clonamos la fila

          fila.find('#nombre_opcion').attr('name', 'campo_' + newID + '[]');
          fila.find('#nombre_opcion').val(decodeURI(dataOpc[1])); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre

          fila.find('#form_opcion').attr('name', 'campo_' + newID + '[]');
          fila.find('#form_opcion').val(decodeURI(dataSel[1])); //Buscamos el campo con id tipo_campo y le agregamos un nuevo nombre

          fila.attr("id", 'tr_opciones_' + newID);
        }

        j = j + 2;
      }
    }
  });
});

/***/ }),

/***/ "./resources/js/module_settings/formularios.js":
/*!*****************************************************!*\
  !*** ./resources/js/module_settings/formularios.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario editar formularios
   */

  $(document).on('click', '#tableFormulario tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".dropleft").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableFormulario tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para eliminar el distribuidores
   *
   */

  $(document).on('click', '.deleteFormulario', function (event) {
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

        var url = currentURL + '/formularios/' + id;
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
   * Evento para mostrar el formulario de crear un nuevo formulario
   */

  $(document).on("click", ".newFormulario", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Nuevo Formulario');
    var url = currentURL + '/formularios/create';
    $('#action').removeClass('updateFormulario');
    $('#action').addClass('saveFormulario');
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
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveFormulario', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
    var dataForm = $("#formDataFormulario").serializeArray();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/formularios';
    $.post(url, {
      dataForm: dataForm,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
    });
  });
  /**
   * Evento para visualizar detalles del Formulario
   */

  $(document).on('click', '.viewFormulario', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    $('#tituloModal').html('Detalles de Formulario');
    var url = currentURL + '/formularios/' + id;
    $('#action').removeClass('updateFormulario');
    $('#action').addClass('saveFormulario');
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
   * Evento para visualizar la configuración de formulario
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
        $('#modal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $("#modal-body").html(result);
      }
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.updateFormulario', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
    var id = $("#idSeleccionado").val();
    var dataForm = $("#formDataFormulario").serializeArray();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/formularios/' + id;
    $.post(url, {
      dataForm: dataForm,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
    });
  });
});

/***/ }),

/***/ "./resources/js/module_settings/menu.js":
/*!**********************************************!*\
  !*** ./resources/js/module_settings/menu.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para el menu de sub categorias y mostrar la vista
   */

  $(document).on("click", ".sub-menu li", function (e) {
    e.preventDefault();
    var id = $(this).data("id");

    if (id == 21) {
      url = currentURL + '/formularios';
      table = ' #tableFormulario';
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

/***/ 1:
/*!*********************************************************************************************************************************************************!*\
  !*** multi ./resources/js/module_settings/menu.js ./resources/js/module_settings/formularios.js ./resources/js/module_settings/acciones_formularios.js ***!
  \*********************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_settings\menu.js */"./resources/js/module_settings/menu.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_settings\formularios.js */"./resources/js/module_settings/formularios.js");
module.exports = __webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_settings\acciones_formularios.js */"./resources/js/module_settings/acciones_formularios.js");


/***/ })

/******/ });