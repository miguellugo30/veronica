<div class="col-md-12" style="text-align: right;">
        @can('create did')
        <button type="button" class="btn btn-primary btn-sm newDid" data-widget="remove"><i class="fas fa-plus"></i> Nuevo DID</button>
        @endcan
    </div>
    <br><br>
<div class="col-md-12">
    <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $id }}">
    @csrf
    <table id="TableCatExts" class="display table table-striped table-sm" style="width:100%">
        <!-- Encabezados de la tabla que se mostrara al inicio -->
        <thead>
            <tr>
                <th>Editar</th>
                <th>Canal</th>
                <th>Did</th>
                <th>Referencia</th>
                <th>Numero Real</th>
                <th>Gateway</th>
                <th>Fakedid</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $dids as $did )
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="editar_did_{{$did->id}}" id="editar_did" class="editar_did" value="{{ $did->id }}">
                    </td>
                    <td>
                        <select name="canal_did_{{$did->id}}" id="canal_did" class="form-control form-control-sm did_edi_{{ $did->id }}" disabled>
                            @foreach ($canales as $canal)
                                <option value="{{$canal->id}}" {{ ( $did->Canales_id == $canal->id ) ? 'selected' : '' }}>{{ $canal->protocolo }}{{ $canal->Troncales->nombre }}/{{ $canal->prefijo }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="text" id="did"        name="did_{{$did->id}}"        value=" {{ $did->did }}"       class="form-control form-control-sm did_edi_{{ $did->id }}" disabled></td>
                    <td><input type="text" id="referencia" name="referencia_{{$did->id}}" value="{{ $did->referencia }}" class="form-control form-control-sm did_edi_{{ $did->id }}" disabled></td>
                    <td><input type="text" id="num_real"   name="num_real_{{$did->id}}"  value="{{ $did->numero_real }}" class="form-control form-control-sm did_edi_{{ $did->id }}" disabled></td>
                    <td>
                        <select name="gateway_{{$did->id}}" id="gateway" class="form-control form-control-sm did_edi_{{ $did->id }}" disabled>
                            <option value="1" {{ ( $did->gateway == 1 ) ? 'selected' : '' }}>Habilitado</option>
                            <option value="0" {{ ( $did->gateway == 0 ) ? 'selected' : '' }}>Deshabilitado</option>
                        </select>
                    </td>
                    <td>
                        <select name="fakedid_{{$did->id}}" id="fakedid" class="form-control form-control-sm did_edi_{{ $did->id }}" disabled>
                            <option value="1" {{ ( $did->fakedid == 1 ) ? 'selected' : '' }}>Habilitado</option>
                            <option value="0" {{ ( $did->fakedid == 0 ) ? 'selected' : '' }}>Deshabilitado</option>
                        </select>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
