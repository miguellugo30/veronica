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
    $(".updateEmpresa").slideUp();
    $("#accionActualizar").slideUp();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id_Empresa = $("#id_empresa").val();
    var url = currentURL + '/canales/create/' + id_Empresa;
    $.get(url, function (data, textStatus, jqXHR) {
      $("#formDataEmpresa").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveCanal', function (event) {
    event.preventDefault();
    var dataForm = $("#formDataEmpresa").serializeArray();
    var id = $("#Empresa_id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/canales';
    $.post(url, {
      dataForm: dataForm,
      _token: _token
    }, function (data, textStatus, xhr) {
      var url = currentURL + "/canales/" + id;
      $.ajax({
        url: url,
        type: 'GET',
        data: {
          _token: _token
        },
        success: function success(result) {
          $('#formDataEmpresa').html(result);
          $('#TableCatExts').DataTable({
            "lengthChange": true
          });
        }
      });
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
    var dataForm = $("#formDataEmpresa").serializeArray();

    var _token = $("input[name=_token]").val();

    var id = $("#id_empresa").val();
    var _method = "PUT";
    var url = currentURL + '/canales/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        dataForm: dataForm,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        //$('#formDataEmpresa').html(result);
        var url = currentURL + "/canales/" + id;
        $.get(url, function (data, textStatus, jqXHR) {
          $('#formDataEmpresa').html(data);
          $('#TableCatExts').DataTable({
            "lengthChange": true
          });
        });
      }
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteCanal', function (event) {
    event.preventDefault();
    var id = $(this).attr('id').replace('delete_', '');

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
        var id = $("#id_empresa").val();
        var url = currentURL + "/canales/" + id;
        $.get(url, function (data, textStatus, jqXHR) {
          $('#formDataEmpresa').html(data);
          $('#TableCatExts').DataTable({
            "lengthChange": true
          });
        });
      }
    });
  });
  /**
   * Evento para clonar una fila de la tabla de nuevo canal
   */

  $(document).on('click', '#add', function () {
    var clickID = $(".tableNewCanal tbody tr:last").attr('id').replace('tr_', ''); // Genero el nuevo numero id

    var newID = parseInt(clickID) + 1;
    fila = $(".tableNewCanal tbody tr:eq()").clone().appendTo(".tableNewCanal"); //Clonamos la fila
    //fila.find('select.tipo_canal').attr("data-pos", newID); //Buscamos el selecto con clase tipo_canal y le agregamos un nuevo atributo a pos

    fila.find('select.tipo_canal').attr({
      'data-pos': newID,
      name: 'tipo_canal_' + newID
    }); //Buscamos el selecto con clase tipo_canal y le agregamos un nuevo atributo a pos

    fila.find('.protocolo').attr({
      id: 'protocolo_' + newID,
      name: 'protocolo_' + newID
    }); //Buscamos el input con clase protocolo y le agregamos un nuevo ID

    fila.find('.protocolo').val(""); //Buscamos el input con clase protocolo y le asignamos un valor vacio

    fila.find('.Troncales_id_canal').attr({
      id: 'Troncales_id_canal_' + newID,
      name: 'Troncales_id_canal_' + newID
    }); //Buscamos el input con clase Troncales_id_canal y le agregamos un nuevo ID

    fila.find('.Troncales_id').attr({
      id: 'Troncales_id_' + newID,
      name: 'Troncales_id_' + newID
    }); //Buscamos el input con clase Troncales_id_canal y le agregamos un nuevo ID

    fila.find('.prefijo').attr({
      id: 'prefijo_' + newID,
      name: 'prefijo_' + newID
    }); //Buscamos el input con clase Troncales_id_canal y le agregamos un nuevo ID

    fila.find('.prefijo').val(""); //Buscamos el input con clase protocolo y le asignamos un valor vacio

    fila.attr("id", 'tr_' + newID);
  });
  /**
   * Evento para eliminars una fila de la tabla de nuevo canal
   */

  $(document).on('click', '.tr_clone_remove', function () {
    var tr = $(this).closest('tr');
    tr.remove();
  });
  /**
   * Evento para obtener el valor del tipo de canal
   */

  $(document).on('change', '.tipo_canal', function (event) {
    var pos = $(this).data('pos');
    var id_Tipo_Canal = $(this).val();

    if (id_Tipo_Canal == 12 || id_Tipo_Canal == 11) {
      $("#protocolo_" + pos).val("LOCAL/");
      $("#Troncales_id_canal_" + pos).prop('disabled', 'disabled');
      $("#Troncales_id_" + pos).prop('disabled', false);
    } else {
      $("#protocolo_" + pos).val("SIP/");
      $("#Troncales_id_canal_" + pos).prop('disabled', false);
      $("#Troncales_id_" + pos).prop('disabled', 'disabled');
    }
  });
  /**
   * Evento para habilitar la edicion del canal seleccionado
   */

  $(document).on('click', '.editar_canal', function (event) {
    var id = $(this).val();
    /**
     * Habilitamos los inputs para editar
     */

    if ($(this).prop('checked')) {
      $("#tipo_Canal_" + id).prop("disabled", false);
      $("#Troncales_id_canal_" + id).prop("disabled", false);
      $("#protocolo_" + id).prop({
        "disabled": false,
        'readonly': true
      });
      $("#prefijo_" + id).prop("disabled", false);
      $("#prefijo_completo_" + id).prop("disabled", false);
      $("#delete_" + id).slideDown();
    } else {
      $("#tipo_Canal_" + id).prop("disabled", true);
      $("#Troncales_id_canal_" + id).prop("disabled", true);
      $("#protocolo_" + id).prop("disabled", true);
      $("#prefijo_" + id).prop("disabled", true);
      $("#prefijo_completo_" + id).prop("disabled", true);
      $("#delete_" + id).slideUp();
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

/***/ "./resources/js/module_administrador/cat_base_datos.js":
/*!*************************************************************!*\
  !*** ./resources/js/module_administrador/cat_base_datos.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo modulo
   */

  $(document).on("click", ".newDataBase", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Nuevo Base de Datos');
    $('#action').removeClass('updateBaseDatos');
    $('#action').addClass('saveBaseDatos');
    var url = currentURL + '/basedatos/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para mostrar el formulario de edicion de un canal
   */

  $(document).on("click", ".editDataBase", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Editar Base de Datos');
    $('#action').removeClass('saveBaseDatos');
    $('#action').addClass('updateBaseDatos');
    var id = $("#idSeleccionado").val();
    var url = currentURL + "/basedatos/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveBaseDatos', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var ubicacion = $("#ubicacion").val();
    var ip = $("#ip").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/basedatos';
    $.post(url, {
      nombre: nombre,
      ubicacion: ubicacion,
      ip: ip,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewIndex #tableBaseDatos').DataTable({
        "lengthChange": true
      });
    }).done(function () {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('click', '#tableBaseDatos tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".editDataBase").slideDown();
    $(".deleteDataBase").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableBaseDatos tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updateBaseDatos', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var ubicacion = $("#ubicacion").val();
    var ip = $("#ip").val();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/basedatos/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        nombre: nombre,
        ubicacion: ubicacion,
        ip: ip,
        _token: _token,
        _method: _method
      },
      success: function success(data) {
        $('.modal-backdrop ').css('display', 'none');
        $('#modal').modal('hide');
        $('.viewResult').html(data);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableBaseDatos').DataTable({
          "lengthChange": true
        });
        Swal.fire('Correcto!', 'El registro ha sido actualizado.', 'success');
      },
      error: function error(data) {
        printErrorMsg(data.responseJSON.errors);
      }
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteDataBase', function (event) {
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

        var _token = $("input[name=_token]").val();

        var _method = "DELETE";
        var url = currentURL + '/basedatos/' + id;
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
            $('.viewIndex #tableBaseDatos').DataTable({
              "lengthChange": true
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
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

/***/ "./resources/js/module_administrador/cat_campos_plantillas.js":
/*!********************************************************************!*\
  !*** ./resources/js/module_administrador/cat_campos_plantillas.js ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo modulo
   */

  $(document).on("click", ".newCamPla", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Nuevo Campo Plantilla');
    $('#action').removeClass('updateCamPla');
    $('#action').addClass('saveCamPla');
    var url = currentURL + '/cat_campos_plantillas/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para mostrar el formulario de edicion de un canal
   */

  $(document).on("click", ".editCamPla", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Editar Campo Plantilla');
    $('#action').removeClass('saveCamPla');
    $('#action').addClass('updateCamPla');
    var id = $("#idSeleccionado").val();
    var url = currentURL + "/cat_campos_plantillas/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
      $("#empresaAdd option").prop('selected', true);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveCamPla', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var empresa = $("#empresaAdd").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_campos_plantillas';
    $.post(url, {
      nombre: nombre,
      empresa: empresa,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewIndex #tableCamPla').DataTable({
        "lengthChange": true
      });
    }).done(function () {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para seleccionar un solo campo plantilla y deseleccionar los demas
   */

  $(document).on('click', '#tableCamPla tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".editCamPla").slideDown();
    $(".deleteCamPla").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableCamPla tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para cancelar la creacion/edicion del modulo
   */

  $(document).on("click", ".cancelCamPla", function (e) {
    $(".viewIndex").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updateCamPla', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var empresa = $("#empresaAdd").val();
    var id = $("#id").val();
    var _method = "PUT";

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_campos_plantillas/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        nombre: nombre,
        empresa: empresa,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableCamPla').DataTable({
          "lengthChange": true
        });
      }
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido actualizado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteCamPla', function (event) {
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

        var _token = $("input[name=_token]").val();

        var _method = "DELETE";
        var url = currentURL + '/cat_campos_plantillas/' + id;
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
            $('.viewIndex #tableCamPla').DataTable({
              "lengthChange": true
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Evento para mostrar las empresas de un campo plantilla
   * Nota: popover es un componente de bootstrap
   */

  $(document).on("click", ".pop", function (event) {
    $('[data-toggle="popover"]').popover({
      container: 'body',
      animation: true,
      html: true,
      placement: "right",
      trigger: 'focus'
    });
  });
  /**
   * Evento para quitar empresas
   */

  $(document).on("click", '.btnLeft', function (event) {
    var selectedItem = $("#empresaAdd option:selected");
    $("#empresa").append(selectedItem);
    $("#empresaAdd option").prop('selected', true);
    $("#empresa option").prop('selected', true);
  });
  /**
   * Evento para agregar empresas
   */

  $(document).on("click", '.btnRight', function (event) {
    var selectedItem = $("#empresa option:selected");
    $("#empresaAdd").append(selectedItem);
    $("#empresaAdd option").prop('selected', true);
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
    $('#tituloModal').html('Nuevo Estado Agente');
    $('#action').removeClass('updateEdoAge');
    $('#action').addClass('saveEdoAge');
    var url = currentURL + '/cat_agente/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para mostrar el formulario de edicion de un canal
   */

  $(document).on("click", ".editEdoAge", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Editar Estado Agente');
    $('#action').removeClass('saveEdoAge');
    $('#action').addClass('updateEdoAge');
    var id = $("#idSeleccionado").val();
    var url = currentURL + "/cat_agente/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
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
        "lengthChange": true
      });
    }).done(function () {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('click', '#tableEdoAge tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".editEdoAge").slideDown();
    $(".deleteEdoAge").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableEdoAge tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
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

    var _method = "PUT";
    var recibir_llamada = $('input:radio[name=recibir_llamada]:checked').val();
    var url = currentURL + '/cat_agente/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        nombre: nombre,
        descripcion: descripcion,
        recibir_llamada: recibir_llamada,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewIndex #tableEdoAge').DataTable({
          "lengthChange": true
        });
      }
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido actualizado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteEdoAge', function (event) {
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

        var url = currentURL + '/cat_agente/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewIndex #tableEdoAge').DataTable({
              "lengthChange": true
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
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
    $('#tituloModal').html('Nuevo Estado Cliente');
    $('#action').removeClass('updateEdoCli');
    $('#action').removeClass('saveOrderEdoCli');
    $('#action').addClass('saveEdoCli');
    var url = currentURL + '/cat_cliente/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para mostrar el formulario de edicion de un canal
   */

  $(document).on("click", ".editEdoCli", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Editar Estado Cliente');
    $('#action').removeClass('saveEdoCli');
    $('#action').removeClass('saveOrderEdoCli');
    $('#action').addClass('updateEdoCli');
    var id = $("#idSeleccionado").val();
    var url = currentURL + "/cat_cliente/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
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
    }).done(function () {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('click', '#tableEdoCli tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".editEdoCli").slideDown();
    $(".deleteEdoCli").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableEdoCli tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
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

    var _method = "PUT";
    var url = currentURL + '/cat_cliente/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        nombre: nombre,
        descripcion: descripcion,
        marcar: marcar,
        mostrar_agente: mostrar_agente,
        parametrizar: parametrizar,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableEdoCli').DataTable({
          "lengthChange": true,
          "order": [[5, "asc"]]
        });
      }
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido actualizado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteEdoCli', function (event) {
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

        var _token = $("input[name=_token]").val();

        var _method = "DELETE";
        var url = currentURL + '/cat_cliente/' + id;
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
            $('.viewIndex #tableEdoCli').DataTable({
              "lengthChange": true,
              "order": [[5, "asc"]]
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Evento para order las categorias
   */

  $(document).on('click', '.orderignEdoCli', function (e) {
    e.preventDefault();
    $('#tituloModal').html('Ordenar Estados');
    $('#action').removeClass('saveEdoCli');
    $('#action').removeClass('updateEdoCli');
    $('#action').addClass('saveOrderEdoCli');
    var url = currentURL + "/cat_cliente/ordering";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
      $("#sortable").sortable();
    });
  });
  /**
   * Evento para editar el menu
   */

  $(document).on('click', '.saveOrderEdoCli', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
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
        $('.viewIndex #tableEdoCli').DataTable({
          "lengthChange": true,
          "order": [[5, "asc"]]
        });
        Swal.fire('Muy bien!', 'Los modulos han sido ordenados.', 'success');
      }
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
    $('#tituloModal').html('Nuevo Estado Empresa');
    $('#action').removeClass('updateEdoEmp');
    $('#action').addClass('saveEdoEmp');
    var url = currentURL + '/cat_empresa/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para mostrar el formulario de edicion de un canal
   */

  $(document).on("click", ".editEdoEmp", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Editar Estado Empresa');
    $('#action').removeClass('saveEdoEmp');
    $('#action').addClass('updateEdoEmp');
    var id = $("#idSeleccionado").val();
    var url = currentURL + "/cat_empresa/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
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
        "lengthChange": true
      });
    }).done(function () {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('click', '#tableEdoEmp tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".editEdoEmp").slideDown();
    $(".deleteEdoEmp").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableEdoEmp tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
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
    var _method = "PUT";

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_empresa/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        nombre: nombre,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableEdoEmp').DataTable({
          "lengthChange": true
        });
      }
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido actualizado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteEdoEmp', function (event) {
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

        var _token = $("input[name=_token]").val();

        var _method = "DELETE";
        var url = currentURL + '/cat_empresa/' + id;
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
            $('.viewIndex #tableEdoEmp').DataTable({
              "lengthChange": true
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
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

/***/ "./resources/js/module_administrador/cat_extensiones.js":
/*!**************************************************************!*\
  !*** ./resources/js/module_administrador/cat_extensiones.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo modulo
   */

  $(document).on("click", ".newExtension", function (e) {
    e.preventDefault();
    $(".updateEmpresa").slideUp();
    $(".updateExtension").slideUp();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id_Empresa = $("#id_empresa").val();
    var url = currentURL + '/extensiones/create/' + id_Empresa;
    $.get(url, function (data, textStatus, jqXHR) {
      $("#formDataEmpresa").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveExtension', function (event) {
    event.preventDefault();
    var dataForm = $("#formDataEmpresa").serializeArray();
    var id = $("#id_empresa").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/extensiones';
    $.post(url, {
      dataForm: dataForm,
      _token: _token
    }, function (data, textStatus, xhr) {
      var url = currentURL + "/extensiones/" + id;
      $.get(url, function (data, textStatus, jqXHR) {
        $('#formDataEmpresa').html(data);
        $('#TableCatExts').DataTable({
          "lengthChange": true
        });
      });
    });
  });
  /**
   * Evento para habilitar la edicion de la extension seleccionado
   */

  $(document).on('click', '.editar_extension', function (event) {
    var id = $(this).val();
    /**
     * Habilitamos los inputs para editar
     */

    if ($(this).prop('checked')) {
      $("#canal_extension_" + id).prop("disabled", false);
      $("#licencia_extension_" + id).prop("disabled", false);
      $("#extension_" + id).prop("disabled", false);
      $("#delete_" + id).slideDown();
    } else {
      $("#canal_extension_" + id).prop("disabled", "disabled");
      $("#licencia_extension_" + id).prop("disabled", "disabled");
      $("#extension_" + id).prop("disabled", "disabled");
      $("#delete_" + id).slideUp();
    }
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteExtension', function (event) {
    event.preventDefault();
    var id = $(this).attr('id').replace('delete_', '');
    var idEmpresa = $("#id_empresa").val();

    var _token = $("input[name=_token]").val();

    var _method = "DELETE";
    var url = currentURL + '/extensiones/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        var url = currentURL + "/extensiones/" + idEmpresa;
        $.get(url, function (data, textStatus, jqXHR) {
          $('#formDataEmpresa').html(data);
          $('#TableCatExts').DataTable({
            "lengthChange": true
          });
        });
      }
    });
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updateExtension', function (event) {
    event.preventDefault();
    var dataForm = $("#formDataEmpresa").serializeArray();

    var _token = $("input[name=_token]").val();

    var id = $("#id_empresa").val();
    var _method = "PUT";
    var url = currentURL + '/extensiones/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        dataForm: dataForm,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        //$('#formDataEmpresa').html(result);
        var url = currentURL + "/extensiones/" + id;
        $.get(url, function (data, textStatus, jqXHR) {
          $('#formDataEmpresa').html(data);
          $('#TableCatExts').DataTable({
            "lengthChange": true
          });
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
    $('#tituloModal').html('Nuevo PBX');
    $('#action').removeClass('updatePbx');
    $('#action').addClass('savePbx');
    var url = currentURL + '/cat_ip_pbx/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para mostrar el formulario de edicion de un canal
   */

  $(document).on("click", ".editPbx", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Editar PBX');
    $('#action').removeClass('savePbx');
    $('#action').addClass('updatePbx');
    var id = $("#idSeleccionado").val();
    var url = currentURL + "/cat_ip_pbx/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.savePbx', function (event) {
    event.preventDefault();
    var media_server = $("#media_server").val();
    var ip_pbx = $("#ip_pbx").val();
    var basedatos = $("#basedatos").val();
    var arr = $('[name="nas[]"]:checked').map(function () {
      return this.value;
    }).get();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_ip_pbx';
    $.post(url, {
      media_server: media_server,
      basedatos: basedatos,
      ip_pbx: ip_pbx,
      arr: arr,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewIndex #tablePbx').DataTable({
        "lengthChange": true
      });
    }).done(function () {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('click', '#tablePbx tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".editPbx").slideDown();
    $(".deletePbx").slideDown();
    $("#idSeleccionado").val(id);
    $("#tablePbx tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updatePbx', function (event) {
    event.preventDefault();
    var media_server = $("#media_server").val();
    var ip_pbx = $("#ip_pbx").val();
    var basedatos = $("#basedatos").val();
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
        basedatos: basedatos,
        arr: arr,
        id: id,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewIndex #tablePbx').DataTable({
          "lengthChange": true
        });
      }
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deletePbx', function (event) {
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
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
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
    $('#tituloModal').html('Nueva NAS');
    $('#action').removeClass('updateNas');
    $('#action').addClass('saveNas');
    var url = currentURL + '/cat_nas/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
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
        "lengthChange": true
      });
    }).done(function () {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('click', '#tableNas tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".editNas").slideDown();
    $(".deleteNas").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableNas tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para mostrar el formulario de edicion de un canal
   */

  $(document).on("click", ".editNas", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Editar NAS');
    $('#action').removeClass('saveNas');
    $('#action').addClass('updateNas');
    var id = $("#idSeleccionado").val();
    var url = currentURL + "/cat_nas/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
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

    var _method = "PUT";
    var url = currentURL + '/cat_nas/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        nombre: nombre,
        ip_nas: ip_nas,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewIndex #tableNas').DataTable({
          "lengthChange": true
        });
      }
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteNas', function (event) {
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

        var _token = $("input[name=_token]").val();

        var _method = "DELETE";
        var url = currentURL + '/cat_nas/' + id;
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
            $('.viewIndex #tableNas').DataTable({
              "lengthChange": true
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
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

/***/ "./resources/js/module_administrador/cat_tipo_canal.js":
/*!*************************************************************!*\
  !*** ./resources/js/module_administrador/cat_tipo_canal.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo canal
   */

  $(document).on("click", ".newTipoCanal", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Nuevo Tipo Canal');
    $('#action').removeClass('updateTipoCanal');
    $('#action').addClass('saveTipoCanales');
    var url = currentURL + '/cat_tipo_canales/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para mostrar el formulario de edicion de un canal
   */

  $(document).on("click", ".editTipoCanal", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Editar Tipo Canal');
    $('#action').removeClass('saveTipoCanales');
    $('#action').addClass('updateTipoCanal');
    var id = $("#idSeleccionado").val();
    var url = currentURL + "/cat_tipo_canales/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveTipoCanales', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var prefijo = $("#prefijo").val();
    var distribuidor = $("#distribuidor").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/cat_tipo_canales';
    $.post(url, {
      nombre: nombre,
      prefijo: prefijo,
      distribuidor: distribuidor,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewIndex #tableTiposCanal').DataTable({
        "lengthChange": true
      });
    }).done(function () {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('click', '#tableTiposCanal tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".editTipoCanal").slideDown();
    $(".deleteTipoCanal").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableTiposCanal tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updateTipoCanal', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var prefijo = $("#prefijo").val();
    var distribuidor = $("#distribuidor").val();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var _method = 'PUT';
    var url = currentURL + '/cat_tipo_canales/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        nombre: nombre,
        prefijo: prefijo,
        distribuidor: distribuidor,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewIndex #tableTiposCanal').DataTable({
          "lengthChange": true
        });
      }
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido actualizado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteTipoCanal', function (event) {
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

        var _token = $("input[name=_token]").val();

        var _method = "DELETE";
        var url = currentURL + '/cat_tipo_canales/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewIndex #tableTiposCanal').DataTable({
              "lengthChange": true
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
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

  $(document).on("click", ".newDid", function (e) {
    e.preventDefault();
    $("#accionActualizar").slideUp();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id_Empresa = $("#id_empresa").val();
    var url = currentURL + '/did/create/' + id_Empresa;
    $.get(url, function (data, textStatus, jqXHR) {
      $('#formDataEmpresa').html(data);
    });
  });
  /**
   * Evento para guardar el nuevo did
   */

  $(document).on('click', '.saveDid', function (event) {
    event.preventDefault();
    var dataForm = $("#formDataEmpresa").serializeArray();
    var id = $("#id_empresa").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/did';
    $.post(url, {
      dataForm: dataForm,
      _token: _token
    }, function (data, textStatus, xhr) {
      var url = currentURL + "/did/" + id;
      $.get(url, function (data, textStatus, jqXHR) {
        $('#formDataEmpresa').html(data);
        $('#TableCatExts').DataTable({
          "lengthChange": true
        });
      });
    });
  });
  /**
   * Evento para mostrar el formulario editar distribuidores
   */

  /*$(document).on('dblclick', '#tableDid tbody tr', function(event) {
      event.preventDefault();
        $(".viewIndex").slideUp();
      $(".viewCreate").slideDown();
        let id = $(this).data("id");
      let url = currentURL + "/did/" + id + "/edit";
      $.get(url, function(data, textStatus, jqXHR) {
          $(".viewCreate").html(data);
        });
  });
  */

  /**
   * Evento para cancelar la creacion/edicion del distribuidores
   */

  $(document).on("click", ".cancelDid", function (e) {
    $(".viewIndex").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para habilitar la edicion de la extension seleccionado
   */

  $(document).on('click', '.editar_did', function (event) {
    var id = $(this).val();
    /**
     * Habilitamos los inputs para editar
     */

    if ($(this).prop('checked')) {
      $(".did_edi_" + id).prop("disabled", false);
    } else {
      $(".did_edi_" + id).prop("disabled", "disabled");
    }
  });
  /**
   * Evento para editar el distribuidores
   */

  $(document).on('click', '.updateDid', function (event) {
    event.preventDefault(); // Datos obtenidos del formulario

    var dataForm = $("#formDataEmpresa").serializeArray();
    var id = $("#id_empresa").val();

    var _token = $("input[name=_token]").val();

    var _method = 'PUT';
    var url = currentURL + '/did/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        dataForm: dataForm,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        url = currentURL + '/did/' + id;
        $.ajax({
          url: url,
          type: 'GET',
          data: {
            _token: _token
          },
          success: function success(result) {
            $('#formDataEmpresa').html(result);
            $('#TableCatExts').DataTable({
              "lengthChange": true
            });
          }
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

  $(document).on("click", ".newDistribuidor", function (e) {
    event.preventDefault();
    $('#tituloModal').html('Nuevo Distribuidor');
    $('#action').removeClass('updateDistribuidor');
    $('#action').addClass('saveDistribuidor');
    var url = currentURL + "/distribuidor/create";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
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
      type: "POST",
      //dataType: "JSON",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      $('.viewResult').html(data);
      $('.viewResult #tableDistribuidores').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para mostrar el formulario editar distribuidores
   */

  $(document).on('click', '#tableDistribuidores tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".editDistribuidor").slideDown();
    $(".deleteDistribuidor").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableDistribuidores tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para mostrar el formulario de edicion de un canal
   */

  $(document).on("click", ".editDistribuidor", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Editar Distribuidor');
    $('#action').removeClass('saveDistribuidor');
    $('#action').addClass('updateDistribuidor');
    var id = $("#idSeleccionado").val();
    var url = currentURL + "/distribuidor/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
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
      //dataType: "JSON",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    }).done(function (data) {
      $('#modal').modal('hide');
      $('.modal-backdrop ').css('display', 'none');
      $('.viewResult').html(data);
      $('.viewResult #tableDistribuidores').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar el distribuidores
   *
   */

  $(document).on('click', '.deleteDistribuidor', function (event) {
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

        var url = currentURL + '/distribuidor/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableDistribuidores').DataTable({
              "lengthChange": false
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
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

/***/ "./resources/js/module_administrador/empresas.js":
/*!*******************************************************!*\
  !*** ./resources/js/module_administrador/empresas.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo modulo
   */

  $(document).on("click", ".newEmpresa", function (e) {
    e.preventDefault();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    /**
     * Seteamos el valor inicioa para la opcion siguiente y anterior
     */

    opcionSiguiente = 0;
    opcionAnterior = -1;
    regresos = 0;
    var url = currentURL + '/empresas/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
      var dato = 0 + ".dataEmpresa";
      var url = currentURL + '/empresas/' + dato;
      $.ajax({
        url: url,
        type: 'GET',
        success: function success(result) {
          $('#formDataEmpresa').html(result);
        }
      });
    });
  });
  /**
   * Declaramos las opciones para la creacion de una nueva cuenta
   */

  var opciones = ['dataEmpresa', 'dataInfra', 'dataModulo', 'dataPosiciones', 'dataAlmacenamiento', 'dataCanales', 'dataExtensiones', 'dataDids'];
  /**
   * Evento para guardar la nueva empresa
   */

  $(document).on('click', '#siguiente', function (event) {
    event.preventDefault();
    $('#anterior').slideDown();
    $('.cancelEmpresa').slideUp();
    /**
     * Recuperamos la accion a relizar y la opcion a relaizar
     */

    var accion = $(this).attr("data-accion");
    var opcion = $(this).attr("data-opcion-siguiente");
    /**
     * Se setea a crear si viene de un accion de actualizar
     */

    if (regresos > 1) {
      $(this).attr("data-accion", "actualizar");
      regresos--;
    } else {
      $(this).attr("data-accion", "crear");
      regresos = 0;
    }
    /**
     * Si aun es menor al tamaño del arreglo seguimos
     * incrementando.
     */


    if (opcionSiguiente < opciones.length) {
      opcionAnterior = opcionAnterior + 1;
      opcionSiguiente = opcionSiguiente + 1;
    }
    /**
     * Cuando lleguemos al final del arreglo ponermos
     * el boton con la leyenda de finalizar
     */


    if (opcionSiguiente == 7) {
      $('#siguiente').html('Finalizar');
    }
    /**
     * Seteamos el valor de la siguiente opcion y anterior
     */


    $('#anterior').attr('data-opcion-anterior', opciones[opcionAnterior]);
    $('#siguiente').attr('data-opcion-siguiente', opciones[opcionSiguiente]);
    /**
     * Dependiendo de la accion a realizar, se define
     * la URL y metodo que se usara
     */

    if (accion.indexOf("actualizar") > -1) {
      var id = $("#id_empresa").val(); //Recuperamos el id de la empresa ha editar

      url = currentURL + '/empresas/' + id; //Definimos la url de edicion

      method = "POST";
      _method = "PUT";
    } else {
      url = currentURL + '/empresas'; //Definimos la URL para crear

      method = "POST";
      _method = "POST";
    }
    /**
     * Recuperamos la informacion del formulario
     */


    var dataForm = $("#formDataEmpresa").serializeArray();

    var _token = $("input[name=_token]").val();
    /**
     * Enviamos la informacion
     */


    $.ajax({
      url: url,
      type: method,
      data: {
        _token: _token,
        _method: _method,
        dataForm: dataForm,
        accion: accion
      },
      success: function success(result) {
        if (opcion == 'dataDids') {
          $('.viewResult').html(result);
        } else {
          $('#formDataEmpresa').html(result);
          $("#formDataEmpresa .saveExtension").slideUp();
          $("#formDataEmpresa .saveDid").slideUp();
          $("#formDataEmpresa .saveCanal").slideUp();
        }
      }
    });
  });
  /**
   * Evento para regresar a la opcion anterior
   */

  $(document).on('click', '#anterior', function (event) {
    event.preventDefault();
    /**
     * Recuperamos la accion a relizar y la opcion a relaizar
     */

    var accion = $(this).attr("data-accion");
    var opcion = $(this).attr("data-opcion-anterior");
    $('#siguiente').attr("data-accion", "actualizar");
    /**
     * Seteamos el valor de la siguiente opcion y anterior
     */

    if (opcionSiguiente == 7) {
      $('#siguiente').html('Siguiente');
    }

    if (opcionAnterior == 0) {
      $('#anterior').slideUp();
    }

    if (opcionSiguiente > 0) {
      regresos++;
      opcionAnterior = opcionAnterior - 1;
      opcionSiguiente = opcionSiguiente - 1;
    }

    $('#anterior').attr('data-opcion-anterior', opciones[opcionAnterior]);
    $('#siguiente').attr('data-opcion-siguiente', opciones[opcionSiguiente]);
    var id = $("#id_empresa").val();

    var _token = $("input[name=_token]").val();

    var dato = id + "." + opcion;

    if (opcion == 'dataExtensiones') {
      url = currentURL + '/extensiones/' + id;
    } else if (opcion == 'dataCanales') {
      url = currentURL + '/canales/' + id;
    } else if (opcion == 'dataDids') {
      url = currentURL + '/did/' + id;
    } else {
      url = currentURL + '/empresas/' + dato;
    }

    $.ajax({
      url: url,
      type: 'GET',
      data: {
        _token: _token,
        accion: accion
      },
      success: function success(result) {
        $('#formDataEmpresa').html(result);
      }
    });
  });
  /**
   * Evento para mostrar el formulario editar empresa
   */

  $(document).on('dblclick', '#tableEmpresas tbody tr', function (event) {
    event.preventDefault();
    $(".newEmpresa").slideUp();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id = $(this).data("id");
    var url = currentURL + "/empresas/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewCreate").html(data);
      var dato = id + ".dataGeneral";
      var url = currentURL + '/empresas/' + dato;
      $.ajax({
        url: url,
        type: 'GET',
        success: function success(result) {
          $('#formDataEmpresa').html(result);
        }
      });
    });
  });
  /**
   * Evento para cancelar la creacion/edicion del modulo
   */

  $(document).on("click", ".cancelEmpresa", function (e) {
    $(".newEmpresa").slideDown();
    $(".viewIndex").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updateEmpresa', function (event) {
    event.preventDefault();
    var dataForm = $("#formDataEmpresa").serializeArray();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/empresas/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        dataForm: dataForm,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        var url = currentURL + "/empresas/" + id + "/edit";
        $.get(url, function (data, textStatus, jqXHR) {
          $(".viewCreate").html(data);
          var dato = id + ".dataGeneral";
          var url = currentURL + '/empresas/' + dato;
          $.ajax({
            url: url,
            type: 'GET',
            success: function success(result) {
              $('#formDataEmpresa').html(result);
            }
          });
        });
      }
    });
  });
  /**
   * Evento para obtener la opcion ha mostrar de el menu
   */

  $(document).on('click', '.menuEmpresa > li', function (event) {
    $('.menuEmpresa > li').removeClass('active');
    $(this).addClass('active');
    var id = $("#id").val();
    var opcion = $(this).data("opcion");

    var _token = $("input[name=_token]").val();

    var dato = id + "." + opcion;
    $("#accionActualizar").removeClass('updateExtension updateCanal updateEmpresa updateDid updatePrefijos');

    if (opcion == 'dataGeneral') {
      $('.updateEmpresa').slideUp();
      url = currentURL + '/empresas/' + dato;
    } else if (opcion == 'dataExtensiones') {
      url = currentURL + '/extensiones/' + id;
      $("#accionActualizar").addClass('updateExtension');
      $('#accionActualizar').slideDown();
    } else if (opcion == 'dataCanales') {
      url = currentURL + '/canales/' + id;
      $("#accionActualizar").addClass('updateCanal');
      $('#accionActualizar').slideDown();
    } else if (opcion == 'dataDids') {
      url = currentURL + '/did/' + id;
      $("#accionActualizar").addClass('updateDid');
      $('#accionActualizar').slideDown();
    } else if (opcion == 'dataPrefijos') {
      url = currentURL + '/prefijos_marcacion/' + id;
      $("#accionActualizar").addClass('updatePrefijos');
      $('#accionActualizar').slideDown();
    } else {
      url = currentURL + '/empresas/' + dato;
      $("#accionActualizar").addClass('updateEmpresa');
      $('#accionActualizar').slideDown();
    }

    $.ajax({
      url: url,
      type: 'GET',
      data: {
        _token: _token
      },
      success: function success(result) {
        $('#formDataEmpresa').html(result);
        $('#TableCatExts').DataTable({
          "lengthChange": true
        });
      }
    });
  });
  /**
   * Evento para eliminar una categoria
   */

  $(document).on('click', '.deleteEmpresa', function (event) {
    event.preventDefault();
    var id = $("#id").val();

    var _token = $("input[name=_token]").val();

    var _method = "DELETE";
    var url = currentURL + '/empresas/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('#tableEmpresas').DataTable({
          "lengthChange": true
        });
      }
    });
  });
  /**
   * Evento para seleccionar los modulos
   */

  $(document).on('click', '.modulosEmpresa', function () {
    var id = $(this).val();

    if ($(this).prop('checked')) {
      if (id == 1) {
        $("#modulo_3").prop("checked", true);
        $("#modulo_4").prop("checked", true);
        $("#modulo_5").prop("checked", true);
        $("#modulo_6").prop("checked", true);
        $("#modulo_9").prop("checked", true);
        $("#modulo_11").prop("checked", true);
        $("#modulo_17").prop("checked", true);
      } else if (id == 2) {
        $("#modulo_3").prop("checked", true);
        $("#modulo_4").prop("checked", true);
        $("#modulo_6").prop("checked", true);
        $("#modulo_9").prop("checked", true);
        $("#modulo_17").prop("checked", true);
      }
    } else {
      if (id == 1) {
        $("#modulo_3").prop("checked", false);
        $("#modulo_4").prop("checked", false);
        $("#modulo_5").prop("checked", false);
        $("#modulo_6").prop("checked", false);
        $("#modulo_9").prop("checked", false);
        $("#modulo_11").prop("checked", false);
        $("#modulo_17").prop("checked", false);
      } else if (id == 2) {
        $("#modulo_3").prop("checked", false);
        $("#modulo_4").prop("checked", false);
        $("#modulo_6").prop("checked", false);
        $("#modulo_9").prop("checked", false);
        $("#modulo_17").prop("checked", false);
      }
    }
  });
  /**
   * Evento para abrir una sesion para entrar a la cuenta del cliente seleccionado
   */

  $(document).on('click', '.linkEmpresa', function () {
    var id_empresa = $(this).attr("data-id_empresa");
    var dominio = $("#dominio_empresa").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/empresas/generar_sesion/' + id_empresa;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: _token,
        id_empresa: id_empresa
      },
      success: function success(result) {
        var tab = window.open(dominio + '/soporte/' + result, '_blank');

        if (tab) {
          tab.focus(); //ir a la pestaña
        } else {
          alert('Pestañas bloqueadas, activa las ventanas emergentes (Popups) ');
          return false;
        }
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/module_administrador/licenciasBria.js":
/*!************************************************************!*\
  !*** ./resources/js/module_administrador/licenciasBria.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo modulo
   */

  $(document).on("click", ".newLicencia", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Nueva Licencia');
    var url = currentURL + '/licencias_bria/create';
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(result) {
        $('#modal').modal('show');
        $("#modal-body").html(result);
      }
    });
    /*
    $.get(url, function(data, textStatus, jqXHR) {
        $('#modal').modal('show');
        $("#modal-body").html(data);
    });
    */
  });
  /**
   * Evento para cancelar la creacion/edicion de una licencia
   */

  $(document).on("click", ".cancelLicencia", function (e) {
    $(".viewIndex").slideDown();
    $(".viewCreate").slideUp();
    $(".viewCreate").html('');
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveLicencia', function (event) {
    event.preventDefault();
    var licencia = $("#licencia").val();
    var disponibles = $("#disponibles").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/licencias_bria';
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        licencia: licencia,
        disponibles: disponibles,
        _token: _token
      },
      beforeSend: function beforeSend() {
        // Handle the beforeSend event
        $("#cargando").fadeIn();
      },
      complete: function complete(result) {
        $("#cargando").fadeOut();
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewIndex #licencias_bria').DataTable({
          "lengthChange": true
        });
      }
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para mostrar las empresas de una licencia
   * Nota: popover es un componente de bootstrap
   */

  $(document).on("click", ".pop", function (event) {
    $('[data-toggle="popover"]').popover({
      container: 'body',
      animation: true,
      html: true,
      placement: "right",
      trigger: 'focus'
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

/***/ "./resources/js/module_administrador/menu.js":
/*!***************************************************!*\
  !*** ./resources/js/module_administrador/menu.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  /**
   * Evento para el menu de sub categorias y mostrar la vista
   */
  $(document).on("click", ".sub-menu", function (e) {
    e.preventDefault();
    var currentURL = window.location.href;
    var id = $(this).data("id");

    if (id == 'sub-6') {
      url = currentURL + '/usuarios';
      table = ' #tableUsuarios';
    } else if (id == 'sub-4') {
      url = currentURL + '/menus';
      table = '#tableMenus';
    } else if (id == 'sub-3') {
      url = currentURL + '/modulos';
      table = ' #tableModulos';
    } else if (id == 'sub-1') {
      url = currentURL + '/distribuidor';
      table = ' #tableDistribuidores';
    } else if (id == 'sub-8') {
      url = currentURL + '/did';
      table = ' #tableDid';
    } else if (id == 'sub-10') {
      url = currentURL + '/cat_empresa';
      table = ' #tableEdoEmp';
    } else if (id == 'sub-11') {
      url = currentURL + '/cat_ip_pbx';
      table = ' #tablePbx';
    } else if (id == 'sub-12') {
      url = currentURL + '/cat_nas';
      table = ' #tableNas';
    } else if (id == 'sub-13') {
      url = currentURL + '/cat_agente';
      table = ' #tableEdoAge';
    } else if (id == 'sub-14') {
      url = currentURL + '/cat_cliente';
      table = ' #tableEdoCli';
    } else if (id == 'sub-9') {
      url = currentURL + '/troncales';
      table = ' #tableTroncales';
    } else if (id == 'sub-15') {
      url = currentURL + '/canales';
      table = ' #tableCanales';
    } else if (id == 'sub-2') {
      url = currentURL + '/empresas';
      table = ' #tableEmpresas';
    } else if (id == 'sub-16') {
      url = currentURL + '/basedatos';
      table = ' #tableBaseDatos';
    } else if (id == 'sub-17') {
      url = currentURL + '/cat_tipo_canales';
      table = ' #tableTiposCanal';
    } else if (id == 'sub-19') {
      url = currentURL + '/licencias_bria';
      table = ' #licencias_bria';
    } else if (id == 'sub-20') {
      url = currentURL + '/logs';
      table = '#tableLogs';
    } else if (id == 'sub-21') {
      url = currentURL + '/formularios';
      table = ' #tableFormularios';
    } else if (id == 'sub-5') {
      url = currentURL + '/smtp';
      table = ' #tableSmtp';
    } else if (id == 'sub-41') {
      url = currentURL + '/cat_campos_plantillas';
      table = ' #tableCamPla';
    }

    $.get(url, function (data, textStatus, jqXHR) {
      $(".viewResult").html(data);

      if (id != 4 || id != 20) {
        $('.viewResult' + table).DataTable({
          "lengthChange": true
        });
      }
    });
  });
});
'sub-';

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
   * Evento para crear una nueva categoria
   */

  $(document).on("click", ".newMenu", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Nuevo Menu / Sub Menu');
    $('#action').removeClass('updateMenu');
    $('#action').removeClass('saveOrderMenu');
    $('#action').addClass('saveMenu');
    var url = currentURL + '/menus/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para saber que tipo de menu se dara de alta
   */

  $(document).on("change", "#tipo_id", function (e) {
    var tipo = $(this).val();

    if (tipo == 2) {
      $(".selectModulo").slideUp();
      $(".selectMenu").slideDown();
    } else {
      $(".selectMenu").slideUp();
      $(".selectModulo").slideDown();
    }
  });
  /**
   * Evento para guardar la nueva categoria
   */

  $(document).on('click', '.saveMenu', function (event) {
    event.preventDefault();
    var tipo_id = $("#tipo_id").val();
    var modulo_id = $("#modulo_id").val();
    var menu_id = $("#menu_id").val();
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();
    var nivel_id = $("#nivel_id").val();

    var _token = $("input[name=_token]").val();
    /**
     * Si tipo_id es igual uno se manda la informacion para crear un menu
     * Si no se manda la informacion para crear un sub menu
     */


    if (tipo_id == 1) {
      url = currentURL + '/menus';
      $.post(url, {
        nombre: nombre,
        descripcion: descripcion,
        tipo: nivel_id,
        modulos_id: modulo_id,
        _token: _token
      }, function (data, textStatus, xhr) {
        $('.viewResult').html(data);
      }).done(function () {
        $('.modal-backdrop ').css('display', 'none');
        $('#modal').modal('hide');
        Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
      }).fail(function (data) {
        printErrorMsg(data.responseJSON.errors);
      });
    } else {
      url = currentURL + '/submenus';
      $.post(url, {
        nombre: nombre,
        descripcion: descripcion,
        tipo: nivel_id,
        id_categoria: menu_id,
        _token: _token
      }, function (data, textStatus, xhr) {
        $('.viewResult').html(data);
      }).done(function () {
        $('.modal-backdrop ').css('display', 'none');
        $('#modal').modal('hide');
        Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
      }).fail(function (data) {
        printErrorMsg(data.responseJSON.errors);
      });
    }
  });
  /**
   * Evento para editar una categoria o sub categoria
   */

  $(document).on("click", ".editMenu", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Editar Menu / Sub Menu');
    $('#action').removeClass('saveMenu');
    $('#action').removeClass('saveOrderMenu');
    $('#action').addClass('updateMenu');
    var id = $("#idSeleccionado").val();
    var tipo = $("#tipoSeleccionado").val();

    if (tipo == 1) {
      url = currentURL + "/menus/" + id + "/edit";
    } else {
      url = currentURL + "/submenus/" + id + "/edit";
    }

    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para editar el menu
   */

  $(document).on('click', '.updateMenu', function (event) {
    event.preventDefault();
    var tipo = $("#tipoSeleccionado").val();

    if (tipo == 1) {
      var nombre = $("#nombre").val();
      var id = $("#id_categoria").val();
      var descripcion = $("#descripcion").val();

      var _tipo = $("#tipo").val();

      var _token = $("input[name=_token]").val();

      var _method = $("input[name=_method]").val();

      var permi = $("#id_permiso").val();
      url = currentURL + "/menus/" + id;
      $.ajax({
        url: url,
        type: 'POST',
        data: {
          nombre: nombre,
          descripcion: descripcion,
          tipo: _tipo,
          _token: _token,
          _method: _method,
          permi: permi
        },
        success: function success(result) {
          $('.viewResult').html(result);
        }
      }).done(function (data) {
        $('.modal-backdrop ').css('display', 'none');
        $('#modal').modal('hide');
        Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
      }).fail(function (data) {
        printErrorMsg(data.responseJSON.errors);
      });
    } else {
      var _nombre = $("#nombre").val();

      var _id = $("#id_subCate").val();

      var _descripcion = $("#descripcion").val();

      var _tipo2 = $("#tipo").val();

      var _token2 = $("input[name=_token]").val();

      var _method2 = $("input[name=_method]").val();

      var _permi = $("#id_permiso").val();

      url = currentURL + "/submenus/" + _id;
      $.ajax({
        url: url,
        type: 'POST',
        data: {
          nombre: _nombre,
          descripcion: _descripcion,
          tipo: _tipo2,
          _token: _token2,
          _method: _method2,
          permi: _permi
        },
        success: function success(result) {
          $('.viewResult').html(result);
        }
      }).done(function (data) {
        $('.modal-backdrop ').css('display', 'none');
        $('#modal').modal('hide');
        Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
      }).fail(function (data) {
        printErrorMsg(data.responseJSON.errors);
      });
    }
  });
  /**
   * Evento para eliminar una categoria
   */

  $(document).on('click', '.deleteMenu', function (event) {
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
        var tipo = $("#tipoSeleccionado").val();
        var id = $("#idSeleccionado").val();

        var _token = $("input[name=_token]").val();

        var _method = "DELETE";

        if (tipo == 1) {
          url = currentURL + '/menus/' + id;
        } else {
          url = currentURL + '/submenus/' + id;
        }

        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Evento para order las categorias
   */

  $(document).on('click', '.orderignCat', function (e) {
    e.preventDefault();
    $('#tituloModal').html('Ordenar Menu / Sub Menu');
    $('#action').removeClass('saveMenu');
    $('#action').removeClass('updateMenu');
    $('#action').addClass('saveOrderMenu');
    var orden = $("#ordenSeleccionado").val();
    var id = $("#idSeleccionado").val();

    if (orden == 0) {
      url = currentURL + "/menus/ordering";
    } else {
      url = currentURL + "/submenus/ordering/" + id;
    }

    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
      $("#sortable").sortable();
    });
  });
  /**
   * Evento para editar el menu
   */

  $(document).on('click', '.saveOrderMenu', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
    var ordenElementos = $("#sortable").sortable("toArray").toString();

    var _token = $("input[name=_token]").val();

    var orden = $("#ordenSeleccionado").val();
    var id = $("#idSeleccionado").val();

    if (orden == 0) {
      url = currentURL + "/menus/updateOrdering";
      $.ajax({
        url: url,
        type: 'POST',
        data: {
          ordenElementos: ordenElementos,
          _token: _token
        },
        success: function success(result) {
          $('.viewResult').html(result);
          Swal.fire('Muy bien!', 'Ha sido ordenado el menu.', 'success');
        }
      });
    } else {
      url = currentURL + "/submenus/updateOrdering";
      $.ajax({
        url: url,
        type: 'POST',
        data: {
          ordenElementos: ordenElementos,
          id_categoria: id,
          _token: _token
        },
        success: function success(result) {
          $('.viewResult').html(result);
          Swal.fire('Muy bien!', 'Ha sido ordenado el sub menu.', 'success');
        }
      });
    }
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
    $('#tituloModal').html('Nuevo Modulo');
    $('#action').removeClass('saveOrderModulo');
    $('#action').removeClass('updateModulo');
    $('#action').addClass('saveModulo');
    var url = currentURL + '/modulos/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
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
      $('.viewResult').html(data);
      $('.viewResult #tableModulos').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
    }).done(function () {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('click', '#tableModulos tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".editModule").slideDown();
    $(".deleteModule").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableModulos tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para mostrar el formulario de edicion de un canal
   */

  $(document).on("click", ".editModule", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Editar Modulo');
    $('#action').removeClass('saveModulo');
    $('#action').removeClass('saveOrderModulo');
    $('#action').addClass('updateModulo');
    var id = $("#idSeleccionado").val();
    var url = currentURL + "/modulos/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updateModulo', function (event) {
    event.preventDefault();
    var nombre = $("#nombreEdit").val();
    var descripcion = $("#descripcionEdit").val();
    var id_modulo = $("#id_modulo").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/modulos/' + id_modulo;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        nombre: nombre,
        descripcion: descripcion,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewResult #tableModulos').DataTable({
          "lengthChange": true,
          "order": [[2, "asc"]]
        });
      }
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteModule', function (event) {
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

        var _token = $("input[name=_token]").val();

        var _method = "DELETE";
        var url = currentURL + '/modulos/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableModulos').DataTable({
              "lengthChange": true,
              "order": [[2, "asc"]]
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Evento para order las categorias
   */

  $(document).on('click', '.orderignModule', function (e) {
    e.preventDefault();
    $('#tituloModal').html('Ordenar Modulo');
    $('#action').removeClass('saveModulo');
    $('#action').removeClass('updateModulo');
    $('#action').addClass('saveOrderModulo');
    var url = currentURL + "/modulos/ordering";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
      $("#sortable").sortable();
    });
  });
  /**
   * Evento para editar el menu
   */

  $(document).on('click', '.saveOrderModulo', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
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
        Swal.fire('Muy bien!', 'Los modulos han sido ordenados.', 'success');
      }
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

/***/ "./resources/js/module_administrador/prefijos_marcacion.js":
/*!*****************************************************************!*\
  !*** ./resources/js/module_administrador/prefijos_marcacion.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear una nueva plantilla
   */

  $(document).on("click", ".newPrefijoMarcacion", function (e) {
    e.preventDefault();
    $("#accionActualizar").slideUp();
    $(".viewIndex").slideUp();
    $(".viewCreate").slideDown();
    var id_empresa = $("#id_empresa").val();
    var url = currentURL + '/prefijos_marcacion/create/' + id_empresa;
    $.get(url, function (data, textStatus, jqXHR) {
      $('#formDataEmpresa').html(data);
    });
  });
  /**
   * Evento para guardar el nuevo Prefijo de Marcacion
   */

  $(document).on('click', '.savePrefijoMarcacion', function (event) {
    event.preventDefault(); //let dataForm = $("#formDataEmpresa").serializeArray();

    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();
    var prefijo = $("#prefijo").val();
    var prefijoNuevo = $("#prefijoNuevo").val();
    var id = $("#id_empresa").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/prefijos_marcacion';
    $.post(url, {
      id: id,
      nombre: nombre,
      descripcion: descripcion,
      prefijo: prefijo,
      prefijoNuevo: prefijoNuevo,
      _token: _token
    }, function (data, textStatus, xhr) {
      var url = currentURL + "/prefijos_marcacion/" + id;
      $.get(url, function (data, textStatus, jqXHR) {
        $('#formDataEmpresa').html(data);
        $('#tablePrefijosMarcacion').DataTable({
          "lengthChange": true
        });
      });
    });
  });
  /**
   * Evento para habilitar la edicion del prefijo seleccionado
   */

  $(document).on('click', '.editar_prefijo', function (event) {
    var id = $(this).val();
    /**
     * Habilitamos los inputs para editar
     */

    if ($(this).prop('checked')) {
      $("#nombre_" + id).prop("disabled", false);
      $("#descripcion_" + id).prop("disabled", false);
      $("#prefijo_" + id).prop("disabled", false);
      $("#prefijoNuevo_" + id).prop("disabled", false);
      $("#delete_" + id).slideDown();
      $("#accionActualizar").slideDown();
    } else {
      $("#nombre_" + id).prop("disabled", true);
      $("#descripcion_" + id).prop("disabled", true);
      $("#prefijo_" + id).prop("disabled", true);
      $("#prefijoNuevo_" + id).prop("disabled", true);
      $("#delete_" + id).slideUp();
      $("#accionActualizar").slideUp();
    }
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updatePrefijos', function (event) {
    event.preventDefault();
    var dataForm = $("#formDataEmpresa").serializeArray();

    var _token = $("input[name=_token]").val();

    var id = $("#id_empresa").val();
    var _method = "PUT";
    var url = currentURL + '/prefijos_marcacion/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        dataForm: dataForm,
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        var url = currentURL + "/prefijos_marcacion/" + id;
        $.get(url, function (data, textStatus, jqXHR) {
          $('#formDataEmpresa').html(data);
          $('#tablePrefijosMarcacion').DataTable({
            "lengthChange": true
          });
        });
      }
    });
  });
  /**
   * Evento para eliminar el prefijo
   */

  $(document).on('click', '.deletePrefijo', function (event) {
    event.preventDefault();
    var id = $(this).attr('id').replace('delete_', '');

    var _token = $("input[name=_token]").val();

    var _method = "DELETE";
    var url = currentURL + '/prefijos_marcacion/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        var id = $("#id_empresa").val();
        var url = currentURL + "/prefijos_marcacion/" + id;
        $.get(url, function (data, textStatus, jqXHR) {
          $('#formDataEmpresa').html(data);
          $('#tablePrefijosMarcacion').DataTable({
            "lengthChange": true
          });
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
   * Evento para mostrar el formulario de edicion de sub menu
   */

  $(document).on('click', '#tableSubMenus tbody tr', function (e) {
    e.preventDefault();
    $("#tableMenus tbody tr").removeClass('table-primary'); //Quitamos la clase de seleccion

    $("#tableSubMenus tbody tr").removeClass('table-primary'); //Quitamos la clase de seleccion

    $(this).addClass('table-primary'); //Agregamos la clase de seleccion al tr

    var id = $(this).data("id");
    $("#idSeleccionado").val(id); //Asignamos el valor del id, del elemento seleccionado

    $("#tipoSeleccionado").val(2); //Asignamos el valor del id, del elemento seleccionado
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

    var _method = "DELETE";
    var url = currentURL + '/submenus/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        id_categoria: id_categoria,
        _token: _token,
        _method: _method
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
    $('#tituloModal').html('Nueva Troncal');
    $('#action').removeClass('updateTrocal');
    $('#action').removeClass('updateTrocalSansay');
    $('#action').addClass('saveTroncal');
    var url = currentURL + '/troncales/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveTroncal', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();
    var ip_host = $("#ip_host").val();
    var mediaserver = $("#mediaserver").val();
    var distribuidores = $("#distribuidores").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/troncales';
    $.post(url, {
      nombre: nombre,
      descripcion: descripcion,
      mediaserver: mediaserver,
      ip_host: ip_host,
      distribuidores: distribuidores,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewIndex #tableTroncales').DataTable({
        "lengthChange": true
      });
    }).done(function () {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para mostrar el formulario editar modulo
   */

  $(document).on('click', '#tableTroncales tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".editTroncal").slideDown();
    $(".deleteTroncal").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableTroncales tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para mostrar el formulario de edicion de un canal
   */

  $(document).on("click", ".editTroncal", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Editar Troncal');
    $('#action').removeClass('saveTroncal');
    $('#action').removeClass('updateTrocalSansay');
    $('#action').addClass('updateTrocal');
    var id = $("#idSeleccionado").val();
    var url = currentURL + "/troncales/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updateTrocal', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();
    var ip_host = $("#ip_host").val();
    var mediaserver = $("#mediaserver").val();
    var distribuidores = $("#distribuidores").val();

    var _token = $("input[name=_token]").val();

    var id = $("#idSeleccionado").val();
    var _method = "PUT";
    var url = currentURL + '/troncales/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        nombre: nombre,
        descripcion: descripcion,
        ip_host: ip_host,
        mediaserver: mediaserver,
        distribuidores: distribuidores,
        id: id,
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
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar el modulo
   */

  $(document).on('click', '.deleteTroncal', function (event) {
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
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
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

  $(document).on('click', '.viewConfig', function (event) {
    var id = $(this).val();
    var url = currentURL + '/troncales/' + id;
    $('#action').removeClass('saveTroncal');
    $('#action').removeClass('updateTrocal');
    $('#action').addClass('updateTrocalSansay');
    $('#tituloModal').html('Configuración Troncal');
    $.get(url, function (data, textStatus, xhr) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para editar el modulo
   */

  $(document).on('click', '.updateTrocalSansay', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
    var id = $("#id_sansay").val();
    var host = $("#host").val();
    var dtmfmode = $("#dtmfmode").val();
    var allow = $("#allow").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/troncales/sansay/' + id;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        id: id,
        host: host,
        dtmfmode: dtmfmode,
        allow: allow,
        _token: _token
      },
      success: function success(result) {
        $('.viewResult').html(result);
        $('.viewCreate').slideUp();
        $('.viewIndex #tableTroncales').DataTable({
          "lengthChange": true
        });
        Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
      }
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

/***/ "./resources/js/module_administrador/usuarios.js":
/*!*******************************************************!*\
  !*** ./resources/js/module_administrador/usuarios.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para ver el formulario de nuevo usuario
   */

  $(document).on("click", ".newUser", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Nuevo Usuario');
    $('#action').removeClass('updateClient');
    $('#action').addClass('saveClient');
    var url = currentURL + '/usuarios/create';
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal({
        show: true,
        keyboard: false
      });
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo usuario
   */

  $(document).on("click", '.saveClient', function (event) {
    event.preventDefault();
    var name = $("#name").val();
    var email = $("#email").val();
    var pass_1 = $("#pass_1").val();
    var cliente = $("#cliente").val();
    var rol = $("#rol").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/usuarios';
    var arr = $('[name="permisos[]"]:checked').map(function () {
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
      $('.viewResult #tableUsuarios').DataTable({
        "lengthChange": true
      });
    }).done(function () {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para editar un usuario
   */

  $(document).on('click', '#tableUsuarios tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".editUser").slideDown();
    $(".deleteUser").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableUsuarios tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para mostrar el formulario de edicion de un canal
   */

  $(document).on("click", ".editUser", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Editar Usuarios');
    $('#action').removeClass('saveClient');
    $('#action').addClass('updateClient');
    var id = $("#idSeleccionado").val();
    var url = currentURL + "/usuarios/" + id + "/edit";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para editar el usuario
   */

  $(document).on('click', '.updateClient', function (event) {
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
    var arr = $('[name="permisos[]"]:checked').map(function () {
      return this.value;
    }).get();
    $.ajax({
      url: url,
      type: 'POST',
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
        $('.viewResult #tableUsuarios').DataTable({
          "lengthChange": true
        });
      }
    }).done(function (data) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar el  usuario
   */

  $(document).on('click', '.deleteUser', function (event) {
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

        var _token = $("input[name=_token]").val();

        var _method = "DELETE";
        var url = currentURL + '/usuarios/' + id;
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
            $('.viewIndex').slideDown();
            $('.viewResult #tableUsuarios').DataTable({
              "lengthChange": true
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Accion para setear el rol en base a la empresa
   * Y mostrar los modulos contratados por la empresa
   */

  $(document).on('change', '#cliente', function (event) {
    var id = $(this).val();
    var url = currentURL + "/usuarios/" + id;
    $.get(url, function (data, textStatus, jqXHR) {
      $(".modulosEmpresa").html(data);
    });
    /***
     * Condicion para que al elegir una empresa diferente a C3ntro, se deshabilite el rol de Super Administrador y Viceversa.
     */

    if (id == 30) {
      $("#cliente option:contains('Selecciona una empresa')").remove();

      if (!$("#rol option:contains('Super Administrador')").length) {
        $("#rol option:contains('Selecciona un rol')").remove();
        $("#rol").prepend("<option value='1'>Super Administrador</option>");
      }

      $("#rol option:contains('Super Administrador')").attr('selected', 'selected');
    } else {
      $("#cliente option:contains('Selecciona una empresa')").remove();
      $("#rol option:contains('Super Administrador')").remove();
      $("#rol option:contains('Administrador')").attr('selected', 'selected');
    }
  });
  $(document).on('click', '.modulo', function () {
    var id = $(this).data("value");

    if ($(this).prop('checked')) {
      $("#sub_cat_" + id).slideDown();
    } else {
      $("#sub_cat_" + id).slideUp();
    }
  });
  /**
   * Evento para marcar / desmarcar todos los checkbox al crear un nuevo usuario
   */

  $(document).on('click', '.marcarDesmarcar', function () {
    //event.preventDefault();
    var id = $(this).data("value");

    if ($("#sub_cat_" + id + " .mark").prop("checked") == true) {
      //alert("CHECKBOX ESTA ACTIVO");
      $("#sub_cat_" + id + " .mark").prop("checked", true);
    } else {
      //alert("CHECKBOX ESTA INACTIVO");
      $("#sub_cat_" + id + " .mark").prop("checked", false);
    }
  });
  /**
   * Evento para marcar / desmarcar todos los checkbox al editar un nuevo usuario
   */

  $(document).on('click', '.marcarDesmarcar2', function () {
    //event.preventDefault();
    var id = $(this).data("value"); //alert("EL ID ES" + id);

    if ($("#sub_cat_" + id + " .mark2").prop("checked") == true) {
      $("#sub_cat_" + id + " .mark2").prop("checked", true);
    } else {
      $("#sub_cat_" + id + " .mark2").prop("checked", false);
    }
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

/***/ 0:
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/module_administrador/usuarios.js ./resources/js/module_administrador/modulos.js ./resources/js/module_administrador/submenus.js ./resources/js/module_administrador/menus.js ./resources/js/module_administrador/distribuidores.js ./resources/js/module_administrador/dids.js ./resources/js/module_administrador/cat_estado_agente.js ./resources/js/module_administrador/cat_estado_cliente.js ./resources/js/module_administrador/cat_estado_empresa.js ./resources/js/module_administrador/cat_ip_pbx.js ./resources/js/module_administrador/cat_nas.js ./resources/js/module_administrador/troncales.js ./resources/js/module_administrador/canales.js ./resources/js/module_administrador/empresas.js ./resources/js/module_administrador/cat_base_datos.js ./resources/js/module_administrador/cat_tipo_canal.js ./resources/js/module_administrador/menu.js ./resources/js/module_administrador/cat_extensiones.js ./resources/js/module_administrador/licenciasBria.js ./resources/js/module_administrador/cat_campos_plantillas.js ./resources/js/module_administrador/prefijos_marcacion.js ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\usuarios.js */"./resources/js/module_administrador/usuarios.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\modulos.js */"./resources/js/module_administrador/modulos.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\submenus.js */"./resources/js/module_administrador/submenus.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\menus.js */"./resources/js/module_administrador/menus.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\distribuidores.js */"./resources/js/module_administrador/distribuidores.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\dids.js */"./resources/js/module_administrador/dids.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\cat_estado_agente.js */"./resources/js/module_administrador/cat_estado_agente.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\cat_estado_cliente.js */"./resources/js/module_administrador/cat_estado_cliente.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\cat_estado_empresa.js */"./resources/js/module_administrador/cat_estado_empresa.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\cat_ip_pbx.js */"./resources/js/module_administrador/cat_ip_pbx.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\cat_nas.js */"./resources/js/module_administrador/cat_nas.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\troncales.js */"./resources/js/module_administrador/troncales.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\canales.js */"./resources/js/module_administrador/canales.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\empresas.js */"./resources/js/module_administrador/empresas.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\cat_base_datos.js */"./resources/js/module_administrador/cat_base_datos.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\cat_tipo_canal.js */"./resources/js/module_administrador/cat_tipo_canal.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\menu.js */"./resources/js/module_administrador/menu.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\cat_extensiones.js */"./resources/js/module_administrador/cat_extensiones.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\licenciasBria.js */"./resources/js/module_administrador/licenciasBria.js");
__webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\cat_campos_plantillas.js */"./resources/js/module_administrador/cat_campos_plantillas.js");
module.exports = __webpack_require__(/*! C:\wamp64\www\Nimbus\resources\js\module_administrador\prefijos_marcacion.js */"./resources/js/module_administrador/prefijos_marcacion.js");


/***/ })

/******/ });