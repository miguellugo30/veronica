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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/module_agentes/agentes.js":
/*!************************************************!*\
  !*** ./resources/js/module_agentes/agentes.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

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
    // customize the button names,
    // otherwise they'd all just say "list"
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

  function start() {
    //use a one-off timer
    timer = setInterval(function () {
      $.ajax({
        method: "GET",
        url: "agentes/" + id_agente,
        // Podrías separar las funciones de PHP en un fichero a parte
        data: {}
      }).done(function (msg) {
        var obj = $.parseJSON(msg);

        if (obj['status'] != 0) {
          stop();
          $(".estado-agente").html("<i class='fa fa-circle text-danger'></i> " + obj['estado']);
          $.get("agentes/" + id_agente + "/edit", function (data, textStatus, jqXHR) {
            $(".view-call").html(data);
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
    var id_agente = $('#id_agente').val();

    var _token = $("input[name=_token]").val();

    $.ajax({
      method: "POST",
      url: "/agentes",
      // Podrías separar las funciones de PHP en un fichero a parte
      data: {
        id_agente: id_agente,
        _token: _token
      }
    }).done(function (msg) {
      console.log(msg);
      $(".view-call").html('');
      $(".estado-agente").html("<i class='fa fa-circle text-success'></i> Disponible");
      start();
    });
  });
});

/***/ }),

/***/ 3:
/*!******************************************************!*\
  !*** multi ./resources/js/module_agentes/agentes.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_agentes\agentes.js */"./resources/js/module_agentes/agentes.js");


/***/ })

/******/ });