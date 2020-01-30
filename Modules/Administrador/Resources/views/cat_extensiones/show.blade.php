<div class="col-12" style="text-align: right;">
    <button type="button" class="btn btn-primary btn-sm newExtension" data-widget="remove"><i class="fas fa-plus"></i> Nueva Extension</button>
</div>
<br><br>
<div class="col-12">
    <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $idEmpresa }}">
    <input type="hidden" name="action" id="action" value="dataExtensiones">
    @csrf
    <table id="TableCatExts" class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Editar</th>
                <th>Canal</th>
                <th>Extension</th>
                <th>Licencia en uso</th>
                <th>Licencias Bria</th>
                <th></th>
                <th>Licencia Ocupada</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($extensiones as $extension)
                <tr>
                    <td class="text-center"><input type="checkbox" class="editar_extension" name="editar_extension_{{ $extension->id }}" id="editar_extension_{{ $extension->id }}" value="{{ $extension->id }}"></td>
                    <td>
                        <select  class="form-control form-control-sm" name="canal_extension_{{ $extension->id }}" id="canal_extension_{{ $extension->id }}" disabled>
                            @foreach ($canales as $canal)
                                <option value="{{$canal->id}}" {{ $canal->id == $extension->Canales_id ? "selected" : "" }}>{{ $canal->protocolo.$canal->Troncales->nombre."/".$canal->prefijo }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="form-control form-control-sm" type="text" name="extension_{{ $extension->id }}" id="extension_{{ $extension->id }}" value="{{ $extension->extension }}" disabled>
                    </td>
                    <td>
                        @if ( $extension->Cat_Licencias_Bria_id != 0 )
                            {{ $extension->Licencias->licencia }}
                        @else
                            Sin licencia.
                        @endif
                    </td>
                    <td>
                        <select  class="form-control form-control-sm" name="licencia_extension_{{ $extension->id }}" id="licencia_extension_{{ $extension->id }}" disabled>
                            <option value="0">Selecciona una licencia</option>
                            @foreach ($licencias as $licencia)
<<<<<<< HEAD
                                <option value="{{$licencia->id}}" {{ $licencia->id == $extension->Cat_Licencias_Bria_id ? "selected" : "" }} {{ $licencia->ocupadas >= $licencia->disponibles ? "hidden" : "" }}>{{ $licencia->licencia }}</option>
=======
                                <option value="{{$licencia->id}}">{{ $licencia->licencia }}</option>
>>>>>>> db6863daa77c3c4a9f8b7deed84e30e5b8dcd0bd
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm deleteExtension" id="delete_{{ $extension->id }}" style="display:none"><i class="fas fa-trash-alt"></i></button>
                    </td>
                    <td>
                        <input class="form-control form-control-sm" type="text" name="licencia_ocupada_" id="licencia_ocupada_" value="@foreach ($licencias as $licencia){{$licencia->id == $extension->Cat_Licencias_Bria_id ? "$licencia->licencia" : ""}}@endforeach" disabled>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
