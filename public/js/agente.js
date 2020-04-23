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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/module_agentes/agentes.js":
/*!************************************************!*\
  !*** ./resources/js/module_agentes/agentes.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
var validNavigation = false;

window.onbeforeunload = function() {
    if (!validNavigation) {

        var id_agente = $('#id_agente').val();
        let _token = $("input[name=_token]").val();
        let id_evento = $('#id_evento').val();
        let cierre = 1;

        $.ajax({
            type: 'POST',
            async: false,
            url: 'logout/agentes',
            data: {
                id_agente: id_agente,
                id_evento: id_evento,
                cierre: cierre,
                _token: _token
            },
            success: function(data) {}
        });

    }
}
*/
function my_onkeydown_handler(event) {
  switch (event.keyCode) {
    case 116:
      // 'F5'
      event.preventDefault();
      event.keyCode = 0;
      window.status = "F5 disabled";
      break;
  }
}

document.addEventListener("keydown", my_onkeydown_handler);
$(function () {
  $(document).on("click", ".nav-link", function (e) {
    $('.nav-link').attr('data-toggle', 'tab');
    var id = $(this).attr('href');
    $(".tab-pane").removeClass('active');
    $(id).addClass('active');
  });
  $(document).on("click", ".close", function (e) {
    $('.nav-link').attr('data-toggle', 'control-sidebar');
  });
});
document.addEventListener('DOMContentLoaded', function () {
  var initialLocaleCode = 'es';
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: ['list'],
    timeZone: 'UTC',
    defaultView: 'listDay',
    titleFormat: {
      year: 'numeric',
      month: 'short',
      day: 'numeric'
    },
    views: {
      listDay: {
        buttonText: 'Dia'
      },
      listWeek: {
        buttonText: 'Semana'
      },
      listMonth: {
        buttonText: 'Mex'
      }
    },
    locale: initialLocaleCode,
    header: {
      left: 'title',
      center: '',
      right: 'listDay,listWeek,listMonth'
    },
    events: 'https://fullcalendar.io/demo-events.json'
  });
  calendar.render();
  var id_agente = $('#id_agente').val();
  var timer = null;
  var currentURL = window.location.href.split('?');

  function start() {
    //use a one-off timer
    timer = setInterval(function () {
      $.ajax({
        method: "GET",
        url: currentURL[0] + "/" + id_agente,
        // Podrías separar las funciones de PHP en un fichero a parte
        data: {}
      }).done(function (msg) {
        var obj = $.parseJSON(msg);

        if (obj['status'] == 1) {
          if (obj['monitoreo'] == 0) {
            stop();
          }

          $(".estado-agente").html("<i class='fa fa-circle text-danger'></i> " + obj['estado']);
          $(".colgar-llamada").prop("disabled", false);
          $.get(currentURL[0] + "/" + id_agente + "/edit", function (data, textStatus, jqXHR) {
            $(".view-call").html(data);
            $(".historico-llamadas").DataTable({
              "searching": false,
              "lengthChange": false,
              "iDisplayLength": 5
            });
          });
        } else if (obj['status'] == 2) {
          if (obj['monitoreo'] == 0) {
            stop();
          }

          $(".estado-agente").html("<i class='fa fa-circle text-danger'></i> " + obj['estado']);
          $("#modal-no-disponible").modal({
            backdrop: 'static',
            keyboard: false
          });
        } else if (obj['status'] == 0) {
          if (obj['monitoreo'] == 1) {
            $(".view-call").html('<div class="col-12 text-center" style="padding-top: 19%;"><i class="fas fa-spinner fa-10x fa-spin text-info"></i></div>');
            $(".colgar-llamada").prop("disabled", true);
          }
        }
      });
    }, 3000);
  }

  ;

  function stop() {
    clearInterval(timer);
  }

  ;
  start();
  $(document).on("click", ".calificar-llamada", function (e) {
    stop();
    var id_agente = $('#id_agente').val();
    var canal = $("#canal").val();
    var id_calificacion = $("#calificacion option:selected").data('calificacionid');
    var uniqueid = $("#uniqueid").val();

    var _token = $("input[name=_token]").val();

    var datosFormulario = $(".formularioView").serializeArray();
    $.ajax({
      method: "POST",
      url: currentURL[0],
      // Podrías separar las funciones de PHP en un fichero a parte
      data: {
        canal: canal,
        uniqueid: uniqueid,
        id_calificacion: id_calificacion,
        id_agente: id_agente,
        datosFormulario: datosFormulario,
        _token: _token
      }
    }).done(function (msg) {
      $(".view-call").html(msg);
      $(".view-call").html('<div class="col-12 text-center" style="padding-top: 19%;"><i class="fas fa-spinner fa-10x fa-spin text-info"></i></div>');
      $(".estado-agente").html("<i class='fa fa-circle text-success'></i> Disponible");
      $(".colgar-llamada").prop("disabled", true);
      start();
    });
  });
  $(document).on("change", "#no_disponible", function (e) {
    var no_disponible = $(this).val();
    var id_agente = $('#id_agente').val();
    var no_disponible_text = $('select[name="no_disponible"] option:selected').text();

    var _token = $("input[name=_token]").val();

    $('#title-no-disponible').html(no_disponible_text);

    if (no_disponible != '0') {
      $.ajax({
        method: "POST",
        url: currentURL[0] + "/no_disponible",
        // Podrías separar las funciones de PHP en un fichero a parte
        data: {
          no_disponible: no_disponible,
          no_disponible_text: no_disponible_text,
          id_agente: id_agente,
          _token: _token
        }
      }).done(function (msg) {
        $(".modal-body").html(msg);
        $("#modal-no-disponible").modal({
          backdrop: 'static',
          keyboard: false
        });
      });
    }
  });
  $(document).on("click", "#agente-disponible", function (e) {
    var agente = $('#agente_evento').val();
    var evento = $('#id_no_disponible').val();

    var _token = $("input[name=_token]").val();

    if (no_disponible != '') {
      $.ajax({
        method: "POST",
        url: currentURL[0] + "/agente_disponible",
        // Podrías separar las funciones de PHP en un fichero a parte
        data: {
          agente: agente,
          evento: evento,
          _token: _token
        }
      }).done(function (msg) {
        $(".estado-agente").html("<i class='fa fa-circle text-success'></i> Disponible");
        $('#no_disponible option[value="0"]').attr("selected", true);
        $("#modal-no-disponible").modal('hide');
        $("#modal-no-disponible .modal-body").html('');
        start();
      });
    }
  });
});

