<form id="form_opc">
    @csrf

    @if ( $tipo_campo == 'select' )
        <div class="col" id="opcionesForm" >
            <table id='formulario' class="table table-striped table-sm tableOpc">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Opcion</th>
                        <th>Sub Formulario</th>
                        <td>
                            <button type="button" class="btn btn-primary add_opc btn-sm"><i class="fas fa-plus-square"></i> Agregar</button>
                            <input type="hidden" class="form-control form-control-sm" id="id_tipo" name="id_tipo" value="{{ $tipo_campo }}">
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($opciones as $opcion)
                        <tr id="tr_opciones_1" class="clonar">
                            <td>
                                1
                            </td>
                            <td>
                                <input type="hidden" class="form-control form-control-sm " name="id_opcion_{{$opcion->id}}" id="id_opcion" value="{{$opcion->id}}" >
                                <input type="hidden" class="form-control form-control-sm " name="id_campos_{{$opcion->id}}" id="id_campos" value="{{$opcion->Campos_id}}" >
                                <input type="text" class="form-control form-control-sm " name="nombre_opcion_{{$opcion->id}}" id="nombre_opcion" value="{{$opcion->opcion}}" placeholder="Nombre Opcion">
                            </td>
                            <td>
                                <select name="form_id_{{$opcion->id}}" id="form_id"  class="form-control form-control-sm ">
                                    <option value="">Selecciona un Formulario</option>
                                    <option value="0">Sin Formulario</option>
                                    @foreach ($formularios as $formulario)
                                        <option value="{{ $formulario->id }}" {{ ( $formulario->id == $opcion->Formularios_id ) ? 'selected=selected' : '' }}>{{ $formulario->nombre }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center tr_clone_remove_opcion" data-opcion-id="{{$opcion->id}}">
                                <button type="button" name="remove" id="remove"class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif ( $tipo_campo == 'asignador_folios' )
        <div class="col" id="folioForm">
            <div class="form-group">
                <label for="folio"><b> Prefijo</b></label>
                <input type="hidden" class="form-control form-control-sm" id="id_tipo" name="id_tipo" value="{{ $tipo_campo }}">
                <input type="hidden" class="form-control form-control-sm" id="id_campo" name="id_campo" value="{{ $campo->id }}">
                <input type="text" class="form-control form-control-sm" id="prefijo" name="prefijo" placeholder="Prefijo" value="{{ $campo->prefijo }}">
            </div>
            <div class="form-group">
                <label for="folio"><b> Folio</b></label>
                <input type="text" class="form-control form-control-sm" id="folio" name="folio" placeholder="Folio" value="{{ $campo->folio }}">
            </div>
        </div>
    @endif
</form>
