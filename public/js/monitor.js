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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/module_monitor/menu.js":
/*!*********************************************!*\
  !*** ./resources/js/module_monitor/menu.js ***!
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

    if (id == 'cat-23') {
      url = currentURL + '/monitoreo';
      table = ' #monitoreo';
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

/***/ "./resources/js/module_monitor/monitoreo.js":
/*!**************************************************!*\
  !*** ./resources/js/module_monitor/monitoreo.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para recuperar los agentes de un grupo
   */

  $(document).on("click", ".list-group-item", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $(".list-group-item").removeClass('active');
    $(this).addClass('active');
    url = currentURL + '/monitoreo/' + id;
    $("#grupo-selec").val(id);
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewListadoAgentes").html(data);
    });
  });
  /**
   * Evento para iniciar el monitoreo
   */

  $(document).on("click", "#iniciar-monitoreo", function (e) {
    e.preventDefault();
    valoresCheck = [];
    $("input[name='agente-check']:checked").each(function () {
      valoresCheck.push(this.value);
    });
    llamadas_mayores = $("#llamadas_mayores").val();
    num_monitoreo = $("#num_monitoreo").val();
    tiempo_rotacion = $("#tiempo_rotacion").val();
    _token = $("input[name=_token]").val();
    $('#sin_tiempo_rotacion').prop('checked') ? rotacion = 1 : rotacion = 0;

    if (tiempo_rotacion == '' && rotacion == 0) {
      Swal.fire('Error!', 'Se tiene que elegir un tiempo de rotación.', 'error');
      return false;
    }

    for (var i = 0; i < valoresCheck.length; i++) {
      $('#agente_' + valoresCheck[i]).removeClass('table-active');
      $('#agente_' + valoresCheck[i]).addClass('table-primary');
    }
    /**
     * Validamos que se tengan agentes seleccionados
     **/


    if (valoresCheck.length == 0) {
      Swal.fire('Tenemos un problema!', 'Debes de elegir por lo menos un agente.', 'error');
      return false;
    } else {
      /**
       * Enviamos la petición para generar la llamada
       **/
      var _url = currentURL + '/monitoreo/0';

      var method = 'PUT';
      $.post(_url, {
        num_monitoreo: num_monitoreo,
        _method: method,
        _token: _token
      }, function (data, textStatus, xhr) {
        obj = $.parseJSON(data);

        if (obj['status'] == 1) {
          /**
           * Se empieza a validar se pudo establecer la llamada
           **/
          var interval = setInterval(function () {
            var num_monitoreo = $("#num_monitoreo").val();
            var url = currentURL + '/monitoreo/LlamadaEstablecida';
            $.post(url, {
              num_monitoreo: num_monitoreo,
              _token: _token
            }, function (data, textStatus, jqXHR) {
              obj = $.parseJSON(data);
              /**
               * Si la llamada fue establecida, se detienen la validación y el timeOut
               * y se inicia el proceso para monitorear a los agentes
               **/

              if (obj['status'] == 1) {
                $('#listadoAgentes tbody tr').addClass('table-active');
                $("#iniciar-monitoreo").slideUp();
                $('#detener-monitoreo').slideDown();
                $('#siguiente-monitoreo').slideDown();
                $('#iniciar-coaching').slideDown();
                $('#iniciar-conferencia').slideDown();
                start();
                clearInterval(interval);
                clearTimeout(timeOut);
              }
            });
          }, 3000);
          /**
           * Después de 30 segundos se manda error al no establecer llamada
           **/

          var timeOut = setTimeout(function () {
            clearInterval(interval);
            Swal.fire('Error!', 'El destino no contesta o no se puede establecer la llamada.', 'error');
          }, 30000);
        } else {
          Swal.fire('Error!', obj['estado'], 'error');
        }
      });
    }
  });
  /**
   * Evento para detener el monitoreo
   */

  $(document).on("click", "#detener-monitoreo", function (e) {
    e.preventDefault();
    $(this).slideUp();
    $('#siguiente-monitoreo').slideUp();
    $('#iniciar-coaching').slideUp();
    $('#iniciar-conferencia').slideUp();
    $('#iniciar-monitoreo').slideDown();
    $("#iniciar-coaching").prop('disabled', true);
    $("#iniciar-conferencia").prop('disabled', true);
    $('#listadoAgentes tbody tr').removeClass('table-active');
    $('#listadoAgentes tbody tr').removeClass('table-primary');
    $('#listadoAgentes tbody tr').removeClass('table-success');
    $('#listadoAgentes tbody tr input[type=checkbox]').prop("checked", false);
    var num_monitoreo = $("#num_monitoreo").val();
    var url = currentURL + '/monitoreo/0';
    $.post(url, {
      num_monitoreo: num_monitoreo,
      _token: _token,
      _method: "DELETE"
    }, function (data, textStatus, jqXHR) {//console.log(data);
    });
    stop(timerListAgente);
    stop(timerAgente);
  });
  /**
   * Evento para detener el monitoreo
   */

  $(document).on("click", "#siguiente-monitoreo", function (e) {
    e.preventDefault();
    url = currentURL + '/monitoreo/' + num_monitoreo + '/edit';
    $.get(url, function (data, textStatus, jqXHR) {});
    agente++;
  });

  function stop(timer) {
    clearInterval(timer);
  }

  ;

  function start() {
    //use a one-off timer
    agente = 0;
    ini = 0;
    /**
     * Función para actualizar el listado de agentes
     * para poder obtener el estado de los agentes
     */

    timerListAgente = setInterval(function () {
      valoresCheck = [];
      $("input[name='agente-check']:checked").each(function () {
        valoresCheck.push(this.value);
      });
      var id = $("#grupo-selec").val();
      url = currentURL + '/monitoreo/' + id;
      $.get(url, function (data, textStatus, jqXHR) {
        $(".viewListadoAgentes").html(data);
        $('#listadoAgentes tbody tr').addClass('table-active');

        for (var i = 0; i < valoresCheck.length; i++) {
          $('#listadoAgentes tbody tr#agente_' + valoresCheck[i] + ' input[type=checkbox]').prop("checked", true);
          $('#agente_' + valoresCheck[i]).removeClass('table-active');
          $('#agente_' + valoresCheck[i]).addClass('table-primary');
        }
      });
    }, 3000);
    /**
     * Función saber si un agente tiene llamada y
     * empezarlo a monitorear
     */

    timerAgente = setInterval(function () {
      valoresCheck = [];
      $("input[name='agente-check']:checked").each(function () {
        valoresCheck.push(this.value);
      });

      if (agente >= valoresCheck.length) {
        agente = 0;
      }

      url = currentURL + '/monitoreo'; //console.log("Validando agente: " + valoresCheck[agente]);

      $.post(url, {
        id: valoresCheck[agente],
        llamadas_mayores: llamadas_mayores,
        num_monitoreo: num_monitoreo,
        _token: _token
      }, function (data, textStatus, xhr) {
        obj = $.parseJSON(data);

        if (obj['status'] == 1) {
          //console.log(" Agente en llamada");
          //console.log("Monitoreado agente: " + valoresCheck[agente]);
          $("#iniciar-coaching").prop('disabled', false);
          $("#iniciar-conferencia").prop('disabled', false);

          if (rotacion == 0) {
            //console.log("Se tiene un tiempo de monitoreo de: " + tiempo_rotacion);
            if (ini == 0) {
              iniciar_tiempo(parseInt(tiempo_rotacion + "000"));
            }
          }

          $('#agente_' + valoresCheck[agente]).addClass('table-success');
        } else {
          //console.log(" Agente sin llamada");
          //console.log(" Siguiente Agente");
          agente++;

          if (agente >= valoresCheck.length) {
            agente = 0;
          }
        }
      });
    }, 3000);
  }

  ;

  function iniciar_tiempo(tiempo_rotacion) {
    ini = 1; //console.log("Se inicia el tiempo de rotacion ");

    setTimeout(function () {
      //console.log("Se termina el tiempo de rotacion ");
      url = currentURL + '/monitoreo/' + num_monitoreo + '/edit';
      $.get(url, function (data, textStatus, jqXHR) {});
      ini = 0;
      agente++;
    }, tiempo_rotacion);
  }
  /**
   * Evento para iniciar el coaching
   */


  $(document).on("click", "#iniciar-coaching", function (e) {
    e.preventDefault();
    var num_monitoreo = $("#num_monitoreo").val();
    var url = currentURL + '/monitoreo/coaching';
    $.post(url, {
      num_monitoreo: num_monitoreo,
      _token: _token
    }, function (data, textStatus, jqXHR) {//console.log(data);
    });
  });
  /**
   * Evento para iniciar el conferencia
   */

  $(document).on("click", "#iniciar-conferencia", function (e) {
    e.preventDefault();
    var num_monitoreo = $("#num_monitoreo").val();
    var url = currentURL + '/monitoreo/conferencia';
    $.post(url, {
      num_monitoreo: num_monitoreo,
      _token: _token
    }, function (data, textStatus, jqXHR) {//console.log(data);
    });
  });

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
});

/***/ }),

/***/ 5:
/*!**********************************************************************************************!*\
  !*** multi ./resources/js/module_monitor/menu.js ./resources/js/module_monitor/monitoreo.js ***!
  \**********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\Users\mchlu\Documents\Desarrollos\Personales\Veronica\resources\js\module_monitor\menu.js */"./resources/js/module_monitor/menu.js");
module.exports = __webpack_require__(/*! C:\Users\mchlu\Documents\Desarrollos\Personales\Veronica\resources\js\module_monitor\monitoreo.js */"./resources/js/module_monitor/monitoreo.js");


/***/ })

/******/ });