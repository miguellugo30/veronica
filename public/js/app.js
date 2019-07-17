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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 
 require('./bootstrap');
 
 window.Vue = require('vue');
 
 */

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 
 const app = new Vue({
     el: '#app',
    });
    */

/***/ }),

/***/ "./resources/js/module_administrador/canales.js":
/*!******************************************************!*\
  !*** ./resources/js/module_administrador/canales.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo modulo
   */

  $(document).on("click", ".newCanal", function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + '/canales/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveCanal', function (event) {
    event.preventDefault();
    var Cat_Distribuidor_id = $("#distribuidores_canal").val();
    var Empresas_id = $("#Empresas_id_canal").val();
    var Troncales_id = $("#Troncales_id_canal").val();
    /**
     * Valores para armar los canales
     */

    var canal_prefijo = $("#canal_prefijo1").val();
    var canal_empresa = $("#canal_empresa1").val();
    var canal_tipo = $("#canal_tipo1").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/canales';
    $.post(url, {
      Empresas_id: Empresas_id,
      Troncales_id: Troncales_id,
      Cat_Distribuidor_id: Cat_Distribuidor_id,
      canales: canales,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewIndex #tableCanales').DataTable({
        "lengthChange": true
      });
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('dblclick', '#tableCanales tbody tr', function (event) {
    event.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/canales/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para cancelar la creacion/edicion del modulo
   */

  $(document).on("click", ".cancelCanal", function (e) {
    $(".viewIndex").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updateCanal', function (event) {
    event.preventDefault();
    var Cat_Distribuidor_id = $("#distribuidores_canal").val();
    var Empresas_id = $("#Empresas_id_canal").val();
    var Troncales_id = $("#Troncales_id_canal").val();
    var id = $("#id").val();
    /**
     * Valores para armar el canal
     */

    var canal_troncal = $("#canal_troncal").val();
    var canal_prefijo = $("#canal_prefijo").val();
    var canal_empresa = $("#canal_empresa").val();
    var canal_tipo = $("#canal_tipo").val();
    var canal = "SIP/" + canal_troncal + "/" + canal_prefijo + canal_empresa + canal_tipo;

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/canales/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        Empresas_id: Empresas_id,
        Troncales_id: Troncales_id,
        Cat_Distribuidor_id: Cat_Distribuidor_id,
        canal: canal,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableCanales').DataTable({
          "lengthChange": true
        });
      }
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteCanal', function (event) {
    event.preventDefault();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var _method = "DELETE";
    var url = currentURL + '/canales/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableCanales').DataTable({
          "lengthChange": true
        });
      }
    });
  });
  /**
   * Evento que obtiene el distribuidor y
   */

  $(document).on('change', '#distribuidores_canal', function (event) {
    //Al cambiar de distribuidor se limpiara el campo de la troncal y el id de la empresa
    $('#canal_troncal').val('');
    $('#canal_empresa').val(''); //Obtener el valor del prefijo seleccionado y settearlo para el armado de canal en "canal_prefijo"

    var prefijo = $("#distribuidores_canal option:selected").data('prefijo');
    var id_empresa = $(this).val();
    var url = currentURL + '/canales/' + id_empresa;
    var id_distribuidor = $("#distribuidores_canal").val();
    $.get(url, function (data, textStatus, xhr) {
      $(".resultDistribuidor").html(data);

      if (id_distribuidor == 2) {
        $('.canal1').show();
        $('.canal2').show();
        $('.canal3').show();
        $("#canal_prefijo1").val(prefijo);
        $("#canal_prefijo2").val(prefijo);
        $("#canal_prefijo3").val(prefijo);
      } else if (id_distribuidor == 1) {
        $('.canal4').show();
        $('.canal5').show();
        $('.canal6').show();
        $('.canal7').show();
        $("#canal_prefijo4").val(prefijo);
        $("#canal_prefijo5").val(prefijo);
        $("#canal_prefijo6").val(prefijo);
        $("#canal_prefijo7").val(prefijo);
      }
    });
  });
  /**
   * Evento para obtener el nombre de la troncal
   */

  $(document).on('change', '#Troncales_id_canal', function (event) {
    var id_distribuidor = $("#distribuidores_canal").val();
    var prefijo = $("#Troncales_id_canal option:selected").text();

    if (id_distribuidor == 2) {
      $("#canal_troncal1").val(prefijo);
      $("#canal_troncal2").val(prefijo);
      $("#canal_troncal3").val(prefijo);
    } else if (id_distribuidor == 1) {
      $("#canal_troncal4").val(prefijo);
      $("#canal_troncal5").val(prefijo);
      $("#canal_troncal6").val(prefijo);
      $("#canal_troncal7").val(prefijo);
    }
  });
  /**
   * Evento para asignar el id de la empresa
   */

  $(document).on('change', '#Empresas_id_canal', function (event) {
    var id_distribuidor = $("#distribuidores_canal").val();
    var id_Empresa = $("#Empresas_id_canal option:selected").val();

    if (id_distribuidor == 2) {
      $("#canal_empresa1").val(zfill(id_Empresa, 3));
      $("#canal_empresa2").val(zfill(id_Empresa, 3));
      $("#canal_empresa3").val(zfill(id_Empresa, 3));
    } else if (id_distribuidor == 1) {
      $("#canal_empresa4").val(zfill(id_Empresa, 3));
      $("#canal_empresa5").val(zfill(id_Empresa, 3));
      $("#canal_empresa6").val(zfill(id_Empresa, 3));
      $("#canal_empresa7").val(zfill(id_Empresa, 3));
    }
  });
  /**
   * Funcion para formatear el id de la empresa a 3 digitos
   * @param {id_empresa} number
   * @param {tamanio} width
   */

  function zfill(number, width) {
    var numberOutput = Math.abs(number);
    /* Valor absoluto del número */

    var length = number.toString().length;
    /* Largo del número */

    var zero = "0";
    /* String de cero */

    if (width <= length) {
      if (number < 0) {
        return "-" + numberOutput.toString();
      } else {
        return numberOutput.toString();
      }
    } else {
      if (number < 0) {
        return "-" + zero.repeat(width - length) + numberOutput.toString();
      } else {
        return zero.repeat(width - length) + numberOutput.toString();
      }
    }
  }
});

