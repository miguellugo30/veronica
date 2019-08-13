<form id="formDataFormulario">
    <div class="col-12" >
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="nombre"><b>Tipo</b></label>
                    <select name="tipo" id="tipo" class="form-control form-control-sm" disabled>
                        <option value="">Seleccione un tipo</option>
                        @foreach ($TipoMarcacion as $tipo)
                            <option value="{{$tipo->id}}" {{($tipo->id == $formulario->Cat_Tipo_Marcacion_id) ? 'selected = "selected"':'' }}>{{ $tipo->tipo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="nombre"><b> Nombre Formulario</b></label>
                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre Formulario" value='{{$formulario->nombre}}' readonly >
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
                        @foreach ($campos as $campo)
                        <tr id="tr_1">
                            <td>
                                <input type="text" class="form-control form-control-sm " name="nombre_campo_1" id="nombre_campo" value='{{$campo->nombre_campo }}'>
                            </td>
                            <td>
                                <select name="tipo_campo_1" id="tipo_campo"  class="form-control form-control-sm">
                                    <option value="">Selecciona un tipo</option>
                                    <option value="text" {{('text' == $campo->tipo_campo) ? 'selected = "selected"':'' }}>Texto Corto</option>
                                    <option value="textarea" {{('textarea' == $campo->tipo_campo) ? 'selected = "selected"':'' }}>Texto Largo</option>
                                    <option value="fecha" {{('fecha' == $campo->tipo_campo) ? 'selected = "selected"':'' }}>Fecha</option>
                                    <option value="select" {{('select' == $campo->tipo_campo) ? 'selected = "selected"':'' }}>Opciones</option>
                                    <option value="numerico" {{('numerico' == $campo->tipo_campo) ? 'selected = "selected"':'' }}>Numerico</option>
                                    <option value="separador" {{('separador' == $formulario->Cat_Tipo_Marcacion_id) ? 'selected = "selected"':'' }}>Seperador</option>
                                    <option value="bloque_oculto" {{('bloque_oculto' == $campo->tipo_campo) ? 'selected = "selected"':'' }}>Crear Bloque Oculto</option>
                                    <option value="texto" {{('texto' == $campo->tipo_campo) ? 'selected = "selected"':'' }}>Texto Escrito</option>
                                    <option value="buscador" {{('buscador' == $campo->tipo_campo) ? 'selected = "selected"':'' }}>Buscador</option>
                                    <option value="buscador_historico" {{('buscador_historico' == $campo->tipo_campo) ? 'selected = "selected"':'' }}>Buscador Historio</option>
                                    
                                    <option value="asignador_folios" {{('asignador_folios' == $campo->tipo_campo) ? 'selected = "selected"':'' }}>Asignador de Folios</option>

                                    
                                    <option value="bloqueInicio" {{('bloqueInicio' == $campo->tipo_campo) ? 'selected = "selected"':'' }}>Bloque Inicio</option>
                                    <option value="bloqueFin" {{('bloqueFin' == $campo->tipo_campo) ? 'selected = "selected"':'' }}>Bloque Termino</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="tamano_1" id="tamano" value='{{$campo->tamano }}'>
                            </td>
                            <td>
                                <input type="checkbox" class="micheckbox" name="obligatorio_1" id="obligatorio" {{('on' == $campo->obligatorio) ? 'checked':'' }} >
                                <input type="hidden" name="obligatorio_1_hidden" id="obligatorio_hidden" value="off">
                            </td>
                            <td>
                                <input type="checkbox" class="micheckbox" name="editable_1" id="editable" {{('on' == $campo->editable) ? 'checked':'' }} >
                                <input type="hidden" name="editable_1_hidden" id="editable_hidden" value="off">
                            </td>
                            <td class="tr_clone_remove">
                                <button type="button" name="remove" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            <!--input type="button" name="remove" value="Eliminar" class="btn btn-danger btn-sm"-->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
</form>
