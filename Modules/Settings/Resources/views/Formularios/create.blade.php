<form id="formDataFormulario">
    <div class="col-12" >
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="nombre"><b>Tipo</b></label>
                    <select name="tipo" id="tipo" class="form-control form-control-sm">
                        <option value="">Seleccione un tipo</option>
                        @foreach ($TipoMarcacion as $tipo)
                            <option value="{{$tipo->id}}">{{ $tipo->tipo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="nombre"><b> Nombre Formulario</b></label>
                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre Formulario">
                    @csrf
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <fieldset>
                <legend>Campos de formulario</legend>
                <table id='formulario' class="table table-striped table-sm tableNewForm">
                    <thead>
                        <tr>
                            <th>Nombre Campo</th>
                            <th>Tipo Campo</th>
                            <th>Longitud</th>
                            <th>Requerido</th>
                            <th>Editable</th>
                            <td><input type="button" class="btn btn-primary btn-sm" id = "add" value = "Agregar campo" /></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="tr_1">
                            <td>
                                <input type="text" class="form-control form-control-sm " name="nombre_campo_1" id="nombre_campo">
                            </td>
                            <td>
                                <select name="tipo_campo_1" id="tipo_campo"  class="form-control form-control-sm ">
                                    <option value="">Selecciona un tipo</option>
                                    <option value="text">Texto Corto</option>
                                    <option value="textarea">Texto Largo</option>
                                    <option value="fecha">Fecha</option>
                                    <option value="select">Opciones</option>
                                    <option value="numerico">Numerico</option>
                                    <option value="separador">Seperador</option>
                                    <option value="bloque_oculto">Crear Bloque Oculto</option>
                                    <option value="texto">Texto Escrito</option>
                                    <option value="buscador">Buscador</option>
                                    <option value="buscador_historio">Buscador Historio</option>
                                    
                                    <option value="asignador_folios">Asignador de Folios</option>

                                    
                                    <option value="bloqueInicio">Bloque Inicio</option>
                                    <option value="bloqueFin">Bloque Termino</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="tamano_1" id="tamano">
                            </td>
                            <td>
                                <input type="checkbox" class="micheckbox" name="obligatorio_1" id="obligatorio">
                                <input type="hidden" name="obligatorio_1_hidden" id="obligatorio_hidden" value="off">
                            </td>
                            <td>
                                <input type="checkbox" class="micheckbox" name="editable_1" id="editable">
                                <input type="hidden" name="editable_1_hidden" id="editable_hidden" value="off">
                            </td>
                            <td class="tr_clone_remove">
                                <button type="button" name="remove" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            <!--input type="button" name="remove" value="Eliminar" class="btn btn-danger btn-sm"-->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
</form>
