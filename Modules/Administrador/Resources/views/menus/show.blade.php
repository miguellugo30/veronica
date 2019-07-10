<fieldset >
    <legend>
        <i class="fas fa-align-justify"></i>
        Sub Menú
        <button type="button" class="btn btn-primary btn-xs newSubCat" style="float: right;margin-left: 5px;">
            <i class="fas fa-plus"></i>
            Nuevo sub menú
        </button>
        <button type="button" class="btn btn-primary btn-xs orderignSubCat" style="float: right;">
            <i class="fas fa-sort-numeric-down"></i>
            Ordenar sub menú
        </button>
        <input type="hidden" name="id_categoria" id="id_categoria" value="{{ $id }}">
    </legend>
    <table id="tableSubMenus" class="display table table-striped table-condensed" style="width:100%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Prioridad</th>
                    <th>tipo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subCategorias as $subCategoria)
                    <tr data-id="{{ $subCategoria->id }}">
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
</fieldset>
