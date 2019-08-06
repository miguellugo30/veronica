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

    if (id == 6) {
      url = currentURL + '/usuarios';
      table = ' #tableUsuarios';
    } else if (id == 4) {
      url = currentURL + '/menus';
      table = '';
    } else if (id == 3) {
      url = currentURL + '/modulos';
      table = ' #tableModulos';
    } else if (id == 1) {
      url = currentURL + '/distribuidor';
      table = ' #tableDistribuidores';
    } else if (id == 8) {
      url = currentURL + '/did';
      table = ' #tableDid';
    } else if (id == 10) {
      url = currentURL + '/cat_empresa';
      table = ' #tableEdoEmp';
    } else if (id == 11) {
      url = currentURL + '/cat_ip_pbx';
      table = ' #tablePbx';
    } else if (id == 12) {
      url = currentURL + '/cat_nas';
      table = ' #tableNas';
    } else if (id == 13) {
      url = currentURL + '/cat_agente';
      table = ' #tableEdoAge';
    } else if (id == 14) {
      url = currentURL + '/cat_cliente';
      table = ' #tableEdoCli';
    } else if (id == 9) {
      url = currentURL + '/troncales';
      table = ' #tableTroncales';
    } else if (id == 15) {
      url = currentURL + '/canales';
      table = ' #tableCanales';
    } else if (id == 2) {
      url = currentURL + '/empresas';
      table = ' #tableEmpresas';
    } else if (id == 16) {
      url = currentURL + '/basedatos';
      table = ' #tableBaseDatos';
    } else if (id == 17) {
      url = currentURL + '/cat_tipo_canales';
      table = ' #tableTiposCanal';
    } else if (id == 19) {
      url = currentURL + '/licencias_bria';
      table = ' #licencias_bria';
    } else if (id == 20) {
      url = currentURL + '/logs';
      table = ' #tableLogs';
    } else if (id == 21) {
      url = currentURL + '/formularios';
      table = ' #tableFormularios';
    }

    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewResult").html(data);

      if (id != 4) {
        $('.viewResult' + table).DataTable({
          "lengthChange": true
        });
      }
    });
  });
});

/***/ }),

/***/ 1:
/*!****************************************************!*\
  !*** multi ./resources/js/module_settings/menu.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_settings\menu.js */"./resources/js/module_settings/menu.js");


/***/ })

/******/ });