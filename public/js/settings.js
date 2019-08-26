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

/***/ "./resources/js/module_settings/acciones_formularios.js":
/*!**************************************************************!*\
  !*** ./resources/js/module_settings/acciones_formularios.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  /**
   * Evento para agregar una nueva fila para campos nuevos en el formulario
   */
  $(document).on('click', '#add', function () {
    var clickID = $(".tableNewForm tbody tr.clonar:last").attr('id').replace('tr_', '');
    $('#form_opc .form-control-sm').val(''); // Genero el nuevo numero id

    var newID = parseInt(clickID) + 1;
    var IDInput = ['id_campo', 'nombre_campo', 'tipo_campo', 'tamano', 'obligatorio', 'obligatorio_hidden', 'editable', 'editable_hidden', 'opciones', 'view'];
    fila = $(".tableNewForm tbody tr:eq()").clone().appendTo(".tableNewForm"); //Clonamos la fila

    for (var i = 0; i < IDInput.length; i++) {
      fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
    }

    fila.find('.btn-info').css('display', 'none');
    fila.find('#id_campo').attr('value', '');
    fila.attr("id", 'tr_' + newID);
  });
  /**
   * Accion para habilitar o deshabilitar los chechbox
   * de Requerido y Editable
   */

  $(document).on('click', '.micheckbox', function () {
    var id = $(this).attr('id');
    var idTR = $(this).attr('name').replace(id + "_", '');
    var name = id + "_hidden_" + idTR;

    if ($(this).prop('checked')) {
      $("input[name=" + name + "]").prop("disabled", true);
    } else {
      $("input[name=" + name + "]").prop("disabled", false);
    }
  });
  /**
   * Evento para eliminar una fila de la tabla de nuevo formulario
   */

  $(document).on('click', '.tr_clone_remove', function () {
    var tr = $(this).closest('tr');
    tr.remove();
  });
  /**
   * Evento para eliminar una fila de la tabla de nuevo formulario
   */

  $(document).on('click', '.tr_edit_remove', function () {
    var id = $(this).data('id-campo');
    var idForm = $("#id_formulario").val();
    var tr = $(this).closest('tr');
    tr.remove();
    var _method = "DELETE";

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/campos/' + id + '&' + idForm;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: _token,
        _method: _method
      },
      success: function success(result) {
        console.log(result);
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/module_settings/agentes.js":
/*!*************************************************!*\
  !*** ./resources/js/module_settings/agentes.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario editar agentes
   */

  $(document).on('click', '#tableAgentes tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".deleteAgente").slideDown();
    $(".editAgente").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableAgentes tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  ;
  /**
   * Evento para eliminar el Agente
   *
   */

  $(document).on('click', '.deleteAgente', function (event) {
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

        var url = currentURL + '/Agentes/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableAgentes').DataTable({
              "lengthChange": false
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
  * Evento para mostrar el formulario de crear un nuevo Agente
  */

  $(document).on("click", ".newAgente", function (e) {
    event.preventDefault();
    $('#tituloModal').html('Alta de Agente');
    $('#action').removeClass('deleteAgente');
    $('#action').addClass('saveAgente');
    var url = currentURL + "/Agentes/create";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
  * Evento para visualizar la configuración del Agente
  */

  $(document).on('click', '.editAgente', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    $('#tituloModal').html('Editar Agente');
    var url = currentURL + '/Agentes/' + id + '/edit';
    $('#action').addClass('updateAgente');
    $('#action').removeClass('saveAgente');
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
   * Evento para guardar los cambios del Agente
   */

  $(document).on('click', '.updateAgente', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
    var id = $("#idSeleccionado").val();
    var dataForm = $("#formDataAgente").serializeArray();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/Agentes/' + id;
    $.post(url, {
      dataForm: dataForm,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
    });
  });
  /**
   * Evento para guardar el nuevo agente
   */

  $(document).on('click', '.saveAgente', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
    var dataForm = $("#altaagente").serializeArray();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/Agentes';
    $.post(url, {
      dataForm: dataForm,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
    });
  });
});

/***/ }),

/***/ "./resources/js/module_settings/audios.js":
/*!************************************************!*\
  !*** ./resources/js/module_settings/audios.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el boton de eliminar seleccionando un audio
   */

  $(document).on('click', '#tableAudios tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".deleteAudio").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableAudios tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para mostrar el formulario de crear un nuevo Audio
   */

  $(document).on("click", ".newAudio", function (e) {
    event.preventDefault();
    $('#tituloModal').html('Nuevo Audio');
    $('#action').removeClass('deleteAudio');
    $('#action').addClass('saveAudio');
    var url = currentURL + "/Audios/create";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  }); //Ingresa el nombre del archivo seleccionado en el campo del browser

  $(document).on('change', '#file', function (e) {
    $('#labelFile').html(e.target.files[0]['name']);
  });
  /**
   * Evento para guardar el nuevo audio
   */

  $(document).on('click', '.saveAudio', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
    var formData = new FormData(document.getElementById("altaaudio"));
    var nombre = $("#name").val();
    var descripcion = $("#descripcion").val();
    var labelFile = $("#labelFile").text();
    var file = $("#file").val();

    var _token = $("input[name=_token]").val();

    formData.append("nombre", nombre);
    formData.append("descripcion", descripcion);
    formData.append("ruta", labelFile);
    formData.append("File", File);
    formData.append("_token", _token);
    var url = currentURL + '/Audios';
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
      $('.viewResult #tableAudios').DataTable({
        "lengthChange": false
      });
    });
    Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
  });
  /**
   * Evento para eliminar el Audio
   *
   */

  $(document).on('click', '.deleteAudio', function (event) {
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

        var url = currentURL + '/Audios/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableAudios').DataTable({
              "lengthChange": false
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/module_settings/formularios.js":
/*!*****************************************************!*\
  !*** ./resources/js/module_settings/formularios.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario editar formularios
   */

  $(document).on('click', '#tableFormulario tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".dropleft").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableFormulario tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para eliminar el Formulario
   *
   */

  $(document).on('click', '.deleteFormulario', function (event) {
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

        var url = currentURL + '/formularios/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableFormulario').DataTable({
              "lengthChange": false
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Evento para mostrar el formulario de crear un nuevo formulario
   */

  $(document).on("click", ".newFormulario", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Nuevo Formulario');
    var url = currentURL + '/formularios/create';
    $('#action').removeClass('updateFormulario');
    $('#action').addClass('saveFormulario');
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
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.saveFormulario', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
    var dataForm = $("#formDataFormulario").serializeArray();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/formularios';
    $.post(url, {
      dataForm: dataForm,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
    });
  });
  /**
   * Evento para visualizar detalles del Formulario
   */

  $(document).on('click', '.viewFormulario', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    $('#tituloModal').html('Detalles de Formulario');
    var url = currentURL + '/formularios/' + id;
    $('#action').removeClass('updateFormulario');
    $('#action').addClass('saveFormulario');
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
   * Evento para visualizar la configuración de formulario
   */

  $(document).on('click', '.editFormulario', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    $('#tituloModal').html('Detalles de Formulario');
    var url = currentURL + '/formularios/' + id + '/edit';
    $('#action').addClass('updateFormulario');
    $('#action').removeClass('saveFormulario');
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
   * Evento para guardar el nuevo modulo
   */

  $(document).on('click', '.updateFormulario', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
    var id = $("#idSeleccionado").val();
    var dataForm = $("#formDataFormulario").serializeArray();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/formularios/' + id;
    $.post(url, {
      dataForm: dataForm,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
    });
  });
  /**
   * Evento para duplicar el Formulario
   *
   */

  $(document).on('click', '.cloneFormulario', function (event) {
    event.preventDefault();
    Swal.fire({
      title: 'Nombre del nuevo formulario',
      input: 'text',
      inputAttributes: {
        autocapitalize: 'off'
      },
      showCancelButton: true,
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Duplicar',
      showLoaderOnConfirm: true,
      preConfirm: function preConfirm(nombreForm) {
        console.log(nombreForm);
        var id = $("#idSeleccionado").val();
        var url = currentURL + '/formularios/duplicar/' + id;

        var _token = $("input[name=_token]").val();

        $.ajax({
          url: url,
          type: 'GET',
          data: {
            id: id,
            nombreForm: nombreForm,
            _token: _token
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableFormulario').DataTable({
              "lengthChange": false
            });
            Swal.fire('Duplicado!', 'El registro ha sido duplicado.', 'success');
          }
        });
      }
    });
  });
});

/***/ }),

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

  $(document).on("click", ".sub-menu", function (e) {
    e.preventDefault();
    var id = $(this).data("id");

    if (id == 21) {
      url = currentURL + '/formularios';
      table = ' #tableFormulario';
    }
    /*
    ## Opcion Calificaciones
    */
    else if (id == 23) {
        url = currentURL + '/calificaciones';
        table = ' #tableCalificaciones';
      } else if (id == 17) {
        url = currentURL + '/Audios';
        table = ' #tableAudios';
      } else if (id == 19) {
        url = currentURL + '/Agentes';
        table = ' #tableAgentes';
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

/***/ 1:
/*!********************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/module_settings/menu.js ./resources/js/module_settings/formularios.js ./resources/js/module_settings/acciones_formularios.js ./resources/js/module_settings/audios.js ./resources/js/module_settings/agentes.js ***!
  \********************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\menu.js */"./resources/js/module_settings/menu.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\formularios.js */"./resources/js/module_settings/formularios.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\acciones_formularios.js */"./resources/js/module_settings/acciones_formularios.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\audios.js */"./resources/js/module_settings/audios.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\agentes.js */"./resources/js/module_settings/agentes.js");


/***/ })

/******/ });