/***/ }),

/***/ "./resources/js/module_administrador/cat_estado_agente.js":
/*!****************************************************************!*\
  !*** ./resources/js/module_administrador/cat_estado_agente.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo modulo
   */

  $(document).on("click", ".newEdoAge", function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + '/cat_agente/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveEdoAge', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();

    var _token = $("input[name=_token]").val();

    var recibir_llamada = $('input:radio[name=recibir_llamada]:checked').val();
    var url = currentURL + '/cat_agente';
    $.post(url, {
      nombre: nombre,
      descripcion: descripcion,
      recibir_llamada: recibir_llamada,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewIndex #tableEdoAge').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('dblclick', '#tableEdoAge tbody tr', function (event) {
    event.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/cat_agente/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para cancelar la creacion/edicion del modulo
   */

  $(document).on("click", ".cancelEdoAge", function (e) {
    $(".viewIndex").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updateEdoAge', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var recibir_llamada = $('input:radio[name=recibir_llamada]:checked').val();
    var url = currentURL + '/cat_agente/' + id;
    $.ajax({
      url: url,
      type: 'PUT',
      data: {
        nombre: nombre,
        descripcion: descripcion,
        recibir_llamada: recibir_llamada,
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableEdoAge').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      }
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteEdoAge', function (event) {
    event.preventDefault();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_agente/' + id;
    $.ajax({
      url: url,
      type: 'DELETE',
      data: {
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableEdoAge').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/module_administrador/cat_estado_cliente.js":
/*!*****************************************************************!*\
  !*** ./resources/js/module_administrador/cat_estado_cliente.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo modulo
   */

  $(document).on("click", ".newEdoCli", function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + '/cat_cliente/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveEdoCli', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();
    var marcar = $('input:radio[name=marcar]:checked').val();
    var mostrar_agente = $('input:radio[name=mostrar_agente]:checked').val();
    var parametrizar = $('input:radio[name=parametrizar]:checked').val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_cliente';
    $.post(url, {
      nombre: nombre,
      descripcion: descripcion,
      marcar: marcar,
      mostrar_agente: mostrar_agente,
      parametrizar: parametrizar,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewIndex #tableEdoCli').DataTable({
        "lengthChange": true,
        "order": [[5, "asc"]]
      });
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('dblclick', '#tableEdoCli tbody tr', function (event) {
    event.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/cat_cliente/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para cancelar la creacion/edicion del modulo
   */

  $(document).on("click", ".cancelEdoCli", function (e) {
    $(".viewIndex").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updateEdoCli', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();
    var marcar = $('input:radio[name=marcar]:checked').val();
    var mostrar_agente = $('input:radio[name=mostrar_agente]:checked').val();
    var parametrizar = $('input:radio[name=parametrizar]:checked').val();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_cliente/' + id;
    $.ajax({
      url: url,
      type: 'PUT',
      data: {
        nombre: nombre,
        descripcion: descripcion,
        marcar: marcar,
        mostrar_agente: mostrar_agente,
        parametrizar: parametrizar,
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableEdoCli').DataTable({
          "lengthChange": true,
          "order": [[5, "asc"]]
        });
      }
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteEdoCli', function (event) {
    event.preventDefault();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_cliente/' + id;
    $.ajax({
      url: url,
      type: 'DELETE',
      data: {
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableEdoCli').DataTable({
          "lengthChange": true,
          "order": [[5, "asc"]]
        });
      }
    });
  });
  /**
   * Evento para order las categorias
   */

  $(document).on('click', '.orderignEdoCli', function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewSubCat").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + "/cat_cliente/ordering";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
      $("#sortable").sortable();
    });
  });
  /**
   * Evento para editar el menu
   */

  $(document).on('click', '.saveOrderEdoCli', function (event) {
    event.preventDefault();
    var ordenElementos = $("#sortable").sortable("toArray").toString();

    var _token = $("input[name=_token]").val();

    var url = currentURL + "/cat_cliente/updateOrdering";
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        ordenElementos: ordenElementos,
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex').slideDown();
        $('.viewResult #tableMenus').DataTable({
          "lengthChange": true,
          "order": [[5, "asc"]]
        });
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/module_administrador/cat_estado_empresa.js":
/*!*****************************************************************!*\
  !*** ./resources/js/module_administrador/cat_estado_empresa.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo modulo
   */

  $(document).on("click", ".newEdoEmp", function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + '/cat_empresa/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveEdoEmp', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_empresa';
    $.post(url, {
      nombre: nombre,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewIndex #tableEdoEmp').DataTable({
        "lengthChange": true,
        "order": [[5, "asc"]]
      });
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('dblclick', '#tableEdoEmp tbody tr', function (event) {
    event.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/cat_empresa/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para cancelar la creacion/edicion del modulo
   */

  $(document).on("click", ".cancelEdoEmp", function (e) {
    $(".viewIndex").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updateEdoEmp', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_empresa/' + id;
    $.ajax({
      url: url,
      type: 'PUT',
      data: {
        nombre: nombre,
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableEdoEmp').DataTable({
          "lengthChange": true,
          "order": [[5, "asc"]]
        });
      }
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteEdoEmp', function (event) {
    event.preventDefault();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_empresa/' + id;
    $.ajax({
      url: url,
      type: 'DELETE',
      data: {
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableEdoEmp').DataTable({
          "lengthChange": true,
          "order": [[5, "asc"]]
        });
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/module_administrador/cat_ip_pbx.js":
/*!*********************************************************!*\
  !*** ./resources/js/module_administrador/cat_ip_pbx.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo modulo
   */

  $(document).on("click", ".newPbx", function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + '/cat_ip_pbx/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.savePbx', function (event) {
    event.preventDefault();
    var media_server = $("#media_server").val();
    var ip_pbx = $("#ip_pbx").val();
    var Cat_Base_Datos_id = $("#basedatos").val();
    var arr = $('[name="nas[]"]:checked').map(function () {
      return this.value;
    }).get();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_ip_pbx';
    $.post(url, {
      media_server: media_server,
      Cat_Base_Datos_id: Cat_Base_Datos_id,
      ip_pbx: ip_pbx,
      arr: arr,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewIndex #tablePbx').DataTable({
        "lengthChange": true
      });
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('dblclick', '#tablePbx tbody tr', function (event) {
    event.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/cat_ip_pbx/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para cancelar la creacion/edicion del modulo
   */

  $(document).on("click", ".cancelPbx", function (e) {
    $(".viewIndex").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updatePbx', function (event) {
    event.preventDefault();
    var media_server = $("#media_server").val();
    var ip_pbx = $("#ip_pbx").val();
    var Cat_Base_Datos_id = $("#basedatos").val();
    var arr = $('[name="nas[]"]:checked').map(function () {
      return this.value;
    }).get();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/cat_ip_pbx/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        media_server: media_server,
        ip_pbx: ip_pbx,
        Cat_Base_Datos_id: Cat_Base_Datos_id,
        arr: arr,
        id: id,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tablePbx').DataTable({
          "lengthChange": true
        });
      }
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deletePbx', function (event) {
    event.preventDefault();
    var id = $("#id").val();
    var _method = "DELETE";

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_ip_pbx/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tablePbx').DataTable({
          "lengthChange": true
        });
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/module_administrador/cat_nas.js":
/*!******************************************************!*\
  !*** ./resources/js/module_administrador/cat_nas.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo modulo
   */

  $(document).on("click", ".newNas", function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + '/cat_nas/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveNas', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var ip_nas = $("#ip_nas").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_nas';
    $.post(url, {
      nombre: nombre,
      ip_nas: ip_nas,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewIndex #tableNas').DataTable({
        "lengthChange": true,
        "order": [[5, "asc"]]
      });
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('dblclick', '#tableNas tbody tr', function (event) {
    event.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/cat_nas/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para cancelar la creacion/edicion del modulo
   */

  $(document).on("click", ".cancelNas", function (e) {
    $(".viewIndex").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updateNas', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var ip_nas = $("#ip_nas").val();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_nas/' + id;
    $.ajax({
      url: url,
      type: 'PUT',
      data: {
        nombre: nombre,
        ip_nas: ip_nas,
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableNas').DataTable({
          "lengthChange": true,
          "order": [[5, "asc"]]
        });
      }
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteNas', function (event) {
    event.preventDefault();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_nas/' + id;
    $.ajax({
      url: url,
      type: 'DELETE',
      data: {
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableNas').DataTable({
          "lengthChange": true,
          "order": [[5, "asc"]]
        });
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/module_administrador/dids.js":
/*!***************************************************!*\
  !*** ./resources/js/module_administrador/dids.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo dids
   */

  $(document).on("click", ".nuevoDid", function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + '/did/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo did
   */

  $(document).on('click', '.saveDid', function (event) {
    event.preventDefault();
    var prefijo = $("#prefijo").val();
    var did = $("#did").val();
    var numero_real = $("#numero_real").val();
    var referencia = $("#referencia").val();
    var gateway = $('input:radio[name=gateway]:checked').val();
    var fakedid = $('input:radio[name=fakedid]:checked').val();
    var Canales_id = $("#Canal_id").val();
    var Empresas_id = $("#id_empresa").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/did';
    $.post(url, {
      prefijo: prefijo,
      dids: did,
      numero_real: numero_real,
      referencia: referencia,
      gateway: gateway,
      fakedid: fakedid,
      Canales_id: Canales_id,
      Empresas_id: Empresas_id,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewCreate').slideUp();
      $('.viewIndex').slideDown();
      $('.viewResult #tableDid').DataTable({
        "lengthChange": true
      });
    });
  });
  /**
   * Evento para mostrar el formulario editar distribuidores
   */

  $(document).on('dblclick', '#tableDid tbody tr', function (event) {
    event.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/did/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para cancelar la creacion/edicion del distribuidores
   */

  $(document).on("click", ".cancelDid", function (e) {
    $(".viewIndex").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para editar el distribuidores
   */

  $(document).on('click', '.updateDid', function (event) {
    event.preventDefault(); // Datos obtenidos del formulario

    var id = $("#id").val();
    var prefijo = $("#prefijo").val();
    var dids = $("#did").val();
    var did = dids.replace("\n", ";");
    var numero_real = $("#numero_real").val();
    var referencia = $("#referencia").val();
    var gateway = $('input:radio[name=gateway]:checked').val();
    var fakedid = $('input:radio[name=fakedid]:checked').val();
    var Canales_id = $("#Canal_id").val();
    var Empresas_id = $("#id_empresa").val();

    var _token = $("input[name=_token]").val();

    var _method = 'PUT';
    var url = currentURL + '/did/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        prefijo: prefijo,
        did: did,
        numero_real: numero_real,
        referencia: referencia,
        gateway: gateway,
        fakedid: fakedid,
        Canales_id: Canales_id,
        Empresas_id: Empresas_id,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex').slideDown();
        $('.viewResult #tableDid').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      }
    });
  });
  /**
   * Evento para eliminar el did
   */

  $(document).on('click', '.deleteDid', function (event) {
    event.preventDefault();
    var id_did = $("#id_did").val();

    var _token = $("input[name=_token]").val();

    var _method = 'DELETE';
    var url = currentURL + '/did/' + id_did;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewIndex #tableDid').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      }
    });
  });
  /**
   * Evento que obtiene el distribuidor y los canales
   */

  $(document).on('change', '#id_empresa', function (event) {
    var id_empresa = $(this).val();
    var Cat_Distribuidor_id = $("#id_empresa option:selected").data('cat_distribuidor_id');
    var url = currentURL + '/did/' + id_empresa;
    $.get(url, function (data, textStatus, xhr) {
      $(".resultEmpresa").html(data);

      if (Cat_Distribuidor_id == 11) {
        $(".resultEmpresa #gatewayhabilitado").attr('checked', true);
      } else {
        $(".resultEmpresa #gatewaydeshabilitado").attr('checked', true);
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/module_administrador/distribuidores.js":
/*!*************************************************************!*\
  !*** ./resources/js/module_administrador/distribuidores.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo distribuidores
   */

  $(document).on("click", ".nuevoDistribuidor", function (e) {
    event.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/distribuidor/create";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo distribuidores
   */

  $(document).on('click', '.saveDistribuidor', function (event) {
    event.preventDefault();
    var formData = new FormData(document.getElementById("altadistribuidores"));
    var servicio = $("#servicio").val();
    var distribuidor = $("#distribuidor").val();
    var numero_soporte = $("#numero_soporte").val();
    var prefijo = $("#prefijo").val();
    var img_header = $("#img_header").val();
    var img_pie = $("#img_pie").val();

    var _token = $("input[name=_token]").val();

    formData.append("servicio", servicio);
    formData.append("distribuidor", distribuidor);
    formData.append("numero_soporte", numero_soporte);
    formData.append("prefijo", prefijo);
    formData.append("img_header", img_header);
    formData.append("img_pie", img_pie);
    formData.append("_token", _token);
    var url = currentURL + '/distribuidor';
    $.ajax({
      url: url,
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    }).done(function (data) {
      $('.viewResult').html(data);
      $('.viewResult #tableDistribuidores').DataTable({
        "lengthChange": false
      });
    });
  });
  /**
   * Evento para mostrar el formulario editar distribuidores
   */

  $(document).on('dblclick', '#tableDistribuidores tbody tr', function (event) {
    event.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/distribuidor/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para cancelar la creacion/edicion del distribuidores
   */

  $(document).on("click", ".cancelDistribuidor", function (e) {
    $(".viewIndex").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para editar el distribuidores
   */

  $(document).on('click', '.updateDistribuidor', function (event) {
    event.preventDefault();
    var formData = new FormData(document.getElementById("editardistribuidores"));
    var servicio = $("#servicio").val();
    var distribuidor = $("#distribuidor").val();
    var numero_soporte = $("#numero_soporte").val();
    var prefijo = $("#prefijo").val();
    var img_header = $("#img_header").val();
    var img_pie = $("#img_pie").val();
    var id_distribuidor = $("#id_distribuidor").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/distribuidor/' + id_distribuidor;
    formData.append("servicio", servicio);
    formData.append("distribuidor", distribuidor);
    formData.append("numero_soporte", numero_soporte);
    formData.append("prefijo", prefijo);
    formData.append("img_header", img_header);
    formData.append("img_pie", img_pie);
    formData.append("_token", _token);
    formData.append("_method", "PUT");
    $.ajax({
      url: url,
      type: "POST",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    }).done(function (data) {
      $('.viewResult').html(data);
    });
  });
  /**
   * Evento para eliminar el distribuidores
   *
   */

  $(document).on('click', '.deleteDistribuidor', function (event) {
    event.preventDefault();
    var id_distribuidor = $("#id_distribuidor").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/distribuidor/' + id_distribuidor;
    $.ajax({
      url: url,
      type: 'DELETE',
      data: {
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewResult #tableDistribuidores').DataTable({
          "lengthChange": false,
          "order": [[2, "asc"]]
        });
      }
    });
  }); //Actualiza la imagen header seleccionada en el input file

  $(document).on('change', '#file_input_header', function (e) {
    var TmpPath_header = URL.createObjectURL(e.target.files[0]);
    $('#image_input_header').attr('src', TmpPath_header);
  }); //Actualiza la imagen pie seleccionada en el input file

  $(document).on('change', '#file_input_pie', function (e) {
    var TmpPath_pie = URL.createObjectURL(e.target.files[0]);
    $('#image_input_pie').attr('src', TmpPath_pie);
  });
});

/***/ }),

/***/ "./resources/js/module_administrador/menus.js":
/*!****************************************************!*\
  !*** ./resources/js/module_administrador/menus.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para ver las sub categorias de la categoria seleccionada
   */

  $(document).on("click", "#tableMenus tbody tr", function (e) {
    var id = $(this).data("id");
    $(".viewIndex").removeClass('col-md-12');
    $(".viewIndex").addClass('col-md-6');
    var url = currentURL + '/menus/' + id;
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewSubCat").html(data);
      $('.viewResult #tableSubMenus').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
    });
  });
  /**
   * Evento para crear una nueva categoria
   */

  $(document).on("click", ".newCat", function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewSubCat").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + '/menus/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para cancelar el alta de la categoria
   */

  $(document).on("click", ".cancelMenu", function (e) {
    $(".viewIndex").slideDown();
    $(".viewSubCat").slideDown();
    $(".viewCreate").slideUp();
  });
  /**
   * Evento para guardar la nueva categoria
   */

  $(document).on('click', '.saveMenu', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();
    var tipo = $("#tipo").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/menus';
    $.post(url, {
      nombre: nombre,
      descripcion: descripcion,
      tipo: tipo,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewCreate').slideUp();
      $('.viewIndex').slideDown();
      $('.viewResult #tableMenus').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
    });
  });
  /**
   * Evento para editar una categoria
   */

  $(document).on('dblclick', '#tableMenus tbody tr', function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewSubCat").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/menus/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para editar el menu
   */

  $(document).on('click', '.editMenu', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var id = $("#id_categoria").val();
    var descripcion = $("#descripcion").val();
    var tipo = $("#tipo").val();

    var _token = $("input[name=_token]").val();

    var _method = $("input[name=_method]").val();

    var url = currentURL + '/menus/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        nombre: nombre,
        descripcion: descripcion,
        tipo: tipo,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex').slideDown();
        $('.viewResult #tableMenus').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      }
    });
  });
  /**
   * Evento para eliminar una categoria
   */

  $(document).on('click', '.deleteMenu', function (event) {
    event.preventDefault();
    var id = $("#id_categoria").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/menus/' + id;
    $.ajax({
      url: url,
      type: 'DELETE',
      data: {
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex').slideDown();
        $('.viewResult #tableMenus').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      }
    });
  });
  /**
   * Evento para order las categorias
   */

  $(document).on('click', '.orderignCat', function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewSubCat").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + "/menus/ordering";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
      $("#sortable").sortable();
    });
  });
  /**
   * Evento para editar el menu
   */

  $(document).on('click', '.saveOrderMenu', function (event) {
    event.preventDefault();
    var ordenElementos = $("#sortable").sortable("toArray").toString();

    var _token = $("input[name=_token]").val();

    var url = currentURL + "/menus/updateOrdering";
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        ordenElementos: ordenElementos,
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex').slideDown();
        $('.viewResult #tableMenus').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/module_administrador/modulos.js":
/*!******************************************************!*\
  !*** ./resources/js/module_administrador/modulos.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo modulo
   */

  $(document).on("click", ".newModule", function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + '/modulos/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveModulo', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/modulos';
    $.post(url, {
      nombre: nombre,
      descripcion: descripcion,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewIndex').html(data);
      $('.viewCreate').slideUp();
      $(".viewCreate").html('');
      $('.viewIndex').slideDown();
      $('.viewIndex #tableModulos').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('dblclick', '#tableModulos tbody tr', function (event) {
    event.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/modulos/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para cancelar la creacion/edicion del modulo
   */

  $(document).on("click", ".cancelModulo", function (e) {
    $(".viewIndex").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.saveModulo', function (event) {
    event.preventDefault();
    var nombre = $("#nombreEdit").val();
    var descripcion = $("#descripcionEdit").val();
    var id_modulo = $("#id_modulo").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/modulos/' + id_modulo;
    $.ajax({
      url: url,
      type: 'PUT',
      data: {
        nombre: nombre,
        descripcion: descripcion,
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableModulos').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      }
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteModulo', function (event) {
    event.preventDefault();
    var id_modulo = $("#id_modulo").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/modulos/' + id_modulo;
    $.ajax({
      url: url,
      type: 'DELETE',
      data: {
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableModulos').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      }
    });
  });
  /**
   * Evento para order las categorias
   */

  $(document).on('click', '.orderignModule', function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewSubCat").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + "/modulos/ordering";
    $.get(url, function (data, textStatus, jqXHR) {
      console.log(data);
      $(".viewCreate").html(data);
      $("#sortable").sortable();
    });
  });
  /**
   * Evento para editar el menu
   */

  $(document).on('click', '.saveOrderModulo', function (event) {
    event.preventDefault();
    var ordenElementos = $("#sortable").sortable("toArray").toString();

    var _token = $("input[name=_token]").val();

    var url = currentURL + "/modulos/updateOrdering";
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        ordenElementos: ordenElementos,
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex').slideDown();
        $('.viewResult #tableMenus').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/module_administrador/submenus.js":
/*!*******************************************************!*\
  !*** ./resources/js/module_administrador/submenus.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para crear una nueva sub categoria
   */

  $(document).on("click", ".newSubCat", function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewSubCat").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + '/submenus/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para cancelar el alta de nuevo sub menu
   */

  $(document).on("click", ".cancelSubMenu", function (e) {
    $(".viewIndex").slideDown();
    $(".viewSubCat").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para guardar el nuevo sub menu
   */

  $(document).on('click', '.saveSubMenu', function (event) {
    event.preventDefault();
    var id_categoria = $("#id_categoria").val();
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();
    var tipo = $("#tipo").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/submenus';
    $.post(url, {
      nombre: nombre,
      descripcion: descripcion,
      tipo: tipo,
      id_categoria: id_categoria,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewSubCat').html(data);
      $('.viewCreate').slideUp();
      $(".viewCreate").html('');
      $(".viewSubCat").slideDown();
      $('.viewIndex').slideDown();
      $('.viewSubCat #tableSubMenus').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
    });
  });
  /**
   * Evento para mostrar el formulario de edicion de sub menu
   */

  $(document).on('dblclick', '#tableSubMenus tbody tr', function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewSubCat").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/submenus/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para editar un sub menu
   */

  $(document).on('click', '.editSubMenu', function (event) {
    event.preventDefault();
    var id_subCategoria = $("#id_subCate").val();
    var id_categoria = $("#id_categoria").val();
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();
    var tipo = $("#tipo").val();

    var _method = $("input[name=_method]").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/submenus/' + id_subCategoria;
    $.post(url, {
      nombre: nombre,
      descripcion: descripcion,
      tipo: tipo,
      id_categoria: id_categoria,
      id_subCategoria: id_subCategoria,
      _token: _token,
      _method: _method
    }, function (data, textStatus, xhr) {
      $('.viewSubCat').html(data);
      $('.viewCreate').slideUp();
      $(".viewCreate").html('');
      $(".viewSubCat").slideDown();
      $('.viewIndex').slideDown();
      $('.viewSubCat #tableSubMenus').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
    });
  });
  /**
   * Evento para eliminar una categoria
   */

  $(document).on('click', '.deleteSubMenu', function (event) {
    event.preventDefault();
    var id = $("#id_subCate").val();
    var id_categoria = $("#id_categoria").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/submenus/' + id;
    $.ajax({
      url: url,
      type: 'DELETE',
      data: {
        id_categoria: id_categoria,
        _token: _token
      },
      success: function success(data) {
        $('.viewSubCat').html(data);
        $('.viewCreate').slideUp();
        $(".viewCreate").html('');
        $(".viewSubCat").slideDown();
        $('.viewIndex').slideDown();
        $('.viewSubCat #tableSubMenus').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      }
    });
  });
  /**
   * Evento para order las sub categorias
   */

  $(document).on('click', '.orderignSubCat', function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewSubCat").slideUp();
    $(".viewCreate").slideDown();
    var id_categoria = $("#id_categoria").val();
    var url = currentURL + "/submenus/ordering/" + id_categoria;
    console.log(id_categoria);
    $.get(url, id_categoria, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
      $("#sortable").sortable();
    });
  });
  /**
   * Evento para editar el menu
   */

  $(document).on('click', '.saveOrdeSubrMenu', function (event) {
    event.preventDefault();
    var ordenElementos = $("#sortable").sortable("toArray").toString();

    var _token = $("input[name=_token]").val();

    var id_categoria = $("#id_categoria").val();
    var url = currentURL + "/submenus/updateOrdering";
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        ordenElementos: ordenElementos,
        id_categoria: id_categoria,
        _token: _token
      },
      success: function success(result) {
        $('.viewSubCat').html(result);
        $('.viewCreate').slideUp();
        $(".viewCreate").html('');
        $(".viewSubCat").slideDown();
        $('.viewIndex').slideDown();
        $('.viewSubCat #tableSubMenus').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/module_administrador/troncales.js":
/*!********************************************************!*\
  !*** ./resources/js/module_administrador/troncales.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo modulo
   */

  $(document).on("click", ".newTroncal", function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + '/troncales/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveTroncal', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var ip_media = $("#ip_media").val();
    var ip_host = $("#ip_host").val();
    var Cat_Distribuidor_id = $("#distribuidores").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/troncales';
    $.post(url, {
      nombre: nombre,
      ip_media: ip_media,
      ip_host: ip_host,
      Cat_Distribuidor_id: Cat_Distribuidor_id,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewIndex #tableTroncales').DataTable({
        "lengthChange": true
      });
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('dblclick', '#tableTroncales tbody tr', function (event) {
    event.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/troncales/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
    });
  });
  /**
   * Evento para cancelar la creacion/edicion del modulo
   */

  $(document).on("click", ".cancelTroncal", function (e) {
    $(".viewIndex").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updateTrocal', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var ip_media = $("#ip_media").val();
    var ip_host = $("#ip_host").val();
    var Cat_Distribuidor_id = $("#distribuidores").val();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/troncales/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        nombre: nombre,
        ip_media: ip_media,
        ip_host: ip_host,
        Cat_Distribuidor_id: Cat_Distribuidor_id,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableTroncales').DataTable({
          "lengthChange": true
        });
      }
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteTroncal', function (event) {
    event.preventDefault();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var _method = "DELETE";
    var url = currentURL + '/troncales/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableTroncales').DataTable({
          "lengthChange": true
        });
      }
    });
  });
  /**
   * Evento que autocompleta el valor del input Troncal Sansay
   * en base a lo que se escriba en el input nombre
   */

  $(document).on('keyup', '#nombre', function (event) {
    var nombre_troncal = $(this).val();
    var nombre = nombre_troncal.replace(" ", "_");
    $("#troncal_sansay").val("BUS > " + nombre + " > DID");
  });
  /**
   * Evento para invocar a la ventana modal para visualizar la configuracion
   */

  $(document).on('click', '.show-modal', function (event) {
    var id = $(this).val(); //alert(id);

    var url = currentURL + '/troncales/' + 1;
    $.get(url, function (data, textStatus, xhr) {
      $("#configuracionmodal").html(data);
      $("#configuracionmodal").modal("show");
    });
  });
});

/***/ }),

/***/ "./resources/js/module_administrador/usuarios.js":
/*!*******************************************************!*\
  !*** ./resources/js/module_administrador/usuarios.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para el menu categorias y mostrar las sub categorias
   */

  $(".menu-categorias li a").click(function (e) {
    e.preventDefault();
    $(".viewResult").html('');
    var url = $(this).attr('href');
    $.get(url, function (data, textStatus, jqXHR) {
      $(".sub-categorias").html(data);
    });
  });
  /**
   * Evento para el menu de sub categorias y mostrar la vista
   */

  $(".sub-categorias").on("click", ".subCat a", function (e) {
    e.preventDefault();
    var id = $(this).data("id");

    if (id == 6) {
      url = currentURL + '/usuarios';
      table = ' #tableUsuarios';
    } else if (id == 4) {
      url = currentURL + '/menus';
      table = ' #tableMenus';
    } else if (id == 3) {
      url = currentURL + '/modulos';
      table = ' #tableDistribuidores';
    } else if (id == 1) {
      url = currentURL + '/distribuidor';
      table = ' #tableDistribuidores';
    } else if (id == 8) {
      url = currentURL + '/did';
      table = ' #tableDid';
    } else if (id == 10) {
      url = currentURL + '/cat_empresa';
      table = ' #tableDid';
    } else if (id == 11) {
      url = currentURL + '/cat_ip_pbx';
      table = ' #tableDid';
    } else if (id == 12) {
      url = currentURL + '/cat_nas';
      table = ' #tableDid';
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
    }

    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewResult").html(data);
      $('.viewResult' + table).DataTable({
        "lengthChange": true
      });
    });
  });
  /**
   * Evento para ver el formulario de nuevo usuario
   */

  $(".viewResult").on("click", ".newUser", function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + '/usuarios/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
      /**
       * Evento para cancelar el alta de nuevo usuario
       */

      $(".viewCreate").on("click", ".cancelClient", function (e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
      });
      /**
       * Evento para guardar el nuevo usuario
       */

      $('.viewCreate').on('click', '.saveClient', function (event) {
        event.preventDefault();
        var name = $("#name").val();
        var email = $("#email").val();
        var pass_1 = $("#pass_1").val();
        var cliente = $("#cliente").val();
        var rol = $("#rol").val();

        var _token = $("input[name=_token]").val();

        var url = currentURL + '/usuarios';
        var arr = $('[name="cats[]"]:checked').map(function () {
          return this.value;
        }).get();
        $.post(url, {
          name: name,
          email: email,
          password: pass_1,
          id_cliente: cliente,
          rol: rol,
          arr: arr,
          _token: _token
        }, function (data, textStatus, xhr) {
          $('.viewResult').html(data);
          $('.viewCreate').slideUp();
          $('.viewIndex').slideDown();
          $('.viewResult #tableUsuarios').DataTable({
            "lengthChange": true
          });
        });
      });
    });
  });
  /**
   * Evento para editar un usuario
   */

  $(".viewResult").on('dblclick', '#tableUsuarios tbody tr', function (event) {
    event.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/usuarios/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
      /**
       * Evento para cancelar la edicion del usuario
       */

      $(".viewCreate").on("click", ".cancelClient", function (e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
      });
      /**
       * Evento para editar el usuario
       */

      $('.viewCreate').on('click', '.saveClient', function (event) {
        event.preventDefault();
        var name = $("#name").val();
        var id_user = $("#id_user").val();
        var email = $("#email").val();
        var pass_1 = $("#pass_1").val();
        var cliente = $("#cliente").val();
        var rol = $("#rol").val();

        var _token = $("input[name=_token]").val();

        var _method = "PUT";
        var url = currentURL + '/usuarios/' + id_user;
        var arr = $('[name="cats[]"]:checked').map(function () {
          return this.value;
        }).get();
        $.ajax({
          url: url,
          type: 'PUT',
          data: {
            name: name,
            email: email,
            password: pass_1,
            id_cliente: cliente,
            rol: rol,
            arr: arr,
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewCreate').slideUp();
            $('.viewIndex').slideDown();
            $('.viewResult #tableUsuarios').DataTable({
              "lengthChange": true
            });
          }
        });
      });
      /**
       * Evento para eliminar el  usuario
       */

      $('.viewCreate').on('click', '.deleteClient', function (event) {
        event.preventDefault();
        var id_user = $("#id_user").val();

        var _token = $("input[name=_token]").val();

        var url = currentURL + '/usuarios/' + id_user;
        $.ajax({
          url: url,
          type: 'DELETE',
          data: {
            _token: _token
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewCreate').slideUp();
            $('.viewIndex').slideDown();
            $('.viewResult #tableUsuarios').DataTable({
              "lengthChange": true
            });
          }
        });
      });
    });
  });
});

/***/ }),

/***/ 0:
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/js/module_administrador/usuarios.js ./resources/js/module_administrador/modulos.js ./resources/js/module_administrador/submenus.js ./resources/js/module_administrador/menus.js ./resources/js/module_administrador/distribuidores.js ./resources/js/module_administrador/dids.js ./resources/js/module_administrador/cat_estado_agente.js ./resources/js/module_administrador/cat_estado_cliente.js ./resources/js/module_administrador/cat_estado_empresa.js ./resources/js/module_administrador/cat_ip_pbx.js ./resources/js/module_administrador/cat_nas.js ./resources/js/module_administrador/troncales.js ./resources/js/module_administrador/canales.js ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\nimbus\resources\js\app.js */"./resources/js/app.js");
__webpack_require__(/*! C:\xampp\htdocs\nimbus\resources\js\module_administrador\usuarios.js */"./resources/js/module_administrador/usuarios.js");
__webpack_require__(/*! C:\xampp\htdocs\nimbus\resources\js\module_administrador\modulos.js */"./resources/js/module_administrador/modulos.js");
__webpack_require__(/*! C:\xampp\htdocs\nimbus\resources\js\module_administrador\submenus.js */"./resources/js/module_administrador/submenus.js");
__webpack_require__(/*! C:\xampp\htdocs\nimbus\resources\js\module_administrador\menus.js */"./resources/js/module_administrador/menus.js");
__webpack_require__(/*! C:\xampp\htdocs\nimbus\resources\js\module_administrador\distribuidores.js */"./resources/js/module_administrador/distribuidores.js");
__webpack_require__(/*! C:\xampp\htdocs\nimbus\resources\js\module_administrador\dids.js */"./resources/js/module_administrador/dids.js");
__webpack_require__(/*! C:\xampp\htdocs\nimbus\resources\js\module_administrador\cat_estado_agente.js */"./resources/js/module_administrador/cat_estado_agente.js");
__webpack_require__(/*! C:\xampp\htdocs\nimbus\resources\js\module_administrador\cat_estado_cliente.js */"./resources/js/module_administrador/cat_estado_cliente.js");
__webpack_require__(/*! C:\xampp\htdocs\nimbus\resources\js\module_administrador\cat_estado_empresa.js */"./resources/js/module_administrador/cat_estado_empresa.js");
__webpack_require__(/*! C:\xampp\htdocs\nimbus\resources\js\module_administrador\cat_ip_pbx.js */"./resources/js/module_administrador/cat_ip_pbx.js");
__webpack_require__(/*! C:\xampp\htdocs\nimbus\resources\js\module_administrador\cat_nas.js */"./resources/js/module_administrador/cat_nas.js");
__webpack_require__(/*! C:\xampp\htdocs\nimbus\resources\js\module_administrador\troncales.js */"./resources/js/module_administrador/troncales.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\nimbus\resources\js\module_administrador\canales.js */"./resources/js/module_administrador/canales.js");


/***/ })

/******/ });