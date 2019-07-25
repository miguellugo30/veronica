<div class="col-md-12" style="text-align: right;">
    <button type="button" class="btn btn-primary btn-xs newExtension" data-widget="remove"><i class="fas fa-plus"></i> Nueva Extension</button>
</div>
<br><br>
<div class="col-md-12">
    <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $idEmpresa }}">
    <input type="hidden" name="action" id="action" value="dataExtensiones">
    @csrf
    <table id="TableCatExts" class="table table-striped">
        <thead>
            <tr>
                <th>Editar</th>
                <th>Canal</th>
                <th>Extension</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($extensiones as $extension)
                <tr>
                    <td><input type="checkbox" class="editar_extension" name="editar_extension_{{ $extension->id }}" id="editar_extension_{{ $extension->id }}" value="{{ $extension->id }}"></td>
                    <td>
                        <select  class="form-control input-sm" name="canal_extension_{{ $extension->id }}" id="canal_extension_{{ $extension->id }}" disabled>
                            @foreach ($canales as $canal)
                                <option value="{{$canal->id}}" {{ $canal->id == $extension->Canales_id ? "selected" : "" }}>{{ $canal->protocolo }}{{ $canal->Troncales->nombre }}/{{ $canal->prefijo }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="form-control input-sm" type="text" name="extension_{{ $extension->id }}" id="extension_{{ $extension->id }}" value="{{ $extension->extension }}" disabled>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-xs deleteExtension" id="delete_{{ $extension->id }}" style="display:none"><i class="fas fa-plus"></i> Eliminar Extension</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
