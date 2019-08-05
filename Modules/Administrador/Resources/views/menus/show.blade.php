<table id="tableSubMenus" class=" table table-sm table-bordere table-hover " style="width:80%;margin: auto;">
    <thead  class="thead-light">
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Prioridad</th>
            <th>tipo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subCategorias as $subCategoria)
            <tr data-id="{{ $subCategoria->id }}" style="cursor:pointer">
                <td>{{ $subCategoria->nombre }}</td>
                <td>{{ $subCategoria->descripcion }}</td>
                <td>{{ $subCategoria->prioridad }}</td>
                <td>
                    @if ($subCategoria->tipo == 1)
                        Sistema
                    @else
                        Clientes
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
