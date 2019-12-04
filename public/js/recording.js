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

/***/ "./resources/js/module_recording/Grabaciones.js":
/*!******************************************************!*\
  !*** ./resources/js/module_recording/Grabaciones.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var currentURL = window.location.href;
  /**
   * Evento para mostrar el boton de eliminar seleccionando una grabacion
   */

  $(document).on('click', '#tableGrabaciones tbody tr', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    $(".deleteGrabacion").slideDown();
    $(".downloadGrabacion").slideDown();
    $("#idSeleccionado").val(id);
    $("#tableGrabaciones tbody tr").removeClass('table-primary');
    $(this).addClass('table-primary');
  });
  /**
   * Evento para descargar la Grabacion
   */

  $(document).on("click", ".downloadGrabacion", function (event) {
    event.preventDefault();
    var id = $("#idSeleccionado").val(); //window.location.href = 'http://10.255.242.136/audios/temp2/Inbound_24/2019-11-05/11536501001-8466.wav';

    $("#idSeleccionado").attr('href', 'http://10.255.242.136/audios/temp2/Inbound_24/2019-11-05/11536501001-8466.wav');
    $("#idSeleccionado").attr('download', '');
    $("#idSeleccionado").attr('target', '_blank');
    /*
    $('#tituloModal').html('Nuevo Audio');
    $('#action').removeClass('deleteAudio');
    $('#action').addClass('saveAudio');
     let url = currentURL + "/Audios/create";
     $.get(url, function(data, textStatus, jqXHR) {
        $('#modal').modal('show');
        $("#modal-body").html(data);
    });
    */
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

/***/ "./resources/js/module_recording/Inbound.js":
/*!**************************************************!*\
  !*** ./resources/js/module_recording/Inbound.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  /**
   * Evento para obtener el Agente
   */
  $(document).on('change', '.campana', function (event) {
    event.preventDefault();
    $("#agente").empty();
    $("#agente").append('<option>Selecciona un Agente</option>');
    $("#extension").empty();
    $("#extension").append('<option>Selecciona una Extension</option>');
    $("#extension").attr('disabled', 'disabled');
    $("#calificacion").empty();
    $("#calificacion").append('<option>Selecciona una Calificacion</option>');
    $("#calificacion").attr('disabled', 'disabled');
    $("#subcalificacion").empty();
    $("#subcalificacion").append('<option>Selecciona una Subcalificacion</option>');
    $("#subcalificacion").attr('disabled', 'disabled');
    var campana_id = $("#campana").val();
    var url = currentURL + "/Inbound/store/" + campana_id;

    var _token = $("input[name=_token]").val();

    $("#agente").removeAttr('disabled');
    $.ajax({
      type: "POST",
      dataType: "json",
      url: url,
      data: {
        campana_id: campana_id,
        _token: _token
      },
      success: function success(res) {
        var respuesta = JSON.stringify(res);
        alert(respuesta);
        console.log(respuesta);
        $.each(respuest, function (key, value) {
          //console.log(key + ' : ' + value);
          $("#agente").append('<option value="' + key + '">' + value + '</option>');
        });
      }
    });
  });
  /*$.ajax({
      type: "POST",
      url: url,
      campana_id: campana_id,
      data: {
          _token: _token,
      },
      success: function(res) {
          //if (res != '') {
          $("#agente").empty();
          //$("#agente").append('<option>Selecciona un Agente</option>');
          //$("#agente").append('<option>Selecciona un Agente</option>');
          $("#agente").append('@foreach ($nombres as $nombre)<option value="{{$nombre->id}}">{{$nombre->nombre}}</option>@endforeach');
          /*$.each(res, function(key, value) {
              $("#agente").append('<option value="' + value + '">' + value + '</option>');
           });*/
  //}

  /**
   * Evento para obtener la Extension
   */

  $(document).on('change', '.agente', function (event) {
    event.preventDefault();
    $("#extension").empty();
    $("#extension").append('<option>Selecciona una Extension</option>');
    $("#extension").removeAttr('disabled');
    $("#calificacion").empty();
    $("#calificacion").append('<option>Selecciona una Calificacion</option>');
    $("#calificacion").attr('disabled', 'disabled');
    var agente_id = $("#agente").val();
    var url = currentURL + '/Inbound/getExtensiones/' + agente_id;

    if (agente_id != '') {
      $.ajax({
        type: "GET",
        url: url,
        agente_id: agente_id,
        success: function success(res) {
          if (res != '') {
            $("#extension").empty();
            $("#extension").append('<option>Selecciona una Extension</option>');
            $.each(res, function (key, value) {
              $("#extension").append('<option value="' + value + '">' + value + '</option>');
            });
          }
        }
      });
    }
  });
  /**
   * Evento para obtener las calificaciones
   */

  $(document).on('change', '.extension', function (event) {
    event.preventDefault();
    $("#calificacion").empty();
    $("#calificacion").append('<option>Selecciona una Calificacion</option>');
    $("#calificacion").removeAttr('disabled');
    var campana_id = $("#campana").val();
    var url = currentURL + '/Inbound/getCalificaciones/' + campana_id;

    if (campana_id != '') {
      $.ajax({
        type: "GET",
        url: url,
        campana_id: campana_id,
        success: function success(res) {
          if (res != '') {
            $("#calificacion").empty();
            $("#calificacion").append('<option>Selecciona una Calificacion</option>');
            $.each(res, function (key, value) {
              $("#calificacion").append('<option value="' + value + '">' + value + '</option>');
            });
          }
        }
      });
    }
  });
  /**
   * Evento para obtener las sub_calificaciones
   */

  $(document).on('change', '.calificacion', function (event) {
    event.preventDefault();
    $("#subcalificacion").removeAttr('disabled');
  });
  /**
   * Evento para mostrar los resultados en el DataTable
   */

  $(document).on('click', '.filtrar', function (event) {
    event.preventDefault();
    var campana_id = $("#campana").val();
    var fechaI = $("#fechaIni").val();
    var fechaF = $("#fechaFin").val();
    var hrI = $("#hrIni").val();
    var hrF = $("#hrFin").val();
    var fechaIni = fechaI + " " + hrI + ":00";
    var fechaFin = fechaF + " " + hrF + ":59";
    var url = currentURL + '/Inbound/store/' + campana_id;

    var _token = $("input[name=_token]").val();

    $.ajax({
      url: url,
      type: 'POST',
      data: {
        fechaIni: fechaIni,
        fechaFin: fechaFin,
        _token: _token
      },
      success: function success(result) {
        $('.resultado').html(result);
        var tabla = $('.resultado #tableInbound').DataTable({
          'columnDefs': [{
            "orderable": false,
            "targets": [0],
            className: 'select-checkbox'
          }],
          select: {
            style: 'os',
            selector: 'td:first-child'
          },
          'order': [[6, 'desc'], [7, 'desc']],
          //dom: 'Bfrtip',
          dom: 'lBfrtip',
          buttons: [{
            extend: 'excel',
            className: 'btn-secondary btn-sm',
            text: '<i class="fa fa-file-excel-o"></i> Exportar a Excel'
          }]
        }); // Añade los botones de Eliminar,Descargar y Exportar a Excel
        //tabla.buttons().container().appendTo($('#botones'));

        tabla.buttons().container().prepend(' <button type="button" class="btn-secondary btn-sm downloadGrabacion"  data-widget="remove"><i class="fas fa fa-download"></i> Descargar Grabaciones</button> ');
        tabla.buttons().container().prepend(' <button type="button" class="btn-secondary btn-sm deleteGrabacion"  data-widget="remove"><i class="fas fa-trash-alt"></i> Eliminar Grabaciones</button> ');
        tabla.buttons().container().appendTo($('#botones')); // Agrega un input text a cada celda de pie de pagina

        $('#tableInbound tfoot th').each(function () {
          var title = $(this).text();
          $(this).html('<input type="text" placeholder="Buscar ' + title + '" />');
        }); // Aplica la busqueda

        tabla.columns().every(function () {
          var that = this;
          $('input', this.footer()).on('keyup change clear', function () {
            if (that.search() !== this.value) {
              that.search(this.value).draw();
            }
          });
        });
      }
    });
  });
  $(document).on("click", ".grabacion", function () {
    var nom_audio = this.id; //let _token = $("input[name=_token]").val();

    var url = currentURL + '/Inbound/getGrabacion/' + nom_audio;
    alert(url);
    $.ajax({
      url: url,
      type: 'GET',
      data: {
        nom_audio: nom_audio //_token: _token

      }
    });
  });
  $(document).on("click", ".checkall", function () {
    /**
     * Evento para Marcar/Desmarcar todos los checkbox de la columna 0
     */
    $('#tableInbound').DataTable().column(0).nodes().to$().find('input[type=checkbox]').attr('checked', this.checked);
    /**
     * Otra forma de hacerlo pero solo funciona con la pagina actual del DataTable
     */

    /*let tabla = $('.resultado #tableInbound').DataTable();
     if (this.checked) {
        for (i = 1; i <= tabla.rows().count(); i++) {
            $(".numcheck_" + i).attr('checked', 'checked');
        }
    } else {
        for (i = 1; i <= tabla.rows().count(); i++) {
            $(".numcheck_" + i).removeAttr('checked');
        }
    }*/
  });
  /**
   * Evento para seleccionar solo una columna del DataTable
   */

  /*$(document).on('click', '#tableInbound tbody tr', function(event) {
      event.preventDefault();
      let id = $(this).data("id");
      $("#idSeleccionado").val(id);
       $("#tableInbound tbody tr").removeClass('table-primary');
      $(this).addClass('table-primary');
   });*/

  /**
   * Evento para deshabilitar las extensiones si seleccionan un Agente
   */

  $(document).on('change', '#agente', function (event) {
    event.preventDefault(); //$("#extension").attr('disabled', 'disabled');
  });
  /**
   * Evento para deshabilitar los agentes si seleccionan una extension
   */

  $(document).on('change', '#extension', function (event) {
    event.preventDefault(); //$("#agente").attr('disabled', 'disabled');
  });
  /**
   * Evento para deshabilitar las subcalificaciones si seleccionan una Calificacion
   */

  $(document).on('change', '#calificacion', function (event) {
    event.preventDefault();
  });
  /**
   * Evento para deshabilitar las calificaciones si seleccionan una subCalificacion
   */

  $(document).on('change', '#subcalificacion', function (event) {
    event.preventDefault();
  });
  /**
   * Evento para mostrar el calendario en los input type Fecha Inicio
   */

  $(document).on('click', '#fechaIni', function (event) {//$("#fechaIni").datepicker({ dateFormat: 'yy-mm-dd' });
  });
  /**
   * Evento para mostrar el calendario en los input type Fecha Fin
   */

  $(document).on('click', '#fechaFin', function (event) {//$("#fechaFin").datepicker({ dateFormat: 'yy-mm-dd' });
  });
});

/***/ }),

/***/ "./resources/js/module_recording/menu.js":
/*!***********************************************!*\
  !*** ./resources/js/module_recording/menu.js ***!
  \***********************************************/
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

    if (id == 36) {
      url = currentURL + '/Inbound';
      table = ' #tableInbound';
    } else if (id == 37) {
      url = currentURL + '/Outbound';
      table = ' #tableOutbound';
    } else if (id == 38) {
      url = currentURL + '/Manuales';
      table = ' #tableManuales';
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

/***/ 3:
/*!***********************************************************************************************************************************************!*\
  !*** multi ./resources/js/module_recording/menu.js ./resources/js/module_recording/Grabaciones.js ./resources/js/module_recording/Inbound.js ***!
  \***********************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_recording\menu.js */"./resources/js/module_recording/menu.js");
__webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_recording\Grabaciones.js */"./resources/js/module_recording/Grabaciones.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\Nimbus\resources\js\module_recording\Inbound.js */"./resources/js/module_recording/Inbound.js");


/***/ })

/******/ });