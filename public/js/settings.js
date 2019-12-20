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

/***/ "./resources/js/module_settings/acciones_speech.js":
/*!*********************************************************!*\
  !*** ./resources/js/module_settings/acciones_speech.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  /**
   * Evento para mostrar el boton de añadir y borrar cuando el tipo de speech sea dinamico
   */
  $(document).on('change', '.tipo', function (event) {
    event.preventDefault();
    var tipo = $('.tipo').val();

    if (tipo == 'dinamico') {
      $('.agrega').removeAttr("hidden");
      $('.remove').removeAttr("hidden");
    } else if (tipo == 'estatico') {
      $('.agrega').attr("hidden", "hidden");
      $('.remove').attr("hidden", "hidden");
      /**
       * Eliminamos las opciones adicionales dentro de la tabla de opciones
       */

      var nColumnas = $(".tableNewSpeech tbody tr").length;

      for (var i = nColumnas; i > 1; i--) {
        $(".tableNewSpeech tbody tr#tr_" + i).remove();
      }
    } else if (tipo == '') {
      $('.agrega').attr("hidden", "hidden");
      $('.remove').attr("hidden", "hidden");
      /**
       * Eliminamos las opciones adicionales dentro de la tabla de opciones
       */

      var nColumnas = $(".tableNewSpeech tbody tr").length;

      for (var _i = nColumnas; _i > 1; _i--) {
        $(".tableNewSpeech tbody tr#tr_" + _i).remove();
      }
    }
  });
  /**
   * Evento para mostrar el boton de añadir y borrar cuando el tipo de speech sea dinamico en el apartado de editar
   */

  $(document).on('change', '.tipo', function (event) {
    event.preventDefault();
    var tipo = $('.tipo').val();

    if (tipo == 'dinamico') {
      $('.agrega').removeAttr("hidden");
      $('.remove').removeAttr("hidden");
    } else if (tipo == 'estatico') {
      $('.agrega').attr("hidden", "hidden");
      $('.remove').attr("hidden", "hidden");
      /**
       * Eliminamos las opciones adicionales dentro de la tabla de opciones
       */

      var nColumnas = $(".tableEditSpeech tbody tr").length;

      for (var i = nColumnas; i > 1; i--) {
        $(".tableEditSpeech tbody tr#tr_" + i).remove();
      }
    } else if (tipo == '') {
      $('.agrega').attr("hidden", "hidden");
      $('.remove').attr("hidden", "hidden");
      /**
       * Eliminamos las opciones adicionales dentro de la tabla de opciones
       */

      var nColumnas = $(".tableEditSpeech tbody tr").length;

      for (var _i2 = nColumnas; _i2 > 1; _i2--) {
        $(".tableEditSpeech tbody tr#tr_" + _i2).remove();
      }
    }
  });
  /**
   * Evento para agregar una nueva fila para campos nuevos en el formulario
   */

  $(document).on('click', '#add_s', function () {
    var clickID = $(".tableNewSpeech tbody tr.clonar:last").attr('id').replace('tr_', '');
    $('#form_opc .form-control-sm').val(''); // Genero el nuevo numero id

    var newID = parseInt(clickID) + 1; //let IDInput = ['nombreSpeech', 'descripcion', 'prioridad'];

    var IDInput = ['nombreSpeech', 'descripcionSpeech'];
    fila = $(".tableNewSpeech tbody tr:eq()").clone().appendTo(".tableNewSpeech"); //Clonamos la fila

    for (var i = 0; i < IDInput.length; i++) {
      fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar

      fila.find('#' + IDInput[i]).attr('id', IDInput[i] + "_" + newID); //Cambiamos el id de los campos de la fila a clonar
    }

    fila.find('.btn-info').css('display', 'none');
    fila.find('#id_campo').attr('value', '');
    fila.attr("id", 'tr_' + newID);
  });
  /**
   * Evento para agregar una nueva fila para campos nuevos en el formulario editar speech
   */

  $(document).on('click', '#add_os', function () {
    var clickID = $(".tableEditSpeech tbody tr.clonar:last").attr('id').replace('tr_', '');
    $('#form_opc .form-control-sm').val(''); // Genero el nuevo numero id

    var newID = parseInt(clickID) + 1;
    var IDInput = ['nombreSpeech', 'descripcion'];
    fila = $(".tableEditSpeech tbody tr:eq()").clone().appendTo(".tableEditSpeech"); //Clonamos la fila

    for (var i = 0; i < IDInput.length; i++) {
      fila.find('.' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar

      fila.find('.' + IDInput[i]).attr('id', IDInput[i] + "_" + newID); //Cambiamos el id de los campos de la fila a clonar
    }

    fila.find('.btn-info').css('display', 'none');
    fila.find('#id_campo').attr('value', '');
    fila.attr("id", 'tr_' + newID);
  });
  /**
   * Evento para eliminar una fila de la tabla de nuevo Speech
   */

  $(document).on('click', '.tr_clone_remove', function () {
    var tr = $(this).closest('tr');
    tr.remove();
  });
});

