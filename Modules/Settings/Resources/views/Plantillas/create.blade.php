<div class="row">
    <div class="col-12">
        <form id="altaCampo" method="post">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="nombre"><b>Nombre *:</b></label>
                        <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="col-md-12">
                    <fieldset>
                        <legend>Campos</legend>
                        <table id="tablaCampos" class="table table-striped table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th>Campo</th>
                                    <th><input type="checkbox" class="todos_num_marcar"> Numero a marcar</th>
                                    <th><input type="checkbox" class="todos_mostrar"> Mostrar agente</th>
                                    <th><input type="checkbox" class="todos_editable"> Editable</th>
                                    <th>
                                        <button type="button" class="btn btn-primary btn-sm" id="addCampo"><i class="fas fa-plus"></i> Agregar</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="tr_1" class="text-center clonar">
                                    <td>
                                        <select name="campo_id_1" id="campo_id_1" class="form-control form-control-sm campo_id">
                                            <option value="">Selecciona un campo</option>
                                            @foreach ($campos as $campo)
                                            <option value="{{$campo->id}}">{{$campo->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="checkbox" class="num_marcar" name="num_marcar_1" id="num_marcar_1" value="1"></td>
                                    <td><input type="checkbox" class="mostrar" name="mostrar_1" id="mostrar_1" value="1"></td>
                                    <td><input type="checkbox" class="editable" name="editable_1" id="editable_1" value="1"></td>
                                    <td><button type="button" name="remove" class="btn btn-danger tr_clone_remove" style="display:none"><i class="fas fa-trash-alt"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
        </form>
        <div class="form-group">
            <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
        </div>
        <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
            <ul></ul>
        </div>
    </div>
</div>
