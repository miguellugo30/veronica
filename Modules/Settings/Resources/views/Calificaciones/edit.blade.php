<form id="formDataCalificaciones">
        <div class="col-12" >
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="nombre"><b>Nombre del grupo *:</b></label>
                        <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre" value="{{ $grupo->nombre }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="nombre"><b> Descripción del grupo *:</b></label>
                        <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion" placeholder="Descripcion" value="{{ $grupo->descripcion }}">
                        @csrf
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <fieldset>
                    <legend>Calificaciones</legend>
                    <table id='formulario' class="table table-striped table-sm tableNewForm">
                        <thead>
                            <tr>
                                <th>Nombre Calificacion *:</th>
                                <th>Formulario *:</th>
                                <td><input type="button" class="btn btn-primary btn-sm" id = "addCalificaciones" value = "Agregar calificaciones" /></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($grupo->Calificaciones as $calificacion)
                                <tr id="tr_{{$i}}" class="clonar">
                                    <td>
                                        <input type="hidden" name="id_calificacion_{{$i}}" id="id_calificacion" value="{{ $calificacion->id }}">
                                        <input type="text" class="form-control form-control-sm opciones" name="nombre_calificacion_{{$i}}" id="nombre_calificacion" placeholder="Nombre Calificacion" value="{{ $calificacion->nombre }}">
                                    </td>
                                    <td>
                                        <select name="formulario_calificacion_{{$i}}" id="formulario_calificacion" data-action="create" class="form-control form-control-sm opciones subFormulario">
                                            <option value="">Selecciona un formulario</option>
                                            @foreach ($formularios as $formulario)
                                                <option value="{{$formulario->id}}" {{($formulario->id == $calificacion->Formularios_id) ? 'selected = "selected"':'' }}>{{$formulario->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="tr_clone_remove-calificacion text-center" data-id-eliminar="{{ $calificacion->id }}">
                                        <button type="button" name="remove"  class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </fieldset>
            </div>
            <div class="form-group">
                <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
            </div>
            <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
                <ul></ul>
            </div>
        </div>
    </form>
