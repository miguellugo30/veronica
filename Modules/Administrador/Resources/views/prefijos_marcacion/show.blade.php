<style>
.input-group-text {
    font-size: 0.87rem;
}
</style>

<div class="col-12" style="text-align: right;">
    {{--@can('create prefijos marcacion')--}}
    <button type="button" class="btn btn-primary btn-sm newPrefijoMarcacion" data-widget="remove"><i class="fas fa-plus"></i> Nuevo Prefijo</button>
    {{--@endcan--}}
</div>

<div class="col-12">
@csrf
    <input type="hidden" name="action" id="action" value="dataPrefijos">
    <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $idEmpresa }}">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Editar</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Prefijo</th>
                <th>Prefijo_nuevo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Prefijos as $prefijo)
                <tr>
                <td class="text-center">
                    <input type="checkbox" class="editar_prefijo" name="editar_prefijo_{{ $prefijo->id }}" value="{{ $prefijo->id }}">
                </td>
                <td class="text-center">
                    <input type="text" name="nombre_{{ $prefijo->id }}" id="nombre_{{ $prefijo->id }}" value="{{ $prefijo->nombre }}" class="form-control form-control-sm" disabled>
                </td>
                <td class="text-center">
                    <input type="text" name="descripcion_{{ $prefijo->id }}" id="descripcion_{{ $prefijo->id }}" value="{{ $prefijo->descripcion }}" class="form-control form-control-sm" disabled>
                </td>
                <td class="text-center">
                    <input type="text" name="prefijo_{{ $prefijo->id }}" id="prefijo_{{ $prefijo->id }}" value="{{ $prefijo->prefijo }}"  class="form-control form-control-sm" disabled>
                </td>
                <td class="text-center">
                    <input type="text" name="prefijoNuevo_{{ $prefijo->id }}" id="prefijoNuevo_{{ $prefijo->id }}" value="{{ $prefijo->prefijo_nuevo }}" class="form-control form-control-sm" disabled>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm deletePrefijo" id="delete_{{ $prefijo->id }}" style="display:none"><i class="fas fa-trash-alt"></i></button>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
