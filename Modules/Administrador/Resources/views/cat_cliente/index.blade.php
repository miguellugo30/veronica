<div class="col-12 viewIndex">
    <fieldset >
        <legend>
            <i class="fas fa-th"></i>
            Catalogo Estado Cliente
            <button type="button" class="btn btn-primary btn-xs newEdoCli" style="float: right;margin-left: 5px;">
                <i class="fas fa-plus"></i>
                Nuevo catalogo
            </button>
            <button type="button" class="btn btn-primary btn-xs orderignEdoCli" style="float: right;">
                <i class="fas fa-sort-numeric-down"></i>
                Ordenar catalogo
            </button>
        </legend>
        <table id="tableEdoCli" class="display table table-striped table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Marcar</th>
                        <th>Mostrar Agente</th>
                        <th>Parametrizar</th>
                        <th>Orden</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cat_clientes as $cat_cliente)
                        <tr data-id="{{ $cat_cliente->id }}">
                            <td>{{ $cat_cliente->nombre }}</td>
                            <td>{{ $cat_cliente->descripcion }}</td>
                            <td>{{ ( $cat_cliente->marcar == 'y' ) ? "Si" : "No" }}</td>
                            <td>{{ ( $cat_cliente->mostrar_agente  == 'y' ) ? "Si" : "No" }}</td>
                            <td>{{ ( $cat_cliente->parametrizar ) ? "Si" : "No" }}</td>
                            <td>{{ $cat_cliente->orden }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>
