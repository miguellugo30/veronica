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

/***/ "./resources/js/module_outbound/campanas.js":
/*!**************************************************!*\
  !*** ./resources/js/module_outbound/campanas.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

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
    $(".tableCampanas tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para regresar
   */

  $(document).on('click', '.returnCampana', function (event) {
    event.preventDefault();
    url = currentURL + 'outbound/campanas';
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewResult").html(data);
      $('.viewResult' + table).DataTable({
        "lengthChange": true
      });
    });
  });
  /**
   * Evento para iniciar campaña
   */

  $(document).on('click', '.startCampana', function (event) {
    event.preventDefault();
    var campana_id = $("#idSeleccionado").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + 'outbound/campanas/iniciar-campana';
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        campana_id: campana_id,
        _token: _token
      },
      success: function success(result) {
        $(".viewResult").html(result);
      }
    });
  });
  /**
   * Evento para detener campaña
   */

  $(document).on('click', '.endCampana', function (event) {
    event.preventDefault();
    var campana_id = $("#idSeleccionado").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + 'outbound/campanas/detener-campana';
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        campana_id: campana_id,
        _token: _token
      },
      success: function success(result) {
        $(".viewResult").html(result);
      }
    });
  });
  /**
   * Evento para mostrar las campanas
   */

  $(document).on('dblclick', '#tableCampanas tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    var url = currentURL + 'outbound/campanas/' + id;
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(result) {
        $(".viewResult").html(result);
      }
    });
    $(".tableCampanas tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para mostrar el formulario para crear la nueva campana
   */

  $(document).on("click", ".newCampanaOutbound", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Nueva Campaña');
    var url = currentURL + 'outbound/campanas/create';
    agentesParticipantes = new Array();
    $('#action').removeClass('updateCampanaOutbound');
    $('#action').addClass('saveCampanaOutbound');
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
  * Seleccionar todos los no seleccionados
  */

  $(document).on('change', '#strategy', function (event) {
    if ($(this).val() == 'predictivo') {
      $("#opcion_predictivo").slideDown();
    } else {
      $("#opcion_predictivo").slideUp();
    }
  });
  /**
   * Evento para guardar la nueva campana
   */

  $(document).on('click', '.saveCampanaOutbound', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var agentesParticipantes = $("#agentes_participantes").val();
    var mlogeo = $("#mlogeo").val();
    var strategy = $("#strategy").val();
    var wrapuptime = $("#wrapuptime").val();
    var no_intentos = $("#no_intentos").val();
    var script = $("#script").val();
    var bd = $("#bd").val();
    var calificacion = $("#calificacion").val();
    var dids = $("#dids").val();
    var llamadas_agente = $("#llamadas_agente").val();
    var msginical = $("#msginical").val();

    var _token = $("input[name=_token]").val();

    if (llamadas_agente == '') {
      llamadas_agente = 1;
    }

    var url = currentURL + 'outbound/campanas';
    $.ajax({
      url: url,
      type: "post",
      data: {
        nombre: nombre,
        agentesParticipantes: agentesParticipantes,
        mlogeo: mlogeo,
        strategy: strategy,
        wrapuptime: wrapuptime,
        no_intentos: no_intentos,
        script: script,
        bd: bd,
        calificacion: calificacion,
        dids: dids,
        llamadas_agente: llamadas_agente,
        msginical: msginical,
        _token: _token
      }
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      $('.viewResult').html(data);
      $('.viewResult #tableCampanas').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
      agentesParticipantes.length = 0;
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
  * Evento para agregar agentes a la campana
  */

  $(document).on('click', '.agentesNoSeleccionados', function (event) {
    var modoLogueo = $('#mlogeo').val();

    if (modoLogueo == "") {
      Swal.fire('!Tenemos un problema!', 'Tienes que elegir primero la modalidad de logueo a usar en esta campaña.', 'warning');
    } else {
      var _token = $("input[name=_token]").val();

      var _url = currentURL + 'outbound/campanas/validar_modo_logueo';

      var agentesSeleccionados = [];
      var agentesDiferentes = [];
      var agentesValidos = [];
      $("input[name='agentes_no']:checked").each(function () {
        agentesSeleccionados.push(parseInt(this.value));
      });

      if (agentesSeleccionados.length == 0) {
        Swal.fire('!Tenemos un problema!', 'Tienes que elegir por lo menos un agente que participara en esta campaña.', 'warning');
      } else {
        $.ajax({
          url: _url,
          type: 'POST',
          data: {
            _token: _token,
            idAgente: agentesSeleccionados
          },
          success: function success(result) {
            for (var i = 0; i < agentesSeleccionados.length; i++) {
              for (var j = 0; j < result.length; j++) {
                if (agentesSeleccionados[i] === parseInt(result[j]['Agentes_id'])) {
                  if (modoLogueo === result[j]['modalidad_logue']) {
                    agentesValidos.push(agentesSeleccionados[i]);
                  } else {
                    agentesDiferentes.push(agentesSeleccionados[i]);
                  }
                }
              }
            }

            if (agentesDiferentes.length > 0) {
              for (var _i = 0; _i < agentesDiferentes.length; _i++) {
                $("#tr_" + agentesDiferentes[_i]).css('background-color', '#ffc0c0');
              }

              Swal.fire('!Tenemos un problema!', 'No se puede agregar los agentes marcados en rojo, ya que esta campaña tiene diferente modalidad de logueo a las cuales ya estan agregados los agentes.', 'warning');
            }

            if (agentesValidos.length > 0) {
              $('#todos_no_selec').prop('checked', false);

              for (var _i2 = 0; _i2 < agentesValidos.length; _i2++) {
                var fila = $("#tr_" + agentesValidos[_i2]);
                fila.attr("background-color", '');
                fila.clone().appendTo(".agenteSelec"); //Clonamos la fila

                $(".agenteSelec #tr_" + agentesValidos[_i2]).css('background-color', '');
                $(".agenteSelec #tr_" + agentesValidos[_i2] + " input[name='agentes_no']").prop('checked', false);
                agentesParticipantes.push(agentesValidos[_i2]);
                $("#agentes_participantes").val(JSON.stringify(agentesParticipantes));
                fila.remove();
              }
            }
          }
        });
      }
    }
  });
  /**
   * Evento para quitar agentes a la campana
   */

  $(document).on('click', '.agentesSeleccionados', function (event) {
    $('#todos_selec').prop('checked', false);
    $(".agenteSelec input[name='agentes_no']:checked").each(function () {
      var fila = $(".agenteSelec #tr_" + this.value);
      var index = agentesParticipantes.indexOf(parseInt(this.value));

      if (index > -1) {
        agentesParticipantes.splice(index, 1);
      }

      fila.clone().appendTo(".agentesNoSelec"); //Clonamos la fila

      fila.remove();
    });
    $(".agentesNoSelec input[name='agentes_no']").prop('checked', false);
    $("#agentes_participantes").val(JSON.stringify(agentesParticipantes));
  });
  /**
  * Seleccionar todos los no seleccionados
  */

  $(document).on('change', '#todos_no_selec', function (event) {
    $(".agentesNoSelec input[name='agentes_no']").prop('checked', $(this).prop("checked"));
  });
  /**
   * Seleccionar todos los seleccionados
   */

  $(document).on('change', '#todos_selec', function (event) {
    $(".agenteSelec input[name='agentes_no']").prop('checked', $(this).prop("checked"));
  });
  /**
   * Evento para capturar el nombre de la campana y mostrar en la etiqueta
   */

  $(document).on('keyup', '#nombre', function (event) {
    var valor = $('#nombre').val();
    $(".nombreCampana").text(valor);
  });
  /**
   * Evento para visualizar la configuración de la campana
   */

  $(document).on('click', '.editCampanaOutbound', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    $('#tituloModal').html('Detalles de Campana');
    var url = currentURL + 'outbound/campanas/' + id + '/edit';
    $('#action').addClass('updateCampanaOutbound');
    $('#action').removeClass('saveCampanaOutbound');
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
   * Evento para guardar la nueva campana
   */

  $(document).on('click', '.updateCampanaOutbound', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var agentesParticipantes = $("#agentes_participantes").val();
    var mlogeo = $("#mlogeo").val();
    var strategy = $("#strategy").val();
    var wrapuptime = $("#wrapuptime").val();
    var no_intentos = $("#no_intentos").val();
    var script = $("#script").val();
    var bd = $("#bd").val();
    var calificacion = $("#calificacion").val();
    var dids = $("#dids").val();
    var llamadas_agente = $("#llamadas_agente").val();
    var msginical = $("#msginical").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var id = $("#idSeleccionado").val();

    if (llamadas_agente == '') {
      llamadas_agente = 1;
    }

    var url = currentURL + 'outbound/campanas/' + id;
    $.ajax({
      url: url,
      type: "post",
      data: {
        nombre: nombre,
        agentesParticipantes: agentesParticipantes,
        mlogeo: mlogeo,
        strategy: strategy,
        wrapuptime: wrapuptime,
        no_intentos: no_intentos,
        script: script,
        bd: bd,
        calificacion: calificacion,
        dids: dids,
        llamadas_agente: llamadas_agente,
        msginical: msginical,
        _token: _token,
        _method: _method
      }
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      $('.viewResult').html(data);
      $('.viewResult #tableCampanas').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
      agentesParticipantes.length = 0;
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Funcion para mostrar los errores de los formularios
   */

  function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $(".form-control").removeClass('is-invalid');

    for (var clave in msg) {
      $("#" + clave).addClass('is-invalid');

      if (msg.hasOwnProperty(clave)) {
        $(".print-error-msg").find("ul").append('<li>' + msg[clave][0] + '</li>');
      }
    }
  }
});

/***/ }),

/***/ "./resources/js/module_outbound/menu.js":
/*!**********************************************!*\
  !*** ./resources/js/module_outbound/menu.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para el menu de sub categorias y mostrar la vista
   */

  $(document).on("click", ".sub-menu-outbound", function (e) {
    e.preventDefault();
    var id = $(this).data("id");

    if (id == 'sub-34') {
      url = currentURL + 'outbound/campanas';
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
/*!***********************************************************************************************!*\
  !*** multi ./resources/js/module_outbound/menu.js ./resources/js/module_outbound/campanas.js ***!
  \***********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_outbound/menu.js */"./resources/js/module_outbound/menu.js");
module.exports = __webpack_require__(/*! /Users/miguellugo/Documents/Desarrollos/Personales/Veronica/resources/js/module_outbound/campanas.js */"./resources/js/module_outbound/campanas.js");


/***/ })

/******/ });