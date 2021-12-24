<form id="form_opc">
    <div class="col" id="opcionesForm" style="display:none">
        <table id='formulario' class="table table-striped table-sm tableOpc">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Opcion</th>
                    <th>Sub Formulario</th>
                    <td>
                        <button type="button" class="btn btn-primary add_opc btn-sm"><i class="fas fa-plus-square"></i> Agregar</button>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr id="tr_opciones_1" class="clonar">
                    <td name="numero_1" id="numero_opcion">
                        1
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm " name="nombre_opcion_1" id="nombre_opcion" placeholder="Nombre Opcion">
                    </td>
                    <td>
                        <select name="form_id_1" id="form_id"  class="form-control form-control-sm ">
                            <option value="">Selecciona un Formulario</option>
                                <option value="0">Sin Formulario</option>
                            @foreach ($formularios as $formulario)
                                <option value="{{ $formulario->id }}">{{ $formulario->nombre }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="text-center " data-opcion-id="">
                        <button type="button" name="remove" id="remove"class="btn btn-danger tr_clone_remove_opcion" style="display: none"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col" id="folioForm" style="display:none">
        <div class="form-group">
            <label for="folio"><b> Prefijo</b></label>
            <input type="text" class="form-control form-control-sm" id="prefijo" name="prefijo" placeholder="Prefijo">
        </div>
        <div class="form-group">
            <label for="folio"><b> Folio</b></label>
            <input type="text" class="form-control form-control-sm" id="folio" name="folio" placeholder="Folio">
        </div>
    </div>
</form>