/***/ }),

/***/ "./resources/js/module_agentes/eventosPantallaAgente.js":
/*!**************************************************************!*\
  !*** ./resources/js/module_agentes/eventosPantallaAgente.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href.split('?');
  /**
   * Evento para colgar la llamada
   */

  $(document).on("click", ".colgar-llamada", function (e) {
    var canal = $("#canal").val();

    var _token = $("input[name=_token]").val();

    $.ajax({
      method: "POST",
      url: currentURL[0] + "/colgar",
      // Podrías separar las funciones de PHP en un fichero a parte
      data: {
        canal: canal,
        _token: _token
      }
    }).done(function (msg) {});
  });
  /**
   * Evento para mostrar el historial de llamadas
   */

  $(document).on("click", "#view-historial-llamadas", function (e) {
    var id_agente = $("#id_agente").val();

    var _token = $("input[name=_token]").val();

    $.ajax({
      method: "POST",
      url: currentURL[0] + "/historial-llamadas",
      // Podrías separar las funciones de PHP en un fichero a parte
      data: {
        id_agente: id_agente,
        _token: _token
      }
    }).done(function (msg) {
      $('.result-historial-llamada').html(msg);
    });
  });
  /**
   * Evento para mostrar el historial de lladamas perdidas
   */

  $(document).on("click", "#view-llamadas-perdidas", function (e) {
    var id_agente = $("#id_agente").val();

    var _token = $("input[name=_token]").val();

    $.ajax({
      method: "POST",
      url: currentURL[0] + "/llamadas-abandonadas",
      // Podrías separar las funciones de PHP en un fichero a parte
      data: {
        id_agente: id_agente,
        _token: _token
      }
    }).done(function (msg) {
      $('.result-llamadas-abandonadas').html(msg);
    });
  });
  /**
   * Evento para el logueo de extension
   */

  $(document).on('click', '.logeo-extension', function (event) {
    var idAgente = $("#id_agente").val();
    var canal = $("#canal").val();
    var extension = $("#extension").val();
    var id_empresa = $("#id_empresa").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL[0].replace('agentes/') + '/logeo-extension';
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        idAgente: idAgente,
        canal: canal,
        extension: extension,
        id_empresa: id_empresa,
        _token: _token
      },
      success: function success(result) {
        var obj = $.parseJSON(result);

        if (obj['error'] == 1) {
          $(".estado-agente").html("<i class='fa fa-circle text-success'></i> Disponible");
        } else {
          Swal.fire('Error!', 'No se ha podido generar el logueo de extension.', 'error');
        }
      }
    });
  });
  /**
   * Evento para mostrar el modal para la trasferencia de llamada
   */

  $(document).on("click", ".transferir-llamada", function (e) {
    $("#modal-transferencia").modal({
      backdrop: 'static',
      keyboard: false
    });
  });
  /**
   * Evento para mostrar las opciones del destino selecionado
   */

  $(document).on('change', '#destino_transferencia', function (event) {
    var opccion = $(this).val();
    var id_empresa = $("#id_empresa").val();
    var id = 0 + '&' + opccion + '&1&' + id_empresa;
    var url = currentURL[0].replace('agentes/') + '/opciones_transferencia/' + id;

    if (opccion == 'Cat_Extensiones') {
      $('.opcion-transferir-extension').slideDown();
    } else {
      $('.opcion-transferir-extension').slideUp();
    }

    if (opccion == 'Numero_Saliente') {
      $('.input-telefono-transferir').slideDown();
      $('#opciones_transferencia').slideUp();
    } else {
      $('.input-telefono-transferir').slideUp();
      $('#opciones_transferencia').slideDown();
      $.ajax({
        url: url,
        type: "GET"
      }).done(function (data) {
        $('#opciones_transferencia').html(data);
      });
    }
  });
});

/***/ }),

/***/ 6:
/*!*************************************************************************************************************!*\
  !*** multi ./resources/js/module_agentes/agentes.js ./resources/js/module_agentes/eventosPantallaAgente.js ***!
  \*************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\Users\mchlu\Documents\Desarrollos\Nimbus\resources\js\module_agentes\agentes.js */"./resources/js/module_agentes/agentes.js");
module.exports = __webpack_require__(/*! C:\Users\mchlu\Documents\Desarrollos\Nimbus\resources\js\module_agentes\eventosPantallaAgente.js */"./resources/js/module_agentes/eventosPantallaAgente.js");


/***/ })

/******/ });