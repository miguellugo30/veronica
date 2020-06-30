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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/module_voicemail/grabacionesVoicemail.js":
/*!***************************************************************!*\
  !*** ./resources/js/module_voicemail/grabacionesVoicemail.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  /**
   * Evento para mostrar los resultados en el DataTable
   */
  $(document).on('click', '.filtrar', function (event) {
    event.preventDefault();
    /**
     * Esto contrae el body
     */

    $('.body-filtro').slideUp();
    $('.nuevo-reporte').slideDown();
    $('#body-reporte').slideDown();
    var fechaI = $("#fechaIni").val();
    var fechaF = $("#fechaFin").val();
    var hrI = $("#hrIni").val();
    var hrF = $("#hrFin").val();
    var url = currentURL + '/grabaciones_voicemial';

    var _token = $("input[name=_token]").val();

    var fechaIni = fechaI + " " + hrI + ":00";
    var fechaFin = fechaF + " " + hrF + ":59";
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        fechaIni: fechaIni,
        fechaFin: fechaFin,
        _token: _token
      },
      success: function success(result) {
        $("#rangoFiltro").html(fechaIni + " -- " + fechaFin);
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
    $('.viewreportedesglose').html('');
    e.preventDefault();
  });
  /**
   * Evento para poder descargar el reporte
   */

  $(document).on("click", ".descargar-reporte", function (e) {
    /**
     * Con esto traemos las variables
     */
    var fechaI = $("#fechaIni").val();
    var fechaF = $("#fechaFin").val();
    var hrI = $("#hrIni").val();
    var hrF = $("#hrFin").val();
    var fechaIni = fechaI + " " + hrI + ":00";
    var fechaFin = fechaF + " " + hrF + ":59";
    var url = currentURL + "/grabaciones_voicemial/descargar/" + fechaIni + "/" + fechaFin;
    $('#iFrameDescarga').attr('src', url);
  });
  /**
   * Evento para descargar y escuchar la grabacion
   */

  $(document).on('click', '.escuchar-grabacion', function (event) {
    event.preventDefault();
    var grab = $(this).attr('id');
    var url = currentURL + '/grabaciones_voicemial/escuchar';

    var _token = $("input[name=_token]").val();

    $.ajax({
      url: url,
      type: 'POST',
      data: {
        grab: grab,
        _token: _token
      },
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
   * Evento para marcar los checbox
   */

  $(document).on("click", '.checkall', function () {
    $(this).closest("table").find("tbody :checkbox").prop("checked", this.checked).closest("tr").toggleClass("selected", this.checked);
  });
  /**
   * Limitar el numero de checkbox
   */

  $(document).on('change', 'input[name="numcheck"]', function (evt) {
    if ($('input[name="numcheck"]:checked').length > 10) {
      $(this).prop('checked', false);
      Swal.fire({
        title: 'Advertencia!',
        icon: 'warning',
        html: 'Solo se pueden seleccionar hasta <b>10 grabaciones</b> para descargar.',
        showCloseButton: true
      });
    }
  });
  /**
   * Evento para descargar las grabaciones en zip
   */

  $(document).on('click', '.descargar-grabaciones', function (event) {
    event.preventDefault();
    var valoresCheck = [];
    $("input[name='numcheck']:checked").each(function () {
      valoresCheck.push(this.value);
    });

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/grabaciones_voicemial/descargar';
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        valoresCheck: valoresCheck,
        _token: _token
      },
      success: function success(result) {
        $('#iFrameDescarga').attr('src', result);
      }
    });
  });
  /**
   * Evento para enviar la grabación
   */

  $(document).on('click', '.enviar-grabacion', function (event) {
    var _this = this;

    event.preventDefault();
    Swal.fire({
      title: 'Ingrese los correos a los cuales se enviara la grabación.',
      text: 'separar con ; si se desea enviar a mas de un correo.',
      input: 'text',
      inputAttributes: {
        autocapitalize: 'off'
      },
      showCancelButton: true,
      confirmButtonText: 'Enviar',
      showLoaderOnConfirm: false
    }).then(function (result) {
      var correos = result.value;

      var _token = $("input[name=_token]").val();

      var idGrabacion = $(_this).attr('id');
      var url = currentURL + '/grabaciones_voicemial/' + idGrabacion;
      $.ajax({
        url: url,
        type: 'GET',
        data: {
          correos: correos,
          _token: _token
        },
        success: function success(data) {
          if (data['error']) {
            Swal.fire('Enviado!', 'Se ha enviado la grabación.', 'success');
          } else {
            Swal.fire('Error!', data['mensaje'], 'error');
          }
        }
      });
    });
  });
  /**
   * Evento para eliminar las grabaciones
   */

  $(document).on('click', '.eliminar-grabaciones', function (event) {
    event.preventDefault();
    Swal.fire({
      title: '¿Estas seguro?',
      text: "¿Deseas eliminar la(s) grabación(es) seleccionada(s)?. Esta acción la(s) eliminara físicamente y no podrá(n) ser recuperada(s).",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Si, Eliminar!',
      cancelButtonText: 'Cancelar'
    }).then(function (result) {
      if (result.value) {
        var valoresCheck = [];
        $("input[name='numcheck']:checked").each(function () {
          valoresCheck.push(this.value);
        });

        var _token = $("input[name=_token]").val();

        var _method = "DELETE";
        var url = currentURL + '/grabaciones_voicemial/0';
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            valoresCheck: valoresCheck,
            _method: _method,
            _token: _token
          },
          success: function success(result) {
            var fechaI = $("#fechaIni").val();
            var fechaF = $("#fechaFin").val();
            var hrI = $("#hrIni").val();
            var hrF = $("#hrFin").val();
            var url = currentURL + '/grabaciones_voicemial';

            var _token = $("input[name=_token]").val();

            var fechaIni = fechaI + " " + hrI + ":00";
            var fechaFin = fechaF + " " + hrF + ":59";
            $.ajax({
              url: url,
              type: 'POST',
              data: {
                fechaIni: fechaIni,
                fechaFin: fechaFin,
                _token: _token
              },
              success: function success(result) {
                $("#rangoFiltro").html(fechaIni + " -- " + fechaFin);
                $('.viewreportedesglose').html(result);
              }
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/module_voicemail/menu.js":
/*!***********************************************!*\
  !*** ./resources/js/module_voicemail/menu.js ***!
  \***********************************************/
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

    if (id == 'cat-24') {
      url = currentURL + '/grabaciones_voicemial';
      table = ' #grabacionesVoicemail';
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

/***/ 4:
/*!*************************************************************************************************************!*\
  !*** multi ./resources/js/module_voicemail/menu.js ./resources/js/module_voicemail/grabacionesVoicemail.js ***!
  \*************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\Users\mchlu\Documents\Desarrollos\Personales\veronica\resources\js\module_voicemail\menu.js */"./resources/js/module_voicemail/menu.js");
module.exports = __webpack_require__(/*! C:\Users\mchlu\Documents\Desarrollos\Personales\veronica\resources\js\module_voicemail\grabacionesVoicemail.js */"./resources/js/module_voicemail/grabacionesVoicemail.js");


/***/ })

/******/ });