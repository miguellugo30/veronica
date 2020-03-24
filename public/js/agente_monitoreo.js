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
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/module_agentes/agentes_monitoreo.js":
/*!**********************************************************!*\
  !*** ./resources/js/module_agentes/agentes_monitoreo.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var bPreguntar = true;
window.onbeforeunload = preguntarAntesDeSalir;

function preguntarAntesDeSalir() {
  if (bPreguntar) return "¿Seguro que quieres salir?";
}
/*
$(window).bind('beforeunload', function(e) {
    e.preventDefault();
    var id_agente = $('#id_agente').val();
    return '>>>>>Before You Go<<<<<<<< \n Your custom message go here';
    console.log(id_agente);
    if (window.btn_clicked) {
        console.log('confirmo');
    } else {
        console.log('no confirmo');
    }
});
*/


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
          stop();
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
          stop();
          $(".estado-agente").html("<i class='fa fa-circle text-danger'></i> " + obj['estado']);
          $("#modal-no-disponible").modal({
            backdrop: 'static',
            keyboard: false
          });
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
        $(".modal-body").html('');
        start();
      });
    }
  });
});

/***/ }),

/***/ "./resources/js/module_agentes/eventosPantallaAgente_monitoreo.js":
/*!************************************************************************!*\
  !*** ./resources/js/module_agentes/eventosPantallaAgente_monitoreo.js ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href.split('?');
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
        console.log(result); // $(".viewFormularioCalificacion").html(result);
      }
    });
  });
});

/***/ }),

/***/ 7:
/*!*********************************************************************************************************************************!*\
  !*** multi ./resources/js/module_agentes/agentes_monitoreo.js ./resources/js/module_agentes/eventosPantallaAgente_monitoreo.js ***!
  \*********************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /var/www/html/repo-v2/Nimbus/resources/js/module_agentes/agentes_monitoreo.js */"./resources/js/module_agentes/agentes_monitoreo.js");
module.exports = __webpack_require__(/*! /var/www/html/repo-v2/Nimbus/resources/js/module_agentes/eventosPantallaAgente_monitoreo.js */"./resources/js/module_agentes/eventosPantallaAgente_monitoreo.js");


/***/ })

/******/ });