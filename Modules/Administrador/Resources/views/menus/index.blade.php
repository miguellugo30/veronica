<div class="col-12 viewIndex">
    <fieldset>
        <legend>
            <i class="fas fa-align-justify"></i> Menus
            <button type="button" class="btn btn-primary btn-xs newCat" style="float: right;margin-left: 5px;">
                <i class="fas fa-plus"></i>
                Nuevo menu
            </button>
            <button type="button" class="btn btn-primary btn-xs orderignCat" style="float: right;">
                <i class="fas fa-sort-numeric-down"></i>
                Ordenar menu
            </button>
        </legend>

        <div class="col-md-12 viewTable">
            <table id="tableMenus" class="display table table-striped table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Prioridad</th>
                        <th>tipo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr data-id="{{ $categoria->id }}">
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->descripcion }}</td>
                            <td>{{ $categoria->prioridad }}</td>
                            <td>
                                @if ($categoria->tipo == 1)
                                    Sistema
                                @else
                                    Clientes
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </fieldset>
</div>
<div class="col-md-6 viewSubCat" ></div>

<div class="col-12 viewCreate">

</div>

