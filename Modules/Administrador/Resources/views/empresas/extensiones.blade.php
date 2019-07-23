<div class="col-md-6">
    <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $idEmpresa }}">
    <input type="hidden" name="action" id="action" value="dataExtensiones">
    @csrf
    <table id="TableCatExts" class="table table-striped">
        <thead>
            <tr>
                <th>Editar</th>
                <th>Canal</th>
                <th>Extension</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!--div class="col-md-6">
    <div class="form-group">
        <label for="canal_id">Canal</label>
        <select name="canal_id" id="canal_id" class="form-control input-sm">
            <option value="" >Selecciona un canal</option>
            @foreach ($canales as $canal)
                <option value="{{$canal->id}}">{{ $canal->protocolo }}{{ $canal->Troncales->nombre }}/{{ $canal->prefijo }}</option>
            @endforeach
        </select>
        <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $idEmpresa }}">
        <input type="hidden" name="action" id="action" value="dataExtensiones">
        @csrf
    </div>
    <div class="form-group">
        <label for="">Extensiones
        </label>
        <div class="form-inline" style="text-align:center">
            <div class="form-group">
                <label for="extension">Extension:</label>
                <input type="number" min="1" class="form-control" id="extension" name="extension" placeholder="Extension">
            </div>
            <div class="form-group">
                <label for="posiciones">Posiciones:</label>
                <input type="number" class="form-control" min="1" max="{{ $numExtensiones }}" id="posiciones" name="posiciones" value="{{ $numExtensiones }}">
            </div>
        </div>
    </div>
</div-->