/***/ }),

/***/ "./resources/js/module_settings/agentes.js":
/*!*************************************************!*\
  !*** ./resources/js/module_settings/agentes.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: C:\\xampp\\htdocs\\Nimbus\\resources\\js\\module_settings\\agentes.js: Unexpected token (123:0)\n\n  121 | \n  122 |         $.post(url, {\n> 123 | <<<<<<< HEAD\n      | ^\n  124 |                 grupo: grupo,\n  125 |                 tipo_licencia: tipo_licencia,\n  126 |                 nivel: nivel,\n    at Parser.raise (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:6931:17)\n    at Parser.unexpected (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:8324:16)\n    at Parser.parseIdentifierName (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:10283:18)\n    at Parser.parseIdentifier (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:10261:23)\n    at Parser.parseMaybePrivateName (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9605:19)\n    at Parser.parsePropertyName (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:10073:98)\n    at Parser.parseObjectMember (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9974:10)\n    at Parser.parseObj (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9904:25)\n    at Parser.parseExprAtom (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9526:28)\n    at Parser.parseExprSubscripts (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9166:23)\n    at Parser.parseMaybeUnary (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9146:21)\n    at Parser.parseExprOps (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9012:23)\n    at Parser.parseMaybeConditional (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:8985:23)\n    at Parser.parseMaybeAssign (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:8931:21)\n    at Parser.parseExprListItem (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:10253:18)\n    at Parser.parseCallExpressionArguments (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9363:22)\n    at Parser.parseSubscript (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9271:29)\n    at Parser.parseSubscripts (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9187:19)\n    at Parser.parseExprSubscripts (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9176:17)\n    at Parser.parseMaybeUnary (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9146:21)\n    at Parser.parseExprOps (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9012:23)\n    at Parser.parseMaybeConditional (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:8985:23)\n    at Parser.parseMaybeAssign (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:8931:21)\n    at Parser.parseExpression (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:8881:23)\n    at Parser.parseStatementContent (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:10741:23)\n    at Parser.parseStatement (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:10612:17)\n    at Parser.parseBlockOrModuleBlockBody (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:11188:25)\n    at Parser.parseBlockBody (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:11175:10)\n    at Parser.parseBlock (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:11159:10)\n    at Parser.parseFunctionBody (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:10178:24)\n    at Parser.parseFunctionBodyAndFinish (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:10148:10)\n    at withTopicForbiddingContext (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:11320:12)\n    at Parser.withTopicForbiddingContext (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:10487:14)\n    at Parser.parseFunction (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:11319:10)\n    at Parser.parseFunctionExpression (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9619:17)\n    at Parser.parseExprAtom (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9532:21)\n    at Parser.parseExprSubscripts (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9166:23)\n    at Parser.parseMaybeUnary (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9146:21)\n    at Parser.parseExprOps (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:9012:23)\n    at Parser.parseMaybeConditional (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:8985:23)\n    at Parser.parseMaybeAssign (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:8931:21)\n    at Parser.parseExprListItem (C:\\xampp\\htdocs\\Nimbus\\node_modules\\@babel\\parser\\lib\\index.js:10253:18)");

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
    var formData = new FormData(document.getElementById("altaaudio"));
    var nombre = $("#nombre").val();
    var descripcion = $("#descripcion").val();
    var labelFile = $("#labelFile").text();
    var file = $("#file").val();

    var _token = $("input[name=_token]").val();

    formData.append("nombre", nombre);
    formData.append("descripcion", descripcion);
    formData.append("ruta", labelFile);
    formData.append("File", file);
    formData.append("_token", _token);
    var url = currentURL + '/Audios';
    $.ajax({
      url: url,
      type: "post",
      //dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    }).done(function (data) {
      $('#modal').modal('hide');
      $('.modal-backdrop ').css('display', 'none');
      $('.viewResult').html(data);
      $('.viewResult #tableAudios').DataTable({
        "lengthChange": false
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar el Audio
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
  /**
   * Evento para reproducir un audio
   */

  $(document).on('click', '.reproducir-audio', function (event) {
    var id = $(this).data("id-audio");
    var url = currentURL + '/Audios/' + id;

    var _token = $("input[name=_token]").val();

    $.ajax({
      url: url,
      type: 'GET',
      data: {
        id: id,
        _token: _token
      },
      success: function success(result) {
        var src = currentURL.replace(/\/settings/g, '') + result;
        var audio = new Audio();
        var playPromise;
        audio.src = src;
        playPromise = audio.play();

        if (playPromise) {
          playPromise.then(function () {
            // Audio Loading Successful
            // Audio playback takes time
            setTimeout(function () {
              // Follow up operation
              console.log("done.");
            }, audio.duration * 1000); // audio.duration is the length of the audio in seconds.
          })["catch"](function (e) {// Audio loading failure
          });
        }
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

/***/ "./resources/js/module_settings/calificaciones.js":
/*!********************************************************!*\
  !*** ./resources/js/module_settings/calificaciones.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nueva calificacion
   */

  $(document).on("click", ".newCalificaciones", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Nuevas Calificaciones');
    var url = currentURL + '/calificaciones/create';
    $('#action').removeClass('updateCalificaciones');
    $('#action').addClass('saveCalificaciones');
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
   * Evento para clonar finas de la tabla
   */

  $(document).on('click', '#addCalificaciones', function (event) {
    var clickID = $(".tableNewForm tbody tr.clonar:last").attr('id').replace('tr_', ''); // Genero el nuevo numero id

    var newID = parseInt(clickID) + 1;
    var IDInput = ['nombre_calificacion', 'formulario_calificacion', 'id_calificacion']; //ID de los inputs dentro de la fila

    fila = $(".tableNewForm tbody tr:eq()").clone().appendTo(".tableNewForm"); //Clonamos la fila

    for (var i = 0; i < IDInput.length; i++) {
      fila.find('#' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
    }

    fila.find('.btn-danger').css('display', 'initial');
    fila.find('#id_calificacion').val('');
    fila.attr("id", 'tr_' + newID);
  });
  /**
   * Evento para guardar Nuevas Calificaciones
   */

  $(document).on('click', '.saveCalificaciones', function (event) {
    event.preventDefault();
    var dataForm = $("#formDataCalificaciones").serializeArray();
    var data = {};
    $(dataForm).each(function (index, obj) {
      data[obj.name] = obj.value;
    });

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/calificaciones';
    $.post(url, {
      dataForm: data,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      $('.viewResult').html(data);
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento que muestra elemento calificaciones || esta funcion muestra con slide los botones de Eliminar y Editar
   */

  $(document).on('click', '#tableCalificaciones tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".dropleft").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableCalificaciones tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para visualizar un registro
   */

  $(document).on('click', '.editCalificaciones', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    $('#tituloModal').html('Edicion de Calificaciones');
    var url = currentURL + '/calificaciones/' + id + '/edit';
    $('#action').removeClass('saveCalificaciones');
    $('#action').addClass('updateCalificaciones');
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
   * Evento para guardar Nuevas Calificaciones
   */

  $(document).on('click', '.updateCalificaciones', function (event) {
    event.preventDefault();
    var dataForm = $("#formDataCalificaciones").serializeArray();
    var data = {};
    $(dataForm).each(function (index, obj) {
      data[obj.name] = obj.value;
    });
    var id = $("#idSeleccionado").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/calificaciones/' + id;
    $.post(url, {
      dataForm: data,
      _token: _token,
      _method: _method
    }, function (data, textStatus, xhr) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      $('.viewResult').html(data);
      $('.viewResult #tableCalificaciones').DataTable({
        "lengthChange": false
      });
      Swal.fire('Actualizado!', 'El registro ha sido actualiazdo.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para eliminar el Grupo
   */

  $(document).on('click', '.deleteCalificaciones', function (event) {
    event.preventDefault();
    /**Modal de Alerta Swal.fire**/

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

        var url = currentURL + '/calificaciones/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableCalificaciones').DataTable({
              "lengthChange": false
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Evento para eliminar el Grupo
   */

  $(document).on('click', '.tr_clone_remove-calificacion', function (event) {
    var id = $(this).data("id-eliminar");

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/calificaciones/eliminarCalificacion/' + id;
    var tr = $(this).closest('tr');
    $.ajax({
      url: url,
      type: 'GET',
      data: {
        _token: _token
      },
      success: function success(result) {
        tr.remove();
        Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
      }
    });
  });
  /**
   * Evento para duplicar el grupo de calificaciones
   */

  $(document).on('click', '.cloneCalificaciones', function (event) {
    event.preventDefault();
    Swal.fire({
      title: 'Nombre del nuevo grupo de calificaciones',
      input: 'text',
      inputAttributes: {
        autocapitalize: 'off'
      },
      showCancelButton: true,
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Duplicar',
      showLoaderOnConfirm: true,
      preConfirm: function preConfirm(nombreForm) {
        var id = $("#idSeleccionado").val();
        var url = currentURL + '/calificaciones/duplicar/' + id;

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
            $('.viewResult #tableCalificaciones').DataTable({
              "lengthChange": false
            });
            Swal.fire('Duplicado!', 'El registro ha sido duplicado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Visualizar el grupo de calificaciones
   */

  $(document).on('click', '.viewCalificaciones', function (event) {
    var id = $("#idSeleccionado").val();
    var url = currentURL + '/calificaciones/' + id;
    $('#tituloModal').html('Visualizar Calificaciones');
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
   * Mostrar formulario vinculado a la calificacion seleccionada
   */

  $(document).on('change', '#calificacion', function (event) {
    var id = $(this).val();
    console.log(id);
    var url = currentURL + '/formularios/' + id;
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(result) {
        $(".viewFormularioCalificacion").html(result);
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
    $(".print-error-msg").find("ul").append('<li>Es un campo obligatorio</li>');

    for (var clave in msg) {
      var data = clave.split('.');
      $("[name='" + data[1] + "']").addClass('is-invalid');
    }
  }
});

/***/ }),

/***/ "./resources/js/module_settings/eventos_agentes.js":
/*!*********************************************************!*\
  !*** ./resources/js/module_settings/eventos_agentes.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el formulario de crear un nuevo Evento
   */

  $(document).on("click", ".newEventoAgente", function (e) {
    e.preventDefault();
    $('#tituloModal').html('Alta de Evento');
    $('#action').removeClass('deleteEventoAgente');
    $('#action').addClass('saveEventoAgente');
    var url = currentURL + "/EventosAgentes/create";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para guardar el nuevo Evento
   */

  $(document).on('click', '.saveEventoAgente', function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var tiempo = $("#tiempo").val(); //let fechaini = $("#fechaini").val();
    //let fechafin = $("#fechafin").val();

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/EventosAgentes';
    $.post(url, {
      nombre: nombre,
      tiempo: tiempo,
      //fechaini: fechaini,
      //fechafin: fechafin,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #tableEventosAgentes').DataTable({
        "lengthChange": true,
        "order": [[0, "asc"]]
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
   * Evento para seleccionar un Evento
   */

  $(document).on('click', '#tableEventosAgentes tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".deleteEventoAgente").slideDown();
    $(".editEventoAgente").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableEventosAgentes tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  ;
  /**
   * Evento para eliminar un Evento
   *
   */

  $(document).on('click', '.deleteEventoAgente', function (event) {
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

        var url = currentURL + '/EventosAgentes/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableEventosAgentes').DataTable({
              "lengthChange": false
            });
            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
          }
        });
      }
    });
  });
  /**
   * Evento para visualizar la configuración del Grupo
   */

  $(document).on('click', '.editEventoAgente', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    $('#tituloModal').html('Editar Evento');
    var url = currentURL + '/EventosAgentes/' + id + '/edit';
    $('#action').addClass('updateEventoAgente');
    $('#action').removeClass('saveEventoAgente');
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

  $(document).on('click', '.updateEventoAgente', function (event) {
    event.preventDefault();
    var id = $("#id").val();
    var nombre = $("#nombre").val();
    var tiempo = $("#tiempo").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/EventosAgentes/' + id;
    $.post(url, {
      nombre: nombre,
      tiempo: tiempo,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.viewResult').html(data);
      $('.viewResult #tableEventosAgentes').DataTable({
        "lengthChange": true,
        "order": [[0, "asc"]]
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
;

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
    var dataForm = $("#formDataFormulario").serializeArray();
    var data = {};
    $(dataForm).each(function (index, obj) {
      data[obj.name] = obj.value;
    });

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/formularios';
    $.post(url, {
      dataForm: data,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      $('.viewResult').html(data);
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
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
    var id = $("#idSeleccionado").val();
    var dataForm = $("#formDataFormulario").serializeArray();
    var data = {};
    $(dataForm).each(function (index, obj) {
      data[obj.name] = obj.value;
    });

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/formularios/' + id;
    $.post(url, {
      dataForm: data,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      $('.viewResult').html(data);
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
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
  /**
   * Funcion para mostrar los errores de los formularios
   */

  function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $(".form-control").removeClass('is-invalid');
    $(".print-error-msg").find("ul").append('<li>Es un campo obligatorio</li>');

    for (var clave in msg) {
      var data = clave.split('.');
      $("[name='" + data[1] + "']").addClass('is-invalid');
    }
  }
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
      $('.viewResult #tableGrupos').DataTable({
        "lengthChange": true,
        "order": [[0, "asc"]]
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
      $('.viewResult #tableGrupos').DataTable({
        "lengthChange": true,
        "order": [[0, "asc"]]
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
    } else if (id == 22) {
      url = currentURL + '/speech';
      table = ' #tableSpeech';
    } else if (id == 23) {
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
    } else if (id == 22) {
      url = currentURL + '/Speech';
      table = ' #tableSpeech';
    } else if (id == 35) {
      url = currentURL + '/EventosAgentes';
      table = ' #tableEventosAgentes';
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

/***/ "./resources/js/module_settings/speech.js":
/*!************************************************!*\
  !*** ./resources/js/module_settings/speech.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para seleccionar Speech
   */

  $(document).on('click', '#tableSpeech tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".deleteSpeech").slideDown();
    $(".editSpeech").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableSpeech tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  ;
  /**
   * Evento para eliminar el Agente
   *
   */

  $(document).on('click', '.deleteSpeech', function (event) {
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

        var url = currentURL + '/speech/' + id;
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: _token,
            _method: _method
          },
          success: function success(result) {
            $('.viewResult').html(result);
            $('.viewResult #tableSpeech').DataTable({
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

  $(document).on("click", ".newSpeech", function (e) {
    event.preventDefault();
    $('#tituloModal').html('Alta de Speech');
    $('#action').removeClass('deleteSpeech');
    $('#action').addClass('saveSpeech');
    var url = currentURL + "/speech/create";
    $.get(url, function (data, textStatus, jqXHR) {
      $('#modal').modal('show');
      $("#modal-body").html(data);
    });
  });
  /**
   * Evento para visualizar la configuración del Speech
   */

  $(document).on('click', '.editSpeech', function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val();
    $('#tituloModal').html('Detalles de Speech');
    var url = currentURL + '/speech/' + id + '/edit';
    $('#action').addClass('updateSpeech');
    $('#action').removeClass('saveSpeech');
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
   * Evento para guardar los cambios del Speech
   */

  $(document).on('click', '.updateSpeech', function (event) {
    event.preventDefault();
    var dataForm = $("#editspeech").serializeArray();
    var data = {};
    $(dataForm).each(function (index, obj) {
      data[obj.name] = obj.value;
    });
    var id = $("#idSeleccionado").val();

    var _token = $("input[name=_token]").val();

    var _method = "PUT";
    var url = currentURL + '/speech/' + id;
    $.post(url, {
      dataForm: data,
      _method: _method,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      $('.viewResult').html(data);
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
    }).fail(function (data) {
      printErrorMsg(data.responseJSON.errors);
    });
  });
  /**
   * Evento para guardar el nuevo speech
   */

  $(document).on('click', '.saveSpeech', function (event) {
    event.preventDefault();
    var dataForm = $("#altaspeech").serializeArray();
    var data = {};
    $(dataForm).each(function (index, obj) {
      data[obj.name] = obj.value;
    });

    var _token = $("input[name=_token]").val();

    var url = currentURL + '/speech';
    $.post(url, {
      dataForm: data,
      _token: _token
    }, function (data, textStatus, xhr) {
      $('.modal-backdrop ').css('display', 'none');
      $('#modal').modal('hide');
      $('.viewResult').html(data);
      $('.viewResult #tableSpeech').DataTable({
        "lengthChange": true,
        "order": [[2, "asc"]]
      });
      Swal.fire('Correcto!', 'El registro ha sido guardado.', 'success');
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
    $(".print-error-msg").find("ul").append('<li>Es un campo obligatorio</li>');

    for (var clave in msg) {
      var data = clave.split('.');
      $("[name='" + data[1] + "']").addClass('is-invalid');
    }
  }
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
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/module_settings/menu.js ./resources/js/module_settings/formularios.js ./resources/js/module_settings/sub_formularios.js ./resources/js/module_settings/acciones_formularios.js ./resources/js/module_settings/audios.js ./resources/js/module_settings/calificaciones.js ./resources/js/module_settings/agentes.js ./resources/js/module_settings/grupos.js ./resources/js/module_settings/speech.js ./resources/js/module_settings/acciones_speech.js ./resources/js/module_settings/eventos_agentes.js ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\menu.js */"./resources/js/module_settings/menu.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\formularios.js */"./resources/js/module_settings/formularios.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\sub_formularios.js */"./resources/js/module_settings/sub_formularios.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\acciones_formularios.js */"./resources/js/module_settings/acciones_formularios.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\audios.js */"./resources/js/module_settings/audios.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\calificaciones.js */"./resources/js/module_settings/calificaciones.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\agentes.js */"./resources/js/module_settings/agentes.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\grupos.js */"./resources/js/module_settings/grupos.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\speech.js */"./resources/js/module_settings/speech.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\acciones_speech.js */"./resources/js/module_settings/acciones_speech.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_settings\eventos_agentes.js */"./resources/js/module_settings/eventos_agentes.js");


/***/ })

/******/ });