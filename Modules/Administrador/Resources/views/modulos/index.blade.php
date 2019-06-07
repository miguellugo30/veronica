<div class="col-12 viewIndex">
    <fieldset >
        <legend>
            <i class="fas fa-th"></i>
            Modulos
            <button type="button" class="btn btn-primary btn-xs newModule" style="float: right;margin-left: 5px;">
                <i class="fas fa-user-plus"></i>
                Nuevo modulo
            </button>
            <button type="button" class="btn btn-primary btn-xs orderignModule" style="float: right;">
                <i class="fas fa-sort-numeric-down"></i>
                Ordenar modulo
            </button>
        </legend>
        <table id="tableModulos" class="display table table-striped table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Prioridad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($modulos as $modulo)
                        <tr data-id="{{ $modulo->id }}">
                            <td>{{ $modulo->nombre }}</td>
                            <td>{{ $modulo->descripcion }}</td>
                            <td>{{ $modulo->prioridad }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>
