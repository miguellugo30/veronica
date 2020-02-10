<div class="row">
    <div class="col-12">
        <form id="altaCampo" method="post">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="nombre"><b>Nombre *:</b></label>
                        <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre" value="{{$plantilla->nombre}}">
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
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($plantilla->Plantillas_campos as $camposPlantilla)
                                    <tr id="tr_{{$i}}" class="text-center clonar">
                                        <td>
                                            <select name="campo_id_{{$i}}" id="campo_id_{{$i}}" class="form-control form-control-sm campo_id">
                                                <option value="">Selecciona un campo</option>
                                                @foreach ($campos as $campo)
                                                    <option value="{{$campo->id}}" {{ $campo->id == $camposPlantilla->fk_campos_plantilla_empresa_fk_cat_campos_plantilla_id ? 'selected=selected' : '' }} >{{$campo->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="checkbox" class="num_marcar" name="num_marcar_{{$i}}" id="num_marcar_{{$i}}" value="1" {{ $camposPlantilla->marcar == '1' ? 'checked' : '' }}></td>
                                        <td><input type="checkbox" class="mostrar" name="mostrar_{{$i}}" id="mostrar_{{$i}}" value="1" {{ $camposPlantilla->mostrar == '1' ? 'checked' : '' }}></td>
                                        <td><input type="checkbox" class="editable" name="editable_{{$i}}" id="editable_{{$i}}" value="1" {{ $camposPlantilla->editable == '1' ? 'checked' : '' }}></td>
                                        @if ($loop->first)
                                            <td><button type="button" name="remove" class="btn btn-danger tr_clone_remove" style="display:none"><i class="fas fa-trash-alt"></i></button></td>
                                        @else
                                            <td><button type="button" name="remove" class="btn btn-danger tr_clone_remove" ><i class="fas fa-trash-alt"></i></button></td>
                                        @endif
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
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
