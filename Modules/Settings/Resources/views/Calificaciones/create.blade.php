<form id="formDataCalificaciones">
    <div class="col-12" >
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="nombre"><b>Nombre del grupo *:</b></label>
                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="nombre"><b> Descripción del grupo *:</b></label>
                    <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion" placeholder="Descripcion">
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
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="tr_1" class="clonar">
                            <td>
                                <input type="text" class="form-control form-control-sm opciones" name="nombre_calificacion_1" id="nombre_calificacion" placeholder="Nombre Calificacion">
                            </td>
                            <td>
                                <select name="formulario_calificacion_1" id="formulario_calificacion" data-action="create" class="form-control form-control-sm opciones subFormulario">
                                    <option value="">Selecciona un formulario</option>
                                    @foreach ($formularios as $formulario)
                                    <option value="{{$formulario->id}}">{{$formulario->nombre}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tr_clone_remove text-center">
                                <button type="button" name="remove" class="btn btn-danger" style="display:none"><i class="fas fa-trash-alt"></i></button>
                            </td>
                            <td class="text-center">
                                <button type="button" name="view_1" id="view" class="btn btn-info view" style="display:none"><i class="fas fa-eye"></i></button>
                            </td>
                        </tr>
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
