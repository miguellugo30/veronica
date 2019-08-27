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
   * Evento para seleccionar agentes
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
    var id = $("#id").val();
    var grupo = $("#grupo").val();
    var nivel = $("#nivel").val();
    var nombre = $("#nombre").val();
    var usuario = $("#usuario").val();
    var contrasena = $("#contrasena").val();
    var extension = $("#extension").val();
    var protocolo = $("#protocolo").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/Agentes/' + id;
    $.post(url, {
      grupo: grupo,
      nivel: nivel,
      nombre: nombre,
      usuario: usuario,
      contrasena: contrasena,
      extension: extension,
      protocolo: protocolo,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #formDataAgente').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    });
  });
  /**
   * Evento para guardar el nuevo agente
   */

  $(document).on('click', '.saveAgente', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
    var grupo = $("#grupo").val();
    var nivel = $("#nivel").val();
    var nombre = $("#nombre").val();
    var usuario = $("#usuario").val();
    var contrasena = $("#contrasena").val();
    var extension = $("#extension").val();
    var protocolo = $("#protocolo").val();
    var Cat_Estado_Agente_id = $("#Cat_Estado_Agente_id").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/Agentes';
    $.post(url, {
      grupo: grupo,
      nivel: nivel,
      nombre: nombre,
      usuario: usuario,
      contrasena: contrasena,
      extension: extension,
      protocolo: protocolo,
      Cat_Estado_Agente_id: Cat_Estado_Agente_id,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #formDataAgente').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
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

/***/ "./resources/js/module_settings/grupos.js":
/*!************************************************!*\
  !*** ./resources/js/module_settings/grupos.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
  * Evento para mostrar el formulario de crear un nuevo Agente
  */

  $(document).on("click", ".newGrupo", function (e) {
    event.preventDefault();
    $('#tituloModal').html('Alta de Grupo');
    $('#action').removeClass('deleteGrupo');
    $('#action').addClass('saveGrupo');
    var url = currentURL + "/Grupos/create";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo agente
   */

  $(document).on('click', '.saveGrupo', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/Grupos';
    $.post(url, {
      nombre: nombre,
      descripcion: descripcion,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #formDataGrupo').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    });
  });
  /**
   * Evento para seleccionar un  Grupo
   */

  $(document).on('click', '#tableGrupos tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".deleteGrupo").slideDown();
    $(".editGrupo").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableGrupos tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  ;
  /**
   * Evento para eliminar un grupo
   *
   */

  $(document).on('click', '.deleteGrupo', function (event) {
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

        var url = currentURL + '/Grupos/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableGrupo').DataTable({
              "lengthChange": false
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
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
    var id = $("#id").val();
    var grupo = $("#grupo").val();
    var nivel = $("#nivel").val();
    var nombre = $("#nombre").val();
    var usuario = $("#usuario").val();
    var contrasena = $("#contrasena").val();
    var extension = $("#extension").val();
    var protocolo = $("#protocolo").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/Agentes/' + id;
    $.post(url, {
      grupo: grupo,
      nivel: nivel,
      nombre: nombre,
      usuario: usuario,
      contrasena: contrasena,
      extension: extension,
      protocolo: protocolo,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #formDataAgente').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
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
    var id = $("#id").val();
    var grupo = $("#grupo").val();
    var nivel = $("#nivel").val();
    var nombre = $("#nombre").val();
    var usuario = $("#usuario").val();
    var contrasena = $("#contrasena").val();
    var extension = $("#extension").val();
    var protocolo = $("#protocolo").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/Agentes/' + id;
    $.post(url, {
      grupo: grupo,
      nivel: nivel,
      nombre: nombre,
      usuario: usuario,
      contrasena: contrasena,
      extension: extension,
      protocolo: protocolo,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #formDataAgente').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
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
    var id = $("#id").val();
    var grupo = $("#grupo").val();
    var nivel = $("#nivel").val();
    var nombre = $("#nombre").val();
    var usuario = $("#usuario").val();
    var contrasena = $("#contrasena").val();
    var extension = $("#extension").val();
    var protocolo = $("#protocolo").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/Agentes/' + id;
    $.post(url, {
      grupo: grupo,
      nivel: nivel,
      nombre: nombre,
      usuario: usuario,
      contrasena: contrasena,
      extension: extension,
      protocolo: protocolo,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #formDataAgente').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
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
    var id = $("#id").val();
    var grupo = $("#grupo").val();
    var nivel = $("#nivel").val();
    var nombre = $("#nombre").val();
    var usuario = $("#usuario").val();
    var contrasena = $("#contrasena").val();
    var extension = $("#extension").val();
    var protocolo = $("#protocolo").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/Agentes/' + id;
    $.post(url, {
      grupo: grupo,
      nivel: nivel,
      nombre: nombre,
      usuario: usuario,
      contrasena: contrasena,
      extension: extension,
      protocolo: protocolo,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #formDataAgente').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    });
  });
  /**
  * Evento para visualizar la configuración del Grupo
  */

  $(document).on('click', '.editGrupo', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    $('#tituloModal').html('Editar Grupo');
    var url = currentURL + '/Grupos/' + id + '/edit';
    $('#action').addClass('updateGrupo');
    $('#action').removeClass('saveGrupo');
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

  $(document).on('click', '.updateGrupo', function (event) {
    event.preventDefault();
    $('#modal').modal('hide');
    var id = $("#id").val();
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/Grupos/' + id;
    $.post(url, {
      nombre: nombre,
      descripcion: descripcion,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #formDataGrupo').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    });
  });
});
;

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
      } else if (id == 28) {
        url = currentURL + '/Agentes';
        table = ' #tableAgentes';
      } else if (id == 29) {
        url = currentURL + '/Grupos';
        table = ' #tableGrupos';
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

/***/ "./resources/js/module_settings/sub_formularios.js":
/*!*********************************************************!*\
  !*** ./resources/js/module_settings/sub_formularios.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar un modal para capturas los parámetros para
   * los campos de Opciones y Folios
   */

  $(document).on("change", ".subFormulario", function (e) {
    var tipo = $(this).val();
    $('#action_opc').addClass('saveOpciones');
    action = $(this).data('action');
    idTR = $(this).attr('name').replace('tipo_campo_', '');
    var url = currentURL + '/subformularios/create';
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(result) {
        if (tipo == 'asignador_folios') {
          $('#modal_opciones_campo').modal({
            backdrop: 'static',
            keyboard: false
          });
          $("#modal_opciones_campo #modal-body").html(result);
          $('#tituloModalOpciones').html('Parametros para los folios');
          $("#modal_opciones_campo #modal-body #opcionesForm").slideUp();
          $("#modal_opciones_campo #modal-body #folioForm").slideDown();
          $("#nombre_opcion").prop("disabled", true);
          $("#form_id").prop("disabled", true);
          $("#prefijo").prop("disabled", false);
          $("#folio").prop("disabled", false);
        } else if (tipo == 'select') {
          $('#modal_opciones_campo').modal({
            backdrop: 'static',
            keyboard: false
          });
          $("#modal_opciones_campo #modal-body").html(result);
          $('#tituloModalOpciones').html('Agregar opciones');
          $("#folioForm").slideUp();
          $("#opcionesForm").slideDown();
          $("#nombre_opcion").prop("disabled", false);
          $("#form_id").prop("disabled", false);
          $("#prefijo").prop("disabled", true);
          $("#folio").prop("disabled", true);
        }
      }
    });
  });
  /**
   * Evento para clonar una fila de la tabla de opciones
   */

  $(document).on('click', '.add_opc', function () {
    var clickID = $(".tableOpc tbody tr.clonar:last").attr('id').replace('tr_opciones_', ''); // Genero el nuevo numero id

    newID = parseInt(clickID) + 1;
    fila = $(".tableOpc tbody tr:eq()").clone().appendTo(".tableOpc"); //Clonamos la fila

    fila.find('#id_opcion').attr({
      name: 'id_opcion_' + newID,
      value: ''
    }); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre

    fila.find('#id_campos').attr('name', 'id_campos_' + newID); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre

    fila.find('#nombre_opcion').attr("name", 'nombre_opcion_' + newID); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre

    fila.find('#form_id').attr("name", 'form_id_' + newID); //Buscamos el campo con id tipo_campo y le agregamos un nuevo nombre

    fila.attr("id", 'tr_opciones_' + newID);
  });
  /**
   * Evento para eliminar una fila de la tabla de nuevo formulario
   */

  $(document).on('click', '.tr_clone_remove_opcion', function () {
    var tr = $(this).closest('tr');
    var id = $(this).data('opcion-id');

    if (id != '') {
      tr.remove();
      var _method = "DELETE";

      var _token = $("input[name=_token]").val();

      var url = currentURL + '/subformularios/' + id;
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
    } else {
      tr.remove();
    }
  });
  /**
   * Evento para guardar las opciones de los campos, Folio y Opciones
   */

  $(document).on('click', '.saveOpciones', function (event) {
    event.preventDefault();
    var dataOpciones = JSON.stringify($("#form_opc").serializeArray());
    $('input[name="opciones_' + idTR + '"]').val(dataOpciones);
    $("#modal_opciones_campo").modal('hide');
    $("button[name='view_" + idTR + "']").slideDown();
    /**
     * Limpiamos todos los input del formulario de Opciones
     */

    $('#form_opc .form-control-sm').val('');
    /**
     * Eliminamos las opciones adicionales dentro de la tabla de opciones
     */

    var nColumnas = $(".tableOpc tbody tr").length;

    for (var i = nColumnas; i > 1; i--) {
      $(".tableOpc tbody tr#tr_opciones_" + i).remove();
    }
  });
  /**
   * Evento para ver las opciones de los campos, Folio y Opciones
   */

  $(document).on('click', '.view', function (event) {
    event.preventDefault();
    idTR = $(this).attr('name').replace('view_', '');
    $('#action_opc').addClass('saveOpciones');
    var opciones = JSON.parse($("input[name=opciones_" + idTR + ']').val());
    var tipo_campo = $('#tr_' + idTR + ' .subFormulario').val();

    if (tipo_campo == 'asignador_folios') {
      $('#tituloModalOpciones').html('Parametros para los folios');
      $("#modal_opciones_campo").modal('show', {
        backdrop: 'static',
        keyboard: false
      });
      $("#opcionesForm").slideUp();
      $("#folioForm").slideDown();
      $("#nombre_opcion").prop("disabled", true);
      $("#form_opcion").prop("disabled", true);
      $("#prefijo").prop("disabled", false);
      $("#folio").prop("disabled", false);

      for (var i = 0; i < opciones.length; i++) {
        $("#" + opciones[i]['name']).val(opciones[i]['value']);
      }
    } else if (tipo_campo == 'select') {
      $('#tituloModalOpciones').html('Agregar opciones');
      $("#modal_opciones_campo").modal('show', {
        backdrop: 'static',
        keyboard: false
      });
      $("#folioForm").slideUp();
      $("#opcionesForm").slideDown();
      $("#nombre_opcion").prop("disabled", false);
      $("#form_opcion").prop("disabled", false);
      $("#prefijo").prop("disabled", true);
      $("#folio").prop("disabled", true);
      var j = 0;

      for (var _i = 0; _i < opciones.length / 2; _i++) {
        newID = _i + 1;

        if (_i < 1) {
          $('#tr_opciones_1 #nombre_opcion').val(opciones[j]['value']);
          $('#tr_opciones_1 #form_id').val(opciones[j + 1]['value']);
        } else {
          fila = $(".tableOpc tbody tr:eq()").clone().appendTo(".tableOpc"); //Clonamos la fila

          fila.find('#nombre_opcion').attr('name', 'nombre_opcion_' + newID);
          fila.find('#nombre_opcion').val(opciones[j]['value']); //Buscamos el campo con id nombre_campo y le agregamos un nuevo nombre

          fila.find('#form_id').attr('name', 'form_id_' + newID);
          fila.find('#form_id').val(opciones[j + 1]['value']); //Buscamos el campo con id tipo_campo y le agregamos un nuevo nombre

          fila.attr("id", 'tr_opciones_' + newID);
        }

        j = j + 2;
      }
    }
  });
  /**
   * Evento para ver las opciones de los campos, Folio y Opciones
   */

  $(document).on('click', '.edit_opciones', function (event) {
    event.preventDefault();
    idTR = $(this).attr('id').replace('view_', '');
    id = $(this).data('id-campo');
    var tipo_campo = $('#tr_' + idTR + ' #tipo_campo').val();
    $('#action_opc').addClass('updateOpciones');
    var url = currentURL + '/subformularios/' + id + '/edit';
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(result) {
        $('#modal_opciones_campo').modal({
          backdrop: 'static',
          keyboard: false
        });
        $("#modal_opciones_campo #modal-body").html(result);

        if (tipo_campo == 'asignador_folios') {
          $('#tituloModalOpciones').html('Parametros para los folios');
          $("#modal_opciones_campo").modal('show', {
            backdrop: 'static',
            keyboard: false
          });
          $("#opcionesForm").slideUp();
          $("#folioForm").slideDown();
          $("#nombre_opcion").prop("disabled", true);
          $("#form_opcion").prop("disabled", true);
          $("#prefijo").prop("disabled", false);
          $("#folio").prop("disabled", false);
        } else if (tipo_campo == 'select') {
          $('#tituloModalOpciones').html('Agregar opciones');
          $("#modal_opciones_campo").modal('show', {
            backdrop: 'static',
            keyboard: false
          });
          $("#folioForm").slideUp();
          $("#opcionesForm").slideDown();
          $("#nombre_opcion").prop("disabled", false);
          $("#form_opcion").prop("disabled", false);
          $("#prefijo").prop("disabled", true);
          $("#folio").prop("disabled", true);
        }
      }
    });
  });
  /**
   * Evento para actualizar las opciones de los campos, Folio y Opciones
   */

  $(document).on('click', '.updateOpciones', function (event) {
    event.preventDefault();
    $("#modal_opciones_campo").modal('hide');
    var val = 0;
    var dataOpciones = JSON.stringify($("#form_opc").serializeArray());

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/subformularios/' + val;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: _token,
        _method: _method,
        dataOpciones: dataOpciones
      },
      success: function success(result) {
        $("#modal_opciones_campo #modal-body").html(result);
      }
    });
  });
});

/***/ }),

/***/ 1:
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/module_settings/menu.js ./resources/js/module_settings/formularios.js ./resources/js/module_settings/sub_formularios.js ./resources/js/module_settings/acciones_formularios.js ./resources/js/module_settings/audios.js ./resources/js/module_settings/agentes.js ./resources/js/module_settings/grupos.js ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\menu.js */"./resources/js/module_settings/menu.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\formularios.js */"./resources/js/module_settings/formularios.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\sub_formularios.js */"./resources/js/module_settings/sub_formularios.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\acciones_formularios.js */"./resources/js/module_settings/acciones_formularios.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\audios.js */"./resources/js/module_settings/audios.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\agentes.js */"./resources/js/module_settings/agentes.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\grupos.js */"./resources/js/module_settings/grupos.js");


/***/ })

/******/ });