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

<<<<<<< HEAD
=======
/***/ "./resources/js/dids.js":
/*!******************************!*\
  !*** ./resources/js/dids.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo distribuidores
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
    var id_empresa = $("#id_empresa").val();
    var tipo = $("#tipo").val();
    var prefijo = $("#prefijo").val();
    var did = $("#did").val();
    var descripcion = $("#descripcion").val();
    var id_troncal_sansay = $("#id_troncal_sansay").val();
    var gateway = $("#gateway").val();
    var fakedid = $("#fakedid").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/did';
    var arr = $('[name="cats[]"]:checked').map(function () {
      return this.value;
    }).get();
    $.post(url, {
      id_empresa: id_empresa,
      tipo: tipo,
      prefijo: prefijo,
      did: did,
      descripcion: descripcion,
      id_troncal_sansay: id_troncal_sansay,
      gateway: gateway,
      fakedid: fakedid,
      arr: arr,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewCreate').slideUp();
      $('.viewIndex').slideDown();
      $('.viewResult #tableDids').DataTable({
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
    var url = currentURL + "/did/" + id + "/edit"; // alert(url);

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
    event.preventDefault(); // formdata es para down de IL

    var id_empresa = $("#id_empresa").val();
    var id_did = $("#id_did").val();
    var tipo = $("#tipo").val();
    var prefijo = $("#prefijo").val();
    var did = $("#did").val();
    var descripcion = $("#descripcion").val();
    var id_troncal_sansay = $("#id_troncal_sansay").val();
    var gateway = $("#gateway").val();
    var fakedid = $("#fakedid").val();

    var _token = $("input[name=_token]").val();

    var _method = 'PUT';
    var url = currentURL + '/did/' + id_did;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        id_empresa: id_empresa,
        id_did: id_did,
        tipo: tipo,
        prefijo: prefijo,
        did: did,
        descripcion: descripcion,
        id_troncal_sansay: id_troncal_sansay,
        gateway: gateway,
        fakedid: fakedid,
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
   * 
   */

  $(document).on('click', '.deleteDid', function (event) {
    event.preventDefault();
    var id_did = $("#id_did").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/did/' + id_did;
    $.ajax({
      url: url,
      type: 'DELETE',
      data: {
        _token: _token
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
});

/***/ }),

>>>>>>> a08c65043cec2bbe06885f5566bb5e59702e7199
/***/ "./resources/js/distribuidores.js":
/*!****************************************!*\
  !*** ./resources/js/distribuidores.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo distribuidores
   */

  $(document).on("click", ".nuevoDistribuidor", function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var url = currentURL + '/distribuidor/create';
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
    var img_header = $("#img_header").val();
    var img_pie = $("#img_pie").val();

    var _token = $("input[name=_token]").val();

    formData.append("servicio", servicio);
    formData.append("distribuidor", distribuidor);
    formData.append("numero_soporte", numero_soporte);
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
    var img_header = $("#img_header").val();
    var img_pie = $("#img_pie").val();
    var id_distribuidor = $("#id_distribuidor").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/distribuidor/' + id_distribuidor;
    formData.append("servicio", servicio);
    formData.append("distribuidor", distribuidor);
    formData.append("numero_soporte", numero_soporte);
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
<<<<<<< HEAD
   *
=======
   * 
>>>>>>> a08c65043cec2bbe06885f5566bb5e59702e7199
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
        $('.viewIndex #tableDistribuidores').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/menus.js":
/*!*******************************!*\
  !*** ./resources/js/menus.js ***!
  \*******************************/
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

/***/ "./resources/js/modulos.js":
/*!*********************************!*\
  !*** ./resources/js/modulos.js ***!
  \*********************************/
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

/***/ "./resources/js/submenus.js":
/*!**********************************!*\
  !*** ./resources/js/submenus.js ***!
  \**********************************/
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
<<<<<<< HEAD
    console.log(id_categoria);
=======
>>>>>>> a08c65043cec2bbe06885f5566bb5e59702e7199
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

<<<<<<< HEAD
    var id_categoria = $("#id_categoria").val();
=======
>>>>>>> a08c65043cec2bbe06885f5566bb5e59702e7199
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

/***/ "./resources/js/usuarios.js":
/*!**********************************!*\
  !*** ./resources/js/usuarios.js ***!
  \**********************************/
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
      var url = currentURL + '/usuarios';
      $.get(url, function (data, textStatus, jqXHR) {
        $(".viewResult").html(data);
        $('.viewResult #tableUsuarios').DataTable({
          "lengthChange": true
        });
      });
    } else if (id == 4) {
      var _url = currentURL + '/menus';

      $.get(_url, function (data, textStatus, jqXHR) {
        $(".viewResult").html(data);
        $('.viewResult #tableMenus').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      });
    } else if (id == 3) {
      var _url2 = currentURL + '/modulos';

      $.get(_url2, function (data, textStatus, jqXHR) {
        $(".viewResult").html(data);
        $('.viewResult #tableModulos').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      });
    } else if (id == 1) {
      var _url3 = currentURL + '/distribuidor';

      $.get(_url3, function (data, textStatus, jqXHR) {
        $(".viewResult").html(data);
        $('.viewResult #tableModulos').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      });
    } else if (id == 8) {
      var _url4 = currentURL + '/did';

      $.get(_url4, function (data, textStatus, jqXHR) {
        $(".viewResult").html(data);
        $('.viewResult #tableModulos').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      });
    }
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

<<<<<<< HEAD
        var _method = "PUT";
=======
>>>>>>> a08c65043cec2bbe06885f5566bb5e59702e7199
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
<<<<<<< HEAD
            _token: _token,
            _method: _method
=======
            _token: _token
>>>>>>> a08c65043cec2bbe06885f5566bb5e59702e7199
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
<<<<<<< HEAD
/*!****************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/js/usuarios.js ./resources/js/modulos.js ./resources/js/submenus.js ./resources/js/menus.js ./resources/js/distribuidores.js ***!
  \****************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\app.js */"./resources/js/app.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\usuarios.js */"./resources/js/usuarios.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\modulos.js */"./resources/js/modulos.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\submenus.js */"./resources/js/submenus.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\menus.js */"./resources/js/menus.js");
module.exports = __webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\distribuidores.js */"./resources/js/distribuidores.js");
=======
/*!***************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/js/usuarios.js ./resources/js/modulos.js ./resources/js/submenus.js ./resources/js/menus.js ./resources/js/distribuidores.js ./resources/js/dids.js ***!
  \***************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! c:\xampp\htdocs\Nimbus\resources\js\app.js */"./resources/js/app.js");
__webpack_require__(/*! c:\xampp\htdocs\Nimbus\resources\js\usuarios.js */"./resources/js/usuarios.js");
__webpack_require__(/*! c:\xampp\htdocs\Nimbus\resources\js\modulos.js */"./resources/js/modulos.js");
__webpack_require__(/*! c:\xampp\htdocs\Nimbus\resources\js\submenus.js */"./resources/js/submenus.js");
__webpack_require__(/*! c:\xampp\htdocs\Nimbus\resources\js\menus.js */"./resources/js/menus.js");
__webpack_require__(/*! c:\xampp\htdocs\Nimbus\resources\js\distribuidores.js */"./resources/js/distribuidores.js");
module.exports = __webpack_require__(/*! c:\xampp\htdocs\Nimbus\resources\js\dids.js */"./resources/js/dids.js");
>>>>>>> a08c65043cec2bbe06885f5566bb5e59702e7199


/***/ })

/******/ });